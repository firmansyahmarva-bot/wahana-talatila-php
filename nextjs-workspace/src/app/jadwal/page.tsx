import React from 'react';

export const metadata = {
  title: 'Jadwal Pelatihan & Sertifikasi K3 Terbaru 2026 — Wahana Totalita',
  description:
    'Jadwal lengkap pelatihan K3 Kemnaker RI & BNSP tahun 2026. Kelas online Zoom & tatap muka Yogyakarta, Jakarta, Surabaya, Bandung.',
};

export default function JadwalPage() {
  const schedules = [
    { course: 'Ahli K3 Umum (AK3U) Kemnaker RI', date: '16 – 28 Maret 2026', method: 'Online Zoom Interaktif', status: 'Pendaftaran Dibuka' },
    { course: 'Ahli K3 Umum Tatap Muka Yogyakarta', date: '06 – 18 April 2026', method: 'Training Center Yogyakarta', status: 'Sisa 5 Kuota' },
    { course: 'Contractor Safety Management System (CSMS)', date: '23 – 24 Maret 2026', method: 'Online Zoom', status: 'Pendaftaran Dibuka' },
    { course: 'SMK3 PP 50/2012 & Auditor SMK3', date: '13 – 15 April 2026', method: 'Blended Zoom & Assessment', status: 'Pendaftaran Dibuka' },
    { course: 'K3 Bekerja di Ketinggian (TKBT / TKPK)', date: '20 – 22 April 2026', method: 'Training Center Yogyakarta', status: 'Pendaftaran Dibuka' },
  ];

  return (
    <div className="page-wrapper">
      <section style={{ background: 'linear-gradient(135deg, #0f172a 0%, #1e293b 100%)', color: '#fff', padding: '60px 0' }}>
        <div className="container">
          <h1 style={{ fontSize: '2.5rem', fontWeight: 800, marginBottom: 16 }}>
            Jadwal Pelatihan K3 2026
          </h1>
          <p style={{ color: '#94a3b8', fontSize: '1.1rem', maxWidth: 680, lineHeight: 1.6 }}>
            Jadwal pelaksanaan pembinaan &amp; sertifikasi K3 resmi Kemnaker RI &amp; BNSP terdekat.
          </p>
        </div>
      </section>

      <section style={{ padding: '60px 0', background: '#fff' }}>
        <div className="container">
          <div style={{ display: 'flex', flexDirection: 'column', gap: 16 }}>
            {schedules.map((item, idx) => (
              <div key={idx} style={{ padding: 20, background: '#f8fafc', borderRadius: 8, border: '1px solid #e2e8f0', display: 'flex', justifyContent: 'space-between', alignItems: 'center', flexWrap: 'wrap', gap: 16 }}>
                <div>
                  <span style={{ background: '#ecfdf5', color: '#059669', fontSize: 12, fontWeight: 700, padding: '2px 8px', borderRadius: 12 }}>{item.status}</span>
                  <h3 style={{ fontSize: 18, fontWeight: 700, color: '#0f172a', margin: '6px 0 4px 0' }}>{item.course}</h3>
                  <p style={{ color: '#64748b', fontSize: 14, margin: 0 }}>📅 {item.date} &nbsp;•&nbsp; 💻 {item.method}</p>
                </div>
                <a
                  href={`https://wa.me/6287759151278?text=Halo%20Wahana%20Totalita,%20saya%20ingin%20daftar%20${encodeURIComponent(item.course)}`}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="btn btn-primary"
                  style={{ background: '#059669', borderColor: '#059669', padding: '10px 20px', fontSize: 14, fontWeight: 700 }}
                >
                  Daftar Sekarang
                </a>
              </div>
            ))}
          </div>
        </div>
      </section>
    </div>
  );
}
