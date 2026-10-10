import React from 'react';
import { Award, Users, BookOpen, Layers } from 'lucide-react';

export default function StatsBar() {
  const stats = [
    {
      num: '120.000+',
      label: 'Peserta Bersertifikasi',
      desc: 'Alumni tersebar di seluruh Indonesia',
      icon: Users,
    },
    {
      num: '125+',
      label: 'Program Pelatihan',
      desc: 'Kemnaker RI, BNSP, & ISO 9001',
      icon: BookOpen,
    },
    {
      num: 'PJK3 Resmi',
      label: 'Lisensi Kemnaker RI',
      desc: 'SKP & Lisensi Operasional Sah',
      icon: Award,
    },
    {
      num: '23 Sektor',
      label: 'Bidang Keahlian K3',
      desc: 'Konstruksi, Migas, Tambang, RS & Kimia',
      icon: Layers,
    },
  ];

  return (
    <section className="bg-white border-b border-slate-200/80 py-8 md:py-10">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
          {stats.map((s, idx) => {
            const Icon = s.icon;
            return (
              <div
                key={idx}
                className="flex items-start gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-100 hover:border-slate-200 hover:bg-slate-100/60 transition-colors"
              >
                <div className="p-3 rounded-xl bg-[#103A5C]/10 text-[#103A5C] shrink-0">
                  <Icon className="w-5 h-5 sm:w-6 sm:h-6" />
                </div>
                <div>
                  <div className="font-display font-extrabold text-xl sm:text-2xl text-[#103A5C] tracking-tight">
                    {s.num}
                  </div>
                  <div className="font-semibold text-xs sm:text-sm text-slate-800 mt-0.5">
                    {s.label}
                  </div>
                  <div className="text-[11px] sm:text-xs text-slate-500 mt-0.5">
                    {s.desc}
                  </div>
                </div>
              </div>
            );
          })}
        </div>
      </div>
    </section>
  );
}
