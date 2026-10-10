'use client';

import React, { useState } from 'react';
import { ChevronDown, HelpCircle, MessageCircle } from 'lucide-react';

interface FaqItem {
  q: string;
  a: string;
}

const faqs: FaqItem[] = [
  {
    q: 'Apa itu sertifikasi K3 KEMNAKER RI dan siapa yang wajib memiliki?',
    a: 'Sertifikasi K3 KEMNAKER RI adalah lisensi resmi penunjukan personel dari Kementerian Ketenagakerjaan RI (SKP & Lisensi K3) yang diwajibkan oleh UU No. 1 Tahun 1970 & Permenaker No. 04/MEN/1987 bagi perusahaan berisiko tinggi atau mempekerjakan lebih dari 100 tenaga kerja.',
  },
  {
    q: 'Apakah pelatihan bisa diikuti secara online dari luar kota?',
    a: 'Ya. Wahana Totalita menyediakan pelatihan online interaktif via Zoom untuk program pembinaan teori. Peserta dari seluruh Indonesia (Sumatera, Kalimantan, Sulawesi, hingga Papua) dapat mengikuti kelas tanpa harus hadir ke Yogyakarta, dengan legalitas kelulusan 100% sama.',
  },
  {
    q: 'Berapa lama proses penerbitan sertifikat setelah evaluasi?',
    a: 'Sertifikat BNSP umumnya terbit dalam 14–30 hari kerja setelah peserta dinyatakan kompeten pada uji asesmen. Sertifikat dan SKP Kemnaker RI diproses melalui sistem TemanK3 regulasi pemerintah, rata-rata 30–60 hari kerja.',
  },
  {
    q: 'Apakah tersedia paket khusus untuk in-house training perusahaan?',
    a: 'Ya, tersedia skema In-House Corporate Training di mana tim instruktur kami hadir langsung di lokasi pabrik/site operasional perusahaan Anda di seluruh Indonesia dengan kurikulum yang disesuaikan dengan jenis bahaya spesifik industri Anda.',
  },
  {
    q: 'Apa perbedaan mendasar antara sertifikasi BNSP dan Kemnaker RI?',
    a: 'Sertifikasi Kemnaker RI memberikan Lisensi Kewenangan Hukum bagi personel K3 untuk ditunjuk secara legal di perusahaan. Sertifikasi BNSP memberikan Pengakuan Standar Kompetensi Profesi Kerja nasional (SKKNI) yang diakui secara luas di industri nasional maupun multinasional.',
  },
  {
    q: 'Bagaimana cara mengecek keaslian sertifikat yang diterbitkan?',
    a: 'Setiap sertifikat resmi dilengkapi dengan nomor registrasi unik dan QR code yang dapat diverifikasi langsung melalui portal resmi TemanK3 Kemnaker RI atau sistem verifikasi online Wahana Totalita.',
  },
];

export default function FaqSection() {
  const [openIndex, setOpenIndex] = useState<number | null>(0);

  const toggleFaq = (idx: number) => {
    setOpenIndex(openIndex === idx ? null : idx);
  };

  return (
    <section className="py-16 bg-slate-50 border-b border-slate-200/80" id="faq" aria-labelledby="faq-heading">
      <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {/* Section Header */}
        <div className="text-center mb-12">
          <div className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#E8F0F7] text-[#103A5C] mb-3">
            <HelpCircle className="w-3.5 h-3.5" />
            Tanya Jawab Seputar Sertifikasi
          </div>
          <h2 id="faq-heading" className="font-display font-extrabold text-3xl sm:text-4xl text-slate-900 tracking-tight mb-4">
            Pertanyaan Yang Sering Diajukan
          </h2>
          <p className="text-base text-slate-600 leading-relaxed font-sans">
            Informasi lengkap mengenai jadwal, legalitas, prosedur sertifikasi, dan in-house training perusahaan.
          </p>
        </div>

        {/* Accordion List */}
        <div className="space-y-3.5">
          {faqs.map((item, idx) => {
            const isOpen = openIndex === idx;
            return (
              <div
                key={idx}
                className="rounded-2xl bg-white border border-slate-200 shadow-sm overflow-hidden transition-colors"
              >
                <button
                  type="button"
                  onClick={() => toggleFaq(idx)}
                  className="w-full flex items-center justify-between p-5 sm:p-6 text-left cursor-pointer focus:outline-none"
                  aria-expanded={isOpen}
                >
                  <span className="font-display font-bold text-base sm:text-lg text-slate-900 pr-4">
                    {item.q}
                  </span>
                  <div className={`p-1.5 rounded-lg bg-slate-100 text-slate-600 shrink-0 transition-transform duration-200 ${isOpen ? 'rotate-180 bg-[#103A5C] text-white' : ''}`}>
                    <ChevronDown className="w-4 h-4" />
                  </div>
                </button>

                {isOpen && (
                  <div className="px-5 pb-5 sm:px-6 sm:pb-6 text-sm text-slate-600 leading-relaxed font-sans border-t border-slate-100 pt-4">
                    {item.a}
                  </div>
                )}
              </div>
            );
          })}
        </div>

        {/* WhatsApp Help Banner below FAQ */}
        <div className="mt-10 p-6 rounded-2xl bg-white border border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4 text-center sm:text-left shadow-sm">
          <div>
            <h4 className="font-display font-bold text-base text-slate-900">
              Masih punya pertanyaan seputar syarat atau biaya?
            </h4>
            <p className="text-xs sm:text-sm text-slate-500 mt-1">
              Konsultan K3 kami online setiap hari kerja untuk membantu Anda.
            </p>
          </div>
          <a
            href="https://wa.me/6287759151278?text=Halo%20Wahana%20Totalita%2C%20saya%20ingin%20bertanya%20tentang%20program%20pelatihan"
            target="_blank"
            rel="noopener noreferrer"
            className="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold bg-[#25D366] hover:bg-[#20ba5a] text-white shadow-sm shrink-0 transition-all"
          >
            <MessageCircle className="w-4 h-4" />
            Tanya via WhatsApp
          </a>
        </div>

      </div>
    </section>
  );
}
