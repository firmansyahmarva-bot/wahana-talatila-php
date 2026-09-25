<?php
require_once __DIR__ . '/config.php';

$s          = get_all_settings();
$categories = get_categories();
$all_trainings = get_trainings();
$wa_number  = $s['wa_number'] ?? '6287759151278';

$by_cat     = [];
$cat_counts = [];
$trainings  = [];
foreach ($all_trainings as $t) {
    $cs = $t['cat_slug'] ?? 'other';
    $by_cat[$cs][] = $t;
    $cat_counts[$cs] = ($cat_counts[$cs] ?? 0) + 1;
    if ($cat_counts[$cs] <= 5) {
        $trainings[] = $t;
    }
}

$meta_desc = !empty($s['meta_description']) ? $s['meta_description'] : 'Wahana Totalita Konsultan menyediakan pelatihan K3, Lingkungan, Mining & ISO terakreditasi resmi KEMNAKER RI dan BNSP. Online & offline. Berbasis di Yogyakarta.';
$page_css = ['home'];
?>
<?php require __DIR__ . '/includes/head.php'; ?>
<?php require __DIR__ . '/includes/navbar.php'; ?>
<main id="konten-utama">
<?php require __DIR__ . '/includes/hero.php'; ?>

<!-- TRUST BAR -->
<div class="trust-bar">
  <div class="container trust-bar-inner">
    <span class="trust-bar-label">Terakreditasi &amp; Diakui</span>
    <div class="trust-logo">
      <div class="trust-logo-icon" aria-hidden="true">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18M3 10h18M5 10v11M9 10v11M15 10v11M19 10v11M12 2L2 7h20L12 2z"/></svg>
      </div>
      <div><span class="trust-logo-name">KEMNAKER RI</span><span class="trust-logo-sub">Kementerian Ketenagakerjaan</span></div>
    </div>
    <div class="trust-logo">
      <div class="trust-logo-icon" aria-hidden="true">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/><path d="M9 14l2 2 4-4"/></svg>
      </div>
      <div><span class="trust-logo-name">BNSP</span><span class="trust-logo-sub">Badan Nasional Sertifikasi Profesi</span></div>
    </div>
    <div class="trust-logo">
      <div class="trust-logo-icon" aria-hidden="true">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 18h20v-2a8 8 0 0 0-16 0v2z"/><path d="M10 10V5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v5"/><path d="M2 18a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1"/></svg>
      </div>
      <div><span class="trust-logo-name">ESDM</span><span class="trust-logo-sub">Kementerian ESDM</span></div>
    </div>
    <div class="trust-logo">
      <div class="trust-logo-icon" aria-hidden="true">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/></svg>
      </div>
      <div><span class="trust-logo-name">KLHK</span><span class="trust-logo-sub">Kementerian Lingkungan Hidup</span></div>
    </div>
    <div class="trust-logo">
      <div class="trust-logo-icon" aria-hidden="true">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>
      </div>
      <div><span class="trust-logo-name">ISO 9001</span><span class="trust-logo-sub">Sistem Manajemen Mutu</span></div>
    </div>
  </div>
</div>

<!-- STATS BAR -->
<section class="stats-bar">
  <div class="container stats-inner">
    <div class="stat-item"><span class="stat-number" data-count="120000" data-suffix="+">120.000+</span><span class="stat-label">Peserta Bersertifikasi</span></div>
    <div class="stat-divider"></div>
    <div class="stat-item"><span class="stat-number" data-count="125" data-suffix="+">125+</span><span class="stat-label"><?= e($s['stat_1_label']??'Program Pelatihan') ?></span></div>
    <div class="stat-divider"></div>
    <div class="stat-item"><span class="stat-number"><?= e($s['stat_2_number']??'BNSP') ?></span><span class="stat-label"><?= e($s['stat_2_label']??'Sertifikasi Resmi') ?></span></div>
    <div class="stat-divider"></div>
    <div class="stat-item"><span class="stat-number" data-count="4" data-suffix="">4</span><span class="stat-label"><?= e($s['stat_4_label']??'Bidang Keahlian') ?></span></div>
  </div>
</section>

<!-- JADWAL TERDEKAT (redesign 2026) -->
<section class="jadwal-strip" aria-labelledby="jt-heading">
  <div class="container">
    <div class="jadwal-strip-head">
      <div>
        <p class="section-eyebrow">Batch Berikutnya</p>
        <h2 class="section-title" id="jt-heading" style="margin:0">Jadwal Terdekat</h2>
      </div>
      <a href="/jadwal/" class="all">Lihat semua jadwal →</a>
    </div>
    <div class="jadwal-cards">
      <?php
      // DB-driven: nearest upcoming batches from Admin -> Jadwal Batch
      require_once __DIR__ . '/includes/jadwal-functions.php';
      $home_batches = get_public_schedules(['upcoming' => 1, 'limit' => 4]);
      $hb_m = ['','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'];
      $hb_idx = 0;
      foreach ($home_batches as $hb):
        $hb_idx++;
        $hs = strtotime($hb['start_date']); $he = strtotime($hb['end_date'] ?: $hb['start_date']);
        if (date('nY',$hs) === date('nY',$he)) {
            $hb_date = ($hs===$he ? date('j',$hs) : date('j',$hs).'-'.date('j',$he)).' '.$hb_m[(int)date('n',$hs)].' '.date('Y',$hs);
        } else {
            $hb_date = date('j',$hs).' '.$hb_m[(int)date('n',$hs)].'-'.date('j',$he).' '.$hb_m[(int)date('n',$he)].' '.date('Y',$he);
        }
        $hb_online = $hb['mode'] === 'online';
        $hb_city   = $hb_online ? 'Online' : ($hb['location'] ?: 'Yogyakarta');
        $hb_seats  = max(0, (int)$hb['seats_left']);
        $hb_low    = $hb_seats > 0 && $hb_seats <= 8;
        $hb_name   = $hb['batch_name'] ?: $hb['training_name'];
      ?>
      <div class="jcard" data-reveal="up" data-reveal-delay="<?= min($hb_idx, 4) ?>">
        <span class="jcard-date"><?= e($hb_date) ?></span>
        <a class="jcard-title" href="/pelatihan/<?= e($hb['training_slug']) ?>/"><?= e($hb_name) ?></a>
        <span class="jcard-meta"><?= e($hb_city) ?> · <?= $hb_online ? 'Online' : 'Tatap Muka' ?> · <?php if ($hb_low): ?><span class="hot">⚡ <?= $hb_seats ?> kursi tersisa</span><?php else: ?>✅ <?= $hb_seats ?> kursi<?php endif; ?></span>
        <a class="jcard-cta" href="<?= wa_url('Halo, saya ingin daftar '.$hb_name.' tanggal '.$hb_date) ?>" target="_blank" rel="noopener">Daftar Sekarang</a>
      </div>
      <?php endforeach; ?>
      <?php if (empty($home_batches)): ?>
      <div class="jcard"><span class="jcard-meta">Jadwal batch berikutnya sedang disusun - hubungi kami untuk info terbaru.</span>
        <a class="jcard-cta" href="<?= wa_url('Halo, saya ingin tahu jadwal pelatihan terdekat') ?>" target="_blank" rel="noopener">Tanya Jadwal</a></div>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- MOBILE CATEGORY CHIPS (hidden on desktop) -->
<div class="mobile-cat-scroll">
  <div class="mobile-cat-inner">
    <button class="mobile-chip active" onclick="filterCategory('all')">🔥 Semua</button>
    <button class="mobile-chip" onclick="filterCategory('k3')">🦺 K3</button>
    <button class="mobile-chip" onclick="filterCategory('lingkungan')">🌿 Lingkungan</button>
    <button class="mobile-chip" onclick="filterCategory('system-management')">⚙️ ISO/QHSE</button>
    <button class="mobile-chip" onclick="filterCategory('mining')">⛏️ Mining</button>
    <button class="mobile-chip" onclick="filterMode('online')">📱 Online</button>
    <button class="mobile-chip" onclick="filterMode('offline')">🏫 Offline</button>
  </div>
</div>

<!-- MOBILE PROMO BANNER (hidden on desktop) -->
<div class="mobile-promo">
  <span class="mobile-promo-icon">🎯</span>
  <div class="mobile-promo-text">
    <strong>Daftar Grup Hemat!</strong>
    <span>Min. 5 peserta • Diskon khusus perusahaan</span>
  </div>
  <a href="<?= wa_url('Halo, saya ingin info diskon grup pelatihan') ?>" class="mobile-promo-btn" target="_blank" rel="noopener">Info →</a>
</div>

<!-- LAYANAN -->
<section class="section-services" id="layanan">
  <div class="container">
    <div class="section-header">
      <p class="section-eyebrow">Layanan Kami</p>
      <h2 class="section-title">Bidang Pelatihan &amp; Sertifikasi</h2>
      <p class="section-subtitle">Empat bidang utama pelatihan bersertifikasi resmi KEMNAKER RI, BNSP, dan kompetensi.</p>
    </div>
    <div class="services-grid">
      <?php 
      $hub_urls = [
        'k3'                => '/keselamatan-kerja/',
        'lingkungan'        => '/k3-lingkungan/',
        'system-management' => '/pelatihan-iso/',
        'mining'            => '/k3-pertambangan/',
      ];
      $srv_idx = 0;
      foreach ($categories as $cat): 
        $srv_idx++;
        $hub_target = $hub_urls[$cat['slug']] ?? '#produk';
      ?>
      <a href="<?= e($hub_target) ?>" class="service-card" data-reveal="up" data-reveal-delay="<?= min($srv_idx, 4) ?>" style="--accent: <?= e($cat['accent_color']) ?>">
        <div class="service-card-icon"><?= $cat['icon'] ?></div>
        <h3 class="service-card-title"><?= e($cat['name']) ?></h3>
        <p class="service-card-desc"><?= e($cat['description']??'') ?></p>
        <span class="service-card-count"><?= count($by_cat[$cat['slug']]??[]) ?> Program</span>
        <span class="service-card-arrow">→</span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CATALOG -->
<section class="section-catalog" id="produk">
  <div class="container">
    <div class="section-header">
      <p class="section-eyebrow">Katalog Program</p>
      <h2 class="section-title">Program Pelatihan &amp; Sertifikasi K3</h2>
      <p class="section-subtitle">Lembaga pelatihan K3 resmi dan sertifikasi profesi Kemnaker RI &amp; BNSP. Tersedia kelas online interaktif via Zoom, kelas tatap muka di Yogyakarta, dan in-house training perusahaan di seluruh Indonesia.</p>
    </div>
    <div class="filter-bar">
      <div class="catalog-search-wrap">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input type="search" id="catalog-search" placeholder="Cari program pelatihan..." autocomplete="off" aria-label="Cari program pelatihan">
      </div>
      <div class="filter-group" id="filter-cat">
        <button class="filter-btn active" data-filter="all" onclick="filterCategory('all')">Semua</button>
        <?php foreach ($categories as $cat): ?>
        <button class="filter-btn" data-filter="<?= e($cat['slug']) ?>" onclick="filterCategory('<?= e($cat['slug']) ?>')"><?= e($cat['name']) ?></button>
        <?php endforeach; ?>
      </div>
      <div class="filter-group" id="filter-mode">
        <button class="filter-mode active" data-mode="all"     onclick="filterMode('all')">Semua</button>
        <button class="filter-mode"        data-mode="online"  onclick="filterMode('online')">Online</button>
        <button class="filter-mode"        data-mode="offline" onclick="filterMode('offline')">Tatap Muka</button>
      </div>
    </div>
    <div class="training-grid" id="training-grid">
      <?php $t_idx = 0; foreach ($trainings as $t): $t_idx++; ?>
      <article class="training-card" <?php if ($t_idx <= 4): ?>data-reveal="up" data-reveal-delay="<?= $t_idx ?>"<?php endif; ?> data-cat="<?= e($t['cat_slug']) ?>" data-mode="<?= e($t['mode']) ?>" style="--accent: <?= e($t['accent_color']??'#0A4A2E') ?>">
        <a href="/pelatihan/<?= e($t['slug']) ?>/" class="training-card-img-wrap">
          <img src="<?= training_img_url($t['image_path'], $t['cat_slug'] ?? '', $t['slug'] ?? '') ?>"
               alt="<?php $cat_ctx=['k3'=>'keselamatan dan kesehatan kerja industri','lingkungan'=>'pengelolaan lingkungan hidup','system-management'=>'sistem manajemen QHSE','mining'=>'pertambangan dan operasional tambang']; echo e($t['name'].' bersertifikasi '.$t['certification'].' — ilustrasi '.($cat_ctx[$t['cat_slug']]??'pelatihan sertifikasi')); ?>"
               loading="lazy" decoding="async" width="400" height="250">
          <span class="training-card-cat-badge"><?= $t['cat_icon'] ?> <?= e($t['cat_name']) ?></span>
        </a>
        <div class="training-card-body">
          <div class="training-card-meta">
            <span class="badge-mode"><?= e(mode_label($t['mode'])) ?></span>
            <span class="badge-cert"><?= e($t['certification']) ?></span>
          </div>
          <h3 class="training-card-title"><a href="/pelatihan/<?= e($t['slug']) ?>/"><?= e($t['name']) ?></a></h3>
          <ul class="training-card-features">
            <?php if (!empty($t['duration_days'])): ?>
            <li><span class="tcf-ico">⏱</span> <?= (int)$t['duration_days'] ?> hari pelatihan</li>
            <?php endif; ?>
            <?php if (!empty($t['validity_months'])): ?>
            <li><span class="tcf-ico">🔄</span> Sertifikat berlaku <?= (int)round($t['validity_months']/12) ?> tahun</li>
            <?php endif; ?>
            <li><span class="tcf-ico">✓</span> Sertifikat + modul + e-certificate</li>
          </ul>
          <div class="training-card-footer">
            <span class="training-price"><?= format_price((int)$t['price']) ?> <small>/orang</small></span>
            <a href="<?= wa_url($t['wa_text']??'Halo, saya ingin info '.$t['name']) ?>" class="btn-wa-card" target="_blank" rel="noopener">Daftar Sekarang</a>
          </div>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
    <div class="catalog-cta-wrap" style="text-align:center;margin:40px 0 20px;">
      <a href="/pelatihan/" class="btn-primary" style="display:inline-flex;align-items:center;gap:10px;padding:15px 32px;font-size:1.05rem;font-weight:700;border-radius:12px;text-decoration:none;box-shadow:0 6px 20px rgba(10,74,46,0.22);transition:all .2s ease;">
        <span>Lihat Semua 140+ Program di Katalog Lengkap</span>
        <span aria-hidden="true" style="font-size:1.2rem;">&rarr;</span>
      </a>
      <p style="color:#64748b;font-size:0.875rem;margin-top:12px;">Cari silabus lengkap, jadwal terdekat, dan sertifikasi Kemnaker RI &amp; BNSP</p>
    </div>
    <p class="filter-empty" id="filter-empty" style="display:none">Tidak ada program yang cocok dengan filter ini.</p>
  </div>
</section>

<!-- B2G BAND (redesign 2026) -->
<div class="container">
  <div class="b2g-band" data-reveal="scale">
    <div>
      <h2>🏛️ Vendor Resmi Pengadaan Pemerintah</h2>
      <p>Terdaftar di LPSE dan PADI UMKM — siap melayani pengadaan langsung maupun tender pelatihan K3 untuk Dinas, OPD, dan BUMN.</p>
      <div class="b2g-badges"><span>LPSE ✓</span><span>PADI UMKM ✓</span><span>PJK3 ✓</span><span>Sejak 2008</span></div>
    </div>
    <a href="/layanan-pemerintah" class="btn26 btn26-primary">Lihat Layanan Pemerintah →</a>
  </div>
</div>

<!-- ABOUT -->
<section class="section-about" id="perusahaan">
  <div class="container about-inner">
    <div class="about-text fade-in">
      <p class="section-eyebrow">Tentang Kami</p>
      <h2 class="section-title">Mitra Sertifikasi &amp; Konsultasi K3</h2>
      <p><?= !empty($s['about_description']) ? e($s['about_description']) : 'Wahana Totalita Konsultan adalah lembaga pelatihan K3 resmi dan konsultan Keselamatan &amp; Kesehatan Kerja berlisensi PJK3 Kementerian Ketenagakerjaan RI (No. Kep. 312/BINWASPNAK-PNK3/V/2020) serta terakreditasi BNSP. Sejak 2008, kami telah meluluskan lebih dari 120.000 alumni dan bermitra dengan ratusan BUMN serta swasta dalam sertifikasi Ahli K3 Umum, SMK3 PP 50/2012, CSMS, K3 Konstruksi, Listrik, dan Migas.' ?></p>
      <div class="about-badges">
        <div class="about-badge"><strong>KEMNAKER RI</strong><span>Sertifikasi Resmi</span></div>
        <div class="about-badge"><strong>BNSP</strong><span>Sertifikasi Profesi</span></div>
        <div class="about-badge"><strong>Sejak 2008</strong><span>Berpengalaman</span></div>
      </div>
    </div>
    <div class="about-actions fade-in">
      <a href="<?= wa_url('Halo, saya ingin konsultasi dengan Wahana Totalita') ?>" class="btn-primary" target="_blank" rel="noopener">Hubungi Konsultan</a>
      <a href="#produk" class="btn-outline">Lihat Program</a>
    </div>
  </div>
</section>

<!-- HOW IT WORKS -->
<section class="section-how fade-in">
  <div class="container">
    <div class="section-header">
      <p class="section-eyebrow">Mudah &amp; Cepat</p>
      <h2 class="section-title">Cara Daftar Pelatihan</h2>
      <p class="section-subtitle">Proses pendaftaran sederhana, tanpa birokrasi rumit. Sertifikat terbit tepat waktu.</p>
    </div>
    <div class="how-steps">
      <div class="how-step" data-reveal="up" data-reveal-delay="1">
        <span class="how-step-num">Langkah 01</span>
        <div class="how-step-icon">📋</div>
        <h3>Pilih Program</h3>
        <p>Browse katalog 40+ program pelatihan K3, Lingkungan, Mining, dan ISO. Filter sesuai kategori dan mode pelatihan.</p>
      </div>
      <div class="how-step" data-reveal="up" data-reveal-delay="2">
        <span class="how-step-num">Langkah 02</span>
        <div class="how-step-icon">💬</div>
        <h3>Hubungi via WhatsApp</h3>
        <p>Klik tombol Daftar Sekarang. Tim kami merespons dalam 1×24 jam untuk konfirmasi jadwal dan biaya.</p>
      </div>
      <div class="how-step" data-reveal="up" data-reveal-delay="3">
        <span class="how-step-num">Langkah 03</span>
        <div class="how-step-icon">📚</div>
        <h3>Ikuti Pelatihan</h3>
        <p>Pelatihan online via Zoom atau tatap muka di Yogyakarta. Materi terstruktur, instruktur praktisi berpengalaman.</p>
      </div>
      <div class="how-step" data-reveal="up" data-reveal-delay="4">
        <span class="how-step-num">Langkah 04</span>
        <div class="how-step-icon">🏆</div>
        <h3>Terima Sertifikat</h3>
        <p>Lulus ujian kompetensi, sertifikat resmi KEMNAKER RI / BNSP diterbitkan dan dikirimkan ke alamat Anda.</p>
      </div>
    </div>
  </div>
</section>

<!-- FAQ -->
<?php
$faq_schema = [
  '@context' => 'https://schema.org',
  '@type'    => 'FAQPage',
  'mainEntity' => [
    ['@type'=>'Question','name'=>'Apa itu sertifikasi K3 KEMNAKER RI?','acceptedAnswer'=>['@type'=>'Answer','text'=>'Sertifikasi K3 KEMNAKER RI adalah pengakuan resmi dari Kementerian Ketenagakerjaan Republik Indonesia bahwa seseorang telah memenuhi kompetensi di bidang Keselamatan dan Kesehatan Kerja. Sertifikat ini wajib dimiliki untuk posisi Ahli K3 Umum di perusahaan yang memiliki risiko kerja tinggi.']],
    ['@type'=>'Question','name'=>'Apakah pelatihan bisa dilakukan secara online?','acceptedAnswer'=>['@type'=>'Answer','text'=>'Ya. Wahana Totalita Konsultan menyediakan pelatihan online via Zoom untuk hampir semua program. Peserta dari seluruh Indonesia dapat mengikuti pelatihan tanpa harus datang ke Yogyakarta. Materi, modul, dan ujian dilakukan secara daring dengan kualitas yang sama.']],
    ['@type'=>'Question','name'=>'Berapa lama proses penerbitan sertifikat setelah ujian?','acceptedAnswer'=>['@type'=>'Answer','text'=>'Sertifikat BNSP umumnya terbit dalam 14-30 hari kerja setelah peserta dinyatakan lulus ujian kompetensi. Sertifikat KEMNAKER RI memiliki proses lebih panjang sesuai regulasi, biasanya 30-60 hari kerja.']],
    ['@type'=>'Question','name'=>'Apakah ada diskon untuk pendaftaran grup perusahaan?','acceptedAnswer'=>['@type'=>'Answer','text'=>'Ya, tersedia diskon khusus untuk pendaftaran grup minimal 5 peserta dari perusahaan yang sama. Hubungi kami via WhatsApp untuk mendapatkan penawaran harga korporasi dan paket in-house training.']],
    ['@type'=>'Question','name'=>'Apakah sertifikat berlaku di seluruh Indonesia?','acceptedAnswer'=>['@type'=>'Answer','text'=>'Ya. Sertifikat yang diterbitkan BNSP dan KEMNAKER RI berlaku secara nasional di seluruh wilayah Indonesia dan diakui oleh perusahaan-perusahaan di berbagai sektor industri.']],
    ['@type'=>'Question','name'=>'Apa perbedaan sertifikasi BNSP dan KEMNAKER RI?','acceptedAnswer'=>['@type'=>'Answer','text'=>'Sertifikasi KEMNAKER RI dikeluarkan langsung oleh Kementerian Ketenagakerjaan, umumnya untuk program K3 umum dan khusus yang diatur dalam UU K3. Sertifikasi BNSP (Badan Nasional Sertifikasi Profesi) mencakup lebih banyak bidang kompetensi kerja termasuk lingkungan, mining, dan ISO/QHSE.']],
  ],
];
?>
<script type="application/ld+json"><?= json_encode($faq_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>

<section class="section-faq fade-in" aria-labelledby="faq-heading">
  <div class="container">
    <div class="section-header">
      <p class="section-eyebrow">Pertanyaan Umum</p>
      <h2 class="section-title" id="faq-heading">Yang Sering Ditanyakan</h2>
      <p class="section-subtitle">Jawaban atas pertanyaan paling umum seputar pelatihan dan sertifikasi kami.</p>
    </div>
    <div class="faq-grid">
      <?php foreach ($faq_schema['mainEntity'] as $faq): ?>
      <div class="faq-item">
        <button class="faq-question" aria-expanded="false">
          <?= e($faq['name']) ?>
          <span class="faq-icon" aria-hidden="true">+</span>
        </button>
        <div class="faq-answer"><div class="faq-answer-inner"><?= e($faq['acceptedAnswer']['text']) ?></div></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- SOCIAL PROOF -->
<section class="section-social-proof" aria-labelledby="sp-heading">
  <div class="container">
    <p class="section-eyebrow">Dipercaya Profesional Indonesia</p>
    <h2 class="section-title" id="sp-heading">Ribuan Peserta Telah Bersertifikasi</h2>
    <p class="section-subtitle">Bergabung bersama alumni dari berbagai industri di seluruh Indonesia</p>
    <div class="sp-stats" aria-label="Statistik peserta">
      <div class="sp-stat"><span class="sp-stat-num">120.000+</span><span class="sp-stat-desc">Total Peserta Bersertifikasi</span></div>
      <div class="sp-stat"><span class="sp-stat-num">125+</span><span class="sp-stat-desc">Program Pelatihan Tersedia</span></div>
      <div class="sp-stat"><span class="sp-stat-num">Sejak 2008</span><span class="sp-stat-desc">Berpengalaman</span></div>
    </div>
    <div class="sp-testimonials">
      <article class="sp-card" data-reveal="up" data-reveal-delay="1"><span class="sp-card-program">Ahli K3 Umum</span><blockquote class="sp-card-quote">Materi sangat relevan dan instruktur berpengalaman di lapangan. Sertifikasi BNSP yang saya dapat langsung diakui perusahaan dan mempercepat karier saya di bidang HSE.</blockquote><div class="sp-card-footer"><div class="sp-card-avatar" aria-hidden="true">BS</div><div><div class="sp-card-name">Budi S.</div><div class="sp-card-meta">HSE Manager &middot; Industri Manufaktur, Jawa Tengah</div></div></div></article>
      <article class="sp-card" data-reveal="up" data-reveal-delay="2"><span class="sp-card-program">POPAL</span><blockquote class="sp-card-quote">Pelatihan online sangat fleksibel dan tidak mengganggu jadwal kerja. Modul lengkap dan tim Wahana Totalita sangat responsif merespon pertanyaan peserta.</blockquote><div class="sp-card-footer"><div class="sp-card-avatar" aria-hidden="true">SR</div><div><div class="sp-card-name">Sari R.</div><div class="sp-card-meta">Environmental Coordinator &middot; Sektor Energi</div></div></div></article>
      <article class="sp-card" data-reveal="up" data-reveal-delay="3"><span class="sp-card-program">POP Mining</span><blockquote class="sp-card-quote">Daftar mudah lewat WhatsApp, sertifikat BNSP terbit tepat waktu. Pelatihan POP ini benar-benar mendukung persiapan saya naik jabatan pengawas lapangan.</blockquote><div class="sp-card-footer"><div class="sp-card-avatar" aria-hidden="true">AF</div><div><div class="sp-card-name">Ahmad F.</div><div class="sp-card-meta">Mining Supervisor &middot; Tambang Batubara, Kalimantan</div></div></div></article>
    </div>
  </div>
</section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
<?php require __DIR__ . '/includes/scripts.php'; ?>
</body>
</html>