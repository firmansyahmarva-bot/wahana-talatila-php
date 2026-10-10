'use client';

import React, { useState, useEffect } from 'react';
import Link from 'next/link';
import { usePathname } from 'next/navigation';
import {
  Search,
  Menu,
  X,
  ChevronDown,
  Phone,
  HardHat,
  Fuel,
  Zap,
  FlaskConical,
  Mountain,
  Pickaxe,
  Leaf,
  Hospital,
  Building2,
  FileCheck2,
  Award,
  Users,
  Briefcase,
  HelpCircle,
  FileText
} from 'lucide-react';

export default function Navbar() {
  const [isScrolled, setIsScrolled] = useState(false);
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
  const [openDropdown, setOpenDropdown] = useState<string | null>(null);
  const [searchQuery, setSearchQuery] = useState('');
  const pathname = usePathname();

  useEffect(() => {
    const handleScroll = () => {
      setIsScrolled(window.scrollY > 15);
    };
    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll();
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  // Close mobile menu on route change
  useEffect(() => {
    setMobileMenuOpen(false);
    setOpenDropdown(null);
  }, [pathname]);

  const toggleDropdown = (name: string) => {
    setOpenDropdown(openDropdown === name ? null : name);
  };

  return (
    <header
      className={`fixed top-0 left-0 right-0 z-50 transition-all duration-200 ${
        isScrolled
          ? 'bg-white/95 backdrop-blur-md shadow-sm border-b border-slate-200/80 py-3'
          : 'bg-[#103A5C] border-b border-white/10 py-3.5'
      }`}
    >
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between gap-4">
          
          {/* Brand Logo */}
          <Link
            href="/"
            className="flex items-center gap-3 shrink-0 group focus:outline-none"
            aria-label="Wahana Totalita Konsultan Beranda"
          >
            <img
              src="/assets/img/logo-wt.png"
              alt="Wahana Totalita Konsultan"
              className="h-10 w-auto rounded-lg shadow-xs group-hover:scale-105 transition-transform"
              width={40}
              height={40}
            />
            <div className="flex flex-col">
              <span
                className={`font-display font-extrabold text-base tracking-tight leading-none ${
                  isScrolled ? 'text-[#103A5C]' : 'text-white'
                }`}
              >
                Wahana Totalita
              </span>
              <span
                className={`text-[10px] font-semibold tracking-wider uppercase mt-1 ${
                  isScrolled ? 'text-slate-500' : 'text-slate-300'
                }`}
              >
                Konsultan K3 &amp; Sertifikasi
              </span>
            </div>
          </Link>

          {/* Desktop Search Bar */}
          <form
            action="/pelatihan/"
            method="get"
            className="hidden md:flex items-center relative max-w-[180px] lg:max-w-[220px] w-full shrink-0"
            role="search"
            onSubmit={(e) => {
              if (!searchQuery.trim()) e.preventDefault();
            }}
          >
            <Search
              className={`absolute left-3 w-4 h-4 pointer-events-none z-10 ${
                isScrolled ? 'text-slate-400' : 'text-slate-300'
              }`}
            />
            <input
              type="search"
              name="q"
              placeholder="Cari pelatihan..."
              aria-label="Cari pelatihan"
              value={searchQuery}
              onChange={(e) => setSearchQuery(e.target.value)}
              className={`w-full pl-9 pr-3 py-1.5 rounded-full text-xs font-medium focus:outline-none transition-all ${
                isScrolled
                  ? 'bg-slate-100 text-slate-900 placeholder-slate-400 focus:bg-white focus:ring-2 focus:ring-[#103A5C]/20 border border-slate-200'
                  : 'bg-white/10 text-white placeholder-slate-300 focus:bg-white/20 focus:ring-2 focus:ring-white/30 border border-white/20'
              }`}
            />
          </form>

          {/* Desktop Navigation Links */}
          <nav className="hidden lg:flex items-center gap-1 xl:gap-2 shrink-0">
            <Link
              href="/pelatihan/"
              className={`px-3 py-2 rounded-lg text-xs font-bold transition-colors ${
                isScrolled
                  ? 'text-slate-700 hover:text-[#103A5C] hover:bg-slate-100'
                  : 'text-slate-100 hover:text-white hover:bg-white/10'
              }`}
            >
              Semua Pelatihan
            </Link>

            <Link
              href="/ahli-k3-umum/"
              className={`px-3 py-2 rounded-lg text-xs font-bold transition-colors ${
                isScrolled
                  ? 'text-slate-700 hover:text-[#103A5C] hover:bg-slate-100'
                  : 'text-slate-100 hover:text-white hover:bg-white/10'
              }`}
            >
              Ahli K3 Umum
            </Link>

            <Link
              href="/jadwal/"
              className={`px-3 py-2 rounded-lg text-xs font-bold transition-colors ${
                isScrolled
                  ? 'text-slate-700 hover:text-[#103A5C] hover:bg-slate-100'
                  : 'text-slate-100 hover:text-white hover:bg-white/10'
              }`}
            >
              Jadwal 2026
            </Link>

            {/* Dropdown: Bidang & Wilayah */}
            <div className="relative group">
              <button
                type="button"
                className={`inline-flex items-center gap-1 px-3 py-2 rounded-lg text-xs font-bold cursor-pointer transition-colors ${
                  isScrolled
                    ? 'text-slate-700 group-hover:text-[#103A5C] group-hover:bg-slate-100'
                    : 'text-slate-100 group-hover:text-white group-hover:bg-white/10'
                }`}
              >
                <span>Bidang &amp; Kota</span>
                <ChevronDown className="w-3.5 h-3.5 group-hover:rotate-180 transition-transform" />
              </button>

              {/* Mega Dropdown Box */}
              <div className="absolute top-full right-0 mt-2 w-[540px] bg-white rounded-2xl shadow-2xl border border-slate-200 p-5 hidden group-hover:block transition-all animate-in fade-in duration-150">
                <div className="grid grid-cols-2 gap-6">
                  {/* Sektor Keahlian */}
                  <div>
                    <div className="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 mb-3 pb-2 border-b border-slate-100">
                      Sektor Keahlian K3
                    </div>
                    <div className="space-y-1">
                      <Link
                        href="/k3-konstruksi/"
                        className="flex items-center gap-2.5 p-2 rounded-xl hover:bg-slate-50 text-slate-800 hover:text-[#103A5C] transition-colors"
                      >
                        <HardHat className="w-4 h-4 text-[#F06A25] shrink-0" />
                        <div>
                          <div className="text-xs font-bold leading-tight">K3 Konstruksi</div>
                          <div className="text-[10px] text-slate-500">Gedung, sipil &amp; infrastruktur</div>
                        </div>
                      </Link>
                      <Link
                        href="/k3-migas/"
                        className="flex items-center gap-2.5 p-2 rounded-xl hover:bg-slate-50 text-slate-800 hover:text-[#103A5C] transition-colors"
                      >
                        <Fuel className="w-4 h-4 text-[#F06A25] shrink-0" />
                        <div>
                          <div className="text-xs font-bold leading-tight">K3 Migas</div>
                          <div className="text-[10px] text-slate-500">Hulu-hilir &amp; petrokimia</div>
                        </div>
                      </Link>
                      <Link
                        href="/k3-listrik/"
                        className="flex items-center gap-2.5 p-2 rounded-xl hover:bg-slate-50 text-slate-800 hover:text-[#103A5C] transition-colors"
                      >
                        <Zap className="w-4 h-4 text-[#F06A25] shrink-0" />
                        <div>
                          <div className="text-xs font-bold leading-tight">K3 Listrik &amp; Energi</div>
                          <div className="text-[10px] text-slate-500">Pembangkit &amp; instalasi</div>
                        </div>
                      </Link>
                      <Link
                        href="/k3-lingkungan/"
                        className="flex items-center gap-2.5 p-2 rounded-xl hover:bg-slate-50 text-slate-800 hover:text-[#103A5C] transition-colors"
                      >
                        <Leaf className="w-4 h-4 text-[#10B981] shrink-0" />
                        <div>
                          <div className="text-xs font-bold leading-tight">K3 Lingkungan &amp; AMDAL</div>
                          <div className="text-[10px] text-slate-500">POPAL, PLB3 &amp; limbah</div>
                        </div>
                      </Link>
                      <Link
                        href="/keselamatan-kerja/"
                        className="block pt-2 text-xs font-extrabold text-[#103A5C] hover:underline"
                      >
                        Lihat 23 Sektor Lengkap &rarr;
                      </Link>
                    </div>
                  </div>

                  {/* Kota Resmi */}
                  <div>
                    <div className="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 mb-3 pb-2 border-b border-slate-100">
                      Kota Pelatihan Tatap Muka
                    </div>
                    <div className="space-y-1">
                      <Link
                        href="/pelatihan-k3-yogyakarta/"
                        className="flex items-center gap-2.5 p-2 rounded-xl hover:bg-slate-50 text-slate-800 hover:text-[#103A5C] transition-colors"
                      >
                        <Building2 className="w-4 h-4 text-[#103A5C] shrink-0" />
                        <div>
                          <div className="text-xs font-bold leading-tight">Yogyakarta (Pusat)</div>
                          <div className="text-[10px] text-slate-500">Training Center resmi</div>
                        </div>
                      </Link>
                      <Link
                        href="/pelatihan-k3-jakarta/"
                        className="flex items-center gap-2.5 p-2 rounded-xl hover:bg-slate-50 text-slate-800 hover:text-[#103A5C] transition-colors"
                      >
                        <Building2 className="w-4 h-4 text-[#103A5C] shrink-0" />
                        <div>
                          <div className="text-xs font-bold leading-tight">Jakarta &amp; Jabodetabek</div>
                          <div className="text-[10px] text-slate-500">Kelas rutin bulanan</div>
                        </div>
                      </Link>
                      <Link
                        href="/pelatihan-k3-surabaya/"
                        className="flex items-center gap-2.5 p-2 rounded-xl hover:bg-slate-50 text-slate-800 hover:text-[#103A5C] transition-colors"
                      >
                        <Building2 className="w-4 h-4 text-[#103A5C] shrink-0" />
                        <div>
                          <div className="text-xs font-bold leading-tight">Surabaya &amp; Jatim</div>
                          <div className="text-[10px] text-slate-500">In-house &amp; public class</div>
                        </div>
                      </Link>
                      <Link
                        href="/pelatihan-k3-balikpapan/"
                        className="flex items-center gap-2.5 p-2 rounded-xl hover:bg-slate-50 text-slate-800 hover:text-[#103A5C] transition-colors"
                      >
                        <Building2 className="w-4 h-4 text-[#103A5C] shrink-0" />
                        <div>
                          <div className="text-xs font-bold leading-tight">Balikpapan &amp; IKN</div>
                          <div className="text-[10px] text-slate-500">Tambang &amp; konstruksi</div>
                        </div>
                      </Link>
                      <Link
                        href="/pelatihan-k3-kota-indonesia/"
                        className="block pt-2 text-xs font-extrabold text-[#103A5C] hover:underline"
                      >
                        Daftar 20 Kota Indonesia &rarr;
                      </Link>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <Link
              href="/artikel/"
              className={`px-3 py-2 rounded-lg text-xs font-bold transition-colors ${
                isScrolled
                  ? 'text-slate-700 hover:text-[#103A5C] hover:bg-slate-100'
                  : 'text-slate-100 hover:text-white hover:bg-white/10'
              }`}
            >
              Panduan K3
            </Link>

            <Link
              href="/perusahaan#kontak"
              className={`px-3 py-2 rounded-lg text-xs font-bold transition-colors ${
                isScrolled
                  ? 'text-slate-700 hover:text-[#103A5C] hover:bg-slate-100'
                  : 'text-slate-100 hover:text-white hover:bg-white/10'
              }`}
            >
              Kontak
            </Link>
          </nav>

          {/* Desktop Right CTA */}
          <div className="hidden sm:flex items-center gap-3">
            <a
              href="https://wa.me/6287759151278?text=Halo%20Wahana%20Totalita%2C%20saya%20ingin%20konsultasi%20pelatihan%20K3"
              target="_blank"
              rel="noopener noreferrer"
              className="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-extrabold bg-[#25D366] hover:bg-[#20ba5a] text-white shadow-sm hover:shadow transition-all"
            >
              <Phone className="w-3.5 h-3.5" />
              <span>Konsultasi WA</span>
            </a>
          </div>

          {/* Mobile Menu Trigger */}
          <button
            type="button"
            className={`lg:hidden p-2 rounded-xl focus:outline-none transition-colors ${
              isScrolled
                ? 'text-slate-800 hover:bg-slate-100'
                : 'text-white hover:bg-white/10'
            }`}
            onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
            aria-label="Buka Menu"
          >
            {mobileMenuOpen ? <X className="w-6 h-6" /> : <Menu className="w-6 h-6" />}
          </button>
        </div>
      </div>

      {/* Mobile Drawer Navigation */}
      {mobileMenuOpen && (
        <div className="lg:hidden bg-white border-b border-slate-200 px-4 pt-4 pb-6 shadow-xl animate-in slide-in-from-top-2 duration-200">
          {/* Mobile Search */}
          <form
            action="/pelatihan/"
            method="get"
            className="flex items-center relative mb-4"
            role="search"
            onSubmit={(e) => {
              if (!searchQuery.trim()) e.preventDefault();
            }}
          >
            <Search className="absolute left-3 w-4 h-4 text-slate-400" />
            <input
              type="search"
              name="q"
              placeholder="Cari program pelatihan K3..."
              value={searchQuery}
              onChange={(e) => setSearchQuery(e.target.value)}
              className="w-full pl-9 pr-4 py-2.5 rounded-xl text-xs bg-slate-100 text-slate-900 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#103A5C]/20"
            />
          </form>

          {/* Mobile Links */}
          <div className="space-y-1">
            <Link
              href="/pelatihan/"
              className="block px-3 py-2.5 rounded-xl text-sm font-bold text-slate-800 hover:bg-slate-100"
            >
              Semua Program Pelatihan
            </Link>
            <Link
              href="/ahli-k3-umum/"
              className="block px-3 py-2.5 rounded-xl text-sm font-bold text-slate-800 hover:bg-slate-100"
            >
              Ahli K3 Umum (Kemnaker &amp; BNSP)
            </Link>
            <Link
              href="/jadwal/"
              className="block px-3 py-2.5 rounded-xl text-sm font-bold text-slate-800 hover:bg-slate-100"
            >
              Jadwal Batch 2026
            </Link>
            <Link
              href="/keselamatan-kerja/"
              className="block px-3 py-2.5 rounded-xl text-sm font-bold text-slate-800 hover:bg-slate-100"
            >
              23 Sektor Bidang K3
            </Link>
            <Link
              href="/pelatihan-k3-kota-indonesia/"
              className="block px-3 py-2.5 rounded-xl text-sm font-bold text-slate-800 hover:bg-slate-100"
            >
              Lokasi Kota Pelatihan
            </Link>
            <Link
              href="/artikel/"
              className="block px-3 py-2.5 rounded-xl text-sm font-bold text-slate-800 hover:bg-slate-100"
            >
              Artikel &amp; Panduan Regulasi
            </Link>
            <Link
              href="/perusahaan#kontak"
              className="block px-3 py-2.5 rounded-xl text-sm font-bold text-slate-800 hover:bg-slate-100"
            >
              Kontak Perusahaan
            </Link>
          </div>

          {/* Mobile WA Button */}
          <div className="mt-4 pt-4 border-t border-slate-100">
            <a
              href="https://wa.me/6287759151278?text=Halo%20Wahana%20Totalita%2C%20saya%20ingin%20konsultasi%20pelatihan%20K3"
              target="_blank"
              rel="noopener noreferrer"
              className="flex items-center justify-center gap-2 w-full py-3 rounded-xl text-sm font-bold bg-[#25D366] text-white shadow-sm"
            >
              <Phone className="w-4 h-4" />
              <span>Chat WhatsApp Customer Service</span>
            </a>
          </div>
        </div>
      )}
    </header>
  );
}
