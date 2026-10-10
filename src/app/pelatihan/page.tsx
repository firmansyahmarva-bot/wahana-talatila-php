import React from 'react';
import type { Metadata } from 'next';
import { TRAINING_PROGRAMS } from '@/data/trainings';
import TrainingCatalogApp from '@/components/catalog/TrainingCatalogApp';

export const metadata: Metadata = {
  title: 'Katalog Pelatihan K3 Resmi Kemnaker & BNSP | Wahana Totalita',
  description:
    'Katalog lengkap pelatihan K3 resmi Kemnaker RI & BNSP: Ahli K3 Umum, alat berat, lingkungan & ISO. Kelas online & offline batch terdekat. Daftar via WhatsApp!',
  alternates: {
    canonical: 'https://wahanatotalita.com/pelatihan/',
  },
  openGraph: {
    title: 'Katalog Pelatihan K3 Resmi Kemnaker & BNSP | Wahana Totalita',
    description:
      'Katalog lengkap pelatihan K3 resmi Kemnaker RI & BNSP: Ahli K3 Umum, alat berat, lingkungan & ISO. Kelas online & offline batch terdekat. Daftar via WhatsApp!',
    url: 'https://wahanatotalita.com/pelatihan/',
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
      name: 'Pelatihan',
      item: 'https://wahanatotalita.com/pelatihan/',
    },
  ],
};

const ITEM_LIST_SCHEMA = {
  '@context': 'https://schema.org',
  '@type': 'ItemList',
  name: 'Katalog Program Pelatihan K3 Wahana Totalita',
  numberOfItems: TRAINING_PROGRAMS.length,
  itemListElement: TRAINING_PROGRAMS.map((t, idx) => ({
    '@type': 'ListItem',
    position: idx + 1,
    item: {
      '@type': 'Course',
      name: t.title,
      description: `Program pembinaan dan sertifikasi ${t.cert} di Wahana Totalita Konsultan.`,
      url: `https://wahanatotalita.com${t.href}`,
      provider: {
        '@type': 'Organization',
        name: 'Wahana Totalita Konsultan',
        sameAs: 'https://wahanatotalita.com',
      },
    },
  })),
};

export default function PelatihanPage() {
  return (
    <>
      <link rel="stylesheet" href="/assets/css/page/pelatihan-catalog.css" />
      <script
        type="application/ld+json"
        dangerouslySetInnerHTML={{ __html: JSON.stringify(BREADCRUMB_SCHEMA) }}
      />
      <script
        type="application/ld+json"
        dangerouslySetInnerHTML={{ __html: JSON.stringify(ITEM_LIST_SCHEMA) }}
      />
      <TrainingCatalogApp trainings={TRAINING_PROGRAMS} />
    </>
  );
}
