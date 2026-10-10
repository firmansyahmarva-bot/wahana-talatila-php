import React from 'react';
import type { Metadata } from 'next';
import { SCHEDULE_BATCHES } from '@/data/schedules';
import ScheduleCatalogApp from '@/components/schedule/ScheduleCatalogApp';

export const metadata: Metadata = {
  title: 'Jadwal Pelatihan K3 & Sertifikasi 2026 – Wahana Totalita Konsultan',
  description:
    'Jadwal lengkap pelatihan K3 dan sertifikasi KEMNAKER RI, BNSP, KLHK tahun 2026. Pilih program, tanggal, dan kota sesuai kebutuhan Anda. Diperbarui setiap bulan.',
  alternates: {
    canonical: 'https://wahanatotalita.com/jadwal/',
  },
  openGraph: {
    title: 'Jadwal Pelatihan K3 & Sertifikasi 2026 – Wahana Totalita Konsultan',
    description:
      'Jadwal lengkap pelatihan K3 dan sertifikasi KEMNAKER RI, BNSP, KLHK tahun 2026. Pilih program, tanggal, dan kota sesuai kebutuhan Anda. Diperbarui setiap bulan.',
    url: 'https://wahanatotalita.com/jadwal/',
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
      name: 'Jadwal Pelatihan',
      item: 'https://wahanatotalita.com/jadwal/',
    },
  ],
};

export default function JadwalPage() {
  return (
    <>
      <link rel="stylesheet" href="/assets/css/page/jadwal-pelatihan.min.css" />
      <script
        type="application/ld+json"
        dangerouslySetInnerHTML={{ __html: JSON.stringify(BREADCRUMB_SCHEMA) }}
      />
      <ScheduleCatalogApp batches={SCHEDULE_BATCHES} />
    </>
  );
}
