import React from 'react';
import Link from 'next/link';
import { Calendar, ArrowRight, MapPin, Users, MessageCircle } from 'lucide-react';

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
    title: 'Pelatihan Ahli K3 Umum (AK3U) Sertifikasi BNSP',
    href: '/pelatihan/ak3-bnsp/',
    meta: 'Online Zoom · Sisa 8 Kursi',
    waUrl:
      'https://wa.me/6287759151278?text=Halo%2C%20saya%20ingin%20daftar%20PELATIHAN%20AHLI%20K3%20UMUM%20%28AK3U%29%20BNSP',
  },
  {
    date: '11-22 Okt 2026',
    title: 'Pelatihan Ahli K3 Umum Sertifikasi KEMNAKER RI',
    href: '/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri/',
    meta: 'Blended / Online · Sisa 5 Kursi',
    waUrl:
      'https://wa.me/6287759151278?text=Halo%2C%20saya%20ingin%20daftar%20Pelatihan%20Ahli%20K3%20Umum%20KEMNAKER%20RI',
  },
  {
    date: '14-17 Okt 2026',
    title: 'Penanggung Jawab Pengolahan Air Limbah (POPAL) BNSP',
    href: '/pelatihan/pelatihan-penanggung-jawab-operasional-pengolahan-air-limbah-popal-sertifikasi-bnsp/',
    meta: 'Online Interactive · Kuota Terbatas',
    waUrl:
      'https://wa.me/6287759151278?text=Halo%2C%20saya%20ingin%20daftar%20Pelatihan%20POPAL%20BNSP',
  },
  {
    date: '16-19 Okt 2026',
    title: 'Ahli Utama Bekerja di Ruang Terbatas (Confined Space) BNSP',
    href: '/pelatihan/pelatihan-ahli-utama-ruang-terbatas-sertifikasi-bnsp/',
    meta: 'Online & Praktik · Sisa 6 Kursi',
    waUrl:
      'https://wa.me/6287759151278?text=Halo%2C%20saya%20ingin%20daftar%20Pelatihan%20Ruang%20Terbatas%20BNSP',
  },
];

export default function ScheduleStrip() {
  return (
    <section className="py-12 bg-slate-50 border-b border-slate-200/80" aria-labelledby="jt-heading">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {/* Section Heading Bar */}
        <div className="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
          <div>
            <div className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#F06A25]/15 text-[#C2410C] border border-[#F06A25]/30 mb-2">
              <Calendar className="w-3.5 h-3.5" />
              Batch Terdekat 2026
            </div>
            <h2 id="jt-heading" className="font-display font-extrabold text-2xl sm:text-3xl text-slate-900 tracking-tight">
              Jadwal Pelatihan Siap Daftar
            </h2>
          </div>

          <Link
            href="/jadwal/"
            className="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold text-[#103A5C] bg-white border border-slate-200 hover:border-[#103A5C] shadow-sm hover:shadow transition-all"
          >
            <span>Semua 40+ Jadwal Batch</span>
            <ArrowRight className="w-4 h-4" />
          </Link>
        </div>

        {/* Schedule Cards Grid */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
          {schedules.map((item, idx) => (
            <div
              key={idx}
              className="group flex flex-col justify-between p-5 rounded-2xl bg-white border border-slate-200 shadow-sm hover:shadow-lg hover:border-slate-300 hover:-translate-y-1 transition-all duration-200"
            >
              <div>
                {/* Date Badge */}
                <div className="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-bold bg-[#E8F0F7] text-[#103A5C] mb-3">
                  <Calendar className="w-3.5 h-3.5 text-[#103A5C]" />
                  {item.date}
                </div>

                {/* Title */}
                <h3 className="font-display font-bold text-sm text-slate-900 group-hover:text-[#103A5C] transition-colors leading-snug line-clamp-2 mb-3">
                  <Link href={item.href}>{item.title}</Link>
                </h3>

                {/* Meta details */}
                <div className="text-xs text-slate-500 font-medium mb-4">
                  {item.meta}
                </div>
              </div>

              {/* Action Buttons */}
              <div className="pt-3 border-t border-slate-100 flex items-center justify-between gap-2 mt-auto">
                <Link
                  href={item.href}
                  className="text-xs font-bold text-[#103A5C] hover:text-[#0B2C46] transition-colors"
                >
                  Detail &rarr;
                </Link>

                <a
                  href={item.waUrl}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-[#25D366] hover:bg-[#20ba5a] text-white shadow-sm transition-all"
                >
                  <MessageCircle className="w-3.5 h-3.5" />
                  Daftar
                </a>
              </div>
            </div>
          ))}
        </div>

      </div>
    </section>
  );
}
