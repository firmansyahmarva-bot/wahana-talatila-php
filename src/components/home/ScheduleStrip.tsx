import React from 'react';
import Link from 'next/link';
import { Calendar, ArrowRight, MessageCircle } from 'lucide-react';
import Button from '@/components/ui/Button';
import Badge from '@/components/ui/Badge';
import Card, { CardBody, CardFooter } from '@/components/ui/Card';

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
            <div className="mb-2">
              <Badge variant="accent" size="sm" icon={<Calendar className="w-3.5 h-3.5" />}>
                Batch Terdekat 2026
              </Badge>
            </div>
            <h2 id="jt-heading" className="font-display font-extrabold text-2xl sm:text-3xl text-slate-900 tracking-tight">
              Jadwal Pelatihan Siap Daftar
            </h2>
          </div>

          <Button
            href="/jadwal/"
            variant="secondary"
            size="sm"
            rightIcon={<ArrowRight className="w-4 h-4" />}
          >
            Semua 40+ Jadwal Batch
          </Button>
        </div>

        {/* Schedule Cards Grid */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
          {schedules.map((item, idx) => (
            <Card key={idx} hoverable className="flex flex-col justify-between h-full group">
              <CardBody className="p-5">
                {/* Date Badge */}
                <div className="mb-3">
                  <Badge variant="brand" size="sm" icon={<Calendar className="w-3.5 h-3.5" />}>
                    {item.date}
                  </Badge>
                </div>

                {/* Title */}
                <h3 className="font-display font-bold text-sm text-slate-900 group-hover:text-[#103A5C] transition-colors leading-snug line-clamp-2 mb-3">
                  <Link href={item.href}>{item.title}</Link>
                </h3>

                {/* Meta details */}
                <div className="text-xs text-slate-500 font-medium mb-4">
                  {item.meta}
                </div>
              </CardBody>

              {/* Action Buttons */}
              <CardFooter className="p-4 flex items-center justify-between gap-2 mt-auto">
                <Link
                  href={item.href}
                  className="text-xs font-bold text-[#103A5C] hover:text-[#0B2C46] transition-colors"
                >
                  Detail &rarr;
                </Link>

                <Button
                  href={item.waUrl}
                  isExternal
                  variant="accent"
                  size="sm"
                  leftIcon={<MessageCircle className="w-3.5 h-3.5" />}
                  className="bg-[#25D366] hover:bg-[#20ba5a] text-white"
                >
                  Daftar
                </Button>
              </CardFooter>
            </Card>
          ))}
        </div>

      </div>
    </section>
  );
}
