import React from 'react';
import { CheckCircle2, FileSearch, MessageCircle, GraduationCap, Award } from 'lucide-react';

const steps = [
  {
    step: '01',
    icon: FileSearch,
    title: 'Pilih Program Pelatihan',
    desc: 'Telusuri katalog 40+ program sertifikasi K3, Lingkungan, Mining, dan ISO. Filter berdasarkan kebutuhan dan format pelaksanaan.',
  },
  {
    step: '02',
    icon: MessageCircle,
    title: 'Konsultasi & Konfirmasi',
    desc: 'Hubungi tim admin via WhatsApp untuk mendapatkan silabus resmi, rincian biaya, jadwal batch terdekat, dan form pendaftaran.',
  },
  {
    step: '03',
    icon: GraduationCap,
    title: 'Ikuti Pembinaan & Evaluasi',
    desc: 'Ikuti sesi pelatihan intensif (online Zoom atau tatap muka di Yogyakarta) dibimbing praktisi senior, simulasi studi kasus, dan ujian kompetensi.',
  },
  {
    step: '04',
    icon: Award,
    title: 'Terbit Sertifikat Resmi',
    desc: 'Setelah dinyatakan kompeten, sertifikat resmi Kemnaker RI / BNSP diterbitkan dengan QR code verifikasi dan dikirim langsung ke alamat Anda.',
  },
];

export default function HowItWorks() {
  return (
    <section className="py-16 md:py-24 bg-slate-50 border-b border-slate-200/80">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {/* Section Header */}
        <div className="text-center max-w-3xl mx-auto mb-16">
          <div className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#E8F0F7] text-[#103A5C] mb-3">
            <CheckCircle2 className="w-3.5 h-3.5" />
            Alur Pendaftaran Mudah
          </div>
          <h2 className="font-display font-extrabold text-3xl sm:text-4xl text-slate-900 tracking-tight mb-4">
            Cara Daftar Pelatihan &amp; Sertifikasi
          </h2>
          <p className="text-base text-slate-600 leading-relaxed font-sans">
            Proses cepat, transparan, dan tanpa birokrasi rumit untuk profesional individu maupun delegasi perusahaan.
          </p>
        </div>

        {/* Steps Grid */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          {steps.map((s, idx) => {
            const Icon = s.icon;
            return (
              <div
                key={idx}
                className="relative flex flex-col p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:shadow-md transition-shadow"
              >
                {/* Step Pill */}
                <div className="flex items-center justify-between mb-6">
                  <div className="w-10 h-10 rounded-xl bg-[#E8F0F7] text-[#103A5C] flex items-center justify-center">
                    <Icon className="w-5 h-5" />
                  </div>
                  <span className="font-display font-extrabold text-xs px-2.5 py-1 rounded-md bg-slate-100 text-slate-600">
                    Langkah {s.step}
                  </span>
                </div>

                <h3 className="font-display font-bold text-base text-slate-900 mb-2 leading-snug">
                  {s.title}
                </h3>
                <p className="text-xs sm:text-sm text-slate-500 leading-relaxed">
                  {s.desc}
                </p>
              </div>
            );
          })}
        </div>

      </div>
    </section>
  );
}
