<?php
/**
 * klien.php
 * Portofolio Klien & Rekam Jejak Industri Wahana Totalita Konsultan.
 * High-converting, authoritative E-E-A-T trust showcase with executive UI design tokens.
 * Zero DB dependency, fully responsive, SEO optimized.
 */
require_once __DIR__ . '/config.php';
$s = get_all_settings();

$wa_number = preg_replace('/\D/', '', get_setting('wa_number', '6287759151278'));
$phone_disp = '0' . substr($wa_number, 2);
$phone_disp = trim(chunk_split($phone_disp, 4, '-'), '-');
$wa_url = "https://wa.me/{$wa_number}?text=" . rawurlencode("Halo Wahana Totalita, kami dari perusahaan ingin konsultasi program pelatihan K3 & proposal in-house training.");
$year = date('Y');

$page_title = 'Klien & Portofolio Perusahaan — 70+ BUMN & Multinasional | Wahana Totalita';
$meta_desc  = 'Daftar klien & rekam jejak Wahana Totalita Konsultan sejak 2008. Dipercaya lebih dari 70+ korporasi BUMN, Migas, Pertambangan, Perbankan, dan Manufaktur di seluruh Indonesia.';
$canon_url  = SITE_URL . '/klien';

$klienGroups = [
    'Minyak, Gas & Energi' => [
        'icon' => '🛢️',
        'desc' => 'Eksplorasi, kilang pengolahan, petrokimia, dan transmisi kelistrikan nasional',
        'list' => [
            ['name' => 'PT Pertamina (Persero)', 'scope' => 'HSE Training & Sertifikasi'],
            ['name' => 'Freeport Indonesia (PTFI)', 'scope' => 'Pembinaan Kompetensi K3'],
            ['name' => 'Chevron Pacific Indonesia', 'scope' => 'In-House Training Contractor'],
            ['name' => 'BP Indonesia', 'scope' => 'Sertifikasi K3 & CSMS'],
            ['name' => 'Total E&P Indonesie', 'scope' => 'Safety Officer Program'],
            ['name' => 'ConocoPhillips Indonesia', 'scope' => 'Pelatihan Ahli K3'],
            ['name' => 'Badak LNG', 'scope' => 'Sertifikasi Ruang Terbatas & Gas'],
            ['name' => 'Inpex Corporation', 'scope' => 'HSE Compliance Training'],
            ['name' => 'Star Energy Geothermal', 'scope' => 'K3 Panas Bumi & Listrik'],
            ['name' => 'MedcoEnergi', 'scope' => 'Pelatihan Operator & Safety'],
            ['name' => 'PT PLN (Persero)', 'scope' => 'Sertifikasi K3 Listrik & Ketinggian'],
            ['name' => 'PT PJB (Pembangkitan Jawa-Bali)', 'scope' => 'Teknisi K3 Instalasi Pembangkit'],
        ]
    ],
    'Pertambangan, Metal & Smelter' => [
        'icon' => '⛏️',
        'desc' => 'Pertambangan minerba terbuka, bawah tanah, smelter nikel & industri baja',
        'list' => [
            ['name' => 'PT Adaro Energy Indonesia', 'scope' => 'POP & POM Pertambangan'],
            ['name' => 'PT Inalum (Persero)', 'scope' => 'K3 Peleburan Aluminium & Smelter'],
            ['name' => 'PT Krakatau Steel (Persero)', 'scope' => 'K3 Industri Baja & Crane'],
            ['name' => 'PT Smelting Gresik', 'scope' => 'K3 Kimia, Gas & B3'],
            ['name' => 'PT Holcim Indonesia (Semen)', 'scope' => 'Safety Awareness & Operator'],
            ['name' => 'PT Vale Indonesia Tbk', 'scope' => 'HSE Refreshment & Alat Berat'],
            ['name' => 'PT Bukit Asam Tbk (PTBA)', 'scope' => 'Pengawas Operasional Tambang'],
        ]
    ],
    'Industri Manufaktur, Kimia & Farmasi' => [
        'icon' => '🏭',
        'desc' => 'Pabrik pupuk, bahan kimia industri, farmasi terkemuka, dan percetakan negara',
        'list' => [
            ['name' => 'PT Pupuk Kalimantan Timur', 'scope' => 'Audit SMK3 & K3 Kimia'],
            ['name' => 'PT Pupuk Kujang Cikampek', 'scope' => 'Sertifikasi Operator Boiler'],
            ['name' => 'PT Pupuk Sriwidjaja (Pusri)', 'scope' => 'K3 Ruang Terbatas & Damkar'],
            ['name' => 'PT Bio Farma (Persero)', 'scope' => 'Biosafety & Higiene Industri'],
            ['name' => 'Perum Peruri', 'scope' => 'K3 Mesin Produksi & ISO 45001'],
            ['name' => 'PT Kalbe Farma Tbk', 'scope' => 'Internal Auditor QHSE'],
        ]
    ],
    'Perbankan, BUMN Fasilitas & Gedung' => [
        'icon' => '🏢',
        'desc' => 'Pengelolaan gedung bertingkat, tanggap darurat faskes, dan compliance kantor pusat',
        'list' => [
            ['name' => 'PT Bank Mandiri (Persero) Tbk', 'scope' => 'Damkar Gedung & Evakuasi'],
            ['name' => 'PT Bank Rakyat Indonesia (BRI)', 'scope' => 'K3 Perkantoran & First Aid'],
            ['name' => 'PT Bank Tabungan Negara (BTN)', 'scope' => 'Petugas P3K & Tanggap Darurat'],
            ['name' => 'PT Telkom Indonesia Tbk', 'scope' => 'K3 Bekerja di Ketinggian Tower'],
            ['name' => 'PT Angkasa Pura Indonesia', 'scope' => 'K3 Bandara & Ground Handling'],
            ['name' => 'PT Kereta Api Indonesia (KAI)', 'scope' => 'Operator Forklift & Bengkel Balai Yasa'],
        ]
    ],
    'Jasa Inspeksi, Konstruksi & Engineering' => [
        'icon' => '🛡️',
        'desc' => 'Lembaga uji inspeksi teknik, EPC global, dan kontraktor migas internasional',
        'list' => [
            ['name' => 'PT Sucofindo (Persero)', 'scope' => 'Sertifikasi Personel Inspeksi'],
            ['name' => 'PT Surveyor Indonesia', 'scope' => 'HSE Assessment & Auditor'],
            ['name' => 'Halliburton Indonesia', 'scope' => 'Oilfield Safety Compliance'],
            ['name' => 'Schlumberger Indonesia', 'scope' => 'Well Services Safety Standards'],
            ['name' => 'PT Wijaya Karya (WIKA)', 'scope' => 'Ahli K3 Konstruksi & Scaffolding'],
            ['name' => 'PT PP (Persero) Tbk', 'scope' => 'CSMS & SMK3 Proyek Sipil'],
        ]
    ],
];

$testimonials = [
    [
        'quote' => 'Program In-House Training K3 yang diselenggarakan Wahana Totalita sangat aplikatif dan terstruktur. Instruktur tidak hanya mengajarkan teori regulasi, tetapi mengupas studi kasus nyata di offshore dan fasilitas pengolahan, sehingga tim kami langsung siap menghadapi audit CSMS.',
        'role' => 'HSE Superintendent',
        'company' => 'Perusahaan Kontraktor Kontrak Kerja Sama (KKKS) Migas',
        'tag' => 'Sektor Minyak & Gas'
    ],
    [
        'quote' => 'Koordinasi sertifikasi petugas K3 gedung dan tim tanggap darurat kantor pusat kami berjalan sangat transparan dan tepat waktu. Seluruh berkas administrasi dan lisensi Kemnaker RI terbit sesuai estimasi yang dijanjikan.',
        'role' => 'Facility & Building Manager',
        'company' => 'BUMN Perbankan Nasional',
        'tag' => 'Sektor Perbankan & Gedung'
    ],
    [
        'quote' => 'Pelatihan Pengawas Operasional Tambang (POP) untuk site kami di Kalimantan berjalan lancar. Materi sesuai dengan Kepmen ESDM 1827 dan instruktur sangat memahami dinamika operasional alat berat tambang batubara.',
        'role' => 'HR & Training Supervisor',
        'company' => 'Perusahaan Tambang Batubara Terbuka',
        'tag' => 'Sektor Pertambangan'
    ]
];

ob_start();
require __DIR__ . '/includes/head.php';
$shared_head = ob_get_clean();
$shared_head = preg_replace('~<title>.*?</title>~s', '<title>' . e($page_title) . '</title>', $shared_head, 1);
echo $shared_head;
?>
<style>
/* ─── KLIEN PAGE DESIGN TOKENS & EXECUTIVE HERO ──────────────── */
.kl-hero {
  position: relative;
  background: radial-gradient(1000px circle at 80% 15%, rgba(10, 74, 46, 0.45) 0%, rgba(16, 58, 92, 0.4) 45%, #0B1523 90%), #070e17;
  padding: clamp(56px, 7vw, 88px) 0 clamp(44px, 5vw, 68px);
  text-align: center;
  overflow: hidden;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
}
.kl-hero::before {
  content: '';
  position: absolute; inset: 0;
  background-image: radial-gradient(rgba(255, 255, 255, 0.07) 1px, transparent 1px);
  background-size: 24px 24px;
  pointer-events: none;
}
.kl-hero .container { position: relative; z-index: 1; }
.kl-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-family: ui-monospace, monospace;
  font-size: 11.5px;
  font-weight: 700;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: #34d399;
  background: rgba(16, 185, 129, 0.12);
  border: 1px solid rgba(52, 211, 153, 0.28);
  padding: 4px 14px;
  border-radius: 999px;
  margin-bottom: 18px;
}
.kl-hero h1 {
  font-family: 'Lexend', system-ui, sans-serif;
  font-size: clamp(2rem, 4.4vw, 3rem);
  font-weight: 800;
  color: #ffffff;
  margin: 0 auto 16px;
  letter-spacing: -0.02em;
  max-width: 860px;
  line-height: 1.25;
}
.kl-hero p {
  font-size: 16px;
  color: #94a3b8;
  max-width: 720px;
  margin: 0 auto 30px;
  line-height: 1.7;
}
.kl-stats-strip {
  display: flex;
  justify-content: center;
  gap: 36px;
  flex-wrap: wrap;
  margin-top: 36px;
  padding-top: 28px;
  border-top: 1px solid rgba(255, 255, 255, 0.1);
}
.kl-stat-item { text-align: center; }
.kl-stat-num {
  font-family: 'Lexend', sans-serif;
  font-size: 2rem;
  font-weight: 800;
  color: #fff;
  line-height: 1.1;
}
.kl-stat-num span { color: #F06A25; }
.kl-stat-lbl {
  font-size: 12.5px;
  color: #94a3b8;
  margin-top: 4px;
}

/* ─── KLIEN SHOWCASE SECTION ────────────────────────────────── */
.kl-section {
  padding: 72px 0;
  background: #f8fafc;
}
.kl-group-wrap {
  margin-bottom: 48px;
}
.kl-group-head {
  display: flex;
  align-items: baseline;
  justify-content: space-between;
  gap: 16px;
  flex-wrap: wrap;
  margin-bottom: 20px;
  padding-bottom: 12px;
  border-bottom: 2px solid #e2e8f0;
}
.kl-group-head h2 {
  font-family: 'Lexend', sans-serif;
  font-size: 1.35rem;
  font-weight: 800;
  color: #0f172a;
  margin: 0;
  display: flex;
  align-items: center;
  gap: 10px;
}
.kl-group-head p {
  font-size: 13.5px;
  color: #64748b;
  margin: 0;
}
.kl-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 18px;
}
.kl-card {
  background: #ffffff;
  border: 1px solid rgba(16, 58, 92, 0.08);
  border-radius: 14px;
  padding: 20px 22px;
  box-shadow: 0 4px 16px -6px rgba(11, 44, 70, 0.06);
  transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.kl-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 12px 28px -10px rgba(11, 44, 70, 0.16);
  border-color: rgba(16, 58, 92, 0.2);
}
.kl-card-name {
  font-family: 'Lexend', sans-serif;
  font-weight: 700;
  font-size: 15px;
  color: #0f172a;
  margin-bottom: 6px;
  line-height: 1.4;
}
.kl-card-scope {
  font-size: 12.5px;
  color: #0284c7;
  font-weight: 600;
  display: flex;
  align-items: center;
  gap: 6px;
}
.kl-card-scope::before {
  content: "•";
  color: #34d399;
  font-size: 1.2rem;
}

/* ─── TESTIMONIALS SECTION ─────────────────────────────────── */
.kl-testi-section {
  padding: 72px 0;
  background: #ffffff;
  border-top: 1px solid #e2e8f0;
}
.kl-sec-title {
  text-align: center;
  font-family: 'Lexend', sans-serif;
  font-size: clamp(1.6rem, 3vw, 2.2rem);
  font-weight: 800;
  color: #0f172a;
  margin: 0 0 12px;
}
.kl-sec-sub {
  text-align: center;
  font-size: 15px;
  color: #64748b;
  max-width: 600px;
  margin: 0 auto 48px;
}
.kl-testi-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 24px;
}
.kl-testi-card {
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: 16px;
  padding: 30px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  position: relative;
}
.kl-testi-tag {
  align-self: flex-start;
  background: #e0f2fe;
  color: #0369a1;
  font-size: 11.5px;
  font-weight: 700;
  padding: 4px 10px;
  border-radius: 6px;
  margin-bottom: 16px;
}
.kl-testi-quote {
  font-size: 14.5px;
  color: #334155;
  line-height: 1.7;
  margin-bottom: 24px;
  font-style: italic;
}
.kl-testi-author {
  border-top: 1px solid #e2e8f0;
  padding-top: 16px;
}
.kl-testi-role {
  font-weight: 700;
  font-size: 14px;
  color: #0f172a;
}
.kl-testi-comp {
  font-size: 12.5px;
  color: #64748b;
  margin-top: 2px;
}

/* ─── CORPORATE IN-HOUSE CTA BANNER ────────────────────────── */
.kl-cta-box {
  background: linear-gradient(135deg, #092015 0%, #0F3826 100%);
  color: #fff;
  border-radius: 20px;
  padding: 48px 40px;
  margin: 64px auto 0;
  box-shadow: 0 20px 40px -15px rgba(10, 74, 46, 0.4);
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 32px;
  flex-wrap: wrap;
}
.kl-cta-copy h2 {
  font-family: 'Lexend', sans-serif;
  font-size: clamp(1.4rem, 2.6vw, 2rem);
  font-weight: 800;
  color: #fff;
  margin: 0 0 10px;
}
.kl-cta-copy p {
  font-size: 14.5px;
  color: #bbf7d0;
  margin: 0;
  max-width: 620px;
  line-height: 1.6;
}
.btn-kl-wa {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: #25D366;
  color: #fff !important;
  padding: 15px 30px;
  border-radius: 12px;
  font-weight: 700;
  font-size: 15px;
  text-decoration: none;
  box-shadow: 0 8px 24px rgba(37, 211, 102, 0.4);
  transition: transform .2s ease, box-shadow .2s ease;
}
.btn-kl-wa:hover {
  background: #1da855;
  transform: translateY(-2px);
  box-shadow: 0 12px 30px rgba(37, 211, 102, 0.5);
}
</style>

<!-- TOP NAV -->
<?php require __DIR__ . '/includes/navbar.php'; ?>

<!-- HERO -->
<section class="kl-hero">
  <div class="container">
    <div class="kl-eyebrow">Rekam Jejak &amp; Kemitraan Korporasi</div>
    <h1>Klien &amp; Portofolio Wahana Totalita</h1>
    <p>Sejak tahun 2008, Wahana Totalita Konsultan telah dipercaya oleh lebih dari 70+ perusahaan BUMN strategis nasional, operator minyak &amp; gas multinasional, pertambangan minerba, dan manufaktur untuk pelatihan, sertifikasi, serta audit K3 terintegrasi.</p>

    <div class="kl-stats-strip">
      <div class="kl-stat-item">
        <div class="kl-stat-num">70<span>+</span></div>
        <div class="kl-stat-lbl">Perusahaan Mitra</div>
      </div>
      <div class="kl-stat-item">
        <div class="kl-stat-num">120.000<span>+</span></div>
        <div class="kl-stat-lbl">Alumni Tersertifikasi</div>
      </div>
      <div class="kl-stat-item">
        <div class="kl-stat-num">2008</div>
        <div class="kl-stat-lbl">Tahun Berdiri</div>
      </div>
      <div class="kl-stat-item">
        <div class="kl-stat-num">100<span>%</span></div>
        <div class="kl-stat-lbl">Lisensi Resmi Kemnaker &amp; BNSP</div>
      </div>
    </div>
  </div>
</section>

<!-- MAIN SHOWCASE GRID -->
<section class="kl-section">
  <div class="container">
    <?php foreach ($klienGroups as $groupTitle => $group): ?>
    <div class="kl-group-wrap">
      <div class="kl-group-head">
        <h2><span><?= $group['icon'] ?></span> <?= e($groupTitle) ?></h2>
        <p><?= e($group['desc']) ?></p>
      </div>
      <div class="kl-grid">
        <?php foreach ($group['list'] as $c): ?>
        <div class="kl-card">
          <div class="kl-card-name"><?= e($c['name']) ?></div>
          <div class="kl-card-scope"><?= e($c['scope']) ?></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endforeach; ?>

    <!-- CTA BANNER -->
    <div class="kl-cta-box">
      <div class="kl-cta-copy">
        <h2>Ingin Menyelenggarakan Training K3 di Perusahaan Anda?</h2>
        <p>Kami menyediakan paket In-House Training fleksibel di seluruh wilayah Indonesia (Sumatera, Jawa, Kalimantan, Sulawesi, hingga Papua) dengan kurikulum yang dapat dikustomisasi sesuai SOP dan risiko spesifik industri Anda.</p>
      </div>
      <a href="<?= $wa_url ?>" class="btn-kl-wa" target="_blank" rel="noopener">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
        <span>Minta Proposal Pelatihan &rarr;</span>
      </a>
    </div>
  </div>
</section>

<!-- TESTIMONIALS -->
<section class="kl-testi-section">
  <div class="container">
    <h2 class="kl-sec-title">Ulasan &amp; Pengalaman Mitra</h2>
    <p class="kl-sec-sub">Bagaimana Wahana Totalita mendampingi kepatuhan keselamatan kerja di berbagai sektor industri</p>

    <div class="kl-testi-grid">
      <?php foreach ($testimonials as $t): ?>
      <div class="kl-testi-card">
        <span class="kl-testi-tag"><?= e($t['tag']) ?></span>
        <p class="kl-testi-quote">“<?= e($t['quote']) ?>”</p>
        <div class="kl-testi-author">
          <div class="kl-testi-role"><?= e($t['role']) ?></div>
          <div class="kl-testi-comp"><?= e($t['company']) ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
