'use client';

import React, { useState, useMemo } from 'react';
import { Search, Filter, BookOpen } from 'lucide-react';
import TrainingCard from '@/components/cards/TrainingCard';
import SectionHeader from '@/components/ui/SectionHeader';
import Button from '@/components/ui/Button';
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
    <section className="py-16 md:py-24 bg-slate-50 border-b border-slate-200/80" id="produk">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {/* Section Header */}
        <SectionHeader
          badgeText="Katalog 40+ Program Resmi"
          title="Program Pelatihan & Sertifikasi K3"
          subtitle="Lembaga pembinaan K3 berlisensi Kemnaker RI & BNSP. Tersedia kelas online interaktif via Zoom, tatap muka di Yogyakarta & 20 kota, serta in-house training perusahaan."
          align="center"
        />

        {/* Filter & Search Bar */}
        <div className="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/90 shadow-sm mb-10">
          <div className="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4">
            
            {/* Search Input */}
            <div className="relative flex-1 max-w-md">
              <Search className="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" />
              <input
                type="search"
                id="catalog-search"
                placeholder="Cari program pelatihan (misal: Ahli K3, POPAL)..."
                autoComplete="off"
                aria-label="Cari program pelatihan"
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
                className="w-full pl-10 pr-4 py-2.5 rounded-xl text-xs sm:text-sm bg-slate-50 border border-slate-200 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#103A5C]/20 transition-all placeholder-slate-400"
              />
            </div>

            {/* Category Filter Chips */}
            <div className="flex flex-wrap items-center gap-2">
              <span className="text-xs font-bold text-slate-400 uppercase tracking-wider mr-1 hidden sm:inline">
                Kategori:
              </span>
              {[
                { key: 'all', label: 'Semua' },
                { key: 'k3', label: 'K3' },
                { key: 'lingkungan', label: 'Lingkungan' },
                { key: 'system-management', label: 'ISO / Sistem' },
                { key: 'mining', label: 'Mining' },
              ].map((cat) => (
                <Button
                  key={cat.key}
                  type="button"
                  size="sm"
                  variant={selectedCat === cat.key ? 'primary' : 'ghost'}
                  onClick={() => setSelectedCat(cat.key)}
                  className={selectedCat !== cat.key ? 'bg-slate-100 hover:bg-slate-200' : ''}
                >
                  {cat.label}
                </Button>
              ))}
            </div>

            {/* Mode Filter Chips */}
            <div className="flex items-center gap-2 pt-2 lg:pt-0 border-t lg:border-t-0 border-slate-100">
              <span className="text-xs font-bold text-slate-400 uppercase tracking-wider mr-1 hidden sm:inline">
                Mode:
              </span>
              {[
                { key: 'all', label: 'Semua Mode' },
                { key: 'online', label: 'Online Zoom' },
                { key: 'offline', label: 'Tatap Muka' },
              ].map((mode) => (
                <Button
                  key={mode.key}
                  type="button"
                  size="sm"
                  variant={selectedMode === mode.key ? 'accent' : 'ghost'}
                  onClick={() => setSelectedMode(mode.key)}
                  className={selectedMode !== mode.key ? 'bg-slate-100 hover:bg-slate-200' : ''}
                >
                  {mode.label}
                </Button>
              ))}
            </div>

          </div>
        </div>

        {/* Training Cards Grid */}
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          {filteredCards.length > 0 ? (
            filteredCards.map((card, idx) => (
              <TrainingCard
                key={idx}
                title={card.title}
                href={card.href}
                imageSrc={card.imageSrc}
                imageAlt={card.imageAlt}
                catBadge={card.category?.toUpperCase()}
                mode={card.mode}
                certification={card.certification}
                features={card.features}
                price={card.price}
                priceUnit={card.priceUnit}
                accentColor={card.accentColor}
              />
            ))
          ) : (
            <div className="col-span-full py-16 text-center bg-white rounded-2xl border border-dashed border-slate-300 p-8">
              <Filter className="w-8 h-8 text-slate-300 mx-auto mb-3" />
              <p className="text-sm font-bold text-slate-700">
                Tidak ada program pelatihan yang sesuai dengan filter pencarian.
              </p>
              <Button
                type="button"
                size="sm"
                variant="primary"
                onClick={() => {
                  setSelectedCat('all');
                  setSelectedMode('all');
                  setSearchTerm('');
                }}
                className="mt-4"
              >
                Reset Semua Filter
              </Button>
            </div>
          )}
        </div>

      </div>
    </section>
  );
}
