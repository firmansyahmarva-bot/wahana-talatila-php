'use client';

import React, { useState, useMemo } from 'react';
import Link from 'next/link';
import { Search, X, CheckCircle2, MessageCircle, ArrowRight } from 'lucide-react';
import { TrainingProgram } from '@/data/trainings';
import TrainingCard from '@/components/cards/TrainingCard';
import PageHeader from '@/components/layout/PageHeader';
import Button from '@/components/ui/Button';
import Badge from '@/components/ui/Badge';
import Card, { CardBody } from '@/components/ui/Card';
import SectionHeader from '@/components/ui/SectionHeader';

interface TrainingCatalogAppProps {
  trainings: TrainingProgram[];
}

const CATEGORIES = [
  { id: 'all', label: 'Semua Program' },
  { id: 'kemnaker', label: 'KEMNAKER RI' },
  { id: 'bnsp', label: 'Sertifikasi BNSP' },
  { id: 'operator', label: 'Operator & Alat Berat' },
  { id: 'mining', label: 'Pertambangan' },
  { id: 'lingkungan', label: 'Lingkungan & Kimia' },
];

export default function TrainingCatalogApp({ trainings }: TrainingCatalogAppProps) {
  const [searchQuery, setSearchQuery] = useState('');
  const [activeCategory, setActiveCategory] = useState('all');
  const [visibleCount, setVisibleCount] = useState(24);

  // Filter logic
  const filteredTrainings = useMemo(() => {
    return trainings.filter((t) => {
      // Category filter
      let matchesCat = true;
      if (activeCategory === 'kemnaker') {
        matchesCat = t.cert.toLowerCase().includes('kemnaker') || t.title.toLowerCase().includes('kemnaker');
      } else if (activeCategory === 'bnsp') {
        matchesCat = t.cert.toLowerCase().includes('bnsp') || t.title.toLowerCase().includes('bnsp');
      } else if (activeCategory === 'operator') {
        const titleLow = t.title.toLowerCase();
        matchesCat =
          titleLow.includes('operator') ||
          titleLow.includes('forklift') ||
          titleLow.includes('crane') ||
          titleLow.includes('boiler') ||
          titleLow.includes('welder') ||
          titleLow.includes('scaffolding') ||
          titleLow.includes('rigger');
      } else if (activeCategory === 'mining') {
        matchesCat =
          t.category === 'mining' ||
          t.title.toLowerCase().includes('pop') ||
          t.title.toLowerCase().includes('pom') ||
          t.title.toLowerCase().includes('tambang');
      } else if (activeCategory === 'lingkungan') {
        matchesCat =
          t.category === 'lingkungan' ||
          t.title.toLowerCase().includes('limbah') ||
          t.title.toLowerCase().includes('kimia') ||
          t.title.toLowerCase().includes('popal') ||
          t.title.toLowerCase().includes('plb3');
      }

      // Search keyword filter
      const q = searchQuery.toLowerCase().trim();
      const matchesSearch =
        !q ||
        t.title.toLowerCase().includes(q) ||
        t.slug.toLowerCase().includes(q) ||
        t.catBadge.toLowerCase().includes(q) ||
        t.cert.toLowerCase().includes(q);

      return matchesCat && matchesSearch;
    });
  }, [trainings, activeCategory, searchQuery]);

  const displayedTrainings = useMemo(() => {
    return filteredTrainings.slice(0, visibleCount);
  }, [filteredTrainings, visibleCount]);

  return (
    <main id="konten-utama" className="min-h-screen bg-slate-50">
      {/* ══════════════════════════════════════════════════════════
           UNIFIED APP PAGE HEADER
           ══════════════════════════════════════════════════════════ */}
      <PageHeader
        eyebrow="Direktori Resmi Pelatihan & Sertifikasi K3"
        title="Katalog Pelatihan K3"
        highlightTitle="& Sertifikasi Resmi"
        description="Pilihan program sertifikasi KEMNAKER RI & BNSP terlengkap di Indonesia. Tersedia kelas online interaktif, tatap muka di 20 kota, dan in-house training perusahaan."
        badges={[
          'Kemnaker RI & BNSP',
          'Online & Tatap Muka 20 Kota',
          'In-House Training B2B',
          'Instruktur Bersertifikasi Resmi',
        ]}
        breadcrumbs={[
          { name: 'Beranda', href: '/' },
          { name: 'Katalog Pelatihan' },
        ]}
      >
        {/* Interactive App Search Bar */}
        <div className="mt-4 max-w-2xl relative">
          <div className="relative flex items-center">
            <Search className="w-5 h-5 text-slate-400 absolute left-4 pointer-events-none" />
            <input
              type="search"
              className="w-full pl-12 pr-12 py-3.5 rounded-2xl bg-white/95 text-slate-900 placeholder:text-slate-400 text-sm font-medium border border-white/20 shadow-xl focus:outline-none focus:ring-2 focus:ring-[#FF8A3D] focus:bg-white transition-all"
              placeholder="Cari program: Ahli K3 Umum, Forklift, POP, Damkar, Auditor..."
              aria-label="Cari pelatihan K3"
              value={searchQuery}
              onChange={(e) => {
                setSearchQuery(e.target.value);
                setVisibleCount(24);
              }}
            />
            {searchQuery && (
              <button
                type="button"
                onClick={() => setSearchQuery('')}
                className="absolute right-4 p-1 text-slate-400 hover:text-slate-600 transition-colors"
                aria-label="Hapus pencarian"
              >
                <X className="w-4 h-4" />
              </button>
            )}
          </div>
        </div>
      </PageHeader>

      {/* ══════════════════════════════════════════════════════════
           CATALOG SECTION & FILTER TABS
           ══════════════════════════════════════════════════════════ */}
      <section className="py-12 bg-slate-50 border-b border-slate-200/80" id="katalog">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          {/* Filter Pills & Counter Header */}
          <div className="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-8">
            <div className="flex flex-wrap gap-2" role="tablist" aria-label="Kategori Pelatihan">
              {CATEGORIES.map((cat) => (
                <Button
                  key={cat.id}
                  type="button"
                  size="sm"
                  variant={activeCategory === cat.id ? 'primary' : 'ghost'}
                  onClick={() => {
                    setActiveCategory(cat.id);
                    setVisibleCount(24);
                  }}
                  className={activeCategory !== cat.id ? 'bg-white border border-slate-200 text-slate-600 hover:text-slate-900' : ''}
                >
                  {cat.label}
                </Button>
              ))}
            </div>

            <div className="text-xs sm:text-sm text-slate-500 font-medium shrink-0">
              Menampilkan <strong className="text-slate-900">{filteredTrainings.length}</strong> program pelatihan
            </div>
          </div>

          {/* Modern Responsive Card Grid */}
          {displayedTrainings.length === 0 ? (
            <Card hoverable={false} className="text-center py-16 bg-white border border-slate-200 p-8 max-w-lg mx-auto">
              <h3 className="font-display font-bold text-lg text-slate-900 mb-2">Program Tidak Ditemukan</h3>
              <p className="text-sm text-slate-500 mb-6">
                Tidak ada program pelatihan yang cocok dengan kata kunci &ldquo;{searchQuery}&rdquo;.
              </p>
              <Button
                type="button"
                variant="primary"
                size="sm"
                onClick={() => {
                  setSearchQuery('');
                  setActiveCategory('all');
                }}
              >
                Reset Filter Pencarian
              </Button>
            </Card>
          ) : (
            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
              {displayedTrainings.map((prog) => (
                <TrainingCard
                  key={prog.slug}
                  title={prog.title}
                  href={prog.href}
                  imageSrc={prog.image}
                  imageAlt={prog.imageAlt || prog.title}
                  catBadge={prog.catBadge}
                  mode={prog.mode}
                  certification={prog.cert}
                  accentColor={prog.accent}
                  features={prog.features}
                />
              ))}
            </div>
          )}

          {/* Load More Button */}
          {visibleCount < filteredTrainings.length && (
            <div className="text-center mt-12">
              <Button
                type="button"
                variant="secondary"
                size="md"
                onClick={() => setVisibleCount((prev) => prev + 24)}
              >
                Muat Lebih Banyak Program (+24) &darr;
              </Button>
            </div>
          )}
        </div>
      </section>

      {/* ══════════════════════════════════════════════════════════
           COMPARISON: KEMNAKER VS BNSP
           ══════════════════════════════════════════════════════════ */}
      <section className="py-16 bg-white border-b border-slate-200/80">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <SectionHeader
            badgeText="Panduan Sertifikasi"
            title="Memilih Antara Kemnaker RI dan BNSP"
            subtitle="Pahami perbedaan mendasar antara lisensi kewenangan Kemnaker RI dan pengakuan kompetensi kerja BNSP untuk kebutuhan karier maupun perusahaan Anda."
            align="center"
          />

          <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
            {/* Kemnaker Card */}
            <Card hoverable={false} className="p-6 md:p-8 bg-slate-50 border-slate-200">
              <Badge variant="brand" size="sm" className="mb-4">
                Kewajiban Regulasi &amp; Lisensi Legal
              </Badge>
              <h3 className="font-display font-extrabold text-2xl text-[#103A5C] mb-3">
                Sertifikasi Kemnaker RI
              </h3>
              <p className="text-sm text-slate-600 leading-relaxed mb-6 font-sans">
                Diterbitkan langsung melalui Kementerian Ketenagakerjaan RI, menghasilkan Surat Keputusan Penunjukan (SKP) dan Lisensi K3 (SIO/Buku Kerja).
              </p>
              <ul className="space-y-3 text-xs sm:text-sm text-slate-700 font-sans">
                <li className="flex items-start gap-2.5">
                  <CheckCircle2 className="w-4 h-4 text-emerald-600 mt-0.5 shrink-0" />
                  <span><strong>Wajib Regulasi:</strong> Payung hukum UU No. 1/1970 untuk pemenuhan syarat audit Pengawas Ketenagakerjaan.</span>
                </li>
                <li className="flex items-start gap-2.5">
                  <CheckCircle2 className="w-4 h-4 text-emerald-600 mt-0.5 shrink-0" />
                  <span><strong>Output Lisensi:</strong> Mendapatkan SKP dan Kartu Kewenangan Ahli/Operator resmi pemerintah.</span>
                </li>
                <li className="flex items-start gap-2.5">
                  <CheckCircle2 className="w-4 h-4 text-emerald-600 mt-0.5 shrink-0" />
                  <span><strong>Contoh Skema:</strong> Ahli K3 Umum Kemnaker, Operator Forklift, Damkar, Operator Boiler &amp; Crane.</span>
                </li>
              </ul>
            </Card>

            {/* BNSP Card */}
            <Card hoverable={false} className="p-6 md:p-8 bg-slate-50 border-slate-200">
              <Badge variant="accent" size="sm" className="mb-4">
                Standar Kompetensi Kerja (SKKNI)
              </Badge>
              <h3 className="font-display font-extrabold text-2xl text-[#C2410C] mb-3">
                Sertifikasi BNSP (Garuda Emas)
              </h3>
              <p className="text-sm text-slate-600 leading-relaxed mb-6 font-sans">
                Diterbitkan melalui Lembaga Sertifikasi Profesi (LSP) berlisensi BNSP mengacu pada standar unit kompetensi SKKNI nasional.
              </p>
              <ul className="space-y-3 text-xs sm:text-sm text-slate-700 font-sans">
                <li className="flex items-start gap-2.5">
                  <CheckCircle2 className="w-4 h-4 text-emerald-600 mt-0.5 shrink-0" />
                  <span><strong>Pengakuan Kompetensi:</strong> Berlogo Garuda Emas, mengukur keterampilan terstandar industri nasional.</span>
                </li>
                <li className="flex items-start gap-2.5">
                  <CheckCircle2 className="w-4 h-4 text-emerald-600 mt-0.5 shrink-0" />
                  <span><strong>Syarat Tender &amp; Proyek:</strong> Kerap menjadi syarat teknis dalam dokumen lelang BUMN, kontraktor EPC, dan migas.</span>
                </li>
                <li className="flex items-start gap-2.5">
                  <CheckCircle2 className="w-4 h-4 text-emerald-600 mt-0.5 shrink-0" />
                  <span><strong>Contoh Skema:</strong> Pengawas K3 Migas, POP/POM Pertambangan, Penanggung Jawab Air Limbah (POPAL), Auditor ISO.</span>
                </li>
              </ul>
            </Card>
          </div>
        </div>
      </section>

      {/* ══════════════════════════════════════════════════════════
           CORPORATE IN-HOUSE CTA BANNER
           ══════════════════════════════════════════════════════════ */}
      <section className="py-16 bg-[#103A5C] text-white">
        <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
          <Badge variant="accent" size="md" className="mb-4">
            In-House Training Korporasi
          </Badge>
          <h2 className="font-display font-extrabold text-3xl sm:text-4xl leading-tight mb-4">
            Konsultasi Kebutuhan Pelatihan K3 Perusahaan Anda
          </h2>
          <p className="text-slate-200 text-base leading-relaxed mb-8 max-w-2xl mx-auto font-sans">
            Kami melayani pelatihan rombongan in-house training di lokasi pabrik, proyek konstruksi, atau kantor perusahaan Anda di seluruh wilayah Indonesia dengan silabus yang disesuaikan.
          </p>
          <div className="flex flex-wrap items-center justify-center gap-4">
            <Button
              href="https://wa.me/6287759151278?text=Halo%20Wahana%20Totalita%2C%20kami%20ingin%20mengajukan%20penawaran%20In-House%20Training%20K3%20untuk%20perusahaan"
              isExternal
              size="lg"
              variant="accent"
              leftIcon={<MessageCircle className="w-5 h-5" />}
              className="bg-[#25D366] hover:bg-[#20ba5a] text-white"
            >
              Minta Proposal Penawaran WhatsApp
            </Button>
            <Button
              href="/jadwal/"
              size="lg"
              variant="secondary"
              rightIcon={<ArrowRight className="w-4 h-4" />}
              className="bg-white/10 hover:bg-white/20 text-white border-white/20"
            >
              Lihat Jadwal Terdekat
            </Button>
          </div>
        </div>
      </section>
    </main>
  );
}
