import React from 'react';
import Link from 'next/link';
import { ShieldCheck, Trees, Settings, Pickaxe, ArrowRight } from 'lucide-react';
import SectionHeader from '@/components/ui/SectionHeader';
import Card, { CardBody, CardFooter } from '@/components/ui/Card';
import Badge from '@/components/ui/Badge';

interface ServiceItem {
  href: string;
  icon: typeof ShieldCheck;
  title: string;
  desc: string;
  count: string;
  tag: string;
}

const services: ServiceItem[] = [
  {
    href: '/keselamatan-kerja/',
    icon: ShieldCheck,
    title: 'Keselamatan & Kesehatan Kerja (K3)',
    desc: 'Program sertifikasi KEMNAKER RI & BNSP: Ahli K3 Umum, K3 Konstruksi, Listrik, Migas, dan Operator Alat Berat.',
    count: '86 Program',
    tag: 'Paling Populer',
  },
  {
    href: '/k3-lingkungan/',
    icon: Trees,
    title: 'Pengelolaan Lingkungan & Limbah',
    desc: 'Pelatihan AMDAL, POPAL (Pengolahan Air Limbah), PLB3 (Limbah B3), dan izin lingkungan industri bersertifikasi BNSP.',
    count: '16 Program',
    tag: 'BNSP Resmi',
  },
  {
    href: '/pelatihan-iso/',
    icon: Settings,
    title: 'System Management & ISO',
    desc: 'QHSE Awareness & Internal Auditor terintegrasi untuk standar internasional ISO 9001, ISO 14001, dan ISO 45001.',
    count: '22 Program',
    tag: 'Standar Global',
  },
  {
    href: '/k3-pertambangan/',
    icon: Pickaxe,
    title: 'K3 Pertambangan (Minerba)',
    desc: 'Pembinaan teknis Pengawas Operasional Pertambangan: sertifikasi resmi POP, POM, dan POU Minerba BNSP.',
    count: '22 Program',
    tag: 'Sertifikasi Tambang',
  },
];

export default function ServicesSection() {
  return (
    <section className="py-16 bg-white border-b border-slate-200/80" id="layanan">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {/* Section Header */}
        <SectionHeader
          badgeText="Direktori 4 Bidang Utama"
          title="Bidang Pelatihan & Sertifikasi Resmi"
          subtitle="Solusi peningkatan kompetensi SDM dan pemenuhan regulasi wajib KEMNAKER RI serta standar profesi BNSP di seluruh sektor industri."
          align="center"
        />

        {/* 4 Cards Grid */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          {services.map((item, idx) => {
            const Icon = item.icon;
            return (
              <Link key={idx} href={item.href} className="group block h-full">
                <Card hoverable className="h-full flex flex-col bg-slate-50 border-slate-200 hover:border-[#103A5C] hover:bg-white">
                  <CardBody className="p-6 flex flex-col justify-between">
                    <div>
                      {/* Top Badge & Icon */}
                      <div className="flex items-center justify-between mb-5">
                        <div className="p-3.5 rounded-xl bg-white border border-slate-200 group-hover:bg-[#103A5C] group-hover:border-[#103A5C] text-[#103A5C] group-hover:text-white shadow-sm transition-colors">
                          <Icon className="w-6 h-6" />
                        </div>
                        <Badge variant="brand" size="sm" className="group-hover:bg-[#F06A25] group-hover:text-white border-transparent">
                          {item.tag}
                        </Badge>
                      </div>

                      {/* Title & Count */}
                      <h3 className="font-display font-bold text-lg text-slate-900 group-hover:text-[#103A5C] transition-colors mb-2 leading-snug">
                        {item.title}
                      </h3>
                      <div className="text-xs font-bold text-[#F06A25] mb-3">
                        {item.count}
                      </div>

                      {/* Description */}
                      <p className="text-xs sm:text-sm text-slate-600 leading-relaxed font-sans mb-6">
                        {item.desc}
                      </p>
                    </div>
                  </CardBody>

                  {/* Footer Link */}
                  <CardFooter className="p-4 flex items-center justify-between text-xs font-bold text-[#103A5C] group-hover:text-[#F06A25] transition-colors mt-auto">
                    <span>Lihat Seluruh Program</span>
                    <ArrowRight className="w-4 h-4 group-hover:translate-x-1 transition-transform" />
                  </CardFooter>
                </Card>
              </Link>
            );
          })}
        </div>

      </div>
    </section>
  );
}
