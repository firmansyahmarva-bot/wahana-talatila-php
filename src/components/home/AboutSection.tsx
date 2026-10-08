import React from 'react';

export default function AboutSection() {
  return (
    <section className="section-about" id="perusahaan">
      <div className="container about-inner">
        <div className="about-text fade-in">
          <p className="section-eyebrow">Tentang Kami</p>
          <h2 className="section-title">Mitra Sertifikasi &amp; Konsultasi K3</h2>
          <p>
            Wahana Totalita Konsultan merupakan perusahaan yang menyediakan Jasa Pelatihan Sertifikasi
            Lingkungan dan K3, Jasa Konsultasi Lingkungan, Jasa Konsultasi Bisnis, PaDi UMKM, serta
            layanan berbasis kompetensi yang didirikan oleh para profesional di bidangnya. Kami
            berkomitmen dalam pelayanan yang mengutamakan kualitas.
          </p>
          <div className="about-badges">
            <div className="about-badge">
              <strong>KEMNAKER RI</strong>
              <span>Sertifikasi Resmi</span>
            </div>
            <div className="about-badge">
              <strong>BNSP</strong>
              <span>Sertifikasi Profesi</span>
            </div>
            <div className="about-badge">
              <strong>Sejak 2008</strong>
              <span>Berpengalaman</span>
            </div>
          </div>
        </div>
        <div className="about-actions fade-in">
          <a
            href="https://wa.me/6287759151278?text=Halo%2C%20saya%20ingin%20konsultasi%20dengan%20Wahana%20Totalita"
            className="btn-primary"
            target="_blank"
            rel="noopener noreferrer"
          >
            Hubungi Konsultan
          </a>
          <a href="#produk" className="btn-outline">
            Lihat Program
          </a>
        </div>
      </div>
    </section>
  );
}
