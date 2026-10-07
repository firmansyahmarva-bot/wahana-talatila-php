import React from 'react';
import { notFound } from 'next/navigation';
import Link from 'next/link';
import articlesData from '@/data/articles.json';

interface ArticleItem {
  title: string;
  category?: string;
  meta_title?: string;
  meta_desc?: string;
  content?: string;
  excerpt?: string;
  date?: string;
  read_time?: string;
}

const articlesMap = articlesData as unknown as Record<string, ArticleItem>;

export async function generateStaticParams() {
  return Object.keys(articlesMap).map((slug) => ({
    slug,
  }));
}

export async function generateMetadata({ params }: { params: Promise<{ slug: string }> }) {
  const { slug } = await params;
  const article = articlesMap[slug];
  if (!article) return {};

  return {
    title: article.meta_title || article.title,
    description: article.meta_desc || article.excerpt,
  };
}

export default async function ArticleDetailPage({ params }: { params: Promise<{ slug: string }> }) {
  const { slug } = await params;
  const article = articlesMap[slug];

  if (!article) {
    notFound();
  }

  return (
    <article className="page-wrapper">
      <section style={{ background: 'linear-gradient(135deg, #0f172a 0%, #1e293b 100%)', color: '#fff', padding: '60px 0' }}>
        <div className="container" style={{ maxWidth: 840 }}>
          <p style={{ color: '#38bdf8', fontWeight: 700, fontSize: 13, textTransform: 'uppercase', marginBottom: 8 }}>
            📰 {article.category || 'Panduan & Edukasi K3'}
          </p>
          <h1 style={{ fontSize: '2.2rem', fontWeight: 800, lineHeight: 1.3, marginBottom: 16 }}>
            {article.title}
          </h1>
          <p style={{ color: '#94a3b8', fontSize: 14 }}>
            📅 {article.date || '05 Maret 2026'} &nbsp;•&nbsp; ⏱️ {article.read_time || '5 min baca'}
          </p>
        </div>
      </section>

      <section style={{ padding: '60px 0', background: '#fff' }}>
        <div className="container" style={{ maxWidth: 840, fontSize: 16, lineHeight: 1.8, color: '#334155' }}>
          {article.content ? (
            <div dangerouslySetInnerHTML={{ __html: article.content }} />
          ) : (
            <p>{article.excerpt}</p>
          )}

          <div style={{ marginTop: 40, paddingTop: 24, borderTop: '1px solid #e2e8f0' }}>
            <Link href="/artikel/" style={{ color: '#0284c7', fontWeight: 700 }}>
              &larr; Kembali ke Daftar Artikel
            </Link>
          </div>
        </div>
      </section>
    </article>
  );
}
