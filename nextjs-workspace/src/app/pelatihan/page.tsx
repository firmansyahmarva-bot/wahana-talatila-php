import React from 'react';
import Link from 'next/link';

export const metadata = {
  title: 'Katalog Pelatihan & Sertifikasi K3 Kemnaker RI – BNSP 2026',
  description:
    'Katalog lengkap 125+ program pelatihan K3, Lingkungan, ISO, & Mining bersertifikasi resmi Kemnaker RI dan BNSP. Tatap Muka & Online Zoom.',
};

export default function PelatihanPage() {
  const courses = [
    { title: 'Ahli K3 Umum (AK3U)', category: 'Kemnaker RI', link: '/ahli-k3-umum/', mode: 'Blended / Tatap Muka' },
    { title: 'Contractor Safety Management System (CSMS)', category: 'K3 Korporasi', link: '/csms/', mode: 'Online Zoom' },
    { title: 'SMK3 PP 50/2012 & Auditor SMK3', category: 'Kemnaker RI', link: '/smk3/', mode: 'Blended' },
    { title: 'K3 Bekerja di Ketinggian (TKBT/TKPK)', category: 'Teknisi K3', link: '/k3-ketinggian/', mode: 'Tatap Muka' },
    { title: 'K3 Listrik & Energi', category: 'Kemnaker / BNSP', link: '/k3-listrik/', mode: 'Blended' },
    { title: 'K3 Minyak & Gas (Migas)', category: 'BNSP', link: '/k3-migas/', mode: 'Online Zoom' },
    { title: 'Petugas P3K (Pertolongan Pertama)', category: 'Kemnaker RI', link: '/p3k/', mode: 'Tatap Muka' },
    { title: 'K3 Kimia & B3', category: 'Kemnaker RI', link: '/k3-kimia/', mode: 'Blended' },
  ];

  return (
    <div className="page-wrapper">
      <section style={{ background: 'linear-gradient(135deg, #0f172a 0%, #1e293b 100%)', color: '#fff', padding: '60px 0' }}>
        <div className="container">
          <h1 style={{ fontSize: '2.5rem', fontWeight: 800, marginBottom: 16 }}>
            Katalog Pelatihan K3 &amp; Sertifikasi
          </h1>
          <p style={{ color: '#94a3b8', fontSize: '1.1rem', maxWidth: 680, lineHeight: 1.6 }}>
            Pilih dari 125+ program pembinaan &amp; sertifikasi K3 resmi Kemnaker RI &amp; BNSP untuk perorangan dan perusahaan.
          </p>
        </div>
      </section>

      <section style={{ padding: '60px 0', background: '#fff' }}>
        <div className="container">
          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(280px, 1fr))', gap: 20 }}>
            {courses.map((c, idx) => (
              <div key={idx} style={{ padding: 20, background: '#f8fafc', borderRadius: 8, border: '1px solid #e2e8f0', display: 'flex', flexDirection: 'column', justifyContent: 'space-between' }}>
                <div>
                  <span style={{ fontSize: 12, fontWeight: 700, color: '#059669', background: '#ecfdf5', padding: '2px 8px', borderRadius: 12 }}>{c.category}</span>
                  <h3 style={{ fontSize: 18, fontWeight: 700, color: '#0f172a', margin: '10px 0 6px 0' }}>{c.title}</h3>
                  <p style={{ color: '#64748b', fontSize: 13, margin: '0 0 16px 0' }}>💻 {c.mode}</p>
                </div>
                <Link href={c.link} style={{ color: '#0284c7', fontWeight: 700, fontSize: 14 }}>
                  Lihat Detail &rarr;
                </Link>
              </div>
            ))}
          </div>
        </div>
      </section>
    </div>
  );
}
