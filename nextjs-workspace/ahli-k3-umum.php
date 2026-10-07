<?php
/**
 * ahli-k3-umum.php
 * Authority & Money Hub for "Ahli K3 Umum" (AK3U) — The highest-intent commercial search pillar.
 * 
 * Target Keywords:
 * - "pelatihan ahli k3 umum", "sertifikasi ahli k3 umum", "ahli k3 umum kemnaker ri"
 * - "biaya pelatihan ahli k3 umum", "harga pelatihan ak3u", "biaya ak3u kemnaker"
 * - "syarat ahli k3 umum", "syarat ak3u fresh graduate d3 s1"
 * - "jadwal pelatihan ahli k3 umum 2026", "jadwal ak3u online zoom"
 * - "perbedaan ak3u kemnaker vs bnsp"
 * - "in house training ahli k3 umum", "perpanjangan skp ahli k3 umum"
 */
require_once __DIR__ . '/config.php';

$db_available = false;
try {
    $conn = @fsockopen(DB_HOST, 3306, $errno, $errstr, 0.2);
    if ($conn) {
        fclose($conn);
        $db_available = true;
    }
} catch (Throwable) {
    $db_available = false;
}

$s = $db_available ? get_all_settings() : [];
$wa_raw = !empty($s['wa_number']) ? $s['wa_number'] : '6287759151278';
$wa_number  = preg_replace('/\D/', '', $wa_raw);
$phone_disp = '0' . substr($wa_number, 2);
$phone_disp = trim(chunk_split($phone_disp, 4, '-'), '-');
$year       = date('Y');

$canonical  = SITE_URL . '/ahli-k3-umum/';
$page_title = 'Pelatihan & Sertifikasi Ahli K3 Umum (AK3U) Kemnaker RI & BNSP ' . $year . ' | Biaya, Syarat, & Jadwal';
$meta_desc  = 'Pusat pendaftaran Pelatihan Ahli K3 Umum (AK3U) resmi Kemnaker RI & BNSP. Informasi lengkap rincian biaya pelatihan, syarat pendaftaran, jadwal ' . $year . ', jalur fresh graduate & in-house.';

// WhatsApp Pre-filled Links
$wa_hero_msg     = "Halo Wahana Totalita, saya ingin informasi lengkap biaya, syarat, dan jadwal pelatihan Ahli K3 Umum {$year}. Mohon dibantu.";
$wa_price_msg    = "Halo Wahana Totalita, mohon kirimkan rincian biaya dan fasilitas resmi pelatihan Ahli K3 Umum (Kemnaker/BNSP).";
$wa_syarat_msg   = "Halo Wahana Totalita, saya ingin konsultasi kelayakan berkas & persyaratan mengikuti pelatihan Ahli K3 Umum.";
$wa_inhouse_msg  = "Halo Wahana Totalita, kami dari perusahaan ingin mengajukan penawaran In-House Training Ahli K3 Umum untuk tim kami. Mohon proposal & RAB.";
$wa_renewal_msg  = "Halo Wahana Totalita, saya ingin konsultasi proses perpanjangan SKP / Lisensi Ahli K3 Umum yang sudah expired.";

// Fetch live batches if DB is reachable, otherwise use curated fallbacks
$ak3u_batches = [];
if ($db_available) {
    try {
        $stmt = get_pdo()->prepare("SELECT tb.*, t.name as course_name, t.slug as course_slug 
                                    FROM training_batches tb 
                                    JOIN trainings t ON tb.course_id = t.id 
                                    WHERE (t.slug LIKE '%ahli-k3-umum%' OR t.name LIKE '%Ahli K3 Umum%') 
                                      AND tb.is_public = 1 
                                      AND tb.start_date >= CURDATE() 
                                    ORDER BY tb.start_date ASC 
                                    LIMIT 4");
        $stmt->execute();
        $ak3u_batches = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Throwable) {
        $ak3u_batches = [];
    }
}

// Fallback batches if DB batches are empty/unseeded
if (empty($ak3u_batches)) {
    $ak3u_batches = [
        [
            'id' => 101,
            'batch_name' => "Batch Reguler Online Blended {$year}",
            'start_date' => date('Y-m-d', strtotime('+7 days')),
            'end_date'   => date('Y-m-d', strtotime('+19 days')),
            'venue'      => 'Online via Zoom Interaktif & Praktik Mandiri',
            'mode'       => 'online',
            'price'      => '7500000',
            'course_slug'=> 'pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri',
        ],
        [
            'id' => 102,
            'batch_name' => "Batch Intensif Tatap Muka Yogyakarta",
            'start_date' => date('Y-m-d', strtotime('+21 days')),
            'end_date'   => date('Y-m-d', strtotime('+33 days')),
            'venue'      => 'Training Center Wahana Totalita, Yogyakarta',
            'mode'       => 'onsite',
            'price'      => '8500000',
            'course_slug'=> 'pelatihan-ahli-k3-umum-kemnaker-offline',
        ],
        [
            'id' => 103,
            'batch_name' => "Batch Uji Kompetensi BNSP Online",
            'start_date' => date('Y-m-d', strtotime('+14 days')),
            'end_date'   => date('Y-m-d', strtotime('+17 days')),
            'venue'      => 'Virtual Assessment via Zoom LSP K3',
            'mode'       => 'online',
            'price'      => '4500000',
            'course_slug'=> 'pelatihan-ahli-k3-umum-sertifikasi-bnsp-online',
        ],
    ];
}

$faqs = [
    [
        'q' => 'Berapa biaya pelatihan Ahli K3 Umum Kemnaker RI dan BNSP?',
        'a' => 'Biaya pelatihan Ahli K3 Umum bersertifikasi Kemnaker RI jalur Online/Blended berkisar antara Rp 6.500.000 hingga Rp 7.500.000, sedangkan jalur Tatap Muka (Offline) di Yogyakarta berkisar antara Rp 8.000.000 hingga Rp 8.500.000 (sudah termasuk akomodasi/fasilitas kelas). Untuk jalur Sertifikasi Profesi BNSP berkisar antara Rp 4.000.000 hingga Rp 5.000.000. Biaya sudah termasuk pembinaan resmi, modul, ujian, SKP/Lisensi Kemnaker atau Sertifikat BNSP Garuda Emas.'
    ],
    [
        'q' => 'Apa saja syarat pendidikan untuk mengikuti pelatihan Ahli K3 Umum?',
        'a' => 'Sesuai Permenaker No. Per.02/MEN/1992, syarat pendidikan minimal untuk memperoleh penunjukan Ahli K3 Umum Kemnaker RI adalah Diploma 3 (D3) atau Sarjana (S1) dari SEMUA JURUSAN (baik teknik maupun non-teknik seperti hukum, ekonomi, komunikasi, dsb). Fresh graduate yang belum bekerja tetap dapat mendaftar dan mengikuti pembinaan hingga lulus ujian.'
    ],
    [
        'q' => 'Apa perbedaan Ahli K3 Umum sertifikasi Kemnaker RI vs BNSP?',
        'a' => 'Sertifikasi Kemnaker RI berorientasi pada kepatuhan hukum regulasi nasional dan penunjukan operasional personel di tempat kerja (menghasilkan SKP & Lisensi K3 untuk pembentukan P2K3 dan audit SMK3). Sedangkan sertifikasi BNSP berorientasi pada pengakuan kompetensi profesi kerja berbasis standar SKKNI nasional berlogo Garuda Emas, sangat diminati untuk tender BUMN, KKKS Migas, dan standar kualifikasi kompetensi profesi.'
    ],
    [
        'q' => 'Berapa lama masa berlaku sertifikat & lisensi Ahli K3 Umum?',
        'a' => 'Sertifikat Pembinaan Ahli K3 Umum dari Kemnaker RI berlaku seumur hidup. Namun, Lisensi Kewenangan & Surat Keputusan Penunjukan (SKP) berlaku selama 3 (tiga) tahun dan wajib diperpanjang melalui PJK3 resmi sebelum masa berlakunya habis. Sertifikat kompetensi BNSP juga memiliki masa berlaku selama 3 tahun.'
    ],
    [
        'q' => 'Apakah fresh graduate bisa langsung mengikuti pelatihan AK3U?',
        'a' => 'Bisa. Fresh graduate lulusan D3 atau S1 dapat langsung mengambil sertifikasi Ahli K3 Umum. Sertifikat ini menjadi nilai tambah terbesar (competitive edge) saat melamar kerja posisi HSE Officer, Safety Supervisor, atau Management Trainee di sektor migas, tambang, manufaktur, dan konstruksi.'
    ],
    [
        'q' => 'Berapa lama durasi pelatihan Ahli K3 Umum?',
        'a' => 'Durasi pembinaan Ahli K3 Umum sertifikasi Kemnaker RI adalah 12 hari kerja efektif (sekitar 120 jam pelajaran), mencakup penyampaian materi regulasi & teknis, praktik kerja lapangan (PKL), pembuatan laporan PKL, seminar presentasi, dan evaluasi ujian negara Kemnaker RI. Untuk jalur BNSP berlangsung selama 3–4 hari efektif.'
    ],
    [
        'q' => 'Apakah Wahana Totalita menyediakan program In-House Training untuk perusahaan?',
        'a' => 'Ya. Kami menyelenggarakan In-House Training Ahli K3 Umum khusus bagi korporasi atau instansi dengan jadwal fleksibel, materi yang disesuaikan dengan hazard industri perusahaan, serta efisiensi anggaran investasi pelatihan untuk rombongan karyawan.'
    ],
];

require __DIR__ . '/includes/head.php';
?>

<!-- JSON-LD Structured Data Graph (Breadcrumbs, Course, FAQPage) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "EducationalOrganization",
      "@id": "<?= SITE_URL ?>/#organization",
      "name": "Wahana Totalita Konsultan",
      "url": "<?= SITE_URL ?>",
      "logo": "<?= SITE_URL ?>/assets/img/og-cover.jpg",
      "telephone": "+<?= e($wa_number) ?>",
      "description": "PJK3 Resmi Berlisensi Kementerian Ketenagakerjaan RI (SK No. Kep. 312/BINWASPNAK-PNK3/V/2020) dan Lembaga Sertifikasi Profesi Terakreditasi BNSP."
    },
    {
      "@type": "BreadcrumbList",
      "@id": "<?= $canonical ?>#breadcrumb",
      "itemListElement": [
        {"@type": "ListItem", "position": 1, "name": "Beranda", "item": "<?= SITE_URL ?>/"},
        {"@type": "ListItem", "position": 2, "name": "Pelatihan K3", "item": "<?= SITE_URL ?>/pelatihan/"},
        {"@type": "ListItem", "position": 3, "name": "Ahli K3 Umum (AK3U)", "item": "<?= $canonical ?>"}
      ]
    },
    {
      "@type": "Course",
      "@id": "<?= $canonical ?>#course",
      "name": "Pelatihan & Sertifikasi Ahli K3 Umum (AK3U) Kemnaker RI & BNSP",
      "description": "Pembinaan dan sertifikasi resmi Ahli K3 Umum Kemnaker RI dan uji kompetensi BNSP. Tersedia kelas Online Zoom, Tatap Muka Yogyakarta, Fresh Graduate, dan In-House Training perusahaan.",
      "url": "<?= $canonical ?>",
      "provider": {"@id": "<?= SITE_URL ?>/#organization"},
      "educationalCredentialAwarded": "Surat Keputusan Penunjukan (SKP) & Lisensi K3 Kemnaker RI / Sertifikat Kompetensi BNSP",
      "courseMode": ["online", "onsite"],
      "inLanguage": "id",
      "offers": {
        "@type": "AggregateOffer",
        "priceCurrency": "IDR",
        "lowPrice": "4500000",
        "highPrice": "8500000",
        "offerCount": "6",
        "availability": "https://schema.org/InStock",
        "url": "<?= $canonical ?>"
      }
    },
    {
      "@type": "FAQPage",
      "@id": "<?= $canonical ?>#faq",
      "mainEntity": [
        <?php foreach ($faqs as $i => $f): ?>
        {
          "@type": "Question",
          "name": <?= json_encode($f['q'], JSON_UNESCAPED_UNICODE) ?>,
          "acceptedAnswer": {
            "@type": "Answer",
            "text": <?= json_encode($f['a'], JSON_UNESCAPED_UNICODE) ?>
          }
        }<?= $i < count($faqs) - 1 ? ',' : '' ?>
        <?php endforeach; ?>
      ]
    }
  ]
}
</script>

<style>
/* ── AK3U Money Hub Styles ── */
:root {
  --ak-navy: #103A5C;
  --ak-navy-dark: #0A253B;
  --ak-navy-light: #164e7d;
  --ak-orange: #E65100;
  --ak-orange-hover: #BF360C;
  --ak-green: #2E7D32;
  --ak-bg-soft: #F8FAFC;
  --ak-border: #E2E8F0;
  --ak-text-main: #1E293B;
  --ak-text-muted: #64748B;
  --ak-gold: #D97706;
}

body {
  color: var(--ak-text-main);
  background-color: #FFFFFF;
}

/* Hero Section */
.ak-hero {
  background: linear-gradient(135deg, var(--ak-navy-dark) 0%, var(--ak-navy) 60%, var(--ak-navy-light) 100%);
  color: #FFFFFF;
  padding: 64px 0 56px;
  position: relative;
  overflow: hidden;
}
.ak-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at 10% 20%, rgba(230, 81, 0, 0.15), transparent 45%),
              radial-gradient(circle at 90% 80%, rgba(46, 125, 50, 0.15), transparent 40%);
  pointer-events: none;
}
.ak-hero-inner {
  position: relative;
  z-index: 2;
  max-width: 1040px;
  margin: 0 auto;
}
.ak-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(255, 255, 255, 0.12);
  border: 1px solid rgba(255, 255, 255, 0.25);
  backdrop-filter: blur(8px);
  padding: 6px 16px;
  border-radius: 999px;
  font-size: 12.5px;
  font-weight: 700;
  letter-spacing: 0.05em;
  text-transform: uppercase;
  color: #FFD54F;
  margin-bottom: 20px;
}
.ak-hero-title {
  font-size: clamp(2rem, 4.5vw, 3.2rem);
  font-weight: 900;
  line-height: 1.18;
  letter-spacing: -0.02em;
  margin-bottom: 18px;
  color: #FFFFFF;
}
.ak-hero-title em {
  font-style: normal;
  color: #FFB74D;
}
.ak-hero-sub {
  font-size: clamp(1.05rem, 2vw, 1.25rem);
  line-height: 1.65;
  color: #E2E8F0;
  max-width: 820px;
  margin-bottom: 32px;
}
.ak-hero-actions {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  margin-bottom: 40px;
}
.ak-btn-primary {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: #25D366;
  color: #FFFFFF !important;
  font-weight: 800;
  font-size: 16px;
  padding: 14px 28px;
  border-radius: 10px;
  text-decoration: none;
  box-shadow: 0 4px 18px rgba(37, 211, 102, 0.4);
  transition: transform 0.18s ease, background 0.18s ease;
}
.ak-btn-primary:hover {
  background: #20BD5A;
  transform: translateY(-2px);
}
.ak-btn-secondary {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: rgba(255, 255, 255, 0.12);
  color: #FFFFFF !important;
  border: 1.5px solid rgba(255, 255, 255, 0.35);
  font-weight: 700;
  font-size: 15.5px;
  padding: 14px 26px;
  border-radius: 10px;
  text-decoration: none;
  transition: all 0.18s ease;
}
.ak-btn-secondary:hover {
  background: rgba(255, 255, 255, 0.22);
  border-color: #FFFFFF;
}
.ak-trust-badges {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
  gap: 14px;
  padding-top: 24px;
  border-top: 1px solid rgba(255, 255, 255, 0.18);
}
.ak-badge-item {
  display: flex;
  align-items: center;
  gap: 12px;
  background: rgba(255, 255, 255, 0.08);
  padding: 12px 16px;
  border-radius: 8px;
  border: 1px solid rgba(255, 255, 255, 0.12);
}
.ak-badge-icon {
  font-size: 22px;
}
.ak-badge-text strong {
  display: block;
  font-size: 13.5px;
  color: #FFFFFF;
}
.ak-badge-text span {
  font-size: 12px;
  color: #CBD5E1;
}

/* Sections Common */
.ak-section {
  padding: 64px 0;
}
.ak-section-alt {
  background-color: var(--ak-bg-soft);
  border-top: 1px solid var(--ak-border);
  border-bottom: 1px solid var(--ak-border);
}
.ak-header-box {
  text-align: center;
  max-width: 760px;
  margin: 0 auto 44px;
}
.ak-kicker {
  display: inline-block;
  color: var(--ak-navy);
  font-weight: 800;
  font-size: 13px;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  margin-bottom: 8px;
}
.ak-title {
  font-size: clamp(1.75rem, 3.2vw, 2.4rem);
  font-weight: 800;
  line-height: 1.25;
  color: var(--ak-navy-dark);
  margin-bottom: 12px;
}
.ak-desc {
  font-size: 15.5px;
  color: var(--ak-text-muted);
  line-height: 1.7;
}

/* Tracks Grid (The Core Funnel) */
.ak-track-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(310px, 1fr));
  gap: 22px;
}
.ak-track-card {
  background: #FFFFFF;
  border: 1.5px solid var(--ak-border);
  border-radius: 14px;
  padding: 26px;
  display: flex;
  flex-direction: column;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
  position: relative;
  transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
}
.ak-track-card:hover {
  transform: translateY(-4px);
  border-color: var(--ak-navy-light);
  box-shadow: 0 12px 30px rgba(16, 58, 92, 0.12);
}
.ak-track-pill {
  display: inline-block;
  padding: 4px 12px;
  border-radius: 6px;
  font-size: 11.5px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  margin-bottom: 14px;
  width: fit-content;
}
.ak-pill-popular { background: #FEF3C7; color: #92400E; }
.ak-pill-offline { background: #E0E7FF; color: #3730A3; }
.ak-pill-bnsp { background: #DCFCE7; color: #166534; }
.ak-pill-fresh { background: #FCE7F3; color: #9D174D; }
.ak-pill-corp { background: #F1F5F9; color: #334155; }
.ak-pill-renew { background: #FEE2E2; color: #991B1B; }

.ak-track-title {
  font-size: 1.25rem;
  font-weight: 800;
  color: var(--ak-navy);
  margin-bottom: 10px;
  line-height: 1.35;
}
.ak-track-body {
  font-size: 14px;
  color: var(--ak-text-muted);
  line-height: 1.65;
  margin-bottom: 18px;
  flex-grow: 1;
}
.ak-track-features {
  list-style: none;
  padding: 0;
  margin: 0 0 22px 0;
  display: flex;
  flex-direction: column;
  gap: 8px;
  font-size: 13.5px;
}
.ak-track-features li {
  display: flex;
  align-items: center;
  gap: 8px;
  color: var(--ak-text-main);
}
.ak-track-features li svg {
  flex-shrink: 0;
  color: var(--ak-green);
}
.ak-track-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  padding: 12px 18px;
  border-radius: 8px;
  font-size: 14px;
  font-weight: 700;
  text-decoration: none;
  background: var(--ak-navy);
  color: #FFFFFF !important;
  transition: background 0.15s ease;
}
.ak-track-btn:hover {
  background: var(--ak-navy-light);
}

/* Pricing Section */
.ak-price-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 20px;
  margin-bottom: 36px;
}
.ak-price-card {
  background: #FFFFFF;
  border: 1.5px solid var(--ak-border);
  border-radius: 12px;
  padding: 24px 20px;
  text-align: center;
  display: flex;
  flex-direction: column;
}
.ak-price-card.featured {
  border: 2px solid var(--ak-navy);
  box-shadow: 0 8px 24px rgba(16, 58, 92, 0.1);
  position: relative;
}
.ak-ribbon {
  position: absolute;
  top: -12px;
  left: 50%;
  transform: translateX(-50%);
  background: var(--ak-orange);
  color: #FFFFFF;
  font-size: 11px;
  font-weight: 800;
  padding: 4px 14px;
  border-radius: 999px;
  text-transform: uppercase;
}
.ak-price-card h3 {
  font-size: 16px;
  font-weight: 700;
  color: var(--ak-navy-dark);
  margin-bottom: 8px;
}
.ak-price-num {
  font-size: 26px;
  font-weight: 900;
  color: var(--ak-navy);
  margin-bottom: 12px;
}
.ak-price-num small {
  font-size: 13px;
  font-weight: 600;
  color: var(--ak-text-muted);
}
.ak-price-desc {
  font-size: 13px;
  color: var(--ak-text-muted);
  line-height: 1.6;
  margin-bottom: 16px;
  flex-grow: 1;
}

/* Facilities list */
.ak-facilities-box {
  background: #FFFFFF;
  border: 1px solid var(--ak-border);
  border-radius: 12px;
  padding: 28px;
}
.ak-facilities-title {
  font-size: 1.2rem;
  font-weight: 800;
  color: var(--ak-navy-dark);
  margin-bottom: 16px;
}
.ak-facilities-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 14px;
}
.ak-facility-item {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  font-size: 14px;
  color: var(--ak-text-main);
  line-height: 1.5;
}
.ak-facility-item svg {
  color: var(--ak-green);
  margin-top: 2px;
  flex-shrink: 0;
}

/* Syarat / Eligibility Checklist */
.ak-syarat-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: 24px;
}
.ak-syarat-card {
  background: #FFFFFF;
  border: 1.5px solid var(--ak-border);
  border-radius: 12px;
  padding: 28px;
}
.ak-syarat-card h3 {
  font-size: 1.25rem;
  font-weight: 800;
  color: var(--ak-navy);
  margin-bottom: 16px;
  display: flex;
  align-items: center;
  gap: 10px;
}
.ak-syarat-list {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 12px;
}
.ak-syarat-list li {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  font-size: 14px;
  line-height: 1.6;
  color: var(--ak-text-main);
}
.ak-syarat-list li strong {
  color: var(--ak-navy-dark);
}

/* Comparison Table */
.ak-table-wrap {
  background: #FFFFFF;
  border: 1.5px solid var(--ak-border);
  border-radius: 12px;
  overflow-x: auto;
  box-shadow: 0 4px 16px rgba(0,0,0,0.03);
}
.ak-comp-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 14.5px;
  text-align: left;
}
.ak-comp-table th {
  background: var(--ak-navy);
  color: #FFFFFF;
  padding: 16px 20px;
  font-weight: 700;
  border-right: 1px solid rgba(255,255,255,0.15);
}
.ak-comp-table th:last-child {
  border-right: none;
}
.ak-comp-table td {
  padding: 14px 20px;
  border-bottom: 1px solid var(--ak-border);
  border-right: 1px solid var(--ak-border);
  vertical-align: top;
  line-height: 1.6;
}
.ak-comp-table td:last-child {
  border-right: none;
}
.ak-comp-table tr:nth-child(even) td {
  background: var(--ak-bg-soft);
}
.ak-comp-table td.dimmed {
  font-weight: 700;
  color: var(--ak-navy);
  background: #F1F5F9;
}

/* Schedule Cards */
.ak-batch-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 18px;
}
.ak-batch-card {
  background: #FFFFFF;
  border: 1.5px solid var(--ak-border);
  border-radius: 12px;
  padding: 22px;
  display: flex;
  flex-direction: column;
  box-shadow: 0 2px 10px rgba(0,0,0,0.04);
}
.ak-batch-date {
  font-size: 16px;
  font-weight: 800;
  color: var(--ak-navy);
  margin-bottom: 6px;
}
.ak-batch-name {
  font-size: 13.5px;
  font-weight: 700;
  color: var(--ak-text-muted);
  margin-bottom: 12px;
}
.ak-batch-venue {
  font-size: 13px;
  color: var(--ak-text-main);
  line-height: 1.5;
  margin-bottom: 16px;
  flex-grow: 1;
}

/* City Grid */
.ak-city-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(170px, 1fr));
  gap: 12px;
}
.ak-city-item {
  background: #FFFFFF;
  border: 1px solid var(--ak-border);
  padding: 12px 14px;
  border-radius: 8px;
  font-size: 13.5px;
  font-weight: 700;
  color: var(--ak-navy);
  text-decoration: none;
  display: flex;
  align-items: center;
  justify-content: space-between;
  transition: all 0.15s ease;
}
.ak-city-item:hover {
  background: var(--ak-navy);
  color: #FFFFFF !important;
  border-color: var(--ak-navy);
}

/* FAQ Accordion */
.ak-faq-list {
  max-width: 820px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  gap: 12px;
}
.ak-faq-item {
  background: #FFFFFF;
  border: 1.5px solid var(--ak-border);
  border-radius: 10px;
  overflow: hidden;
}
.ak-faq-item details summary {
  padding: 18px 22px;
  font-size: 15.5px;
  font-weight: 700;
  color: var(--ak-navy-dark);
  cursor: pointer;
  list-style: none;
  display: flex;
  justify-content: space-between;
  align-items: center;
  user-select: none;
}
.ak-faq-item details summary::-webkit-details-marker {
  display: none;
}
.ak-faq-item details summary::after {
  content: '+';
  font-size: 20px;
  font-weight: 700;
  color: var(--ak-navy);
}
.ak-faq-item details[open] summary::after {
  content: '−';
}
.ak-faq-content {
  padding: 0 22px 20px;
  font-size: 14.5px;
  color: var(--ak-text-muted);
  line-height: 1.7;
}

/* Bottom CTA Strip */
.ak-cta-strip {
  background: linear-gradient(135deg, var(--ak-navy-dark) 0%, var(--ak-navy) 100%);
  color: #FFFFFF;
  padding: 56px 0;
  text-align: center;
}
.ak-cta-strip h2 {
  font-size: clamp(1.8rem, 3.5vw, 2.6rem);
  font-weight: 800;
  margin-bottom: 14px;
}
.ak-cta-strip p {
  font-size: 16px;
  color: #E2E8F0;
  max-width: 680px;
  margin: 0 auto 28px;
}
</style>

<!-- ═══════════════ HERO SECTION ═══════════════ -->
<section class="ak-hero">
  <div class="container ak-hero-inner">
    <div class="ak-eyebrow">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>
      PJK3 Resmi Kemnaker RI · BNSP · Vendor LPSE
    </div>
    <h1 class="ak-hero-title">
      Pelatihan &amp; Sertifikasi <em>Ahli K3 Umum (AK3U)</em><br>
      Kemnaker RI &amp; BNSP <?= $year ?>
    </h1>
    <p class="ak-hero-sub">
      Pusat resmi pembinaan calon Ahli K3 Umum berlisensi Kementerian Ketenagakerjaan RI dan uji kompetensi profesi BNSP. 
      Tersedia kelas <strong>Online Blended via Zoom</strong>, <strong>Tatap Muka Yogyakarta</strong>, <strong>Jalur Khusus Fresh Graduate</strong>, 
      hingga <strong>In-House Training Perusahaan</strong> dengan garansi kelulusan dan pendampingan pasca-pelatihan.
    </p>

    <div class="ak-hero-actions">
      <a href="<?= wa_url($wa_hero_msg, $wa_number) ?>" class="ak-btn-primary" target="_blank" rel="noopener">
        <svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
        <span>Konsultasi Pendaftaran WhatsApp</span>
      </a>
      <a href="#jadwal" class="ak-btn-secondary">
        <span>Lihat Jadwal &amp; Biaya <?= $year ?> &darr;</span>
      </a>
    </div>

    <div class="ak-trust-badges">
      <div class="ak-badge-item">
        <span class="ak-badge-icon">📜</span>
        <div class="ak-badge-text">
          <strong>SK Kemnaker RI</strong>
          <span>No. Kep. 312/BINWASPNAK-PNK3/V/2020</span>
        </div>
      </div>
      <div class="ak-badge-item">
        <span class="ak-badge-icon">🦅</span>
        <div class="ak-badge-text">
          <strong>Sertifikasi BNSP</strong>
          <span>Garuda Emas Standar SKKNI</span>
        </div>
      </div>
      <div class="ak-badge-item">
        <span class="ak-badge-icon">👥</span>
        <div class="ak-badge-text">
          <strong>12.000+ Alumni K3</strong>
          <span>Tersebar di BUMN &amp; Multinasional</span>
        </div>
      </div>
      <div class="ak-badge-item">
        <span class="ak-badge-icon">🏛️</span>
        <div class="ak-badge-text">
          <strong>Penyedia Resmi LPSE</strong>
          <span>Siap SPK &amp; Pengadaan B2G</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════ 6-TRACK PROGRAM SELECTOR ═══════════════ -->
<section class="ak-section" id="jalur">
  <div class="container">
    <div class="ak-header-box">
      <span class="ak-kicker">Pilihan Jalur Sertifikasi</span>
      <h2 class="ak-title">Pilih Jalur Ahli K3 Umum yang Tepat untuk Kebutuhan Anda</h2>
      <p class="ak-desc">
        Setiap peserta memiliki target karir dan kebutuhan industri yang berbeda. 
        Wahana Totalita menyediakan 6 pilihan jalur komprehensif dengan legalitas resmi pemerintah.
      </p>
    </div>

    <div class="ak-track-grid">
      <!-- Track 1: Kemnaker Blended -->
      <article class="ak-track-card">
        <span class="ak-track-pill ak-pill-popular">Paling Diminati</span>
        <h3 class="ak-track-title">AK3U Kemnaker RI (Online Blended)</h3>
        <p class="ak-track-body">
          Pembinaan 12 hari melalui Zoom interaktif dengan pengawas Kemnaker RI. Efisien tanpa meninggalkan domisili, dengan ujian negara dan PKL online.
        </p>
        <ul class="ak-track-features">
          <li><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg> SKP &amp; Lisensi K3 Kemnaker RI</li>
          <li><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg> Durasi 12 Hari Kerja via Zoom</li>
          <li><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg> Termasuk Seminar Kit &amp; Modul Kirim Fisik</li>
        </ul>
        <a href="/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri/" class="ak-track-btn">
          <span>Lihat Detail Program &rarr;</span>
        </a>
      </article>

      <!-- Track 2: Kemnaker Offline -->
      <article class="ak-track-card">
        <span class="ak-track-pill ak-pill-offline">Tatap Muka Intensif</span>
        <h3 class="ak-track-title">AK3U Kemnaker RI (Offline Yogyakarta)</h3>
        <p class="ak-track-body">
          Pelaksanaan tatap muka di Yogyakarta dengan kunjungan praktik kerja lapangan (PKL) langsung ke pabrik/industri mitra untuk pengalaman audit nyata.
        </p>
        <ul class="ak-track-features">
          <li><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg> PKL Nyata di Pabrik Manufaktur</li>
          <li><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg> Lunch, Coffee Break &amp; Akomodasi</li>
          <li><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg> Bimbingan Tatap Muka Instruktur Senior</li>
        </ul>
        <a href="/pelatihan/pelatihan-ahli-k3-umum-kemnaker-offline/" class="ak-track-btn">
          <span>Lihat Detail Offline &rarr;</span>
        </a>
      </article>

      <!-- Track 3: BNSP Online -->
      <article class="ak-track-card">
        <span class="ak-track-pill ak-pill-bnsp">Sertifikasi Profesi</span>
        <h3 class="ak-track-title">Ahli K3 Umum Sertifikasi BNSP</h3>
        <p class="ak-track-body">
          Uji kompetensi berbasis SKKNI nasional berlogo Garuda Emas. Fokus pada pembuktian portofolio keahlian kerja bagi praktisi HSE dan syarat tender BUMN/Migas.
        </p>
        <ul class="ak-track-features">
          <li><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg> Sertifikat Kompetensi Garuda BNSP</li>
          <li><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg> Durasi Singkat (3–4 Hari Efektif)</li>
          <li><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg> Diakui Standar Kerja Regional ASEAN</li>
        </ul>
        <a href="/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-bnsp-online/" class="ak-track-btn">
          <span>Lihat Jalur BNSP &rarr;</span>
        </a>
      </article>

      <!-- Track 4: Fresh Graduate -->
      <article class="ak-track-card">
        <span class="ak-track-pill ak-pill-fresh">Karir Akselerasi</span>
        <h3 class="ak-track-title">Khusus Fresh Graduate D3/S1</h3>
        <p class="ak-track-body">
          Program akselerasi karir bagi lulusan baru D3/S1 tanpa syarat pengalaman kerja. Dilengkapi pembekalan CV review, teknik wawancara HSE, dan simulasi JSA.
        </p>
        <ul class="ak-track-features">
          <li><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg> Tanpa Syarat Pengalaman Kerja</li>
          <li><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg> Biaya Bersahabat dengan Opsi Cicilan</li>
          <li><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg> Akses Jaringan Alumni &amp; Lowongan HSE</li>
        </ul>
        <a href="/ak3u-fresh-graduate/" class="ak-track-btn">
          <span>Pelajari Jalur Fresh Grad &rarr;</span>
        </a>
      </article>

      <!-- Track 5: Corporate In-House -->
      <article class="ak-track-card">
        <span class="ak-track-pill ak-pill-corp">Perusahaan / B2B</span>
        <h3 class="ak-track-title">In-House Training Perusahaan</h3>
        <p class="ak-track-body">
          Pelatihan massal staf/manajemen K3 di lokasi perusahaan Anda di seluruh Indonesia. Jadwal fleksibel, kurikulum disesuaikan potensi bahaya spesifik pabrik.
        </p>
        <ul class="ak-track-features">
          <li><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg> Efisiensi Biaya per Peserta (Grup 10+)</li>
          <li><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg> Studi Kasus &amp; Audit Hazard Internal</li>
          <li><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg> Fasilitasi Pembentukan Komite P2K3</li>
        </ul>
        <a href="/in-house-training/" class="ak-track-btn">
          <span>Minta Proposal In-House &rarr;</span>
        </a>
      </article>

      <!-- Track 6: Perpanjangan SKP -->
      <article class="ak-track-card">
        <span class="ak-track-pill ak-pill-renew">Reaktivasi Lisensi</span>
        <h3 class="ak-track-title">Perpanjangan SKP &amp; Lisensi K3</h3>
        <p class="ak-track-body">
          Lisensi atau SKP Ahli K3 Umum Anda sudah lewat dari masa 3 tahun? Kami memproses perpanjangan resmi Kemnaker RI secara cepat, aman, dan tanpa tes ulang.
        </p>
        <ul class="ak-track-features">
          <li><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg> Proses Resmi PJK3 Kemnaker RI</li>
          <li><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg> Tanpa Mengulang Pelatihan 12 Hari</li>
          <li><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg> Pengurusan Berkas Pindah Perusahaan</li>
        </ul>
        <a href="/perpanjangan-skp/" class="ak-track-btn">
          <span>Perpanjang SKP Sekarang &rarr;</span>
        </a>
      </article>
    </div>
  </div>
</section>

<!-- ═══════════════ PRICING & TRANSPARENCY MATRIX ═══════════════ -->
<section class="ak-section ak-section-alt" id="biaya">
  <div class="container">
    <div class="ak-header-box">
      <span class="ak-kicker">Transparansi Investasi Pelatihan</span>
      <h2 class="ak-title">Berapa Biaya Pelatihan Ahli K3 Umum <?= $year ?>?</h2>
      <p class="ak-desc">
        Wahana Totalita menerapkan kebijakan harga all-in transparan tanpa pungutan liar tersembunyi. 
        Seluruh sertifikat, lisensi, lencana, modul, dan administrasi Kemnaker RI sudah termasuk dalam paket.
      </p>
    </div>

    <div class="ak-price-grid">
      <div class="ak-price-card featured">
        <span class="ak-ribbon">Rekomendasi</span>
        <h3>Kemnaker RI Blended Online</h3>
        <div class="ak-price-num">Rp 6.950.000 <small>/peserta</small></div>
        <p class="ak-price-desc">
          Format paling fleksibel. Belajar via Zoom 12 hari, PKL online, ujian resmi, gratis ongkir pengiriman berkas &amp; seminar kit ke rumah.
        </p>
        <a href="<?= wa_url($wa_price_msg, $wa_number) ?>" class="ak-track-btn" target="_blank" rel="noopener">Minta Rincian Biaya WA</a>
      </div>

      <div class="ak-price-card">
        <h3>Kemnaker RI Tatap Muka (Jogja)</h3>
        <div class="ak-price-num">Rp 8.500.000 <small>/peserta</small></div>
        <p class="ak-price-desc">
          Kelas tatap muka eksklusif di Yogyakarta. Termasuk lunch, 2x coffee break, kunjungan pabrik industri nyata, dan modul cetak hardcopy.
        </p>
        <a href="<?= wa_url($wa_price_msg, $wa_number) ?>" class="ak-track-btn" target="_blank" rel="noopener">Cek Kuota Offline</a>
      </div>

      <div class="ak-price-card">
        <h3>Sertifikasi BNSP Online</h3>
        <div class="ak-price-num">Rp 4.750.000 <small>/peserta</small></div>
        <p class="ak-price-desc">
          Uji portofolio kompetensi 3–4 hari untuk praktisi K3 berpengalaman. Sertifikat resmi BNSP berlogo Garuda Emas diakui nasional &amp; ASEAN.
        </p>
        <a href="<?= wa_url($wa_price_msg, $wa_number) ?>" class="ak-track-btn" target="_blank" rel="noopener">Daftar Jalur BNSP</a>
      </div>

      <div class="ak-price-card">
        <h3>In-House Perusahaan (B2B)</h3>
        <div class="ak-price-num">Custom RAB <small>/rombongan</small></div>
        <p class="ak-price-desc">
          Investasi lebih hemat untuk perusahaan (minimal 10–20 staf). Instruktur kami hadir langsung di lokasi site/kantor Anda di seluruh Indonesia.
        </p>
        <a href="<?= wa_url($wa_inhouse_msg, $wa_number) ?>" class="ak-track-btn" target="_blank" rel="noopener">Minta Penawaran RAB</a>
      </div>
    </div>

    <!-- What's Included Box -->
    <div class="ak-facilities-box">
      <h3 class="ak-facilities-title">Fasilitas Resmi yang Anda Dapatkan (All-in Tanpa Biaya Tambahan):</h3>
      <div class="ak-facilities-grid">
        <div class="ak-facility-item">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
          <span>Sertifikat Pembinaan Calon Ahli K3 Umum Resmi dari Kementerian Ketenagakerjaan RI</span>
        </div>
        <div class="ak-facility-item">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
          <span>Surat Keputusan Penunjukan (SKP) &amp; Kartu Lisensi Kewenangan Ahli K3 (Masa Berlaku 3 Tahun)</span>
        </div>
        <div class="ak-facility-item">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
          <span>Buku Himpunan Peraturan Perundangan K3 RI &amp; Modul Pembinaan Lengkap Hardcopy/Softcopy</span>
        </div>
        <div class="ak-facility-item">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
          <span>Exclusive Safety Kit: Rompi HSE Pro, Lencana Pin Ahli K3, Topi, Notebook, &amp; Tas Diklat</span>
        </div>
        <div class="ak-facility-item">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
          <span>Bimbingan Intensif Pembuatan Laporan PKL &amp; Simulasi Ujian Evaluasi hingga LULUS</span>
        </div>
        <div class="ak-facility-item">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
          <span>Gratis Pengiriman Seluruh Dokumen Kelulusan ke Alamat Rumah Anda di Seluruh Indonesia</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════ SYARAT & KETENTUAN ═══════════════ -->
<section class="ak-section" id="syarat">
  <div class="container">
    <div class="ak-header-box">
      <span class="ak-kicker">Kriteria &amp; Berkas Administrasi</span>
      <h2 class="ak-title">Persyaratan Mengikuti Pelatihan Ahli K3 Umum</h2>
      <p class="ak-desc">
        Ketahui ketentuan kualifikasi pendidikan dan berkas administrasi yang wajib dipersiapkan sebelum pendaftaran diverifikasi oleh pengawas ketenagakerjaan.
      </p>
    </div>

    <div class="ak-syarat-grid">
      <!-- Card 1: Pendidikan -->
      <div class="ak-syarat-card">
        <h3>
          <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82zM12 3L1 9l11 6 9-4.91V17h2V9L12 3z"/></svg>
          1. Kualifikasi Pendidikan
        </h3>
        <ul class="ak-syarat-list">
          <li>
            <span><strong>Pendidikan Minimal:</strong> D3 / D4 / S1 dari SEMUA JURUSAN. Baik latar belakang Teknik, MIPA, Ekonomi, Hukum, Kesehatan Masyarakat, maupun Sosial Humaniora berhak mengikuti sertifikasi.</span>
          </li>
          <li>
            <span><strong>Fresh Graduate:</strong> Diperbolehkan langsung mendaftar menggunakan Surat Keterangan Lulus (SKL) sementara jika ijazah resmi belum terbit.</span>
          </li>
          <li>
            <span><strong>Pengalaman Kerja:</strong> Tidak diwajibkan memiliki pengalaman kerja K3 untuk mengikuti pembinaan jalur Kemnaker RI.</span>
          </li>
        </ul>
      </div>

      <!-- Card 2: Berkas Dokumen -->
      <div class="ak-syarat-card">
        <h3>
          <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg>
          2. Dokumen yang Dipersiapkan
        </h3>
        <ul class="ak-syarat-list">
          <li>
            <span><strong>Scan Ijazah Terakhir:</strong> Asli atau fotokopi legalisir basah dari perguruan tinggi.</span>
          </li>
          <li>
            <span><strong>Scan KTP:</strong> E-KTP elektronik yang masih berlaku jelas dan tidak buram.</span>
          </li>
          <li>
            <span><strong>Surat Keterangan Sehat:</strong> Dari dokter puskesmas/klinik/rumah sakit yang menyatakan kondisi jasmani sehat.</span>
          </li>
          <li>
            <span><strong>Pas Foto Resmi:</strong> Latar belakang <strong>MERAH</strong> (kemeja berkerah rapi atau jas dasi).</span>
          </li>
          <li>
            <span><strong>Surat Rekomendasi:</strong> Surat tugas/rekomendasi dari perusahaan tempat bekerja (jika jalur utusan instansi) ATAU surat pernyataan bermaterai jika jalur mandiri.</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════ COMPARISON: KEMNAKER VS BNSP ═══════════════ -->
<section class="ak-section ak-section-alt" id="perbedaan">
  <div class="container">
    <div class="ak-header-box">
      <span class="ak-kicker">Panduan Pengambilan Keputusan</span>
      <h2 class="ak-title">Perbedaan Sertifikasi Ahli K3 Umum: Kemnaker RI vs BNSP</h2>
      <p class="ak-desc">
        Bingung memilih antara sertifikasi Kemnaker RI atau BNSP? Simak tabel perbandingan objektif berikut untuk menentukan sertifikat mana yang wajib Anda miliki.
      </p>
    </div>

    <div class="ak-table-wrap">
      <table class="ak-comp-table">
        <thead>
          <tr>
            <th style="width:25%">Parameter Evaluasi</th>
            <th style="width:38%">Sertifikasi Kemnaker RI (Pemerintah)</th>
            <th style="width:37%">Sertifikasi Profesi BNSP</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="dimmed">Dasar Hukum Utama</td>
            <td>UU No. 1 Tahun 1970 &amp; Permenaker No. 02/MEN/1992</td>
            <td>UU No. 13 Tahun 2003 &amp; PP No. 10 Tahun 2018</td>
          </tr>
          <tr>
            <td class="dimmed">Lembaga Penerbit</td>
            <td>Direktorat Bina Wasnak &amp; Pengujian K3, Kementerian Ketenagakerjaan RI</td>
            <td>Badan Nasional Sertifikasi Profesi (BNSP) melalui LSP Terlisensi</td>
          </tr>
          <tr>
            <td class="dimmed">Output Dokumen</td>
            <td>
              &bull; Sertifikat Pembinaan Calon Ahli K3 Umum<br>
              &bull; <strong>Surat Keputusan Penunjukan (SKP)</strong><br>
              &bull; <strong>Kartu Lisensi Kewenangan K3</strong>
            </td>
            <td>
              &bull; <strong>Sertifikat Kompetensi Kerja</strong> berlogo Lambang Negara Garuda Emas
            </td>
          </tr>
          <tr>
            <td class="dimmed">Kewajiban Perusahaan</td>
            <td><strong>Wajib hukum</strong> bagi perusahaan untuk membentuk panitia P2K3 dan audit sertifikasi SMK3 PP 50/2012</td>
            <td>Opsional bagi regulasi wajib, namun sering menjadi syarat mutlak dalam tender BUMN/Migas</td>
          </tr>
          <tr>
            <td class="dimmed">Metode Pembinaan</td>
            <td>Pembinaan materi regulasi intensif 12 hari + PKL industri + Ujian Pengawas Disnaker</td>
            <td>Uji asesmen portofolio pengalaman kerja (3–4 hari) oleh asesor kompetensi BNSP</td>
          </tr>
          <tr>
            <td class="dimmed">Masa Berlaku</td>
            <td>Sertifikat seumur hidup; Lisensi &amp; SKP berlaku 3 tahun (dapat diperpanjang)</td>
            <td>Sertifikat berlaku 3 tahun (wajib perpanjangan uji asesmen ulang)</td>
          </tr>
          <tr>
            <td class="dimmed">Kesimpulan Pilihan</td>
            <td><strong>Pilihan Utama</strong> jika Anda bertugas sebagai penanggung jawab K3 resmi di perusahaan atau butuh lisensi hukum Disnaker.</td>
            <td><strong>Pilihan Tepat</strong> jika Anda praktisi yang membutuhkan pengakuan portofolio standar profesi internasional &amp; tender proyek.</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- ═══════════════ UPCOMING BATCHES ═══════════════ -->
<section class="ak-section" id="jadwal">
  <div class="container">
    <div class="ak-header-box">
      <span class="ak-kicker">Konfirmasi Jadwal Terdekat</span>
      <h2 class="ak-title">Jadwal Pelatihan Ahli K3 Umum Terbaru <?= $year ?></h2>
      <p class="ak-desc">
        Pendaftaran dibuka untuk gelombang batch terdekat. Kuota dibatasi maksimal 30 peserta per kelas demi menjamin efektivitas interaksi pembinaan.
      </p>
    </div>

    <div class="ak-batch-grid">
      <?php foreach ($ak3u_batches as $b): ?>
      <div class="ak-batch-card">
        <span class="ak-track-pill ak-pill-popular" style="margin-bottom:8px">Pendaftaran Dibuka</span>
        <div class="ak-batch-date">
          <?= date('d M Y', strtotime($b['start_date'])) ?> &ndash; <?= !empty($b['end_date']) && $b['end_date'] !== '0000-00-00' ? date('d M Y', strtotime($b['end_date'])) : 'Selesai' ?>
        </div>
        <div class="ak-batch-name"><?= e($b['batch_name'] ?? 'Batch Pelatihan Ahli K3 Umum') ?></div>
        <div class="ak-batch-venue">
          <strong>Lokasi / Mode:</strong><br>
          <?= e($b['venue'] ?? 'Online Zoom Interaktif') ?>
        </div>
        <a href="<?= wa_url("Halo Wahana Totalita, saya ingin daftar/konfirmasi kuota untuk: {$b['batch_name']} tanggal " . date('d M Y', strtotime($b['start_date'])), $wa_number) ?>" 
           class="ak-track-btn" target="_blank" rel="noopener">
          <span>Daftar Batch Ini &rarr;</span>
        </a>
      </div>
      <?php endforeach; ?>
    </div>

    <div style="text-align:center;margin-top:32px;">
      <a href="/jadwal/" style="font-weight:700;color:var(--ak-navy);text-decoration:none;font-size:15px">
        Lihat Kalender Lengkap Semua Jadwal Pelatihan K3 &rarr;
      </a>
    </div>
  </div>
</section>

<!-- ═══════════════ CITY CROSS LINKS ═══════════════ -->
<section class="ak-section ak-section-alt">
  <div class="container">
    <div class="ak-header-box" style="margin-bottom:28px">
      <span class="ak-kicker">Jangkauan Layanan Nasional</span>
      <h2 class="ak-title">Pelatihan Ahli K3 Umum Tersedia di Kota Anda</h2>
      <p class="ak-desc">
        Wahana Totalita menyelenggarakan pelatihan Ahli K3 Umum kelas online dari seluruh Indonesia, 
        serta in-house corporate training di berbagai pusat industri nasional:
      </p>
    </div>

    <div class="ak-city-grid">
      <a href="/pelatihan-k3-yogyakarta/" class="ak-city-item"><span>Yogyakarta (Pusat)</span> <span>&rarr;</span></a>
      <a href="/pelatihan-k3-jakarta/" class="ak-city-item"><span>DKI Jakarta</span> <span>&rarr;</span></a>
      <a href="/pelatihan-k3-surabaya/" class="ak-city-item"><span>Surabaya</span> <span>&rarr;</span></a>
      <a href="/pelatihan-k3-bandung/" class="ak-city-item"><span>Bandung</span> <span>&rarr;</span></a>
      <a href="/pelatihan-k3-semarang/" class="ak-city-item"><span>Semarang</span> <span>&rarr;</span></a>
      <a href="/pelatihan-k3-cilegon/" class="ak-city-item"><span>Cilegon (Baja/Kimia)</span> <span>&rarr;</span></a>
      <a href="/pelatihan-k3-karawang/" class="ak-city-item"><span>Karawang (Manufaktur)</span> <span>&rarr;</span></a>
      <a href="/pelatihan-k3-balikpapan/" class="ak-city-item"><span>Balikpapan &amp; IKN</span> <span>&rarr;</span></a>
      <a href="/pelatihan-k3-samarinda/" class="ak-city-item"><span>Samarinda (Tambang)</span> <span>&rarr;</span></a>
      <a href="/pelatihan-k3-medan/" class="ak-city-item"><span>Medan</span> <span>&rarr;</span></a>
      <a href="/pelatihan-k3-makassar/" class="ak-city-item"><span>Makassar</span> <span>&rarr;</span></a>
      <a href="/pelatihan-k3-batam/" class="ak-city-item"><span>Batam (Galangan)</span> <span>&rarr;</span></a>
      <a href="/pelatihan-k3-solo/" class="ak-city-item"><span>Solo Surakarta</span> <span>&rarr;</span></a>
      <a href="/pelatihan-k3-malang/" class="ak-city-item"><span>Malang Raya</span> <span>&rarr;</span></a>
      <a href="/pelatihan-k3-denpasar/" class="ak-city-item"><span>Bali Denpasar</span> <span>&rarr;</span></a>
      <a href="/pelatihan-k3-palembang/" class="ak-city-item"><span>Palembang</span> <span>&rarr;</span></a>
    </div>
  </div>
</section>

<!-- ═══════════════ FREQUENTLY ASKED QUESTIONS (FAQ) ═══════════════ -->
<section class="ak-section" id="faq">
  <div class="container">
    <div class="ak-header-box">
      <span class="ak-kicker">Tanya Jawab Populer</span>
      <h2 class="ak-title">Pertanyaan Umum Seputar Pelatihan Ahli K3 Umum</h2>
      <p class="ak-desc">
        Jawaban lengkap atas pertanyaan yang paling sering diajukan calon peserta mengenai sertifikasi, legalitas, dan ujian Ahli K3 Umum.
      </p>
    </div>

    <div class="ak-faq-list">
      <?php foreach ($faqs as $idx => $f): ?>
      <div class="ak-faq-item">
        <details <?= $idx === 0 ? 'open' : '' ?>>
          <summary><?= e($f['q']) ?></summary>
          <div class="ak-faq-content">
            <p><?= e($f['a']) ?></p>
          </div>
        </details>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ═══════════════ BOTTOM CTA STRIP ═══════════════ -->
<section class="ak-cta-strip">
  <div class="container">
    <h2>Amankan Kursi Pelatihan Ahli K3 Umum Anda Hari Ini</h2>
    <p>
      Dapatkan sertifikat resmi Kemnaker RI / BNSP untuk meningkatkan kepatuhan K3 perusahaan dan melesatkan karir profesional Anda. Konsultasikan jadwal dan penawaran khusus via WhatsApp.
    </p>
    <a href="<?= wa_url($wa_hero_msg, $wa_number) ?>" class="ak-btn-primary" target="_blank" rel="noopener">
      <svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
      <span>Hubungi Konsultan Kami Sekarang</span>
    </a>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
