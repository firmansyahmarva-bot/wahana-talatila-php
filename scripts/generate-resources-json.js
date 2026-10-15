import fs from 'fs';

const categories = [
  { id: 1, name: 'JSA / Job Safety Analysis', slug: 'jsa', icon: '📋', description: 'Template JSA siap pakai', sort_order: 1 },
  { id: 2, name: 'Checklist K3', slug: 'checklist', icon: '✅', description: 'Checklist inspeksi dan audit', sort_order: 2 },
  { id: 3, name: 'SOP K3', slug: 'sop', icon: '📝', description: 'Standard Operating Procedure K3', sort_order: 3 },
  { id: 4, name: 'HIRARC / IBPR', slug: 'hirarc', icon: '⚠️', description: 'Hazard Identification Risk Assessment', sort_order: 4 },
  { id: 5, name: 'Poster & Rambu K3', slug: 'poster', icon: '🖼️', description: 'Poster K3 siap cetak', sort_order: 5 },
  { id: 6, name: 'CSMS Dokumen', slug: 'csms', icon: '🏢', description: 'Contractor Safety Management System', sort_order: 6 },
  { id: 7, name: 'Regulasi K3', slug: 'regulasi', icon: '⚖️', description: 'Peraturan Perundangan K3 terbaru', sort_order: 7 },
  { id: 8, name: 'Safety Talk', slug: 'safety-talk', icon: '🗣️', description: 'Materi safety talk dan toolbox meeting', sort_order: 8 },
  { id: 9, name: 'HSE Plan', slug: 'hse-plan', icon: '📊', description: 'Rencana K3 untuk proyek', sort_order: 9 },
  { id: 10, name: 'Template Lainnya', slug: 'lainnya', icon: '📁', description: 'Dokumen pendukung K3 lainnya', sort_order: 10 }
];

const resources = [
  {
    id: 1,
    category_id: 1,
    title: 'Template JSA (Job Safety Analysis) Excel',
    slug: 'template-jsa-excel',
    description: 'Template JSA siap pakai dalam format Excel untuk menganalisis bahaya per langkah pekerjaan. Dilengkapi kolom langkah kerja, potensi bahaya, penilaian risiko, dan tindakan pengendalian. Cocok untuk industri konstruksi, migas, dan manufaktur.',
    file_path: '/assets/downloads/template-jsa.csv',
    file_type: 'xlsx',
    file_size_kb: 45,
    is_premium: 0,
    price: 0,
    download_count: 348,
    view_count: 1250,
    tags: 'jsa,job safety analysis,template k3',
    meta_title: 'Download Template JSA Excel Gratis | Wahana Totalita',
    meta_desc: 'Template Job Safety Analysis (JSA) Excel gratis siap pakai. Analisis bahaya per langkah kerja lengkap dengan penilaian risiko. Download sekarang.'
  },
  {
    id: 2,
    category_id: 4,
    title: 'Template HIRADC / IBPR Excel',
    slug: 'template-hiradc-ibpr',
    description: 'Template HIRADC (Hazard Identification, Risk Assessment & Determining Control) / IBPR dalam Excel. Dilengkapi matriks risiko 5x5, kolom likelihood dan severity otomatis, serta hierarki pengendalian sesuai PP No. 50/2012.',
    file_path: '/assets/downloads/template-ibpr.csv',
    file_type: 'xlsx',
    file_size_kb: 60,
    is_premium: 0,
    price: 0,
    download_count: 512,
    view_count: 1890,
    tags: 'hiradc,ibpr,manajemen risiko,smk3',
    meta_title: 'Download Template HIRADC / IBPR Gratis | Wahana Totalita',
    meta_desc: 'Template HIRADC/IBPR Excel gratis dengan matriks risiko 5x5 otomatis sesuai PP No. 50/2012. Identifikasi bahaya & pengendalian risiko. Download.'
  },
  {
    id: 3,
    category_id: 2,
    title: 'Checklist Inspeksi K3 Harian',
    slug: 'checklist-inspeksi-k3-harian',
    description: 'Checklist inspeksi K3 harian untuk pengawas lapangan. Mencakup APD, housekeeping, peralatan, kelistrikan, dan kondisi tidak aman. Format siap cetak untuk dokumentasi compliance SMK3.',
    file_path: '',
    file_type: 'pdf',
    file_size_kb: 120,
    is_premium: 0,
    price: 0,
    download_count: 289,
    view_count: 980,
    tags: 'checklist k3,inspeksi,housekeeping',
    meta_title: 'Download Checklist Inspeksi K3 Harian | Wahana Totalita',
    meta_desc: 'Checklist inspeksi K3 harian gratis untuk pengawas. APD, housekeeping, kelistrikan & kondisi tidak aman. Siap cetak untuk compliance SMK3.'
  },
  {
    id: 4,
    category_id: 8,
    title: 'Materi Safety Talk / Toolbox Meeting (20 Topik)',
    slug: 'materi-safety-talk-toolbox-meeting',
    description: 'Kumpulan 20 materi Safety Talk / Toolbox Meeting siap pakai untuk briefing K3 harian. Topik mencakup bekerja di ketinggian, ruang terbatas, kelistrikan, APD, ergonomi, dan tanggap darurat.',
    file_path: '',
    file_type: 'pdf',
    file_size_kb: 250,
    is_premium: 0,
    price: 0,
    download_count: 420,
    view_count: 1540,
    tags: 'safety talk,toolbox meeting,briefing k3',
    meta_title: 'Download 20 Materi Safety Talk Gratis | Wahana Totalita',
    meta_desc: 'Kumpulan 20 materi Safety Talk / Toolbox Meeting siap pakai untuk briefing K3 harian. Bekerja di ketinggian, ruang terbatas, APD. Download gratis.'
  },
  {
    id: 5,
    category_id: 6,
    title: 'Template Dokumen CSMS & Pra-Kualifikasi',
    slug: 'template-csms-prakualifikasi',
    description: 'Template dokumen CSMS (Contractor Safety Management System) untuk pra-kualifikasi tender migas dan industri. Mencakup struktur HSE, kebijakan K3, statistik kecelakaan, dan program pelatihan kontraktor.',
    file_path: '',
    file_type: 'docx',
    file_size_kb: 90,
    is_premium: 0,
    price: 0,
    download_count: 195,
    view_count: 820,
    tags: 'csms,prakualifikasi,kontraktor,tender',
    meta_title: 'Download Template CSMS & Pra-Kualifikasi | Wahana Totalita',
    meta_desc: 'Template dokumen CSMS untuk pra-kualifikasi tender migas & industri. Struktur HSE, kebijakan K3, statistik kecelakaan. Download gratis.'
  },
  {
    id: 6,
    category_id: 3,
    title: 'Template SOP Tanggap Darurat (Emergency Response)',
    slug: 'template-sop-tanggap-darurat',
    description: 'Template SOP Tanggap Darurat siap sesuaikan untuk perusahaan Anda. Mencakup prosedur kebakaran, gempa, kebocoran B3, evakuasi, peran tim ERT, dan titik kumpul. Sesuai persyaratan SMK3.',
    file_path: '',
    file_type: 'docx',
    file_size_kb: 75,
    is_premium: 0,
    price: 0,
    download_count: 367,
    view_count: 1110,
    tags: 'sop,tanggap darurat,emergency response,erp',
    meta_title: 'Download Template SOP Tanggap Darurat | Wahana Totalita',
    meta_desc: 'Template SOP Tanggap Darurat gratis: kebakaran, gempa, kebocoran B3, evakuasi & peran tim ERT. Sesuai SMK3. Download dan sesuaikan.'
  }
];

// Enrich resources with category details
const data = {
  categories: categories.map(c => {
    const count = resources.filter(r => r.category_id === c.id).length;
    return { ...c, count };
  }),
  resources: resources.map(r => {
    const cat = categories.find(c => c.id === r.category_id);
    return {
      ...r,
      cat_name: cat ? cat.name : 'Umum',
      cat_slug: cat ? cat.slug : 'umum',
      cat_icon: cat ? cat.icon : '📁'
    };
  })
};

fs.writeFileSync('D:/wahana-transform/wahana-astro/src/data/resources.json', JSON.stringify(data, null, 2));
console.log('Successfully written src/data/resources.json');
