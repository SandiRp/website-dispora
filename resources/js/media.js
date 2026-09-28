const placeholder = '/images/media-placeholder.svg';

export function isMediaUrl(value, base = window.location.href) {
    if (!value) return false;
    try {
        const url = new URL(value, base);
        return url.origin === new URL(base).origin && /^\/(?:file|admin\/files)\/[^/]+\/.+/.test(url.pathname);
    } catch {
        return false;
    }
}

export async function resolveMedia(value, download = false) {
    if (!isMediaUrl(value)) throw new Error('Media unavailable');
    const url = new URL(value, window.location.href);
    url.searchParams.set('resolve', '1');
    if (download) url.searchParams.set('download', '1');
    const response = await fetch(url, {
        headers: { Accept: 'application/json' },
        credentials: 'same-origin',
        cache: 'no-store',
        signal: AbortSignal.timeout(15000),
    });
    if (!response.ok || response.redirected) throw new Error('Media unavailable');
    const data = await response.json();
    const target = new URL(data.url);
    if (!['https:', 'http:'].includes(target.protocol) || !Number.isFinite(Date.parse(data.expires_at)) || Date.parse(data.expires_at) <= Date.now()) {
        throw new Error('Media unavailable');
    }
    return target.href;
}

export function fallbackImage(image) {
    if (image.tagName !== 'IMG' || image.closest('[contenteditable="true"]')) return;
    const src = image.getAttribute('src');
    if (src === placeholder || (!image.hasAttribute('data-media-image') && !isMediaUrl(src))) return;
    image.removeAttribute('srcset');
    image.closest('picture')?.querySelectorAll('source').forEach(source => source.removeAttribute('srcset'));
    image.alt ||= 'Gambar tidak tersedia';
    image.src = placeholder;
}

function mediaStatus(element, retry) {
    const box = document.createElement('div');
    box.className = 'relative z-10 bg-white text-gray-700 text-sm p-3 rounded';
    const message = document.createElement('span');
    message.setAttribute('role', 'status');
    message.setAttribute('aria-live', 'polite');
    const button = document.createElement('button');
    button.type = 'button';
    button.className = 'underline ml-2';
    button.textContent = 'Coba lagi';
    button.addEventListener('click', retry);
    box.append(message, button);
    element.before(box);
    return {
        box,
        show(text, canRetry = false) {
            message.textContent = text;
            button.hidden = !canRetry;
        },
    };
}

export function installMedia(Alpine) {
    // Capture before inline/Alpine handlers can replace the fallback or clear the source.
    document.addEventListener('error', event => {
        const image = event.target;
        if (image.tagName !== 'IMG' || image.closest('[contenteditable="true"]') || (!image.hasAttribute('data-media-image') && !isMediaUrl(image.getAttribute('src')) && image.getAttribute('src') !== placeholder)) return;
        event.stopImmediatePropagation();
        fallbackImage(image);
    }, true);

    // Image request state can still be stale during a src mutation microtask.
    const scan = root => setTimeout(() => {
        const images = root.tagName === 'IMG' ? [root] : root.querySelectorAll?.('img') || [];
        images.forEach(image => {
            if (image.complete && !image.naturalWidth) fallbackImage(image);
        });
    }, 0);
    const start = () => {
        scan(document);
        new MutationObserver(records => records.forEach(record => {
            if (record.type === 'attributes') scan(record.target);
            else record.addedNodes.forEach(scan);
        })).observe(document.body, { childList: true, subtree: true, attributes: true, attributeFilter: ['src', 'srcset'] });
    };
    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', start, { once: true });
    else start();

    Alpine.directive('media-preview', (frame, { expression }, { evaluateLater, effect, cleanup }) => {
        const evaluate = evaluateLater(expression);
        let current = '';
        let version = 0;
        const status = mediaStatus(frame, () => load(current));
        const load = async value => {
            current = value;
            const request = ++version;
            frame.style.display = 'none';
            frame.removeAttribute('src');
            status.show(value ? 'Memuat dokumen...' : 'Pilih dokumen untuk melihat pratinjau.');
            if (!value) return;
            try {
                const url = await resolveMedia(value);
                if (request !== version) return;
                frame.src = url;
                frame.style.display = '';
                // Cross-origin PDF viewers do not reliably report load failures.
                status.show('Jika pratinjau tidak tampil, coba lagi atau buka dokumen penuh.', true);
            } catch {
                if (request === version) status.show('Dokumen tidak tersedia. Silakan coba lagi.', true);
            }
        };
        effect(() => evaluate(value => load(value)));
        cleanup(() => { ++version; status.box.remove(); });
    });

    const statuses = new WeakMap();
    document.addEventListener('click', async event => {
        const link = event.target.closest?.('a[href]');
        if (!link || event.defaultPrevented || event.button !== 0 || event.ctrlKey || event.metaKey || event.shiftKey || event.altKey || !isMediaUrl(link.getAttribute('href'))) return;
        event.preventDefault();
        if (link.getAttribute('aria-busy') === 'true') return;
        let status = statuses.get(link);
        if (!status) {
            status = mediaStatus(link, () => link.click());
            statuses.set(link, status);
        }
        status.show('Memuat berkas...');
        link.setAttribute('aria-busy', 'true');
        const download = link.hasAttribute('download') || new URL(link.href).searchParams.get('download') === '1';
        const tab = !download && link.target === '_blank' ? window.open('about:blank', '_blank') : null;
        if (tab) tab.opener = null;
        try {
            const url = await resolveMedia(link.href, download);
            if (tab && !tab.closed) tab.location.replace(url);
            else window.location.assign(url);
            status.show('Berkas siap. Jika tidak terbuka, coba lagi.', true);
        } catch {
            tab?.close();
            status.show('Berkas tidak tersedia. Silakan coba lagi.', true);
        } finally {
            link.removeAttribute('aria-busy');
        }
    });
}
