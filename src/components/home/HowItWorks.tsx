import React from 'react';

const steps = [
  {
    num: 'Langkah 01',
    icon: '📋',
    title: 'Pilih Program',
    desc: 'Browse katalog 40+ program pelatihan K3, Lingkungan, Mining, dan ISO. Filter sesuai kategori dan mode pelatihan.',
  },
  {
    num: 'Langkah 02',
    icon: '💬',
    title: 'Hubungi via WhatsApp',
    desc: 'Klik tombol Daftar Sekarang. Tim kami merespons dalam 1×24 jam untuk konfirmasi jadwal dan biaya.',
  },
  {
    num: 'Langkah 03',
    icon: '📚',
    title: 'Ikuti Pelatihan',
    desc: 'Pelatihan online via Zoom atau tatap muka di Yogyakarta. Materi terstruktur, instruktur praktisi berpengalaman.',
  },
  {
    num: 'Langkah 04',
    icon: '🏆',
    title: 'Terima Sertifikat',
    desc: 'Lulus ujian kompetensi, sertifikat resmi KEMNAKER RI / BNSP diterbitkan dan dikirimkan ke alamat Anda.',
  },
];

export default function HowItWorks() {
  return (
    <section className="section-how fade-in">
      <div className="container">
        <div className="section-header">
          <p className="section-eyebrow">Mudah &amp; Cepat</p>
          <h2 className="section-title">Cara Daftar Pelatihan</h2>
          <p className="section-subtitle">
            Proses pendaftaran sederhana, tanpa birokrasi rumit. Sertifikat terbit tepat waktu.
          </p>
        </div>
        <div className="how-steps">
          {steps.map((s, idx) => (
            <div
              key={idx}
              className="how-step"
              data-reveal="up"
              data-reveal-delay={String(idx + 1)}
            >
              <span className="how-step-num">{s.num}</span>
              <div className="how-step-icon">{s.icon}</div>
              <h3>{s.title}</h3>
              <p>{s.desc}</p>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
