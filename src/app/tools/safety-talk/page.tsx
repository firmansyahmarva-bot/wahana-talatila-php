import React from 'react';
import type { Metadata } from 'next';
import fs from 'fs';
import path from 'path';
import SafetyTalkApp, { SafetyTalkTopic, RelatedTraining } from '@/components/tools/SafetyTalkApp';

export const metadata: Metadata = {
  title: '100 Materi Safety Talk Harian K3 2026: Singkat, Jelas + Absensi',
  description:
    '100 Materi Safety Talk Harian & Toolbox Meeting (TBM) K3 terlengkap 2026! Dilengkapi fakta, poin diskusi, teknologi K3 & AI, hingga lembar daftar hadir. Gratis cetak!',
  alternates: {
    canonical: 'https://wahanatotalita.com/tools/safety-talk/',
  },
  openGraph: {
    title: '100 Materi Safety Talk Harian K3 2026: Singkat, Jelas + Absensi',
    description:
      '100 Materi Safety Talk Harian & Toolbox Meeting (TBM) K3 terlengkap 2026! Dilengkapi fakta, poin diskusi, teknologi K3 & AI, hingga lembar daftar hadir. Gratis cetak!',
    url: 'https://wahanatotalita.com/tools/safety-talk/',
    type: 'website',
  },
};

const BREADCRUMB_SCHEMA = {
  '@context': 'https://schema.org',
  '@type': 'BreadcrumbList',
  itemListElement: [
    {
      '@type': 'ListItem',
      position: 1,
      name: 'Beranda',
      item: 'https://wahanatotalita.com/',
    },
    {
      '@type': 'ListItem',
      position: 2,
      name: 'Tools K3',
      item: 'https://wahanatotalita.com/tools/',
    },
    {
      '@type': 'ListItem',
      position: 3,
      name: 'Safety Talk',
      item: 'https://wahanatotalita.com/tools/safety-talk/',
    },
  ],
};

const FAQ_SCHEMA = {
  '@context': 'https://schema.org',
  '@type': 'FAQPage',
  mainEntity: [
    {
      '@type': 'Question',
      name: 'Berapa lama durasi ideal satu sesi Safety Talk / Toolbox Meeting?',
      acceptedAnswer: {
        '@type': 'Answer',
        text: 'Idealnya 5-10 menit agar pekerja tetap fokus dan tidak mengganggu jadwal kerja. Sampaikan satu topik utama, ajukan 2-3 poin diskusi, dan tutup dengan penegasan tindakan K3.',
      },
    },
    {
      '@type': 'Question',
      name: 'Siapa yang seharusnya memimpin safety talk harian?',
      acceptedAnswer: {
        '@type': 'Answer',
        text: 'Idealnya dipimpin langsung oleh supervisor, foreman, atau tim HSE di lapangan untuk menunjukkan kepemimpinan K3 operasional. Dalam pelaksanaannya, materi dan pengawasan keselamatan kerja dikoordinasikan oleh Ahli K3 Umum sebagai penanggung jawab implementasi K3 di perusahaan.',
      },
    },
    {
      '@type': 'Question',
      name: 'Apakah 100 topik safety talk ini gratis dan siap cetak?',
      acceptedAnswer: {
        '@type': 'Answer',
        text: 'Ya, 100% gratis! Setiap topik dilengkapi tombol cetak langsung yang mencakup lembar daftar hadir (absensi) toolbox meeting.',
      },
    },
  ],
};

export default function SafetyTalkPage() {
  const talksPath = path.join(process.cwd(), 'data', 'safety_talks.json');
  const relatedPath = path.join(process.cwd(), 'data', 'safety_talks_related.json');

  let talks: SafetyTalkTopic[] = [];
  let relatedTrainings: RelatedTraining[] = [];

  try {
    talks = JSON.parse(fs.readFileSync(talksPath, 'utf8'));
    relatedTrainings = JSON.parse(fs.readFileSync(relatedPath, 'utf8'));
  } catch (err) {
    console.error('Failed to load safety talks data:', err);
  }

  return (
    <>
      <link rel="stylesheet" href="/assets/css/page/safety-talk.css" />
      <script
        type="application/ld+json"
        dangerouslySetInnerHTML={{ __html: JSON.stringify(BREADCRUMB_SCHEMA) }}
      />
      <script
        type="application/ld+json"
        dangerouslySetInnerHTML={{ __html: JSON.stringify(FAQ_SCHEMA) }}
      />
      <SafetyTalkApp talks={talks} relatedTrainings={relatedTrainings} />
    </>
  );
}
