import React from 'react';
import Link from 'next/link';

interface PhotoItem {
  src: string;
  alt: string;
  title: string;
}

const photos: PhotoItem[] = [
  {
    src: '/images/pelatihan-001.webp',
    alt: 'Pelatihan Ahli K3 Umum Sertifikasi Kemnaker RI',
    title: 'Pelatihan Ahli K3 Umum Sertifikasi Kemnaker RI',
  },
  {
    src: '/images/pelatihan-003.webp',
    alt: 'Praktik Kerja Lapangan Peserta Pelatihan K3 Industri',
    title: 'Praktik Kerja Lapangan Peserta Pelatihan K3 Industri',
  },
  {
    src: '/images/pelatihan-005.webp',
    alt: 'Uji Kompetensi & Sertifikasi BNSP K3 Wahana Totalita',
    title: 'Uji Kompetensi & Sertifikasi BNSP K3 Wahana Totalita',
  },
  {
    src: '/images/pelatihan-008.webp',
    alt: 'Simulasi Tanggap Darurat & Penanggulangan Kebakaran K3',
    title: 'Simulasi Tanggap Darurat & Penanggulangan Kebakaran K3',
  },
  {
    src: '/images/pelatihan-011.webp',
    alt: 'Pembinaan Calon Ahli K3 Umum Resmi Kemnaker RI',
    title: 'Pembinaan Calon Ahli K3 Umum Resmi Kemnaker RI',
  },
  {
    src: '/images/pelatihan-014.webp',
    alt: 'Sesi Evaluasi & Ujian Sertifikasi K3 Kemnaker',
    title: 'Sesi Evaluasi & Ujian Sertifikasi K3 Kemnaker',
  },
  {
    src: '/images/pelatihan-017.webp',
    alt: 'Pelatihan K3 Bekerja di Ketinggian & Ruang Terbatas',
    title: 'Pelatihan K3 Bekerja di Ketinggian & Ruang Terbatas',
  },
  {
    src: '/images/pelatihan-020.webp',
    alt: 'Pemeriksaan Alat Keselamatan Kerja & Audit CSMS',
    title: 'Pemeriksaan Alat Keselamatan Kerja & Audit CSMS',
  },
  {
    src: '/images/pelatihan-024.webp',
    alt: 'In-House Training Pelatihan K3 Korporasi Nasional',
    title: 'In-House Training Pelatihan K3 Korporasi Nasional',
  },
  {
    src: '/images/pelatihan-028.webp',
    alt: 'Pemberian Lisensi & Surat Keputusan Penunjukan Ahli K3',
    title: 'Pemberian Lisensi & Surat Keputusan Penunjukan Ahli K3',
  },
  {
    src: '/images/pelatihan-032.webp',
    alt: 'Pelatihan Sertifikasi POPAL & Lingkungan Hidup BNSP',
    title: 'Pelatihan Sertifikasi POPAL & Lingkungan Hidup BNSP',
  },
  {
    src: '/images/pelatihan-036.webp',
    alt: 'Praktik Inspeksi K3 & Identifikasi Bahaya Lapangan',
    title: 'Praktik Inspeksi K3 & Identifikasi Bahaya Lapangan',
  },
  {
    src: '/images/pelatihan-041.webp',
    alt: 'Pelatihan Auditor SMK3 PP 50 Tahun 2012 Kemnaker RI',
    title: 'Pelatihan Auditor SMK3 PP 50 Tahun 2012 Kemnaker RI',
  },
  {
    src: '/images/pelatihan-045.webp',
    alt: 'Kegiatan Pembinaan Keselamatan dan Kesehatan Kerja K3',
    title: 'Kegiatan Pembinaan Keselamatan dan Kesehatan Kerja K3',
  },
  {
    src: '/images/pelatihan-050.webp',
    alt: 'Dokumentasi Kelulusan Calon Ahli K3 Umum Wahana Totalita',
    title: 'Dokumentasi Kelulusan Calon Ahli K3 Umum Wahana Totalita',
  },
  {
    src: '/images/pelatihan-055.webp',
    alt: 'Pelatihan K3 Listrik & Teknisi K3 Industri Kemnaker',
    title: 'Pelatihan K3 Listrik & Teknisi K3 Industri Kemnaker',
  },
  {
    src: '/images/pelatihan-060.webp',
    alt: 'Workshop Contractor Safety Management System CSMS',
    title: 'Workshop Contractor Safety Management System CSMS',
  },
  {
    src: '/images/pelatihan-064.webp',
    alt: 'Sertifikasi Petugas P3K & K3 Lingkungan Kerja Kemnaker RI',
    title: 'Sertifikasi Petugas P3K & K3 Lingkungan Kerja Kemnaker RI',
  },
];

export default function PhotoStrip() {
  return (
    <section
      className="footer-photo-strip"
      aria-label="Dokumentasi Pelatihan K3 Wahana Totalita"
    >
      <div className="footer-photo-track">
        <div className="footer-photo-group">
          {photos.map((item, idx) => (
            <Link
              key={idx}
              href="/galeri/"
              className="footer-photo-item"
              title={item.title}
            >
              <img
                src={item.src}
                alt={item.alt}
                width={220}
                height={135}
                loading="lazy"
                decoding="async"
              />
            </Link>
          ))}
        </div>
        <div className="footer-photo-group" aria-hidden="true">
          {photos.map((item, idx) => (
            <Link
              key={`dup-${idx}`}
              href="/galeri/"
              className="footer-photo-item"
              tabIndex={-1}
            >
              <img
                src={item.src}
                alt={item.alt}
                width={220}
                height={135}
                loading="lazy"
                decoding="async"
              />
            </Link>
          ))}
        </div>
      </div>
    </section>
  );
}
