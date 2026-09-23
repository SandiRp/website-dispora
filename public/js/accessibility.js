/**
 * =========================================================
 *  ACCESSIBILITY ENGINE — Dispora Jawa Timur
 *  Text-to-Speech, Font Resize, High Contrast, Reading Guide,
 *  Link Highlighting, Grayscale, localStorage persistence
 * =========================================================
 */
(function () {
    'use strict';

    /* ---- Constants ---- */
    var STORAGE_KEY = 'dispora_a11y_prefs';
    var DEBOUNCE_MS = 350;
    var FONT_STEP   = 10;
    var FONT_MIN    = 70;
    var FONT_MAX    = 200;

    /* Default preferences */
    var DEFAULTS = {
        ttsEnabled     : false,
        ttsLang        : 'id-ID',
        fontSize       : 100,
        highContrast   : false,
        readingGuide   : false,
        highlightLinks : false,
        grayscale      : false
    };

    /* Selectors whose text should be read by TTS */
    var TTS_SELECTORS = 'h1,h2,h3,h4,h5,h6,p,a,button,li,td,th,label,figcaption,blockquote,summary,caption,[alt]';

    /* ---- State ---- */
    var prefs       = loadPrefs();
    var ttsTimer    = null;
    var guideEl     = null;
    var panelOpen   = false;
    var lastSpoken  = null;  // avoid repeating same text

    /* ================================================================
       STORAGE
       ================================================================ */
    function loadPrefs() {
        try {
            var raw = localStorage.getItem(STORAGE_KEY);
            if (raw) {
                var saved = JSON.parse(raw);
                var merged = {};
                for (var k in DEFAULTS) {
                    if (DEFAULTS.hasOwnProperty(k)) {
                        merged[k] = saved.hasOwnProperty(k) ? saved[k] : DEFAULTS[k];
                    }
                }
                return merged;
            }
        } catch (_) { /* ignore */ }
        return copyObj(DEFAULTS);
    }

    function savePrefs() {
        try { localStorage.setItem(STORAGE_KEY, JSON.stringify(prefs)); }
        catch (_) { /* quota exceeded, etc. */ }
    }

    function copyObj(o) {
        var c = {};
        for (var k in o) { if (o.hasOwnProperty(k)) c[k] = o[k]; }
        return c;
    }

    /* ================================================================
       INIT
       ================================================================ */
    document.addEventListener('DOMContentLoaded', init);

    function init() {
        createReadingGuide();
        applyAll();
        bindUI();
        bindTTS();
    }

    /* ================================================================
       APPLY ALL SETTINGS
       ================================================================ */
    function applyAll() {
        /* Font size */
        document.documentElement.style.fontSize = prefs.fontSize + '%';
        setLabel('a11y-font-label', prefs.fontSize + '%');

        /* Body classes */
        toggleClass(document.body, 'a11y-high-contrast', prefs.highContrast);
        toggleClass(document.body, 'a11y-highlight-links', prefs.highlightLinks);
        toggleClass(document.body, 'a11y-grayscale', prefs.grayscale);

        /* Reading guide */
        if (guideEl) toggleClass(guideEl, 'active', prefs.readingGuide);

        /* Button active states */
        setBtnActive('a11y-btn-tts',      prefs.ttsEnabled);
        setBtnActive('a11y-btn-contrast',  prefs.highContrast);
        setBtnActive('a11y-btn-guide',     prefs.readingGuide);
        setBtnActive('a11y-btn-links',     prefs.highlightLinks);
        setBtnActive('a11y-btn-grayscale', prefs.grayscale);

        /* TTS language dropdown */
        var langSel = byId('a11y-tts-lang');
        if (langSel) langSel.value = prefs.ttsLang;
    }

    /* ================================================================
       UI EVENT BINDINGS
       ================================================================ */
    function bindUI() {
        var fab   = byId('a11y-fab');
        var panel = byId('a11y-panel');

        /* Panel open / close */
        if (fab && panel) {
            fab.addEventListener('click', function (e) {
                e.stopPropagation();
                panelOpen = !panelOpen;
                toggleClass(panel, 'open', panelOpen);
                fab.setAttribute('aria-expanded', panelOpen ? 'true' : 'false');
            });

            /* Close button inside panel */
            var closeBtn = panel.querySelector('.a11y-panel-close');
            if (closeBtn) {
                closeBtn.addEventListener('click', function () {
                    panelOpen = false;
                    panel.classList.remove('open');
                    fab.setAttribute('aria-expanded', 'false');
                    fab.focus();
                });
            }

            /* Click outside to close */
            document.addEventListener('click', function (e) {
                if (panelOpen && !panel.contains(e.target) && !fab.contains(e.target)) {
                    panelOpen = false;
                    panel.classList.remove('open');
                    fab.setAttribute('aria-expanded', 'false');
                }
            });

            /* Escape to close */
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && panelOpen) {
                    panelOpen = false;
                    panel.classList.remove('open');
                    fab.setAttribute('aria-expanded', 'false');
                    fab.focus();
                }
            });
        }

        /* ---- Toggle Buttons ---- */

        /* TTS on/off */
        onClick('a11y-btn-tts', function () {
            prefs.ttsEnabled = !prefs.ttsEnabled;
            if (!prefs.ttsEnabled) cancelTTS();
            setBtnActive('a11y-btn-tts', prefs.ttsEnabled);
            savePrefs();
            /* Announce status */
            if (prefs.ttsEnabled) {
                speak(prefs.ttsLang === 'id-ID' ? 'Pembacaan suara diaktifkan' : 'Text to speech enabled');
            }
        });

        /* TTS language */
        var langSel = byId('a11y-tts-lang');
        if (langSel) {
            langSel.addEventListener('change', function () {
                prefs.ttsLang = this.value;
                savePrefs();
                if (prefs.ttsEnabled) {
                    speak(prefs.ttsLang === 'id-ID' ? 'Bahasa Indonesia dipilih' : 'English selected');
                }
            });
        }

        /* Font controls */
        onClick('a11y-font-increase', function () {
            if (prefs.fontSize < FONT_MAX) {
                prefs.fontSize += FONT_STEP;
                document.documentElement.style.fontSize = prefs.fontSize + '%';
                setLabel('a11y-font-label', prefs.fontSize + '%');
                savePrefs();
            }
        });
        onClick('a11y-font-decrease', function () {
            if (prefs.fontSize > FONT_MIN) {
                prefs.fontSize -= FONT_STEP;
                document.documentElement.style.fontSize = prefs.fontSize + '%';
                setLabel('a11y-font-label', prefs.fontSize + '%');
                savePrefs();
            }
        });

        /* High Contrast */
        onClick('a11y-btn-contrast', function () {
            prefs.highContrast = !prefs.highContrast;
            toggleClass(document.body, 'a11y-high-contrast', prefs.highContrast);
            setBtnActive('a11y-btn-contrast', prefs.highContrast);
            savePrefs();
        });

        /* Reading Guide */
        onClick('a11y-btn-guide', function () {
            prefs.readingGuide = !prefs.readingGuide;
            if (guideEl) toggleClass(guideEl, 'active', prefs.readingGuide);
            setBtnActive('a11y-btn-guide', prefs.readingGuide);
            savePrefs();
        });

        /* Link Highlighting */
        onClick('a11y-btn-links', function () {
            prefs.highlightLinks = !prefs.highlightLinks;
            toggleClass(document.body, 'a11y-highlight-links', prefs.highlightLinks);
            setBtnActive('a11y-btn-links', prefs.highlightLinks);
            savePrefs();
        });

        /* Grayscale */
        onClick('a11y-btn-grayscale', function () {
            prefs.grayscale = !prefs.grayscale;
            toggleClass(document.body, 'a11y-grayscale', prefs.grayscale);
            setBtnActive('a11y-btn-grayscale', prefs.grayscale);
            savePrefs();
        });

        /* Reset All */
        onClick('a11y-reset', function () {
            cancelTTS();
            prefs = copyObj(DEFAULTS);
            savePrefs();
            document.documentElement.style.fontSize = '100%';
            applyAll();
        });

        /* Reading guide mouse tracking */
        document.addEventListener('mousemove', function (e) {
            if (prefs.readingGuide && guideEl) {
                guideEl.style.top = e.clientY + 'px';
            }
        });
    }

    /* ================================================================
       TEXT-TO-SPEECH (Web Speech API)
       ================================================================ */
    function bindTTS() {
        if (!('speechSynthesis' in window)) return;

        /* Event delegation — hover */
        document.body.addEventListener('mouseover', function (e) {
            if (!prefs.ttsEnabled) return;
            var target = findTTSTarget(e.target);
            if (!target) return;
            scheduleTTS(target);
        });

        document.body.addEventListener('mouseout', function (e) {
            if (!prefs.ttsEnabled) return;
            clearTTSHighlight();
            clearTimeout(ttsTimer);
            cancelTTS();
            lastSpoken = null;
        });

        /* Event delegation — keyboard focus */
        document.body.addEventListener('focusin', function (e) {
            if (!prefs.ttsEnabled) return;
            var target = findTTSTarget(e.target);
            if (!target) return;
            scheduleTTS(target);
        });

        document.body.addEventListener('focusout', function () {
            if (!prefs.ttsEnabled) return;
            clearTTSHighlight();
            clearTimeout(ttsTimer);
            cancelTTS();
            lastSpoken = null;
        });
    }

    function findTTSTarget(el) {
        if (!el || !el.closest) return null;
        var target = el.closest(TTS_SELECTORS);
        if (!target) return null;
        /* Exclude the a11y widget itself */
        if (target.closest('#a11y-panel') || target.closest('#a11y-fab')) return null;
        /* Exclude the Google Translate widget */
        if (target.closest('.skiptranslate') || target.closest('#google_translate_element') || target.closest('#a11y-translate-nav')) return null;
        return target;
    }

    function scheduleTTS(target) {
        clearTimeout(ttsTimer);
        ttsTimer = setTimeout(function () {
            var text = extractText(target);
            if (text && text !== lastSpoken) {
                lastSpoken = text;
                setTTSHighlight(target);
                speak(text);
            }
        }, DEBOUNCE_MS);
    }

    function extractText(el) {
        /* Prefer alt text for images */
        var alt = el.getAttribute('alt');
        if (alt && alt.trim()) return alt.trim();
        /* aria-label */
        var ariaLabel = el.getAttribute('aria-label');
        if (ariaLabel && ariaLabel.trim()) return ariaLabel.trim();
        /* innerText (rendered text only) */
        var txt = (el.innerText || el.textContent || '').trim();
        /* Limit length to prevent very long readings */
        if (txt.length > 400) txt = txt.substring(0, 400);
        return txt || '';
    }

    function speak(text) {
        if (!text) return;
        window.speechSynthesis.cancel();
        var utter = new SpeechSynthesisUtterance(text);
        utter.lang   = prefs.ttsLang;
        utter.rate   = 1.0;
        utter.pitch  = 1.0;
        utter.volume = 1.0;

        /* Try to find a matching voice for the language */
        var voices = window.speechSynthesis.getVoices();
        for (var i = 0; i < voices.length; i++) {
            if (voices[i].lang === prefs.ttsLang || voices[i].lang.indexOf(prefs.ttsLang.split('-')[0]) === 0) {
                utter.voice = voices[i];
                break;
            }
        }

        utter.onend = function () { clearTTSHighlight(); };
        utter.onerror = function () { clearTTSHighlight(); };
        window.speechSynthesis.speak(utter);
    }

    function cancelTTS() {
        if ('speechSynthesis' in window) window.speechSynthesis.cancel();
    }

    /* Visual highlight while TTS is speaking */
    var currentHighlight = null;
    function setTTSHighlight(el) {
        clearTTSHighlight();
        if (el) {
            el.classList.add('a11y-tts-speaking');
            currentHighlight = el;
        }
    }
    function clearTTSHighlight() {
        if (currentHighlight) {
            currentHighlight.classList.remove('a11y-tts-speaking');
            currentHighlight = null;
        }
    }

    /* ================================================================
       READING GUIDE
       ================================================================ */
    function createReadingGuide() {
        guideEl = byId('a11y-reading-guide');
        if (!guideEl) {
            guideEl = document.createElement('div');
            guideEl.id = 'a11y-reading-guide';
            guideEl.className = 'a11y-reading-guide';
            guideEl.setAttribute('aria-hidden', 'true');
            document.body.appendChild(guideEl);
        }
    }

    /* ================================================================
       HELPERS
       ================================================================ */
    function byId(id) { return document.getElementById(id); }

    function onClick(id, fn) {
        var el = byId(id);
        if (el) el.addEventListener('click', fn);
    }

    function setBtnActive(id, active) {
        var el = byId(id);
        if (!el) return;
        toggleClass(el, 'active', active);
        /* Update status badge text */
        var badge = el.querySelector('.a11y-btn-status');
        if (badge) badge.textContent = active ? 'ON' : 'OFF';
        /* Update aria-pressed */
        el.setAttribute('aria-pressed', active ? 'true' : 'false');
    }

    function setLabel(id, text) {
        var el = byId(id);
        if (el) el.textContent = text;
    }

    function toggleClass(el, cls, force) {
        if (force) el.classList.add(cls);
        else el.classList.remove(cls);
    }

    /* Load voices asynchronously (some browsers lazy-load) */
    if ('speechSynthesis' in window) {
        window.speechSynthesis.getVoices();
        if (window.speechSynthesis.onvoiceschanged !== undefined) {
            window.speechSynthesis.onvoiceschanged = function () {
                window.speechSynthesis.getVoices();
            };
        }
    }

})();
