import React from 'react';

const testimonials = [
  {
    program: 'Ahli K3 Umum',
    quote:
      'Materi sangat relevan dan instruktur berpengalaman di lapangan. Sertifikasi BNSP yang saya dapat langsung diakui perusahaan dan mempercepat karier saya di bidang HSE.',
    initials: 'BS',
    name: 'Budi S.',
    meta: 'HSE Manager · Industri Manufaktur, Jawa Tengah',
  },
  {
    program: 'POPAL',
    quote:
      'Pelatihan online sangat fleksibel dan tidak mengganggu jadwal kerja. Modul lengkap dan tim Wahana Totalita sangat responsif merespon pertanyaan peserta.',
    initials: 'SR',
    name: 'Sari R.',
    meta: 'Environmental Coordinator · Sektor Energi',
  },
  {
    program: 'POP Mining',
    quote:
      'Daftar mudah lewat WhatsApp, sertifikat BNSP terbit tepat waktu. Pelatihan POP ini benar-benar mendukung persiapan saya naik jabatan pengawas lapangan.',
    initials: 'AF',
    name: 'Ahmad F.',
    meta: 'Mining Supervisor · Tambang Batubara, Kalimantan',
  },
];

export default function SocialProof() {
  return (
    <section className="section-social-proof" aria-labelledby="sp-heading">
      <div className="container">
        <p className="section-eyebrow">Dipercaya Profesional Indonesia</p>
        <h2 className="section-title" id="sp-heading">
          Ribuan Peserta Telah Bersertifikasi
        </h2>
        <p className="section-subtitle">
          Bergabung bersama alumni dari berbagai industri di seluruh Indonesia
        </p>
        <div className="sp-stats" aria-label="Statistik peserta">
          <div className="sp-stat">
            <span className="sp-stat-num">120.000+</span>
            <span className="sp-stat-desc">Total Peserta Bersertifikasi</span>
          </div>
          <div className="sp-stat">
            <span className="sp-stat-num">125+</span>
            <span className="sp-stat-desc">Program Pelatihan Tersedia</span>
          </div>
          <div className="sp-stat">
            <span className="sp-stat-num">Sejak 2008</span>
            <span className="sp-stat-desc">Berpengalaman</span>
          </div>
        </div>
        <div className="sp-testimonials">
          {testimonials.map((t, idx) => (
            <article
              key={idx}
              className="sp-card"
              data-reveal="up"
              data-reveal-delay={String(idx + 1)}
            >
              <span className="sp-card-program">{t.program}</span>
              <blockquote className="sp-card-quote">{t.quote}</blockquote>
              <div className="sp-card-footer">
                <div className="sp-card-avatar" aria-hidden="true">
                  {t.initials}
                </div>
                <div>
                  <div className="sp-card-name">{t.name}</div>
                  <div className="sp-card-meta">{t.meta}</div>
                </div>
              </div>
            </article>
          ))}
        </div>
      </div>
    </section>
  );
}
