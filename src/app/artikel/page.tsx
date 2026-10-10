import React from 'react';
import type { Metadata } from 'next';
import { ARTICLES } from '@/data/articles';
import ArticleCatalogApp from '@/components/article/ArticleCatalogApp';

export const metadata: Metadata = {
  title: 'Artikel & Panduan K3 | Wahana Totalita Konsultan',
  description:
    'Artikel, panduan, dan tips seputar K3, sertifikasi BNSP, lingkungan kerja, dan keselamatan industri dari Wahana Totalita Konsultan.',
  alternates: {
    canonical: 'https://wahanatotalita.com/artikel/',
  },
  openGraph: {
    title: 'Artikel & Panduan K3 | Wahana Totalita Konsultan',
    description:
      'Artikel, panduan, dan tips seputar K3, sertifikasi BNSP, lingkungan kerja, dan keselamatan industri dari Wahana Totalita Konsultan.',
    url: 'https://wahanatotalita.com/artikel/',
    type: 'website',
  },
};

const SCHEMAS = [
  {
    '@context': 'https://schema.org',
    '@type': 'Blog',
    name: 'Artikel Wahana Totalita Konsultan',
    url: 'https://wahanatotalita.com/artikel/',
    description:
      'Artikel, panduan, dan tips seputar K3, sertifikasi BNSP, lingkungan kerja, dan keselamatan industri dari Wahana Totalita Konsultan.',
    publisher: {
      '@type': 'Organization',
      name: 'Wahana Totalita Konsultan',
      url: 'https://wahanatotalita.com',
    },
    inLanguage: 'id',
  },
  {
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
        name: 'Artikel',
        item: 'https://wahanatotalita.com/artikel/',
      },
    ],
  },
];

export default function ArtikelPage() {
  return (
    <>
      <link rel="stylesheet" href="/assets/css/artikel.css" />
      {SCHEMAS.map((schema, index) => (
        <script
          key={index}
          type="application/ld+json"
          dangerouslySetInnerHTML={{ __html: JSON.stringify(schema) }}
        />
      ))}
      <ArticleCatalogApp articles={ARTICLES} />
    </>
  );
}
