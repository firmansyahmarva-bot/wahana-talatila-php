import React from 'react';
import type { Metadata } from 'next';
import { notFound } from 'next/navigation';
import { getAllPageSlugs, getPageMeta, getPageDetail } from '@/lib/pages';
import CourseDetailTemplate, { parseCourseFromHtml } from '@/components/templates/CourseDetailTemplate';
import ArticleDetailTemplate, { parseArticleFromHtml } from '@/components/templates/ArticleDetailTemplate';
import CityHubDetailTemplate, { parseCityFromHtml } from '@/components/templates/CityHubDetailTemplate';

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
  // Strip old header, navbar, footer DOM nodes, and any embedded <style> tags that bleed into header/footer
  return html
    .replace(/<header[\s\S]*?<\/header>/gi, '')
    .replace(/<nav[\s\S]*?<\/nav>/gi, '')
    .replace(/<footer[\s\S]*?<\/footer>/gi, '')
    .replace(/<style[\s\S]*?<\/style>/gi, '');
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

  // If this is a course / training page, render our 100% native modern React template!
  if (pagePath.startsWith('pelatihan/')) {
    const courseData = parseCourseFromHtml(data.body_html || '', meta.title || '', pagePath);
    return (
      <>
        {data.schemas?.map((s: string, idx: number) => (
          <script
            key={idx}
            type="application/ld+json"
            dangerouslySetInnerHTML={{ __html: s }}
          />
        ))}
        <CourseDetailTemplate data={courseData} />
      </>
    );
  }


  // If this is an article or guide page, render our 100% native modern Article template!
  if (pagePath.startsWith('artikel/')) {
    const articleData = parseArticleFromHtml(data.body_html || '', meta.title || '', pagePath);
    return (
      <>
        {data.schemas?.map((s: string, idx: number) => (
          <script
            key={idx}
            type="application/ld+json"
            dangerouslySetInnerHTML={{ __html: s }}
          />
        ))}
        <ArticleDetailTemplate data={articleData} />
      </>
    );
  }

  // If this is a city landing page (e.g. pelatihan-k3-jakarta, pelatihan-k3-surabaya), render CityHubDetailTemplate!
  if (pagePath.startsWith('pelatihan-k3-')) {
    const cityData = parseCityFromHtml(data.body_html || '', meta.title || '', pagePath);
    return (
      <>
        {data.schemas?.map((s: string, idx: number) => (
          <script
            key={idx}
            type="application/ld+json"
            dangerouslySetInnerHTML={{ __html: s }}
          />
        ))}
        <CityHubDetailTemplate data={cityData} />
      </>
    );
  }

  // For remaining static or regulatory pages, wrap inside scoped legacy-prose
  const sanitizedBody = cleanBodyHtml(data.body_html);

  return (
    <>
      {data.schemas?.map((s: string, idx: number) => (
        <script
          key={idx}
          type="application/ld+json"
          dangerouslySetInnerHTML={{ __html: s }}
        />
      ))}
      <main id="konten-utama" className="py-12 bg-white">
        <div className="container legacy-prose" dangerouslySetInnerHTML={{ __html: sanitizedBody }} />
      </main>
    </>
  );
}


