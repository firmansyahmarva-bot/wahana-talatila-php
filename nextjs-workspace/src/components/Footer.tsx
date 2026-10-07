import React from 'react';
import Link from 'next/link';

export default function Footer() {
  return (
    <footer className="footer">
      {/* Quick Contact Strip */}
      <div className="footer-contact-strip" style={{ background: '#0f172a', padding: '16px 0', borderBottom: '1px solid #1e293b' }}>
        <div className="container fcs-inner" style={{ display: 'flex', gap: 16, justifyContent: 'center', flexWrap: 'wrap' }}>
          <a href="mailto:info@wahanatotalita.com" className="btn btn-outline" style={{ display: 'inline-flex', alignItems: 'center', gap: 8, color: '#fff', borderColor: '#334155' }}>
            <span>Email Kami</span>
          </a>
          <a 
            href="https://wa.me/6287759151278?text=Halo%20Admin%20Wahana%20Totalita,%20saya%20ingin%20tanya%20jadwal%20dan%20biaya%20pelatihan"
            target="_blank"
            rel="noopener noreferrer"
            className="btn btn-primary"
            style={{ display: 'inline-flex', alignItems: 'center', gap: 8, background: '#25D366', borderColor: '#25D366', color: '#fff' }}
          >
            <span>WhatsApp Konsultasi</span>
          </a>
        </div>
      </div>

      <div className="container footer-inner" style={{ padding: '48px 0', display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(220px, 1fr))', gap: 32 }}>
        {/* Col 1: Brand & Accreditation */}
        <div className="footer-brand">
          <div className="footer-logo" style={{ display: 'flex', alignItems: 'center', gap: 8, marginBottom: 12 }}>
            <span style={{ display: 'inline-flex', alignItems: 'center', justifyContent: 'center', width: 32, height: 32, borderRadius: 6, background: '#059669', color: '#fff', fontWeight: 800 }}>
              W
            </span>
            <span style={{ fontSize: 18, fontWeight: 700 }}>Wahana Totalita Konsultan</span>
          </div>
          <p style={{ color: '#94a3b8', fontSize: 14, lineHeight: 1.6 }}>
            Lembaga pelatihan &amp; sertifikasi K3 resmi berlisensi Kemnaker RI &amp; terakreditasi BNSP. Melayani public training di Yogyakarta dan in-house di seluruh Indonesia.
          </p>
        </div>

        {/* Col 2: Program Sertifikasi Populer */}
        <div className="footer-nav">
          <h4 style={{ color: '#f8fafc', marginBottom: 16 }}>Program Populer</h4>
          <ul style={{ listStyle: 'none', padding: 0, margin: 0, display: 'flex', flexDirection: 'column', gap: 10 }}>
            <li><Link href="/ahli-k3-umum/" style={{ color: '#cbd5e1' }}>Ahli K3 Umum Kemnaker RI</Link></li>
            <li><Link href="/csms/" style={{ color: '#cbd5e1' }}>CSMS Contractor Safety</Link></li>
            <li><Link href="/smk3/" style={{ color: '#cbd5e1' }}>SMK3 PP 50/2012</Link></li>
            <li><Link href="/k3-konstruksi/" style={{ color: '#cbd5e1' }}>K3 Konstruksi</Link></li>
            <li><Link href="/k3-listrik/" style={{ color: '#cbd5e1' }}>K3 Listrik &amp; Energi</Link></li>
          </ul>
        </div>

        {/* Col 3: Layanan & Kota */}
        <div className="footer-nav">
          <h4 style={{ color: '#f8fafc', marginBottom: 16 }}>Kota Pelatihan</h4>
          <ul style={{ listStyle: 'none', padding: 0, margin: 0, display: 'flex', flexDirection: 'column', gap: 10 }}>
            <li><Link href="/kota/yogyakarta/" style={{ color: '#cbd5e1' }}>Pelatihan K3 Yogyakarta</Link></li>
            <li><Link href="/kota/jakarta/" style={{ color: '#cbd5e1' }}>Pelatihan K3 Jakarta</Link></li>
            <li><Link href="/kota/surabaya/" style={{ color: '#cbd5e1' }}>Pelatihan K3 Surabaya</Link></li>
            <li><Link href="/kota/bandung/" style={{ color: '#cbd5e1' }}>Pelatihan K3 Bandung</Link></li>
            <li><Link href="/jadwal/" style={{ color: '#cbd5e1' }}>Jadwal Pelatihan 2026</Link></li>
          </ul>
        </div>

        {/* Col 4: Informasi & Kontak */}
        <div className="footer-nav">
          <h4 style={{ color: '#f8fafc', marginBottom: 16 }}>Hubungi Kami</h4>
          <p style={{ color: '#cbd5e1', fontSize: 14, margin: '0 0 8px 0' }}>
            📍 Jl. Kebon Agung No. 12, Sleman, DI Yogyakarta
          </p>
          <p style={{ color: '#cbd5e1', fontSize: 14, margin: '0 0 8px 0' }}>
            📞 WhatsApp: +62 877-5915-1278
          </p>
          <p style={{ color: '#cbd5e1', fontSize: 14, margin: '0 0 8px 0' }}>
            ✉️ Email: info@wahanatotalita.com
          </p>
        </div>
      </div>

      {/* Copyright Bar */}
      <div style={{ background: '#020617', padding: '16px 0', borderTop: '1px solid #1e293b', color: '#64748b', fontSize: 13, textAlign: 'center' }}>
        <div className="container">
          &copy; {new Date().getFullYear()} Wahana Totalita Konsultan. All rights reserved.
        </div>
      </div>
    </footer>
  );
}
