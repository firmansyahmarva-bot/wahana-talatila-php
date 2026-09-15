<?php /** FOOTER — persistent nav, identity, and sitewide lead-capture (every page, no exceptions). */ ?>
</main>

<a class="wa-float" href="<?= e(wa_url($SITE['wa_prefill'])) ?>" rel="noopener" aria-label="Chat WhatsApp">
  <svg viewBox="0 0 32 32" width="28" height="28" aria-hidden="true"><path fill="currentColor" d="M16 2C8.3 2 2 8.3 2 16c0 2.7.7 5.2 2 7.4L2 30l6.8-1.8c2.1 1.2 4.6 1.8 7.2 1.8 7.7 0 14-6.3 14-14S23.7 2 16 2zm0 25.5c-2.3 0-4.5-.6-6.4-1.8l-.5-.3-4.3 1.1 1.1-4.2-.3-.5C4.4 20 3.8 18 3.8 16 3.8 9.3 9.3 3.8 16 3.8S28.2 9.3 28.2 16 22.7 27.5 16 27.5zm7.1-8.9c-.4-.2-2.3-1.1-2.6-1.3-.4-.1-.6-.2-.9.2-.3.4-1 1.3-1.2 1.5-.2.3-.4.3-.8.1-.4-.2-1.7-.6-3.2-2-1.2-1.1-2-2.4-2.2-2.8-.2-.4 0-.6.2-.8.2-.2.4-.4.6-.7.2-.2.3-.4.4-.6.1-.3 0-.5 0-.7-.1-.2-.9-2.1-1.2-2.9-.3-.7-.6-.6-.9-.6h-.7c-.2 0-.6.1-.9.4-.3.4-1.2 1.1-1.2 2.8s1.2 3.3 1.4 3.5c.2.3 2.4 3.7 5.9 5.1.8.4 1.5.6 2 .7.8.3 1.6.2 2.2.1.7-.1 2.1-.9 2.4-1.7.3-.8.3-1.5.2-1.7-.1-.1-.3-.2-.7-.4z"/></svg>
</a>

<div class="sticky-lead">
  <span><?= e($SITE['site_name']) ?> — <?= e($SITE['tagline']) ?></span>
  <a class="btn btn-wa" href="<?= e(wa_url($page['wa_prefill'] ?? $SITE['wa_prefill'])) ?>" rel="noopener">Chat WhatsApp</a>
</div>

<footer class="site-footer">
  <div class="wrap footer-grid">
    <div class="footer-col footer-about">
      <img src="/assets/img/logo-light.svg" alt="<?= e($SITE['org_name']) ?>" width="180" height="40" loading="lazy">
      <p><?= e($SITE['site_name']) ?> adalah panduan seputar profesi dan sertifikasi Ahli K3 Umum, disusun dan ditinjau oleh <?= e($SITE['author']['name']) ?>, <?= e($SITE['author']['title']) ?>, bersama tim <?= e($SITE['org_name']) ?>, <?= e($SITE['org_city']) ?>.</p>
    </div>
    <div class="footer-col">
      <h2 class="footer-h">Topik</h2>
      <ul>
        <?php foreach ($SITE['footer_pillars'] as $pk): ?>
        <li><a href="<?= e(page_url($pk)) ?>"><?= e($PAGES[$pk]['h1']) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div class="footer-col">
      <h2 class="footer-h">Referensi</h2>
      <ul>
        <li><a href="<?= e(page_url('f3')) ?>">Glosarium Istilah K3</a></li>
        <li><a href="<?= e(page_url('f4')) ?>">FAQ Ahli K3 Umum</a></li>
        <li><a href="<?= e(page_url('home')) ?>">Beranda</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h2 class="footer-h">Kontak</h2>
      <ul class="footer-contact">
        <li>WhatsApp: <a href="<?= e(wa_url($SITE['wa_prefill'])) ?>" rel="noopener"><?= e($SITE['wa_display']) ?></a></li>
        <li>Email: <a href="mailto:<?= e($SITE['email']) ?>"><?= e($SITE['email']) ?></a></li>
        <li><?= e($SITE['org_city']) ?>, Indonesia</li>
      </ul>
    </div>
  </div>
  <div class="wrap footer-bottom">
    <p>&copy; <?= date('Y') ?> <?= e($SITE['org_name']) ?>. Konten bersifat edukasi dan bukan pengganti nasihat hukum; rujuk selalu teks resmi peraturan perundang-undangan.</p>
  </div>
</footer>
<script>
(function(){
  var bar = document.getElementById('reading-progress');
  if (!bar) return;
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) bar.style.transition = 'none';
  var ticking = false;
  function update(){
    var h = document.documentElement;
    var max = h.scrollHeight - h.clientHeight;
    var pct = max > 0 ? Math.min(100, Math.max(0, (h.scrollTop / max) * 100)) : 0;
    bar.style.width = pct + '%';
    ticking = false;
  }
  document.addEventListener('scroll', function(){
    if (!ticking) { window.requestAnimationFrame(update); ticking = true; }
  }, { passive: true });
  update();
})();
</script>
</body>
</html>
