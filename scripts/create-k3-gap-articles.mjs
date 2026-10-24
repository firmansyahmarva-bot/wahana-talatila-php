import fs from 'node:fs';

const S = {
  apar: ['OSHA: Extinguisher Basics', 'https://www.osha.gov/etools/evacuation-plans-procedures/emergency-standards/portable-extinguishers/about'],
  classes: ['Kemnaker: SKKNI 2011-324, klasifikasi kebakaran', 'https://jdih.kemnaker.go.id/asset/data_puu/SKKNI%202011-324.pdf'],
  pass: ['OSHA: Fire Extinguisher Use', 'https://www.osha.gov/etools/evacuation-plans-procedures/emergency-standards/portable-extinguishers/use'],
  fireUse: ['Fire and Rescue NSW: Safe Operating of Fire Extinguishers', 'https://www.fire.nsw.gov.au/fire-safety/home-fire-safety/topics/safe-operating-of-fire-extinguishers'],
  fireGuide: ['OSHA: Using Fire Extinguishers (PDF)', 'https://www.osha.gov/sites/default/files/2019-03/fireprotection.pdf'],
  triangle: ['OSHA: Common Wellsite Incidents, fire triangle', 'https://www.osha.gov/etools/oil-and-gas/general-safety/common-wellsite-incidents'],
  dust: ['OSHA: Hazard Communication Guidance for Combustible Dusts', 'https://www.osha.gov/publications/3371combustible-dust'],
  signs: ['HSE: Safety Signs', 'https://www.hse.gov.uk/workplace-health/signs.htm'],
  signTypes: ['HSE: Safety Signs for Workplace Transport', 'https://www.hse.gov.uk/WORKPLACETRANSPORT/safetysigns/index.htm'],
  iso: ['ISO: ISO 7010:2019, registered safety signs', 'https://www.iso.org/standard/72424.html'],
  signGuide: ['HSE: Safety Signs and Signals, L64 (PDF)', 'https://www.hse.gov.uk/pubns/priced/L64.pdf'],
  fiveR: ['Kemnaker BPVP Bandung Barat: Implementasi 5S/5R', 'https://bpvpbandungbarat.kemnaker.go.id/implementasi-dan-sosialisasi-5s-untuk-peningkatan-efisiensi-efektivitas-dan-keamanan-lingkungan-kerja/'],
  house: ['CCOHS: Workplace Housekeeping', 'https://www.ccohs.ca/oshanswers/hsprograms/housekeeping/house.html'],
  report: ['CCOHS: Hazard and Near-Miss Reporting by Workers', 'https://www.ccohs.ca/oshanswers/hsprograms/report.html?wbdisable=true'],
  investigation: ['CCOHS: Incident Investigation', 'https://www.ccohs.ca/oshanswers/hsprograms/investig.html'],
  controls: ['NIOSH: Hierarchy of Controls', 'https://www.cdc.gov/niosh/hierarchy-of-controls/about/'],
  hazard: ['OSHA: Hazard Identification and Assessment', 'https://www.osha.gov/safety-management/hazard-identification'],
  ground: ['Schneider Electric: Characteristics of TT, TN and IT Systems', 'https://www.electrical-installation.org/enwiki/Characteristics_of_TT%2C_TN_and_IT_systems'],
  tt: ['Schneider Electric: TT System, Principle', 'https://www.electrical-installation.org/enwiki/TT_system_-_Principle'],
  earthTest: ['Schneider Electric: Installation and Measurements of Earth Electrodes', 'https://www.electrical-installation.org/enwiki/Installation_and_measurements_of_earth_electrodes'],
  electric: ['HSE: Electrical Safety FAQs', 'https://www.hse.gov.uk/electricity/faq.htm'],
  mcb: ['Schneider Electric Indonesia: Perbedaan MCB, ELCB dan RCBO', 'https://www.se.com/id/id/faqs/FAQ000257898/'],
};
const link = (key) => `<a href="${S[key][1]}" target="_blank" rel="noopener">${S[key][0]}</a>`;
const sources = (...keys) => '<h2>Sumber rujukan</h2><ul>' + keys.map(k=>`<li>${link(k)}</li>`).join('') + '</ul>';
const table = (caption, heads, rows) => `<table><caption>${caption}</caption><thead><tr>${heads.map(h=>`<th scope="col">${h}</th>`).join('')}</tr></thead><tbody>${rows.map(row=>`<tr><th scope="row">${row[0]}</th>${row.slice(1).map(c=>`<td>${c}</td>`).join('')}</tr>`).join('')}</tbody></table>`;
const figure = (name, alt, caption, width=1200, height=800) => `<figure><a href="/images/articles/k3-guides/${name}.webp" target="_blank" rel="noopener"><img src="/images/articles/k3-guides/${name}.webp" alt="${alt}" width="${width}" height="${height}" loading="lazy" decoding="async"></a><figcaption>${caption}</figcaption></figure>`;
const articles = [];

articles.push({
 slug:'jenis-apar-dan-fungsinya', title:'Jenis APAR dan Fungsinya',
 meta_title:'Jenis APAR dan Fungsinya: Gambar & Tabel Pemilihan',
 meta_desc:'Kenali jenis APAR air, busa, powder, CO2, dan media khusus. Lihat gambar komponen, tabel penggunaan, serta cara membaca label sebelum memilih.',
 keywords:'jenis apar, apar adalah, fungsi apar, jenis apar dan fungsinya, apar co2, apar powder',
 related:['cara-menggunakan-apar','segitiga-api','sertifikasi-k3-kebakaran-kemnaker'],
 content:`<p><strong>APAR adalah Alat Pemadam Api Ringan, yaitu alat pemadam portabel untuk menangani kebakaran tahap awal sesuai kemampuan alat dan penggunanya.</strong> Jenis APAR dibedakan antara lain berdasarkan media pemadam: air, busa, dry chemical powder, karbon dioksida (CO2), serta media khusus untuk risiko tertentu. Pemilihannya harus mengikuti bahan yang terbakar dan rating pada label tabung.</p>
<p>Warna tabung dan bentuk selang bukan bukti cukup untuk menentukan isinya. Dua APAR yang sama-sama merah dapat memiliki kemampuan berbeda. Artikel ini membantu membaca perbedaannya; urutan pengoperasian dibahas terpisah dalam <a href="/artikel/cara-menggunakan-apar/">cara menggunakan APAR</a>.</p>
<h2>Gambar APAR: bagian apa yang perlu dikenali?</h2>
${figure('apar-equipment','Ilustrasi tiga APAR: dry chemical dengan manometer, CO2 dengan corong, dan air dengan manometer','Ilustrasi buatan AI untuk mengenali bentuk komponen: kiri dry chemical, tengah CO2, kanan air. Bentuk nyata berbeda antarproduk. Identifikasi media dan rating tetap melalui label, bukan gambar ini.')}
<p><strong>Manometer</strong> menunjukkan tekanan pada model yang memilikinya; jarum pada zona operasi tidak menyatakan semua isi pasti lengkap. <strong>Pin dan segel</strong> membantu menunjukkan kesiapan serta kemungkinan alat pernah digunakan. <strong>Selang/nozzle atau corong</strong> mengarahkan media. Pada CO2, sebagian komponen pelepas dapat sangat dingin saat digunakan; pegangan yang benar mengikuti petunjuk pabrikan.</p>
<h2>Tabel jenis APAR dan kegunaannya</h2>
${table('Media pemadam: kegunaan umum dan batasnya',['Media','Kegunaan umum sesuai rating','Batas penting'],[
['Air / water','Bahan padat biasa seperti kertas dan kayu pada alat berlabel sesuai.','Jangan gunakan air biasa pada listrik bertegangan atau minyak goreng yang terbakar.'],
['Busa / foam','Sebagian bahan padat dan cairan mudah terbakar, bergantung jenis busa serta rating.','Tidak semua busa cocok untuk semua cairan; jangan menganggap aman pada listrik bertegangan.'],
['Dry chemical powder','Produk ABC dapat digunakan pada kelas yang tercantum; produk BC memiliki cakupan berbeda.','Meninggalkan residu. Powder ABC bukan pengganti serbuk khusus kebakaran logam.'],
['CO2','Umumnya untuk risiko cairan mudah terbakar dan peralatan listrik bertegangan sesuai label.','Tidak meninggalkan residu padat, tetapi dapat menimbulkan bahaya atmosfer dan tidak selalu mencegah penyalaan ulang.'],
['Wet chemical','Produk khusus untuk minyak/lemak masak dengan rating yang sesuai.','Label dapat memakai klasifikasi K atau F menurut sistem standar; jangan menyamakannya dengan semua APAR cair.'],
['Serbuk khusus logam','Jenis logam tertentu yang dinyatakan pabrikan.','Media harus cocok dengan logamnya; APAR powder serbaguna tidak otomatis cocok.']])}
<p>Rujukan teknis ${link('apar')} menjelaskan pemilihan berdasarkan jenis kebakaran. Detail media khusus juga dibahas pada ${link('fireGuide')}. Gunakan label produk untuk keputusan akhir, bukan daftar generik yang menyebut satu alat cocok untuk segala kebakaran.</p>
<h2>Kelas kebakaran A, B, C, dan D</h2>
<p>Dokumen ${link('classes')} menjelaskan konteks Indonesia: A untuk bahan padat selain logam, B untuk cairan atau gas mudah terbakar, C untuk instalasi listrik bertegangan, dan D untuk logam. Klasifikasi internasional tidak selalu menggunakan huruf yang sama untuk bahaya yang sama. Karena itu, baca keterangan bahan dan standar pada label, terutama untuk produk impor.</p>
<p>Contoh: tabung CO2 dekat panel bukan berarti boleh dipakai untuk memasuki ruang penuh asap. Pemilihan media, kemampuan pengguna, jalan keluar, dan perkembangan api semuanya menentukan apakah upaya pemadaman layak dilakukan.</p>
<h2>Cara memilih APAR untuk area kerja</h2>
<ol><li><strong>Daftar bahan dan sumber energi.</strong> Ruang arsip, dapur, bengkel logam, dan ruang panel membutuhkan penilaian berbeda.</li><li><strong>Cocokkan rating produk.</strong> Periksa media, kelas yang dicakup, kapasitas, petunjuk, dan pembatasan pemakaian.</li><li><strong>Perhatikan lingkungan.</strong> Angin, ruang sempit, akses, dan peralatan sensitif memengaruhi pilihan serta penggunaannya.</li><li><strong>Atur penempatan dan kesiapan.</strong> Tentukan jumlah, cakupan, serta akses berdasarkan penilaian area dan ketentuan yang berlaku, bukan satu rumus luas lantai tanpa konteks.</li><li><strong>Siapkan pengguna dan pemeliharaan.</strong> Alat yang cocok tetap memerlukan petugas terlatih dan pemeriksaan.</li></ol>
<h2>Contoh memilih: arsip, panel, dan dapur</h2>
<p><strong>Area arsip:</strong> periksa beban bahan padat dan rating yang mencakupnya. <strong>Ruang panel:</strong> evaluasi bahaya listrik bertegangan dan konsekuensi residu; isolasi listrik hanya oleh pihak berwenang. <strong>Dapur komersial:</strong> identifikasi minyak/lemak masak, alat, dan sistem proteksi yang diperlukan. Ketiga contoh ini adalah pertanyaan penilaian, bukan spesifikasi pengadaan untuk semua bangunan.</p>
<h2>Kesalahan yang perlu dihindari</h2>
<ul><li>Menganggap semua tabung merah berisi media sama.</li><li>Menyamakan tekanan dengan jumlah media yang masih tersedia.</li><li>Menggunakan powder ABC untuk semua kebakaran logam.</li><li>Membeli berdasarkan berat tabung saja tanpa membaca rating.</li><li>Menaruh APAR di belakang tumpukan karena tempatnya terlihat rapi.</li></ul>
<p>Untuk memahami mengapa medianya berbeda, lanjutkan ke <a href="/artikel/segitiga-api/">segitiga api</a>. Untuk pengembangan kemampuan tim, lihat <a href="/artikel/sertifikasi-k3-kebakaran-kemnaker/">pelatihan K3 kebakaran</a>.</p>
${sources('apar','classes','fireGuide')}`,
 faqs:[['Apa saja jenis APAR?','Jenis media yang umum meliputi air, busa, dry chemical powder, dan CO2. Ada juga wet chemical serta media khusus logam. Kemampuan setiap produk mengikuti label dan ratingnya.'],['Apakah APAR CO2 selalu memiliki manometer?','Banyak APAR CO2 tidak memakai manometer. Cara memeriksa kesiapan dan jumlah isi mengikuti petunjuk serta prosedur pemeliharaan modelnya.'],['Apakah APAR ABC cocok untuk semua kebakaran?','Tidak. Rating ABC tidak mencakup setiap risiko, misalnya logam tertentu atau minyak masak yang membutuhkan media khusus.'],['Bolehkah memilih APAR dari warna tabung?','Tidak cukup. Periksa label media, rating, petunjuk, dan kondisi alat. Warna serta bentuk tidak menggantikan informasi tersebut.']]
});

articles.push({slug:'rambu-k3',title:'Rambu K3: Gambar, Arti & Warna',meta_title:'Rambu K3: Gambar, Arti Warna & Contoh Penggunaan',meta_desc:'Pahami gambar rambu K3: larangan, perintah, peringatan, kondisi aman, dan pemadam. Pelajari arti warna, bentuk, serta contoh penempatannya.',keywords:'rambu k3, gambar rambu k3, simbol keselamatan kerja, arti warna rambu k3, rambu keselamatan kerja',related:['logo-k3','5r-adalah','safety-induction-pengenalan-k3-pekerja-baru'],
content:`<p><strong>Rambu K3 adalah tanda yang menyampaikan larangan, kewajiban, peringatan bahaya, kondisi aman, atau lokasi perlengkapan keselamatan.</strong> Untuk membacanya, perhatikan bentuk, warna, simbol, dan teks pendamping secara bersamaan. Warna merah, misalnya, dapat digunakan untuk larangan maupun lokasi alat pemadam; bentuk dan gambarnya membedakan pesan tersebut.</p>
<p>Galeri pembuka memperlihatkan lima kelompok beserta contoh pesan. Klik gambar untuk memperbesar. Ilustrasi pada halaman ini dibuat untuk belajar membaca rambu, bukan berkas produksi yang telah dinyatakan sesuai standar.</p>
<h2>Arti warna dan bentuk rambu K3</h2>
${table('Lima kelompok rambu dan cara membacanya',['Kelompok','Ciri visual','Pesan yang disampaikan'],[
['Larangan','Lingkaran dengan garis tepi dan garis diagonal merah.','Tindakan tertentu tidak boleh dilakukan, misalnya merokok.'],
['Perintah / kewajiban','Lingkaran biru dengan simbol putih.','Lakukan tindakan tertentu, misalnya memakai pelindung kepala.'],
['Peringatan','Segitiga kuning dengan tepi dan simbol hitam.','Ada bahaya yang harus diwaspadai, misalnya listrik.'],
['Kondisi aman','Persegi/persegi panjang hijau dengan simbol putih.','Informasi keselamatan seperti pertolongan pertama atau arah keluar.'],
['Peralatan pemadam','Persegi/persegi panjang merah dengan simbol putih.','Lokasi perlengkapan pemadaman, misalnya APAR.']])}
<p>Pembedaan kelompok dijelaskan dalam ${link('signTypes')} dan ${link('signGuide')}. ${link('iso')} membahas rambu keselamatan terdaftar. Rujukan luar negeri di sini digunakan untuk menjelaskan desain dan pesan, bukan sebagai pernyataan hukum yang otomatis berlaku pada semua lokasi Indonesia.</p>
<h2>Contoh rambu K3 dan tindakan pembaca</h2>
<h3>Dilarang merokok</h3><p>Maknanya adalah larangan merokok pada area yang ditandai. Dalam induksi, jelaskan batas area larangan dan kebijakan lokasi tentang sumber penyalaan. Jangan mengganti simbol larangan dengan gambar rokok saja karena pesan “dilarang” dapat hilang.</p>
<h3>Wajib memakai pelindung kepala</h3><p>Rambu biru menunjukkan tindakan yang harus dipenuhi sebelum memasuki area. Jenis serta kesesuaian pelindung kepala ditentukan penilaian bahaya dan ketentuan lokasi; gambar helm tidak menentukan seluruh spesifikasi APD.</p>
<h3>Peringatan bahaya listrik</h3><p>Segitiga dengan simbol petir menunjukkan bahaya listrik. Rambu ini tidak memberi kewenangan untuk membuka panel. Pembatasan akses dan prosedur kerja tetap diperlukan. Penandaan harus berada pada lokasi yang membuat bahaya dikenali sebelum orang terpapar.</p>
<h3>Pertolongan pertama dan arah keluar</h3><p>Palang pertolongan pertama menunjukkan fasilitas terkait, sedangkan tanda arah keluar mengarahkan pergerakan menuju rute yang ditentukan. Ikuti rangkaian rambu dan prosedur evakuasi lokasi. Panah yang salah arah dapat menyesatkan meskipun warna dan gambarnya terlihat benar.</p>
<h3>Lokasi APAR</h3><p>Rambu pemadam menunjukkan tempat alat, bukan perintah untuk memadamkan semua api. Penggunaan tetap memerlukan penilaian, alat sesuai, serta pengguna yang memahami batasnya. Lihat <a href="/artikel/cara-menggunakan-apar/">panduan penggunaan APAR</a>.</p>
<h2>Perbedaan rambu K3 dan logo K3</h2>
<p><a href="/artikel/logo-k3/">Logo K3</a> adalah lambang keselamatan dan kesehatan kerja; rambu menyampaikan pesan khusus. Memasang lambang K3 pada pintu ruang panel tidak menjelaskan larangan masuk atau bahaya listrik sejelas rambu yang sesuai. Tentukan pesan yang dibutuhkan, lalu pilih simbolnya.</p>
<h2>Cara menempatkan rambu agar mudah dipahami</h2>
<ol><li><strong>Tentukan keputusan pembaca.</strong> Apakah orang perlu berhenti, mengenakan APD, atau memilih arah?</li><li><strong>Pasang sebelum titik keputusan.</strong> Orang perlu mengetahui persyaratan sebelum memasuki area, bukan sesudah melewati bahaya.</li><li><strong>Periksa garis pandang.</strong> Pintu terbuka, rak, kendaraan, dan tumpukan dapat menutupi tanda.</li><li><strong>Uji dari posisi pengguna.</strong> Lihat keterbacaan pada jarak, pencahayaan, dan arah pendekatan yang sebenarnya.</li><li><strong>Jaga konsistensi.</strong> Perubahan jalur, fasilitas, atau tata letak harus diikuti pembaruan tanda dan penjelasan kepada tim.</li></ol>
<p>${link('signs')} menekankan bahwa rambu melengkapi pengendalian risiko. Menambahkan lebih banyak papan tidak menggantikan pelindung mesin, pemisahan jalur, atau penghilangan hambatan.</p>
<h2>Checklist pemeriksaan rambu</h2>
<ul><li>Pesan sesuai bahaya atau fasilitas yang benar-benar ada.</li><li>Simbol, bentuk, warna, dan teks tidak bertentangan.</li><li>Panah mengarah ke tujuan aktual.</li><li>Terlihat tanpa tertutup barang atau pantulan.</li><li>Kondisi fisik terbaca dan tidak pudar.</li><li>Pekerja dan pengunjung memahami tindakan yang diminta.</li></ul>
<p>Contoh latihan: pintu darurat memiliki rambu hijau, tetapi aksesnya tertutup kotak. Memperbesar rambu bukan tindakan utama; buka akses dan perbaiki pengelolaan penyimpanan. Panduan <a href="/artikel/5r-adalah/">penerapan 5R</a> membantu menata agar kondisi tersebut tidak berulang.</p>
${sources('signTypes','signGuide','iso','signs')}`,
faqs:[['Apa arti warna biru pada rambu K3?','Pada rambu berbentuk lingkaran, biru dengan simbol putih umumnya menyampaikan kewajiban, misalnya memakai APD tertentu. Baca bentuk dan simbolnya bersama warna.'],['Apakah semua rambu merah berarti larangan?','Tidak. Lingkaran merah bergaris diagonal menyampaikan larangan, sedangkan bidang merah dengan simbol perlengkapan dapat menunjukkan lokasi alat pemadam.'],['Apa beda rambu K3 dan logo K3?','Rambu menyampaikan pesan atau tindakan khusus. Logo K3 adalah lambang keselamatan dan kesehatan kerja secara umum.'],['Apakah gambar di artikel ini bisa menjadi master rambu resmi?','Tidak. Gambar adalah ilustrasi edukatif. Untuk pemasangan operasional, gunakan desain, ukuran, bahan, dan penempatan yang memenuhi standar serta ketentuan lokasi.']]
});

articles.push({slug:'5r-adalah',title:'5R: Pengertian & Contoh Penerapan',meta_title:'5R Adalah: Pengertian, Contoh Penerapan & Checklist',meta_desc:'5R adalah Ringkas, Rapi, Resik, Rawat, dan Rajin. Pelajari contoh di tempat kerja, perbedaan 5R dan 5S, gambar sebelum-sesudah, serta checklist.',keywords:'5r adalah, contoh 5r, penerapan 5r, ringkas rapi resik rawat rajin, 5r dan 5s',related:['rambu-k3','near-miss','inspeksi-k3-rutin-checklist'],
content:`<p><strong>5R adalah Ringkas, Rapi, Resik, Rawat, dan Rajin: pendekatan menata serta memelihara tempat kerja agar barang mudah ditemukan, area terjaga, dan kebiasaan baik berlanjut.</strong> 5R merupakan padanan bahasa Indonesia untuk 5S: Seiri, Seiton, Seiso, Seiketsu, dan Shitsuke.</p>
<p>Tujuannya bukan hanya membuat meja terlihat bersih saat ada tamu. Hasil yang lebih berguna adalah jalur tidak menjadi tempat menyimpan barang, alat kembali ke lokasi yang tepat, dan penyimpangan cepat terlihat. ${link('fiveR')} menjelaskan padanan serta penerapan metode ini.</p>
<h2>Gambar sebelum dan sesudah penerapan 5R</h2>
${figure('5r-before-after','Perbandingan bengkel yang sama: kiri alat bercampur dan kotak menghalangi jalur; kanan alat tertata dan jalur terbuka','Ilustrasi buatan AI untuk latihan pengamatan. Bandingkan akses jalan, tempat alat, dan penyimpanan; gambar sesudah belum membuktikan seluruh risiko bengkel telah dikendalikan.')}
<p>Perhatikan tiga perubahan: kotak yang tidak diperlukan disingkirkan, lokasi alat dibuat jelas, dan jalur dibebaskan. Agar bertahan, perlu pemilik area, standar penataan, dan pemeriksaan rutin. Foto “sesudah” saja belum memperlihatkan apakah sistem tersebut dijalankan setiap hari.</p>
<h2>Arti 5R dan padanannya dalam 5S</h2>
${table('Dari istilah ke tindakan yang bisa diperiksa',['5R / 5S','Pertanyaan kunci','Contoh tindakan'],[
['Ringkas / Seiri','Apakah barang ini diperlukan untuk pekerjaan di area ini?','Pisahkan stok aktif, barang rusak, dan barang menunggu keputusan.'],
['Rapi / Seiton','Di mana tempat yang tepat agar mudah diambil dan dikembalikan?','Tetapkan lokasi alat dengan penanda bentuk atau nama.'],
['Resik / Seiso','Apa yang perlu dibersihkan dan diperiksa sumber kotornya?','Bersihkan area dan laporkan sumber kebocoran, bukan hanya mengelap berulang.'],
['Rawat / Seiketsu','Standar apa yang menjaga tiga langkah awal?','Buat kondisi acuan, pembagian area, dan jadwal pemeriksaan.'],
['Rajin / Shitsuke','Bagaimana perilaku serta tindak lanjut dibuat konsisten?','Lakukan pemeriksaan singkat dan selesaikan temuan sesuai tanggung jawab.']])}
<h2>Contoh penerapan 5R di gudang</h2>
<p><strong>Ringkas:</strong> daftar barang di rak dan pisahkan barang yang tidak lagi digunakan ke area berstatus jelas. Jangan membuang bahan atau limbah tanpa prosedur. <strong>Rapi:</strong> tentukan lokasi penyimpanan dan akses pengambilan. Barang tidak boleh menonjol ke jalur hanya karena masih muat di rak.</p>
<p><strong>Resik:</strong> cari sumber debu, tumpahan, atau kemasan yang rusak. <strong>Rawat:</strong> gunakan foto acuan dan pembagian tanggung jawab. <strong>Rajin:</strong> saat serah terima shift, cek penyimpangan dan catat tindakan yang belum selesai. Ukuran keberhasilan bukan jumlah foto, melainkan apakah orang bisa bekerja tanpa harus memindahkan hambatan setiap kali.</p>
<h2>Contoh penerapan 5R di kantor</h2>
<p>Pilih dokumen aktif, arsip, dan salinan yang boleh dihapus mengikuti kebijakan retensi. Tetapkan tempat perlengkapan bersama serta tata kabel yang tidak mengganggu akses. Bersihkan area kerja dengan metode yang cocok untuk peralatan. Buat aturan penyimpanan dan jadwal peninjauan; jangan menjadikan 5R alasan membuang dokumen penting atau memindahkan alat keselamatan.</p>
<p>Dalam ruang digital, prinsip serupa dapat dipakai untuk penamaan berkas, lokasi dokumen resmi, dan penghapusan duplikasi yang telah disetujui. Pastikan orang tahu versi yang berlaku, siapa pemiliknya, dan bagaimana meminta perubahan.</p>
<h2>Cara memulai program 5R</h2>
<ol><li>Pilih satu area dengan batas dan pemilik yang jelas.</li><li>Catat kondisi awal serta masalah nyata: pencarian alat lama, akses tertutup, atau barang tidak teridentifikasi.</li><li>Sepakati barang yang diperlukan dan mekanisme keputusan untuk sisanya.</li><li>Susun lokasi penyimpanan bersama pengguna area.</li><li>Periksa hasil dari posisi orang yang bekerja, membawa barang, atau merespons keadaan darurat.</li><li>Tetapkan standar sederhana dan tinjau setelah beberapa siklus kerja.</li></ol>
<h2>Checklist 5R yang dapat dipakai saat inspeksi</h2>
${table('Contoh checklist internal; bukan skor sertifikasi',['Pemeriksaan','Bukti yang dicari','Tindak lanjut jika belum sesuai'],[
['Barang diperlukan','Daftar/status barang di area jelas.','Tentukan pemilik keputusan dan tenggatnya.'],
['Lokasi penyimpanan','Alat dapat diambil dan dikembalikan tanpa menutup jalan.','Perbaiki tempat dan kapasitas penyimpanan.'],
['Kebersihan dan sumbernya','Tumpahan ditangani dan penyebabnya ditelusuri.','Laporkan kerusakan serta kontrol sementara.'],
['Standar area','Acuan dan tanggung jawab tersedia.','Buat panduan singkat yang dipahami pengguna.'],
['Konsistensi','Temuan lama diperiksa penyelesaiannya.','Verifikasi hasil, bukan hanya status “selesai”.']])}
<p>${link('house')} menekankan housekeeping sebagai kegiatan berkelanjutan yang juga mencakup tata letak dan akses. Pengecatan garis di lantai tidak cukup bila lokasi penyimpanan memang tidak sanggup menampung barang.</p>
<h2>Kesalahan umum dalam program 5R</h2>
<ul><li>Menyamakan 5R dengan kerja bakti satu hari.</li><li>Memindahkan barang bermasalah ke area orang lain.</li><li>Menggunakan label tanpa menentukan pemilik dan tindak lanjut.</li><li>Mengejar nilai audit sambil mengabaikan akses darurat.</li><li>Menganggap tempat bersih berarti semua mesin dan instalasi aman.</li></ul>
<p>Hubungkan hasil 5R dengan <a href="/artikel/inspeksi-k3-rutin-checklist/">inspeksi K3 rutin</a> dan <a href="/artikel/near-miss/">pelaporan near miss</a>. Jika hambatan yang sama terus muncul, tinjau kapasitas dan aliran barang, bukan sekadar mengingatkan pekerja agar lebih rajin.</p>
${sources('fiveR','house')}`,
faqs:[['Apa kepanjangan 5R?','Ringkas, Rapi, Resik, Rawat, dan Rajin. Kelimanya menghubungkan penataan awal dengan standar serta kebiasaan yang mempertahankannya.'],['Apa perbedaan 5R dan 5S?','5R adalah padanan Indonesia dari 5S Jepang: Seiri, Seiton, Seiso, Seiketsu, dan Shitsuke. Fokus penerapannya serupa.'],['Apa beda Ringkas dan Rapi?','Ringkas memilih barang yang diperlukan. Rapi menetapkan tempat barang tersebut agar mudah ditemukan, digunakan, dan dikembalikan.'],['Apakah 5R cukup dilakukan sekali?','Tidak. Penataan awal perlu dilanjutkan dengan standar, tanggung jawab, pemeriksaan, dan tindak lanjut penyimpangan.']]
});

articles.push({slug:'segitiga-api',title:'Segitiga Api: Unsur & Penjelasannya',meta_title:'Segitiga Api: Gambar, 3 Unsur & Contoh Pencegahan',meta_desc:'Segitiga api terdiri dari panas, bahan bakar, dan oksigen. Pahami diagram, contoh di tempat kerja, cara pencegahan, serta bedanya dengan tetrahedron.',keywords:'segitiga api, unsur segitiga api, teori segitiga api, gambar segitiga api, tetrahedron api',related:['jenis-apar-dan-fungsinya','cara-menggunakan-apar','izin-kerja-panas-hot-work-permit'],
content:`<p><strong>Segitiga api adalah model yang menjelaskan tiga unsur pembentukan api: panas, bahan bakar, dan oksigen.</strong> Jika kondisi pembakaran tidak terpenuhi karena salah satu unsur dikendalikan, api dapat dicegah atau dipadamkan. Diagram ini membantu memahami prinsipnya, tetapi bukan petunjuk bahwa semua kebakaran aman ditangani sendiri.</p>
<p>Contoh sederhana di bengkel: percikan pekerjaan panas menjadi sumber penyalaan, bahan mudah terbakar tersedia di sekitarnya, dan udara menyediakan oksigen. Pencegahan harus memeriksa kombinasi tersebut, bukan hanya memastikan ada APAR di dekat pekerjaan.</p>
<h2>Gambar segitiga api dan arti setiap unsur</h2>
<p>Diagram pembuka menempatkan setiap unsur pada satu sudut dan contoh kontrol di dekatnya. Panah menunjukkan hubungan konsep, bukan arah penyebaran api. Klik untuk melihat label dengan ukuran penuh.</p>
${table('Tiga unsur api dan contoh sumbernya',['Unsur','Peran dalam konsep','Contoh yang perlu dinilai'],[
['Panas','Energi yang memulai atau mempertahankan pembakaran.','Percikan las, permukaan panas, nyala terbuka, gesekan.'],
['Bahan bakar','Material yang dapat bereaksi dalam pembakaran.','Kertas, kayu, cairan mudah terbakar, uap atau gas tertentu.'],
['Oksigen','Mendukung reaksi pembakaran pada kondisi yang sesuai.','Udara sekitar; kondisi kaya oksigen memerlukan perhatian khusus.']])}
<p>${link('triangle')} menjelaskan bahwa konsentrasi bahan bakar dan oksigen serta sumber penyalaan harus berada pada kondisi yang memungkinkan. Kehadiran bahan di ruangan saja tidak menyatakan api pasti terbentuk pada saat itu.</p>
<h2>Contoh segitiga api di tempat kerja</h2>
<h3>Pekerjaan pengelasan dekat penyimpanan</h3>
<p>Dalam skenario latihan, kotak karton disimpan dekat pekerjaan las. Pertanyaan pertama adalah apakah pekerjaan dapat dipindahkan atau material disingkirkan dengan aman. Setelah itu periksa area sekitarnya, termasuk sisi lain penghalang dan tempat percikan mungkin mencapai bahan. Rambu tidak menggantikan pemisahan serta pemeriksaan tersebut.</p>
<h3>Cairan mudah terbakar dekat sumber panas</h3>
<p>Identifikasi bahan dari label dan SDS. Kondisi penyimpanan, penutupan wadah, potensi pelepasan uap, serta sumber penyalaan perlu dinilai. Jangan menilai aman hanya karena tidak terlihat tumpahan. Gunakan <a href="/artikel/panduan-msds-sds-bahan-kimia/">SDS bahan kimia</a> sebagai informasi awal, lalu ikuti prosedur lokasi.</p>
<h3>Debu bahan mudah terbakar</h3>
<p>Untuk debu tertentu, pembahasan ledakan juga melibatkan penyebaran debu dan pengurungan. ${link('dust')} membedakan konsep tersebut dari segitiga api sederhana. Jangan melakukan demonstrasi dengan menerbangkan debu di dekat api untuk “membuktikan” teorinya.</p>
<h2>Bagaimana mengendalikan unsur segitiga api?</h2>
${table('Prinsip pengendalian dan batas penerapannya',['Prinsip','Contoh pencegahan','Yang tidak boleh disimpulkan'],[
['Mengendalikan sumber panas','Hilangkan atau pisahkan sumber penyalaan dari bahan mudah terbakar.','Mematikan satu alat pasti menghilangkan seluruh energi panas.'],
['Mengurangi bahan bakar','Atur persediaan serta singkirkan bahan yang tidak diperlukan dari area kerja.','Boleh memindahkan wadah yang sudah terpapar api tanpa penilaian.'],
['Mengendalikan oksigen pada proses tertentu','Gunakan sistem yang dirancang khusus dan dikelola personel kompeten.','Aman masuk ke ruang yang oksigennya dikurangi.']])}
<p>Pada pemadaman, media bekerja melalui mekanisme yang berbeda dan harus cocok dengan jenis kebakaran. Air bukan jawaban universal; penggunaan yang salah pada minyak masak atau listrik bertegangan dapat menambah bahaya. Pilih berdasarkan rating serta petunjuk dalam <a href="/artikel/jenis-apar-dan-fungsinya/">panduan jenis APAR</a>.</p>
<h2>Perbedaan segitiga api dan tetrahedron api</h2>
<p>Tetrahedron menambahkan <strong>reaksi berantai kimia</strong> sebagai unsur keempat. Model tersebut membantu menjelaskan bahwa menghentikan reaksi juga dapat berperan dalam pemadaman. Model dasar dan pengembangan ini dibahas pada ${link('apar')}. Keduanya adalah cara memahami proses; tidak menentukan sendiri kapasitas alat atau metode respons suatu lokasi.</p>
<h2>Latihan: cari kontrol sebelum memilih alat</h2>
<p>Bayangkan pekerjaan panas akan dilakukan di ruang yang sebelumnya dipakai menyimpan kemasan. Tim menemukan serpihan karton di bawah meja dan tidak mengetahui isi wadah tertutup. Jawaban yang berguna bukan langsung “siapkan powder”. Hentikan persiapan yang belum jelas, identifikasi bahan, tata area, lalu evaluasi metode dan pengendalian melalui sistem izin kerja.</p>
<p>Catat tiga kolom: <strong>sumber panas yang ada, bahan yang mungkin terpapar, dan pengendalian sebelum mulai</strong>. Beri penanggung jawab serta bukti verifikasi. Tinjau lagi jika metode, material, atau kondisi area berubah. Lihat <a href="/artikel/izin-kerja-panas-hot-work-permit/">izin kerja panas</a> untuk konteks pelaksanaannya.</p>
<h2>Kesalahan memahami teori segitiga api</h2>
<ul><li>Menyamakan titik nyala dengan jaminan bahan akan menyala pada semua kondisi.</li><li>Menganggap api kecil selalu mudah dipadamkan tanpa melihat asap dan jalur keluar.</li><li>Menggunakan teori “kurangi oksigen” sebagai alasan masuk ke ruang berbahaya.</li><li>Mencoba media pemadam yang tidak sesuai bahan.</li></ul>
<p>Jika api berkembang, asap mengganggu, bahan tidak diketahui, atau jalur keluar terancam, utamakan alarm dan evakuasi sesuai prosedur. Latihan teori sebaiknya dilanjutkan dengan pembelajaran praktik terkontrol, bukan percobaan api di tempat kerja.</p>
${sources('triangle','dust','apar')}`,
faqs:[['Apa tiga unsur segitiga api?','Panas, bahan bakar, dan oksigen. Pembakaran juga bergantung pada kondisi material, konsentrasi, serta sumber penyalaan yang sesuai.'],['Apa perbedaan segitiga dan tetrahedron api?','Tetrahedron menambahkan reaksi berantai kimia sebagai unsur keempat. Keduanya adalah model penjelasan proses pembakaran.'],['Apakah semua api bisa dipadamkan dengan air?','Tidak. Air biasa tidak boleh digunakan pada listrik bertegangan atau minyak masak yang terbakar. Metode dan media harus sesuai bahaya serta petunjuk alat.'],['Apa contoh segitiga api di bengkel?','Percikan pekerjaan panas, kemasan mudah terbakar, dan udara dapat membentuk kombinasi yang perlu dikendalikan sebelum pekerjaan dilakukan.']]
});

// Remaining four guides are defined in the companion module to keep authoring reviewable.
const { moreArticles } = await import('./k3-gap-articles-more.mjs');
articles.push(...moreArticles({link,sources,table,figure}));
const existing = fs.readdirSync('data/articles').filter(f=>f.endsWith('.json')).map(f=>JSON.parse(fs.readFileSync('data/articles/'+f,'utf8')));
let nextId = Math.max(...existing.map(a=>a.id)) + 1;
for (const entry of articles) {
 const old = existing.find(a=>a.slug===entry.slug);
 const faq_list = entry.faqs.map(([q,a])=>({q,a}));
 const record = {id:old?.id ?? nextId++,title:entry.title,slug:entry.slug,meta_title:entry.meta_title,meta_desc:entry.meta_desc,keywords:entry.keywords,topic:'k3',topic_tags:entry.keywords.split(', ').slice(0,4),related_article_slugs:entry.related,category:'K3',thumbnail:`/images/articles/k3-guides/${entry.slug}.png`,content:entry.content,faq_list,faq_data:JSON.stringify(faq_list),author:'Wahana Totalita Konsultan',status:'published',published_at:'2026-10-25T00:00:00+07:00',created_at:old?.created_at || '2026-10-25T00:00:00+07:00',updated_at:'2026-10-25T00:00:00+07:00',view_count:old?.view_count || 0};
 fs.writeFileSync(`data/articles/${entry.slug}.json`,JSON.stringify(record,null,4)+'\n');
}
fs.mkdirSync('output/k3-gap-articles',{recursive:true});
fs.writeFileSync('output/k3-gap-articles/manifest.json',JSON.stringify(articles.map(a=>({slug:a.slug,title:a.title})),null,2));
console.log(`Created ${articles.length} article records.`);
