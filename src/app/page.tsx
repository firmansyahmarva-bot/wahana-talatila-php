import React from 'react';
import type { Metadata } from 'next';
import { getPageDetail } from '@/lib/pages';
import Hero from '@/components/home/Hero';
import StatsBar from '@/components/home/StatsBar';
import ScheduleStrip from '@/components/home/ScheduleStrip';
import ServicesSection from '@/components/home/ServicesSection';
import CatalogSection from '@/components/home/CatalogSection';
import AboutSection from '@/components/home/AboutSection';
import HowItWorks from '@/components/home/HowItWorks';
import FaqSection from '@/components/home/FaqSection';
import SocialProof from '@/components/home/SocialProof';

export async function generateMetadata(): Promise<Metadata> {
  const data = getPageDetail('index');
  if (!data) return {};

  return {
    title: data.title,
    description: data.description,
    alternates: {
      canonical: data.canonical || 'https://wahanatotalita.com/',
    },
    openGraph: {
      title: data.title,
      description: data.description,
      url: data.canonical || 'https://wahanatotalita.com/',
      type: 'website',
    },
  };
}

export default function HomePage() {
  const data = getPageDetail('index');

  return (
    <>
      {data?.schemas?.map((s: string, idx: number) => (
        <script
          key={idx}
          type="application/ld+json"
          dangerouslySetInnerHTML={{ __html: s }}
        />
      ))}
      <main id="konten-utama">
        <Hero />
        <StatsBar />
        <ScheduleStrip />
        <ServicesSection />
        <CatalogSection />
        <AboutSection />
        <HowItWorks />
        <FaqSection />
        <SocialProof />
      </main>
    </>
  );
}
