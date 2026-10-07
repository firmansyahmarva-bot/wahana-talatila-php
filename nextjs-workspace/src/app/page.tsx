import React from 'react';
import Link from 'next/link';

export const metadata = {
  title: 'Wahana Totalita Konsultan — Pelatihan K3 & Sertifikasi Resmi Kemnaker RI – BNSP',
  description:
    'Lembaga Pelatihan & Konsultan K3 Resmi — 125+ program K3, Lingkungan, ISO, dan Mining bersertifikasi BNSP & KEMNAKER RI. Kelas online Zoom & tatap muka Yogyakarta.',
};

export default function HomePage() {
  const featuredPrograms = [
    {
      title: 'Ahli K3 Umum (AK3U) Kemnaker RI',
      category: 'Sertifikasi Kemnaker RI',
      desc: 'Pelatihan Sertifikasi Calon Ahli K3 Umum KEMNAKER RI. Pembinaan tatap muka & Blended/Online Zoom.',
      duration: '12 Hari Pembinaan',
      badge: 'Terpopuler',
      link: '/ahli-k3-umum/',
      icon: '🛡️',
    },
    {
      title: 'CSMS (Contractor Safety Management System)',
      category: 'K3 Korporasi & Tender',
      desc: 'Sistem Manajemen Keselamatan Kontraktor untuk kualifikasi tender minyak, gas, tambang & manufaktur.',
      duration: '2 Hari Training',
      badge: 'Rekomendasi Tender',
      link: '/csms/',
      icon: '⚙️',
    },
    {
      title: 'SMK3 PP 50 Tahun 2012 & Audit SMK3',
      category: 'Sertifikasi Kemnaker RI',
      desc: 'Penerapan & Audit Sistem Manajemen Keselamatan dan Kesehatan Kerja sesuai Peraturan Pemerintah.',
      duration: '3 Hari Training',
      badge: 'Regulasi Resmi',
      link: '/smk3/',
      icon: '📋',
    },
    {
      title: 'K3 Bekerja di Ketinggian (TKBT / TKPK)',
      category: 'Teknisi K3',
      desc: 'Tenaga Kerja Bangunan Tinggi (TKBT) & Tenaga Kerja Pada Ketinggian (TKPK) Kemnaker RI.',
      duration: '3-5 Hari',
      badge: 'Sertifikasi Kemnaker',
      link: '/k3-ketinggian/',
      icon: '🧗',
    },
    {
      title: 'K3 Konstruksi & Bangunan',
      category: 'Konstruksi & Sipil',
      desc: 'Pelatihan & Pembinaan K3 Sipil, Gedung, Jalan, dan Infrastruktur Nasional.',
      duration: '6 Hari Training',
      badge: 'Kemnaker / BNSP',
      link: '/k3-konstruksi/',
      icon: '🏗️',
    },
    {
      title: 'K3 Minyak, Gas & Petrokimia',
      category: 'Sektor Migas',
      desc: 'K3 Hulu-Hilir Migas, Keselamatan Operasional Kilang & Pengolahan Bahan Berbahaya.',
      duration: '4-5 Hari Training',
      badge: 'Sertifikasi BNSP',
      link: '/k3-migas/',
      icon: '🛢️',
    },
  ];

  return (
    <div className="homepage-wrapper">
      {/* HERO SECTION */}
      <section className="hero hero26" style={{ background: 'linear-gradient(135deg, #0f172a 0%, #1e293b 100%)', color: '#fff', padding: '80px 0 60px' }}>
        <div className="container hero26-inner" style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(320px, 1fr))', gap: 40, alignItems: 'center' }}>
          <div className="hero26-content">
            <p className="hero26-eyebrow" style={{ color: '#10b981', fontWeight: 700, fontSize: 14, letterSpacing: '0.05em', textTransform: 'uppercase', marginBottom: 12 }}>
              🟢 PJK3 · KEMNAKER RI · BNSP · Vendor LPSE
            </p>
            <h1 className="hero26-title" style={{ fontSize: '2.5rem', fontWeight: 800, lineHeight: 1.2, marginBottom: 20 }}>
              Pelatihan K3 &amp; Sertifikasi Kemnaker RI – BNSP<br />
              <em style={{ fontStyle: 'normal', color: '#38bdf8' }}>Wahana Totalita Konsultan K3</em>
            </h1>
            <p className="hero26-sub" style={{ color: '#94a3b8', fontSize: '1.1rem', lineHeight: 1.6, marginBottom: 32 }}>
              Lembaga Pelatihan &amp; Konsultan K3 Resmi — 125+ program K3, Lingkungan, ISO, dan Mining bersertifikasi BNSP &amp; KEMNAKER RI. Kelas online interaktif via Zoom dan tatap muka di Yogyakarta.
            </p>

            <div className="hero26-actions" style={{ display: 'flex', gap: 16, flexWrap: 'wrap' }}>
              <a
                href="https://wa.me/6287759151278?text=Halo%20Wahana%20Totalita,%20saya%20ingin%20konsultasi%20program%20pelatihan%20K3"
                target="_blank"
                rel="noopener noreferrer"
                className="btn btn-primary"
                style={{ background: '#25D366', borderColor: '#25D366', padding: '14px 28px', fontSize: 16, fontWeight: 700 }}
              >
                Konsultasi via WhatsApp
              </a>
              <Link href="/jadwal/" className="btn btn-outline" style={{ color: '#fff', borderColor: '#475569', padding: '14px 28px', fontSize: 16 }}>
                Lihat Jadwal 2026 &rarr;
              </Link>
            </div>
          </div>

          <aside className="hero26-card" style={{ background: 'rgba(30, 41, 59, 0.8)', padding: 32, borderRadius: 16, border: '1px solid #334155', backdropFilter: 'blur(10px)' }}>
            <h3 style={{ fontSize: 20, fontWeight: 700, marginBottom: 20, color: '#f8fafc' }}>Kenapa Wahana Totalita?</h3>
            <div className="hero26-stat" style={{ marginBottom: 20 }}>
              <span style={{ fontSize: '2.5rem', fontWeight: 800, color: '#10b981' }}>120.000+</span>
              <p style={{ color: '#cbd5e1', margin: 0, fontSize: 14 }}>Peserta Bersertifikasi</p>
            </div>
            <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: 16, borderTop: '1px solid #334155', paddingTop: 16 }}>
              <div>
                <span style={{ fontSize: 20, fontWeight: 700, color: '#38bdf8' }}>125+</span>
                <p style={{ color: '#94a3b8', fontSize: 13, margin: 0 }}>Program Aktif</p>
              </div>
              <div>
                <span style={{ fontSize: 20, fontWeight: 700, color: '#38bdf8' }}>2008</span>
                <p style={{ color: '#94a3b8', fontSize: 13, margin: 0 }}>Berdiri Sejak</p>
              </div>
            </div>
          </aside>
        </div>
      </section>

      {/* TRUST BAR */}
      <section style={{ background: '#090d16', padding: '24px 0', borderBottom: '1px solid #1e293b', color: '#cbd5e1' }}>
        <div className="container" style={{ display: 'flex', justifyContent: 'space-around', flexWrap: 'wrap', gap: 24, textTransform: 'uppercase', fontSize: 13, fontWeight: 600 }}>
          <span>🏛️ KEMNAKER RI</span>
          <span>📋 BNSP Sertifikasi</span>
          <span>⚡ ESDM Pertambangan</span>
          <span>🌿 KLHK Lingkungan</span>
          <span>🏅 ISO 9001 Mutu</span>
        </div>
      </section>

      {/* FEATURED PROGRAMS */}
      <section style={{ padding: '80px 0', background: '#f8fafc' }}>
        <div className="container">
          <div style={{ textAlign: 'center', marginBottom: 48 }}>
            <p style={{ color: '#059669', fontWeight: 700, textTransform: 'uppercase', fontSize: 14 }}>Program Utama</p>
            <h2 style={{ fontSize: '2rem', fontWeight: 800, color: '#0f172a' }}>Pelatihan &amp; Sertifikasi K3 Populer</h2>
          </div>

          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(320px, 1fr))', gap: 24 }}>
            {featuredPrograms.map((prog, idx) => (
              <div key={idx} style={{ background: '#fff', padding: 28, borderRadius: 12, boxShadow: '0 4px 12px rgba(0,0,0,0.05)', border: '1px solid #e2e8f0', display: 'flex', flexDirection: 'column', justifyContent: 'space-between' }}>
                <div>
                  <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: 16 }}>
                    <span style={{ fontSize: 32 }}>{prog.icon}</span>
                    <span style={{ background: '#ecfdf5', color: '#059669', padding: '4px 10px', borderRadius: 20, fontSize: 12, fontWeight: 700 }}>{prog.badge}</span>
                  </div>
                  <p style={{ color: '#64748b', fontSize: 13, fontWeight: 600, margin: '0 0 6px 0' }}>{prog.category}</p>
                  <h3 style={{ fontSize: 18, fontWeight: 700, color: '#0f172a', margin: '0 0 12px 0' }}>{prog.title}</h3>
                  <p style={{ color: '#475569', fontSize: 14, lineHeight: 1.5, marginBottom: 20 }}>{prog.desc}</p>
                </div>
                <div style={{ borderTop: '1px solid #f1f5f9', paddingTop: 16, display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
                  <span style={{ fontSize: 13, color: '#64748b', fontWeight: 600 }}>⏱️ {prog.duration}</span>
                  <Link href={prog.link} style={{ color: '#0284c7', fontWeight: 700, fontSize: 14 }}>
                    Detail Program &rarr;
                  </Link>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* CALL TO ACTION */}
      <section style={{ background: 'linear-gradient(135deg, #0284c7 0%, #0369a1 100%)', color: '#fff', padding: '60px 0', textAlign: 'center' }}>
        <div className="container">
          <h2 style={{ fontSize: '2rem', fontWeight: 800, marginBottom: 16 }}>Butuh Pelatihan In-House K3 untuk Perusahaan Anda?</h2>
          <p style={{ fontSize: '1.1rem', opacity: 0.9, maxWidth: 640, margin: '0 auto 32px' }}>
            Kami menyediakan paket pelatihan khusus perusahaan (In-House Training) dengan kurikulum yang disesuaikan dengan kebutuhan &amp; potensi bahaya di tempat kerja Anda.
          </p>
          <a
            href="https://wa.me/6287759151278?text=Halo%20Wahana%20Totalita,%20kami%20tertarik%20dengan%20program%20In-House%20Training%20K3%20untuk%20perusahaan"
            target="_blank"
            rel="noopener noreferrer"
            className="btn btn-primary"
            style={{ background: '#25D366', borderColor: '#25D366', padding: '16px 36px', fontSize: 18, fontWeight: 700 }}
          >
            Minta Penawaran In-House
          </a>
        </div>
      </section>
    </div>
  );
}
