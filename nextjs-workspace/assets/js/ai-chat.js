/**
 * ai-chat.js — AI Training Finder Widget
 * Wahana Totalita Konsultan
 * Separate file — loaded via <script> in footer
 * No dependencies — vanilla JS only
 */

(function () {
  'use strict';

  // ── Config ──────────────────────────────────────────────────────────────
  var ENDPOINT = '/api/ai-chat.php';
  var SUGGESTIONS = [
    'Saya butuh sertifikat K3 untuk kerja',
    'Ahli K3 Umum BNSP berapa harganya?',
    'Pelatihan untuk operator forklift',
    'K3 konstruksi Yogyakarta',
    'Cara perpanjang sertifikat K3',
    'Pelatihan lingkungan hidup BNSP',
  ];
  var GREETING = 'Halo! 👋 Saya asisten AI Wahana Totalita. Ceritakan kebutuhan pelatihan K3 Anda — saya akan rekomendasikan program yang paling tepat untuk Anda.';

  var history   = [];
  var isOpen    = false;
  var isLoading = false;

  // ── Build DOM ────────────────────────────────────────────────────────────
  function buildWidget() {
    // Button
    var btn = el('button', { className: 'wtc-btn', 'aria-label': 'Buka Pencari Program K3' });
    btn.innerHTML = '<span class="wtc-btn-label">Cari Program K3</span>'
      + '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">'
      + '<circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35M11 8v6M8 11h6"/></svg>';
    btn.onclick = toggleChat;

    // Window
    var win = el('div', { className: 'wtc-window', id: 'wtcWindow', role: 'dialog', 'aria-label': 'Pencari Program Pelatihan K3' });

    // Header
    var header = el('div', { className: 'wtc-header' });
    header.innerHTML = '<div class="wtc-header-avatar">🤖</div>'
      + '<div class="wtc-header-info">'
      + '<div class="wtc-header-name">Asisten K3 Wahana</div>'
      + '<div class="wtc-header-status"><span class="wtc-online-dot"></span>AI Aktif 24 Jam</div>'
      + '</div>'
      + '<button class="wtc-close" onclick="window.wtcClose()" aria-label="Tutup">&times;</button>';

    // Messages area
    var msgs = el('div', { className: 'wtc-messages', id: 'wtcMessages' });

    // Suggestions
    var sugg = el('div', { className: 'wtc-suggestions', id: 'wtcSugg' });
    SUGGESTIONS.forEach(function (s) {
      var b = el('button', { className: 'wtc-suggestion' });
      b.textContent = s;
      b.onclick = function () { sendMessage(s); };
      sugg.appendChild(b);
    });

    // Input
    var inputArea = el('div', { className: 'wtc-input-area' });
    var textarea  = el('textarea', {
      className: 'wtc-input', id: 'wtcInput',
      placeholder: 'Tanyakan program pelatihan K3...',
      rows: 1,
      'aria-label': 'Pesan ke asisten K3'
    });
    textarea.addEventListener('input', autoResize);
    textarea.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); doSend(); }
    });

    var sendBtn = el('button', { className: 'wtc-send', id: 'wtcSend', 'aria-label': 'Kirim', disabled: true });
    sendBtn.innerHTML = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>';
    sendBtn.onclick = doSend;
    textarea.addEventListener('input', function () {
      sendBtn.disabled = !this.value.trim();
    });

    inputArea.appendChild(textarea);
    inputArea.appendChild(sendBtn);
    win.appendChild(header);
    win.appendChild(msgs);
    win.appendChild(sugg);
    win.appendChild(inputArea);

    document.body.appendChild(btn);
    document.body.appendChild(win);

    // Show greeting
    addBotMessage(GREETING, [], null);
  }

  // ── Toggle ───────────────────────────────────────────────────────────────
  function toggleChat() {
    isOpen = !isOpen;
    var win = document.getElementById('wtcWindow');
    win.classList.toggle('open', isOpen);
    if (isOpen) {
      setTimeout(function () { document.getElementById('wtcInput').focus(); }, 200);
    }
  }
  window.wtcClose = function () { isOpen = false; document.getElementById('wtcWindow').classList.remove('open'); };
  // Open the chat — used by the mobile search bar in the navbar
  window.wtcOpen = function () {
    var win = document.getElementById('wtcWindow');
    if (!win) return;
    isOpen = true;
    win.classList.add('open');
    setTimeout(function () { var i = document.getElementById('wtcInput'); if (i) i.focus(); }, 200);
  };

  // ── Send ─────────────────────────────────────────────────────────────────
  function doSend() {
    var input = document.getElementById('wtcInput');
    var msg   = (input.value || '').trim();
    if (!msg || isLoading) return;
    sendMessage(msg);
    input.value = '';
    input.style.height = '';
    document.getElementById('wtcSend').disabled = true;
  }

  function sendMessage(msg) {
    if (!isOpen) { isOpen = true; document.getElementById('wtcWindow').classList.add('open'); }
    // Hide suggestions after first message
    var sugg = document.getElementById('wtcSugg');
    if (sugg) sugg.style.display = 'none';

    addUserMessage(msg);
    history.push({ role: 'user', content: msg });
    showTyping();
    isLoading = true;

    fetch(ENDPOINT, {
      method:  'POST',
      headers: { 'Content-Type': 'application/json' },
      body:    JSON.stringify({ message: msg, history: history.slice(-6) }),
    })
      .then(function (r) { return r.json(); })
      .then(function (data) {
        hideTyping();
        isLoading = false;
        if (data.error) {
          addBotMessage('Maaf, ada gangguan. Silakan coba lagi.', [], null);
          return;
        }
        addBotMessage(data.reply || '', data.programs || [], data.show_wa ? data.wa_url : null);
        history.push({ role: 'assistant', content: data.reply || '' });
      })
      .catch(function () {
        hideTyping();
        isLoading = false;
        addBotMessage('Koneksi bermasalah. Silakan hubungi kami via WhatsApp.', [],
          'https://wa.me/' + (window.wtcWA || '6287759151278'));
      });
  }

  // ── Message Renderers ────────────────────────────────────────────────────
  function addUserMessage(text) {
    var msgs = document.getElementById('wtcMessages');
    var row  = el('div', { className: 'wtc-msg user' });
    var bub  = el('div', { className: 'wtc-bubble' });
    bub.textContent = text;
    row.appendChild(bub);
    msgs.appendChild(row);
    scrollBottom();
  }

  function addBotMessage(text, programs, wa_url) {
    var msgs = document.getElementById('wtcMessages');
    var row  = el('div', { className: 'wtc-msg bot' });
    var avatar = el('div', { className: 'wtc-msg-avatar' });
    avatar.textContent = '🤖';
    var bub  = el('div', { className: 'wtc-bubble' });

    // Text (convert **bold** and newlines)
    var formatted = text
      .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
      .replace(/\n/g, '<br>');
    bub.innerHTML = '<div>' + formatted + '</div>';

    // Program cards
    if (programs && programs.length) {
      var cards = el('div', { className: 'wtc-programs' });
      programs.forEach(function (p) {
        if (!p.slug) return;
        var card = el('a', { className: 'wtc-program-card', href: p.url || ('/pelatihan/' + p.slug + '/') });
        var price_str = p.price ? 'Rp ' + Number(p.price).toLocaleString('id-ID') : '';
        card.innerHTML = '<div class="wtc-prog-name">' + esc(p.name) + ' <span class="wtc-prog-arrow">→</span></div>'
          + '<div class="wtc-prog-meta">'
          + (price_str ? '<span class="wtc-prog-price">' + esc(price_str) + '/orang</span>' : '')
          + (p.cert   ? '<span class="wtc-prog-cert">' + esc(p.cert) + '</span>' : '')
          + '</div>';
        cards.appendChild(card);
      });
      bub.appendChild(cards);
    }

    // WA button
    if (wa_url) {
      var wa = el('a', { className: 'wtc-wa-btn', href: wa_url, target: '_blank', rel: 'noopener' });
      wa.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>'
        + ' Daftar via WhatsApp';
      bub.appendChild(wa);
    }

    row.appendChild(avatar);
    row.appendChild(bub);
    msgs.appendChild(row);
    scrollBottom();
  }

  // ── Typing indicator ─────────────────────────────────────────────────────
  function showTyping() {
    var msgs = document.getElementById('wtcMessages');
    var row  = el('div', { className: 'wtc-msg bot', id: 'wtcTyping' });
    var av   = el('div', { className: 'wtc-msg-avatar' }); av.textContent = '🤖';
    var bub  = el('div', { className: 'wtc-bubble' });
    bub.innerHTML = '<div class="wtc-typing"><span></span><span></span><span></span></div>';
    row.appendChild(av); row.appendChild(bub);
    msgs.appendChild(row);
    scrollBottom();
  }
  function hideTyping() {
    var t = document.getElementById('wtcTyping');
    if (t) t.remove();
  }

  // ── Helpers ───────────────────────────────────────────────────────────────
  function el(tag, attrs) {
    var e = document.createElement(tag);
    Object.keys(attrs || {}).forEach(function (k) {
      if (k === 'className') e.className = attrs[k];
      else e.setAttribute(k, attrs[k]);
    });
    return e;
  }
  function esc(s) {
    return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
  }
  function scrollBottom() {
    var msgs = document.getElementById('wtcMessages');
    if (msgs) setTimeout(function () { msgs.scrollTop = msgs.scrollHeight; }, 50);
  }
  function autoResize() {
    this.style.height = 'auto';
    this.style.height = Math.min(this.scrollHeight, 80) + 'px';
  }

  // ── Init ──────────────────────────────────────────────────────────────────
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', buildWidget);
  } else {
    buildWidget();
  }

})();
