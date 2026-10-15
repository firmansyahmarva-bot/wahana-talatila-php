/**
 * Modular SEO FAQs for course programs.
 * Extracted from includes/training-faqs.php.
 */

export interface FAQItem {
  q: string;
  a: string;
}

export const UNIVERSAL_FAQS: FAQItem[] = [
  {
    q: 'Apa perbedaan sertifikasi K3 BNSP dan Kemnaker?',
    a: 'Sertifikasi Kemnaker diterbitkan melalui lembaga pelatihan yang ditunjuk Kementerian Ketenagakerjaan RI, umumnya berupa Sertifikat Kompetensi K3 disertai SKP (Surat Keputusan Penunjukan) untuk profesi tertentu seperti Ahli K3 Umum. Sertifikasi BNSP diterbitkan oleh Lembaga Sertifikasi Profesi (LSP) berlisensi Badan Nasional Sertifikasi Profesi, mengacu pada skema SKKNI. Keduanya sah dan diakui secara nasional.',
  },
  {
    q: 'Berapa lama masa berlaku SKP dan sertifikat K3?',
    a: 'SKP (Surat Keputusan Penunjukan) dan sertifikat kompetensi K3 dari Kemnaker umumnya berlaku 3 tahun sejak tanggal diterbitkan, dan dapat diperpanjang sebelum masa berlaku habis. Sertifikat BNSP mengikuti masa berlaku skema sertifikasi terkait, pada umumnya juga 3 tahun. Kami membantu proses perpanjangan via WhatsApp.',
  },
  {
    q: 'Bagaimana cara mengecek keaslian sertifikat K3 secara online?',
    a: 'Sertifikat Kemnaker dapat dicek melalui sistem informasi resmi Kementerian Ketenagakerjaan (TemanK3), sedangkan sertifikat BNSP diverifikasi melalui portal resmi registrasi BNSP / LSP penerbit. Wahana Totalita juga menyediakan fasilitas verifikasi legalitas dokumen.',
  },
  {
    q: 'Bagaimana proses pendaftaran pelatihan ini?',
    a: 'Pendaftaran dilakukan cepat via WhatsApp — tim kami mengirimkan silabus materi, jadwal batch terdekat, formulir pendaftaran, dan rincian investasi. Setelah berkas persyaratan dikonfirmasi, peserta terdaftar dalam kelas online maupun tatap muka.',
  },
  {
    q: 'Apakah sertifikat ini berlaku untuk tender pemerintah dan proyek BUMN?',
    a: 'Ya. Sertifikat Kemnaker maupun BNSP yang diterbitkan lembaga terakreditasi berlaku sah secara nasional dan lazim digunakan sebagai syarat pemenuhan tender kementerian, BUMN, kontraktor EPC, dan korporasi swasta di seluruh Indonesia.',
  },
];

export const FAQ_CLUSTERS: Array<{ keywords: string[]; faqs: FAQItem[] }> = [
  {
    keywords: ['alat-berat', 'alat berat', 'excavator', 'crane', 'rigger', 'loader', 'grader', 'compactor', 'forklift'],
    faqs: [
      {
        q: 'Berapa lama masa berlaku Lisensi K3 (SIO) Operator Alat Berat?',
        a: 'Berdasarkan Permenaker No. 8 Tahun 2020 tentang Keselamatan dan Kesehatan Kerja Pesawat Angkat dan Pesawat Angkut, Lisensi K3 / SIO (Surat Ijin Operator) berlaku selama 5 tahun sejak tanggal diterbitkan dan dapat diperpanjang kembali.',
      },
      {
        q: 'Apa saja syarat penerbitan Lisensi K3 (SIO) Alat Berat Kemnaker RI?',
        a: 'Persyaratan utama: usia minimal 18 tahun, pendidikan formal minimal SMP/SMA sederajat (tergantung kelas alat), surat keterangan sehat jasmani, pas foto background merah, serta dinyatakan lulus evaluasi teori dan praktik bersama pengawas Kemnaker RI.',
      },
      {
        q: 'Apakah tersedia fasilitas In-House Training Operator Alat Berat di lokasi perusahaan?',
        a: 'Ya. Wahana Totalita menyediakan program In-House Training alat berat langsung di area kerja tambang, perkebunan, atau proyek konstruksi perusahaan di seluruh Indonesia menggunakan unit alat operasional klien.',
      },
    ],
  },
  {
    keywords: ['forklift'],
    faqs: [
      {
        q: 'Apa saja syarat menjadi operator forklift bersertifikat?',
        a: 'Syarat: usia minimal 18 tahun, pendidikan minimal SMP/sederajat, sehat jasmani dan rohani, mengikuti pelatihan K3 Operator Forklift resmi Kemnaker RI, dan lulus uji evaluasi untuk mendapatkan Lisensi SIO Kemnaker RI.',
      },
      {
        q: 'Forklift dikelompokkan menjadi berapa kelas operator?',
        a: 'Operator forklift dikelompokkan menjadi 2 kelas: Kelas 1 (kapasitas di atas 15 ton) dan Kelas 2 (kapasitas hingga 15 ton). Jenjang lisensi menentukan kapasitas unit yang diizinkan untuk dioperasikan secara legal.',
      },
    ],
  },
  {
    keywords: ['confined', 'ruang-terbatas', 'ruang terbatas', 'tkbt', 'tkpk'],
    faqs: [
      {
        q: 'Apa sumber bahaya spesifik saat bekerja di ruang terbatas (confined space)?',
        a: 'Bahaya utama meliputi kekurangan atau kelebihan kadar oksigen, gas beracun (H2S, CO), uap mudah terbakar, dan risiko tertimbun material curah. Pengukuran kadar gas wajib dilakukan sebelum dan selama pekerjaan berlangsung.',
      },
      {
        q: 'Berapa kadar oksigen yang aman untuk bekerja di ruang terbatas?',
        a: 'Rentang aman untuk memasuki ruang terbatas adalah 19,5% – 23,5%. Di bawah 19,5% berisiko asfiksia, sedangkan di atas 23,5% berisiko kebakaran tinggi (oxygen enriched).',
      },
    ],
  },
  {
    keywords: ['ahli-k3-umum', 'ahli k3 umum', 'ak3u'],
    faqs: [
      {
        q: 'Apa perbedaan Ahli K3 Umum Kemnaker RI dan BNSP?',
        a: 'Ahli K3 Umum Kemnaker menghasilkan Sertifikat Pembinaan dan SKP (Surat Keputusan Penunjukan) resmi dari Kementerian Ketenagakerjaan RI yang menjadi mandat hukum penunjukan personil K3 di perusahaan sesuai UU No. 1/1970. Ahli K3 Umum BNSP mengukur kompetensi berbasis SKKNI standar profesi nasional.',
      },
      {
        q: 'Berapa lama durasi pelatihan Ahli K3 Umum Kemnaker RI?',
        a: 'Pelatihan Ahli K3 Umum Kemnaker berlangsung selama 12 hari kerja (120 jam pelajaran) meliputi pembinaan regulasi, analisa bahaya tempat kerja, seminar PKL, dan ujian evaluasi resmi Kemnaker.',
      },
    ],
  },
  {
    keywords: ['kebakaran', 'damkar', 'fire'],
    faqs: [
      {
        q: 'Apa saja tingkatan sertifikasi K3 Penanggulangan Kebakaran Kemnaker RI?',
        a: 'Sesuai Kepmenaker KEP.186/MEN/1999: Petugas Peran Kebakaran (Kelas D), Regu Penanggulangan Kebakaran (Kelas C), Koordinator Unit Penanggulangan Kebakaran (Kelas B), dan Ahli K3 Spesialis Kebakaran (Kelas A).',
      },
    ],
  },
  {
    keywords: ['lingkungan', 'pppa', 'popal', 'pppu', 'poippu', 'limbah'],
    faqs: [
      {
        q: 'Siapa yang wajib memiliki sertifikasi POPAL atau PPPA?',
        a: 'Berdasarkan regulasi Kementerian LHK, setiap industri atau fasilitas yang menghasilkan air limbah dan limbah B3 wajib menunjuk penanggung jawab operasional bersertifikasi kompetensi resmi BNSP di bidang pengelolaan lingkungan hidup.',
      },
    ],
  },
  {
    keywords: ['pop', 'pom', 'pou', 'tambang', 'mining'],
    faqs: [
      {
        q: 'Apa perbedaan sertifikasi POP, POM, dan POU di pertambangan?',
        a: 'POP (Pengawas Operasional Pertama) ditujukan untuk level pengawas operasional lini depan (foreman/supervisor). POM (Pengawas Operasional Madya) untuk level superintendent. POU (Pengawas Operasional Utama) untuk level pimpinan teknik tambang/KTT.',
      },
    ],
  },
  {
    keywords: ['smk3', 'auditor'],
    faqs: [
      {
        q: 'Berapa kriteria yang dinilai dalam audit SMK3?',
        a: 'Berdasarkan PP No. 50 Tahun 2012, penilaian audit terbagi menjadi tingkat awal (64 kriteria), tingkat transisi (122 kriteria), dan tingkat lanjutan (166 kriteria) dalam 12 elemen audit keselamatan dan kesehatan kerja.',
      },
    ],
  },
];

/**
 * Returns tailored FAQ items for a specific training course.
 */
export function getTrainingFaqs(name: string, slug: string, price?: number | string | null): FAQItem[] {
  const haystack = `${slug} ${name}`.toLowerCase();
  
  const courseSpecific: FAQItem[] = [
    {
      q: `Kapan jadwal pelaksanaan ${name} batch terdekat?`,
      a: `Jadwal ${name} diselenggarakan secara berkala setiap bulan untuk kelas reguler publik (online via Zoom interaktif maupun tatap muka) serta in-house training di lokasi perusahaan. Hubungi kami via WhatsApp untuk mendapatkan jadwal batch dan silabus terbaru.`,
    },
    {
      q: `Berapa biaya investasi dan apa saja fasilitas pelatihan ini?`,
      a: `Investasi pelatihan ${name} ${price && Number(price) > 0 ? `mulai dari Rp ${Number(price).toLocaleString('id-ID')} / peserta` : 'dapat dikonsultasikan secara gratis'}. Fasilitas mencakup sertifikat resmi, modul materi lengkap, pembinaan oleh instruktur senior bersertifikat, dan konsultasi pra-pelatihan.`,
    },
  ];

  let matchedClusterFaqs: FAQItem[] = [];
  for (const cluster of FAQ_CLUSTERS) {
    for (const kw of cluster.keywords) {
      if (haystack.includes(kw)) {
        matchedClusterFaqs = matchedClusterFaqs.concat(cluster.faqs);
        break;
      }
    }
  }

  // Combine course-specific + matched cluster + universal
  return [...courseSpecific, ...matchedClusterFaqs, ...UNIVERSAL_FAQS.slice(0, 3)];
}
