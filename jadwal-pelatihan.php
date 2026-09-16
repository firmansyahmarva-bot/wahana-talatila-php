<?php
/**
 * Schedule page - DB-DRIVEN: rows come from training_batches, managed in
 * Admin -> Pelatihan -> Jadwal Batch. Add/edit batches there; they appear here.
 */
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/jadwal-functions.php';
$s = get_all_settings();

$wa_number = '6287872688794';
$wa_link   = "https://wa.me/{$wa_number}?text=" . rawurlencode('Halo, saya ingin cek jadwal pelatihan bulan ini');
$year      = date('Y');
$gtm_id    = 'GTM-MMZHD3HN';

function wt_date_range(string $start, string $end): string {
    $m = ['','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'];
    $s = strtotime($start); $e = strtotime($end ?: $start);
    $sd=(int)date('j',$s); $sm=(int)date('n',$s); $sy=date('Y',$s);
    $ed=(int)date('j',$e); $em=(int)date('n',$e); $ey=date('Y',$e);
    if ($s === $e) return "$sd {$m[$sm]} $sy";
    if ($sm === $em && $sy === $ey) return "$sd-$ed {$m[$sm]} $sy";
    if ($sy === $ey) return "$sd {$m[$sm]}-$ed {$m[$em]} $sy";
    return "$sd {$m[$sm]} $sy - $ed {$m[$em]} $ey";
}

$schedules = [];
foreach (get_public_schedules(['upcoming' => 1, 'limit' => 100]) as $b) {
    $isOnline = $b['mode'] === 'online';
    $schedules[] = [
        wt_date_range($b['start_date'], $b['end_date']),
        $b['batch_name'] ?: $b['training_name'],
        $b['certification'] ?: 'BNSP',
        $isOnline ? '' : ($b['location'] ?: 'Yogyakarta'),
        $isOnline ? 'Online' : 'Tatap Muka',
        max(0, (int)$b['seats_left']),
        $b['training_slug'],
        (int)$b['id'],
        date('Y-m', strtotime($b['start_date'])),
    ];
}

// Keep the initial page compact: show the first three available months.
// Later batches remain in the HTML and can be revealed with one button.
$visibleMonths = [];
foreach ($schedules as $r) {
    if (!in_array($r[8], $visibleMonths, true)) $visibleMonths[] = $r[8];
    if (count($visibleMonths) === 3) break;
}
$extraBatchCount = count(array_filter($schedules, fn($r) => !in_array($r[8], $visibleMonths, true)));

// Derived list of distinct trainings (from the schedules already fetched above)
// used purely for the "Program Pelatihan Populer" section below. No new query,
// no invented data — just a dedupe of what get_public_schedules() returned.
$popularPrograms = [];
foreach ($schedules as $r) {
    $slug = $r[6];
    if ($slug && !isset($popularPrograms[$slug])) {
        $popularPrograms[$slug] = [
            'name' => $r[1],
            'cert' => $r[2],
        ];
    }
    if (count($popularPrograms) >= 6) break;
}

$faqs = [
    [
        'q' => 'Bagaimana cara mendaftar pelatihan di Wahana Totalita?',
        'a' => 'Pilih jadwal yang sesuai pada tabel di atas, klik tombol "Daftar", lalu lengkapi konfirmasi melalui WhatsApp. Tim kami akan mengirimkan detail program, biaya, dan langkah pembayaran setelah data Anda kami terima.'
    ],
    [
        'q' => 'Apakah jadwal pelatihan bisa berubah setelah saya mendaftar?',
        'a' => 'Bisa, meskipun jarang terjadi. Perubahan biasanya dipicu oleh kuota peserta, ketersediaan asesor atau instruktur, penyesuaian jadwal dari lembaga sertifikasi, hari libur nasional, atau kondisi operasional lain. Jika terjadi perubahan, kami akan menghubungi peserta terdaftar lebih dulu.'
    ],
    [
        'q' => 'Apa perbedaan sertifikasi Kemnaker RI dan BNSP?',
        'a' => 'Sertifikasi Kemnaker RI diterbitkan oleh Kementerian Ketenagakerjaan dan umumnya berlaku untuk kompetensi teknis K3 seperti Ahli K3 Umum, operator, atau teknisi. Sertifikasi BNSP diterbitkan oleh Badan Nasional Sertifikasi Profesi melalui skema kompetensi kerja nasional. Keduanya diakui secara resmi, namun skema, proses asesmen, dan cakupan bidangnya berbeda — tim kami dapat membantu menentukan mana yang sesuai dengan kebutuhan pekerjaan Anda.'
    ],
    [
        'q' => 'Apa bedanya public training dan in-house training?',
        'a' => 'Public training diikuti peserta dari berbagai perusahaan dalam satu batch dengan jadwal dan lokasi yang sudah ditentukan. In-house training diselenggarakan khusus untuk internal satu perusahaan, dengan jadwal, lokasi, dan materi yang bisa disesuaikan kebutuhan industri Anda, biasanya untuk minimal 10 peserta.'
    ],
    [
        'q' => 'Apakah pelatihan online sama efektifnya dengan tatap muka?',
        'a' => 'Untuk materi yang bersifat regulasi, manajemen risiko, dan teori K3, pelatihan online cukup efektif dan lebih fleksibel dari sisi waktu dan lokasi. Namun untuk kompetensi yang membutuhkan praktik langsung dengan alat atau simulasi lapangan, kelas tatap muka lebih disarankan.'
    ],
    [
        'q' => 'Berapa lama proses sertifikasi setelah pelatihan selesai?',
        'a' => 'Setelah pelatihan dan asesmen selesai, waktu penerbitan sertifikat mengikuti proses masing-masing lembaga sertifikasi (Kemnaker RI, BNSP, atau KLHK). Tim kami akan menginformasikan estimasi waktu dan status penerbitan sertifikat kepada peserta.'
    ],
    [
        'q' => 'Apakah biaya pelatihan sudah termasuk sertifikasi?',
        'a' => 'Rincian biaya berbeda untuk setiap program. Silakan konfirmasi ke tim kami melalui WhatsApp untuk mendapatkan rincian biaya pelatihan dan sertifikasi pada program yang Anda minati.'
    ],
    [
        'q' => 'Apakah saya bisa memindahkan jadwal jika berhalangan hadir?',
        'a' => 'Bisa. Hubungi tim kami sesegera mungkin melalui WhatsApp agar peserta dapat dipindahkan ke batch berikutnya, mengikuti ketersediaan kuota pada jadwal tujuan.'
    ],
    [
        'q' => 'Apa saja dokumen yang perlu disiapkan sebelum pelatihan?',
        'a' => 'Umumnya peserta perlu menyiapkan KTP, pas foto, dan dokumen pendukung sesuai persyaratan masing-masing skema sertifikasi. Detail lengkap akan kami kirimkan setelah pendaftaran dikonfirmasi.'
    ],
    [
        'q' => 'Apakah pelatihan ini bisa diikuti perusahaan maupun individu?',
        'a' => 'Bisa keduanya. Kami melayani peserta individu yang mendaftar mandiri melalui jadwal public training, maupun perusahaan yang ingin mengirimkan beberapa karyawan sekaligus atau menyelenggarakan in-house training.'
    ],
    [
        'q' => 'Apakah tersedia pelatihan untuk level operator, teknisi, dan supervisor?',
        'a' => 'Ya. Program kami mencakup berbagai jenjang kompetensi K3, mulai dari operator, teknisi, hingga supervisor dan Ahli K3, disesuaikan dengan kebutuhan peran dan tanggung jawab di tempat kerja.'
    ],
    [
        'q' => 'Kota mana saja yang dilayani untuk pelatihan tatap muka?',
        'a' => 'Kami melayani pelatihan tatap muka di berbagai kota besar di Indonesia, dengan Yogyakarta sebagai salah satu lokasi utama. Untuk in-house training, kami dapat hadir di lokasi perusahaan Anda di seluruh Indonesia.'
    ],
    [
        'q' => 'Bagaimana jika jadwal yang saya inginkan belum tersedia?',
        'a' => 'Hubungi tim kami melalui WhatsApp untuk menanyakan rencana batch berikutnya, atau ajukan kebutuhan in-house training dengan jadwal yang lebih fleksibel sesuai kesiapan perusahaan Anda.'
    ],
];
?><!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Jadwal Pelatihan K3 & Sertifikasi <?=$year?> – Wahana Totalita Konsultan</title>
<meta name="description" content="Jadwal lengkap pelatihan K3 dan sertifikasi KEMNAKER RI, BNSP, KLHK tahun <?=$year?>. Pilih program, tanggal, dan kota sesuai kebutuhan Anda. Diperbarui setiap bulan.">
<link rel="canonical" href="https://wahanatotalita.com/jadwal/">
<meta property="og:type"        content="website">
<meta property="og:title"       content="Jadwal Pelatihan K3 <?=$year?> | Wahana Totalita">
<meta property="og:description" content="Jadwal pelatihan K3 dan sertifikasi KEMNAKER RI, BNSP, KLHK <?=$year?>. Update bulanan.">
<meta property="og:url"         content="https://wahanatotalita.com/jadwal/">
<meta property="og:image"       content="https://wahanatotalita.com/assets/img/favicon-512.png">
<meta property="og:locale"      content="id_ID">
<meta name="twitter:card"       content="summary_large_image">
<meta name="robots"             content="index,follow">
<meta name="theme-color"        content="#0A4A2E">
<link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon-32.png">
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','<?=$gtm_id?>');</script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/base.css">
<link rel="stylesheet" href="/assets/css/components.css">
<script type="application/ld+json">
<?php
$faqSchema = [
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => array_map(function ($f) {
        return [
            '@type' => 'Question',
            'name'  => $f['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text'  => $f['a'],
            ],
        ];
    }, $faqs),
];
$batchListSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'ItemList',
    'name' => 'Jadwal Pelatihan K3 Wahana Totalita',
    'numberOfItems' => count($schedules),
    'itemListElement' => array_map(fn($r, $i) => [
        '@type' => 'ListItem',
        'position' => $i + 1,
        'name' => strip_tags($r[1]),
        'url' => SITE_URL . '/jadwal/' . $r[7] . '/',
    ], $schedules, array_keys($schedules)),
];
echo json_encode([$faqSchema, $batchListSchema], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
?>
</script>
<style>
*{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{
  font-family:'Plus Jakarta Sans',sans-serif;
  color:#16241d;
  line-height:1.6;
  background:
    radial-gradient(circle at 8% 0%, rgba(16,163,105,.16), transparent 45%),
    radial-gradient(circle at 95% 12%, rgba(37,211,102,.14), transparent 40%),
    radial-gradient(circle at 50% 90%, rgba(10,74,46,.10), transparent 45%),
    #f4f8f6;
  background-attachment:fixed;
}
a{text-decoration:none}
.container{max-width:1100px;margin:0 auto;padding:0 24px}

/* glass base */
.table-wrap,.tab,.notice-bar,.inhouse .container>div:first-child,
.btn-primary,.btn-dark,.btn-daftar,.btn-inhouse{
  backdrop-filter:blur(14px) saturate(160%);
  -webkit-backdrop-filter:blur(14px) saturate(160%);
}

.page-hero{padding:calc(var(--nav-h,72px) + 56px) 0 44px}
.page-hero h1{font-family:'Sora',sans-serif;font-size:clamp(28px,4vw,46px);font-weight:800;margin:0 0 14px;color:#062E1C;letter-spacing:-.02em}
.page-hero p{font-size:17px;color:#3d4d45;margin:0 0 26px;max-width:700px}
.hero-btns{display:flex;flex-wrap:wrap;gap:12px}
.btn-primary{background:rgba(37,211,102,.92);color:#fff;padding:13px 26px;border-radius:12px;font-weight:700;font-size:15px;border:1px solid rgba(255,255,255,.35);box-shadow:0 6px 18px rgba(37,211,102,.3);transition:transform .15s}
.btn-primary:hover{transform:translateY(-1px)}
.btn-dark{background:rgba(10,74,46,.85);color:#fff;padding:13px 26px;border-radius:12px;font-weight:600;font-size:15px;border:1px solid rgba(255,255,255,.15);box-shadow:0 6px 18px rgba(10,74,46,.25);transition:transform .15s}
.btn-dark:hover{transform:translateY(-1px)}

.notice-bar{
  background:rgba(255,251,235,.55);
  border-top:1px solid rgba(253,230,138,.6);
  border-bottom:1px solid rgba(253,230,138,.6);
  padding:12px 0;font-size:14px;color:#78350f;
}
.notice-bar a{color:#92400e;font-weight:700}

.schedule-section{padding:56px 0}
.filter-tabs{display:flex;flex-wrap:wrap;gap:10px;margin-bottom:26px}
.tab{
  padding:9px 20px;border-radius:999px;
  border:1px solid rgba(255,255,255,.6);
  background:rgba(255,255,255,.45);
  color:#2b3a33;cursor:pointer;font-size:14px;font-family:inherit;font-weight:500;
  box-shadow:0 2px 10px rgba(6,46,28,.05);
  transition:all .2s;
}
.tab.active,.tab:hover{background:rgba(10,74,46,.88);color:#fff;border-color:rgba(10,74,46,.88)}

.table-wrap{
  overflow-x:auto;border-radius:20px;
  background:rgba(255,255,255,.55);
  border:1px solid rgba(255,255,255,.6);
  box-shadow:0 8px 32px rgba(6,46,28,.08);
}
table{width:100%;border-collapse:collapse;font-size:14px}
thead th{background:rgba(6,46,28,.88);color:#fff;padding:14px;text-align:left;font-weight:600;font-family:'Sora',sans-serif;font-size:13px;letter-spacing:.02em}
tbody td{padding:14px;border-bottom:1px solid rgba(6,46,28,.08);vertical-align:middle}
tbody tr:hover td{background:rgba(255,255,255,.5)}
tbody tr:last-child td{border-bottom:none}
.badge{display:inline-block;font-size:11px;padding:3px 9px;border-radius:12px;font-weight:600}
.badge-cert{background:rgba(16,163,105,.14);color:#0A4A2E}
.badge-online{background:rgba(59,130,246,.14);color:#1e40af;margin-left:6px}
.badge-tatap{background:rgba(249,115,22,.14);color:#c2410c;margin-left:6px}
.badge-low{background:rgba(239,68,68,.14);color:#b91c1c;font-weight:700}
.badge-ok{background:rgba(34,197,94,.14);color:#166534}
.btn-daftar{background:rgba(37,211,102,.92);color:#fff;padding:7px 16px;border-radius:10px;font-size:13px;font-weight:600;white-space:nowrap;border:1px solid rgba(255,255,255,.35)}
.batch-link{display:inline-block;color:#075b38;font-weight:800;text-decoration:none;padding:3px 8px 3px 0;border-radius:7px;transition:color .2s,background .2s,transform .2s}
.batch-link:hover{color:#06482d;background:rgba(16,163,105,.10);transform:translateX(3px)}
.batch-link::after{content:'›';display:inline-grid;place-items:center;width:20px;height:20px;margin-left:7px;border-radius:50%;background:#d9f5e7;color:#075b38;font-size:18px;line-height:1;vertical-align:-2px}
.show-batches-wrap{text-align:center;margin-top:22px}
.show-batches-btn{border:1px solid rgba(10,74,46,.22);background:#fff;color:#075b38;border-radius:12px;padding:12px 22px;font:700 14px 'Plus Jakarta Sans',sans-serif;cursor:pointer;box-shadow:0 5px 18px rgba(6,46,28,.09)}
.show-batches-btn:hover{background:#075b38;color:#fff}
[hidden]{display:none!important}

.inhouse{padding:64px 0}
.inhouse .container{display:grid;grid-template-columns:1fr auto;gap:40px;align-items:center}
.inhouse .container>div:first-child{
  background:rgba(255,255,255,.5);
  border:1px solid rgba(255,255,255,.6);
  border-radius:20px;padding:28px 32px;
  box-shadow:0 8px 32px rgba(6,46,28,.06);
}
.inhouse h2{font-family:'Sora',sans-serif;font-size:clamp(22px,3vw,30px);font-weight:800;margin:0 0 12px;color:#062E1C;letter-spacing:-.01em}
.inhouse p{color:#3d4d45;font-size:16px;line-height:1.7}
.btn-inhouse{background:rgba(10,74,46,.88);color:#fff;padding:17px 30px;border-radius:14px;font-weight:700;font-size:16px;display:block;text-align:center;white-space:nowrap;border:1px solid rgba(255,255,255,.2);box-shadow:0 8px 24px rgba(10,74,46,.28);transition:transform .15s}
.btn-inhouse:hover{transform:translateY(-1px)}

.breadcrumb{list-style:none;display:flex;gap:8px;padding:0;margin-bottom:18px;font-size:13px;color:#5b6b62}
.breadcrumb a{color:#0A4A2E}
footer-note{display:block;text-align:center;margin:24px 0 0;font-size:14px;color:#888}
@media(max-width:700px){
  thead{display:none}
  tbody tr{display:block;margin-bottom:16px;border:1px solid rgba(6,46,28,.1);border-radius:16px;padding:14px;background:rgba(255,255,255,.4)}
  tbody td{display:block;padding:5px 0;border:none}
  tbody td::before{content:attr(data-label)": ";font-weight:600;color:#3d4d45}
  .inhouse .container{grid-template-columns:1fr}
}

/* --- added content sections (SEO/EEAT enrichment) --- */
.content-section{padding:48px 0}
.content-section h2{font-family:'Sora',sans-serif;font-size:clamp(22px,3vw,30px);font-weight:800;margin:0 0 14px;color:#062E1C;letter-spacing:-.01em}
.content-section > .container > p.lead{color:#3d4d45;font-size:16px;max-width:760px;margin-bottom:28px}
.section-card{
  background:rgba(255,255,255,.5);
  border:1px solid rgba(255,255,255,.6);
  border-radius:20px;padding:28px 32px;
  box-shadow:0 8px 32px rgba(6,46,28,.06);
}
.steps-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(210px,1fr));gap:18px;margin-top:22px}
.step-card{
  background:rgba(255,255,255,.55);border:1px solid rgba(255,255,255,.6);
  border-radius:16px;padding:20px;box-shadow:0 4px 18px rgba(6,46,28,.05);
}
.step-num{
  display:inline-flex;align-items:center;justify-content:center;
  width:30px;height:30px;border-radius:50%;
  background:rgba(10,74,46,.88);color:#fff;font-weight:700;font-size:14px;
  font-family:'Sora',sans-serif;margin-bottom:10px;
}
.step-card h3{font-size:16px;font-weight:700;color:#062E1C;margin-bottom:6px}
.step-card p{font-size:14px;color:#3d4d45}

.option-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:18px;margin-top:22px}
.option-card{
  background:rgba(255,255,255,.55);border:1px solid rgba(255,255,255,.6);
  border-radius:16px;padding:22px;box-shadow:0 4px 18px rgba(6,46,28,.05);
}
.option-card h3{font-family:'Sora',sans-serif;font-size:16px;font-weight:700;color:#0A4A2E;margin-bottom:8px}
.option-card p{font-size:14px;color:#3d4d45}

.reason-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:18px;margin-top:22px}
.reason-card{
  background:rgba(255,255,255,.55);border:1px solid rgba(255,255,255,.6);
  border-radius:16px;padding:20px;box-shadow:0 4px 18px rgba(6,46,28,.05);
}
.reason-card h3{font-size:15px;font-weight:700;color:#062E1C;margin-bottom:6px;display:flex;gap:8px;align-items:center}
.reason-card p{font-size:14px;color:#3d4d45}

.program-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:18px;margin-top:22px}
.program-card{
  background:rgba(255,255,255,.55);border:1px solid rgba(255,255,255,.6);
  border-radius:16px;padding:20px;box-shadow:0 4px 18px rgba(6,46,28,.05);
  transition:transform .15s;display:block;
}
.program-card:hover{transform:translateY(-2px)}
.program-card h3{font-size:16px;font-weight:700;color:#0A4A2E;margin-bottom:6px}
.program-card span{font-size:12px;color:#5b6b62}

.faq-list{margin-top:22px;display:flex;flex-direction:column;gap:12px}
.faq-item{
  background:rgba(255,255,255,.55);border:1px solid rgba(255,255,255,.6);
  border-radius:14px;padding:4px 20px;box-shadow:0 4px 18px rgba(6,46,28,.05);
}
.faq-item summary{
  cursor:pointer;list-style:none;padding:16px 0;font-weight:700;color:#062E1C;
  font-size:15px;display:flex;justify-content:space-between;align-items:center;gap:12px;
}
.faq-item summary::-webkit-details-marker{display:none}
.faq-item summary::after{content:'+';font-size:20px;color:#0A4A2E;flex-shrink:0}
.faq-item[open] summary::after{content:'–'}
.faq-item p{padding:0 0 16px;color:#3d4d45;font-size:14px}

.city-line{font-size:15px;color:#3d4d45;margin-top:22px;line-height:1.9}
.city-line strong{color:#062E1C}
</style>
</head>
<body>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?=$gtm_id?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

<?php require __DIR__ . '/includes/navbar.php'; ?>

<!-- HERO -->
<section class="page-hero">
  <div class="container">
    <nav aria-label="Breadcrumb"><ol class="breadcrumb"><li><a href="/">Beranda</a></li><li aria-hidden="true">›</li><li aria-current="page">Jadwal Pelatihan</li></ol></nav>
    <h1>📅 Jadwal Pelatihan K3 & Sertifikasi <?=$year?></h1>
    <p>Jadwal terbaru program pelatihan dan sertifikasi KEMNAKER RI, BNSP, dan KLHK tahun <?=$year?>. Diperbarui otomatis saat batch tersedia.</p>
    <div class="hero-btns">
      <a href="<?=$wa_link?>" target="_blank" rel="noopener" class="btn-primary">💬 Daftar via WhatsApp</a>
      <a href="#jadwal" class="btn-dark">Lihat Jadwal ↓</a>
    </div>
  </div>
</section>

<!-- NOTICE -->
<div class="notice-bar">
  <div class="container">
    ℹ️ Jadwal dapat berubah sewaktu-waktu. Konfirmasi via WhatsApp: <a href="<?=$wa_link?>" target="_blank" rel="noopener">0877-5915-1278</a>
  </div>
</div>

<!-- SCHEDULE -->
<section class="schedule-section" id="jadwal">
  <div class="container">
    <div class="filter-tabs">
      <button class="tab active" onclick="filterSchedule(this,'all')">Semua</button>
      <button class="tab" onclick="filterSchedule(this,'online')">Online</button>
      <button class="tab" onclick="filterSchedule(this,'tatap muka')">Tatap Muka</button>
      <button class="tab" onclick="filterSchedule(this,'kemnaker')">KEMNAKER RI</button>
      <button class="tab" onclick="filterSchedule(this,'bnsp')">BNSP</button>
    </div>
    <div class="table-wrap">
      <table id="schedTable">
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Program Pelatihan</th>
            <th>Sertifikasi</th>
            <th>Kota / Mode</th>
            <th>Sisa Kursi</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($schedules as $r):
            $lowSeat  = $r[5] <= 6;
            $isOnline = $r[4] === 'Online';
            $filterKey = strtolower($r[4]) . ' ' . strtolower($r[2]);
            $rowWaMsg = "Halo, saya ingin mendaftar pelatihan:\n*{$r[1]}*\nTanggal: {$r[0]}\nMode: {$r[4]}" . ($r[3] ? "\nLokasi: {$r[3]}" : '');
            $rowWaLink = "https://wa.me/{$wa_number}?text=" . rawurlencode($rowWaMsg);
          ?>
          <?php $isExtra = !in_array($r[8], $visibleMonths, true); ?>
          <tr data-f="<?=htmlspecialchars($filterKey)?>" data-extra="<?=$isExtra?'1':'0'?>" <?=$isExtra?'hidden':''?>>
            <td data-label="Tanggal"><strong><?=$r[0]?></strong></td>
            <td data-label="Program"><a href="/jadwal/<?=$r[7]?>/" class="batch-link" aria-label="Buka detail batch <?=htmlspecialchars($r[1])?>"><?=$r[1]?></a><br><?php if($r[6]): ?><a href="/pelatihan/<?=$r[6]?>/" style="font-size:12px;color:#64748b">Lihat program utama</a><?php endif; ?></td>
            <td data-label="Sertifikasi"><span class="badge badge-cert"><?=$r[2]?></span></td>
            <td data-label="Kota/Mode"><?=$r[3]?><span class="badge <?=$isOnline?'badge-online':'badge-tatap'?>"><?=$r[4]?></span></td>
            <td data-label="Sisa Kursi"><span class="badge <?=$lowSeat?'badge-low':'badge-ok'?>"><?=$lowSeat?'⚡ '.$r[5].' kursi':'✅ '.$r[5].' kursi'?></span></td>
            <td data-label="Daftar"><a href="<?=$rowWaLink?>" target="_blank" rel="noopener" class="btn-daftar">Daftar</a></td>
          </tr>
          <?php endforeach; ?>
          <?php if (empty($schedules)): ?>
          <tr><td colspan="6" style="text-align:center;padding:32px;color:#888">Jadwal batch berikutnya sedang disusun. <a href="<?=$wa_link?>" target="_blank" rel="noopener" style="color:#0A4A2E;font-weight:700">Hubungi kami via WhatsApp</a>.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
    <?php if ($extraBatchCount > 0): ?>
    <div class="show-batches-wrap"><button type="button" id="showBatchesBtn" class="show-batches-btn" onclick="toggleAllBatches()">Lihat <?=$extraBatchCount?> jadwal berikutnya ↓</button></div>
    <?php endif; ?>
    <p style="text-align:center;margin:24px 0 0;font-size:14px;color:#888">
      Tidak menemukan jadwal yang cocok? <a href="<?=$wa_link?>" target="_blank" rel="noopener" style="color:#0A4A2E;font-weight:700">Hubungi kami</a> untuk jadwal khusus atau in-house training.
    </p>
  </div>
</section>

<!-- CARA MENDAFTAR -->
<section class="content-section">
  <div class="container">
    <h2>📝 Cara Mendaftar Pelatihan</h2>
    <p class="lead">Proses pendaftaran pelatihan K3 dan sertifikasi di Wahana Totalita dibuat sesederhana mungkin, dari memilih jadwal sampai peserta siap mengikuti kelas.</p>
    <div class="steps-grid">
      <div class="step-card">
        <div class="step-num">1</div>
        <h3>Pilih Jadwal & Program</h3>
        <p>Cek tabel jadwal di atas, sesuaikan dengan program, sertifikasi, kota, dan mode (online/tatap muka) yang Anda butuhkan.</p>
      </div>
      <div class="step-card">
        <div class="step-num">2</div>
        <h3>Klik Daftar / WhatsApp</h3>
        <p>Klik tombol "Daftar" pada batch yang dipilih, atau hubungi tim kami langsung via WhatsApp untuk konsultasi terlebih dulu.</p>
      </div>
      <div class="step-card">
        <div class="step-num">3</div>
        <h3>Konfirmasi Data Peserta</h3>
        <p>Lengkapi data diri dan dokumen pendukung sesuai persyaratan skema sertifikasi yang dipilih.</p>
      </div>
      <div class="step-card">
        <div class="step-num">4</div>
        <h3>Pembayaran</h3>
        <p>Tim kami akan mengirimkan rincian biaya dan metode pembayaran melalui WhatsApp setelah data terkonfirmasi.</p>
      </div>
      <div class="step-card">
        <div class="step-num">5</div>
        <h3>Ikuti Pelatihan</h3>
        <p>Peserta mengikuti sesi pelatihan sesuai jadwal, baik secara online maupun tatap muka, hingga tahap asesmen kompetensi.</p>
      </div>
      <div class="step-card">
        <div class="step-num">6</div>
        <h3>Terima Sertifikat</h3>
        <p>Setelah dinyatakan kompeten, sertifikat diterbitkan oleh lembaga terkait (KEMNAKER RI, BNSP, atau KLHK) sesuai proses masing-masing.</p>
      </div>
    </div>
  </div>
</section>

<!-- CARA MEMILIH JADWAL -->
<section class="content-section">
  <div class="container">
    <h2>🎯 Cara Memilih Jadwal yang Tepat</h2>
    <p class="lead">Setiap perusahaan dan individu punya kebutuhan berbeda. Berikut gambaran singkat setiap opsi agar Anda bisa menentukan yang paling sesuai.</p>
    <div class="option-grid">
      <div class="option-card">
        <h3>Public Training</h3>
        <p>Cocok untuk peserta individu atau perusahaan yang ingin mengirim 1–beberapa karyawan mengikuti kelas gabungan sesuai jadwal batch yang sudah tersedia, tanpa perlu mengatur logistik pelatihan sendiri.</p>
      </div>
      <div class="option-card">
        <h3>In-House Training</h3>
        <p>Pilihan tepat untuk perusahaan yang ingin melatih banyak karyawan sekaligus (minimal 10 peserta), dengan jadwal dan materi yang bisa disesuaikan kebutuhan operasional dan risiko kerja di industri Anda.</p>
      </div>
      <div class="option-card">
        <h3>Online</h3>
        <p>Lebih fleksibel dari sisi waktu dan lokasi, cocok untuk materi regulasi, manajemen risiko K3, dan teori yang tidak membutuhkan praktik alat secara langsung.</p>
      </div>
      <div class="option-card">
        <h3>Tatap Muka (Offline)</h3>
        <p>Direkomendasikan untuk program yang membutuhkan praktik lapangan langsung, simulasi penggunaan alat, atau observasi keselamatan kerja yang lebih efektif dilakukan secara langsung.</p>
      </div>
    </div>
  </div>
</section>

<!-- MENGAPA JADWAL BISA BERUBAH -->
<section class="content-section">
  <div class="container">
    <div class="section-card">
      <h2>🔄 Mengapa Jadwal Pelatihan Bisa Berubah</h2>
      <p style="color:#3d4d45;font-size:15px;line-height:1.8">
        Jadwal pada halaman ini disusun berdasarkan rencana batch yang sedang berjalan, namun beberapa hal di luar kendali penyelenggara dapat memengaruhi pelaksanaannya. Kuota peserta minimum perlu terpenuhi agar kelas dapat berjalan efektif, sehingga batch dengan peminat masih sedikit kadang perlu digeser. Ketersediaan asesor atau instruktur bersertifikat juga menjadi faktor, mengingat mereka mengikuti jadwal dari beberapa program sekaligus. Selain itu, lembaga sertifikasi seperti KEMNAKER RI, BNSP, dan KLHK memiliki jadwal asesmen dan administrasi masing-masing yang harus disesuaikan dengan penyelenggara. Hari libur nasional dan cuti bersama juga dapat menggeser tanggal pelaksanaan, begitu pula penyesuaian operasional lain seperti ketersediaan lokasi atau fasilitas pelatihan. Karena itu, kami selalu menyarankan peserta mengonfirmasi jadwal terbaru melalui WhatsApp sebelum melakukan persiapan keberangkatan atau pengaturan cuti kerja.
      </p>
    </div>
  </div>
</section>

<!-- MENGAPA MEMILIH WAHANA TOTALITA -->
<section class="content-section">
  <div class="container">
    <h2>✅ Mengapa Memilih Wahana Totalita</h2>
    <p class="lead">Beberapa hal yang kami jaga konsisten di setiap penyelenggaraan pelatihan K3 dan sertifikasi.</p>
    <div class="reason-grid">
      <div class="reason-card">
        <h3>🏛️ Program Sertifikasi Resmi</h3>
        <p>Pelatihan mengacu pada skema sertifikasi resmi dari KEMNAKER RI, BNSP, dan KLHK sesuai bidang kompetensi K3 yang dibutuhkan.</p>
      </div>
      <div class="reason-card">
        <h3>💬 Dukungan yang Responsif</h3>
        <p>Tim kami dapat dihubungi langsung via WhatsApp untuk konsultasi program, jadwal, hingga kebutuhan in-house training.</p>
      </div>
      <div class="reason-card">
        <h3>🇮🇩 Jangkauan Nasional</h3>
        <p>Melayani peserta dari berbagai kota di Indonesia, baik untuk kelas public training maupun in-house training di lokasi perusahaan.</p>
      </div>
      <div class="reason-card">
        <h3>👨‍🏫 Instruktur Berpengalaman</h3>
        <p>Materi disampaikan oleh instruktur yang memahami penerapan K3 di berbagai jenis industri, bukan sekadar teori normatif.</p>
      </div>
      <div class="reason-card">
        <h3>🛠️ Pelatihan Aplikatif</h3>
        <p>Materi dirancang agar peserta dapat langsung menerapkan pengetahuan K3 di tempat kerja, bukan hanya untuk keperluan sertifikat.</p>
      </div>
      <div class="reason-card">
        <h3>🏢 Individu & Korporat</h3>
        <p>Melayani pendaftaran perorangan melalui jadwal public training, maupun kebutuhan pelatihan massal untuk perusahaan.</p>
      </div>
    </div>
  </div>
</section>

<?php if (!empty($popularPrograms)): ?>
<!-- PROGRAM POPULER -->
<section class="content-section">
  <div class="container">
    <h2>🔥 Program Pelatihan Populer</h2>
    <p class="lead">Beberapa program yang paling banyak diikuti pada jadwal berjalan saat ini.</p>
    <div class="program-grid">
      <?php foreach ($popularPrograms as $slug => $p): ?>
      <a href="/pelatihan/<?=$slug?>/" class="program-card">
        <h3><?=$p['name']?></h3>
        <span><?=$p['cert']?></span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- FAQ -->
<section class="content-section">
  <div class="container">
    <h2>❓ Pertanyaan yang Sering Diajukan</h2>
    <p class="lead">Jawaban seputar pendaftaran, jadwal, dan sertifikasi pelatihan K3.</p>
    <div class="faq-list">
      <?php foreach ($faqs as $f): ?>
      <details class="faq-item">
        <summary><?=htmlspecialchars($f['q'])?></summary>
        <p><?=htmlspecialchars($f['a'])?></p>
      </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- KOTA YANG DILAYANI -->
<section class="content-section">
  <div class="container">
    <h2>📍 Kota yang Kami Layani</h2>
    <p class="lead">Pelatihan tatap muka diselenggarakan secara berkala di beberapa kota, sementara in-house training dapat dilaksanakan di lokasi perusahaan Anda di seluruh Indonesia.</p>
    <p class="city-line">
      Termasuk di antaranya <strong>Yogyakarta</strong>, <strong>Jakarta</strong>, <strong>Surabaya</strong>, <strong>Bandung</strong>, <strong>Semarang</strong>, <strong>Medan</strong>, <strong>Makassar</strong>, <strong>Balikpapan</strong>, dan <strong>Denpasar</strong>. Untuk kota di luar daftar ini, silakan hubungi tim kami — in-house training dapat diselenggarakan di lokasi perusahaan Anda di seluruh Indonesia.
    </p>
  </div>
</section>

<!-- IN-HOUSE -->
<section class="inhouse">
  <div class="container">
    <div>
      <h2>🏢 Butuh In-House Training?</h2>
      <p>Kami menyediakan pelatihan di lokasi perusahaan Anda — seluruh Indonesia. Minimal 10 peserta, jadwal fleksibel, materi disesuaikan dengan industri Anda.</p>
    </div>
    <a href="https://wa.me/<?=$wa_number?>?text=<?=rawurlencode('Halo, saya ingin info in-house training untuk perusahaan kami')?>" target="_blank" rel="noopener" class="btn-inhouse">Minta Penawaran</a>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>

<script>
let scheduleExpanded = false;
let activeScheduleFilter = 'all';
function applyScheduleVisibility() {
  document.querySelectorAll('#schedTable tbody tr').forEach(row => {
    const matchesFilter = activeScheduleFilter === 'all' || (row.dataset.f || '').includes(activeScheduleFilter);
    const allowedMonth = scheduleExpanded || row.dataset.extra !== '1';
    row.hidden = !(matchesFilter && allowedMonth);
  });
}
function filterSchedule(btn, type) {
  document.querySelectorAll('.tab').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  activeScheduleFilter = type;
  applyScheduleVisibility();
}
function toggleAllBatches() {
  scheduleExpanded = !scheduleExpanded;
  applyScheduleVisibility();
  const btn = document.getElementById('showBatchesBtn');
  if (btn) btn.textContent = scheduleExpanded ? 'Tampilkan 3 bulan pertama ↑' : 'Lihat <?=$extraBatchCount?> jadwal berikutnya ↓';
}
</script>
<?php require __DIR__ . '/includes/scripts.php'; ?>
</body>
</html>
