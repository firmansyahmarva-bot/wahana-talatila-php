'use client';

import React, { useState, useMemo, useEffect, useRef } from 'react';
import ArticleCard from '@/components/cards/ArticleCard';
import { ArticleItem } from '@/data/articles';

interface ArticleCatalogAppProps {
  articles: ArticleItem[];
}

const ITEMS_PER_PAGE = 12;

export default function ArticleCatalogApp({ articles }: ArticleCatalogAppProps) {
  const [selectedCategory, setSelectedCategory] = useState<string>('all');
  const [searchQuery, setSearchQuery] = useState<string>('');
  const [currentPage, setCurrentPage] = useState<number>(1);
  const layoutTopRef = useRef<HTMLDivElement>(null);

  // Derive categories and counts dynamically
  const { categories, totalCount } = useMemo(() => {
    const counts: Record<string, { count: number; color: string }> = {};
    for (const a of articles) {
      if (!counts[a.category]) {
        counts[a.category] = { count: 0, color: a.categoryColor };
      }
      counts[a.category].count += 1;
    }
    const list = Object.entries(counts)
      .map(([name, val]) => ({
        name,
        count: val.count,
        color: val.color,
      }))
      .sort((a, b) => b.count - a.count);

    return { categories: list, totalCount: articles.length };
  }, [articles]);

  // Filter articles based on category and search query
  const filteredArticles = useMemo(() => {
    return articles.filter((a) => {
      // Category filter
      const matchesCategory =
        selectedCategory === 'all' ||
        a.category.toLowerCase() === selectedCategory.toLowerCase();

      // Search keyword
      const q = searchQuery.toLowerCase().trim();
      const matchesSearch =
        !q ||
        a.title.toLowerCase().includes(q) ||
        a.excerpt.toLowerCase().includes(q) ||
        a.category.toLowerCase().includes(q);

      return matchesCategory && matchesSearch;
    });
  }, [articles, selectedCategory, searchQuery]);

  // Reset page to 1 whenever filters change
  useEffect(() => {
    setCurrentPage(1);
  }, [selectedCategory, searchQuery]);

  // Calculate pagination
  const totalPages = Math.max(1, Math.ceil(filteredArticles.length / ITEMS_PER_PAGE));
  const currentArticles = useMemo(() => {
    const start = (currentPage - 1) * ITEMS_PER_PAGE;
    return filteredArticles.slice(start, start + ITEMS_PER_PAGE);
  }, [filteredArticles, currentPage]);

  const handlePageChange = (page: number) => {
    if (page < 1 || page > totalPages || page === currentPage) return;
    setCurrentPage(page);
    if (layoutTopRef.current) {
      layoutTopRef.current.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  };

  const handleResetFilters = () => {
    setSelectedCategory('all');
    setSearchQuery('');
    setCurrentPage(1);
  };

  const isFiltered = selectedCategory !== 'all' || searchQuery.trim() !== '';

  return (
    <main id="konten-utama">
      {/* ══════════════════════════════════════════════════════════
           HERO SECTION
           ══════════════════════════════════════════════════════════ */}
      <section className="ak-hero">
        <div className="container">
          <h1>
            Artikel &amp; Panduan <em>K3 &amp; Lingkungan</em>
          </h1>
          <p>
            Tips praktis, panduan sertifikasi, dan update regulasi K3 terbaru untuk profesional industri Indonesia.
          </p>

          {/* Search Form */}
          <form
            className="ak-search-form"
            onSubmit={(e) => e.preventDefault()}
            role="search"
            aria-label="Pencarian artikel K3"
          >
            <input
              type="text"
              name="q"
              placeholder="Cari artikel, regulasi, atau sertifikasi..."
              value={searchQuery}
              onChange={(e) => setSearchQuery(e.target.value)}
              autoComplete="off"
              aria-label="Kata kunci pencarian artikel"
            />
            {searchQuery ? (
              <button
                type="button"
                onClick={() => setSearchQuery('')}
                aria-label="Hapus kata kunci pencarian"
                style={{
                  background: 'none',
                  border: 'none',
                  cursor: 'pointer',
                  color: '#6b7280',
                  fontSize: '18px',
                  padding: '0 12px',
                  display: 'flex',
                  alignItems: 'center',
                }}
              >
                ✕
              </button>
            ) : (
              <button type="submit" aria-label="Cari artikel">
                <svg
                  width="18"
                  height="18"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  strokeWidth="2.5"
                  aria-hidden="true"
                >
                  <circle cx="11" cy="11" r="8" />
                  <line x1="21" y1="21" x2="16.65" y2="16.65" />
                </svg>
              </button>
            )}
          </form>
        </div>
      </section>

      {/* ══════════════════════════════════════════════════════════
           LAYOUT: SIDEBAR + ARTICLE GRID
           ══════════════════════════════════════════════════════════ */}
      <div className="ak-layout container" ref={layoutTopRef}>
        {/* FILTER SIDEBAR */}
        <aside className="ak-sidebar" aria-label="Kategori artikel">
          <div className="ak-sidebar-card">
            <h3>Kategori</h3>
            <button
              type="button"
              className={`ak-cat-link ${selectedCategory === 'all' ? 'active' : ''}`}
              onClick={() => setSelectedCategory('all')}
              style={{ width: '100%', textAlign: 'left', background: selectedCategory === 'all' ? undefined : 'transparent', border: 'none', cursor: 'pointer' }}
            >
              <span>Semua</span> <span>{totalCount}</span>
            </button>
            {categories.map((cat) => (
              <button
                key={cat.name}
                type="button"
                className={`ak-cat-link ${selectedCategory === cat.name ? 'active' : ''}`}
                onClick={() => setSelectedCategory(cat.name)}
                style={
                  {
                    width: '100%',
                    textAlign: 'left',
                    background: selectedCategory === cat.name ? undefined : 'transparent',
                    border: 'none',
                    cursor: 'pointer',
                    '--cat-color': cat.color,
                  } as React.CSSProperties
                }
              >
                <span>{cat.name}</span> <span>{cat.count}</span>
              </button>
            ))}
          </div>

          {/* CTA Card */}
          <div className="ak-sidebar-cta">
            <div className="ak-cta-icon">🎓</div>
            <h4>Butuh Sertifikasi K3?</h4>
            <p>Konsultasi gratis dengan tim ahli kami via WhatsApp.</p>
            <a
              href="https://wa.me/6287759151278?text=Halo%2C%20saya%20ingin%20konsultasi%20tentang%20pelatihan%20K3"
              className="ak-cta-btn"
              target="_blank"
              rel="noopener noreferrer"
            >
              💬 Chat WhatsApp
            </a>
          </div>
        </aside>

        {/* MAIN ARTICLES CONTENT */}
        <div className="ak-main">
          {/* Active Filter Bar */}
          <div className="ak-filter-info">
            <span>
              {selectedCategory === 'all' ? 'Semua Topik' : `Kategori: ${selectedCategory}`}
              {searchQuery.trim() && ` • Cari: "${searchQuery}"`}
            </span>
            {isFiltered && (
              <button
                type="button"
                className="ak-clear-filter"
                onClick={handleResetFilters}
                style={{ background: 'none', border: 'none', cursor: 'pointer', padding: 0 }}
              >
                Reset Filter ✕
              </button>
            )}
            <span className="ak-result-count">
              Menampilkan {filteredArticles.length} artikel
            </span>
          </div>

          {/* Article Grid */}
          {currentArticles.length === 0 ? (
            <div
              style={{
                background: '#fff',
                padding: '48px 24px',
                borderRadius: '16px',
                textAlign: 'center',
                border: '1px solid rgba(0,0,0,0.06)',
              }}
            >
              <div style={{ fontSize: '2.5rem', marginBottom: '12px' }}>🔍</div>
              <h3 style={{ fontSize: '1.25rem', color: '#103A5C', margin: '0 0 8px' }}>
                Tidak Ada Artikel yang Ditemukan
              </h3>
              <p style={{ color: '#64748b', fontSize: '0.95rem', maxWidth: '420px', margin: '0 auto 20px' }}>
                Coba gunakan kata kunci lain atau klik tombol reset untuk menampilkan seluruh artikel K3.
              </p>
              <button
                type="button"
                className="btn-primary"
                onClick={handleResetFilters}
                style={{
                  background: '#103A5C',
                  color: '#fff',
                  border: 'none',
                  padding: '10px 24px',
                  borderRadius: '8px',
                  fontWeight: 600,
                  cursor: 'pointer',
                }}
              >
                Tampilkan Semua Artikel
              </button>
            </div>
          ) : (
            <div className="ak-grid">
              {currentArticles.map((article, idx) => {
                const isFeatured =
                  currentPage === 1 && idx === 0 && selectedCategory === 'all' && !searchQuery.trim();

                return (
                  <ArticleCard
                    key={article.id || article.slug}
                    title={article.title}
                    href={article.href}
                    imageSrc={article.imageSrc}
                    imageAlt={article.imageAlt}
                    category={article.category}
                    categoryColor={article.categoryColor}
                    excerpt={article.excerpt}
                    date={article.dateDisplay}
                    readingTime={article.readingTime}
                    featured={isFeatured}
                    headingLevel="h2"
                  />
                );
              })}
            </div>
          )}

          {/* Pagination */}
          {totalPages > 1 && (
            <nav className="ak-pagination" aria-label="Navigasi Halaman Artikel">
              {currentPage > 1 && (
                <button
                  type="button"
                  className="ak-page-btn"
                  onClick={() => handlePageChange(currentPage - 1)}
                  aria-label="Halaman sebelumnya"
                >
                  &larr;
                </button>
              )}

              {Array.from({ length: totalPages }, (_, i) => i + 1).map((pageNum) => {
                // Show first, last, current, and surrounding pages
                const isEdge = pageNum === 1 || pageNum === totalPages;
                const isNearby = Math.abs(pageNum - currentPage) <= 2;

                if (!isEdge && !isNearby) {
                  // Ellipsis
                  if (pageNum === 2 || pageNum === totalPages - 1) {
                    return (
                      <span
                        key={pageNum}
                        style={{ display: 'inline-flex', alignItems: 'center', padding: '0 4px', color: '#9ca3af' }}
                      >
                        ...
                      </span>
                    );
                  }
                  return null;
                }

                return (
                  <button
                    key={pageNum}
                    type="button"
                    className={`ak-page-btn ${currentPage === pageNum ? 'active' : ''}`}
                    onClick={() => handlePageChange(pageNum)}
                    aria-current={currentPage === pageNum ? 'page' : undefined}
                    aria-label={`Halaman ${pageNum}`}
                  >
                    {pageNum}
                  </button>
                );
              })}

              {currentPage < totalPages && (
                <button
                  type="button"
                  className="ak-page-btn"
                  onClick={() => handlePageChange(currentPage + 1)}
                  aria-label="Halaman selanjutnya"
                >
                  &rarr;
                </button>
              )}
            </nav>
          )}
        </div>
      </div>
    </main>
  );
}
