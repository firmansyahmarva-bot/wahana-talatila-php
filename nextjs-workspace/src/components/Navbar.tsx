'use client';

import React, { useState } from 'react';
import Link from 'next/link';
import Image from 'next/image';

export default function Navbar() {
  const [searchQuery, setSearchQuery] = useState('');
  const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);
  const [openDropdown, setOpenDropdown] = useState<string | null>(null);

  const handleSearch = (e: React.FormEvent) => {
    e.preventDefault();
    if (searchQuery.trim()) {
      window.location.href = `/pelatihan/?q=${encodeURIComponent(searchQuery.trim())}`;
    }
  };

  const toggleDropdown = (name: string) => {
    setOpenDropdown(openDropdown === name ? null : name);
  };

  return (
    <nav className="navbar" id="navbar">
      <div className="container nav-inner">
        {/* Logo */}
        <Link href="/" className="nav-logo" aria-label="Wahana Totalita Konsultan">
          <span className="nav-logo-icon" style={{ display: 'inline-flex', alignItems: 'center', justifyContent: 'center', width: 36, height: 36, borderRadius: 8, background: '#059669', color: '#fff', fontWeight: 800, fontSize: 18 }}>
            W
          </span>
          <span className="nav-logo-text" style={{ marginLeft: 8 }}>
            <strong>Wahana Totalita</strong>
          </span>
        </Link>

        {/* Search Input */}
        <form onSubmit={handleSearch} className="nav-search" role="search">
          <span className="nav-search-icon" aria-hidden="true">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5">
              <circle cx="11" cy="11" r="8" />
              <line x1="21" y1="21" x2="16.65" y2="16.65" />
            </svg>
          </span>
          <input
            type="search"
            className="nav-search-input"
            placeholder="Cari pelatihan..."
            value={searchQuery}
            onChange={(e) => setSearchQuery(e.target.value)}
            aria-label="Cari pelatihan"
          />
          <button type="submit" className="nav-search-btn" aria-label="Cari">
            <span className="nav-search-btn-label">Cari</span>
          </button>
        </form>

        {/* Desktop Navigation Links */}
        <ul className={`nav-links ${isMobileMenuOpen ? 'mobile-open' : ''}`} id="nav-links">
          <li>
            <Link href="/pelatihan/">Pelatihan</Link>
          </li>
          <li>
            <Link href="/ahli-k3-umum/">Ahli K3 Umum</Link>
          </li>
          <li>
            <Link href="/jadwal/">Jadwal</Link>
          </li>
          
          {/* Bidang & Kota Dropdown */}
          <li className="nav-dropdown" onMouseEnter={() => setOpenDropdown('bidang')} onMouseLeave={() => setOpenDropdown(null)}>
            <button 
              className="nav-dropdown-toggle"
              onClick={() => toggleDropdown('bidang')}
              type="button"
            >
              Bidang &amp; Kota
              <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="3" style={{ verticalAlign: 'middle', marginLeft: 3 }}>
                <polyline points="6 9 12 15 18 9" />
              </svg>
            </button>
            {openDropdown === 'bidang' && (
              <div className="nav-dropdown-menu" style={{ minWidth: 540 }}>
                <div className="nav-dropdown-grid" style={{ display: 'grid', gridTemplateColumns: 'repeat(2, 1fr)', gap: 16 }}>
                  <div className="nav-dropdown-col">
                    <div className="nav-dropdown-heading" style={{ fontWeight: 700, marginBottom: 8 }}>🏭 Sektor Keahlian K3</div>
                    <Link href="/k3-konstruksi/" className="nav-dropdown-item">
                      <span><strong>K3 Konstruksi</strong><br /><small>Gedung, sipil &amp; infrastruktur</small></span>
                    </Link>
                    <Link href="/k3-migas/" className="nav-dropdown-item">
                      <span><strong>K3 Minyak &amp; Gas</strong><br /><small>Hulu-hilir &amp; petrokimia</small></span>
                    </Link>
                    <Link href="/k3-listrik/" className="nav-dropdown-item">
                      <span><strong>K3 Listrik &amp; Energi</strong><br /><small>Pembangkit &amp; instalasi</small></span>
                    </Link>
                    <Link href="/k3-kimia/" className="nav-dropdown-item">
                      <span><strong>K3 Kimia &amp; B3</strong><br /><small>Hazardous material &amp; lab</small></span>
                    </Link>
                    <Link href="/keselamatan-kerja/" className="nav-dropdown-item" style={{ marginTop: 6, borderTop: '1px solid #e2e8f0', paddingTop: 8 }}>
                      <span><strong>Semua Bidang K3 &rarr;</strong></span>
                    </Link>
                  </div>

                  <div className="nav-dropdown-col">
                    <div className="nav-dropdown-heading" style={{ fontWeight: 700, marginBottom: 8 }}>📍 Kota Pelatihan Resmi</div>
                    <Link href="/kota/yogyakarta/" className="nav-dropdown-item">
                      <span><strong>Yogyakarta (Pusat)</strong><br /><small>Training Center &amp; Tatap Muka</small></span>
                    </Link>
                    <Link href="/kota/jakarta/" className="nav-dropdown-item">
                      <span><strong>DKI Jakarta</strong><br /><small>Konstruksi, Migas &amp; Korporasi</small></span>
                    </Link>
                    <Link href="/kota/surabaya/" className="nav-dropdown-item">
                      <span><strong>Surabaya</strong><br /><small>Maritim, Manufaktur &amp; Crane</small></span>
                    </Link>
                    <Link href="/kota/bandung/" className="nav-dropdown-item">
                      <span><strong>Bandung</strong><br /><small>Manufaktur &amp; Industri</small></span>
                    </Link>
                  </div>
                </div>
              </div>
            )}
          </li>

          <li>
            <Link href="/artikel/">Artikel</Link>
          </li>
          <li>
            <Link href="/perusahaan/">Perusahaan</Link>
          </li>
        </ul>

        {/* CTA Button */}
        <div className="nav-cta">
          <a
            href="https://wa.me/6287759151278?text=Halo%20Admin%20Wahana%20Totalita,%20saya%20ingin%20tanya%20jadwal%20dan%20biaya%20pelatihan"
            target="_blank"
            rel="noopener noreferrer"
            className="btn btn-primary nav-wa-btn"
          >
            Hubungi Kami
          </a>
        </div>
      </div>
    </nav>
  );
}
