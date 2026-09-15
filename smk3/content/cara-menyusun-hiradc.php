<?php
/** #22 — Cara Menyusun HIRADC (dengan Contoh Tabel). */
$updated = '2026-08-10';
$faq = [
  ['q' => 'Aplikasi atau software apa yang paling ideal untuk menyusun dan mengelola HIRADC?', 'a' => 'Untuk sebagian besar perusahaan menengah (100–500 pekerja), perangkat lunak spreadsheet seperti Microsoft Excel atau Google Sheets sudah sangat memadai, asalkan struktur kolomnya lengkap dan rumus kalkulasi risikonya terkunci. Perusahaan multi-site berskala holding besar disarankan menggunakan perangkat lunak EHS terintegrasi.'],
  ['q' => 'Bagaimana menentukan skor Kemungkinan (Likelihood) jika bahaya tersebut belum pernah terjadi di perusahaan kami?', 'a' => 'Skor Kemungkinan tidak boleh hanya diukur dari riwayat internal perusahaan. Jika kecelakaan tersebut pernah terjadi di industri sejenis (misalnya kecelakaan ledakan dust explosion di pabrik tepung lain), skor Kemungkinan wajib ditetapkan minimal skala 3 (Mungkin / Moderate).'],
  ['q' => 'Siapa yang bertanggung jawab menandatangani dan mengesahkan dokumen register HIRADC?', 'a' => 'Dokumen Register HIRADC disusun oleh Tim Risk Assessment (HSE & Supervisor Area), diverifikasi oleh Sekretaris P2K3 (Ahli K3 Umum), dan WAJIB disahkan secara resmi oleh Pimpinan Puncak Tempat Kerja (Plant Manager / General Manager / Direktur Operasional).'],
  ['q' => 'Apakah pekerjaan proyek kontraktor wajib memiliki HIRADC tersendiri?', 'a' => 'Wajib. Seluruh aktivitas pekerjaan kontraktor di area fasilitas Anda harus dicakup dalam HIRADC khusus kontraktor (atau meminta kontraktor menyerahkan JSA / HIRADC proyek) yang ditinjau dan disetujui oleh Tim HSE perusahaan sebelum pekerjaan dimulai di lapangan.'],
];
?>
<div class="note"><strong>Catatan Regulasi:</strong> Metode perhitungan skoring HIRADC / IBPR mengacu pada prinsip penilaian risiko standar ISO 31000 Risk Management dan Lampiran II PP No. 50 Tahun 2012. Selalu gunakan matriks risiko 5x5 yang telah disahkan oleh Manajemen Puncak perusahaan per 2026.</div>

<p>Di sebuah pabrik pengolahan kayu di Tangerang, seorang tim HSE menghabiskan waktu 2 minggu mengisi 300 baris tabel HIRADC. Namun saat audit eksternal SMK3 berlangsung, auditor senior menemukan kesalahan mendasar pada baris ke-12: untuk aktivitas <em>pengoperasian mesin gergaji pita (band saw)</em>, tim menetapkan skor risiko awal **Skor 4 (Low Risk)** hanya karena pekerja dianggap "sudah berpengalaman 10 tahun". Auditor menegaskan bahwa pengalaman kerja tidak mengurangi bahaya mekanis pisau gergaji yang berputar 1.500 RPM tanpa guard pelindung. Penetapan skor risiko yang didasarkan pada asumsi subjektif tanpa kriteria obyektif adalah penyebab utama dokumen HIRADC ditolak auditor. Artikel ini adalah panduan panduan praktis step-by-step menyusun HIRADC secara obyektif, terukur, dan dilengkapi contoh tabel siap pakai.</p>

<h2 id="5-tahap-penyusunan">5 Tahap Operasional Menyusun Register HIRADC dari Nol</h2>

<h3 id="tahap-1-pemetaan">Tahap 1: Pembagian Area Kerja &amp; Pemecahan Aktivitas Operasional</h3>
<p>Jangan pernah menulis nama aktivitas terlalu umum seperti "Operasional Pabrik". Pecahlah tempat kerja berdasarkan **Unit Area -&gt; Sub-Fasilitas -&gt; Tahapan Aktivitas**: </p>
<ul>
  <li><strong>Aktivitas Rutin:</strong> Operasional produksi harian, penerimaan bahan baku, pengemasan, pengangkutan forklift, dan pembersihan area.</li>
  <li><strong>Aktivitas Non-Rutin:</strong> Pemeliharaan berkala (preventive maintenance), perbaikan mesin rusak (breakdown), bongkar-pasang cetakan (*die change*), dan penanganan limbah B3 bulanan.</li>
  <li><strong>Aktivitas Kondisi Darurat:</strong> Penanganan tumpahan bahan kimia (*spill response*), evakuasi kebakaran, kegagalan daya listrik (*blackout*), dan kebocoran gas bertekanan.</li>
</ul>

<h3 id="tahap-2-deskripsi-bahaya">Tahap 2: Identifikasi Bahaya &amp; Penentuan Dampak Risiko Spesifik</h3>
<p>Untuk setiap aktivitas, identifikasi bahaya menggunakan **Metode Kata Kunci Spesifik**. Hindari kata-kata generik:</p>

<div class="table-scroll"><table>
  <tr>
    <th>Aktivitas Kerja</th>
    <th>Deskripsi Bahaya SALAH (Generik)</th>
    <th>Deskripsi Bahaya BENAR (Spesifik &amp; Bergambar)</th>
    <th>Dampak Risiko Kesehatan / Keselamatan</th>
  </tr>
  <tr>
    <td>Pengangkatan bahan kimia asam sulfat di laboratorium</td>
    <td>Bahan Kimia</td>
    <td>Tumpahan atau cipratan cairan Asam Sulfat (H2SO4) dari jerigen retak saat dituangkan manual tanpa sarung tangan kimia.</td>
    <td>Luka bakar kimia pada kulit, kebutaan mata akibat cipratan asam, iritasi saluran pernapasan.</td>
  </tr>
  <tr>
    <td>Pembersihan debu di atap gudang logistik</td>
    <td>Ketinggian</td>
    <td>Pekerja memanjat atap seng gudang (ketinggian 8 meter) tanpa menggunakan harness dan tanpa adanya lifeline/scaffolding.</td>
    <td>Jatuh dari ketinggian, fraktur tulang belakang, pendarahan otak, cedera fatal (*fatality*).</td>
  </tr>
  <tr>
    <td>Pengoperasian forklift di area gudang sempit</td>
    <td>Tabrakan</td>
    <td>Forklift melaju di lorong gudang blind spot tanpa cermin cembung dan klakson rusak saat pejalan kaki melintas.</td>
    <td>Pejalan kaki tertabrak/tergilas roda forklift, patah tulang kaki, kerusakan struktur rak gudang.</td>
  </tr>
</table></div>

<h3 id="tahap-3-matriks-skoring">Tahap 3: Penilaian Risiko Menggunakan Matriks 5x5 Standar K3</h3>
<p>Nilai Risiko dihitung menggunakan rumus baku: \[\text{Tingkat Risiko (Risk Score)} = \text{Kemungkinan (Likelihood)} \times \text{Keparahan (Severity)}\]</p>

<h4 id="tabel-kemungkinan">1. Skala Kemungkinan (Likelihood - L)</h4>
<div class="table-scroll"><table>
  <tr>
    <th>Skor (L)</th>
    <th>Kategori Kemungkinan</th>
    <th>Kriteria Kualitatif / Frekuensi Kejadian</th>
  </tr>
  <tr>
    <td><strong>1</strong></td>
    <td>Sangat Jarang (Sangat Unlikely)</td>
    <td>Hampir tidak pernah terjadi di industri sejenis (&lt; 1 kali dalam 10 tahun).</td>
  </tr>
  <tr>
    <td><strong>2</strong></td>
    <td>Jarang (Unlikely)</td>
    <td>Pernah terjadi di industri sejenis, tetapi belum pernah di fasilitas ini.</td>
  </tr>
  <tr>
    <td><strong>3</strong></td>
    <td>Mungkin (Moderate)</td>
    <td>Pernah terjadi 1 kali di fasilitas ini dalam 3 tahun terakhir.</td>
  </tr>
  <tr>
    <td><strong>4</strong></td>
    <td>Sering (Likely)</td>
    <td>Terjadi beberapa kali dalam 1 tahun di fasilitas ini.</td>
  </tr>
  <tr>
    <td><strong>5</strong></td>
    <td>Sangat Sering (Almost Certain)</td>
    <td>Terjadi berulang kali setiap bulan di area operasional.</td>
  </tr>
</table></div>

<h4 id="tabel-keparahan">2. Skala Keparahan (Severity - S)</h4>
<div class="table-scroll"><table>
  <tr>
    <th>Skor (S)</th>
    <th>Kategori Keparahan</th>
    <th>Dampak Fisik / Kesehatan / Operasional</th>
  </tr>
  <tr>
    <td><strong>1</strong></td>
    <td>Sangat Ringan (Insignificant)</td>
    <td>Cedera ringan P3K (First Aid), tidak ada hari kerja yang hilang.</td>
  </tr>
  <tr>
    <td><strong>2</strong></td>
    <td>Ringan (Minor)</td>
    <td>Membutuhkan perawatan medis luar, hilang hari kerja &lt; 2 hari.</td>
  </tr>
  <tr>
    <td><strong>3</strong></td>
    <td>Sedang (Moderate)</td>
    <td>Cedera sedang, perawatan inap rumah sakit, hilang hari kerja &gt; 2 hari (LTI).</td>
  </tr>
  <tr>
    <td><strong>4</strong></td>
    <td>Berat (Major)</td>
    <td>Cedera berat, cacat permanen sebagian anggota tubuh, penghentian proses produksi.</td>
  </tr>
  <tr>
    <td><strong>5</strong></td>
    <td>Sangat Berat (Catastrophic)</td>
    <td>Kematian (*fatality*) 1 orang atau lebih, cacat total permanen, kerusakan masif.</td>
  </tr>
</table></div>

<h4 id="tabel-matriks-5x5">3. Matriks Risiko 5x5 dan Kategori Tindakan</h4>
<div class="table-scroll"><table>
  <tr>
    <th colspan="2" rowspan="2">Matriks Risiko 5x5</th>
    <th colspan="5">Tingkat Keparahan (Severity)</th>
  </tr>
  <tr>
    <th>1 (Sangat Ringan)</th>
    <th>2 (Ringan)</th>
    <th>3 (Sedang)</th>
    <th>4 (Berat)</th>
    <th>5 (Catastrophic)</th>
  </tr>
  <tr>
    <th rowspan="5">Tingkat Kemungkinan (Likelihood)</th>
    <th>5 (Sangat Sering)</th>
    <td><span style="background:#ffeb3b; padding:2px 8px;">5 (Medium)</span></td>
    <td><span style="background:#ff9800; padding:2px 8px; color:#fff;">10 (High)</span></td>
    <td><span style="background:#f44336; padding:2px 8px; color:#fff;">15 (Extreme)</span></td>
    <td><span style="background:#f44336; padding:2px 8px; color:#fff;">20 (Extreme)</span></td>
    <td><span style="background:#f44336; padding:2px 8px; color:#fff;">25 (Extreme)</span></td>
  </tr>
  <tr>
    <th>4 (Sering)</th>
    <td><span style="background:#8bc34a; padding:2px 8px;">4 (Low)</span></td>
    <td><span style="background:#ffeb3b; padding:2px 8px;">8 (Medium)</span></td>
    <td><span style="background:#ff9800; padding:2px 8px; color:#fff;">12 (High)</span></td>
    <td><span style="background:#f44336; padding:2px 8px; color:#fff;">16 (Extreme)</span></td>
    <td><span style="background:#f44336; padding:2px 8px; color:#fff;">20 (Extreme)</span></td>
  </tr>
  <tr>
    <th>3 (Mungkin)</th>
    <td><span style="background:#8bc34a; padding:2px 8px;">3 (Low)</span></td>
    <td><span style="background:#ffeb3b; padding:2px 8px;">6 (Medium)</span></td>
    <td><span style="background:#ff9800; padding:2px 8px; color:#fff;">9 (High)</span></td>
    <td><span style="background:#ff9800; padding:2px 8px; color:#fff;">12 (High)</span></td>
    <td><span style="background:#f44336; padding:2px 8px; color:#fff;">15 (Extreme)</span></td>
  </tr>
  <tr>
    <th>2 (Jarang)</th>
    <td><span style="background:#8bc34a; padding:2px 8px;">2 (Low)</span></td>
    <td><span style="background:#8bc34a; padding:2px 8px;">4 (Low)</span></td>
    <td><span style="background:#ffeb3b; padding:2px 8px;">6 (Medium)</span></td>
    <td><span style="background:#ffeb3b; padding:2px 8px;">8 (Medium)</span></td>
    <td><span style="background:#ff9800; padding:2px 8px; color:#fff;">10 (High)</span></td>
  </tr>
  <tr>
    <th>1 (Sangat Jarang)</th>
    <td><span style="background:#8bc34a; padding:2px 8px;">1 (Low)</span></td>
    <td><span style="background:#8bc34a; padding:2px 8px;">2 (Low)</span></td>
    <td><span style="background:#8bc34a; padding:2px 8px;">3 (Low)</span></td>
    <td><span style="background:#8bc34a; padding:2px 8px;">4 (Low)</span></td>
    <td><span style="background:#ffeb3b; padding:2px 8px;">5 (Medium)</span></td>
  </tr>
</table></div>

<h3 id="tahap-4-hirarki-tindakan">Tahap 4: Penetapan Pengendalian Tambahan &amp; Penanggung Jawab (PIC)</h3>
<p>Untuk risiko kategori **High (9–12)** dan **Extreme (15–25)**, perusahaan wajib merancang pengendalian tambahan berdasar **Hirarki Pengendalian (Eliminasi, Substitusi, Rekayasa Teknik, Administratif, APD)**. Setiap tindakan perbaikan wajib dilengkapi nama PIC dan Target Tanggal Penyelesaian.</p>

<h3 id="tahap-5-risiko-sisa">Tahap 5: Perhitungan Risiko Sisa (Residual Risk)</h3>
<p>Hitung kembali skor risiko sisa setelah tindakan perbaikan dipasang. Skor risiko sisa wajib berada pada skala **Low (1–4)** atau **Medium (5–8)**.</p>

<h2 id="contoh-tabel-lengkap">Contoh Tabel Register HIRADC Siap Pakai (Area Gudang &amp; Maintenance)</h2>
<p>Berikut adalah draf formulir register HIRADC komprehensif yang memenuhi standar audit PP 50/2012:</p>

<div class="table-scroll"><table>
  <tr>
    <th rowspan="2">No</th>
    <th rowspan="2">Aktivitas / Proses Kerja</th>
    <th rowspan="2">Identifikasi Bahaya</th>
    <th rowspan="2">Risiko / Dampak Keselamatan</th>
    <th rowspan="2">Pengendalian Saat Ini</th>
    <th colspan="3">Risiko Awal</th>
    <th rowspan="2">Rekomendasi Pengendalian Tambahan</th>
    <th rowspan="2">PIC &amp; Tenggat</th>
    <th colspan="3">Risiko Sisa</th>
  </tr>
  <tr>
    <th>L</th>
    <th>S</th>
    <th>Skor</th>
    <th>L</th>
    <th>S</th>
    <th>Skor</th>
  </tr>
  <tr>
    <td>1</td>
    <td>Bongkar muat bahan kimia drum di loading dock (Rutin)</td>
    <td>Drum bahan kimia korosif bocor/tumpah saat diangkut forklift.</td>
    <td>Luka bakar kimia pada kulit pekerja gudang &amp; polusi tanah.</td>
    <td>Sarung tangan kain biasa (Tidak sesuai).</td>
    <td>4</td>
    <td>4</td>
    <td><span style="background:#f44336; color:#fff; padding:2px 6px;">16 (Extreme)</span></td>
    <td>1. Sediakan secondary containment drum.<br>2. Sediakan Spill Kit B3 &amp; Eyewash.<br>3. Wajibkan sarung tangan Nitrile &amp; Apron kimia.</td>
    <td>Gudang Spv / 14 Hari</td>
    <td>1</td>
    <td>4</td>
    <td><span style="background:#8bc34a; padding:2px 6px;">4 (Low)</span></td>
  </tr>
  <tr>
    <td>2</td>
    <td>Penggantian lampu penerangan atap gudang H=7m (Non-Rutin)</td>
    <td>Pekerja memanjat atap menggunakan tangga bambu tanpa lifeline.</td>
    <td>Pekerja jatuh dari ketinggian, fatalitas/kematian.</td>
    <td>Instruksi lisan berhati-hati.</td>
    <td>3</td>
    <td>5</td>
    <td><span style="background:#f44336; color:#fff; padding:2px 6px;">15 (Extreme)</span></td>
    <td>1. Penerbitan Permit to Work (PTW).<br>2. Gunakan Scaffolding ber-stempel aman.<br>3. Wajib Full Body Harness double lanyard.<br>4. Teknisi bersertifikat TKBT II.</td>
    <td>HSE Spv / Sebelum Kerja</td>
    <td>1</td>
    <td>5</td>
    <td><span style="background:#ffeb3b; padding:2px 6px;">5 (Med)</span></td>
  </tr>
  <tr>
    <td>3</td>
    <td>Pembersihan sisa mesin pres cetakan (Rutin)</td>
    <td>Tangan melintas di bawah pisau pres saat mesin masih terhubung listrik.</td>
    <td>Tangan terpotong / amputasi bagian jari.</td>
    <td>SOP Pembersihan tertempel.</td>
    <td>3</td>
    <td>4</td>
    <td><span style="background:#ff9800; color:#fff; padding:2px 6px;">12 (High)</span></td>
    <td>1. Pasang sensor Safety Light Curtain (Engineering).<br>2. Penerapan Prosedur LOTO saat pembersihan.<br>3. Sediakan tongkat pembersih magnetic.</td>
    <td>Maintenance Mgr / 30 Hari</td>
    <td>1</td>
    <td>4</td>
    <td><span style="background:#8bc34a; padding:2px 6px;">4 (Low)</span></td>
  </tr>
</table></div>

<h2 id="pemeliharaan-berkala">Disiplin Pemeliharaan dan Pembaruan Dokumentasi HIRADC</h2>
<p>Dokumen HIRADC yang sudah disahkan wajib dikelola sebagai dokumen dinamik. Lakukan pembaruan berkala berdasarkan **4 Pemicu Utama**: </p>
<ol>
  <li><strong>Pasca-Terjadi Insiden / Nearmiss:</strong> Jika terjadi kecelakaan kerja pada satu aktivitas, register HIRADC untuk aktivitas tersebut wajib langsung direvisi untuk memasukkan rekomendasi RCA.</li>
  <li><strong>Adanya Modifikasi Proses / Mesin Baru (MOC):</strong> Pembelian mesin baru atau perubahan layout pabrik wajib melalui penilaian HIRADC sebelum mesin dioperasikan.</li>
  <li><strong>Perubahan Peraturan Perundangan K3:</strong> Terbitnya NAB baru atau regulasi teknis keselamatan baru mewajibkan penyesuaian skoring HIRADC.</li>
  <li><strong>Tinjauan Rutin Tahunan:</strong> Minimal 1 tahun sekali, P2K3 dan Tim HSE menyelenggarkan workshop peninjauan ulang seluruh register HIRADC fasilitas perusahaan.</li>
</ol>

<p>Dengan menyusun HIRADC mengikuti langkah-langkah terstruktur di atas, perusahaan Anda tidak hanya mengantongi dokumen yang dijamin patuh (*comply*) pada audit sertifikasi SMK3 PP 50/2012, tetapi juga benar-benar mengendalikan risiko kecelakaan kerja di tempat kerja secara nyata.</p>

