import React from 'react';
import { Award, ShieldCheck, CalendarCheck2, ArrowRight, MessageCircle } from 'lucide-react';

export default function AboutSection() {
  return (
    <section className="py-16 md:py-24 bg-white border-b border-slate-200/80" id="perusahaan">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
          
          {/* Left Column: Text & Credibility */}
          <div className="lg:col-span-7">
            <div className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#E8F0F7] text-[#103A5C] mb-3">
              <ShieldCheck className="w-3.5 h-3.5" />
              Tentang Wahana Totalita
            </div>
            
            <h2 className="font-display font-extrabold text-3xl sm:text-4xl text-slate-900 tracking-tight leading-tight mb-6">
              Mitra Terpercaya Sertifikasi K3 &amp; Konsultasi Lingkungan Industri
            </h2>

            <p className="text-base text-slate-600 leading-relaxed font-sans mb-6">
              Wahana Totalita Konsultan adalah Perusahaan Jasa Keselamatan dan Kesehatan Kerja (PJK3) resmi berlisensi Kemnaker RI, Lembaga Uji Kompetensi mitra BNSP, serta penyedia konsultasi perizinan lingkungan hidup sejak 2008.
            </p>

            <p className="text-base text-slate-600 leading-relaxed font-sans mb-8">
              Kami telah meluluskan lebih dari 120.000 alumni tersertifikasi yang berkarier di sektor pertambangan, minyak &amp; gas, manufaktur otomotif, konstruksi BUMN, energi, serta fasilitas kesehatan di seluruh Indonesia.
            </p>

            {/* Credential Badges */}
            <div className="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
              <div className="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                <div className="font-display font-extrabold text-lg text-[#103A5C]">
                  KEMNAKER RI
                </div>
                <div className="text-xs font-semibold text-slate-500 mt-1">
                  PJK3 Lisensi Resmi
                </div>
              </div>

              <div className="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                <div className="font-display font-extrabold text-lg text-[#F06A25]">
                  BNSP RI
                </div>
                <div className="text-xs font-semibold text-slate-500 mt-1">
                  Sertifikasi Profesi
                </div>
              </div>

              <div className="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                <div className="font-display font-extrabold text-lg text-[#103A5C]">
                  Sejak 2008
                </div>
                <div className="text-xs font-semibold text-slate-500 mt-1">
                  18+ Tahun Dedikasi
                </div>
              </div>
            </div>

            {/* CTAs */}
            <div className="flex flex-wrap items-center gap-4">
              <a
                href="https://wa.me/6287759151278?text=Halo%2C%20saya%20ingin%20konsultasi%20pelatihan%20dengan%20Wahana%20Totalita"
                target="_blank"
                rel="noopener noreferrer"
                className="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl text-sm font-bold bg-[#103A5C] hover:bg-[#0B2C46] text-white shadow-sm hover:shadow transition-all"
              >
                <MessageCircle className="w-4 h-4" />
                <span>Hubungi Konsultan Kami</span>
              </a>

              <a
                href="#produk"
                className="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl text-sm font-bold bg-slate-100 hover:bg-slate-200 text-slate-800 transition-colors"
              >
                <span>Lihat Katalog Program</span>
                <ArrowRight className="w-4 h-4" />
              </a>
            </div>
          </div>

          {/* Right Column: Visual Trust Card */}
          <div className="lg:col-span-5">
            <div className="p-8 rounded-3xl bg-gradient-to-br from-[#103A5C] to-[#0B2C46] text-white shadow-xl relative overflow-hidden">
              <div 
                className="absolute inset-0 opacity-10 bg-[radial-gradient(white_1px,transparent_1px)] [background-size:16px_16px]" 
                aria-hidden="true" 
              />
              <div className="relative">
                <div className="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center mb-6">
                  <Award className="w-6 h-6 text-[#FF8A3D]" />
                </div>
                <h3 className="font-display font-extrabold text-2xl mb-4 leading-snug">
                  Layanan B2B &amp; In-House Corporate Training
                </h3>
                <p className="text-slate-200 text-sm leading-relaxed mb-6">
                  Butuh sertifikasi K3 untuk tim kerja dalam jumlah besar di lokasi pabrik atau site operasional? Kami menyediakan solusi tailored in-house training dengan kurikulum spesifik risiko industri Anda.
                </p>
                <ul className="space-y-2.5 text-xs text-slate-200 mb-8">
                  <li className="flex items-center gap-2">
                    <span className="w-1.5 h-1.5 rounded-full bg-[#10B981]" />
                    <span>Instruktur bersertifikasi TOT &amp; praktisi senior</span>
                  </li>
                  <li className="flex items-center gap-2">
                    <span className="w-1.5 h-1.5 rounded-full bg-[#10B981]" />
                    <span>Jadwal &amp; silabus fleksibel sesuai shift kerja</span>
                  </li>
                  <li className="flex items-center gap-2">
                    <span className="w-1.5 h-1.5 rounded-full bg-[#10B981]" />
                    <span>Tersedia e-Faktur PPN resmi &amp; legalitas LPSE / PaDi UMKM</span>
                  </li>
                </ul>
                <a
                  href="/perusahaan/"
                  className="block text-center py-3 px-4 rounded-xl text-xs font-extrabold bg-[#F06A25] hover:bg-[#d95614] text-white shadow-md transition-all"
                >
                  Pelajari Layanan B2B Korporasi &rarr;
                </a>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
  );
}
