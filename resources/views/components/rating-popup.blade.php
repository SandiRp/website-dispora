<div id="rating-popup" class="fixed inset-0 z-[100] hidden items-center justify-center bg-gray-950/70 p-4 backdrop-blur-sm" role="dialog" aria-modal="true" aria-labelledby="rating-title">
    <div class="w-full max-w-md rounded-3xl bg-white p-6 shadow-2xl md:p-8">
        <div class="mb-5 flex items-start justify-between gap-4">
            <div>
                <p class="mb-1 text-xs font-bold uppercase tracking-widest text-dispora-600">Pendapat Anda</p>
                <h2 id="rating-title" class="text-2xl font-extrabold text-gray-900">Bagaimana pengalaman Anda?</h2>
            </div>
            <button id="rating-close" type="button" class="rounded-full p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-700" aria-label="Tutup">&times;</button>
        </div>
        <form id="rating-form" action="{{ route('ratings.store') }}" method="POST">
            @csrf
            <input type="hidden" name="page_url" value="{{ url()->current() }}">
            <fieldset class="mb-5">
                <legend class="mb-3 text-sm font-semibold text-gray-700">Pilih rating <span class="text-red-500">*</span></legend>
                <div class="flex justify-center gap-2" id="rating-stars">
                    @for($value = 1; $value <= 5; $value++)
                        <label class="cursor-pointer">
                            <input class="peer sr-only" type="radio" name="rating" value="{{ $value }}" required>
                            <span class="rating-star block text-4xl text-gray-300 transition hover:scale-110" aria-hidden="true">★</span>
                            <span class="sr-only">{{ $value }} bintang</span>
                        </label>
                    @endfor
                </div>
            </fieldset>
            <label for="rating-comment" class="mb-2 block text-sm font-semibold text-gray-700">Komentar <span class="font-normal text-gray-400">(opsional)</span></label>
            <textarea id="rating-comment" name="comment" maxlength="1000" rows="4" class="w-full rounded-xl border-gray-300 focus:border-dispora-500 focus:ring-dispora-500" placeholder="Ceritakan pengalaman Anda..."></textarea>
            <p id="rating-error" class="mt-2 hidden text-sm text-red-600" role="alert"></p>
            <button type="submit" class="mt-5 w-full rounded-xl bg-dispora-600 px-5 py-3 font-bold text-white transition hover:bg-dispora-700 disabled:cursor-wait disabled:opacity-60">Kirim Penilaian</button>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const popup = document.getElementById('rating-popup');
    const form = document.getElementById('rating-form');
    if (!popup || !form || localStorage.getItem('dispora_rating_submitted') === '1') return;

    const startedKey = 'dispora_visit_started_at';
    const startedAt = Number(localStorage.getItem(startedKey)) || Date.now();
    localStorage.setItem(startedKey, String(startedAt));
    const showPopup = () => {
        popup.classList.remove('hidden');
        popup.classList.add('flex');
        form.querySelector('input[name="rating"]')?.focus();
    };
    window.setTimeout(showPopup, Math.max(0, 300000 - (Date.now() - startedAt)));

    document.getElementById('rating-close')?.addEventListener('click', () => {
        popup.classList.add('hidden');
        popup.classList.remove('flex');
    });

    const radios = [...form.querySelectorAll('input[name="rating"]')];
    radios.forEach((radio, index) => radio.addEventListener('change', () => {
        form.querySelectorAll('.rating-star').forEach((star, starIndex) => {
            star.classList.toggle('text-yellow-400', starIndex <= index);
            star.classList.toggle('text-gray-300', starIndex > index);
        });
    }));

    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        const button = form.querySelector('button[type="submit"]');
        const error = document.getElementById('rating-error');
        button.disabled = true;
        error.classList.add('hidden');
        try {
            const response = await fetch(form.action, { method: 'POST', body: new FormData(form), headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } });
            if (!response.ok) throw new Error('Penilaian belum dapat disimpan. Silakan coba kembali.');
            localStorage.setItem('dispora_rating_submitted', '1');
            popup.innerHTML = '<div class="w-full max-w-md rounded-3xl bg-white p-10 text-center shadow-2xl"><div class="mb-4 text-5xl">✓</div><h2 class="text-2xl font-extrabold text-gray-900">Terima kasih!</h2><p class="mt-2 text-gray-600">Penilaian Anda berhasil disimpan.</p></div>';
            window.setTimeout(() => { popup.classList.add('hidden'); popup.classList.remove('flex'); }, 1800);
        } catch (exception) {
            error.textContent = exception.message;
            error.classList.remove('hidden');
            button.disabled = false;
        }
    });
});
</script>
@endpush
