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
  // Strip old header, navbar, or footer DOM nodes embedded inside body content
  return html
    .replace(/<header[\s\S]*?<\/header>/gi, '')
    .replace(/<nav[\s\S]*?<\/nav>/gi, '')
    .replace(/<footer[\s\S]*?<\/footer>/gi, '');
}

function sanitizePageCss(css: string): string {
  if (!css) return '';
  // Strip global body, footer, navbar overrides to prevent header/footer corruption
  return css
    .replace(/body\s*\{[^}]*\}/gi, '')
    .replace(/footer[\s\S]*?\{[^}]*\}/gi, '')
    .replace(/\.navbar[\s\S]*?\{[^}]*\}/gi, '')
    .replace(/a\s*\{[^}]*color\s*:[^;}]*!important[^}]*\}/gi, '');
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
      {data.inline_styles?.map((css: string, idx: number) => {
        const safeCss = sanitizePageCss(css);
        if (!safeCss.trim()) return null;
        return <style key={idx} dangerouslySetInnerHTML={{ __html: safeCss }} />;
      })}
      {data.schemas?.map((s: string, idx: number) => (
        <script
          key={idx}
          type="application/ld+json"
          dangerouslySetInnerHTML={{ __html: s }}
        />
      ))}
      <main id="konten-utama" className="py-10 bg-white" dangerouslySetInnerHTML={{ __html: sanitizedBody }} />
    </>
  );
}
