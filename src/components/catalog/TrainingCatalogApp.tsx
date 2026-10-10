'use client';

import React, { useState, useMemo } from 'react';
import Link from 'next/link';
import { Search, X, CheckCircle, ArrowRight } from 'lucide-react';
import { TrainingProgram } from '@/data/trainings';
import TrainingCard from '@/components/cards/TrainingCard';
import PageHeader from '@/components/layout/PageHeader';

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
                <button
                  key={cat.id}
                  type="button"
                  className={`px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all duration-200 cursor-pointer ${
                    activeCategory === cat.id
                      ? 'bg-[#103A5C] text-white shadow-md shadow-[#103A5C]/20'
                      : 'bg-white text-slate-600 hover:text-slate-900 border border-slate-200 hover:border-slate-300'
                  }`}
                  onClick={() => {
                    setActiveCategory(cat.id);
                    setVisibleCount(24);
                  }}
                >
                  {cat.label}
                </button>
              ))}
            </div>

            <div className="text-xs sm:text-sm text-slate-500 font-medium shrink-0">
              Menampilkan <strong className="text-slate-900">{filteredTrainings.length}</strong> program pelatihan
            </div>
          </div>

          {/* Modern Responsive Card Grid */}
          {displayedTrainings.length === 0 ? (
            <div className="text-center py-16 bg-white rounded-2xl border border-slate-200 p-8 max-w-lg mx-auto">
              <h3 className="font-display font-bold text-lg text-slate-900 mb-2">Program Tidak Ditemukan</h3>
              <p className="text-sm text-slate-500 mb-6">
                Tidak ada program pelatihan yang cocok dengan kata kunci &ldquo;{searchQuery}&rdquo;.
              </p>
              <button
                type="button"
                className="px-5 py-2.5 rounded-xl font-bold text-xs bg-[#103A5C] text-white hover:bg-[#0B2C46] transition-colors cursor-pointer"
                onClick={() => {
                  setSearchQuery('');
                  setActiveCategory('all');
                }}
              >
                Reset Filter Pencarian
              </button>
            </div>
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
              <button
                type="button"
                className="px-8 py-3.5 rounded-xl text-sm font-bold bg-white text-[#103A5C] border border-slate-200 hover:border-[#103A5C] shadow-sm hover:shadow transition-all cursor-pointer"
                onClick={() => setVisibleCount((prev) => prev + 24)}
              >
                Muat Lebih Banyak Program (+24) &darr;
              </button>
            </div>
          )}
        </div>
      </section>

      {/* ══════════════════════════════════════════════════════════
           COMPARISON: KEMNAKER VS BNSP
           ══════════════════════════════════════════════════════════ */}
      <section className="pcat-compare-section">
        <div className="container">
          <div className="section-header text-center">
            <span className="section-eyebrow">Panduan Sertifikasi</span>
            <h2 className="section-title">Memilih Antara Kemnaker RI dan BNSP</h2>
            <p className="section-desc">
              Pahami perbedaan mendasar antara lisensi kewenangan Kemnaker RI dan pengakuan kompetensi kerja BNSP untuk kebutuhan karier maupun perusahaan Anda.
            </p>
          </div>

          <div className="pcat-compare-grid">
            {/* Kemnaker Card */}
            <div className="pcat-compare-card pcat-compare-kemnaker" data-reveal="up" data-reveal-delay="1">
              <span className="pcat-comp-tag tag-kemnaker">Kewajiban Regulasi &amp; Lisensi Legal</span>
              <h3>Sertifikasi Kemnaker RI</h3>
              <p>
                Diterbitkan langsung melalui Kementerian Ketenagakerjaan RI, menghasilkan Surat Keputusan Penunjukan (SKP) dan Lisensi K3 (SIO/Buku Kerja).
              </p>
              <ul className="pcat-comp-points">
                <li>
                  <span className="icon">✅</span>
                  <span><strong>Wajib Regulasi:</strong> Payung hukum UU No. 1/1970 untuk pemenuhan syarat audit Pengawas Ketenagakerjaan.</span>
                </li>
                <li>
                  <span className="icon">✅</span>
                  <span><strong>Output Lisensi:</strong> Mendapatkan SKP dan Kartu Kewenangan Ahli/Operator resmi pemerintah.</span>
                </li>
                <li>
                  <span className="icon">✅</span>
                  <span><strong>Contoh Skema:</strong> Ahli K3 Umum Kemnaker, Operator Forklift (Kelas 1 &amp; 2), Damkar (Kelas D/C/B/A), Operator Boiler &amp; Crane.</span>
                </li>
              </ul>
            </div>

            {/* BNSP Card */}
            <div className="pcat-compare-card pcat-compare-bnsp" data-reveal="up" data-reveal-delay="2">
              <span className="pcat-comp-tag tag-bnsp">Standar Kompetensi Kerja (SKKNI)</span>
              <h3>Sertifikasi BNSP (Badan Nasional Sertifikasi Profesi)</h3>
              <p>
                Diterbitkan melalui Lembaga Sertifikasi Profesi (LSP) berlisensi BNSP mengacu pada standar unit kompetensi SKKNI nasional.
              </p>
              <ul className="pcat-comp-points">
                <li>
                  <span className="icon">✅</span>
                  <span><strong>Pengakuan Kompetensi:</strong> Berlogo Garuda Emas, mengukur keterampilan terstandar industri nasional.</span>
                </li>
                <li>
                  <span className="icon">✅</span>
                  <span><strong>Syarat Tender &amp; Proyek:</strong> Kerap menjadi syarat teknis dalam dokumen lelang BUMN, kontraktor EPC, dan migas.</span>
                </li>
                <li>
                  <span className="icon">✅</span>
                  <span><strong>Contoh Skema:</strong> Pengawas K3 Migas, POP/POM Pertambangan, Penanggung Jawab Air Limbah (POPAL), Auditor SMK3 &amp; ISO.</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </section>

      {/* ══════════════════════════════════════════════════════════
           4 STEPS REGISTRATION
           ══════════════════════════════════════════════════════════ */}
      <section className="pcat-steps-section">
        <div className="container">
          <div className="section-header text-center">
            <span className="section-eyebrow">Alur Pendaftaran</span>
            <h2 className="section-title">4 Langkah Mudah Mengikuti Pelatihan</h2>
          </div>

          <div className="pcat-steps-grid">
            <div className="pcat-step-card" data-reveal="up" data-reveal-delay="1">
              <div className="pcat-step-num">1</div>
              <h4>Pilih Program &amp; Jadwal</h4>
              <p>Pilih program sertifikasi yang sesuai dengan kebutuhan kualifikasi atau proyek perusahaan Anda.</p>
            </div>
            <div className="pcat-step-card" data-reveal="up" data-reveal-delay="2">
              <div className="pcat-step-num">2</div>
              <h4>Registrasi Dokumen</h4>
              <p>Kirim kelengkapan berkas (KTP, Ijazah, CV, Surat Tugas) via WhatsApp atau email representatif kami.</p>
            </div>
            <div className="pcat-step-card" data-reveal="up" data-reveal-delay="3">
              <div className="pcat-step-num">3</div>
              <h4>Pembinaan &amp; Praktik</h4>
              <p>Ikuti sesi pembinaan interaktif via Zoom atau tatap muka di training center bersama instruktur senior.</p>
            </div>
            <div className="pcat-step-card" data-reveal="up" data-reveal-delay="4">
              <div className="pcat-step-num">4</div>
              <h4>Asesmen &amp; Sertifikat</h4>
              <p>Ujian evaluasi kelulusan &amp; penerbitan sertifikat resmi Kemnaker RI / BNSP berlisensi nasional.</p>
            </div>
          </div>
        </div>
      </section>

      {/* ══════════════════════════════════════════════════════════
           CORPORATE IN-HOUSE CTA BANNER
           ══════════════════════════════════════════════════════════ */}
      <section className="pcat-cta-section">
        <div className="container">
          <div className="pcat-cta-inner">
            <span className="pcat-cta-badge">In-House Training Korporasi</span>
            <h2>Konsultasi Kebutuhan Pelatihan K3 Perusahaan Anda</h2>
            <p>
              Kami melayani pelatihan rombongan in-house training di lokasi pabrik, proyek konstruksi, atau kantor perusahaan Anda di seluruh wilayah Indonesia dengan silabus yang disesuaikan.
            </p>
            <div className="pcat-cta-actions">
              <a
                href="https://wa.me/6287759151278?text=Halo%20Wahana%20Totalita%2C%20kami%20ingin%20mengajukan%20penawaran%20In-House%20Training%20K3%20untuk%20perusahaan"
                target="_blank"
                rel="noopener noreferrer"
                className="btn-primary"
              >
                💬 Minta Proposal Penawaran WhatsApp &rarr;
              </a>
              <Link href="/jadwal/" className="btn-outline-light">
                Lihat Jadwal Terdekat &rarr;
              </Link>
            </div>
          </div>
        </div>
      </section>
    </main>
  );
}
