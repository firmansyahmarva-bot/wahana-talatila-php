import React from 'react';
import Link from 'next/link';

export const metadata = {
  title: 'Direktori & Pusat Informasi K3 Terlengkap Indonesia — Wahana Totalita',
  description:
    'Direktori lengkap bidang keselamatan dan kesehatan kerja (K3), sertifikasi Kemnaker RI & BNSP, modul pelatihan, serta regulasi K3 nasional.',
};

export default function K3IndexPage() {
  const k3Categories = [
    { title: 'Ahli K3 Umum', link: '/ahli-k3-umum/', icon: '🛡️', desc: 'Pembinaan calon Ahli K3 Umum resmi Kemnaker RI.' },
    { title: 'K3 Konstruksi', link: '/k3-konstruksi/', icon: '🏗️', desc: 'Keselamatan gedung, sipil & infrastruktur.' },
    { title: 'K3 Listrik & Energi', link: '/k3-listrik/', icon: '⚡', desc: 'Teknisi & Ahli K3 instalasi listrik.' },
    { title: 'K3 Minyak & Gas', link: '/k3-migas/', icon: '🛢️', desc: 'Hulu-hilir & pengolahan petrokimia.' },
    { title: 'K3 Kimia & B3', link: '/k3-kimia/', icon: '🧪', desc: 'Penanganan bahan berbahaya & beracun.' },
    { title: 'K3 Bekerja di Ketinggian', link: '/k3-ketinggian/', icon: '🧗', desc: 'Teknisi TKBT & TKPK Kemnaker RI.' },
    { title: 'SMK3 PP 50/2012', link: '/smk3/', icon: '📋', desc: 'Sistem manajemen & audit SMK3.' },
    { title: 'CSMS Kontraktor', link: '/csms/', icon: '⚙️', desc: 'Contractor Safety Management System.' },
  ];

  return (
    <div className="page-wrapper">
      <section style={{ background: 'linear-gradient(135deg, #0f172a 0%, #1e293b 100%)', color: '#fff', padding: '60px 0' }}>
        <div className="container">
          <h1 style={{ fontSize: '2.5rem', fontWeight: 800, marginBottom: 16 }}>
            Direktori &amp; Modul K3 Indonesia
          </h1>
          <p style={{ color: '#94a3b8', fontSize: '1.1rem', maxWidth: 680, lineHeight: 1.6 }}>
            Pusat informasi lengkap program pembinaan, sertifikasi profesi, dan standar keselamatan dan kesehatan kerja (K3) nasional.
          </p>
        </div>
      </section>

      <section style={{ padding: '60px 0', background: '#f8fafc' }}>
        <div className="container">
          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(280px, 1fr))', gap: 24 }}>
            {k3Categories.map((item, idx) => (
              <div key={idx} style={{ background: '#fff', padding: 24, borderRadius: 12, border: '1px solid #e2e8f0', boxShadow: '0 2px 8px rgba(0,0,0,0.03)' }}>
                <span style={{ fontSize: 32, display: 'block', marginBottom: 12 }}>{item.icon}</span>
                <h3 style={{ fontSize: 18, fontWeight: 700, color: '#0f172a', margin: '0 0 8px 0' }}>{item.title}</h3>
                <p style={{ color: '#64748b', fontSize: 14, lineHeight: 1.5, margin: '0 0 16px 0' }}>{item.desc}</p>
                <Link href={item.link} style={{ color: '#0284c7', fontWeight: 700, fontSize: 14 }}>
                  Lihat Program &rarr;
                </Link>
              </div>
            ))}
          </div>
        </div>
      </section>
    </div>
  );
}
