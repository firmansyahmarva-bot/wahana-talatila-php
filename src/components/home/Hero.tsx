import React from 'react';
import Link from 'next/link';
import { MessageCircle, Calendar, ArrowRight, ShieldCheck, Users, Building, Award } from 'lucide-react';

export default function Hero() {
  return (
    <section className="relative overflow-hidden bg-gradient-to-br from-[#16486E] via-[#103A5C] to-[#0B2C46] text-white pt-28 pb-16 md:pt-36 md:pb-24 border-b border-white/10">
      {/* Background Micro Mesh */}
      <div 
        className="absolute inset-0 pointer-events-none opacity-40 bg-[radial-gradient(rgba(255,255,255,0.14)_1px,transparent_1px)] [background-size:24px_24px]"
        aria-hidden="true" 
      />

      {/* Radiant Glow Blobs */}
      <div 
        className="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-[#F06A25]/15 blur-3xl rounded-full pointer-events-none"
        aria-hidden="true"
      />

      <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
          
          {/* Left Column: Core Value Proposition & CTAs */}
          <div className="lg:col-span-7 flex flex-col items-start">
            {/* Trust Pill */}
            <div className="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-white/10 backdrop-blur-md border border-white/20 text-white mb-6 shadow-sm">
              <span className="w-2 h-2 rounded-full bg-[#10B981] animate-pulse" />
              PJK3 Kemnaker RI · BNSP · Vendor Resmi LPSE
            </div>

            {/* Main Headline */}
            <h1 className="text-3xl sm:text-5xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight font-display mb-6">
              Pelatihan &amp; Sertifikasi K3 Resmi{' '}
              <span className="text-[#FF8A3D] block mt-1">Kemnaker RI &amp; BNSP</span>
            </h1>

            {/* Subtitle */}
            <p className="text-base sm:text-lg text-slate-200 max-w-2xl leading-relaxed font-sans mb-8">
              Pusat pembinaan keselamatan kerja (K3), sertifikasi operator, lingkungan industri &amp; ISO terpercaya sejak 2008. Kelas tatap muka di Yogyakarta &amp; 20 kota, online interaktif, dan in-house perusahaan.
            </p>

            {/* Action Buttons */}
            <div className="flex flex-wrap items-center gap-4 w-full sm:w-auto mb-8">
              <a
                href="https://wa.me/6287759151278?text=Halo%20Wahana%20Totalita%2C%20saya%20ingin%20konsultasi%20program%20pelatihan%20K3"
                target="_blank"
                rel="noopener noreferrer"
                className="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-6 py-4 rounded-xl font-bold text-sm bg-gradient-to-r from-[#25D366] to-[#128C7E] text-white shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all cursor-pointer"
              >
                <MessageCircle className="w-5 h-5" />
                <span>Konsultasi WhatsApp</span>
              </a>

              <Link
                href="/jadwal/"
                className="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-4 rounded-xl font-bold text-sm bg-white/10 hover:bg-white/20 text-white border border-white/20 backdrop-blur-md transition-all"
              >
                <Calendar className="w-4 h-4" />
                <span>Lihat Jadwal 2026</span>
                <ArrowRight className="w-4 h-4 ml-1" />
              </Link>
            </div>

            {/* Quick Segment Selector */}
            <div className="flex items-center gap-2 sm:gap-3 flex-wrap text-xs text-slate-300">
              <span className="font-semibold text-white">Pilihan Peserta:</span>
              <a
                href="/pelatihan/"
                className="px-3 py-1 rounded-lg bg-white/10 hover:bg-white/20 text-white border border-white/10 transition-colors"
              >
                👤 Individu / Mandiri
              </a>
              <a
                href="https://wa.me/6287759151278?text=Halo%2C%20perusahaan%20kami%20ingin%20penawaran%20in-house%20training%20K3"
                target="_blank"
                rel="noopener noreferrer"
                className="px-3 py-1 rounded-lg bg-white/10 hover:bg-white/20 text-white border border-white/10 transition-colors"
              >
                🏢 Perusahaan (In-House)
              </a>
              <Link
                href="/layanan-pemerintah/"
                className="px-3 py-1 rounded-lg bg-[#FF8A3D]/20 hover:bg-[#FF8A3D]/30 text-[#FF8A3D] border border-[#FF8A3D]/30 transition-colors font-medium"
              >
                🏛️ Pengadaan LPSE / B2G
              </Link>
            </div>
          </div>

          {/* Right Column: High-Trust Floating App Card */}
          <div className="lg:col-span-5">
            <div className="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-6 sm:p-8 shadow-2xl text-white">
              <div className="flex items-center justify-between border-b border-white/10 pb-4 mb-6">
                <span className="text-xs font-bold tracking-wider uppercase text-slate-300">
                  Track Record &amp; Kredibilitas
                </span>
                <span className="px-2.5 py-1 rounded-full text-[10px] font-bold bg-[#10B981] text-white">
                  Resmi Terverifikasi
                </span>
              </div>

              {/* Big Stat */}
              <div className="mb-6">
                <div className="text-4xl sm:text-5xl font-black font-display tracking-tight text-white">
                  120.000<span className="text-[#FF8A3D]">+</span>
                </div>
                <div className="text-sm text-slate-300 mt-1 font-medium">
                  Alumni Peserta Bersertifikasi Nasional
                </div>
              </div>

              {/* Secondary Stats Grid */}
              <div className="grid grid-cols-2 gap-4 pt-4 border-t border-white/10 mb-6">
                <div className="bg-white/5 rounded-2xl p-3.5 border border-white/10">
                  <div className="text-2xl font-bold text-white font-display">125+</div>
                  <div className="text-xs text-slate-300 mt-0.5">Program Pelatihan</div>
                </div>
                <div className="bg-white/5 rounded-2xl p-3.5 border border-white/10">
                  <div className="text-2xl font-bold text-white font-display">2008</div>
                  <div className="text-xs text-slate-300 mt-0.5">Melayani Sejak</div>
                </div>
              </div>

              {/* Trust Badges Bar */}
              <div className="flex items-center justify-between gap-2 text-xs font-semibold text-slate-200 pt-2">
                <span className="flex items-center gap-1.5">
                  <ShieldCheck className="w-4 h-4 text-[#FF8A3D]" /> PJK3 Kemnaker
                </span>
                <span className="flex items-center gap-1.5">
                  <Award className="w-4 h-4 text-[#FF8A3D]" /> Lisensi BNSP
                </span>
                <span className="flex items-center gap-1.5">
                  <Building className="w-4 h-4 text-[#FF8A3D]" /> LPSE B2G
                </span>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
  );
}
