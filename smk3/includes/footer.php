<?php /** FOOTER — persistent money links + identity. */ ?>
</main>
<footer class="site-footer">
  <div class="wrap footer-grid">
    <div class="footer-col footer-about">
      <img src="/assets/img/logo-light.svg" alt="<?= e($SITE['org_name']) ?>" width="180" height="40" loading="lazy">
      <p><?= e($SITE['site_name']) ?> adalah pusat panduan SMK3 (PP No. 50 Tahun 2012) yang dikelola oleh tim <?= e($SITE['org_name']) ?>, <?= e($SITE['org_city']) ?>.</p>
    </div>
    <div class="footer-col">
      <h2 class="footer-h">Layanan</h2>
      <ul>
        <?php foreach ($SITE['footer_money'] as $mk): ?>
        <li><a href="<?= e(page_url($mk)) ?>"><?= e($PAGES[$mk]['n'] === 1 ? 'Beranda' : $PAGES[$mk]['h1']) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div class="footer-col">
      <h2 class="footer-h">Topik Panduan</h2>
      <ul>
        <?php foreach ($SITE['hub_pages'] as $slug => $hubKey): ?>
        <li><a href="<?= e(page_url($hubKey)) ?>"><?= e($SITE['hub_names'][$slug]) ?></a></li>
        <?php endforeach; ?>
        <li><a href="<?= e(page_url('blog')) ?>">Blog & Update Regulasi</a></li>
        <li><a href="<?= e(page_url('tentang-kami')) ?>">Tentang Kami</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h2 class="footer-h">Kontak</h2>
      <ul class="footer-contact">
        <li>WhatsApp: <a href="<?= e(wa_url()) ?>" rel="noopener"><?= e($SITE['wa_display']) ?></a></li>
        <li>Email: <a href="mailto:<?= e($SITE['email']) ?>"><?= e($SITE['email']) ?></a></li>
        <li><?= e($SITE['org_city']) ?>, Indonesia</li>
      </ul>
    </div>
  </div>
  <div class="wrap footer-bottom">
    <p>&copy; <?= date('Y') ?> <?= e($SITE['org_name']) ?>. Konten bersifat edukasi dan bukan pengganti nasihat hukum; rujuk selalu teks resmi peraturan perundang-undangan.</p>
  </div>
</footer>
</body>
</html>
