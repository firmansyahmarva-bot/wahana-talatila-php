'use client';

import React, { useState, useMemo } from 'react';
import Link from 'next/link';
import { ToolItem } from '@/data/tools';

interface ToolsCatalogAppProps {
  tools: ToolItem[];
}

const CATEGORIES = [
  { id: 'all', label: 'Semua Tools' },
  { id: 'lapangan', label: 'Manajemen Risiko & Lapangan' },
  { id: 'kalkulator', label: 'Kalkulator K3 & Finansial' },
  { id: 'regulasi', label: 'Regulasi & Dokumen K3' },
  { id: 'edukasi', label: 'Edukasi & Kampanye K3' },
];

export default function ToolsCatalogApp({ tools }: ToolsCatalogAppProps) {
  const [activeCategory, setActiveCategory] = useState<string>('all');
  const [searchQuery, setSearchQuery] = useState<string>('');
  const [openFaqIndex, setOpenFaqIndex] = useState<number | null>(null);

  const filteredTools = useMemo(() => {
    return tools.filter((t) => {
      // Category filter
      const matchesCat = activeCategory === 'all' || t.category === activeCategory;

      // Search keyword filter
      const q = searchQuery.toLowerCase().trim();
      const matchesSearch =
        !q ||
        t.title.toLowerCase().includes(q) ||
        t.desc.toLowerCase().includes(q) ||
        t.tags.some((tag) => tag.toLowerCase().includes(q)) ||
        t.categoryName.toLowerCase().includes(q) ||
        t.searchKeywords.toLowerCase().includes(q);

      return matchesCat && matchesSearch;
    });
  }, [tools, activeCategory, searchQuery]);

  const toggleFaq = (index: number) => {
    setOpenFaqIndex(openFaqIndex === index ? null : index);
  };

  return (
    <main id="konten-utama" className="tools-hub-page">
      {/* ══════════════════════════════════════════════════════════
           HERO SECTION
           ══════════════════════════════════════════════════════════ */}
      <section className="hub-hero">
        <div className="container">
          <div className="hero-badge">⚡ Direktori Aplikasi &amp; Kalkulator K3</div>
          <h1>
            Kumpulan Tools &amp; Kalkulator <span>K3 Online</span>
          </h1>
          <p>
            Akses gratis ke seluruh aplikasi analisis risiko, generator dokumen keselamatan kerja, dan kalkulator kepatuhan regulasi Kemnaker RI untuk praktisi HSE profesional di seluruh Indonesia.
          </p>
        </div>
      </section>

      {/* ══════════════════════════════════════════════════════════
           SEARCH, FILTERS, AND TOOLS GRID
           ══════════════════════════════════════════════════════════ */}
      <section className="hub-wrapper">
        <div className="container">
          {/* Search Card & Filter Pills */}
          <div className="search-card">
            <div className="search-input-box">
              <span className="search-icon" aria-hidden="true">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5">
                  <circle cx="11" cy="11" r="8" />
                  <line x1="21" y1="21" x2="16.65" y2="16.65" />
                </svg>
              </span>
              <input
                type="search"
                className="hub-search-input"
                placeholder="Cari tools K3: Safety Talk, JSA, HIRADC, FR/SR, Kebisingan, Regulasi..."
                value={searchQuery}
                onChange={(e) => setSearchQuery(e.target.value)}
                aria-label="Pencarian aplikasi dan tools K3"
              />
              {searchQuery && (
                <button
                  type="button"
                  className="search-clear-btn"
                  onClick={() => setSearchQuery('')}
                  aria-label="Hapus kata kunci pencarian"
                >
                  ✕
                </button>
              )}
            </div>

            <div className="category-pills" role="tablist" aria-label="Filter kategori tools K3">
              {CATEGORIES.map((cat) => {
                const count =
                  cat.id === 'all'
                    ? tools.length
                    : tools.filter((t) => t.category === cat.id).length;

                return (
                  <button
                    key={cat.id}
                    type="button"
                    className={`cat-btn ${activeCategory === cat.id ? 'active' : ''}`}
                    onClick={() => setActiveCategory(cat.id)}
                    role="tab"
                    aria-selected={activeCategory === cat.id}
                  >
                    {cat.label} ({count})
                  </button>
                );
              })}
            </div>
          </div>

          {/* Result Count Status */}
          <div style={{ marginBottom: '20px', fontSize: '14px', color: '#64748b', fontWeight: 600 }}>
            Menampilkan <strong>{filteredTools.length}</strong> dari {tools.length} tools keselamatan kerja
            {searchQuery && ` untuk kata kunci "${searchQuery}"`}
          </div>

          {/* Tools Grid */}
          {filteredTools.length === 0 ? (
            <div
              style={{
                background: '#fff',
                padding: '48px 24px',
                borderRadius: '16px',
                textAlign: 'center',
                border: '1px solid #E2E8F0',
                marginBottom: '48px',
              }}
            >
              <div style={{ fontSize: '2.5rem', marginBottom: '12px' }}>🔍</div>
              <h3 style={{ fontSize: '1.25rem', color: '#0D233A', margin: '0 0 8px' }}>
                Tidak Ada Tools yang Cocok
              </h3>
              <p style={{ color: '#64748b', fontSize: '0.95rem', maxWidth: '420px', margin: '0 auto 20px' }}>
                Coba gunakan kata kunci lain atau klik tombol reset untuk menampilkan seluruh koleksi tools K3.
              </p>
              <button
                type="button"
                className="cat-btn active"
                onClick={() => {
                  setActiveCategory('all');
                  setSearchQuery('');
                }}
              >
                Tampilkan Semua Tools
              </button>
            </div>
          ) : (
            <div className="tools-grid">
              {filteredTools.map((tool) => (
                <Link key={tool.id} href={tool.href} className="tool-card">
                  <div className="tool-header">
                    <div
                      className="tool-icon-box"
                      dangerouslySetInnerHTML={{ __html: tool.iconSvg }}
                    />
                    <span className="tool-badge">{tool.badge}</span>
                  </div>
                  <h2 className="tool-title">{tool.title}</h2>
                  <p className="tool-desc">{tool.desc}</p>
                  <div className="tool-footer">
                    <div className="tag-list">
                      {tool.tags.map((tag, idx) => (
                        <span key={idx} className="tool-tag">
                          {tag}
                        </span>
                      ))}
                    </div>
                    <span className="tool-arrow">Buka Tool &rarr;</span>
                  </div>
                </Link>
              ))}
            </div>
          )}

          {/* ══════════════════════════════════════════════════════════
               EDITORIAL & FAQ SECTION (SEO DEPTH)
               ══════════════════════════════════════════════════════════ */}
          <div className="editorial-box">
            <h2 className="editorial-title">
              Pentingnya Digitalisasi Tools K3 dalam Penerapan SMK3 PP 50/2012
            </h2>
            <p className="editorial-p">
              Transformasi digital dalam pengelolaan Keselamatan dan Kesehatan Kerja (K3) kini menjadi kebutuhan fundamental bagi perusahaan di Indonesia. Penggunaan kalkulator dan generator otomatis memungkinkan Ahli K3 Umum, pengawas lapangan, dan komite P2K3 untuk melakukan evaluasi risiko kuantitatif secara cepat, akurat, dan terstandarisasi sesuai regulasi nasional.
            </p>

            <h3 style={{ color: '#0D233A', fontFamily: "'Lexend', sans-serif", fontSize: '1.15rem', margin: '22px 0 10px' }}>
              Keunggulan Implementasi Tools K3 Berbasis Standar Resmi
            </h3>
            <ul style={{ paddingLeft: '22px', color: '#334155', lineHeight: 1.75, marginBottom: '24px' }}>
              <li>
                <strong>Akurasi Perhitungan Hukum:</strong> Menghilangkan risiko kesalahan rumus manual dalam perhitungan Frequency Rate (FR) dan Severity Rate (SR) pada pelaporan triwulan P2K3 ke Dinas Tenaga Kerja.
              </li>
              <li>
                <strong>Standardisasi Form Lapangan:</strong> Menjamin format dokumen Job Safety Analysis (JSA) dan Risk Register mematuhi ketentuan hierarki pengendalian ISO 45001:2018.
              </li>
              <li>
                <strong>Efisiensi Waktu Kerja:</strong> Mempersingkat waktu pembuatan materi Toolbox Meeting harian dan verifikasi kepatuhan dokumen audit SMK3.
              </li>
            </ul>

            {/* FAQ Accordion */}
            <h3 style={{ color: '#0D233A', fontFamily: "'Lexend', sans-serif", fontSize: '1.25rem', margin: '28px 0 16px' }}>
              Tanya Jawab Seputar Tools K3 (FAQ)
            </h3>
            <div className="faq-box">
              <div className={`faq-item ${openFaqIndex === 0 ? 'active' : ''}`}>
                <button
                  type="button"
                  className="faq-q"
                  onClick={() => toggleFaq(0)}
                  aria-expanded={openFaqIndex === 0}
                >
                  <span>Apakah seluruh tools dan kalkulator K3 di situs ini gratis?</span>
                  <span className="faq-icon" aria-hidden="true">▼</span>
                </button>
                <div className="faq-a">
                  Ya, 100% gratis dan dapat digunakan secara bebas oleh praktisi HSE, Ahli K3 Umum, mahasiswa, dan manajemen perusahaan di seluruh Indonesia tanpa perlu registrasi.
                </div>
              </div>

              <div className={`faq-item ${openFaqIndex === 1 ? 'active' : ''}`}>
                <button
                  type="button"
                  className="faq-q"
                  onClick={() => toggleFaq(1)}
                  aria-expanded={openFaqIndex === 1}
                >
                  <span>Apakah hasil perhitungan kalkulator K3 sesuai dengan standar regulasi pemerintah?</span>
                  <span className="faq-icon" aria-hidden="true">▼</span>
                </button>
                <div className="faq-a">
                  Seluruh formula perhitungan dan dokumen yang dihasilkan mengacu langsung pada peraturan perundang-undangan resmi Republik Indonesia, seperti Kepmenaker No. KEP.372/MEN/1989, Permenaker No. 5 Tahun 2018, Permenaker No. 03/MEN/1998, dan PP No. 50 Tahun 2012 tentang Penerapan SMK3.
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
  );
}
