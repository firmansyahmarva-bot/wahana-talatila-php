import React from 'react';
import type { Metadata } from 'next';
import fs from 'fs';
import path from 'path';

function getHomePageData() {
  const filePath = path.join(process.cwd(), 'data', 'pages', 'index.json');
  return JSON.parse(fs.readFileSync(filePath, 'utf8'));
}

export async function generateMetadata(): Promise<Metadata> {
  const data = getHomePageData();
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
  const data = getHomePageData();
  return (
    <>
      {data.css_links?.map((href: string, idx: number) => (
        <link key={idx} rel="stylesheet" href={href} />
      ))}
      {data.inline_styles?.map((css: string, idx: number) => (
        <style key={idx} dangerouslySetInnerHTML={{ __html: css }} />
      ))}
      {data.schemas?.map((s: string, idx: number) => (
        <script
          key={idx}
          type="application/ld+json"
          dangerouslySetInnerHTML={{ __html: s }}
        />
      ))}
      <div
        dangerouslySetInnerHTML={{ __html: data.body_html }}
        suppressHydrationWarning
      />
    </>
  );
}
