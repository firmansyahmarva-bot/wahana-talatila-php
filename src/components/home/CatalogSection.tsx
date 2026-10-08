'use client';

import React, { useState, useMemo } from 'react';
import TrainingCard from '@/components/cards/TrainingCard';
import catalogData from '../../../data/home_catalog.json';

export default function CatalogSection() {
  const [selectedCat, setSelectedCat] = useState('all');
  const [selectedMode, setSelectedMode] = useState('all');
  const [searchTerm, setSearchTerm] = useState('');

  const filteredCards = useMemo(() => {
    return catalogData.filter((card) => {
      // Category filter
      if (selectedCat !== 'all' && card.category !== selectedCat) {
        return false;
      }
      // Mode filter
      if (selectedMode !== 'all' && card.modeKey !== selectedMode) {
        return false;
      }
      // Search filter
      if (searchTerm.trim()) {
        const query = searchTerm.toLowerCase();
        const matchesTitle = card.title.toLowerCase().includes(query);
        const matchesCert = card.certification?.toLowerCase().includes(query);
        if (!matchesTitle && !matchesCert) {
          return false;
        }
      }
      return true;
    });
  }, [selectedCat, selectedMode, searchTerm]);

  return (
    <section className="section-catalog" id="produk">
      <div className="container">
        <div className="section-header">
          <p className="section-eyebrow">Katalog Program</p>
          <h2 className="section-title">Program Pelatihan &amp; Sertifikasi K3</h2>
          <p className="section-subtitle">
            Lembaga pelatihan K3 resmi dan sertifikasi profesi Kemnaker RI &amp; BNSP. Tersedia
            kelas online interaktif via Zoom, kelas tatap muka di Yogyakarta, dan in-house
            training perusahaan di seluruh Indonesia.
          </p>
        </div>

        <div className="filter-bar">
          <div className="catalog-search-wrap">
            <svg
              width="16"
              height="16"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              strokeWidth="2"
            >
              <circle cx="11" cy="11" r="8" />
              <line x1="21" y1="21" x2="16.65" y2="16.65" />
            </svg>
            <input
              type="search"
              id="catalog-search"
              placeholder="Cari program pelatihan..."
              autoComplete="off"
              aria-label="Cari program pelatihan"
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
            />
          </div>

          <div className="filter-group" id="filter-cat">
            <button
              className={`filter-btn ${selectedCat === 'all' ? 'active' : ''}`}
              onClick={() => setSelectedCat('all')}
            >
              Semua
            </button>
            <button
              className={`filter-btn ${selectedCat === 'k3' ? 'active' : ''}`}
              onClick={() => setSelectedCat('k3')}
            >
              K3
            </button>
            <button
              className={`filter-btn ${selectedCat === 'lingkungan' ? 'active' : ''}`}
              onClick={() => setSelectedCat('lingkungan')}
            >
              Lingkungan
            </button>
            <button
              className={`filter-btn ${selectedCat === 'system-management' ? 'active' : ''}`}
              onClick={() => setSelectedCat('system-management')}
            >
              System Management
            </button>
            <button
              className={`filter-btn ${selectedCat === 'mining' ? 'active' : ''}`}
              onClick={() => setSelectedCat('mining')}
            >
              Mining
            </button>
          </div>

          <div className="filter-group" id="filter-mode">
            <button
              className={`filter-mode ${selectedMode === 'all' ? 'active' : ''}`}
              onClick={() => setSelectedMode('all')}
            >
              Semua
            </button>
            <button
              className={`filter-mode ${selectedMode === 'online' ? 'active' : ''}`}
              onClick={() => setSelectedMode('online')}
            >
              Online
            </button>
            <button
              className={`filter-mode ${selectedMode === 'offline' ? 'active' : ''}`}
              onClick={() => setSelectedMode('offline')}
            >
              Tatap Muka
            </button>
          </div>
        </div>

        <div className="training-grid" id="training-grid">
          {filteredCards.length > 0 ? (
            filteredCards.map((card, idx) => (
              <TrainingCard
                key={idx}
                title={card.title}
                href={card.href}
                imageSrc={card.imageSrc}
                imageAlt={card.imageAlt}
                mode={card.mode}
                certification={card.certification}
                features={card.features}
                price={card.price}
                priceUnit={card.priceUnit}
                accentColor={card.accentColor}
              />
            ))
          ) : (
            <p style={{ textAlign: 'center', gridColumn: '1 / -1', padding: '32px', color: '#64748b' }}>
              Tidak ada program pelatihan yang sesuai dengan filter pencarian.
            </p>
          )}
        </div>
      </div>
    </section>
  );
}
