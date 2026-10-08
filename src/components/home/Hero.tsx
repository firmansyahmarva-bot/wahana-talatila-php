import React from 'react';
import Link from 'next/link';

export default function Hero() {
  return (
    <section className="hero hero26">
      <div className="hero26-bg" aria-hidden="true" />
      <div className="hero26-glow hero26-glow-a" aria-hidden="true" />
      <div className="hero26-glow hero26-glow-b" aria-hidden="true" />

      <div className="container hero26-inner">
        <div className="hero26-content">
          <p className="hero26-eyebrow">
            <span className="hero26-dot" />
            PJK3 · KEMNAKER RI · BNSP · Vendor LPSE
          </p>
          <h1 className="hero26-title">
            Pelatihan K3 &amp; Sertifikasi Kemnaker RI – BNSP
            <br />
            <em>Wahana Totalita Konsultan K3</em>
          </h1>
          <p className="hero26-sub">
            Wahana Totalita Konsultan menyediakan jasa pelatihan sertifikasi lingkungan, K3, mining,
            dan system management yang diakui KEMNAKER RI, BNSP, PaDi UMKM
          </p>

          <div className="hero26-actions">
            <a
              href="https://wa.me/6287759151278?text=Halo%2C%20saya%20ingin%20konsultasi%20program%20pelatihan%20K3"
              className="btn26 btn26-primary"
              target="_blank"
              rel="noopener noreferrer"
            >
              <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18" aria-hidden="true">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347" />
              </svg>
              Konsultasi via WhatsApp
            </a>
            <Link href="/jadwal/" className="btn26 btn26-ghost">
              Lihat Jadwal 2026 →
            </Link>
          </div>

          <div className="hero26-paths">
            <span className="hero26-paths-label">Saya mendaftar sebagai:</span>
            <div className="hero26-chips">
              <a href="#produk" className="chip26">
                Individu
              </a>
              <a
                href="https://wa.me/6287759151278?text=Halo%2C%20kami%20dari%20perusahaan%20ingin%20info%20pelatihan%20K3%20untuk%20karyawan%20%28in-house%20%2F%20grup%29"
                className="chip26"
                target="_blank"
                rel="noopener noreferrer"
              >
                Perusahaan
              </a>
              <Link href="/layanan-pemerintah" className="chip26 chip26-gov">
                Instansi Pemerintah →
              </Link>
            </div>
          </div>
        </div>

        <aside className="hero26-card" aria-label="Statistik Wahana Totalita">
          <p className="hero26-card-title">Kenapa Wahana Totalita?</p>
          <div className="hero26-stat">
            <span className="hero26-stat-num">
              120.000<span className="plus">+</span>
            </span>
            <span className="hero26-stat-label">Peserta Bersertifikasi</span>
          </div>
          <div className="hero26-stat-row">
            <div className="hero26-stat-sm">
              <span className="num">125+</span>
              <span className="lbl">Program Aktif</span>
            </div>
            <div className="hero26-stat-sm">
              <span className="num">2008</span>
              <span className="lbl">Berdiri Sejak</span>
            </div>
          </div>
          <div className="hero26-card-badges">
            <span>PJK3</span>
            <span>LPSE</span>
            <span>PADI UMKM</span>
          </div>
        </aside>
      </div>
    </section>
  );
}
