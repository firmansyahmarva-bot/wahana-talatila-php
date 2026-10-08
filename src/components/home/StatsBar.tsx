import React from 'react';

export default function StatsBar() {
  return (
    <section className="stats-bar">
      <div className="container stats-inner">
        <div className="stat-item">
          <span className="stat-number" data-count="120000" data-suffix="+">
            120.000+
          </span>
          <span className="stat-label">Peserta Bersertifikasi</span>
        </div>
        <div className="stat-divider" />
        <div className="stat-item">
          <span className="stat-number" data-count="125" data-suffix="+">
            125+
          </span>
          <span className="stat-label">Program Pelatihan</span>
        </div>
        <div className="stat-divider" />
        <div className="stat-item">
          <span className="stat-number">BNSP</span>
          <span className="stat-label">Sertifikasi Resmi</span>
        </div>
        <div className="stat-divider" />
        <div className="stat-item">
          <span className="stat-number" data-count="4" data-suffix="">
            4
          </span>
          <span className="stat-label">Bidang Keahlian</span>
        </div>
      </div>
    </section>
  );
}
