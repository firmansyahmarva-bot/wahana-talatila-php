<!-- ═══════════════════════════════════════════════════ MOVING PHOTO STRIP (Above Footer) -->
<section class="footer-photo-strip" aria-label="Dokumentasi Pelatihan K3 Wahana Totalita">
  <div class="footer-photo-track">
    <div class="footer-photo-group">
      <?php
        $footer_photos = [
          1  => 'Pelatihan Ahli K3 Umum Sertifikasi Kemnaker RI',
          3  => 'Praktik Kerja Lapangan Peserta Pelatihan K3 Industri',
          5  => 'Uji Kompetensi & Sertifikasi BNSP K3 Wahana Totalita',
          8  => 'Simulasi Tanggap Darurat & Penanggulangan Kebakaran K3',
          11 => 'Pembinaan Calon Ahli K3 Umum Resmi Kemnaker RI',
          14 => 'Sesi Evaluasi & Ujian Sertifikasi K3 Kemnaker',
          17 => 'Pelatihan K3 Bekerja di Ketinggian & Ruang Terbatas',
          20 => 'Pemeriksaan Alat Keselamatan Kerja & Audit CSMS',
          24 => 'In-House Training Pelatihan K3 Korporasi Nasional',
          28 => 'Pemberian Lisensi & Surat Keputusan Penunjukan Ahli K3',
          32 => 'Pelatihan Sertifikasi POPAL & Lingkungan Hidup BNSP',
          36 => 'Praktik Inspeksi K3 & Identifikasi Bahaya Lapangan',
          41 => 'Pelatihan Auditor SMK3 PP 50 Tahun 2012 Kemnaker RI',
          45 => 'Kegiatan Pembinaan Keselamatan dan Kesehatan Kerja K3',
          50 => 'Dokumentasi Kelulusan Calon Ahli K3 Umum Wahana Totalita',
          55 => 'Pelatihan K3 Listrik & Teknisi K3 Industri Kemnaker',
          60 => 'Workshop Contractor Safety Management System CSMS',
          64 => 'Sertifikasi Petugas P3K & K3 Lingkungan Kerja Kemnaker RI',
        ];
        foreach ($footer_photos as $fp_num => $fp_alt):
          $fp_img = sprintf('/images/pelatihan-%03d.webp', $fp_num);
      ?>
      <a href="/galeri/" class="footer-photo-item" title="<?= e($fp_alt) ?>">
        <img src="<?= $fp_img ?>" alt="<?= e($fp_alt) ?>" width="220" height="135" loading="lazy" decoding="async">
      </a>
      <?php endforeach; ?>
    </div>
    <div class="footer-photo-group" aria-hidden="true">
      <?php foreach (array_keys($footer_photos) as $fp_num):
          $fp_img = sprintf('/images/pelatihan-%03d.webp', $fp_num);
      ?>
      <a href="/galeri/" class="footer-photo-item" tabindex="-1">
        <img src="<?= $fp_img ?>" alt="" width="220" height="135" loading="lazy" decoding="async">
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════ FOOTER -->
<footer class="footer">

  <!-- Quick Contact Strip (Matches Reference Screenshot 2) -->
  <div class="footer-contact-strip">
    <div class="container fcs-inner">
      <a href="mailto:<?= e($s['site_email'] ?? 'info@wahanatotalita.com') ?>" class="fcs-btn">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
        <span>Email Kami</span>
      </a>
      <a href="<?= wa_url('Halo Wahana Totalita, saya ingin tanya jadwal dan biaya pelatihan K3') ?>" target="_blank" rel="noopener" class="fcs-btn fcs-wa">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
        <span>WhatsApp Konsultasi</span>
      </a>
    </div>
  </div>

  <div class="container footer-inner">
    <!-- Col 1: Brand & Accreditation -->
    <div class="footer-brand">
      <div class="footer-logo">
        <?= theme_logo_html($s) ?>
        <span><strong><?= e($s['site_name'] ?? 'Wahana Totalita Konsultan') ?></strong></span>
      </div>
      <p>Lembaga pelatihan &amp; sertifikasi K3 resmi berlisensi Kemnaker RI &amp; terakreditasi BNSP. Melayani public training di Yogyakarta dan in-house di seluruh Indonesia.</p>
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

    <!-- Col 2: Program Sertifikasi Populer -->
    <div class="footer-nav">
      <h4>Program Populer</h4>
      <ul>
        <li><a href="/pelatihan/k3/">Pelatihan K3 Lengkap</a></li>
        <li><a href="/pelatihan/pelatihan-ahli-k3-umum-fresh-graduate-kemnaker-online/">Ahli K3 Umum Kemnaker</a></li>
        <li><a href="/pelatihan/ak3-bnsp/">Ahli K3 BNSP</a></li>
        <li><a href="/pelatihan/pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri/">Operator Forklift Kelas II</a></li>
        <li><a href="/pelatihan/pelatihan-damkar-paralel-kelas-dcba-sertifikasi-kemnaker-ri/">Damkar Kelas D–A</a></li>
        <li><a href="/pelatihan/pelatihan-petugas-p3k-first-aid-online/">Petugas P3K / First Aid</a></li>
        <li><a href="/pelatihan/pelatihan-internal-auditor-iso-45001-online/">Internal Auditor ISO 45001</a></li>
        <li><a href="/keselamatan-kerja/">Direktori 23 Bidang K3</a></li>
        <li><a href="/pelatihan/">Katalog Semua Program</a></li>
      </ul>
    </div>

    <!-- Col 3: Layanan & Fitur Platform -->
    <div class="footer-nav">
      <h4>Layanan &amp; Fitur</h4>
      <ul>
        <li><a href="/jadwal/">Jadwal Pelatihan <?= date('Y') ?></a></li>
        <li><a href="/jadwal/kalender/">Kalender Pelatihan</a></li>
        <li><a href="/regulasi/">Pusat Regulasi K3 RI</a></li>
        <li><a href="/skkni/">Standar Profesi SKKNI</a></li>
        <li><a href="/in-house-training/">In-House Training Perusahaan</a></li>
        <li><a href="/tools/safety-talk">Safety Talk Generator</a></li>
        <li><a href="/verifikasi/">Verifikasi Keaslian Sertifikat</a></li>
        <li><a href="/artikel/">Artikel &amp; Panduan K3</a></li>
        <li><a href="/perusahaan">Tentang Wahana Totalita</a></li>
      </ul>
    </div>

    <!-- Col 4: Wilayah Layanan & Kontak -->
    <div class="footer-contact">
      <h4>Hub In-House &amp; Kontak</h4>
      <ul>
        <li><a href="/in-house-training/balikpapan-ikn/">In-House Balikpapan &amp; IKN</a></li>
        <li><a href="/in-house-training/cilegon-karawang/">In-House Cilegon &amp; Karawang</a></li>
        <li><a href="/in-house-training/morowali-weda-bay/">In-House Morowali &amp; Weda Bay</a></li>
        <li><a href="/pelatihan-k3-jakarta/">Jakarta</a> · <a href="/pelatihan-k3-surabaya/">Surabaya</a> · <a href="/pelatihan-k3-bandung/">Bandung</a></li>
        <li><a href="/pelatihan-k3-medan/">Medan</a> · <a href="/pelatihan-k3-semarang/">Semarang</a> · <a href="/pelatihan-k3-makassar/">Makassar</a></li>
        <li><a href="<?= wa_url() ?>" target="_blank">📱 WhatsApp: <?= e($s['wa_number'] ?? '0877-5915-1278') ?></a></li>
        <?php if (!empty($s['site_address'])): ?>
        <li>📍 <?= e($s['site_address']) ?></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>

  <div class="footer-bottom">
    <div class="container">
      <p>© <?= date('Y') ?> <?= e($s['site_name'] ?? 'Wahana Totalita Konsultan') ?>. All rights reserved.
        · <a href="/sitemap.xml" style="opacity:.6;text-decoration:none">Sitemap</a>
        · <a href="/sitemap-jadwal.xml" style="opacity:.6;text-decoration:none">Sitemap Jadwal</a>
        · <a href="/verifikasi/" style="opacity:.6;text-decoration:none">Verifikasi Sertifikat</a>
        · <a href="/kebijakan-privasi" style="opacity:.6;text-decoration:none">Privasi</a>
        · <a href="/zh/" style="opacity:.6;text-decoration:none">中文 (ZH)</a>
      </p>
    </div>
  </div>
</footer>

<!-- Floating WhatsApp Button with Notification Badge (Matches Reference Screenshot 1) -->
<a href="<?= wa_url($wa_float_msg ?? ($wa_msg ?? 'Halo Wahana Totalita, saya ingin bertanya tentang program pelatihan')) ?>"
   class="wa-float" target="_blank" rel="noopener" aria-label="Konsultasi WhatsApp">
  <span class="wa-badge" aria-label="1 pesan">1</span>
  <svg viewBox="0 0 24 24" fill="currentColor">
    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/>
  </svg>
</a>
