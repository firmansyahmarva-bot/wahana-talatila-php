'use client';

import React from 'react';
import Link from 'next/link';
import { usePathname } from 'next/navigation';
import { Home, Calendar, BookOpen, FileText } from 'lucide-react';

export default function MobileBottomNav() {
  const pathname = usePathname();

  const isHome = pathname === '/';
  const isJadwal = pathname.startsWith('/jadwal');
  const isPelatihan = pathname.startsWith('/pelatihan');
  const isArtikel = pathname.startsWith('/artikel');

  return (
    <nav
      className="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-slate-200/90 shadow-lg px-2 py-1.5 flex items-center justify-around"
      aria-label="Navigasi Bawah Mobile"
    >
      <Link
        href="/"
        className={`flex flex-col items-center gap-1 py-1 px-3 rounded-xl text-[10px] font-bold transition-colors ${
          isHome ? 'text-[#103A5C]' : 'text-slate-500 hover:text-slate-800'
        }`}
      >
        <Home className={`w-5 h-5 ${isHome ? 'text-[#103A5C]' : 'text-slate-400'}`} />
        <span>Beranda</span>
      </Link>

      <Link
        href="/jadwal/"
        className={`flex flex-col items-center gap-1 py-1 px-3 rounded-xl text-[10px] font-bold transition-colors ${
          isJadwal ? 'text-[#103A5C]' : 'text-slate-500 hover:text-slate-800'
        }`}
      >
        <Calendar className={`w-5 h-5 ${isJadwal ? 'text-[#103A5C]' : 'text-slate-400'}`} />
        <span>Jadwal</span>
      </Link>

      <Link
        href="/pelatihan/"
        className={`flex flex-col items-center gap-1 py-1 px-3 rounded-xl text-[10px] font-bold transition-colors ${
          isPelatihan ? 'text-[#103A5C]' : 'text-slate-500 hover:text-slate-800'
        }`}
      >
        <BookOpen className={`w-5 h-5 ${isPelatihan ? 'text-[#103A5C]' : 'text-slate-400'}`} />
        <span>Pelatihan</span>
      </Link>

      <Link
        href="/artikel/"
        className={`flex flex-col items-center gap-1 py-1 px-3 rounded-xl text-[10px] font-bold transition-colors ${
          isArtikel ? 'text-[#103A5C]' : 'text-slate-500 hover:text-slate-800'
        }`}
      >
        <FileText className={`w-5 h-5 ${isArtikel ? 'text-[#103A5C]' : 'text-slate-400'}`} />
        <span>Panduan</span>
      </Link>
    </nav>
  );
}
