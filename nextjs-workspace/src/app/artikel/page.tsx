import React from 'react';
import Link from 'next/link';

export const metadata = {
  title: 'Artikel & Panduan K3 Indonesia — Wahana Totalita',
  description:
    'Pusat edukasi & artikel K3 terlengkap: regulasi Kemnaker, panduan CSMS, SMK3, K3 Konstruksi, Migas, dan keselamatan kerja industri.',
};

export default function ArtikelPage() {
  const articles = [
    { title: 'Dasar Hukum Keselamatan dan Kesehatan Kerja (K3) di Indonesia', category: 'Regulasi K3', date: '05 Maret 2026', readTime: '5 min' },
    { title: 'Panduan Lengkap CSMS Pertamina: 7 Elemen & Siklus K3LL', category: 'CSMS & Tender', date: '01 Maret 2026', readTime: '8 min' },
    { title: 'Tugas & Wewenang Ahli K3 Umum di Tempat Kerja Sesuai UU No 1 Tahun 1970', category: 'Ahli K3 Umum', date: '25 Februari 2026', readTime: '6 min' },
    { title: 'Cara Membuat Identifikasi Bahaya dan Penilaian Risiko (IBPR / HIRADC)', category: 'Manajemen Risiko', date: '18 Februari 2026', readTime: '7 min' },
  ];

  return (
    <div className="page-wrapper">
      <section style={{ background: 'linear-gradient(135deg, #0f172a 0%, #1e293b 100%)', color: '#fff', padding: '60px 0' }}>
        <div className="container">
          <h1 style={{ fontSize: '2.5rem', fontWeight: 800, marginBottom: 16 }}>
            Artikel &amp; Panduan K3
          </h1>
          <p style={{ color: '#94a3b8', fontSize: '1.1rem', maxWidth: 680, lineHeight: 1.6 }}>
            Edukasi, regulasi, dan panduan praktis implementasi keselamatan dan kesehatan kerja di industri.
          </p>
        </div>
      </section>

      <section style={{ padding: '60px 0', background: '#fff' }}>
        <div className="container">
          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(300px, 1fr))', gap: 24 }}>
            {articles.map((art, idx) => (
              <div key={idx} style={{ padding: 24, background: '#f8fafc', borderRadius: 12, border: '1px solid #e2e8f0', display: 'flex', flexDirection: 'column', justifyContent: 'space-between' }}>
                <div>
                  <span style={{ fontSize: 12, fontWeight: 700, color: '#0369a1', background: '#e0f2fe', padding: '2px 8px', borderRadius: 12 }}>{art.category}</span>
                  <h3 style={{ fontSize: 18, fontWeight: 700, color: '#0f172a', margin: '12px 0 8px 0', lineHeight: 1.4 }}>{art.title}</h3>
                  <p style={{ color: '#64748b', fontSize: 13, margin: 0 }}>📅 {art.date} &nbsp;•&nbsp; ⏱️ {art.readTime}</p>
                </div>
                <div style={{ marginTop: 16, paddingTop: 12, borderTop: '1px solid #f1f5f9' }}>
                  <span style={{ color: '#0284c7', fontWeight: 700, fontSize: 14 }}>
                    Baca Selengkapnya &rarr;
                  </span>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>
    </div>
  );
}
