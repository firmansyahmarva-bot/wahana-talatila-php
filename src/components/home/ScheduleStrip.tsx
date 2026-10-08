import React from 'react';
import Link from 'next/link';

interface ScheduleItem {
  date: string;
  title: string;
  href: string;
  meta: string;
  waUrl: string;
}

const schedules: ScheduleItem[] = [
  {
    date: '7-9 Okt 2026',
    title: 'PELATIHAN AHLI K3 UMUM (AK3U)  BNSP - Oct 2026',
    href: '/pelatihan/ak3-bnsp/',
    meta: 'Online · Online · ✅ 30 kursi',
    waUrl:
      'https://wa.me/6287759151278?text=Halo%2C%20saya%20ingin%20daftar%20PELATIHAN%20AHLI%20K3%20UMUM%20%28AK3U%29%20%20BNSP%20-%20Oct%202026%20tanggal%207-9%20Okt%202026',
  },
  {
    date: '11-22 Okt 2026',
    title: 'Pelatihan Ahli K3 Umum | Sertifikasi KEMNAKER RI - Oct 2026',
    href: '/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri/',
    meta: 'Online · Online · ✅ 20 kursi',
    waUrl:
      'https://wa.me/6287759151278?text=Halo%2C%20saya%20ingin%20daftar%20Pelatihan%20Ahli%20K3%20Umum%20%7C%20Sertifikasi%20KEMNAKER%20RI%20-%20Oct%202026%20tanggal%2011-22%20Okt%202026',
  },
  {
    date: '14-17 Okt 2026',
    title:
      'Pelatihan Penanggung Jawab Operasional Pengolahan Air Limbah (POPAL) | Online - Oct 2026',
    href: '/pelatihan/pelatihan-penanggung-jawab-operasional-pengolahan-air-limbah-popal-sertifikasi-bnsp/',
    meta: 'Online · Online · ✅ 20 kursi',
    waUrl:
      'https://wa.me/6287759151278?text=Halo%2C%20saya%20ingin%20daftar%20Pelatihan%20Penanggung%20Jawab%20Operasional%20Pengolahan%20Air%20Limbah%20%28POPAL%29%20%7C%20Online%20-%20Oct%202026%20tanggal%2014-17%20Okt%202026',
  },
  {
    date: '16-19 Okt 2026',
    title: 'Pelatihan Ahli Utama Ruang Terbatas | Sertifikasi BNSP - Oct 2026',
    href: '/pelatihan/pelatihan-ahli-utama-ruang-terbatas-sertifikasi-bnsp/',
    meta: 'Online · Online · ✅ 20 kursi',
    waUrl:
      'https://wa.me/6287759151278?text=Halo%2C%20saya%20ingin%20daftar%20Pelatihan%20Ahli%20Utama%20Ruang%20Terbatas%20%7C%20Sertifikasi%20BNSP%20-%20Oct%202026%20tanggal%2016-19%20Okt%202026',
  },
];

export default function ScheduleStrip() {
  return (
    <section className="jadwal-strip" aria-labelledby="jt-heading">
      <div className="container">
        <div className="jadwal-strip-head">
          <div>
            <p className="section-eyebrow">Batch Berikutnya</p>
            <h2 className="section-title" id="jt-heading" style={{ margin: 0 }}>
              Jadwal Terdekat
            </h2>
          </div>
          <Link href="/jadwal/" className="all">
            Lihat semua jadwal →
          </Link>
        </div>
        <div className="jadwal-cards">
          {schedules.map((item, idx) => (
            <div
              key={idx}
              className="jcard"
              data-reveal="up"
              data-reveal-delay={String(idx + 1)}
            >
              <span className="jcard-date">{item.date}</span>
              <Link className="jcard-title" href={item.href}>
                {item.title}
              </Link>
              <span className="jcard-meta">{item.meta}</span>
              <a
                className="jcard-cta"
                href={item.waUrl}
                target="_blank"
                rel="noopener noreferrer"
              >
                Daftar Sekarang
              </a>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
