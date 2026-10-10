'use client';

import React, { useState } from 'react';
import { ChevronDown, MessageCircle } from 'lucide-react';
import SectionHeader from '@/components/ui/SectionHeader';
import Button from '@/components/ui/Button';
import Card, { CardBody } from '@/components/ui/Card';

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
        <SectionHeader
          badgeText="Tanya Jawab Seputar Sertifikasi"
          title="Pertanyaan Yang Sering Diajukan"
          subtitle="Informasi lengkap mengenai jadwal, legalitas, prosedur sertifikasi, dan in-house training perusahaan."
          align="center"
        />

        {/* Accordion List */}
        <div className="space-y-3.5">
          {faqs.map((item, idx) => {
            const isOpen = openIndex === idx;
            return (
              <Card key={idx} hoverable={false} className="bg-white border-slate-200">
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
              </Card>
            );
          })}
        </div>

        {/* WhatsApp Help Banner below FAQ */}
        <Card hoverable={false} className="mt-10 p-6 bg-white border-slate-200 shadow-sm">
          <div className="flex flex-col sm:flex-row items-center justify-between gap-4 text-center sm:text-left">
            <div>
              <h3 className="font-display font-bold text-base text-slate-900">
                Masih punya pertanyaan seputar syarat atau biaya?
              </h3>
              <p className="text-xs sm:text-sm text-slate-500 mt-1">
                Konsultan K3 kami online setiap hari kerja untuk membantu Anda.
              </p>
            </div>
            <Button
              href="https://wa.me/6287759151278?text=Halo%20Wahana%20Totalita%2C%20saya%20ingin%20bertanya%20tentang%20program%20pelatihan"
              isExternal
              variant="accent"
              size="sm"
              leftIcon={<MessageCircle className="w-4 h-4" />}
              className="bg-[#25D366] hover:bg-[#20ba5a] text-white shrink-0"
            >
              Tanya via WhatsApp
            </Button>
          </div>
        </Card>

      </div>
    </section>
  );
}
