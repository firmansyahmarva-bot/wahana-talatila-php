import React from 'react';
import { Star, Quote, Users, Building, Award } from 'lucide-react';

const testimonials = [
  {
    program: 'Ahli K3 Umum Kemnaker RI',
    quote:
      'Materi sangat terstruktur dan instruktur benar-benar berpengalaman dari lapangan. SKP dan lisensi terbit tepat waktu dan langsung diakui perusahaan manufaktur tempat saya bertugas.',
    initials: 'BS',
    name: 'Budi Santoso, S.T.',
    meta: 'HSE Coordinator · Industri Otomotif, Cikarang',
  },
  {
    program: 'POPAL Sertifikasi BNSP',
    quote:
      'Pelatihan interaktif via Zoom memudahkan saya yang bertugas di remote area. Bimbingan pra-asesmen BNSP sangat membantu sampai dinyatakan kompeten 100%.',
    initials: 'SR',
    name: 'Sari Rahmawati, S.Si.',
    meta: 'Environmental Supervisor · Sektor Energi, Riau',
  },
  {
    program: 'POP Minerba BNSP',
    quote:
      'Daftar mudah via WhatsApp, materi regulasi minerba sangat mendalam. Sertifikasi BNSP dari Wahana Totalita mempercepat promosi saya menjadi Pengawas Operasional.',
    initials: 'AF',
    name: 'Ahmad Fadli',
    meta: 'Mining Supervisor · Tambang Batubara, Kalimantan Timur',
  },
];

export default function SocialProof() {
  return (
    <section className="py-16 md:py-24 bg-gradient-to-br from-[#103A5C] via-[#0B2C46] to-[#071E30] text-white" aria-labelledby="sp-heading">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {/* Section Header */}
        <div className="text-center max-w-3xl mx-auto mb-16">
          <div className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-white/10 text-[#FF8A3D] border border-white/10 mb-3">
            <Star className="w-3.5 h-3.5 fill-[#FF8A3D]" />
            Testimoni &amp; Pengakuan Alumni
          </div>
          <h2 id="sp-heading" className="font-display font-extrabold text-3xl sm:text-4xl tracking-tight mb-4 text-white">
            Dipercaya Lebih Dari 120.000 Profesional
          </h2>
          <p className="text-base text-slate-300 leading-relaxed font-sans">
            Alumni Wahana Totalita tersebar di berbagai sektor industri strategis, BUMN, dan korporasi multinasional di seluruh penjuru Indonesia.
          </p>
        </div>

        {/* Testimonials Cards Grid */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
          {testimonials.map((t, idx) => (
            <article
              key={idx}
              className="flex flex-col justify-between p-6 sm:p-8 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md shadow-lg"
            >
              <div>
                {/* Program Tag */}
                <div className="inline-flex items-center gap-1.5 px-3 py-1 rounded-md text-xs font-bold bg-[#F06A25]/20 text-[#FF8A3D] border border-[#F06A25]/30 mb-6">
                  {t.program}
                </div>

                {/* Quote Text */}
                <blockquote className="text-sm text-slate-200 leading-relaxed italic mb-8 relative">
                  &ldquo;{t.quote}&rdquo;
                </blockquote>
              </div>

              {/* Author Footer */}
              <div className="flex items-center gap-3 pt-4 border-t border-white/10">
                <div className="w-10 h-10 rounded-full bg-[#E8F0F7] text-[#103A5C] font-extrabold flex items-center justify-center shrink-0 text-sm">
                  {t.initials}
                </div>
                <div>
                  <div className="font-display font-bold text-sm text-white leading-tight">
                    {t.name}
                  </div>
                  <div className="text-xs text-slate-400 mt-0.5">
                    {t.meta}
                  </div>
                </div>
              </div>
            </article>
          ))}
        </div>

        {/* Corporate Trust Strip */}
        <div className="pt-10 border-t border-white/10 text-center">
          <p className="text-xs font-bold uppercase tracking-widest text-slate-400 mb-6">
            Mendukung Kepatuhan K3 &amp; Keselamatan Kerja di Seluruh Indonesia
          </p>
          <div className="flex flex-wrap items-center justify-center gap-8 sm:gap-14 text-slate-300 font-bold text-xs sm:text-sm">
            <span className="flex items-center gap-2">
              <Award className="w-4 h-4 text-[#10B981]" />
              Terdaftar di TemanK3 Kemnaker
            </span>
            <span className="flex items-center gap-2">
              <Users className="w-4 h-4 text-[#10B981]" />
              Mitra Lembaga Sertifikasi Profesi BNSP
            </span>
            <span className="flex items-center gap-2">
              <Building className="w-4 h-4 text-[#10B981]" />
              Vendor Resmi LPSE &amp; PaDi UMKM
            </span>
          </div>
        </div>

      </div>
    </section>
  );
}
