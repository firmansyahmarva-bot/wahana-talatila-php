'use client';

import React, { useState, useMemo } from 'react';
import Link from 'next/link';
import { Calendar, Search, X, MessageCircle, ArrowRight, CheckCircle2 } from 'lucide-react';
import { ScheduleBatch } from '@/data/schedules';
import PageHeader from '@/components/layout/PageHeader';
import Button from '@/components/ui/Button';
import Badge from '@/components/ui/Badge';
import Card, { CardBody } from '@/components/ui/Card';
import SectionHeader from '@/components/ui/SectionHeader';

interface ScheduleCatalogAppProps {
  batches: ScheduleBatch[];
}

const TABS = [
  { id: 'all', label: 'Semua' },
  { id: 'online', label: 'Online' },
  { id: 'offline', label: 'Tatap Muka' },
  { id: 'kemnaker', label: 'KEMNAKER RI' },
  { id: 'bnsp', label: 'BNSP' },
];

export default function ScheduleCatalogApp({ batches }: ScheduleCatalogAppProps) {
  const [activeTab, setActiveTab] = useState('all');
  const [searchQuery, setSearchQuery] = useState('');

  const filteredBatches = useMemo(() => {
    return batches.filter((b) => {
      // Tab filter
      let matchesTab = true;
      if (activeTab === 'online') {
        matchesTab = b.mode.toLowerCase().includes('online') || b.filterTags.includes('online');
      } else if (activeTab === 'offline') {
        matchesTab = b.mode.toLowerCase().includes('tatap') || b.filterTags.includes('offline');
      } else if (activeTab === 'kemnaker') {
        matchesTab = b.certification.toLowerCase().includes('kemnaker') || b.title.toLowerCase().includes('kemnaker');
      } else if (activeTab === 'bnsp') {
        matchesTab = b.certification.toLowerCase().includes('bnsp') || b.title.toLowerCase().includes('bnsp');
      }

      // Search keyword filter
      const q = searchQuery.toLowerCase().trim();
      const matchesSearch =
        !q ||
        b.title.toLowerCase().includes(q) ||
        b.date.toLowerCase().includes(q) ||
        b.certification.toLowerCase().includes(q) ||
        b.mode.toLowerCase().includes(q);

      return matchesTab && matchesSearch;
    });
  }, [batches, activeTab, searchQuery]);

  return (
    <main id="konten-utama" className="min-h-screen bg-slate-50">
      {/* ══════════════════════════════════════════════════════════
           UNIFIED APP PAGE HEADER
           ══════════════════════════════════════════════════════════ */}
      <PageHeader
        eyebrow="Agenda & Kalender Pembinaan 2026"
        title="Jadwal Pelatihan K3"
        highlightTitle="& Sertifikasi 2026"
        description="Jadwal lengkap batch pembinaan dan sertifikasi KEMNAKER RI, BNSP, dan KLHK tahun 2026. Diperbarui setiap bulan dengan kuota transparan."
        badges={[
          'Update Batch Tiap Bulan',
          'Sertifikasi Kemnaker & BNSP',
          'Tersedia Kelas Online & Tatap Muka',
          'Layanan In-House Corporate',
        ]}
        breadcrumbs={[
          { name: 'Beranda', href: '/' },
          { name: 'Jadwal Pelatihan' },
        ]}
      />

      {/* ══════════════════════════════════════════════════════════
           SCHEDULE CONTROLS & TABLE
           ══════════════════════════════════════════════════════════ */}
      <section className="py-12 bg-slate-50 border-b border-slate-200/80" id="jadwal">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          
          {/* Controls: Tabs & Search Input */}
          <div className="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200 shadow-sm mb-6 flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4">
            <div className="flex flex-wrap gap-2" role="tablist" aria-label="Filter Jadwal">
              {TABS.map((tab) => (
                <Button
                  key={tab.id}
                  type="button"
                  size="sm"
                  variant={activeTab === tab.id ? 'primary' : 'ghost'}
                  onClick={() => setActiveTab(tab.id)}
                  className={activeTab !== tab.id ? 'bg-slate-100 hover:bg-slate-200 text-slate-700' : ''}
                >
                  {tab.label}
                </Button>
              ))}
            </div>

            <div className="relative max-w-sm w-full">
              <Search className="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none" />
              <input
                type="search"
                className="w-full pl-10 pr-10 py-2 rounded-xl text-xs sm:text-sm bg-slate-50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-[#103A5C]/20 outline-none"
                placeholder="Cari jadwal program..."
                aria-label="Cari jadwal batch"
                value={searchQuery}
                onChange={(e) => setSearchQuery(e.target.value)}
              />
              {searchQuery && (
                <button
                  type="button"
                  className="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 text-xs"
                  onClick={() => setSearchQuery('')}
                >
                  <X className="w-4 h-4" />
                </button>
              )}
            </div>
          </div>

          <div className="text-xs sm:text-sm text-slate-500 font-medium mb-6">
            Menampilkan <strong className="text-slate-900">{filteredBatches.length}</strong> batch pelatihan tersedia
          </div>

          {/* Schedule Table / Card View */}
          <div className="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div className="overflow-x-auto">
              <table className="w-full text-left text-xs sm:text-sm">
                <thead className="bg-slate-50 text-slate-700 border-b border-slate-200 font-bold uppercase text-[11px] tracking-wider">
                  <tr>
                    <th className="py-3.5 px-4 sm:px-6 w-[140px]">Tanggal</th>
                    <th className="py-3.5 px-4 sm:px-6">Program Pelatihan</th>
                    <th className="py-3.5 px-4 sm:px-6 w-[180px]">Sertifikasi</th>
                    <th className="py-3.5 px-4 sm:px-6 w-[140px]">Mode</th>
                    <th className="py-3.5 px-4 sm:px-6 w-[120px]">Sisa Kuota</th>
                    <th className="py-3.5 px-4 sm:px-6 w-[110px] text-right">Aksi</th>
                  </tr>
                </thead>
                <tbody className="divide-y divide-slate-100">
                  {filteredBatches.length === 0 ? (
                    <tr>
                      <td colSpan={6} className="text-center py-12 px-4 text-slate-500">
                        <p className="font-bold text-slate-800 text-base mb-1">
                          Tidak Ada Jadwal yang Cocok
                        </p>
                        <p className="text-xs">
                          Coba kata kunci lain atau pilih tab &ldquo;Semua&rdquo; untuk melihat seluruh jadwal batch.
                        </p>
                      </td>
                    </tr>
                  ) : (
                    filteredBatches.map((b) => (
                      <tr key={b.id || b.title} className="hover:bg-slate-50/80 transition-colors">
                        <td className="py-4 px-4 sm:px-6 font-bold text-[#103A5C]">
                          {b.date}
                        </td>
                        <td className="py-4 px-4 sm:px-6">
                          <Link href={b.batchHref || b.programHref} className="font-bold text-slate-900 hover:text-[#103A5C] transition-colors block leading-snug">
                            {b.title}
                          </Link>
                          <Link href={b.programHref} className="text-[11px] text-slate-500 hover:text-[#103A5C] font-medium inline-flex items-center gap-1 mt-1">
                            Lihat silabus program &rarr;
                          </Link>
                        </td>
                        <td className="py-4 px-4 sm:px-6">
                          <Badge variant="brand" size="sm">
                            {b.certification}
                          </Badge>
                        </td>
                        <td className="py-4 px-4 sm:px-6">
                          <Badge
                            variant={b.mode.toLowerCase().includes('online') ? 'success' : 'accent'}
                            size="sm"
                          >
                            {b.mode}
                          </Badge>
                        </td>
                        <td className="py-4 px-4 sm:px-6">
                          <Badge variant="neutral" size="sm">
                            {b.seats}
                          </Badge>
                        </td>
                        <td className="py-4 px-4 sm:px-6 text-right">
                          <Button
                            href={b.waLink}
                            isExternal
                            variant="accent"
                            size="sm"
                            leftIcon={<MessageCircle className="w-3.5 h-3.5" />}
                            className="bg-[#25D366] hover:bg-[#20ba5a] text-white"
                          >
                            Daftar
                          </Button>
                        </td>
                      </tr>
                    ))
                  )}
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>

      {/* ══════════════════════════════════════════════════════════
           HOW TO REGISTER (6 STEPS)
           ══════════════════════════════════════════════════════════ */}
      <section className="py-16 bg-white border-b border-slate-200/80">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <SectionHeader
            badgeText="Panduan Registrasi"
            title="Cara Mendaftar Pelatihan"
            subtitle="Proses pendaftaran cepat, transparan, dan terverifikasi secara resmi."
            align="center"
          />

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {[
              { num: '1️⃣', title: 'Pilih Jadwal & Program', desc: 'Pilih program sertifikasi dan tanggal batch yang sesuai dengan kebutuhan kualifikasi Anda.' },
              { num: '2️⃣', title: 'Klik Daftar / WhatsApp', desc: 'Klik tombol Daftar untuk langsung terhubung dengan tim representatif kami dengan format pesan otomatis.' },
              { num: '3️⃣', title: 'Konfirmasi Data Peserta', desc: 'Kirim dokumen persyaratan (KTP, pas foto, dan salinan ijazah terakhir) untuk verifikasi lisensi.' },
              { num: '4️⃣', title: 'Pembayaran Legal', desc: 'Lakukan pembayaran melalui rekening resmi PT Wahana Totalita Konsultan dengan invoice legal.' },
              { num: '5️⃣', title: 'Ikuti Pembinaan', desc: 'Akses link kelas Zoom interaktif atau hadir di fasilitas training center kami sesuai tanggal batch.' },
              { num: '6️⃣', title: 'Terima Sertifikat Resmi', desc: 'Sertifikat kelulusan resmi Kemnaker RI / BNSP diterbitkan dan dikirimkan ke alamat Anda.' },
            ].map((step, i) => (
              <Card key={i} hoverable className="p-6 bg-slate-50 border-slate-200">
                <div className="text-2xl mb-3">{step.num}</div>
                <h3 className="font-display font-bold text-base text-[#103A5C] mb-2">{step.title}</h3>
                <p className="text-xs sm:text-sm text-slate-600 leading-relaxed font-sans">{step.desc}</p>
              </Card>
            ))}
          </div>
        </div>
      </section>

      {/* ══════════════════════════════════════════════════════════
           CTA WHATSAPP SECTION
           ══════════════════════════════════════════════════════════ */}
      <section className="py-16 bg-[#103A5C] text-white text-center">
        <div className="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
          <h2 className="font-display font-extrabold text-2xl sm:text-3xl leading-tight mb-4">
            Butuh Jadwal Khusus atau In-House Training Perusahaan?
          </h2>
          <p className="text-slate-200 text-sm sm:text-base leading-relaxed mb-8 font-sans">
            Kami dapat menyesuaikan tanggal, materi, dan lokasi pelatihan sesuai kebutuhan operasional perusahaan Anda di seluruh wilayah Indonesia.
          </p>
          <Button
            href="https://wa.me/6287759151278?text=Halo%20Wahana%20Totalita%2C%20kami%20ingin%20jadwal%20khusus%20in-house%20training%20K3"
            isExternal
            size="lg"
            variant="accent"
            leftIcon={<MessageCircle className="w-5 h-5" />}
            className="bg-[#25D366] hover:bg-[#20ba5a] text-white"
          >
            Hubungi Konsultan Pelatihan Kami
          </Button>
        </div>
      </section>
    </main>
  );
}
