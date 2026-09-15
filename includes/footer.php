<!-- ═══════════════════════════════════════════════════ FOOTER -->
<footer class="footer">
  <div class="container footer-inner">
    <div class="footer-brand">
      <div class="footer-logo">
        <?= theme_logo_html($s) ?>
        <span><strong><?= e($s['site_name'] ?? 'Wahana Totalita Konsultan') ?></strong></span>
      </div>
      <p><?= e($s['site_tagline'] ?? '') ?></p>
      <div class="footer-socials">
        <?php if (!empty($s['instagram_url'])): ?>
        <a href="<?= e($s['instagram_url']) ?>" target="_blank" rel="noopener" aria-label="Instagram">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r=".5" fill="currentColor" stroke="none"/></svg>
        </a>
        <?php endif; ?>
        <?php if (!empty($s['facebook_url'])): ?>
        <a href="<?= e($s['facebook_url']) ?>" target="_blank" rel="noopener" aria-label="Facebook">
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
        </a>
        <?php endif; ?>
        <?php if (!empty($s['tiktok_url'])): ?>
        <a href="<?= e($s['tiktok_url']) ?>" target="_blank" rel="noopener" aria-label="TikTok">
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V8.69a8.18 8.18 0 0 0 4.78 1.52V6.75a4.84 4.84 0 0 1-1.01-.06z"/></svg>
        </a>
        <?php endif; ?>
        <?php if (!empty($s['youtube_url'])): ?>
        <a href="<?= e($s['youtube_url']) ?>" target="_blank" rel="noopener" aria-label="YouTube">
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 0 0 1.46 6.42 29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58 2.78 2.78 0 0 0 1.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.96-1.96A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75,15.02 15.5,12 9.75,8.98 9.75,15.02" fill="white"/></svg>
        </a>
        <?php endif; ?>
      </div>
    </div>

    <div class="footer-nav">
      <h4>Pelatihan K3</h4>
      <ul>
        <li><a href="/pelatihan/">🎓 Semua Pelatihan</a></li>
        <li><a href="/pelatihan/k3/">Pelatihan K3</a></li>
        <li><a href="/pelatihan/lingkungan/">Pelatihan Lingkungan</a></li>
        <li><a href="/pelatihan/system-management/">ISO &amp; System Management</a></li>
        <li><a href="/pelatihan/mining/">Pelatihan Pertambangan</a></li>
        <li><a href="/pelatihan/pelatihan-operator-k3-sertifikasi-bnsp/">Operator K3 (Sertifikasi BNSP)</a></li>
        <li><a href="/pelatihan/pelatihan-ahli-k3-umum-fresh-graduate-kemnaker-online/">Ahli K3 Umum Fresh Graduate</a></li>
        <li><a href="/pelatihan/tkbt-ii-surabaya/">TKBT II Surabaya</a></li>
        <li><a href="/pelatihan/pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri/">Operator Forklift Kelas II</a></li>
        <li><a href="/pelatihan/pelatihan-operator-pesawat-tenaga-produksi-ptp/">Operator Pesawat Tenaga Produksi (PTP)</a></li>
        <li><a href="/pelatihan/pelatihan-dan-sertifikasi-pipe-fitter-sertifikasi-bnsp/">Pipe Fitter BNSP</a></li>
        <li><a href="/pelatihan/perpanjangan-sertifikasi-bnsp-online/">Perpanjangan Sertifikasi BNSP</a></li>
      </ul>
    </div>

    <div class="footer-nav">
      <h4>Sertifikasi Populer</h4>
      <ul>
        <li><a href="/pelatihan/operator-forklift-kelas-2-semarang/">Forklift Kelas II Semarang</a></li>
        <li><a href="/pelatihan/ahli-k3-umum-balikpapan/">Ahli K3 Umum Balikpapan</a></li>
        <li><a href="/pelatihan/ak3-bnsp/">Ahli K3 BNSP</a></li>
        <li><a href="/pelatihan/pelatihan-dan-sertifikasi-welding-technologistsuperintendent-sertifikasi-bnsp/">Welding Technologist</a></li>
        <li><a href="/pelatihan/pelatihan-internal-auditor-iso-45001-online/">Internal Auditor ISO 45001</a></li>
        <li><a href="/pelatihan/pelatihan-petugas-p3k-first-aid-online/">Petugas P3K / First Aid</a></li>
        <li><a href="/pelatihan/pelatihan-damkar-paralel-kelas-dcba-sertifikasi-kemnaker-ri/">Damkar Kelas D–A</a></li>
        <li><a href="/pelatihan/pelatihan-dan-sertifikasi-fillet-plate-welder-sertifikasi-bnsp/">Fillet Plate Welder</a></li>
      </ul>
    </div>

    <div class="footer-nav">
      <h4>Jadwal &amp; Informasi</h4>
      <ul>
        <li><a href="/jadwal/">📅 Jadwal Pelatihan <?= date('Y') ?></a></li>
        <li><a href="/jadwal/kalender/">Kalender Pelatihan</a></li>
        <li><a href="/tools/safety-talk">Safety Talk</a></li>
        <li><a href="/layanan-pemerintah">Layanan Pemerintah</a></li>
        <li><a href="/perusahaan">Tentang Perusahaan</a></li>
        <li><a href="/k3">Tentang K3</a></li>
        <li><a href="/artikel/syarat-k3-tender-pemerintah-lpse/">Syarat K3 Tender Pemerintah</a></li>
        <li><a href="/artikel/metode-investigasi-kecelakaan-kerja/">Investigasi Kecelakaan Kerja</a></li>
      </ul>
    </div>

    <div class="footer-nav">
      <h4>Kota Populer</h4>
      <ul>
        <li><a href="/pelatihan-k3-jakarta/">K3 Jakarta</a></li>
        <li><a href="/pelatihan-k3-surabaya/">K3 Surabaya</a></li>
        <li><a href="/pelatihan-k3-bandung/">K3 Bandung</a></li>
        <li><a href="/pelatihan-k3-batam/">K3 Batam</a></li>
        <li><a href="/pelatihan-k3-pekanbaru/">K3 Pekanbaru</a></li>
        <li><a href="/pelatihan-k3-semarang/">K3 Semarang</a></li>
        <li><a href="/pelatihan-k3-malang/">K3 Malang</a></li>
        <li><a href="/pelatihan-k3-yogyakarta/">K3 Yogyakarta</a></li>
        <li><a href="/pelatihan-k3-medan/">K3 Medan</a></li>
        <li><a href="/pelatihan-k3-balikpapan/">K3 Balikpapan</a></li>
        <li><a href="/pelatihan-k3-makassar/">K3 Makassar</a></li>
      </ul>
    </div>

    <div class="footer-contact">
      <h4>Kontak</h4>
      <ul>
        <?php if (!empty($s['site_phone'])): ?>
        <li><a href="<?= wa_url() ?>" target="_blank">📱 WhatsApp</a></li>
        <?php endif; ?>
        <?php if (!empty($s['site_email'])): ?>
        <li><span id="email-kontak" aria-label="Alamat email kontak"></span></li>
        <?php endif; ?>
        <?php if (!empty($s['site_address'])): ?>
        <li>📍 <?= e($s['site_address']) ?></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <p>© <?= date('Y') ?> <?= e($s['site_name'] ?? 'Wahana Totalita Konsultan') ?>. All rights reserved.
        · <a href="/sitemap.xml" style="opacity:.5;text-decoration:none">Sitemap</a>
        · <a href="/sitemap-jadwal.xml" style="opacity:.5;text-decoration:none">Sitemap Jadwal</a>
        · <a href="/verifikasi/" style="opacity:.5;text-decoration:none">Verifikasi Sertifikat</a>
        · <a href="/kebijakan-privasi" style="opacity:.5;text-decoration:none">Privasi</a>
        · <a href="/syarat-ketentuan/" style="opacity:.5;text-decoration:none">Syarat &amp; Ketentuan</a>
      </p>
      <p style="margin-top:6px;font-size:.7rem;opacity:.45;line-height:1.6">
        <a href="https://smk3.wahanatotalita.com/" target="_blank" rel="noopener" style="color:inherit;text-decoration:none">SMK3</a>
        · <a href="https://iso.wahanatotalita.com/" target="_blank" rel="noopener" style="color:inherit;text-decoration:none">ISO</a>
        · <a href="https://hse.wahanatotalita.com/" target="_blank" rel="noopener" style="color:inherit;text-decoration:none">HSE</a>
        · <a href="https://training.wahanatotalita.com/" target="_blank" rel="noopener" style="color:inherit;text-decoration:none">Training</a>
        · <a href="https://k3umum.wahanatotalita.com/" target="_blank" rel="noopener" style="color:inherit;text-decoration:none">K3 Umum</a>
      </p>
    </div>
  </div>
</footer>

<!-- Floating WhatsApp Button -->
<a href="<?= wa_url('Halo Wahana Totalita, saya ingin bertanya') ?>"
   class="wa-float" target="_blank" rel="noopener" aria-label="WhatsApp">
  <svg viewBox="0 0 24 24" fill="currentColor">
    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/>
  </svg>
</a>
