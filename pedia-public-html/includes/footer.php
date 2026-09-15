<?php /** MEGA-FOOTER — regulasi + bahaya sets + platform links. On every page. */ ?>
</main>
<footer class="site-footer">
  <div class="wrap footer-grid">
    <div class="footer-col footer-about">
      <img src="/assets/img/logo-light.svg" alt="<?= e($SITE['site_name']) ?>" width="190" height="42" loading="lazy">
      <p><?= e($SITE['site_name']) ?> adalah pustaka pengetahuan K3, kesehatan kerja, dan lingkungan yang bersifat edukatif dan non-komersial, dikelola tim redaksi <?= e($SITE['org_name']) ?>, <?= e($SITE['org_city']) ?>.</p>
      <ul class="footer-contact">
        <li>Email redaksi: <a href="mailto:<?= e($SITE['email']) ?>"><?= e($SITE['email']) ?></a></li>
        <li><?= e($SITE['org_city']) ?>, Indonesia</li>
      </ul>
    </div>
    <div class="footer-col">
      <h2 class="footer-h">Regulasi K3</h2>
      <ul>
        <?php foreach ($SITE['footer_regulasi'] as $rk): ?>
        <li><a href="<?= e(page_url($rk)) ?>"><?= e($PAGES[$rk]['type'] === 'hub' ? 'Peta Regulasi K3' : preg_split('/\s*[:—]\s*/u', $PAGES[$rk]['title'])[0]) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div class="footer-col">
      <h2 class="footer-h">Bahaya &amp; Pengendalian</h2>
      <ul>
        <?php foreach ($SITE['footer_bahaya'] as $bk): ?>
        <li><a href="<?= e(page_url($bk)) ?>"><?= e($PAGES[$bk]['type'] === 'hub' ? 'Semua Jenis Bahaya' : preg_split('/\s*[:—]\s*/u', $PAGES[$bk]['title'])[0]) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div class="footer-col">
      <h2 class="footer-h">Tentang Situs Ini</h2>
      <ul>
        <?php foreach ($SITE['footer_platform'] as $pk): ?>
        <li><a href="<?= e(page_url($pk)) ?>"><?= e(preg_split('/\s*[:—&]\s*/u', $PAGES[$pk]['title'])[0]) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
  <div class="wrap footer-bottom">
    <p>&copy; <?= date('Y') ?> <?= e($SITE['org_name']) ?>. Seluruh konten bersifat edukasi dan bukan pengganti teks resmi peraturan perundang-undangan maupun nasihat hukum/medis. Situs terkait: <a href="<?= e($SITE['external']['smk3_home']) ?>">Panduan SMK3 Indonesia</a> · <a href="<?= e($SITE['external']['iso_home']) ?>">Panduan ISO 45001 Indonesia</a>.</p>
  </div>
</footer>
</body>
</html>
