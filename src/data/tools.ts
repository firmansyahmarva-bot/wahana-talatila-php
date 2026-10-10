export interface ToolItem {
  id: string;
  href: string;
  category: 'lapangan' | 'kalkulator' | 'regulasi' | 'edukasi';
  categoryName: string;
  title: string;
  badge: string;
  desc: string;
  tags: string[];
  searchKeywords: string;
  iconSvg: string;
}

export const TOOLS_DATA: ToolItem[] = [
  {
    "id": "tool-1",
    "href": "/tools/safety-talk/",
    "category": "edukasi",
    "categoryName": "Edukasi & Kampanye K3",
    "title": "100 Materi Safety Talk & Toolbox Meeting (TBM)",
    "badge": "Paling Populer",
    "desc": "Database 100 topik materi safety talk harian K3 terlengkap dengan poin diskusi 2 arah, fakta statistik, dan lembar daftar hadir absensi siap cetak.",
    "tags": [
      "Toolbox Meeting",
      "Absensi TBM",
      "100 Topik"
    ],
    "searchKeywords": "100 materi safety talk & toolbox meeting (tbm) database 100 topik materi safety talk harian k3 terlengkap dengan poin diskusi 2 arah, fakta statistik, dan lembar daftar hadir absensi siap cetak. toolbox meeting absensi tbm 100 topik",
    "iconSvg": "<svg width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><path d=\"M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253\"/></svg>"
  },
  {
    "id": "tool-2",
    "href": "/tools/kalkulator-k3/",
    "category": "kalkulator",
    "categoryName": "Kalkulator K3 & Finansial",
    "title": "Kalkulator Statistik K3 (FR, SR, IR & Safe T-Score)",
    "badge": "Standar Kemnaker",
    "desc": "Hitung indikator kinerja K3 resmi: Frequency Rate (FR), Severity Rate (SR), Incident Rate, dan Piramida Heinrich sesuai Kepmenaker 372/1989 & OSHA.",
    "tags": [
      "Kepmenaker 372/1989",
      "OSHA 1904",
      "Laporan P2K3"
    ],
    "searchKeywords": "kalkulator statistik k3 (fr, sr, ir & safe t-score) hitung indikator kinerja k3 resmi: frequency rate (fr), severity rate (sr), incident rate, dan piramida heinrich sesuai kepmenaker 372/1989 & osha. kepmenaker 372/1989 osha 1904 laporan p2k3",
    "iconSvg": "<svg width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><path d=\"M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z\"/></svg>"
  },
  {
    "id": "tool-3",
    "href": "/tools/jsa-builder/",
    "category": "lapangan",
    "categoryName": "Manajemen Risiko & Lapangan",
    "title": "JSA Builder (Job Safety Analysis Generator)",
    "badge": "Siap Cetak",
    "desc": "Generator penyusun formulir analisis keselamatan kerja langkah demi langkah dengan 6 template pekerjaan risiko tinggi dan cetak form tanda tangan resmi.",
    "tags": [
      "Izin Kerja PTW",
      "Hierarki Kontrol",
      "Format Resmi"
    ],
    "searchKeywords": "jsa builder (job safety analysis generator) generator penyusun formulir analisis keselamatan kerja langkah demi langkah dengan 6 template pekerjaan risiko tinggi dan cetak form tanda tangan resmi. izin kerja ptw hierarki kontrol format resmi",
    "iconSvg": "<svg width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><path d=\"M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4\"/></svg>"
  },
  {
    "id": "tool-4",
    "href": "/tools/risk-matrix/",
    "category": "lapangan",
    "categoryName": "Manajemen Risiko & Lapangan",
    "title": "Matriks Risiko 5x5 K3 (ISO 31000 & HIRARC)",
    "badge": "ISO 31000",
    "desc": "Kalkulator evaluasi matriks risiko 5x5 interaktif berdasarkan Peluang (Likelihood) dan Keparahan (Consequence) serta pembuatan tabel Risk Register.",
    "tags": [
      "Low to Extreme",
      "ALARP",
      "Risk Register"
    ],
    "searchKeywords": "matriks risiko 5x5 k3 (iso 31000 & hirarc) kalkulator evaluasi matriks risiko 5x5 interaktif berdasarkan peluang (likelihood) dan keparahan (consequence) serta pembuatan tabel risk register. low to extreme alarp risk register",
    "iconSvg": "<svg width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><path d=\"M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z\"/></svg>"
  },
  {
    "id": "tool-5",
    "href": "/tools/kalkulator-kebisingan/",
    "category": "kalkulator",
    "categoryName": "Kalkulator K3 & Finansial",
    "title": "Kalkulator Paparan Kebisingan Permenaker 5/2018",
    "badge": "Permenaker 5/2018",
    "desc": "Hitung Dosis Kebisingan Kumulatif (%), TWA 8-Jam (dBA), batas pajanan waktu kerja maksimal, serta uji proteksi riil APD telinga (NRR Derating).",
    "tags": [
      "NAB 85 dBA",
      "TWA 8 Jam",
      "Earplug & Earmuff"
    ],
    "searchKeywords": "kalkulator paparan kebisingan permenaker 5/2018 hitung dosis kebisingan kumulatif (%), twa 8-jam (dba), batas pajanan waktu kerja maksimal, serta uji proteksi riil apd telinga (nrr derating). nab 85 dba twa 8 jam earplug & earmuff",
    "iconSvg": "<svg width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><path d=\"M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z\"/></svg>"
  },
  {
    "id": "tool-6",
    "href": "/tools/kalkulator-biaya-k3/",
    "category": "kalkulator",
    "categoryName": "Kalkulator K3 & Finansial",
    "title": "Kalkulator Biaya Kecelakaan Kerja (Heinrich & Bird)",
    "badge": "Teori Gunung Es",
    "desc": "Analisis total kerugian finansial akibat kecelakaan kerja berdasarkan Teori Gunung Es K3 (biaya langsung vs biaya tersembunyi) dan ROI program K3.",
    "tags": [
      "Rasio 1:4 & 1:10",
      "Hidden Costs",
      "ROI Safety"
    ],
    "searchKeywords": "kalkulator biaya kecelakaan kerja (heinrich & bird) analisis total kerugian finansial akibat kecelakaan kerja berdasarkan teori gunung es k3 (biaya langsung vs biaya tersembunyi) dan roi program k3. rasio 1:4 & 1:10 hidden costs roi safety",
    "iconSvg": "<svg width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><path d=\"M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z\"/></svg>"
  },
  {
    "id": "tool-7",
    "href": "/tools/regulasi-k3/",
    "category": "regulasi",
    "categoryName": "Regulasi & Dokumen K3",
    "title": "Database Regulasi K3 Indonesia Terlengkap",
    "badge": "Database Hukum",
    "desc": "Koleksi peraturan perundang-undangan K3 lengkap: UU No. 1/1970, PP No. 50/2012, Permenaker, dan Kepmenaker dengan pasal krusial dan sanksi hukum.",
    "tags": [
      "UU 1/1970",
      "PP 50/2012",
      "Sanksi Pidana"
    ],
    "searchKeywords": "database regulasi k3 indonesia terlengkap koleksi peraturan perundang-undangan k3 lengkap: uu no. 1/1970, pp no. 50/2012, permenaker, dan kepmenaker dengan pasal krusial dan sanksi hukum. uu 1/1970 pp 50/2012 sanksi pidana",
    "iconSvg": "<svg width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><path d=\"M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253\"/></svg>"
  },
  {
    "id": "tool-8",
    "href": "/tools/apd-selector/",
    "category": "lapangan",
    "categoryName": "Manajemen Risiko & Lapangan",
    "title": "Panduan Pemilihan APD K3 (SNI & Permenaker 08/2010)",
    "badge": "Permenaker 08/2010",
    "desc": "Spesifikasi teknis alat pelindung diri 7 organ tubuh sesuai Permenaker No. 08/2010, standar SNI, ANSI, & EN lengkap dengan panduan inspeksi kelayakan pra-pakai.",
    "tags": [
      "Standar SNI/ANSI",
      "7 Organ Tubuh",
      "Inspeksi Pra-Pakai"
    ],
    "searchKeywords": "panduan pemilihan apd k3 (sni & permenaker 08/2010) spesifikasi teknis alat pelindung diri 7 organ tubuh sesuai permenaker no. 08/2010, standar sni, ansi, & en lengkap dengan panduan inspeksi kelayakan pra-pakai. standar sni/ansi 7 organ tubuh inspeksi pra-pakai",
    "iconSvg": "<svg width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><path d=\"M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z\"/></svg>"
  },
  {
    "id": "tool-9",
    "href": "/tools/laporan-insiden/",
    "category": "lapangan",
    "categoryName": "Manajemen Risiko & Lapangan",
    "title": "Formulir Laporan Insiden K3 & Investigasi 5-Why",
    "badge": "Permenaker 03/1998",
    "desc": "Dokumentasikan insiden kecelakaan kerja resmi Permenaker 03/1998 dengan analisis rantai akar penyebab 5-Why, penyebab langsung SCAT, dan matriks CAPA.",
    "tags": [
      "5-Why Analysis",
      "SCAT Model",
      "Format Disnaker"
    ],
    "searchKeywords": "formulir laporan insiden k3 & investigasi 5-why dokumentasikan insiden kecelakaan kerja resmi permenaker 03/1998 dengan analisis rantai akar penyebab 5-why, penyebab langsung scat, dan matriks capa. 5-why analysis scat model format disnaker",
    "iconSvg": "<svg width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><path d=\"M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z\"/></svg>"
  },
  {
    "id": "tool-10",
    "href": "/tools/ibpr-generator/",
    "category": "lapangan",
    "categoryName": "Manajemen Risiko & Lapangan",
    "title": "Generator IBPR / HIRADC K3 (SMK3 PP 50/2012)",
    "badge": "SMK3 PP 50/2012",
    "desc": "Buat tabel Identifikasi Bahaya dan Penilaian Risiko (IBPR) terpadu dengan klasifikasi kondisi Rutin/Non-Rutin/Darurat dan evaluasi risiko awal vs sisa.",
    "tags": [
      "Elemen 2 SMK3",
      "ISO 45001",
      "Export CSV"
    ],
    "searchKeywords": "generator ibpr / hiradc k3 (smk3 pp 50/2012) buat tabel identifikasi bahaya dan penilaian risiko (ibpr) terpadu dengan klasifikasi kondisi rutin/non-rutin/darurat dan evaluasi risiko awal vs sisa. elemen 2 smk3 iso 45001 export csv",
    "iconSvg": "<svg width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><path d=\"M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z\"/></svg>"
  },
  {
    "id": "tool-11",
    "href": "/tools/social-generator/",
    "category": "edukasi",
    "categoryName": "Edukasi & Kampanye K3",
    "title": "Generator Poster & Banner K3 (Bulan K3 Nasional)",
    "badge": "Download HD",
    "desc": "Desain grafis promosi keselamatan kerja dan spanduk Bulan K3 Nasional dengan template slogan motivasi siap download dalam resolusi tinggi PNG.",
    "tags": [
      "Bulan K3",
      "Poster Mading",
      "Banner 16:9"
    ],
    "searchKeywords": "generator poster & banner k3 (bulan k3 nasional) desain grafis promosi keselamatan kerja dan spanduk bulan k3 nasional dengan template slogan motivasi siap download dalam resolusi tinggi png. bulan k3 poster mading banner 16:9",
    "iconSvg": "<svg width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><path d=\"M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z\"/></svg>"
  },
  {
    "id": "tool-12",
    "href": "/tools/ai-analyzer/",
    "category": "regulasi",
    "categoryName": "Regulasi & Dokumen K3",
    "title": "AI K3 Document Analyzer (Cek Kepatuhan SMK3)",
    "badge": "AI Scanner",
    "desc": "Pindai kepatuhan dokumen Kebijakan K3, SOP, dan JSA Anda terhadap regulasi audit PP No. 50 Tahun 2012 dan temukan celah ketidaksesuaian secara instan.",
    "tags": [
      "Gap Analysis",
      "Klausul Audit",
      "Evaluasi Otomatis"
    ],
    "searchKeywords": "ai k3 document analyzer (cek kepatuhan smk3) pindai kepatuhan dokumen kebijakan k3, sop, dan jsa anda terhadap regulasi audit pp no. 50 tahun 2012 dan temukan celah ketidaksesuaian secara instan. gap analysis klausul audit evaluasi otomatis",
    "iconSvg": "<svg width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><path d=\"M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z\"/></svg>"
  }
];
