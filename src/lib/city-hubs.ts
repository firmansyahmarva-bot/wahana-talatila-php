import cityDataRaw from '../data/city-hubs.json';

export interface CityHub {
  slug: string;
  name: string;
  province: string;
  title: string;
  desc: string;
  industries: string;
  demand: string;
  highlight: string;
  companies: string;
  nearby: string[];
  type: 'urban' | 'industrial' | 'energy_mining';
}

export interface CityFaq {
  q: string;
  a: string;
}

export interface CityWhyCard {
  icon: string;
  title: string;
  desc: string;
}

export interface CityProgram {
  name: string;
  tag1: string;
  tag2: string;
  body: 'KEMNAKER RI' | 'BNSP' | 'KEMNAKER / BNSP';
  duration: string;
  slug: string;
  desc: string;
}

export const CITY_HUBS: Record<string, CityHub> = cityDataRaw as any;

export function getCityHub(slug: string): CityHub | null {
  return CITY_HUBS[slug] || null;
}

export function getAllCityHubs(): CityHub[] {
  return Object.values(CITY_HUBS);
}

export function getCityPrograms(city: CityHub): CityProgram[] {
  const isMining = city.type === 'energy_mining';
  const isIndustrial = city.type === 'industrial';

  return [
    {
      name: `Ahli K3 Umum (AK3U) Kemnaker RI`,
      tag1: 'Kemnaker RI',
      tag2: 'Online Zoom / Jogja',
      body: 'KEMNAKER RI',
      duration: '12 Hari',
      slug: 'pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri',
      desc: `Sertifikasi wajib penunjukan Ahli K3 Umum resmi Kemnaker RI untuk kepatuhan regulasi UU No. 1/1970 perusahaan di ${city.name}.`,
    },
    {
      name: isMining ? 'Pengawas Operasional Pertama (POP) Tambang' : 'Auditor SMK3 PP No. 50/2012',
      tag1: isMining ? 'ESDM / BNSP' : 'Kemnaker RI',
      tag2: isMining ? 'Sertifikasi BNSP' : 'Audit SMK3',
      body: isMining ? 'BNSP' : 'KEMNAKER RI',
      duration: isMining ? '5 Hari' : '4 Hari',
      slug: isMining ? 'pelatihan-pop-pertambangan-sertifikasi-bnsp-online' : 'pelatihan-auditor-sistem-manajemen-k3-sertifikasi-kemnaker-ri',
      desc: isMining
        ? `Sertifikasi uji kompetensi Pengawas Operasional Pertama (POP) Minerba berstandar SKKNI untuk tambang di sekitar ${city.name}.`
        : `Pembinaan auditor internal dan eksternal SMK3 sesuai kriteria audit PP 50/2012 bagi korporasi di ${city.name}.`,
    },
    {
      name: isIndustrial ? 'Ahli K3 Kimia & Pengendalian B3' : 'Ahli K3 Konstruksi Sertifikasi BNSP',
      tag1: isIndustrial ? 'Kemnaker RI' : 'BNSP Garuda',
      tag2: isIndustrial ? 'Bahan Berbahaya' : 'Konstruksi Sipil',
      body: isIndustrial ? 'KEMNAKER RI' : 'BNSP',
      duration: isIndustrial ? '6 Hari' : '4 Hari',
      slug: isIndustrial ? 'pelatihan-ahli-k3-kimia-sertifikasi-kemnaker-ri' : 'ahli-k3-konstruksi-sertifikasi-bnsp',
      desc: isIndustrial
        ? `Manajemen keselamatan bahan kimia beracun, dokumen MSDS, dan pengendalian risiko ledakan/kebocoran di ${city.name}.`
        : `Kompetensi keselamatan pekerjaan konstruksi, pekerjaan tanah, perancah, dan struktur proyek di ${city.name}.`,
    },
    {
      name: 'K3 Operator Forklift & Material Handling',
      tag1: 'Kemnaker RI',
      tag2: 'Lisensi SIO Resmi',
      body: 'KEMNAKER RI',
      duration: '3 Hari',
      slug: 'pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri',
      desc: `Lisensi resmi SIO Operator Forklift Kemnaker RI Kelas I & II untuk pergudangan, logistik, dan pabrik di ${city.name}.`,
    },
    {
      name: 'K3 Teknisi & Ahli Listrik Industri',
      tag1: 'Kemnaker RI',
      tag2: 'Permenaker 12/2015',
      body: 'KEMNAKER RI',
      duration: '4-6 Hari',
      slug: 'pelatihan-k3-teknisi-listrik-sertifikasi-kemnaker-ri',
      desc: `Identifikasi bahaya arus pendek, isolasi LOTO, dan standar instalasi listrik aman fasilitas pabrik dan gedung di ${city.name}.`,
    },
    {
      name: 'Petugas Penanggulangan Kebakaran (Damkar)',
      tag1: 'Kemnaker RI',
      tag2: 'Kelas D/C/B/A',
      body: 'KEMNAKER RI',
      duration: '3-6 Hari',
      slug: 'pelatihan-damkar-paralel-kelas-dcba-sertifikasi-kemnaker-ri',
      desc: `Kesiapsiagaan regu pemadam kebakaran internal, sistem hidran, APAR, dan evakuasi darurat gedung/industri di ${city.name}.`,
    },
    {
      name: 'Petugas P3K di Tempat Kerja',
      tag1: 'Kemnaker RI',
      tag2: 'First Aid Berlisensi',
      body: 'KEMNAKER RI',
      duration: '3 Hari',
      slug: 'pelatihan-petugas-p3k-first-aid-online',
      desc: `Sertifikasi resmi petugas pertolongan pertama pada kecelakaan di tempat kerja sesuai Permenaker No. 15/2008.`,
    },
    {
      name: 'K3 Bekerja di Ketinggian (TKBT / TKPK)',
      tag1: 'Kemnaker RI',
      tag2: 'Permenaker 09/2016',
      body: 'KEMNAKER RI',
      duration: '3-4 Hari',
      slug: 'pelatihan-tkbt-ii-sertifikasi-kemnaker-ri',
      desc: `Sertifikasi Tenaga Kerja Bangunan Tinggi & Rope Access untuk pemeliharaan gedung, menara BTS, dan site di ${city.name}.`,
    },
  ];
}

export function getCityWhyCards(city: CityHub): CityWhyCard[] {
  const nearbyStr = city.nearby.slice(0, 3).join(', ');

  if (city.type === 'energy_mining') {
    return [
      {
        icon: '🏛️',
        title: 'Lisensi Sah Kemnaker RI & BNSP',
        desc: `Sertifikat resmi yang diterbitkan memenuhi seluruh standar kualifikasi rekanan CSMS, audit ESDM/Ketenagakerjaan, serta tender sektor energi di ${city.name}.`,
      },
      {
        icon: '🎓',
        title: 'Instruktur Senior Praktisi Industri',
        desc: `Materi dibimbing langsung oleh instruktur berpengalaman di bidang ${city.industries} dengan studi kasus risiko tinggi di site riil.`,
      },
      {
        icon: '💻',
        title: 'Fleksibilitas Online & Training Center',
        desc: `Peserta dari ${city.name} dan area sekitarnya (${nearbyStr}) dapat mengikuti kelas daring intensif tanpa terkendala jarak operasi site.`,
      },
      {
        icon: '🏢',
        title: 'In-House Training di Site Perusahaan',
        desc: `Penyelenggaraan pelatihan eksklusif di lokasi fasilitas operasional Anda di ${city.name} dengan kurikulum kustom sesuai potensi hazard site.`,
      },
      {
        icon: '📋',
        title: 'Simulasi Lengkap Uji Asesmen',
        desc: `Peserta dibekali modul ajar terstandar, bank soal evaluasi asesmen BNSP/Kemnaker, serta bimbingan uji kompetensi hingga lulus 100%.`,
      },
      {
        icon: '♻️',
        title: 'Layanan Perpanjangan Lisensi & SKP',
        desc: `Dukungan purna-pelatihan menyeluruh bagi alumni di ${city.province} untuk perpanjangan Surat Keputusan Penunjukan (SKP) dan lisensi K3 berkala.`,
      },
    ];
  }

  if (city.type === 'industrial') {
    return [
      {
        icon: '🏛️',
        title: 'PJK3 Resmi Berlisensi Nasional',
        desc: `Menyelenggarakan pembinaan K3 terakreditasi resmi untuk mendukung pemenuhan audit SMK3 dan kepatuhan pabrik manufaktur di wilayah ${city.name}.`,
      },
      {
        icon: '🎓',
        title: 'Kurikulum Berorientasi Industri Nyata',
        desc: `Disusun khusus menjawab tantangan keselamatan kerja pada sektor ${city.industries} yang berkembang di kawasan industri ${city.name}.`,
      },
      {
        icon: '💻',
        title: 'Pilihan Metode Online & Tatap Muka',
        desc: `Fleksibilitas jadwal bagi staf pabrik dari ${city.name} maupun klaster industri sekitarnya (${nearbyStr}) via live interactive webinar Zoom.`,
      },
      {
        icon: '🏢',
        title: 'In-House Training Pabrik & Kawasan',
        desc: `Pelatihan rombongan di fasilitas pabrik Anda di ${city.name} dengan simulasi bahaya mesin, listrik, LOTO, dan tanggap darurat industri.`,
      },
      {
        icon: '📋',
        title: 'Sertifikat Diakui Rekanan & Auditor',
        desc: `Dokumen lisensi K3 resmi berlogo Garuda Emas / SKP Kemnaker yang menjadi syarat wajib seleksi vendor, CSMS, dan sertifikasi ISO/SMK3.`,
      },
      {
        icon: '♻️',
        title: 'Konsultasi K3 & Resertifikasi Berkelanjutan',
        desc: `Layanan konsultasi regulasi berkelanjutan untuk perpanjangan masa berlaku lisensi K3 dan pendampingan audit ketenagakerjaan di ${city.province}.`,
      },
    ];
  }

  return [
    {
      icon: '🏛️',
      title: 'Sertifikasi Terakreditasi Nasional',
      desc: `Sertifikat sah Kemnaker RI dan BNSP yang diakui instansi pemerintah, BUMN, dan korporasi swasta di ${city.name} dan seluruh Indonesia.`,
    },
    {
      icon: '🎓',
      title: 'Trainer Praktisi & Asesor Berlisensi',
      desc: `Dipandu narasumber ahli yang mendalam menguasai implementasi K3 pada sektor ${city.industries} di area perkotaan ${city.name}.`,
    },
    {
      icon: '💻',
      title: 'Akses Pembelajaran Fleksibel',
      desc: `Kemudahan belajar daring dengan materi praktis bagi peserta perorangan maupun korporasi di ${city.name} serta kota tetangga (${nearbyStr}).`,
    },
    {
      icon: '🏢',
      title: 'In-House Training Khusus Korporasi',
      desc: `Modul pelatihan disesuaikan dengan jenis fasilitas kerja, gedung komersial, rumah sakit, maupun lokasi proyek konstruksi di ${city.name}.`,
    },
    {
      icon: '📋',
      title: 'Proses Pendaftaran Cepat & Mudah',
      desc: `Konsultasi gratis, pendaftaran 100% online via WhatsApp, serta asistensi pemberkasan administratif tanpa prosedur birokrasi berbelit.`,
    },
    {
      icon: '♻️',
      title: 'Pendampingan Karir & Alumni K3',
      desc: `Jejaring alumni K3 aktif di ${city.province} serta kemudahan asistensi perpanjangan SKP Ahli K3 saat masa berlaku lisensi berakhir.`,
    },
  ];
}

export function getCityFaqs(city: CityHub): CityFaq[] {
  const nearbyStr = city.nearby.slice(0, 3).join(', ');

  if (city.type === 'energy_mining') {
    return [
      {
        q: `Apa saja sertifikasi K3 yang paling banyak dibutuhkan di ${city.name}?`,
        a: `Di ${city.name} dan wilayah ${city.province}, kebutuhan sertifikasi keselamatan kerja sangat terfokus pada Ahli K3 Umum (AK3U) Kemnaker RI, Pengawas Operasional Pertambangan (POP/POM BNSP), K3 Migas, serta K3 Konstruksi guna memenuhi kualifikasi kerja di sektor ${city.industries}.`,
      },
      {
        q: `Berapa rincian biaya pelatihan K3 di ${city.name}?`,
        a: `Biaya pelatihan K3 di ${city.name} sangat terjangkau dan transparan, mulai dari Rp3.650.000 untuk sertifikasi BNSP hingga paket corporate in-house training grup. Biaya mencakup modul, pembinaan intensif, sertifikat resmi, dan bimbingan ujian. Hubungi kami via WhatsApp untuk mendapatkan proposal resmi.`,
      },
      {
        q: `Apakah tersedia pelatihan K3 sistem online Zoom untuk peserta dari ${city.name}?`,
        a: `Ya. Kami menyediakan program Blended Learning & Online Interaktif via Zoom resmi. Peserta dari ${city.name} dan kawasan sekitarnya (${nearbyStr}) dapat mengikuti pembinaan tanpa harus meninggalkan lokasi site tambang atau operasional harian.`,
      },
      {
        q: `Apakah sertifikat K3 Wahana Totalita diakui resmi di ${city.name} dan berlaku nasional?`,
        a: `Ya, seluruh sertifikat diterbitkan resmi langsung oleh Kementerian Ketenagakerjaan RI (Kemnaker RI) dengan SKP/Lisensi resmi atau Badan Nasional Sertifikasi Profesi (BNSP) berlogo Garuda Emas. Berlaku sah secara nasional untuk syarat tender LPSE, CSMS BUMN, dan audit ketenagakerjaan di ${city.province}.`,
      },
      {
        q: `Apa syarat mendaftar pelatihan K3 bagi calon peserta dari ${city.name}?`,
        a: `Persyaratan umum meliputi salinan KTP, pas foto formal latar belakang merah, dan salinan ijazah terakhir (minimal SMA/SMK untuk lisensi teknis operator atau minimal D3/S1 untuk sertifikasi Ahli K3 Umum). Seluruh proses pendaftaran dan verifikasi berkas dilakukan secara online via WhatsApp tim konsultan kami.`,
      },
    ];
  }

  if (city.type === 'industrial') {
    return [
      {
        q: `Apa saja sertifikasi K3 yang paling banyak dicari industri di ${city.name}?`,
        a: `Sektor industri dan manufaktur di ${city.name} dan sekitarnya (${city.province}) umumnya mensyaratkan sertifikasi Ahli K3 Umum Kemnaker RI, Operator Forklift & Alat Angkut, Ahli K3 Listrik, K3 Kimia, Auditor SMK3 PP 50/2012, serta Petugas Pemadam Kebakaran untuk pemenuhan audit kepatuhan pabrik.`,
      },
      {
        q: `Berapa estimasi biaya pelatihan K3 di ${city.name}?`,
        a: `Biaya pelatihan K3 di ${city.name} sangat kompetitif, berkisar antara Rp3.000.000 hingga Rp7.500.000 tergantung skema (Kemnaker RI atau BNSP) dan format kelas (Online Zoom atau Tatap Muka/In-House Pabrik). Tersedia penawaran corporate khusus untuk rombongan staf perusahaan.`,
      },
      {
        q: `Bisa menyelenggarakan In-House Training langsung di pabrik kami di ${city.name}?`,
        a: `Tentu saja. Wahana Totalita secara rutin mengirimkan instruktur praktisi senior langsung ke lokasi site/fasilitas pabrik perusahaan Anda di ${city.name} dan kawasan sekitarnya (${nearbyStr}) dengan jadwal yang fleksibel disesuaikan shift kerja operasional tim.`,
      },
      {
        q: `Apakah sertifikat hasil pelatihan dapat digunakan untuk audit SMK3 di ${city.name}?`,
        a: `Ya. Sertifikat dan lisensi penunjukan resmi Kemnaker RI & BNSP yang diterbitkan diakui 100% oleh Pengawas Ketenagakerjaan Disnaker ${city.province}, auditor SMK3 PP 50/2012, serta auditor sertifikasi ISO 45001.`,
      },
      {
        q: `Bagaimana cara pendaftaran pelatihan K3 untuk instansi di ${city.name}?`,
        a: `Cukup hubungi tim konsultan kami via WhatsApp. Kami akan mengirimkan formulir pendaftaran, rincian jadwal batch terdekat, serta invoice penawaran resmi korporasi lengkap dengan dokumen faktur pajak resmi.`,
      },
    ];
  }

  return [
    {
      q: `Sertifikasi K3 apa saja yang diselenggarakan di ${city.name}?`,
      a: `Di ${city.name} dan provinsi ${city.province}, program terfavorit mencakup Ahli K3 Umum (AK3U) Kemnaker RI, Ahli Muda K3 Konstruksi, Auditor SMK3, Petugas P3K, Petugas Kebakaran, dan Safety Officer BNSP untuk sektor ${city.industries}.`,
    },
    {
      q: `Berapa kisaran biaya pelatihan K3 di wilayah ${city.name}?`,
      a: `Biaya pelatihan bervariasi mulai dari Rp3.500.000 untuk sertifikasi kompetensi BNSP hingga paket intensif Ahli K3 Umum. Biaya mencakup pembinaan instruktur, e-book regulasi, training kit, ujian sertifikasi, dan legalitas resmi.`,
    },
    {
      q: `Apakah kelas online Zoom sama resminya dengan tatap muka langsung di ${city.name}?`,
      a: `Sama persis. Kelas Online Blended Learning diselenggarakan sesuai Keputusan Direktur Jenderal Pembinaan Pengawasan Ketenagakerjaan dan K3 Kemnaker RI. Output sertifikat, SKP, dan lisensi kewenangan yang didapat berkekuatan hukum sama dengan kelas offline.`,
    },
    {
      q: `Apakah sertifikat K3 Wahana Totalita bisa dipakai untuk syarat tender LPSE di ${city.name}?`,
      a: `Ya. Seluruh sertifikat diterbitkan resmi berlogo Garuda Emas BNSP atau ber-SKP Kemnaker RI, sehingga sah dan valid untuk memenuhi prasyarat personel teknis dalam dokumen tender LPSE, BUMN, dan proyek swasta di ${city.province}.`,
    },
    {
      q: `Bagaimana alur pendaftaran pelatihan K3 bagi profesional di ${city.name}?`,
      a: `Pendaftaran dapat dilakukan 100% secara daring. Anda cukup mengirimkan berkas KTP, ijazah terakhir, dan pas foto melalui WhatsApp kami, memilih jadwal batch yang sesuai, dan tim kami akan memandu persiapan pra-pelatihan Anda.`,
    },
  ];
}
