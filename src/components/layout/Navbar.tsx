'use client';

import React, { useState, useEffect } from 'react';
import Link from 'next/link';
import { usePathname } from 'next/navigation';

export default function Navbar() {
  const [isScrolled, setIsScrolled] = useState(false);
  const [menuOpen, setMenuOpen] = useState(false);
  const [openDropdown, setOpenDropdown] = useState<string | null>(null);
  const [searchQuery, setSearchQuery] = useState('');
  const pathname = usePathname();

  useEffect(() => {
    const handleScroll = () => {
      setIsScrolled(window.scrollY > 20);
    };
    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll();
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  // Close mobile menu on route change
  useEffect(() => {
    setMenuOpen(false);
    setOpenDropdown(null);
  }, [pathname]);

  const toggleDropdown = (name: string, e: React.MouseEvent) => {
    if (window.innerWidth <= 900) {
      e.preventDefault();
      setOpenDropdown(openDropdown === name ? null : name);
    }
  };

  const isLightPage = pathname !== '/' && !pathname.startsWith('/zh');

  return (
    <nav
      className={`navbar ${isScrolled ? 'scrolled' : ''} ${
        !isScrolled && isLightPage ? 'on-light-hero' : ''
      }`}
      id="navbar"
    >
      <div className="container nav-inner">
        {/* Brand Logo */}
        <Link
          href="/"
          className="nav-logo"
          aria-label="Wahana Totalita Konsultan — Pelatihan K3 & Sertifikasi Resmi"
        >
          <img
            src="/assets/img/logo-wt.png"
            alt="Wahana Totalita Konsultan"
            className="nav-logo-img"
            width={44}
            height={44}
            decoding="async"
            style={{ height: '44px', width: 'auto', display: 'block', borderRadius: '8px' }}
          />
          <span className="nav-logo-text">
            <strong>Wahana Totalita Konsultan</strong>
          </span>
        </Link>

        {/* Unified Search Form */}
        <form
          action="/pelatihan/"
          method="get"
          className="nav-search"
          id="nav-search-form"
          role="search"
          onSubmit={(e) => {
            if (!searchQuery.trim()) e.preventDefault();
          }}
        >
          <span className="nav-search-icon" aria-hidden="true">
            <svg
              width="15"
              height="15"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              strokeWidth="2.5"
            >
              <circle cx="11" cy="11" r="8" />
              <line x1="21" y1="21" x2="16.65" y2="16.65" />
            </svg>
          </span>
          <input
            type="search"
            name="q"
            className="nav-search-input"
            placeholder="Cari pelatihan..."
            aria-label="Cari pelatihan"
            autoComplete="off"
            value={searchQuery}
            onChange={(e) => setSearchQuery(e.target.value)}
          />
          <button type="submit" className="nav-search-btn" aria-label="Cari">
            <span className="nav-search-btn-label">Cari</span>
            <svg
              className="nav-search-btn-icon"
              width="14"
              height="14"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              strokeWidth="2.5"
            >
              <circle cx="11" cy="11" r="8" />
              <line x1="21" y1="21" x2="16.65" y2="16.65" />
            </svg>
          </button>
        </form>

        {/* Navigation Links */}
        <ul className={`nav-links ${menuOpen ? 'open' : ''}`} id="nav-links">
          <li>
            <Link href="/pelatihan/">Pelatihan</Link>
          </li>
          <li>
            <Link href="/ahli-k3-umum/">Ahli K3 Umum</Link>
          </li>
          <li>
            <Link href="/jadwal/">Jadwal</Link>
          </li>

          {/* Bidang & Wilayah Dropdown */}
          <li className={`nav-dropdown ${openDropdown === 'bidang' ? 'open' : ''}`}>
            <Link
              href="/keselamatan-kerja/"
              className="nav-dropdown-toggle"
              aria-haspopup="true"
              aria-expanded={openDropdown === 'bidang'}
              onClick={(e) => toggleDropdown('bidang', e)}
            >
              Bidang &amp; Kota
              <svg
                width="10"
                height="10"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                strokeWidth="3"
                style={{ verticalAlign: 'middle', marginLeft: '3px' }}
              >
                <polyline points="6 9 12 15 18 9" />
              </svg>
            </Link>
            <div className="nav-dropdown-menu" role="menu" style={{ minWidth: '540px' }}>
              <div
                className="nav-dropdown-grid"
                style={{ gridTemplateColumns: 'repeat(2, 1fr)' }}
              >
                <div className="nav-dropdown-col">
                  <div className="nav-dropdown-heading">🏭 Sektor Keahlian K3</div>
                  <Link href="/k3-konstruksi/" className="nav-dropdown-item">
                    <span className="nav-di-icon">🏗️</span>
                    <span>
                      <strong>K3 Konstruksi</strong>
                      <br />
                      <small>Gedung, sipil &amp; infrastruktur</small>
                    </span>
                  </Link>
                  <Link href="/k3-migas/" className="nav-dropdown-item">
                    <span className="nav-di-icon">🛢️</span>
                    <span>
                      <strong>K3 Minyak &amp; Gas</strong>
                      <br />
                      <small>Hulu-hilir &amp; petrokimia</small>
                    </span>
                  </Link>
                  <Link href="/k3-listrik/" className="nav-dropdown-item">
                    <span className="nav-di-icon">⚡</span>
                    <span>
                      <strong>K3 Listrik &amp; Energi</strong>
                      <br />
                      <small>Pembangkit &amp; instalasi</small>
                    </span>
                  </Link>
                  <Link href="/k3-kimia/" className="nav-dropdown-item">
                    <span className="nav-di-icon">🧪</span>
                    <span>
                      <strong>K3 Kimia &amp; B3</strong>
                      <br />
                      <small>Hazardous material &amp; lab</small>
                    </span>
                  </Link>
                  <Link href="/k3-ketinggian/" className="nav-dropdown-item">
                    <span className="nav-di-icon">🧗</span>
                    <span>
                      <strong>Bekerja di Ketinggian</strong>
                      <br />
                      <small>TKBT, TKPK &amp; scaffolding</small>
                    </span>
                  </Link>
                  <Link href="/k3-pertambangan/" className="nav-dropdown-item">
                    <span className="nav-di-icon">⛏️</span>
                    <span>
                      <strong>K3 Pertambangan</strong>
                      <br />
                      <small>POP, POM, POU &amp; minerba</small>
                    </span>
                  </Link>
                  <Link href="/k3-lingkungan/" className="nav-dropdown-item">
                    <span className="nav-di-icon">🌿</span>
                    <span>
                      <strong>K3 Lingkungan &amp; AMDAL</strong>
                      <br />
                      <small>POPAL, PLB3 &amp; limbah</small>
                    </span>
                  </Link>
                  <Link href="/k3-rumah-sakit/" className="nav-dropdown-item">
                    <span className="nav-di-icon">🏥</span>
                    <span>
                      <strong>K3 Rumah Sakit &amp; Faskes</strong>
                      <br />
                      <small>Akreditasi &amp; biosafety</small>
                    </span>
                  </Link>
                  <Link
                    href="/keselamatan-kerja/"
                    className="nav-dropdown-item"
                    style={{
                      marginTop: '6px',
                      borderTop: '1px solid #e2e8f0',
                      paddingTop: '8px',
                    }}
                  >
                    <span className="nav-di-icon">👉</span>
                    <span>
                      <strong>Semua 23 Bidang K3 &rarr;</strong>
                      <br />
                      <small>Direktori lengkap sektor</small>
                    </span>
                  </Link>
                </div>

                <div className="nav-dropdown-col">
                  <div className="nav-dropdown-heading">📍 Kota Pelatihan Resmi</div>
                  <Link href="/pelatihan-k3-yogyakarta/" className="nav-dropdown-item">
                    <span className="nav-di-icon">🏢</span>
                    <span>
                      <strong>Yogyakarta (Pusat)</strong>
                      <br />
                      <small>Training Center &amp; Tatap Muka</small>
                    </span>
                  </Link>
                  <Link href="/pelatihan-k3-jakarta/" className="nav-dropdown-item">
                    <span className="nav-di-icon">🌆</span>
                    <span>
                      <strong>DKI Jakarta</strong>
                      <br />
                      <small>Konstruksi, Migas &amp; Korporasi</small>
                    </span>
                  </Link>
                  <Link href="/pelatihan-k3-surabaya/" className="nav-dropdown-item">
                    <span className="nav-di-icon">🚢</span>
                    <span>
                      <strong>Surabaya</strong>
                      <br />
                      <small>Maritim, Manufaktur &amp; Crane</small>
                    </span>
                  </Link>
                  <Link href="/pelatihan-k3-bandung/" className="nav-dropdown-item">
                    <span className="nav-di-icon">🏭</span>
                    <span>
                      <strong>Bandung</strong>
                      <br />
                      <small>Tekstil, Farmasi &amp; Industri</small>
                    </span>
                  </Link>
                  <Link href="/pelatihan-k3-cilegon/" className="nav-dropdown-item">
                    <span className="nav-di-icon">⚙️</span>
                    <span>
                      <strong>Cilegon &amp; Serang</strong>
                      <br />
                      <small>Baja, Petrokimia &amp; Pelabuhan</small>
                    </span>
                  </Link>
                  <Link href="/pelatihan-k3-balikpapan/" className="nav-dropdown-item">
                    <span className="nav-di-icon">🛢️</span>
                    <span>
                      <strong>Balikpapan &amp; IKN</strong>
                      <br />
                      <small>Migas, Logistik &amp; Tambang</small>
                    </span>
                  </Link>
                  <Link href="/pelatihan-k3-semarang/" className="nav-dropdown-item">
                    <span className="nav-di-icon">🏗️</span>
                    <span>
                      <strong>Semarang</strong>
                      <br />
                      <small>Kawasan Kendal &amp; Pelabuhan</small>
                    </span>
                  </Link>
                  <Link href="/pelatihan-k3-medan/" className="nav-dropdown-item">
                    <span className="nav-di-icon">🌴</span>
                    <span>
                      <strong>Medan &amp; Sumatera</strong>
                      <br />
                      <small>Perkebunan Sawit &amp; Pabrik</small>
                    </span>
                  </Link>
                  <Link
                    href="/kota/"
                    className="nav-dropdown-item"
                    style={{
                      marginTop: '6px',
                      borderTop: '1px solid #e2e8f0',
                      paddingTop: '8px',
                    }}
                  >
                    <span className="nav-di-icon">📍</span>
                    <span>
                      <strong>Semua 20 Kota Pelatihan &rarr;</strong>
                      <br />
                      <small>Buka direktori lengkap kota</small>
                    </span>
                  </Link>
                </div>
              </div>
            </div>
          </li>

          {/* Platform K3 Dropdown */}
          <li className={`nav-dropdown ${openDropdown === 'platform' ? 'open' : ''}`}>
            <a
              href="#"
              className="nav-dropdown-toggle"
              aria-haspopup="true"
              aria-expanded={openDropdown === 'platform'}
              onClick={(e) => toggleDropdown('platform', e)}
            >
              Platform K3
              <svg
                width="10"
                height="10"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                strokeWidth="3"
                style={{ verticalAlign: 'middle', marginLeft: '3px' }}
              >
                <polyline points="6 9 12 15 18 9" />
              </svg>
            </a>
            <div className="nav-dropdown-menu" role="menu">
              <div className="nav-dropdown-grid">
                <div className="nav-dropdown-col">
                  <div className="nav-dropdown-heading">📚 Referensi K3</div>
                  <Link href="/resources/" className="nav-dropdown-item">
                    <span className="nav-di-icon">📄</span>
                    <span>
                      <strong>Resources</strong>
                      <br />
                      <small>Panduan &amp; template K3</small>
                    </span>
                  </Link>
                  <Link href="/glosarium/" className="nav-dropdown-item">
                    <span className="nav-di-icon">📖</span>
                    <span>
                      <strong>Glosarium K3</strong>
                      <br />
                      <small>Kamus istilah K3 &amp; HSE</small>
                    </span>
                  </Link>
                  <Link href="/insiden/" className="nav-dropdown-item">
                    <span className="nav-di-icon">⚠️</span>
                    <span>
                      <strong>Database Insiden</strong>
                      <br />
                      <small>Kasus kecelakaan kerja RI</small>
                    </span>
                  </Link>
                </div>

                <div className="nav-dropdown-col">
                  <div className="nav-dropdown-heading">🛠️ Tools Gratis</div>
                  <Link href="/tools/" className="nav-dropdown-item">
                    <span className="nav-di-icon">🧮</span>
                    <span>
                      <strong>Tools K3 Online</strong>
                      <br />
                      <small>Kalkulator, JSA, Risk Matrix</small>
                    </span>
                  </Link>
                  <Link href="/tools/ai-analyzer" className="nav-dropdown-item">
                    <span className="nav-di-icon">🤖</span>
                    <span>
                      <strong>AI Analyzer Dokumen</strong>
                      <br />
                      <small>Analisis dokumen K3 gratis</small>
                    </span>
                  </Link>
                  <Link href="/verifikasi/" className="nav-dropdown-item">
                    <span className="nav-di-icon">✅</span>
                    <span>
                      <strong>Verifikasi Sertifikat</strong>
                      <br />
                      <small>Cek keaslian sertifikat</small>
                    </span>
                  </Link>
                </div>

                <div className="nav-dropdown-col">
                  <div className="nav-dropdown-heading">🤝 Komunitas</div>
                  <Link href="/forum/" className="nav-dropdown-item">
                    <span className="nav-di-icon">💬</span>
                    <span>
                      <strong>Forum Diskusi K3</strong>
                      <br />
                      <small>Tanya jawab &amp; share ilmu</small>
                    </span>
                  </Link>
                  <Link href="/lowongan/" className="nav-dropdown-item">
                    <span className="nav-di-icon">💼</span>
                    <span>
                      <strong>Lowongan HSE</strong>
                      <br />
                      <small>Info kerja K3 &amp; HSE</small>
                    </span>
                  </Link>
                  <Link href="/workplace/" className="nav-dropdown-item">
                    <span className="nav-di-icon">🏢</span>
                    <span>
                      <strong>Workplace K3 App</strong>
                      <br />
                      <small>Kelola K3 perusahaan</small>
                    </span>
                  </Link>
                </div>
              </div>
            </div>
          </li>

          <li>
            <Link href="/pelatihan/ak3-bnsp/">AK3 BNSP</Link>
          </li>
          <li>
            <Link href="/artikel/">Artikel</Link>
          </li>
          <li>
            <Link href="/perusahaan#kontak">Kontak</Link>
          </li>
        </ul>

        {/* WhatsApp Action Button */}
        <div className="nav-actions">
          <a
            href="https://wa.me/6287759151278?text=Halo%20Wahana%20Totalita%2C%20saya%20ingin%20bertanya%20tentang%20program%20pelatihan"
            className="btn-wa-nav"
            target="_blank"
            rel="noopener noreferrer"
          >
            <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16">
              <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347" />
            </svg>
            Hubungi Kami
          </a>
        </div>

        {/* Mobile Hamburger Button */}
        <button
          className="nav-hamburger"
          id="nav-hamburger"
          aria-label="Toggle menu"
          aria-expanded={menuOpen}
          onClick={() => setMenuOpen(!menuOpen)}
        >
          <span />
          <span />
          <span />
        </button>
      </div>
    </nav>
  );
}
