'use client';

import React, { useState } from 'react';
import { MessageCircle, X, ChevronRight, Sparkles, Send } from 'lucide-react';

export default function WhatsAppFloat() {
  const [isOpen, setIsOpen] = useState(false);

  const phone = '6287759151278';
  const quickOptions = [
    {
      title: 'Tanya Jadwal & Kuota',
      desc: 'Cek jadwal terdekat kelas Jogja, Jakarta & Online',
      msg: 'Halo Wahana Totalita, saya ingin cek jadwal pelatihan K3 terdekat dan kuota yang tersedia.',
    },
    {
      title: 'Konsultasi Sertifikasi',
      desc: 'Kemnaker RI, BNSP, atau Perpanjangan SKP',
      msg: 'Halo Wahana Totalita, saya butuh konsultasi mengenai sertifikasi K3 yang sesuai untuk saya/tim.',
    },
    {
      title: 'Penawaran In-House Training',
      desc: 'Pelatihan internal khusus perusahaan Anda',
      msg: 'Halo Wahana Totalita, perusahaan kami ingin meminta penawaran proposal in-house training K3.',
    },
  ];

  return (
    <div className="fixed right-5 bottom-20 md:bottom-6 z-50">
      {/* App Popup Card */}
      {isOpen && (
        <div className="absolute bottom-16 right-0 w-80 max-w-[90vw] bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden animate-in fade-in slide-in-from-bottom-4 duration-200">
          {/* Header */}
          <div className="bg-gradient-to-r from-[#103A5C] to-[#0B2C46] text-white p-4 flex items-center justify-between">
            <div className="flex items-center gap-2.5">
              <div className="relative">
                <div className="w-8 h-8 rounded-full bg-[#25D366] flex items-center justify-center">
                  <MessageCircle className="w-4 h-4 text-white" />
                </div>
                <span className="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full bg-[#10B981] ring-2 ring-white" />
              </div>
              <div>
                <div className="font-display font-bold text-xs">Customer Service K3</div>
                <div className="text-[10px] text-slate-300">Online · Balas Cepat</div>
              </div>
            </div>

            <button
              type="button"
              onClick={() => setIsOpen(false)}
              className="p-1 rounded-lg hover:bg-white/10 text-slate-300 hover:text-white"
              aria-label="Tutup"
            >
              <X className="w-4 h-4" />
            </button>
          </div>

          {/* Body */}
          <div className="p-3.5 space-y-2 bg-slate-50 max-h-72 overflow-y-auto">
            <p className="text-[11px] font-semibold text-slate-500 mb-2">
              Pilih topik untuk konsultasi langsung via WhatsApp:
            </p>

            {quickOptions.map((opt, idx) => (
              <a
                key={idx}
                href={`https://wa.me/${phone}?text=${encodeURIComponent(opt.msg)}`}
                target="_blank"
                rel="noopener noreferrer"
                className="flex items-center justify-between p-2.5 rounded-xl bg-white border border-slate-200/90 hover:border-[#25D366] hover:bg-emerald-50/30 transition-all text-slate-800 group"
              >
                <div>
                  <div className="text-xs font-bold group-hover:text-[#103A5C]">
                    {opt.title}
                  </div>
                  <div className="text-[10px] text-slate-500">{opt.desc}</div>
                </div>
                <ChevronRight className="w-4 h-4 text-slate-400 group-hover:text-[#25D366] transition-transform group-hover:translate-x-0.5" />
              </a>
            ))}
          </div>

          {/* Footer Direct Input */}
          <div className="p-3 bg-white border-t border-slate-100">
            <a
              href={`https://wa.me/${phone}?text=${encodeURIComponent(
                'Halo Wahana Totalita, saya ingin bertanya tentang pelatihan K3.'
              )}`}
              target="_blank"
              rel="noopener noreferrer"
              className="flex items-center justify-center gap-2 w-full py-2.5 rounded-xl text-xs font-bold bg-[#25D366] hover:bg-[#20ba5a] text-white shadow-sm transition-all"
            >
              <Send className="w-3.5 h-3.5" />
              <span>Mulai Chat Sekarang</span>
            </a>
          </div>
        </div>
      )}

      {/* Main Trigger Button */}
      <button
        type="button"
        onClick={() => setIsOpen(!isOpen)}
        className="w-14 h-14 rounded-full bg-[#25D366] hover:bg-[#20ba5a] text-white flex items-center justify-center shadow-lg hover:shadow-xl hover:scale-105 transition-all cursor-pointer ring-4 ring-[#25D366]/20"
        aria-label="Buka Chat WhatsApp"
      >
        {isOpen ? <X className="w-6 h-6" /> : <MessageCircle className="w-7 h-7" />}
      </button>
    </div>
  );
}
