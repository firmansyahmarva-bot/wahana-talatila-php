'use client';

import React, { useState } from 'react';

interface FaqItem {
  q: string;
  a: string;
}

const faqs: FaqItem[] = [
  {
    q: 'Apa itu sertifikasi K3 KEMNAKER RI?',
    a: 'Sertifikasi K3 KEMNAKER RI adalah pengakuan resmi dari Kementerian Ketenagakerjaan Republik Indonesia bahwa seseorang telah memenuhi kompetensi di bidang Keselamatan dan Kesehatan Kerja. Sertifikat ini wajib dimiliki untuk posisi Ahli K3 Umum di perusahaan yang memiliki risiko kerja tinggi.',
  },
  {
    q: 'Apakah pelatihan bisa dilakukan secara online?',
    a: 'Ya. Wahana Totalita Konsultan menyediakan pelatihan online via Zoom untuk hampir semua program. Peserta dari seluruh Indonesia dapat mengikuti pelatihan tanpa harus datang ke Yogyakarta. Materi, modul, dan ujian dilakukan secara daring dengan kualitas yang sama.',
  },
  {
    q: 'Berapa lama proses penerbitan sertifikat setelah ujian?',
    a: 'Sertifikat BNSP umumnya terbit dalam 14-30 hari kerja setelah peserta dinyatakan lulus ujian kompetensi. Sertifikat KEMNAKER RI memiliki proses lebih panjang sesuai regulasi, biasanya 30-60 hari kerja.',
  },
  {
    q: 'Apakah ada diskon untuk pendaftaran grup perusahaan?',
    a: 'Ya, tersedia diskon khusus untuk pendaftaran grup minimal 5 peserta dari perusahaan yang sama. Hubungi kami via WhatsApp untuk mendapatkan penawaran harga korporasi dan paket in-house training.',
  },
  {
    q: 'Apakah sertifikat berlaku di seluruh Indonesia?',
    a: 'Ya. Sertifikat yang diterbitkan BNSP dan KEMNAKER RI berlaku secara nasional di seluruh wilayah Indonesia dan diakui oleh perusahaan-perusahaan di berbagai sektor industri.',
  },
  {
    q: 'Apa perbedaan sertifikasi BNSP dan KEMNAKER RI?',
    a: 'Sertifikasi KEMNAKER RI dikeluarkan langsung oleh Kementerian Ketenagakerjaan, umumnya untuk program K3 umum dan khusus yang diatur dalam UU K3. Sertifikasi BNSP (Badan Nasional Sertifikasi Profesi) mencakup lebih banyak bidang kompetensi kerja termasuk lingkungan, mining, dan ISO/QHSE.',
  },
];

export default function FaqSection() {
  const [openIndices, setOpenIndices] = useState<number[]>([]);

  const toggleFaq = (idx: number) => {
    setOpenIndices((prev) =>
      prev.includes(idx) ? prev.filter((i) => i !== idx) : [...prev, idx]
    );
  };

  return (
    <section className="section-faq fade-in" aria-labelledby="faq-heading">
      <div className="container">
        <div className="section-header">
          <p className="section-eyebrow">Pertanyaan Umum</p>
          <h2 className="section-title" id="faq-heading">
            Yang Sering Ditanyakan
          </h2>
          <p className="section-subtitle">
            Jawaban atas pertanyaan paling umum seputar pelatihan dan sertifikasi kami.
          </p>
        </div>
        <div className="faq-grid">
          {faqs.map((item, idx) => {
            const isOpen = openIndices.includes(idx);
            return (
              <div key={idx} className={`faq-item ${isOpen ? 'open' : ''}`}>
                <button
                  type="button"
                  className="faq-question"
                  aria-expanded={isOpen}
                  onClick={() => toggleFaq(idx)}
                >
                  {item.q}
                  <span className="faq-icon" aria-hidden="true">
                    {isOpen ? '−' : '+'}
                  </span>
                </button>
                <div className="faq-answer">
                  <div className="faq-answer-inner">{item.a}</div>
                </div>
              </div>
            );
          })}
        </div>
      </div>
    </section>
  );
}
