import React from 'react';
import Link from 'next/link';

export const metadata = {
  title: 'Pelatihan & Sertifikasi Ahli K3 Umum (AK3U) Kemnaker RI & BNSP 2026',
  description:
    'Pusat pendaftaran Pelatihan Ahli K3 Umum (AK3U) resmi Kemnaker RI & BNSP. Informasi lengkap rincian biaya pelatihan, syarat pendaftaran, jadwal 2026, jalur fresh graduate & in-house.',
};

export default function AhliK3UmumPage() {
  const batches = [
    {
      name: 'Batch Reguler Blended Online Zoom 2026',
      date: '16 – 28 Maret 2026',
      method: 'Online Zoom Interaktif',
      price: 'Rp 7.500.000',
      badge: 'Sertifikasi Kemnaker RI',
    },
    {
      name: 'Batch Tatap Muka Yogyakarta',
      date: '06 – 18 April 2026',
      method: 'Training Center Yogyakarta',
      price: 'Rp 9.800.000',
      badge: 'Tatap Muka & Praktik Lapangan',
    },
    {
      name: 'Batch BNSP Sertifikasi Profesi',
      date: '20 – 24 April 2026',
      method: 'Hybrid Zoom & Asesmen',
      price: 'Rp 6.200.000',
      badge: 'Sertifikasi BNSP',
    },
  ];

  const requirements = [
    'Pendidikan Minimal D3 / S1 semua jurusan (Fresh Graduate / Profesional)',
    'Fotokopi / Scan Ijazah Terakhir & Transkrip Nilai',
    'Fotokopi / Scan KTP Elektronik (NIK)',
    'Pasfoto background MERAH berpakaian rapi (Kemeja/Jas)',
    'Surat Keterangan Sehat dari Dokter',
    'Surat Utusan Perusahaan (Khusus peserta utusan perusahaan)',
  ];

  const faqs = [
    {
      q: 'Apa perbedaan Ahli K3 Umum Kemnaker RI dan BNSP?',
      a: 'Ahli K3 Umum Kemnaker RI memberikan Lisensi & SKP (Surat Keputusan Penunjukan) untuk bertindak sebagai penanggung jawab K3 di perusahaan. Sedangkan BNSP memberikan sertifikat kompetensi berbasis okupasi nasional.',
    },
    {
      q: 'Apakah Fresh Graduate D3/S1 bisa langsung mendaftar?',
      a: 'Bisa! Jalur Fresh Graduate diperbolehkan mengikuti pembinaan calon Ahli K3 Umum untuk mempersiapkan sertifikasi dan meningkatkan daya saing karir K3 di industri.',
    },
    {
      q: 'Bagaimana sistem pembayaran dan pendaftaran?',
      a: 'Pendaftaran cukup dengan mengisi formulir online dan membayar DP (Down Payment) untuk mengamankan kuota kelas. Pelunasan dapat dilakukan sebelum pembukaan kelas.',
    },
  ];

  return (
    <div className="page-wrapper">
      {/* PAGE HERO */}
      <section style={{ background: 'linear-gradient(135deg, #0f172a 0%, #1e293b 100%)', color: '#fff', padding: '60px 0' }}>
        <div className="container">
          <p style={{ color: '#10b981', fontWeight: 700, fontSize: 14, textTransform: 'uppercase', marginBottom: 8 }}>
            🟢 Pembinaan &amp; Sertifikasi Resmi Kemnaker RI &amp; BNSP
          </p>
          <h1 style={{ fontSize: '2.5rem', fontWeight: 800, lineHeight: 1.2, marginBottom: 16 }}>
            Pelatihan Ahli K3 Umum (AK3U)
          </h1>
          <p style={{ color: '#94a3b8', fontSize: '1.1rem', maxWidth: 720, lineHeight: 1.6, marginBottom: 24 }}>
            Tingkatkan kompetensi &amp; karir K3 Anda dengan Sertifikat, SKP, dan Lisensi Ahli K3 Umum Resmi Kementerian Ketenagakerjaan RI &amp; BNSP.
          </p>
          <div style={{ display: 'flex', gap: 16, flexWrap: 'wrap' }}>
            <a
              href="https://wa.me/6287759151278?text=Halo%20Wahana%20Totalita,%20saya%20ingin%20tanya%20jadwal%20dan%20pendaftaran%20Ahli%20K3%20Umum"
              target="_blank"
              rel="noopener noreferrer"
              className="btn btn-primary"
              style={{ background: '#25D366', borderColor: '#25D366', padding: '12px 24px', fontWeight: 700 }}
            >
              Daftar Sekarang via WhatsApp
            </a>
            <a href="#jadwal" className="btn btn-outline" style={{ color: '#fff', borderColor: '#475569', padding: '12px 24px' }}>
              Lihat Jadwal Batch 2026 ↓
            </a>
          </div>
        </div>
      </section>

      {/* REQUIREMENTS & SYARAT */}
      <section style={{ padding: '60px 0', background: '#fff' }}>
        <div className="container">
          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(320px, 1fr))', gap: 40, alignItems: 'center' }}>
            <div>
              <p style={{ color: '#059669', fontWeight: 700, fontSize: 14, textTransform: 'uppercase', marginBottom: 8 }}>Syarat Pendaftaran</p>
              <h2 style={{ fontSize: '1.8rem', fontWeight: 800, color: '#0f172a', marginBottom: 20 }}>Syarat &amp; Dokumen Peserta AK3U</h2>
              <ul style={{ listStyle: 'none', padding: 0, margin: 0, display: 'flex', flexDirection: 'column', gap: 12 }}>
                {requirements.map((req, idx) => (
                  <li key={idx} style={{ display: 'flex', gap: 12, alignItems: 'flex-start', color: '#334155', fontSize: 15 }}>
                    <span style={{ color: '#059669', fontWeight: 800 }}>✓</span>
                    <span>{req}</span>
                  </li>
                ))}
              </ul>
            </div>

            <div style={{ background: '#f8fafc', padding: 32, borderRadius: 12, border: '1px solid #e2e8f0' }}>
              <h3 style={{ fontSize: 20, fontWeight: 700, color: '#0f172a', marginBottom: 16 }}>Fasilitas Resmi Peserta</h3>
              <ul style={{ listStyle: 'none', padding: 0, margin: '0 0 24px 0', display: 'flex', flexDirection: 'column', gap: 10, color: '#475569', fontSize: 14 }}>
                <li>📜 Sertifikat Ahli K3 Umum Resmi Kemnaker RI / BNSP</li>
                <li>🛡️ SKP (Surat Keputusan Penunjukan) &amp; Lisensi K3</li>
                <li>📚 Modul Pembinaan Himpunan Peraturan Perundangan K3</li>
                <li>🎒 Training Kit &amp; Souvenir Exclusive Wahana Totalita</li>
                <li>☕ Coffee Break &amp; Lunch (Kelas Tatap Muka)</li>
                <li>👥 Alumni Network &amp; Akses Lowongan Kerja K3</li>
              </ul>
            </div>
          </div>
        </div>
      </section>

      {/* SCHEDULE BATCHES */}
      <section id="jadwal" style={{ padding: '60px 0', background: '#f8fafc' }}>
        <div className="container">
          <div style={{ textAlign: 'center', marginBottom: 40 }}>
            <p style={{ color: '#059669', fontWeight: 700, textTransform: 'uppercase', fontSize: 14 }}>Jadwal Terdekat</p>
            <h2 style={{ fontSize: '1.8rem', fontWeight: 800, color: '#0f172a' }}>Jadwal Pelatihan Ahli K3 Umum 2026</h2>
          </div>

          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(300px, 1fr))', gap: 24 }}>
            {batches.map((batch, idx) => (
              <div key={idx} style={{ background: '#fff', padding: 24, borderRadius: 12, border: '1px solid #cbd5e1', boxShadow: '0 2px 8px rgba(0,0,0,0.04)' }}>
                <span style={{ background: '#e0f2fe', color: '#0369a1', padding: '4px 10px', borderRadius: 16, fontSize: 12, fontWeight: 700 }}>
                  {batch.badge}
                </span>
                <h3 style={{ fontSize: 18, fontWeight: 700, color: '#0f172a', margin: '12px 0 8px 0' }}>{batch.name}</h3>
                <p style={{ color: '#475569', fontSize: 14, margin: '0 0 4px 0' }}>📅 <strong>Tanggal:</strong> {batch.date}</p>
                <p style={{ color: '#475569', fontSize: 14, margin: '0 0 16px 0' }}>💻 <strong>Metode:</strong> {batch.method}</p>
                <div style={{ borderTop: '1px solid #f1f5f9', paddingTop: 16, display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
                  <span style={{ fontSize: 18, fontWeight: 800, color: '#059669' }}>{batch.price}</span>
                  <a
                    href={`https://wa.me/6287759151278?text=Halo%20Wahana%20Totalita,%20saya%20ingin%20daftar%20${encodeURIComponent(batch.name)}`}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="btn btn-primary"
                    style={{ background: '#059669', borderColor: '#059669', fontSize: 13, padding: '8px 16px' }}
                  >
                    Daftar Batch
                  </a>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* FAQ SECTION */}
      <section style={{ padding: '60px 0', background: '#fff' }}>
        <div className="container" style={{ maxWidth: 800 }}>
          <h2 style={{ fontSize: '1.8rem', fontWeight: 800, color: '#0f172a', textAlign: 'center', marginBottom: 32 }}>Pertanyaan Sering Diajukan (FAQ)</h2>
          <div style={{ display: 'flex', flexDirection: 'column', gap: 16 }}>
            {faqs.map((faq, idx) => (
              <div key={idx} style={{ padding: 20, background: '#f8fafc', borderRadius: 8, border: '1px solid #e2e8f0' }}>
                <h3 style={{ fontSize: 16, fontWeight: 700, color: '#0f172a', margin: '0 0 8px 0' }}>{faq.q}</h3>
                <p style={{ color: '#475569', fontSize: 14, margin: 0, lineHeight: 1.5 }}>{faq.a}</p>
              </div>
            ))}
          </div>
        </div>
      </section>
    </div>
  );
}
