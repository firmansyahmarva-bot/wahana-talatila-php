import React from 'react';
import Link from 'next/link';
import { Mail, Phone, MessageCircle, MapPin, ShieldCheck, ExternalLink } from 'lucide-react';

export default function Footer() {
  return (
    <footer className="bg-[#0B2C46] text-slate-300 font-sans border-t border-white/10 mt-auto">
      {/* Quick Contact Action Bar */}
      <div className="bg-[#071E30] border-b border-white/5 py-4">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex flex-wrap items-center justify-between gap-4">
            <div className="flex flex-wrap items-center gap-6 text-xs sm:text-sm font-semibold">
              <a
                href="mailto:info@wahanatotalita.com"
                className="flex items-center gap-2 hover:text-white transition-colors"
              >
                <Mail className="w-4 h-4 text-[#FF8A3D]" />
                <span>info@wahanatotalita.com</span>
              </a>
              <a
                href="tel:+628122969435"
                className="flex items-center gap-2 hover:text-white transition-colors"
              >
                <Phone className="w-4 h-4 text-[#FF8A3D]" />
                <span>+62 812-2969-435</span>
              </a>
            </div>

            <a
              href="https://wa.me/6287759151278?text=Halo%20Wahana%20Totalita%2C%20saya%20ingin%20konsultasi%20program%20pelatihan"
              target="_blank"
              rel="noopener noreferrer"
              className="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold bg-[#25D366] hover:bg-[#20ba5a] text-white shadow-sm transition-all"
            >
              <MessageCircle className="w-4 h-4" />
              <span>WhatsApp Customer Service (24/7)</span>
            </a>
          </div>
        </div>
      </div>

      {/* Main Footer Links Columns */}
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10">
          
          {/* Brand & Address */}
          <div className="lg:col-span-2">
            <Link href="/" className="flex items-center gap-3 mb-4">
              <img
                src="/assets/img/logo-wt.png"
                alt="Wahana Totalita Konsultan"
                className="h-10 w-auto rounded-lg shadow-sm"
                width={40}
                height={40}
              />
              <span className="font-display font-extrabold text-lg text-white tracking-tight">
                Wahana Totalita Konsultan
              </span>
            </Link>

            <p className="text-xs sm:text-sm text-slate-400 leading-relaxed max-w-sm mb-6">
              Perusahaan Jasa Keselamatan dan Kesehatan Kerja (PJK3) resmi Kemnaker RI, Lembaga Pembinaan &amp; Sertifikasi Profesi BNSP, PaDi UMKM, serta Konsultan Lingkungan Hidup terpercaya sejak 2008.
            </p>

            <div className="space-y-2 text-xs text-slate-400">
              <div className="flex items-start gap-2">
                <MapPin className="w-4 h-4 text-[#FF8A3D] shrink-0 mt-0.5" />
                <span>Kantor Pusat: Jl. Ringroad Timur No. 10, Yogyakarta 55198</span>
              </div>
              <div className="flex items-start gap-2">
                <ShieldCheck className="w-4 h-4 text-[#10B981] shrink-0 mt-0.5" />
                <span>SK Penunjukan PJK3 Kemnaker RI No. 5/112/AS.02.04/I/2023</span>
              </div>
            </div>
          </div>

          {/* Col 2: Pelatihan Populer */}
          <div>
            <div className="font-display font-bold text-xs uppercase tracking-wider text-white mb-4">
              Program Populer
            </div>
            <ul className="space-y-2.5 text-xs text-slate-400">
              <li>
                <Link href="/ahli-k3-umum/" className="hover:text-white transition-colors">
                  Ahli K3 Umum Kemnaker RI
                </Link>
              </li>
              <li>
                <Link href="/pelatihan/ak3-bnsp/" className="hover:text-white transition-colors">
                  Ahli K3 Umum BNSP
                </Link>
              </li>
              <li>
                <Link href="/k3-konstruksi/" className="hover:text-white transition-colors">
                  Ahli Muda &amp; Madya K3 Konstruksi
                </Link>
              </li>
              <li>
                <Link href="/k3-migas/" className="hover:text-white transition-colors">
                  Pengawas K3 Migas
                </Link>
              </li>
              <li>
                <Link href="/k3-listrik/" className="hover:text-white transition-colors">
                  Teknisi &amp; Ahli K3 Listrik
                </Link>
              </li>
              <li>
                <Link href="/k3-lingkungan/" className="hover:text-white transition-colors">
                  POPAL &amp; Pengelolaan Limbah B3
                </Link>
              </li>
              <li>
                <Link href="/pelatihan-iso/" className="hover:text-white transition-colors">
                  Lead Auditor ISO 45001 &amp; 9001
                </Link>
              </li>
            </ul>
          </div>

          {/* Col 3: Sektor & Kota */}
          <div>
            <div className="font-display font-bold text-xs uppercase tracking-wider text-white mb-4">
              Kota &amp; Wilayah
            </div>
            <ul className="space-y-2.5 text-xs text-slate-400">
              <li>
                <Link href="/pelatihan-k3-yogyakarta/" className="hover:text-white transition-colors">
                  Yogyakarta (Pusat Pelatihan)
                </Link>
              </li>
              <li>
                <Link href="/pelatihan-k3-jakarta/" className="hover:text-white transition-colors">
                  Jakarta &amp; Jabodetabek
                </Link>
              </li>
              <li>
                <Link href="/pelatihan-k3-surabaya/" className="hover:text-white transition-colors">
                  Surabaya &amp; Jawa Timur
                </Link>
              </li>
              <li>
                <Link href="/pelatihan-k3-semarang/" className="hover:text-white transition-colors">
                  Semarang &amp; Jawa Tengah
                </Link>
              </li>
              <li>
                <Link href="/pelatihan-k3-balikpapan/" className="hover:text-white transition-colors">
                  Balikpapan &amp; IKN
                </Link>
              </li>
              <li>
                <Link href="/pelatihan-k3-makassar/" className="hover:text-white transition-colors">
                  Makassar &amp; Sulsel
                </Link>
              </li>
              <li>
                <Link href="/pelatihan-k3-kota-indonesia/" className="text-[#FF8A3D] font-bold hover:underline">
                  Semua 20 Kota Indonesia &rarr;
                </Link>
              </li>
            </ul>
          </div>

          {/* Col 4: Corporate & Legal */}
          <div>
            <div className="font-display font-bold text-xs uppercase tracking-wider text-white mb-4">
              Perusahaan &amp; Info
            </div>
            <ul className="space-y-2.5 text-xs text-slate-400">
              <li>
                <Link href="/perusahaan/" className="hover:text-white transition-colors">
                  Profil Perusahaan
                </Link>
              </li>
              <li>
                <Link href="/jadwal/" className="hover:text-white transition-colors">
                  Jadwal Pelatihan 2026
                </Link>
              </li>
              <li>
                <Link href="/artikel/" className="hover:text-white transition-colors">
                  Artikel &amp; Regulasi K3
                </Link>
              </li>
              <li>
                <Link href="/faq/" className="hover:text-white transition-colors">
                  Tanya Jawab (FAQ)
                </Link>
              </li>
              <li>
                <Link href="/perusahaan#kontak" className="hover:text-white transition-colors">
                  Hubungi Konsultan
                </Link>
              </li>
              <li>
                <Link href="/sitemap.xml" className="hover:text-white transition-colors">
                  Sitemap XML
                </Link>
              </li>
            </ul>
          </div>

        </div>
      </div>

      {/* Copyright Footer Strip */}
      <div className="bg-[#051726] py-6 border-t border-white/5">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
          <p>
            &copy; {new Date().getFullYear()} PT Wahana Totalita Konsultan. Seluruh Hak Cipta Dilindungi Undang-Undang.
          </p>
          <div className="flex items-center gap-4">
            <Link href="/kebijakan-privasi/" className="hover:text-slate-400 transition-colors">
              Kebijakan Privasi
            </Link>
            <span>&bull;</span>
            <Link href="/syarat-ketentuan/" className="hover:text-slate-400 transition-colors">
              Syarat &amp; Ketentuan
            </Link>
          </div>
        </div>
      </div>
    </footer>
  );
}
