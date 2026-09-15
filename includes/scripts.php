<!-- ═══════════════════════════════════════════════════ SCRIPTS -->
<script src="/assets/js/main.js"></script>

<?php if (!empty($s['ga_measurement_id'])): ?>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?= e($s['ga_measurement_id']) ?>"></script>
<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','<?= e($s['ga_measurement_id']) ?>');</script>
<?php endif; ?>

<!-- ── Cookie / Privacy Notice (UU PDP No. 27/2022) ── -->
<div id="cookie-notice" role="region" aria-label="Pemberitahuan Privasi" aria-live="polite">
  <p>
    Kami menggunakan cookie dan data analitik untuk meningkatkan pengalaman Anda,
    sesuai <strong>UU Perlindungan Data Pribadi (UU No. 27 Tahun 2022)</strong>.
    Data hanya digunakan untuk keperluan internal dan tidak dijual kepada pihak ketiga.
    Dengan melanjutkan, Anda menyetujui penggunaan cookie ini.
  </p>
  <button class="cookie-btn" id="cookie-accept" aria-label="Tutup pemberitahuan privasi">Mengerti</button>
</div>

<script>
(function () {
  // ── Email obfuscation ──────────────────────────────────────────────
  var el = document.getElementById('email-kontak');
  if (el) {
    var rev = function(s) { return s.split('').reverse().join(''); };
    var u = 'ofni', d = 'moc.atilatotanahaw', sep = String.fromCharCode(64);
    var addr = rev(u) + sep + rev(d);
    var link = document.createElement('a');
    link.href = 'mailto:' + addr;
    link.textContent = '\u2709\ufe0f ' + addr;
    el.appendChild(link);
  }
  // ── Cookie notice ──────────────────────────────────────────────────
  var notice = document.getElementById('cookie-notice');
  if (localStorage.getItem('wtk_cookie_ok')) notice.classList.add('hidden');
  document.getElementById('cookie-accept').addEventListener('click', function () {
    localStorage.setItem('wtk_cookie_ok', '1');
    notice.classList.add('hidden');
  });
  // ── Mobile chip sync with filter ──────────────────────────────────
  document.querySelectorAll('.mobile-chip').forEach(function(chip) {
    chip.addEventListener('click', function() {
      document.querySelectorAll('.mobile-chip').forEach(function(c) {
        c.classList.remove('active');
      });
      this.classList.add('active');
      // Scroll to catalog section
      var catalog = document.getElementById('produk');
      if (catalog) {
        setTimeout(function() {
          catalog.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 100);
      }
    });
  });

  // ── Mobile bottom nav active state ─────────────────────────────────
  var mbnItems = document.querySelectorAll('.mbn-item');
  mbnItems.forEach(function(item) {
    item.addEventListener('click', function() {
      mbnItems.forEach(function(i) { i.classList.remove('active'); });
      this.classList.add('active');
    });
  });

  // ── Hero slideshow ─────────────────────────────────────────────────
  var slides = document.querySelectorAll('.hero-slide');
  var dots   = document.querySelectorAll('.hero-dot');
  var cur    = 0;
  if (slides.length) {
    function heroGoTo(n) {
      slides[cur].classList.remove('active');
      dots[cur].classList.remove('active');
      cur = (n + slides.length) % slides.length;
      slides[cur].classList.add('active');
      dots[cur].classList.add('active');
    }
    var slideTimer = setInterval(function() { heroGoTo(cur + 1); }, 5500);
    dots.forEach(function(dot) {
      dot.addEventListener('click', function() {
        clearInterval(slideTimer);
        heroGoTo(parseInt(this.dataset.slide));
        slideTimer = setInterval(function() { heroGoTo(cur + 1); }, 5500);
      });
    });
    // Swipe support
    var heroEl = document.querySelector('.hero');
    var touchStartX = 0;
    heroEl.addEventListener('touchstart', function(e) { touchStartX = e.touches[0].clientX; }, {passive:true});
    heroEl.addEventListener('touchend',   function(e) {
      var dx = e.changedTouches[0].clientX - touchStartX;
      if (Math.abs(dx) > 50) {
        clearInterval(slideTimer);
        heroGoTo(cur + (dx < 0 ? 1 : -1));
        slideTimer = setInterval(function() { heroGoTo(cur + 1); }, 5500);
      }
    }, {passive:true});
  }
})();
</script>

<!-- AI Training Finder Chat Widget -->
<link rel="stylesheet" href="/assets/css/ai-chat.css">
<!-- Catalog: show 12 first, reveal rest on demand (filters/search auto-reveal) -->
<script>
(function(){
  var grid=document.getElementById('training-grid'); if(!grid) return;
  var cards=[].slice.call(grid.querySelectorAll('.training-card'));
  var LIMIT=12; if(cards.length<=LIMIT) return;
  cards.slice(LIMIT).forEach(function(c){c.classList.add('tc-hidden');});
  var btn=document.createElement('button');
  btn.className='btn-load-more'; btn.type='button';
  btn.textContent='Lihat Semua '+cards.length+' Program ↓';
  grid.parentNode.insertBefore(btn, grid.nextSibling);
  function reveal(){cards.forEach(function(c){c.classList.remove('tc-hidden');}); if(btn.parentNode) btn.remove();}
  btn.addEventListener('click', reveal);
  document.querySelectorAll('.filter-btn,.filter-mode,.mobile-chip').forEach(function(el){el.addEventListener('click', reveal, {once:true});});
  var s=document.getElementById('catalog-search'); if(s) s.addEventListener('input', reveal, {once:true});
})();
</script>
<script>window.wtcWA = '<?= e(get_setting("wa_number","6281235036420")) ?>';</script>
<script src="/assets/js/ai-chat.js" defer></script>

