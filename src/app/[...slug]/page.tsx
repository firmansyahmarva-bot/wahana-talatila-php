import React from 'react';
import type { Metadata } from 'next';
import { notFound } from 'next/navigation';
import { getAllPageSlugs, getPageMeta, getPageDetail } from '@/lib/pages';

export async function generateStaticParams() {
  return getAllPageSlugs();
}

export async function generateMetadata({
  params,
}: {
  params: Promise<{ slug: string[] }>;
}): Promise<Metadata> {
  const { slug } = await params;
  const pagePath = slug.join('/');
  const meta = getPageMeta(pagePath);

  if (!meta) {
    return {};
  }

  return {
    title: meta.title,
    description: meta.description,
    alternates: {
      canonical: meta.canonical || `https://wahanatotalita.com/${pagePath}/`,
    },
    openGraph: {
      title: meta.title,
      description: meta.description,
      url: meta.canonical || `https://wahanatotalita.com/${pagePath}/`,
      type: 'article',
    },
  };
}

function cleanBodyHtml(html: string): string {
  if (!html) return '';
  // Strip any legacy header, navbar, or footer DOM nodes embedded inside old HTML bodies
  return html
    .replace(/<header[\s\S]*?<\/header>/gi, '')
    .replace(/<nav[\s\S]*?<\/nav>/gi, '')
    .replace(/<footer[\s\S]*?<\/footer>/gi, '');
}

export default async function CatchAllPage({
  params,
}: {
  params: Promise<{ slug: string[] }>;
}) {
  const { slug } = await params;
  const pagePath = slug.join('/');
  const meta = getPageMeta(pagePath);

  if (!meta) {
    notFound();
  }

  const data = getPageDetail(meta.id);
  if (!data) {
    notFound();
  }

  const sanitizedBody = cleanBodyHtml(data.body_html);

  return (
    <>
      {data.css_links?.map((href: string, idx: number) => {
        if (
          href.includes('tokens.css') ||
          href.includes('core.min.css') ||
          href.includes('components.min.css') ||
          href.includes('fonts.googleapis.com')
        ) {
          return null;
        }
        return <link key={idx} rel="stylesheet" href={href} />;
      })}
      {data.inline_styles?.map((css: string, idx: number) => {
        if (css.includes('footerPhotoScroll') || css.includes('.navbar{')) {
          return null;
        }
        return <style key={idx} dangerouslySetInnerHTML={{ __html: css }} />;
      })}
      {data.schemas?.map((s: string, idx: number) => (
        <script
          key={idx}
          type="application/ld+json"
          dangerouslySetInnerHTML={{ __html: s }}
        />
      ))}
      <main id="konten-utama" dangerouslySetInnerHTML={{ __html: sanitizedBody }} />
    </>
  );
}
