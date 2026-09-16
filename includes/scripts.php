<!-- ═══════════════════════════════════════════════════ SCRIPTS -->
<script src="/assets/js/main.js" defer></script>

<?php 
$gtm_id = !empty($s['gtm_id']) ? $s['gtm_id'] : '';
$ga_id  = !empty($s['ga_measurement_id']) ? $s['ga_measurement_id'] : '';
if ($gtm_id || $ga_id): ?>
<script>
(function() {
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  window.gtag = gtag;

  var analyticsLoaded = false;
  function loadAnalytics() {
    if (analyticsLoaded) return;
    analyticsLoaded = true;

    <?php if ($gtm_id): ?>
    (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','<?= e($gtm_id) ?>');
    <?php endif; ?>

    <?php if ($ga_id && empty($gtm_id)): ?>
    var s = document.createElement('script');
    s.async = true;
    s.src = 'https://www.googletagmanager.com/gtag/js?id=<?= e($ga_id) ?>';
    document.head.appendChild(s);
    gtag('js', new Date());
    gtag('config', '<?= e($ga_id) ?>');
    <?php endif; ?>
  }

  var events = ['scroll', 'touchstart', 'mousemove', 'click', 'keydown'];
  function onInteraction() {
    loadAnalytics();
    events.forEach(function(e) { window.removeEventListener(e, onInteraction, { passive: true }); });
  }
  events.forEach(function(e) {
    window.addEventListener(e, onInteraction, { passive: true, once: true });
  });

  if ('requestIdleCallback' in window) {
    requestIdleCallback(function() { setTimeout(loadAnalytics, 2500); });
  } else {
    setTimeout(loadAnalytics, 3500);
  }
})();
</script>
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
<link rel="stylesheet" href="/assets/css/ai-chat.css" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" href="/assets/css/ai-chat.css"></noscript>
<script>window.wtcWA = '<?= e(get_setting("wa_number","6281235036420")) ?>';</script>
<script src="/assets/js/ai-chat.js" defer></script>

