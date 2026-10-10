'use client';

import React, { useState, useMemo } from 'react';
import Link from 'next/link';
import { TrainingProgram } from '@/data/trainings';
import TrainingCard from '@/components/cards/TrainingCard';

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
    <main id="konten-utama" className="pcat-page">
      {/* ══════════════════════════════════════════════════════════
           HERO & SEARCH SECTION
           ══════════════════════════════════════════════════════════ */}
      <section className="pcat-hero">
        <div className="container">
          <div className="pcat-hero-inner">
            <span className="pcat-eyebrow">Direktori Resmi Pelatihan &amp; Sertifikasi K3</span>
            <h1 className="pcat-title">Katalog Pelatihan K3 &amp; Sertifikasi Resmi</h1>
            <p className="pcat-desc">
              Pilihan program sertifikasi KEMNAKER RI &amp; BNSP terlengkap di Indonesia. Tersedia kelas online interaktif, tatap muka di 20 kota, dan in-house training perusahaan.
            </p>

            <div className="pcat-badges">
              <span className="pcat-badge">✔ Kemnaker RI &amp; BNSP</span>
              <span className="pcat-badge">✔ Online &amp; Offline</span>
              <span className="pcat-badge">✔ In-house Perusahaan</span>
              <span className="pcat-badge">✔ Seluruh Indonesia</span>
            </div>

            {/* Elevated Interactive Search */}
            <div className="pcat-search-box">
              <span className="pcat-search-icon" aria-hidden="true">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5">
                  <circle cx="11" cy="11" r="8" />
                  <line x1="21" y1="21" x2="16.65" y2="16.65" />
                </svg>
              </span>
              <input
                type="search"
                className="pcat-search-input"
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
                  className="pcat-search-clear"
                  onClick={() => setSearchQuery('')}
                  aria-label="Hapus pencarian"
                >
                  ✕
                </button>
              )}
            </div>
          </div>
        </div>
      </section>

      {/* ══════════════════════════════════════════════════════════
           CATALOG SECTION & FILTER TABS
           ══════════════════════════════════════════════════════════ */}
      <section className="pcat-catalog-section" id="katalog">
        <div className="container">
          <div className="pcat-catalog-header">
            <div className="pcat-cat-tabs" role="tablist" aria-label="Kategori Pelatihan">
              {CATEGORIES.map((cat) => (
                <button
                  key={cat.id}
                  type="button"
                  className={`pcat-cat-btn ${activeCategory === cat.id ? 'active' : ''}`}
                  onClick={() => {
                    setActiveCategory(cat.id);
                    setVisibleCount(24);
                  }}
                >
                  {cat.label}
                </button>
              ))}
            </div>
            <div className="pcat-results-counter">
              Menampilkan <strong>{filteredTrainings.length}</strong> program
            </div>
          </div>

          {/* Training Cards Grid */}
          <div className="training-grid" id="trainingGrid">
            {displayedTrainings.length === 0 ? (
              <div className="pcat-empty">
                <h3>Program Tidak Ditemukan</h3>
                <p>Tidak ada program pelatihan yang cocok dengan kata kunci &ldquo;{searchQuery}&rdquo;.</p>
                <button
                  type="button"
                  className="btn-primary"
                  onClick={() => {
                    setSearchQuery('');
                    setActiveCategory('all');
                  }}
                >
                  Reset Pencarian
                </button>
              </div>
            ) : (
              displayedTrainings.map((prog) => (
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
              ))
            )}
          </div>

          {/* Load More Button */}
          {visibleCount < filteredTrainings.length && (
            <div className="pcat-load-more">
              <button
                type="button"
                className="btn-outline"
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
