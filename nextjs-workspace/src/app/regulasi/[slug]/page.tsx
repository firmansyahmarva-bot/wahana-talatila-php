import React from 'react';
import { notFound } from 'next/navigation';
import Link from 'next/link';
import regulasiData from '@/data/regulasi.json';

interface RegulasiItem {
  slug: string;
  nomor?: string;
  tentang?: string;
  ringkasan?: string;
  kategori?: string;
  pasal_penting?: string[];
  kewajiban_perusahaan?: string;
  sanksi?: string;
  content_html?: string;
}

const regulasiMap = regulasiData as unknown as Record<string, RegulasiItem>;

export async function generateStaticParams() {
  return Object.keys(regulasiMap).map((slug) => ({
    slug,
  }));
}

export async function generateMetadata({ params }: { params: Promise<{ slug: string }> }) {
  const { slug } = await params;
  const reg = regulasiMap[slug];
  if (!reg) return {};

  return {
    title: `${reg.nomor} tentang ${reg.tentang} — Panduan Regulasi K3`,
    description: reg.ringkasan,
  };
}

export default async function RegulasiDetailPage({ params }: { params: Promise<{ slug: string }> }) {
  const { slug } = await params;
  const reg = regulasiMap[slug];

  if (!reg) {
    notFound();
  }

  return (
    <article className="page-wrapper">
      <section style={{ background: 'linear-gradient(135deg, #0f172a 0%, #1e293b 100%)', color: '#fff', padding: '60px 0' }}>
        <div className="container" style={{ maxWidth: 840 }}>
          <p style={{ color: '#10b981', fontWeight: 700, fontSize: 13, textTransform: 'uppercase', marginBottom: 8 }}>
            ⚖️ Regulasi &amp; Hukum K3 Indonesia
          </p>
          <h1 style={{ fontSize: '2.2rem', fontWeight: 800, lineHeight: 1.3, marginBottom: 16 }}>
            {reg.nomor}
          </h1>
          <p style={{ color: '#cbd5e1', fontSize: '1.1rem', lineHeight: 1.6 }}>
            Tentang {reg.tentang}
          </p>
        </div>
      </section>

      <section style={{ padding: '60px 0', background: '#fff' }}>
        <div className="container" style={{ maxWidth: 840, fontSize: 16, lineHeight: 1.8, color: '#334155' }}>
          {reg.ringkasan && (
            <div style={{ background: '#f8fafc', padding: 24, borderRadius: 12, border: '1px solid #e2e8f0', marginBottom: 32 }}>
              <h2 style={{ fontSize: 18, fontWeight: 700, color: '#0f172a', marginBottom: 8 }}>Ringkasan Subtansi</h2>
              <p style={{ margin: 0, color: '#475569' }}>{reg.ringkasan}</p>
            </div>
          )}

          {reg.content_html && (
            <div dangerouslySetInnerHTML={{ __html: reg.content_html }} style={{ marginBottom: 40 }} />
          )}

          {reg.pasal_penting && reg.pasal_penting.length > 0 && (
            <div style={{ marginBottom: 40 }}>
              <h2 style={{ fontSize: 20, fontWeight: 700, color: '#0f172a', marginBottom: 16 }}>Pasal-Pasal Krusial</h2>
              <ul style={{ listStyle: 'none', padding: 0, margin: 0, display: 'flex', flexDirection: 'column', gap: 10 }}>
                {reg.pasal_penting.map((pasal, idx) => (
                  <li key={idx} style={{ background: '#fafafa', padding: 14, borderRadius: 8, border: '1px solid #f1f5f9', color: '#334155' }}>
                    📌 {pasal}
                  </li>
                ))}
              </ul>
            </div>
          )}

          <div style={{ marginTop: 40, paddingTop: 24, borderTop: '1px solid #e2e8f0' }}>
            <Link href="/" style={{ color: '#0284c7', fontWeight: 700 }}>
              &larr; Beranda
            </Link>
          </div>
        </div>
      </section>
    </article>
  );
}
