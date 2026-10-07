import React from 'react';
import { notFound } from 'next/navigation';
import Link from 'next/link';
import allPagesData from '@/data/all_site_pages.json';

interface SitePage {
  path: string;
  title: string;
  meta_title?: string;
  meta_desc?: string;
  content?: string;
  url: string;
}

const pagesMap = allPagesData as unknown as Record<string, SitePage>;

export async function generateStaticParams() {
  const params: { slug: string[] }[] = [];

  for (const path of Object.keys(pagesMap)) {
    if (path === 'home' || !path) continue;
    const segments = path.split('/');
    params.push({ slug: segments });
  }

  return params;
}

export async function generateMetadata({ params }: { params: Promise<{ slug: string[] }> }) {
  const { slug } = await params;
  const path = slug.join('/');
  const page = pagesMap[path];

  if (!page) return {};

  return {
    title: page.meta_title || page.title,
    description: page.meta_desc || `Panduan & Pelatihan K3 Resmi — ${page.title}`,
  };
}

export default async function CatchAllStaticPage({ params }: { params: Promise<{ slug: string[] }> }) {
  const { slug } = await params;
  const path = slug.join('/');
  const page = pagesMap[path];

  if (!page) {
    notFound();
  }

  const pageTitle = page.title || path.replace(/-/g, ' ').toUpperCase();
  const waUrl = `https://wa.me/6287759151278?text=${encodeURIComponent(`Halo Wahana Totalita, saya ingin informasi mengenai ${pageTitle}`)}`;

  return (
    <article className="page-wrapper">
      {/* HEADER */}
      <section style={{ background: 'linear-gradient(135deg, #0f172a 0%, #1e293b 100%)', color: '#fff', padding: '60px 0' }}>
        <div className="container" style={{ maxWidth: 880 }}>
          <p style={{ color: '#10b981', fontWeight: 700, fontSize: 13, textTransform: 'uppercase', marginBottom: 8 }}>
            🟢 Wahana Totalita Konsultan K3 Resmi
          </p>
          <h1 style={{ fontSize: '2.2rem', fontWeight: 800, lineHeight: 1.3, marginBottom: 16 }}>
            {pageTitle}
          </h1>
          <p style={{ color: '#cbd5e1', fontSize: '1.05rem', lineHeight: 1.6, marginBottom: 24 }}>
            {page.meta_desc || `Halaman resmi informasi dan pendaftaran ${pageTitle}.`}
          </p>
          <div style={{ display: 'flex', gap: 16, flexWrap: 'wrap' }}>
            <a
              href={waUrl}
              target="_blank"
              rel="noopener noreferrer"
              className="btn btn-primary"
              style={{ background: '#25D366', borderColor: '#25D366', padding: '12px 28px', fontWeight: 700 }}
            >
              Konsultasi &amp; Pendaftaran via WA
            </a>
            <Link href="/" className="btn btn-outline" style={{ color: '#fff', borderColor: '#475569', padding: '12px 24px' }}>
              &larr; Kembali ke Beranda
            </Link>
          </div>
        </div>
      </section>

      {/* BODY CONTENT */}
      <section style={{ padding: '60px 0', background: '#fff' }}>
        <div className="container" style={{ maxWidth: 880, fontSize: 16, lineHeight: 1.8, color: '#334155' }}>
          {page.content ? (
            <div dangerouslySetInnerHTML={{ __html: page.content }} />
          ) : (
            <div>
              <h2 style={{ fontSize: 22, fontWeight: 700, color: '#0f172a', marginBottom: 16 }}>
                Informasi Program &amp; Layanan
              </h2>
              <p>
                Halaman ini menyajikan informasi lengkap mengenai <strong>{pageTitle}</strong> yang diselenggarakan oleh <strong>Wahana Totalita Konsultan</strong> berlisensi KEMNAKER RI &amp; terakreditasi BNSP.
              </p>
              <div style={{ marginTop: 24, background: '#f8fafc', padding: 24, borderRadius: 12, border: '1px solid #e2e8f0' }}>
                <h3 style={{ fontSize: 18, fontWeight: 700, color: '#0f172a', marginBottom: 12 }}>Fasilitas &amp; Keunggulan</h3>
                <ul style={{ listStyle: 'none', padding: 0, margin: 0, display: 'flex', flexDirection: 'column', gap: 8 }}>
                  <li>📜 Sertifikat Resmi Kemnaker RI / BNSP</li>
                  <li>👥 Bimbingan Instruktur Practitioner &amp; Senior Auditor</li>
                  <li>☕ Modul Lengkap &amp; Training Kit</li>
                  <li>🤝 Layanan Pendaftaran Individu &amp; In-House Perusahaan</li>
                </ul>
              </div>
            </div>
          )}

          <div style={{ marginTop: 40, paddingTop: 24, borderTop: '1px solid #e2e8f0' }}>
            <Link href="/" style={{ color: '#0284c7', fontWeight: 700 }}>
              &larr; Beranda Utama
            </Link>
          </div>
        </div>
      </section>
    </article>
  );
}
