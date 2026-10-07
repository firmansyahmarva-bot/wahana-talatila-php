import React from 'react';
import Link from 'next/link';

export const metadata = {
  title: 'Panduan CSMS Indonesia: 7 Elemen, Siklus K3LL Pertamina & Pendampingan High Risk',
  description:
    'Panduan komprehensif CSMS (Contractor Safety Management System) Indonesia: Siklus K3LL Pertamina, 7 elemen penilaian, prakualifikasi & jasa pendampingan lolos High Risk.',
};

export default function CSMSPage() {
  const elements = [
    { title: '1. Kepemimpinan & Komitmen', desc: 'Komitmen manajemen puncak dalam implementasi K3LL dan alokasi sumber daya.' },
    { title: '2. Kebijakan & Sasaran Strategis', desc: 'Kebijakan K3LL tertulis, sosialisasi, dan target K3 perusahan.' },
    { title: '3. Organisasi, Tanggung Jawab & Standar', desc: 'Struktur HSE, tugas & wewenang personel, serta standar operasional.' },
    { title: '4. Manajeman Risiko (IBPR / HIRADC)', desc: 'Identifikasi bahaya, penilaian risiko, dan tindakan pengendalian.' },
    { title: '5. Perencanaan & Prosedur Operasional', desc: 'Prosedur kerja aman (SOP), tanggap darurat, dan izin kerja (PTW).' },
    { title: '6. Pemantauan Implementasi & Audit', desc: 'Inspeksi K3, audit internal, investigasi insiden & pelaporan.' },
    { title: '7. Tinjauan Manajemen & Evaluasi', desc: 'Evaluasi berkala kinerja CHSEMS oleh Manajemen Puncak.' },
  ];

  return (
    <div className="page-wrapper">
      <section style={{ background: 'linear-gradient(135deg, #0f172a 0%, #1e293b 100%)', color: '#fff', padding: '60px 0' }}>
        <div className="container">
          <span style={{ background: '#0284c7', color: '#fff', padding: '4px 12px', borderRadius: 16, fontSize: 13, fontWeight: 700 }}>
            HSE &amp; Tender Management
          </span>
          <h1 style={{ fontSize: '2.5rem', fontWeight: 800, marginTop: 12, marginBottom: 16 }}>
            CSMS (Contractor Safety Management System)
          </h1>
          <p style={{ color: '#94a3b8', fontSize: '1.1rem', maxWidth: 720, lineHeight: 1.6, marginBottom: 24 }}>
            Sistem Pengelolaan K3 Kontraktor untuk kualifikasi tender di Pertamina, BUMN, Migas &amp; Pertambangan. Pendampingan persiapan dokumen hingga lulus penilaian High Risk.
          </p>
          <a
            href="https://wa.me/6287759151278?text=Halo%20Wahana%20Totalita,%20kami%20ingin%20konsultasi%20pendampingan%20dokumen%20CSMS%20High%20Risk"
            target="_blank"
            rel="noopener noreferrer"
            className="btn btn-primary"
            style={{ background: '#25D366', borderColor: '#25D366', padding: '12px 28px', fontWeight: 700 }}
          >
            Konsultasi CSMS via WhatsApp
          </a>
        </div>
      </section>

      <section style={{ padding: '60px 0', background: '#fff' }}>
        <div className="container">
          <h2 style={{ fontSize: '1.8rem', fontWeight: 800, color: '#0f172a', textAlign: 'center', marginBottom: 40 }}>
            7 Elemen Penilaian CSMS / Siklus K3LL Pertamina
          </h2>
          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(300px, 1fr))', gap: 20 }}>
            {elements.map((el, idx) => (
              <div key={idx} style={{ padding: 20, background: '#f8fafc', borderRadius: 8, border: '1px solid #e2e8f0' }}>
                <h3 style={{ fontSize: 16, fontWeight: 700, color: '#0369a1', margin: '0 0 8px 0' }}>{el.title}</h3>
                <p style={{ color: '#475569', fontSize: 14, margin: 0, lineHeight: 1.5 }}>{el.desc}</p>
              </div>
            ))}
          </div>
        </div>
      </section>
    </div>
  );
}
