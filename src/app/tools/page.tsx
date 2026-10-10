import React from 'react';
import type { Metadata } from 'next';
import { TOOLS_DATA } from '@/data/tools';
import ToolsCatalogApp from '@/components/tools/ToolsCatalogApp';

export const metadata: Metadata = {
  title: 'Kumpulan Tools K3 Online 2026: Kalkulator, Generator & Regulasi K3',
  description:
    'Pusat tools dan kalkulator K3 online terlengkap 2026: Safety Talk, Kalkulator Statistik K3 (FR/SR), JSA Builder, Matriks Risiko 5x5, Kebisingan, Regulasi K3, dan IBPR gratis.',
  alternates: {
    canonical: 'https://wahanatotalita.com/tools/',
  },
  openGraph: {
    title: 'Kumpulan Tools K3 Online 2026: Kalkulator, Generator & Regulasi K3',
    description:
      'Pusat tools dan kalkulator K3 online terlengkap 2026: Safety Talk, Kalkulator Statistik K3 (FR/SR), JSA Builder, Matriks Risiko 5x5, Kebisingan, Regulasi K3, dan IBPR gratis.',
    url: 'https://wahanatotalita.com/tools/',
    type: 'website',
  },
};

const SCHEMAS = [
  {
    '@context': 'https://schema.org',
    '@type': 'Organization',
    '@id': 'https://wahanatotalita.com/#organization',
    name: 'Wahana Totalita Konsultan',
    url: 'https://wahanatotalita.com',
    description:
      'PJK3 Resmi Berlisensi Kementerian Ketenagakerjaan RI (No. Kep. 312/BINWASPNAK-PNK3/V/2020) dan Lembaga Pelatihan Sertifikasi K3, Lingkungan, Mining & ISO.',
    logo: {
      '@type': 'ImageObject',
      url: 'https://wahanatotalita.com/assets/img/og-cover.jpg',
      width: 1200,
      height: 630,
    },
    contactPoint: {
      '@type': 'ContactPoint',
      telephone: '628122969435',
      contactType: 'customer service',
      availableLanguage: ['Indonesian', 'English', 'Chinese'],
    },
    knowsAbout: [
      'Keselamatan dan Kesehatan Kerja (K3)',
      'Sertifikasi BNSP',
      'Sertifikasi Kemnaker RI',
      'SMK3 PP 50/2012',
      'Riksa Uji Alat Berat (SIA)',
      'Surat Izin Operator (SIO)',
    ],
    hasCredential: [
      {
        '@type': 'EducationalOccupationalCredential',
        name: 'PJK3 Resmi Berlisensi Kementerian Ketenagakerjaan RI (No. Kep. 312/BINWASPNAK-PNK3/V/2020)',
        credentialCategory: 'SK Penunjukan PJK3 Bidang Pembinaan K3',
        recognizedBy: {
          '@type': 'GovernmentOrganization',
          name: 'Kementerian Ketenagakerjaan Republik Indonesia (Kemnaker RI)',
        },
      },
      {
        '@type': 'EducationalOccupationalCredential',
        name: 'Lembaga Pelatihan Terakreditasi BNSP',
        credentialCategory: 'Sertifikasi Profesi K3',
        recognizedBy: {
          '@type': 'GovernmentOrganization',
          name: 'Badan Nasional Sertifikasi Profesi (BNSP)',
        },
      },
    ],
    sameAs: ['https://instagram.com/wahanatotalita.id'],
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
        name: 'Tools K3',
        item: 'https://wahanatotalita.com/tools/',
      },
    ],
  },
  {
    '@context': 'https://schema.org',
    '@type': 'CollectionPage',
    name: 'Kumpulan Tools K3 Online 2026: Kalkulator, Generator & Regulasi',
    url: 'https://wahanatotalita.com/tools/',
    description:
      'Direktori lengkap aplikasi dan kalkulator keselamatan kerja K3 online gratis: Safety Talk, Kalkulator K3, JSA, Matriks Risiko, Kebisingan, dan IBPR.',
    inLanguage: 'id-ID',
  },
  {
    '@context': 'https://schema.org',
    '@type': 'FAQPage',
    mainEntity: [
      {
        '@type': 'Question',
        name: 'Apakah seluruh tools dan kalkulator K3 di situs ini gratis?',
        acceptedAnswer: {
          '@type': 'Answer',
          text: 'Ya, 100% gratis dan dapat digunakan secara bebas oleh praktisi HSE, Ahli K3 Umum, mahasiswa, dan manajemen perusahaan di seluruh Indonesia tanpa perlu registrasi.',
        },
      },
      {
        '@type': 'Question',
        name: 'Apakah hasil perhitungan kalkulator K3 sesuai dengan standar regulasi pemerintah?',
        acceptedAnswer: {
          '@type': 'Answer',
          text: 'Seluruh formula perhitungan dan dokumen yang dihasilkan mengacu langsung pada peraturan perundang-undangan resmi Republik Indonesia, seperti Kepmenaker No. KEP.372/MEN/1989, Permenaker No. 5 Tahun 2018, Permenaker No. 03/MEN/1998, dan PP No. 50 Tahun 2012 tentang Penerapan SMK3.',
        },
      },
    ],
  },
];

export default function ToolsPage() {
  return (
    <>
      <link rel="stylesheet" href="/assets/css/tools.css" />
      {SCHEMAS.map((schema, index) => (
        <script
          key={index}
          type="application/ld+json"
          dangerouslySetInnerHTML={{ __html: JSON.stringify(schema) }}
        />
      ))}
      <ToolsCatalogApp tools={TOOLS_DATA} />
    </>
  );
}
