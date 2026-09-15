<?php
/** #21 — HIRADC dalam SMK3. */
$updated = '2026-08-10';
$faq = [
  ['q' => 'Apa kepanjangan dan definisi teknis dari HIRADC / IBPR?', 'a' => 'HIRADC adalah singkatan dari Hazard Identification, Risk Assessment, and Determining Control (dalam bahasa Indonesia dikenal sebagai IBPR: Identifikasi Bahaya, Penilaian Risiko, dan Penetapan Pengendalian). HIRADC adalah metodologi terstruktur untuk menemukan potensi bahaya di tempat kerja, menghitung tingkat risiko, dan menentukan tindakan pencegahan yang terukur.'],
  ['q' => 'Mengapa auditor eksternal Kemnaker selalu memeriksa register HIRADC terlebih dahulu?', 'a' => 'Karena HIRADC adalah "mesin penggerak" seluruh elemen SMK3. Prosedur operasional (SOP), jadwal inspeksi, materi induksi K3, jenis APD yang dibeli, dan isi Permit to Work semuanya wajib diturunkan dari hasil analisis risiko dalam HIRADC.'],
  ['q' => 'Apa perbedaan mendasar antara HIRADC dan JSA (Job Safety Analysis)?', 'a' => 'HIRADC menilai risiko seluruh aktivitas organisasi secara luas (macro assessment), mencakup kondisi rutin, non-rutin, dan darurat. JSA membedah satu tugas spesifik berisiko tinggi secara teknis (micro assessment) langkah demi langkah sebelum pekerjaan dimulai di lapangan.'],
  ['q' => 'Kapan dokumen register HIRADC wajib ditinjau ulang (review)?', 'a' => 'HIRADC wajib ditinjau ulang minimal 1 tahun sekali, atau secara insidentil apabila terjadi: kecelakaan kerja/nearmiss, perubahan mesin/proses produksi baru, pembangunan fasilitas baru, atau terbitnya peraturan perundangan K3 baru.'],
];
?>
<div class="note"><strong>Catatan Regulasi:</strong> Pengelolaan manajemen risiko HIRADC mengacu pada Prinsip II (Perencanaan K3) Pasal 9 PP No. 50 Tahun 2012, Permenaker No. 05 Tahun 2018 (Pengukuran Lingkungan Kerja), dan standar ISO 31000 Risk Management per 2026.</div>

<p>Dalam sebuah audit investigasi pasca-kecelakaan fatal di sebuah pabrik peleburan baja di Jawa Timur, pengawas ketenagakerjaan menemukan dokumen HIRADC perusahaan tebal berukuran 200 halaman yang dijilid rapi. Namun saat tabel HIRADC area peleburan dibuka, bahaya *kebocoran cairan baja cair saat penuangan ladle* sama sekali tidak tercantum. Yang ada hanyalah bahaya generik seperti "terpeleset" dan "terbentur". Kelalaian fatal dalam tahap Identifikasi Bahaya ini membuat perusahaan tidak pernah menyediakan pakaian pelindung tahan panas (*aluminized suit*) dan tidak memiliki Prosedur Operasional Tanggap Darurat penuangan ladle. HIRADC bukan sekadar berkas formalitas untuk memenuhi Kriteria Audit Elemen 2. HIRADC adalah cetak biru perlindungan keselamatan jiwa yang menentukan hidup matinya pekerja di fasilitas tempat kerja Anda.</p>

<h2 id="hiradc-sebagai-mesin-penggerak">HIRADC sebagai "Mesin Penggerak" (Engine) 12 Elemen SMK3</h2>
<p>HIRADC berada di pusat seluruh arsitektur SMK3. Hubungan keterikatan HIRADC dengan elemen operasional lainnya dapat dipetakan sebagai berikut:</p>

<div class="table-scroll"><table>
  <tr>
    <th>Elemen SMK3 PP 50/2012</th>
    <th>Bagaimana HIRADC Menjadi Input Utama Operasional</th>
    <th>Resiko Jika HIRADC Cacat / Salah Analysis</th>
  </tr>
  <tr>
    <td><strong>Elemen 1 &amp; 2 (Program K3)</strong></td>
    <td>Sasaran dan Anggaran K3 tahunan wajib dialokasikan untuk membiayai pengendalian risiko kategori *High* &amp; *Extreme* hasil HIRADC.</td>
    <td>Anggaran K3 habis untuk hal sepele (misal: beli cat jalur), sementara risiko ledakan tanki tidak dianggarkan.</td>
  </tr>
  <tr>
    <td><strong>Elemen 6 (Pengendalian Operasional)</strong></td>
    <td>SOP, Instruksi Kerja, LOTO, dan Izin Kerja Aman (PTW) disusun berdasarkan urutan hazard yang teridentifikasi di HIRADC.</td>
    <td>SOP dibuat tanpa poin keselamatan teknis; izin kerja diterbitkan tanpa pemantauan gas berbahaya.</td>
  </tr>
  <tr>
    <td><strong>Elemen 6.5 (Pengelolaan APD)</strong></td>
    <td>Jenis dan spesifikasi APD (misal: sarung tangan kimia vs anti-potong) ditentukan dari analisis bahaya fisik/kimia di HIRADC.</td>
    <td>Perusahaan membeli APD yang salah (misal: masker debu biasa diberikan ke pekerja pengecatan cat solven).</td>
  </tr>
  <tr>
    <td><strong>Elemen 7 (Pemantauan K3)</strong></td>
    <td>Titik lokasi pengujian lingkungan kerja (kebisingan, kimia) dan jenis MCU berkala karyawan disesuaikan dengan pajanan HIRADC.</td>
    <td>Pemeriksaan kesehatan karyawan tidak mendeteksi penyakit akibat kerja (PAK) karena jenis uji MCU tidak sesuai pajanan.</td>
  </tr>
  <tr>
    <td><strong>Elemen 12 (Pelatihan K3)</strong></td>
    <td>Matriks Analisis Kebutuhan Pelatihan (TNA) wajib mengacu pada kompetensi lisensi K3 yang disyaratkan oleh HIRADC.</td>
    <td>Karyawan dilatih materi generik yang tidak relevan dengan bahaya nyata di stasiun kerjanya.</td>
  </tr>
</table></div>

<h2 id="5-kategori-bahaya">5 Kategori Bahaya Lingkungan Kerja Sesuai Permenaker 5/2018</h2>
<p>Proses Identifikasi Bahaya (*Hazard Identification*) di tempat kerja wajib menyisir 5 kelompok bahaya utama tanpa ada yang terlewati:</p>

<div class="table-scroll"><table>
  <tr>
    <th>Kategori Bahaya</th>
    <th>Faktor Bahaya Spesifik di Tempat Kerja</th>
    <th>Contoh Dampak Risiko Kesehatan / Keselamatan</th>
  </tr>
  <tr>
    <td><strong>1. Bahaya Fisik &amp; Mekanik</strong></td>
    <td>Mesin berputar tanpa guard, permukaan panas, ketinggian, listrik tegangan tinggi, kebisingan &gt;85 dB, getaran, pencahayaan buruk.</td>
    <td>Kebutaan, terputus anggota badan (amputasi), luka bakar, jatuh fatal, Tuli Akibat Kebisingan (TAK).</td>
  </tr>
  <tr>
    <td><strong>2. Bahaya Kimia</strong></td>
    <td>Paparan gas beracun (H2S, CO), uap pelarut organik (solven), debu silika/asbes, cairan asam/basa korosif, bahan kimia peledak.</td>
    <td>Iritasi paru-paru, luka bakar kimia, kanker okupasional, keracunan akut, kecelakaan ledakan.</td>
  </tr>
  <tr>
    <td><strong>3. Bahaya Biologi</strong></td>
    <td>Bakteri patogen, virus (HIV/Hepatitis/Covid), jamur di area lembab, gigitan hewan berbisa, limbah medis infeksius.</td>
    <td>Infeksi saluran pernapasan, penyakit kulit, infeksi darah, keracunan biologis (di RS/Lab/Fasilitas limbah).</td>
  </tr>
  <tr>
    <td><strong>4. Bahaya Ergonomi</strong></td>
    <td>Angkat-angkut beban berat manual (&gt;25 kg), gerakan berulang (*repetitive motion*), postur tubuh janggal (*awkward posture*).</td>
    <td>Gangguan Otot Rangka Akibat Kerja (GOTRAK / Musculoskeletal Disorders - MSDs), HNP/saraf terjepit.</td>
  </tr>
  <tr>
    <td><strong>5. Bahaya Psikososial</strong></td>
    <td>Beban kerja berlebih, kerja shift malam berkepanjangan, kekerasan di tempat kerja, ketidakjelasan peran, intimidasi/bullying.</td>
    <td>Stres kerja berat, kelelahan kronis (*burnout*), hipertensi, penurunan konsentrasi yang memicu kecelakaan.</td>
  </tr>
</table></div>

<h2 id="hirarki-pengendalian-risiko">Hirarki Pengendalian Risiko K3 (Hierarchy of Controls)</h2>
<p>Setelah tingkat risiko dihitung, penetapan langkah pengendalian **WAJIB** mengikuti urutan hirarki 5 tingkat. Pengendalian tidak boleh langsung melompat ke penggunaan APD:</p>

<ol class="steps">
  <li><strong>Tingkat 1 — Eliminasi (Elimination):</strong> Menghilangkan sumber bahaya secara total dari tempat kerja. <br><em>Contoh:</em> Menghentikan penggunaan mesin tua berisiko tinggi dan menggantinya dengan proses otomatisasi tanpa operator.</li>
  <li><strong>Tingkat 2 — Substitusi (Substitution):</strong> Mengganti bahan/alat/proses berbahaya dengan alternatif yang lebih aman. <br><em>Contoh:</em> Mengganti pembersih berbasis solven kimia beracun (Toluene) dengan bahan pembersih berbasis air (water-based detergent).</li>
  <li><strong>Tingkat 3 — Rekayasa Teknik (Engineering Controls):</strong> Memasang isolasi fisik atau sarana proteksi teknis antara bahaya dan pekerja. <br><em>Contoh:</em> Memasang penutup mesin (*machine guarding*), sistem ventilasi hisap (*local exhaust ventilation*), interlock safety sensor, dan tanggul B3.</li>
  <li><strong>Tingkat 4 — Pengendalian Administratif (Administrative Controls):</strong> Mengatur alur kerja, prosedur, dan durasi pajanan pekerja. <br><em>Contoh:</em> Penerbitan SOP, Izin Kerja Aman (PTW), rotasi shift kerja untuk mengurangi durasi bising, dan pembatasan akses area.</li>
  <li><strong>Tingkat 5 — Alat Pelindung Diri (APD / PPE):</strong> Perlindungan tahap akhir yang melekat pada tubuh pekerja. <br><em>Contoh:</em> Penyediaan helm keselamatan, sepatu safety, earplug, harness, dan respirator masker respirator kimia.</li>
</ol>

<div class="note"><strong>Evaluasi Risiko Sisa (Residual Risk):</strong> Setelah menetapkan tindakan pengendalian, perusahaan wajib menghitung ulang skor risiko sisa. Risiko sisa harus berada pada kategori **Low** atau **Acceptable**. Jika risiko sisa masih kategori *High*, berarti langkah pengendalian yang dirancang belum memadai.</div>

<h2 id="hiradc-sehat-vs-fiktif">Matriks Perbandingan HIRADC Sehat vs HIRADC Formalitas (Fiktif)</h2>
<p>Auditor eksternal Kemnaker dengan mudah membedakan HIRADC yang benar-benar hidup di operasional perusahaan dengan HIRADC formalitas yang dibuat menjelang audit:</p>

<div class="table-scroll"><table>
  <tr>
    <th>Indikator Evaluasi</th>
    <th>HIRADC Sehat &amp; Operasional (Comply)</th>
    <th>HIRADC Formalitas / Fiktif (Non-Comply)</th>
  </tr>
  <tr>
    <td><strong>Tim Penyusun</strong></td>
    <td>Disusun oleh Tim Multidisiplin (HSE + Supervisor Area + Operator Mesin + Maintenance).</td>
    <td>Dibuat oleh 1 orang Staf HSE di belakang meja komputer tanpa pernah ke lapangan.</td>
  </tr>
  <tr>
    <td><strong>Kedalaman Deskripsi Bahaya</strong></td>
    <td>Bahaya ditulis spesifik: "Tangan terjepit pisau pemotong mesin potong miring saat clearing jam".</td>
    <td>Bahaya ditulis generik dan abstrak: "Terjepit mesin", "Terjatuh", "Terluka".</td>
  </tr>
  <tr>
    <td><strong>Status Pengendalian Ada</strong></td>
    <td>Menilai risiko berdasarkan kondisi fisik nyata yang terpasang hari ini di lapangan.</td>
    <td>Menilai risiko berdasarkan "rencana masa depan" yang belum tentu dipasang.</td>
  </tr>
  <tr>
    <td><strong>Keterlibatan Operator</strong></td>
    <td>Saat diwawancarai auditor, operator mesin tahu bahaya utama di area kerjanya.</td>
    <td>Operator mesin tidak tahu saat ditanya auditor mengenai isi tabel HIRADC.</td>
  </tr>
  <tr>
    <td><strong>Ketersediaan Re-Evaluasi</strong></td>
    <td>Dokumen memuat tanggal peninjauan berkala dan catatan revisi pasca-kejadian insiden.</td>
    <td>Dokumen tidak pernah direvisi sejak 3 tahun lalu meskipun ada penambahan mesin baru.</td>
  </tr>
</table></div>

<h2 id="5-pola-temuan-hiradc">5 Pola Temuan Auditor pada Dokumen HIRADC</h2>
<ol>
  <li><strong>Aktivitas Non-Rutin dan Maintenance Tidak Dicakup:</strong> HIRADC hanya memuat proses produksi normal. Aktivitas pembersihan tangki, pemeliharaan listrik tahunan, dan perbaikan darurat tidak ada di tabel.</li>
  <li><strong>Aktivitas Kontraktor dan Tamu Diabaikan:</strong> Pekerjaan sub-kontraktor yang memotong/mengelas di area pabrik tidak dinilai risikonya dalam register HIRADC.</li>
  <li><strong>Peta Bahaya Psikososial dan Ergonomi Kosong:</strong> Register HIRADC 100% hanya berisi bahaya fisik (mesin/kebakaran). Bahaya stres kerja, shift malam, dan angkat beban manual tidak pernah dinilai.</li>
  <li><strong>Penetapan Pengendalian Hanya Mengandalkan APD:</strong> Untuk risiko tinggi mesin potong, pengendalian yang ditulis hanya "Wajib Pakai Sarung Tangan", tanpa ada upaya membuat guard mesin.</li>
  <li><strong>Dokumen HIRADC Tidak Pernah Disosialisasikan:</strong> Lembar HIRADC disimpan di binder HSE Manager dan tidak pernah diturunkan menjadi materi *Safety Talk* atau *Instruksi Kerja* bagi operator.</li>
</ol>

<p>Pahamilah bahwa HIRADC yang disusun secara jujur dan mendalam adalah investasi keselamatan kerja terbaik perusahaan Anda. Keberhasilan penyusunan HIRADC akan memandu seluruh program K3 berjalan secara efisien, tepat sasaran, dan dijamin memuaskan saat diverifikasi dalam audit sertifikasi SMK3.</p>

