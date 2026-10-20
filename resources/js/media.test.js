// Run with: node --test resources/js/media.test.js
import assert from 'node:assert/strict';
import { readFileSync } from 'node:fs';
import { test } from 'node:test';
import { runInNewContext } from 'node:vm';
import { fallbackImage, installMedia, isMediaUrl, resolveMedia } from './media.js';

test('stable media resolution, image fallback, and preview retries/races', async () => {
    globalThis.window = { location: { href: 'https://app.test/program' } };
    assert.equal(isMediaUrl('/file/official_logos/images/a.png'), true);
    assert.equal(isMediaUrl('/admin/files/documents/a.pdf'), true);
    for (const value of ['', null, '/berita/a', 'https://other.test/file/posts/a', 'javascript:alert(1)']) {
        assert.equal(isMediaUrl(value), false);
    }
    const signed = { url: 'https://objects.test/signed', expires_at: new Date(Date.now() + 900000).toISOString() };
    globalThis.fetch = async (url, options) => {
        assert.equal(url.origin, 'https://app.test');
        assert.equal(url.searchParams.get('resolve'), '1');
        assert.equal(url.searchParams.get('download'), '1');
        assert.equal(options.credentials, 'same-origin');
        assert.equal(options.cache, 'no-store');
        return { ok: true, json: async () => signed };
    };
    assert.equal(await resolveMedia('/file/documents/a.pdf?download=1'), signed.url);
    assert.equal(await resolveMedia('/admin/files/documents/a.pdf', true), signed.url);
    for (const response of [
        { ok: false, status: 404 }, { ok: false, status: 503 },
        { ok: true, redirected: true },
        { ok: true, json: async () => ({ ...signed, url: 'javascript:alert(1)' }) },
        { ok: true, json: async () => ({ ...signed, expires_at: '2000-01-01' }) },
        { ok: true, json: async () => { throw new Error('Not JSON'); } },
    ]) {
        globalThis.fetch = async () => response;
        await assert.rejects(resolveMedia('/file/documents/a.pdf'));
    }
    globalThis.fetch = async () => { throw new Error('Offline'); };
    await assert.rejects(resolveMedia('/file/documents/a.pdf'));

    const element = (tagName = 'DIV', attrs = {}) => ({
        tagName, attrs, style: {}, children: [], alt: '',
        getAttribute(name) { return this.attrs[name] ?? null; },
        hasAttribute(name) { return name in this.attrs; },
        setAttribute(name, value) { this.attrs[name] = value; },
        removeAttribute(name) { delete this.attrs[name]; },
        set src(value) { this.attrs.src = value; },
        get src() { return this.attrs.src; },
        closest() { return null; },
        append(...children) { this.children.push(...children); },
        before(node) { this.status = node; },
        addEventListener(name, callback) { this[name] = callback; },
        remove() { this.removed = true; },
    });
    const image = element('IMG', { src: '/file/posts/missing.png', srcset: 'bad.png 2x' });
    fallbackImage(image);
    assert.equal(image.src, '/images/media-placeholder.svg');
    assert.equal(image.alt, 'Gambar tidak tersedia');
    assert.equal(image.hasAttribute('srcset'), false);
    fallbackImage(image);
    assert.equal(image.src, '/images/media-placeholder.svg');
    const external = element('IMG', { src: 'https://other.test/image.png' });
    fallbackImage(external);
    assert.equal(external.src, 'https://other.test/image.png');
    const missing = element('IMG', { 'data-media-image': '', src: '' });
    fallbackImage(missing);
    assert.equal(missing.src, '/images/media-placeholder.svg');

    const listeners = {};
    const cached = element('IMG', { src: '/file/posts/cached.png' });
    cached.complete = true;
    cached.naturalWidth = 0;
    let mutations;
    globalThis.MutationObserver = class {
        constructor(callback) { mutations = callback; }
        observe() {}
    };
    globalThis.document = {
        readyState: 'loading',
        addEventListener(name, callback) { listeners[name] = callback; },
        createElement: () => element(),
        querySelectorAll: () => [cached],
    };
    let directive;
    installMedia({ directive(name, callback) { directive = callback; } });
    listeners.DOMContentLoaded();
    await new Promise(resolve => setTimeout(resolve, 0));
    assert.equal(cached.src, '/images/media-placeholder.svg');
    cached.src = '/admin/files/posts/dynamic.png';
    mutations([{ type: 'childList', addedNodes: [cached] }]);
    await new Promise(resolve => setTimeout(resolve, 0));
    assert.equal(cached.src, '/images/media-placeholder.svg');
    cached.src = '/file/posts/loading.png';
    mutations([{ type: 'attributes', target: cached }]);
    // Simulate the browser updating request state after observer delivery.
    cached.complete = false;
    await new Promise(resolve => setTimeout(resolve, 0));
    assert.equal(cached.src, '/file/posts/loading.png');
    cached.complete = true;
    cached.naturalWidth = 100;
    mutations([{ type: 'attributes', target: cached }]);
    await new Promise(resolve => setTimeout(resolve, 0));
    assert.equal(cached.src, '/file/posts/loading.png');
    let stopped = false;
    listeners.error({ target: image, stopImmediatePropagation() { stopped = true; } });
    assert.equal(stopped, true);
    const frame = element('IFRAME');
    let evaluate, cleanup;
    directive(frame, { expression: 'activeDoc' }, {
        evaluateLater: () => callback => { evaluate = callback; },
        effect: callback => callback(),
        cleanup: callback => { cleanup = callback; },
    });
    evaluate('/file/documents/missing.pdf');
    await new Promise(resolve => setImmediate(resolve));
    assert.match(frame.status.children[0].textContent, /tidak tersedia/);
    assert.equal(frame.status.children[1].hidden, false);
    assert.equal(frame.src, undefined);
    const pending = [];
    globalThis.fetch = () => new Promise(resolve => pending.push(resolve));
    evaluate('/file/documents/first.pdf');
    evaluate('/file/documents/second.pdf');
    pending[1]({ ok: true, json: async () => signed });
    await new Promise(resolve => setImmediate(resolve));
    pending[0]({ ok: false });
    await new Promise(resolve => setImmediate(resolve));
    assert.equal(frame.src, signed.url);
    assert.equal(frame.style.display, '');
    evaluate('');
    assert.equal(frame.src, undefined);
    cleanup();
    assert.equal(frame.status.removed, true);

    const link = element('A', { href: '/file/documents/a.pdf?download=1', download: '' });
    link.href = 'https://app.test/file/documents/a.pdf?download=1';
    const click = { target: { closest: () => link }, button: 0, preventDefault() {} };
    globalThis.fetch = async () => ({ ok: false });
    await listeners.click(click);
    assert.match(link.status.children[0].textContent, /tidak tersedia/);
    assert.equal(link.hasAttribute('aria-busy'), false);
    let destination;
    window.location.assign = url => { destination = url; };
    globalThis.fetch = async () => ({ ok: true, json: async () => signed });
    await listeners.click(click);
    assert.equal(destination, signed.url);
    destination = null;
    link.attrs.href = 'https://external.test/file/documents/a.pdf';
    await listeners.click(click);
    assert.equal(destination, null);
});

test('layouts use only bundled Alpine with media installed before startup', () => {
    for (const layout of ['main', 'app', 'guest']) {
        const view = readFileSync(new URL(`../views/layouts/${layout}.blade.php`, import.meta.url), 'utf8');
        assert.match(view, /@vite\([^\n]*resources\/js\/app\.js/);
        assert.doesNotMatch(view, /<script[^>]+src=["'][^"']*alpinejs/i);
    }
    const app = readFileSync(new URL('./app.js', import.meta.url), 'utf8');
    assert.match(app, /installMedia\(Alpine\);\s*Alpine\.start\(\)/);
});

test('both editor adapters reject JSON 422 and malformed success responses', () => {
    for (const page of ['create', 'edit']) {
        const view = readFileSync(new URL(`../views/admin/posts/${page}.blade.php`, import.meta.url), 'utf8');
        const source = view.slice(view.indexOf('class MyUploadAdapter'), view.indexOf('function MyCustomUploadAdapterPlugin'));
        const Adapter = runInNewContext(`${source.replace(/\{\{.*?\}\}/g, 'test')}; MyUploadAdapter`);
        for (const [status, response, succeeds] of [
            [422, { message: 'Invalid image.', errors: { upload: ['Invalid image.'] } }, false],
            [500, null, false], [200, {}, false],
            [200, { url: '/admin/files/posts/image.png' }, true],
        ]) {
            const adapter = new Adapter({});
            const listeners = {};
            adapter.xhr = { status, response, addEventListener(name, callback) { listeners[name] = callback; } };
            let resolved = false, rejected = false;
            adapter._initListeners(() => { resolved = true; }, () => { rejected = true; }, { name: 'image.png' });
            listeners.load();
            assert.equal(resolved, succeeds);
            assert.equal(rejected, !succeeds);
        }
    }
});
