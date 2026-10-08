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
            <span>WhatsApp Konsultasi</span>
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
              <strong>Wahana Totalita Konsultan</strong>
            </span>
          </div>
          <p>
            Lembaga pelatihan &amp; sertifikasi K3 resmi berlisensi Kemnaker RI &amp; terakreditasi
            BNSP. Melayani public training di Yogyakarta dan in-house di seluruh Indonesia.
          </p>
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
          </div>
        </div>

        {/* Col 2: Program Populer */}
        <div className="footer-nav">
          <h4>Program Populer</h4>
          <ul>
            <li>
              <Link href="/ahli-k3-umum/">
                <strong>Ahli K3 Umum (AK3U)</strong>
              </Link>
            </li>
            <li>
              <Link href="/pelatihan/k3/">Pelatihan K3 Lengkap</Link>
            </li>
            <li>
              <Link href="/pelatihan/pelatihan-ahli-k3-umum-fresh-graduate-kemnaker-online/">
                Ahli K3 Umum Kemnaker
              </Link>
            </li>
            <li>
              <Link href="/pelatihan/ak3-bnsp/">Ahli K3 BNSP</Link>
            </li>
            <li>
              <Link href="/pelatihan/pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri/">
                Operator Forklift Kelas II
              </Link>
            </li>
            <li>
              <Link href="/pelatihan/pelatihan-damkar-paralel-kelas-dcba-sertifikasi-kemnaker-ri/">
                Damkar Kelas D–A
              </Link>
            </li>
            <li>
              <Link href="/pelatihan/pelatihan-petugas-p3k-first-aid-online/">
                Petugas P3K / First Aid
              </Link>
            </li>
            <li>
              <Link href="/pelatihan/pelatihan-internal-auditor-iso-45001-online/">
                Internal Auditor ISO 45001
              </Link>
            </li>
            <li>
              <Link href="/keselamatan-kerja/">Direktori 23 Bidang K3</Link>
            </li>
            <li>
              <Link href="/pelatihan/">Katalog Semua Program</Link>
            </li>
          </ul>
        </div>

        {/* Col 3: Layanan & Fitur */}
        <div className="footer-nav">
          <h4>Layanan &amp; Fitur</h4>
          <ul>
            <li>
              <Link href="/jadwal/">Jadwal Pelatihan 2026</Link>
            </li>
            <li>
              <Link href="/jadwal/kalender/">Kalender Pelatihan</Link>
            </li>
            <li>
              <Link href="/riksa-uji/">
                <strong>Jasa Riksa Uji K3 (Alat &amp; Instalasi)</strong>
              </Link>
            </li>
            <li>
              <Link href="/perpanjangan-skp/">
                <strong>Perpanjangan SKP &amp; Lisensi K3</strong>
              </Link>
            </li>
            <li>
              <Link href="/purnabakti/">
                <strong>Pelatihan Purnabakti (Masa Persiapan Pensiun)</strong>
              </Link>
            </li>
            <li>
              <Link href="/event-organizer/">
                <strong>Event Organizer BUMN &amp; HSE K3</strong>
              </Link>
            </li>
            <li>
              <Link href="/layanan-pemerintah/">Pengadaan LPSE &amp; B2G</Link>
            </li>
            <li>
              <Link href="/in-house-training/">In-House Training Perusahaan</Link>
            </li>
            <li>
              <Link href="/instruktur/">Tim Instruktur &amp; Tenaga Ahli</Link>
            </li>
            <li>
              <Link href="/klien/">Portofolio &amp; Klien Kami</Link>
            </li>
            <li>
              <Link href="/regulasi/">Pusat Regulasi K3 RI</Link>
            </li>
            <li>
              <Link href="/skkni/">Standar Profesi SKKNI</Link>
            </li>
            <li>
              <Link href="/tools/safety-talk">Safety Talk Generator</Link>
            </li>
            <li>
              <Link href="/verifikasi/">Verifikasi Keaslian Sertifikat</Link>
            </li>
            <li>
              <Link href="/artikel/">Artikel &amp; Panduan K3</Link>
            </li>
            <li>
              <Link href="/perusahaan">Tentang Wahana Totalita</Link>
            </li>
          </ul>
        </div>

        {/* Col 4: Wilayah Layanan & Kontak */}
        <div className="footer-contact">
          <h4>Wilayah Layanan &amp; Kontak</h4>
          <ul>
            <li>
              <Link href="/in-house-training/balikpapan-ikn/">In-House Balikpapan &amp; IKN</Link>
            </li>
            <li>
              <Link href="/in-house-training/cilegon-karawang/">In-House Cilegon &amp; Karawang</Link>
            </li>
            <li>
              <Link href="/in-house-training/morowali-weda-bay/">In-House Morowali &amp; Weda Bay</Link>
            </li>
            <li style={{ marginTop: '6px', fontSize: '12px', color: '#9DB8CE', lineHeight: 1.6 }}>
              <strong style={{ color: '#fff' }}>Jawa:</strong>{' '}
              <Link href="/pelatihan-k3-yogyakarta/">Jogja</Link> ·{' '}
              <Link href="/pelatihan-k3-jakarta/">Jakarta</Link> ·{' '}
              <Link href="/pelatihan-k3-surabaya/">Surabaya</Link> ·{' '}
              <Link href="/pelatihan-k3-bandung/">Bandung</Link> ·{' '}
              <Link href="/pelatihan-k3-semarang/">Semarang</Link> ·{' '}
              <Link href="/pelatihan-k3-solo/">Solo</Link> ·{' '}
              <Link href="/pelatihan-k3-cilegon/">Cilegon</Link> ·{' '}
              <Link href="/pelatihan-k3-bekasi/">Bekasi</Link> ·{' '}
              <Link href="/pelatihan-k3-malang/">Malang</Link>
            </li>
            <li style={{ marginTop: '4px', fontSize: '12px', color: '#9DB8CE', lineHeight: 1.6 }}>
              <strong style={{ color: '#fff' }}>Luar Jawa:</strong>{' '}
              <Link href="/pelatihan-k3-balikpapan/">Balikpapan</Link> ·{' '}
              <Link href="/pelatihan-k3-samarinda/">Samarinda</Link> ·{' '}
              <Link href="/pelatihan-k3-banjarmasin/">Banjarmasin</Link> ·{' '}
              <Link href="/pelatihan-k3-pontianak/">Pontianak</Link> ·{' '}
              <Link href="/pelatihan-k3-medan/">Medan</Link> ·{' '}
              <Link href="/pelatihan-k3-palembang/">Palembang</Link> ·{' '}
              <Link href="/pelatihan-k3-pekanbaru/">Pekanbaru</Link> ·{' '}
              <Link href="/pelatihan-k3-batam/">Batam</Link> ·{' '}
              <Link href="/pelatihan-k3-makassar/">Makassar</Link> ·{' '}
              <Link href="/pelatihan-k3-manado/">Manado</Link> ·{' '}
              <Link href="/pelatihan-k3-denpasar/">Bali</Link>
            </li>
            <li style={{ marginTop: '8px' }}>
              <Link href="/kota/" style={{ color: '#FFB74D', fontWeight: 700 }}>
                📍 Direktori 20 Kota Layanan &rarr;
              </Link>
            </li>
            <li style={{ marginTop: '6px' }}>
              <a href="https://wa.me/6287759151278" target="_blank" rel="noopener noreferrer">
                📱 WhatsApp: 6287759151278
              </a>
            </li>
            <li>📍 Yogyakarta, Indonesia</li>
          </ul>
        </div>
      </div>

      <div className="footer-bottom">
        <div className="container">
          <p>
            © 2026 Wahana Totalita Konsultan. All rights reserved. ·{' '}
            <Link href="/sitemap.xml" style={{ opacity: 0.6, textDecoration: 'none' }}>
              Sitemap
            </Link>{' '}
            ·{' '}
            <Link href="/sitemap-jadwal.xml" style={{ opacity: 0.6, textDecoration: 'none' }}>
              Sitemap Jadwal
            </Link>{' '}
            ·{' '}
            <Link href="/verifikasi/" style={{ opacity: 0.6, textDecoration: 'none' }}>
              Verifikasi Sertifikat
            </Link>{' '}
            ·{' '}
            <Link href="/kebijakan-privasi" style={{ opacity: 0.6, textDecoration: 'none' }}>
              Privasi
            </Link>{' '}
            ·{' '}
            <Link href="/zh/" style={{ opacity: 0.6, textDecoration: 'none' }}>
              中文 (ZH)
            </Link>
          </p>
        </div>
      </div>
    </footer>
  );
}
