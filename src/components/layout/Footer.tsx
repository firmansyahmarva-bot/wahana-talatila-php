import React from 'react';
import Link from 'next/link';

export default function Footer() {
  return (
    <footer className="footer">
      {/* Quick Contact Strip */}
      <div className="footer-contact-strip">
        <div className="container fcs-inner">
          <a href="mailto:info@wahanatotalita.com" className="fcs-btn">
            <svg
              width="15"
              height="15"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              strokeWidth="2"
            >
              <rect width="20" height="16" x="2" y="4" rx="2" />
              <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
            </svg>
            <span>info@wahanatotalita.com</span>
          </a>
          <a href="tel:+628122969435" className="fcs-btn">
            <svg
              width="15"
              height="15"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              strokeWidth="2"
            >
              <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
            </svg>
            <span>+62 812-2969-435</span>
          </a>
          <a
            href="https://wa.me/6287759151278?text=Halo%20Wahana%20Totalita%2C%20saya%20ingin%20konsultasi%20program%20pelatihan"
            className="fcs-btn fcs-wa"
            target="_blank"
            rel="noopener noreferrer"
          >
            <svg viewBox="0 0 24 24" fill="currentColor" width="15" height="15">
              <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347" />
            </svg>
            <span>WhatsApp Konsultasi Cepat (Online)</span>
          </a>
        </div>
      </div>

      <div className="container footer-inner">
        {/* Col 1: Brand & Accreditation */}
        <div className="footer-brand">
          <div className="footer-logo">
            <img
              src="/assets/img/logo-wt.png"
              alt="Wahana Totalita Konsultan"
              className="nav-logo-img"
              width={44}
              height={44}
              decoding="async"
              style={{ height: '44px', width: 'auto', display: 'block', borderRadius: '8px' }}
            />
            <span>
              <strong>Wahana Totalita</strong>
            </span>
          </div>
          <p>
            Lembaga Pembinaan &amp; Sertifikasi K3 Resmi Berlisensi Kemnaker RI &amp; BNSP. 
            Melayani Public Training di Yogyakarta &amp; 20 kota besar serta In-House Training Perusahaan di seluruh Indonesia.
          </p>

          <div style={{ display: 'flex', flexDirection: 'column', gap: '6px', marginBottom: '18px' }}>
            <span style={{ fontSize: '12px', color: '#6EE7B7', fontWeight: 600 }}>
              ✔ PJK3 Resmi Kemnaker RI
            </span>
            <span style={{ fontSize: '12px', color: '#6EE7B7', fontWeight: 600 }}>
              ✔ Terakreditasi BNSP &amp; ISO 9001
            </span>
            <span style={{ fontSize: '12px', color: '#6EE7B7', fontWeight: 600 }}>
              ✔ Ribuan Alumni &amp; 500+ Perusahaan Mitra
            </span>
          </div>

          <div className="footer-socials">
            <a
              href="https://instagram.com/wahanatotalita.id"
              target="_blank"
              rel="noopener noreferrer"
              aria-label="Instagram"
            >
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                <rect x="2" y="2" width="20" height="20" rx="5" />
                <circle cx="12" cy="12" r="4" />
                <circle cx="17.5" cy="6.5" r=".5" fill="currentColor" stroke="none" />
              </svg>
            </a>
            <a
              href="https://wa.me/6287759151278"
              target="_blank"
              rel="noopener noreferrer"
              aria-label="WhatsApp"
            >
              <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347" />
              </svg>
            </a>
          </div>
        </div>

        {/* Col 2: Program Populer Kemnaker & BNSP */}
        <div className="footer-nav">
          <h4>Program Sertifikasi</h4>
          <ul>
            <li>
              <Link href="/ahli-k3-umum/">
                <strong>Ahli K3 Umum (Kemnaker)</strong>
              </Link>
            </li>
            <li>
              <Link href="/pelatihan/ak3-bnsp/">
                <strong>Ahli K3 Muda &amp; Madya BNSP</strong>
              </Link>
            </li>
            <li>
              <Link href="/pelatihan/pelatihan-internal-auditor-smk3-pp-50-2012-online/">
                Auditor SMK3 PP 50/2012
              </Link>
            </li>
            <li>
              <Link href="/pelatihan/pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri/">
                Operator Forklift Kelas II
              </Link>
            </li>
            <li>
              <Link href="/pelatihan/pelatihan-damkar-paralel-kelas-dcba-sertifikasi-kemnaker-ri/">
                Petugas Damkar (Kelas D, C, B, A)
              </Link>
            </li>
            <li>
              <Link href="/pelatihan/pelatihan-petugas-p3k-first-aid-online/">
                Petugas P3K di Tempat Kerja
              </Link>
            </li>
            <li>
              <Link href="/pelatihan/pelatihan-k3-bekerja-di-ketinggian-tkbt-tkpk-kemnaker-ri/">
                K3 Ketinggian (TKBT &amp; TKPK)
              </Link>
            </li>
            <li>
              <Link href="/pelatihan/pelatihan-pengawas-operasional-pertama-pop-minerba-bnsp/">
                POP Pertambangan Minerba
              </Link>
            </li>
            <li>
              <Link href="/pelatihan/pelatihan-internal-auditor-iso-45001-online/">
                Internal Auditor ISO 45001
              </Link>
            </li>
            <li>
              <Link href="/keselamatan-kerja/" style={{ color: '#F06A25', fontWeight: 600 }}>
                Lihat Semua 23 Sektor K3 &rarr;
              </Link>
            </li>
          </ul>
        </div>

        {/* Col 3: Layanan B2B & Fitur Gratis */}
        <div className="footer-nav">
          <h4>Layanan &amp; Platform</h4>
          <ul>
            <li>
              <Link href="/jadwal/">
                <strong>Jadwal Pelatihan 2026</strong>
              </Link>
            </li>
            <li>
              <Link href="/in-house-training/">
                <strong>In-House Training Perusahaan</strong>
              </Link>
            </li>
            <li>
              <Link href="/riksa-uji/">Riksa Uji K3 Alat &amp; Instalasi</Link>
            </li>
            <li>
              <Link href="/perpanjangan-skp/">Perpanjangan SKP &amp; Lisensi K3</Link>
            </li>
            <li>
              <Link href="/layanan-pemerintah/">Pengadaan LPSE &amp; B2G</Link>
            </li>
            <li>
              <Link href="/tools/safety-talk">Safety Talk Generator Gratis</Link>
            </li>
            <li>
              <Link href="/tools/">Kalkulator &amp; Risk Matrix K3</Link>
            </li>
            <li>
              <Link href="/verifikasi/">Verifikasi Keaslian Sertifikat</Link>
            </li>
            <li>
              <Link href="/artikel/">Artikel, Regulasi &amp; UU K3</Link>
            </li>
            <li>
              <Link href="/klien/">Daftar Klien &amp; Testimoni BUMN</Link>
            </li>
          </ul>
        </div>

        {/* Col 4: Wilayah Layanan & Kantor */}
        <div className="footer-contact">
          <h4>Wilayah &amp; Kantor</h4>
          <ul>
            <li>
              <strong style={{ color: '#FFFFFF' }}>Kantor Pusat Training:</strong>
              <br />
              <span style={{ fontSize: '12.5px', color: '#9DB8CE' }}>
                Yogyakarta (Training Center &amp; Praktik Lapangan)
              </span>
            </li>
            <li style={{ marginTop: '6px' }}>
              <Link href="/in-house-training/balikpapan-ikn/">In-House Balikpapan &amp; IKN</Link>
            </li>
            <li>
              <Link href="/in-house-training/cilegon-karawang/">In-House Cilegon &amp; Karawang</Link>
            </li>
            <li>
              <Link href="/in-house-training/morowali-weda-bay/">In-House Morowali &amp; Weda Bay</Link>
            </li>
            <li style={{ marginTop: '6px', fontSize: '12px', color: '#9DB8CE', lineHeight: 1.6 }}>
              <strong style={{ color: '#fff' }}>Kota Pelatihan:</strong>{' '}
              <Link href="/pelatihan-k3-yogyakarta/">Jogja</Link> ·{' '}
              <Link href="/pelatihan-k3-jakarta/">Jakarta</Link> ·{' '}
              <Link href="/pelatihan-k3-surabaya/">Surabaya</Link> ·{' '}
              <Link href="/pelatihan-k3-bandung/">Bandung</Link> ·{' '}
              <Link href="/pelatihan-k3-semarang/">Semarang</Link> ·{' '}
              <Link href="/pelatihan-k3-cilegon/">Cilegon</Link> ·{' '}
              <Link href="/pelatihan-k3-balikpapan/">Balikpapan</Link> ·{' '}
              <Link href="/pelatihan-k3-medan/">Medan</Link>
            </li>
            <li style={{ marginTop: '8px' }}>
              <Link href="/kota/" style={{ color: '#F06A25', fontWeight: 700 }}>
                📍 Direktori Lengkap 20 Kota &rarr;
              </Link>
            </li>
            <li style={{ marginTop: '8px' }}>
              <a
                href="https://wa.me/6287759151278"
                target="_blank"
                rel="noopener noreferrer"
                style={{ color: '#25D366', fontWeight: 700 }}
              >
                📱 WhatsApp: 0877-5915-1278
              </a>
            </li>
          </ul>
        </div>
      </div>

      <div className="footer-bottom">
        <div className="container">
          <p>
            © 2026 Wahana Totalita Konsultan. All rights reserved. ·{' '}
            <Link href="/sitemap.xml" style={{ opacity: 0.75, textDecoration: 'none' }}>
              Sitemap
            </Link>{' '}
            ·{' '}
            <Link href="/sitemap-jadwal.xml" style={{ opacity: 0.75, textDecoration: 'none' }}>
              Sitemap Jadwal
            </Link>{' '}
            ·{' '}
            <Link href="/verifikasi/" style={{ opacity: 0.75, textDecoration: 'none' }}>
              Verifikasi Sertifikat
            </Link>{' '}
            ·{' '}
            <Link href="/kebijakan-privasi" style={{ opacity: 0.75, textDecoration: 'none' }}>
              Kebijakan Privasi
            </Link>{' '}
            ·{' '}
            <Link href="/perusahaan" style={{ opacity: 0.75, textDecoration: 'none' }}>
              Legalitas PJK3
            </Link>
          </p>
        </div>
      </div>
    </footer>
  );
}

