{{-- ================================================================
     ACCESSIBILITY WIDGET — Floating Button + Panel
     Includes: TTS, Font Resize, High Contrast, Reading Guide,
               Link Highlighting, Grayscale, Google Translate
     ================================================================ --}}

{{-- Skip-to-content link (WCAG 2.4.1) --}}
<a href="#main-content" class="a11y-skip-link" id="a11y-skip-link">
    Langsung ke Konten Utama
</a>

{{-- ===================== FLOATING ACTION BUTTON ===================== --}}
<button id="a11y-fab"
        class="a11y-fab"
        aria-label="Buka menu aksesibilitas"
        aria-expanded="false"
        aria-controls="a11y-panel"
        title="Aksesibilitas">
    {{-- Pulse ring --}}
    <span class="a11y-fab-pulse" aria-hidden="true"></span>
    {{-- Universal Access Icon (SVG) --}}
    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 2.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5-1.5-.67-1.5-1.5.67-1.5 1.5-1.5zm5 5.5h-3.5v8h-1V14h-1v4h-1v-8H7V10h10v2z"/>
    </svg>
</button>

{{-- ======================== PANEL ======================== --}}
<div id="a11y-panel"
     class="a11y-panel"
     role="dialog"
     aria-label="Panel Pengaturan Aksesibilitas"
     aria-modal="false">

    {{-- Header --}}
    <div class="a11y-panel-header">
        <h3>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="white" aria-hidden="true">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 2.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5-1.5-.67-1.5-1.5.67-1.5 1.5-1.5zm5 5.5h-3.5v8h-1V14h-1v4h-1v-8H7V10h10v2z"/>
            </svg>
            Aksesibilitas
        </h3>
        <p>Sesuaikan tampilan untuk kenyamanan Anda</p>
        <button class="a11y-panel-close" aria-label="Tutup panel aksesibilitas">&times;</button>
    </div>

    {{-- Body --}}
    <div class="a11y-panel-body">

        {{-- ===== SECTION: Text-to-Speech ===== --}}
        <div class="a11y-section">
            <div class="a11y-section-title">Pembacaan Suara</div>

            <button id="a11y-btn-tts" class="a11y-btn" type="button" aria-pressed="false" role="switch">
                <span class="a11y-btn-icon" aria-hidden="true">🔊</span>
                <span class="a11y-btn-label">
                    <span class="a11y-btn-name">Text-to-Speech</span>
                    <span class="a11y-btn-desc">Bacakan teks saat hover/fokus</span>
                </span>
                <span class="a11y-btn-status">OFF</span>
            </button>

            <div class="a11y-select-wrapper">
                <select id="a11y-tts-lang" class="a11y-select" aria-label="Pilih bahasa pembacaan suara">
                    <option value="id-ID">🇮🇩 Bahasa Indonesia</option>
                    <option value="en-US">🇬🇧 English</option>
                </select>
            </div>
        </div>

        {{-- ===== SECTION: Ukuran Font ===== --}}
        <div class="a11y-section">
            <div class="a11y-section-title">Ukuran Teks</div>

            <div class="a11y-font-controls">
                <span class="a11y-font-icon" aria-hidden="true">🔤</span>
                <button id="a11y-font-decrease"
                        class="a11y-font-btn"
                        type="button"
                        aria-label="Perkecil ukuran teks">
                    A−
                </button>
                <span id="a11y-font-label" class="a11y-font-label" aria-live="polite">100%</span>
                <button id="a11y-font-increase"
                        class="a11y-font-btn"
                        type="button"
                        aria-label="Perbesar ukuran teks">
                    A+
                </button>
            </div>
        </div>

        {{-- ===== SECTION: Tampilan ===== --}}
        <div class="a11y-section">
            <div class="a11y-section-title">Tampilan</div>

            <button id="a11y-btn-contrast" class="a11y-btn" type="button" aria-pressed="false" role="switch">
                <span class="a11y-btn-icon" aria-hidden="true">🎨</span>
                <span class="a11y-btn-label">
                    <span class="a11y-btn-name">Kontras Tinggi</span>
                    <span class="a11y-btn-desc">Latar gelap, teks terang</span>
                </span>
                <span class="a11y-btn-status">OFF</span>
            </button>

            <button id="a11y-btn-grayscale" class="a11y-btn" type="button" aria-pressed="false" role="switch">
                <span class="a11y-btn-icon" aria-hidden="true">👁️</span>
                <span class="a11y-btn-label">
                    <span class="a11y-btn-name">Grayscale</span>
                    <span class="a11y-btn-desc">Mode hitam-putih (buta warna)</span>
                </span>
                <span class="a11y-btn-status">OFF</span>
            </button>
        </div>

        {{-- ===== SECTION: Navigasi ===== --}}
        <div class="a11y-section">
            <div class="a11y-section-title">Bantuan Navigasi</div>

            <button id="a11y-btn-guide" class="a11y-btn" type="button" aria-pressed="false" role="switch">
                <span class="a11y-btn-icon" aria-hidden="true">📏</span>
                <span class="a11y-btn-label">
                    <span class="a11y-btn-name">Penggaris Baca</span>
                    <span class="a11y-btn-desc">Garis horizontal mengikuti kursor</span>
                </span>
                <span class="a11y-btn-status">OFF</span>
            </button>

            <button id="a11y-btn-links" class="a11y-btn" type="button" aria-pressed="false" role="switch">
                <span class="a11y-btn-icon" aria-hidden="true">🔗</span>
                <span class="a11y-btn-label">
                    <span class="a11y-btn-name">Sorot Semua Link</span>
                    <span class="a11y-btn-desc">Tandai semua tautan di halaman</span>
                </span>
                <span class="a11y-btn-status">OFF</span>
            </button>
        </div>

        {{-- ===== SECTION: Terjemahan ===== --}}
        <div class="a11y-section">
            <div class="a11y-section-title">Terjemahan Halaman</div>

            <div style="display: flex; align-items: center; gap: 10px; padding: 10px 14px; border: 1.5px solid #e8eaed; border-radius: 14px; background: white; margin-bottom: 8px;">
                <span style="font-size: 18px; flex-shrink: 0;" aria-hidden="true">🌐</span>
                <div style="flex: 1; min-width: 0;">
                    <select id="a11y-panel-lang" class="a11y-select"
                            aria-label="Pilih bahasa terjemahan halaman"
                            onchange="a11yChangeLanguage(this.value)">
                        <option value="">Pilih Bahasa...</option>
                        <option value="id">🇮🇩 Bahasa Indonesia</option>
                        <option value="en">🇬🇧 English</option>
                        <option value="ar">🇸🇦 العربية</option>
                        <option value="zh-CN">🇨🇳 中文</option>
                        <option value="ja">🇯🇵 日本語</option>
                        <option value="ko">🇰🇷 한국어</option>
                        <option value="ms">🇲🇾 Bahasa Melayu</option>
                        <option value="th">🇹🇭 ไทย</option>
                        <option value="vi">🇻🇳 Tiếng Việt</option>
                        <option value="fr">🇫🇷 Français</option>
                        <option value="de">🇩🇪 Deutsch</option>
                        <option value="es">🇪🇸 Español</option>
                        <option value="pt">🇵🇹 Português</option>
                        <option value="ru">🇷🇺 Русский</option>
                        <option value="hi">🇮🇳 हिन्दी</option>
                        <option value="nl">🇳🇱 Nederlands</option>
                        <option value="it">🇮🇹 Italiano</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- ===== RESET ===== --}}
        <button id="a11y-reset" class="a11y-reset-btn" type="button" aria-label="Reset semua pengaturan aksesibilitas">
            🔄 Reset Semua Pengaturan
        </button>

    </div>{{-- /.a11y-panel-body --}}
</div>{{-- /.a11y-panel --}}

{{-- Reading guide element (rendered by JS, backup placeholder) --}}
<div id="a11y-reading-guide" class="a11y-reading-guide" aria-hidden="true"></div>
