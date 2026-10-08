'use client';

import React, { useState, useMemo } from 'react';
import Link from 'next/link';

export interface SafetyTalkTopic {
  w: number;
  cat: string;
  title: string;
  desc: string;
  tags: string[];
  stat: string;
  points: string[];
  steps: string[];
  related: {
    url: string;
    label: string;
  };
}

export interface RelatedTraining {
  url: string;
  label: string;
}

interface SafetyTalkAppProps {
  talks: SafetyTalkTopic[];
  relatedTrainings: RelatedTraining[];
}

const CATEGORIES = [
  { id: 'all', label: 'Semua (100)' },
  { id: 'umum', label: 'Umum & Fundamental' },
  { id: 'ketinggian', label: 'Ketinggian' },
  { id: 'kebakaran', label: 'Kebakaran' },
  { id: 'listrik', label: 'Listrik & LOTO' },
  { id: 'kimia', label: 'Bahan Kimia & B3' },
  { id: 'kesehatan', label: 'Kesehatan & Ergonomi' },
  { id: 'alatberat', label: 'Alat Berat & Kendaraan' },
  { id: 'lingkungan', label: 'Lingkungan & Limbah' },
  { id: 'tambang', label: 'Tambang & Ruang Terbatas' },
  { id: 'teknologi', label: 'Teknologi & AI K3' },
];

export default function SafetyTalkApp({ talks, relatedTrainings }: SafetyTalkAppProps) {
  const [searchQuery, setSearchQuery] = useState('');
  const [activeCat, setActiveCat] = useState('all');
  const [visibleLimit, setVisibleLimit] = useState(12);
  const [selectedTopic, setSelectedTopic] = useState<SafetyTalkTopic | null>(null);

  // Filter topics based on active category and search keyword
  const filteredTalks = useMemo(() => {
    return talks.filter((t) => {
      const matchCat = activeCat === 'all' || t.cat === activeCat;
      const q = searchQuery.toLowerCase().trim();
      const matchQuery =
        !q ||
        t.title.toLowerCase().includes(q) ||
        t.desc.toLowerCase().includes(q) ||
        t.w.toString() === q ||
        t.tags.some((tag) => tag.toLowerCase().includes(q));
      return matchCat && matchQuery;
    });
  }, [talks, activeCat, searchQuery]);

  const displayedTalks = useMemo(() => {
    return filteredTalks.slice(0, visibleLimit);
  }, [filteredTalks, visibleLimit]);

  const handleQuickSearch = (keyword: string) => {
    setSearchQuery(keyword);
    setActiveCat('all');
    setVisibleLimit(12);
    const grid = document.getElementById('talkGrid');
    if (grid) {
      grid.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  };

  const handleCategorySelect = (catId: string) => {
    setActiveCat(catId);
    setVisibleLimit(12);
  };

  const printTalk = (t: SafetyTalkTopic) => {
    const win = window.open('', '_blank');
    if (!win) return;
    win.document.write(`<!DOCTYPE html><html><head><title>Safety Talk Topik ${t.w}: ${t.title}</title>
    <style>
    body{font-family:'Segoe UI',Arial,sans-serif;padding:24px;max-width:720px;margin:0 auto;color:#1e293b;line-height:1.5}
    h1{font-size:16pt;border-bottom:2px solid #06402B;padding-bottom:8px;margin-bottom:12px;color:#06402B}
    h3{font-size:11pt;color:#06402B;margin-top:16px;margin-bottom:6px}
    .stat{background:#F0FDF4;padding:10px 14px;border-radius:6px;font-size:9pt;margin:12px 0;border:1px solid #BBF7D0;color:#14532D}
    ol,ul{padding-left:20px;line-height:1.6;font-size:9.5pt}
    li{margin-bottom:4px}
    .footer{margin-top:28px;border-top:1px solid #E2E8F0;padding-top:8px;font-size:8pt;color:#64748B;text-align:center}
    table{width:100%;margin-top:10px;border-collapse:collapse;font-size:8.5pt}
    th{border:1px solid #CBD5E1;padding:6px;background:#F8FAFC;text-align:left}
    td{border:1px solid #CBD5E1;padding:6px;height:24px}
    </style></head><body>
    <h1>Safety Talk — Topik ${t.w}: ${t.title}</h1>
    <div class="stat"><strong>Fakta K3:</strong> ${t.stat}</div>
    <p style="font-size:9.5pt;line-height:1.6">${t.desc}</p>
    <h3>Poin Diskusi Toolbox Meeting (2 Arah)</h3>
    <ol>${t.points.map((p) => `<li>${p}</li>`).join('')}</ol>
    <h3>Langkah Tindakan Lapangan (Action Steps)</h3>
    <ol>${t.steps.map((s) => `<li>${s}</li>`).join('')}</ol>
    <div style="margin-top:18px;border:1px solid #CBD5E1;border-radius:6px;padding:12px">
      <strong style="font-size:10pt;color:#06402B">Daftar Hadir Toolbox Meeting (TBM)</strong><br>
      <div style="margin-top:6px;font-size:8.5pt;color:#475569">
        Tanggal: _______________ | Departemen/Area: _______________ | Pengawas/Fasilitator: _______________<br>
        <table>
          <tr><th style="width:36px;text-align:center">No</th><th>Nama Pekerja</th><th>Jabatan</th><th style="width:120px">Tanda Tangan</th></tr>
          ${[1, 2, 3, 4, 5, 6, 7, 8, 9, 10].map((n) => `<tr><td style="text-align:center">${n}</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>`).join('')}
        </table>
      </div>
    </div>
    <div class="footer">Materi K3 Resmi dari wahanatotalita.com/tools/safety-talk/ — Wahana Totalita Konsultan</div>
    </body></html>`);
    win.document.close();
    win.print();
  };

  return (
    <main className="st-page" id="konten-utama">
      {/* ══════════════════════════════════════════════════════════
           HERO SECTION
           ══════════════════════════════════════════════════════════ */}
      <section className="st-hero">
        <div className="container">
          <div className="st-hero-grid">
            <div className="st-hero-content">
              <div className="st-hero-badge">
                <span className="st-pulse-dot" />
                Kamus &amp; Database Safety Talk K3 2026
              </div>
              <h1>
                <span>100 Materi Safety Talk Harian</span>
                Toolbox Meeting Singkat &amp; Jelas
              </h1>
              <p className="st-lead">
                Topik K3 harian terlengkap — fakta statistik, poin diskusi, teknologi K3 &amp; AI, serta lembar daftar hadir siap cetak.
              </p>

              {/* Elevated Search Bar */}
              <div className="st-search-box">
                <span className="st-search-icon" aria-hidden="true">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5">
                    <circle cx="11" cy="11" r="8" />
                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                  </svg>
                </span>
                <input
                  type="search"
                  id="stSearch"
                  className="st-search-input"
                  placeholder="Cari topik: ketinggian, listrik, APD, atau AI..."
                  aria-label="Cari materi safety talk"
                  value={searchQuery}
                  onChange={(e) => {
                    setSearchQuery(e.target.value);
                    setVisibleLimit(12);
                  }}
                />
                <button
                  type="button"
                  className="st-search-btn"
                  onClick={() => {
                    const grid = document.getElementById('talkGrid');
                    if (grid) grid.scrollIntoView({ behavior: 'smooth' });
                  }}
                >
                  <span>Cari Topik</span>
                </button>
              </div>

              {/* Quick Topic Chips */}
              <div className="st-quick-chips" aria-label="Topik Populer">
                <span className="st-quick-label">⚡ Topik Cepat:</span>
                <button type="button" className="st-chip" onClick={() => handleQuickSearch('Ketinggian')}>
                  Ketinggian
                </button>
                <button type="button" className="st-chip" onClick={() => handleQuickSearch('APD')}>
                  APD Wajib
                </button>
                <button type="button" className="st-chip" onClick={() => handleQuickSearch('Kebakaran')}>
                  APAR &amp; Api
                </button>
                <button type="button" className="st-chip" onClick={() => handleQuickSearch('Listrik')}>
                  LOTO &amp; Listrik
                </button>
                <button type="button" className="st-chip" onClick={() => handleQuickSearch('Confined Space')}>
                  Ruang Terbatas
                </button>
                <button type="button" className="st-chip" onClick={() => handleQuickSearch('Forklift')}>
                  Forklift
                </button>
              </div>

              {/* Trust Badges */}
              <div className="st-trust-row" aria-label="Keunggulan materi">
                <div className="st-trust-item">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5">
                    <polyline points="20 6 9 17 4 12" />
                  </svg>
                  <span>100% Gratis &amp; Siap Cetak</span>
                </div>
                <div className="st-trust-item">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5">
                    <polyline points="20 6 9 17 4 12" />
                  </svg>
                  <span>Format Ringkas 5–10 Menit</span>
                </div>
                <div className="st-trust-item">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5">
                    <polyline points="20 6 9 17 4 12" />
                  </svg>
                  <span>Disertai Lembar Absensi (TBM)</span>
                </div>
              </div>
            </div>

            {/* Right Stat Card */}
            <aside className="st-hero-panel" aria-label="Ringkasan database">
              <p className="st-panel-eyebrow">Pusat Materi Praktis</p>
              <h2 className="st-panel-title">Satu database lengkap untuk briefing K3 setahun penuh.</h2>
              <div className="st-stat-grid">
                <div className="st-stat-card">
                  <strong>100</strong>
                  <span>Topik Siap Pakai</span>
                </div>
                <div className="st-stat-card">
                  <strong>10+</strong>
                  <span>Kategori Industri</span>
                </div>
                <div className="st-stat-card">
                  <strong>5–10m</strong>
                  <span>Durasi Briefing</span>
                </div>
                <div className="st-stat-card">
                  <strong>PDF/Print</strong>
                  <span>Lembar Absensi</span>
                </div>
              </div>
              <div className="st-panel-cta">
                <p>Butuh lisensi dan sertifikasi resmi Kemnaker RI / BNSP untuk tim pengawas Anda?</p>
                <a
                  href="https://wa.me/6287759151278?text=Halo%20Wahana%2C%20saya%20tertarik%20dengan%20program%20pelatihan%20K3"
                  target="_blank"
                  rel="noopener noreferrer"
                  className="st-panel-btn"
                >
                  💬 Konsultasi Sertifikasi K3 &rarr;
                </a>
              </div>
            </aside>
          </div>
        </div>
      </section>

      {/* ══════════════════════════════════════════════════════════
           CATEGORY FILTERS & TOPIC GRID
           ══════════════════════════════════════════════════════════ */}
      <section className="st-content-section">
        <div className="container">
          <div className="st-section-head">
            <div>
              <span className="st-section-eyebrow">Koleksi Lengkap 100 Topik</span>
              <h2 className="st-section-title">Materi untuk Briefing Shift Kerja</h2>
            </div>
            <div className="st-results-meta">
              Menampilkan <span id="stResultsCount" className="st-count-pill">{filteredTalks.length} topik</span>
            </div>
          </div>

          {/* Sticky Category Bar */}
          <div className="st-cat-bar" role="tablist" aria-label="Kategori Safety Talk">
            {CATEGORIES.map((cat) => (
              <button
                key={cat.id}
                type="button"
                className={`st-cat-btn ${activeCat === cat.id ? 'active' : ''}`}
                onClick={() => handleCategorySelect(cat.id)}
              >
                {cat.label}
              </button>
            ))}
          </div>

          {/* Topics Grid */}
          <div className="st-grid" id="talkGrid">
            {displayedTalks.length === 0 ? (
              <div
                style={{
                  color: 'var(--st-slate-600)',
                  textAlign: 'center',
                  padding: '50px 20px',
                  gridColumn: '1/-1',
                  background: '#fff',
                  borderRadius: '16px',
                  border: '1px dashed var(--st-slate-300)',
                }}
              >
                <p
                  style={{
                    fontFamily: "'Lexend', sans-serif",
                    fontSize: '1.15rem',
                    fontWeight: 700,
                    color: 'var(--st-slate-900)',
                    marginBottom: '6px',
                  }}
                >
                  Topik Tidak Ditemukan
                </p>
                <p style={{ fontSize: '0.9rem', marginBottom: '16px' }}>
                  Coba kata kunci lain atau bersihkan pencarian untuk melihat seluruh 100 topik.
                </p>
                <button
                  type="button"
                  onClick={() => {
                    setSearchQuery('');
                    setActiveCat('all');
                    setVisibleLimit(12);
                  }}
                  style={{
                    background: 'var(--st-forest)',
                    color: '#fff',
                    border: 'none',
                    borderRadius: '999px',
                    padding: '9px 20px',
                    fontFamily: "'Lexend', sans-serif",
                    fontWeight: 700,
                    fontSize: '0.82rem',
                    cursor: 'pointer',
                  }}
                >
                  Tampilkan Semua Topik
                </button>
              </div>
            ) : (
              displayedTalks.map((t) => (
                <div
                  key={t.w}
                  className="st-card"
                  data-cat={t.cat}
                  onClick={() => setSelectedTopic(t)}
                  role="button"
                  tabIndex={0}
                  onKeyDown={(e) => {
                    if (e.key === 'Enter') setSelectedTopic(t);
                  }}
                >
                  <div className="st-card-top">
                    <span className={`st-cat-badge cat-${t.cat}`}>{t.cat.toUpperCase()}</span>
                    <span className="st-topic-id">Topik #{t.w}</span>
                  </div>
                  <div className="st-card-header">
                    <h3>{t.title}</h3>
                  </div>
                  <div className="st-card-body">{t.desc}</div>
                  <div className="st-card-tags">
                    {t.tags.map((tg, idx) => (
                      <span key={idx} className="st-tag">
                        {tg}
                      </span>
                    ))}
                  </div>
                  <Link
                    className="st-card-related"
                    href={t.related.url}
                    onClick={(e) => e.stopPropagation()}
                  >
                    <span>Pelajari: {t.related.label}</span>
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5">
                      <polyline points="9 18 15 12 9 6" />
                    </svg>
                  </Link>
                  <div className="st-card-footer">
                    <button
                      className="st-btn-detail"
                      onClick={(e) => {
                        e.stopPropagation();
                        setSelectedTopic(t);
                      }}
                      type="button"
                    >
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
                      </svg>
                      <span>Lihat Detail</span>
                    </button>
                    <button
                      className="st-btn-print"
                      onClick={(e) => {
                        e.stopPropagation();
                        printTalk(t);
                      }}
                      type="button"
                      title="Cetak materi dan lembar absensi"
                    >
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                        <polyline points="6 9 6 2 18 2 18 9" />
                        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
                        <rect x="6" y="14" width="12" height="8" />
                      </svg>
                      <span>Print Absensi</span>
                    </button>
                  </div>
                </div>
              ))
            )}
          </div>

          {/* Load More Button */}
          {visibleLimit < filteredTalks.length && (
            <div className="st-load-more-wrap">
              <button
                type="button"
                id="stLoadMore"
                className="st-load-more-btn"
                onClick={() => setVisibleLimit((prev) => prev + 12)}
              >
                <span>Muat Topik Lainnya (+12)</span>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                  <polyline points="6 9 12 15 18 9" />
                </svg>
              </button>
            </div>
          )}
        </div>
      </section>

      {/* ══════════════════════════════════════════════════════════
           COMMERCIAL CTA
           ══════════════════════════════════════════════════════════ */}
      <section className="st-commercial-cta">
        <div className="container">
          <div className="st-cta-card">
            <div className="st-cta-badge">Sertifikasi Pengawas &amp; Trainer K3</div>
            <h2 className="st-cta-title">Tingkatkan Kompetensi Memimpin Toolbox Meeting &amp; Safety Leadership</h2>
            <p className="st-cta-desc">
              Kuasai teknik komunikasi K3 dua arah, investigasi insiden, dan penegakan budaya kerja selamat bersertifikasi Kemnaker RI &amp; BNSP.
            </p>
            <div className="st-cta-btns">
              <a
                href="https://wa.me/6287759151278?text=Halo%20Wahana%2C%20saya%20ingin%20tanya%20program%20pembinaan%20Ahli%20K3%20Umum"
                target="_blank"
                rel="noopener noreferrer"
                className="st-btn-wa"
              >
                💬 Konsultasi Batch Terdekat via WhatsApp
              </a>
              <Link href="/pelatihan/" className="st-btn-ghost">
                Lihat Katalog Pelatihan &rarr;
              </Link>
            </div>
          </div>
        </div>
      </section>

      {/* ══════════════════════════════════════════════════════════
           EDUCATIONAL GUIDE SECTION
           ══════════════════════════════════════════════════════════ */}
      <section className="st-guide-section">
        <div className="container">
          <div className="st-guide-grid">
            <article className="st-guide-article">
              <h2>Cara Menggunakan Database 100 Materi Safety Talk</h2>
              <p>
                Safety talk (disebut juga <em>toolbox meeting</em> atau <em>tailgate briefing</em>) adalah pertemuan singkat 5–10 menit di awal shift kerja untuk menyelaraskan kesadaran bahaya dan langkah pencegahan.
              </p>
              <h3>4 Prinsip Briefing K3 yang Efektif:</h3>
              <ol>
                <li><strong>Satu Topik per Briefing:</strong> Fokus pada satu bahaya spesifik yang relevan dengan pekerjaan hari ini.</li>
                <li><strong>Gunakan Komunikasi 2 Arah:</strong> Ajukan pertanyaan diskusi untuk memancing keaktifan peserta, bukan ceramah 1 arah.</li>
                <li><strong>Tegaskan Tindakan Nyata:</strong> Selalu akhiri sesi dengan 3–4 langkah kontrol konkret di lapangan.</li>
                <li><strong>Dokumentasikan Absensi:</strong> Gunakan lembar daftar hadir yang tersedia untuk bukti kepatuhan audit SMK3.</li>
              </ol>
            </article>

            <article className="st-guide-article">
              <h2>Teknologi &amp; AI dalam Era Baru Safety Talk K3</h2>
              <p>
                Di era industri modern, pelaksanaan safety talk didukung teknologi analitik dan kecerdasan buatan (AI) untuk meningkatkan retensi dan deteksi bahaya proaktif.
              </p>
              <h3>Pemanfaatan Teknologi K3 Lapangan:</h3>
              <ul>
                <li><strong>AI Computer Vision:</strong> Kamera pintar mendeteksi anomali APD dan perilaku tidak aman secara real-time.</li>
                <li><strong>Wearable Biosensors:</strong> Gelang pintar memantau detak jantung dan tingkat kelelahan operator mesin.</li>
                <li><strong>Digital TBM Logging:</strong> Absensi berbasis QR code dan aplikasi mobile untuk rekapitulasi audit otomatis.</li>
              </ul>
            </article>
          </div>
        </div>
      </section>

      {/* ══════════════════════════════════════════════════════════
           FAQ SECTION
           ══════════════════════════════════════════════════════════ */}
      <section className="st-faq-section">
        <div className="container">
          <div className="st-faq-head">
            <span className="st-section-eyebrow">Bantuan &amp; Panduan</span>
            <h2 className="st-section-title">Pertanyaan Umum (FAQ)</h2>
          </div>
          <div className="st-faq-list">
            <details className="st-faq-item">
              <summary className="st-faq-question">
                <span>Berapa lama durasi ideal satu sesi Safety Talk / Toolbox Meeting?</span>
                <span className="st-faq-icon">+</span>
              </summary>
              <div className="st-faq-answer">
                <p>
                  Idealnya berlangsung antara <strong>5 hingga 10 menit</strong>. Waktu yang singkat menjaga fokus pekerja tetap optimal sebelum memulai pekerjaan fisik tanpa menyita waktu operasional shift kerja.
                </p>
              </div>
            </details>

            <details className="st-faq-item">
              <summary className="st-faq-question">
                <span>Siapa yang seharusnya memimpin safety talk harian?</span>
                <span className="st-faq-icon">+</span>
              </summary>
              <div className="st-faq-answer">
                <p>
                  Sangat dianjurkan dipimpin langsung oleh <strong>supervisor lapangan, foreman, atau tim HSE</strong>. Keterlibatan pengawas operasional menunjukkan <em>visible safety leadership</em> yang kuat.
                </p>
              </div>
            </details>

            <details className="st-faq-item">
              <summary className="st-faq-question">
                <span>Apakah materi dan lembar absensi ini boleh didownload dan dicetak gratis?</span>
                <span className="st-faq-icon">+</span>
              </summary>
              <div className="st-faq-answer">
                <p>
                  <strong>Ya, 100% gratis</strong> untuk seluruh praktisi K3, pengawas, dan perusahaan di Indonesia. Anda dapat menggunakan tombol Print di setiap topik untuk langsung mencetak materi beserta tabel absensinya.
                </p>
              </div>
            </details>
          </div>
        </div>
      </section>

      {/* ══════════════════════════════════════════════════════════
           RELATED COMMERCIAL TRAININGS
           ══════════════════════════════════════════════════════════ */}
      <section className="st-related-trainings">
        <div className="container">
          <div className="st-section-head">
            <div>
              <span className="st-section-eyebrow">Pengembangan Karir HSE</span>
              <h2 className="st-section-title">Pelatihan K3 Terkait</h2>
            </div>
            <Link href="/pelatihan/" className="st-view-all-link">
              Lihat Semua &rarr;
            </Link>
          </div>
          <div className="st-related-grid">
            {relatedTrainings.map((rt, idx) => (
              <Link key={idx} href={rt.url} className="st-related-item">
                <div className="st-related-icon">🎓</div>
                <div className="st-related-info">
                  <strong>{rt.label}</strong>
                  <span>Sertifikasi Kemnaker RI / BNSP Resmi &rarr;</span>
                </div>
              </Link>
            ))}
          </div>
        </div>
      </section>

      {/* ══════════════════════════════════════════════════════════
           INTERACTIVE MODAL DIALOG
           ══════════════════════════════════════════════════════════ */}
      {selectedTopic && (
        <div
          className="st-modal-overlay show"
          onClick={() => setSelectedTopic(null)}
          role="dialog"
          aria-modal="true"
        >
          <div className="st-modal-card" onClick={(e) => e.stopPropagation()}>
            <div className="st-modal-head">
              <div>
                <span className={`st-cat-badge cat-${selectedTopic.cat}`} style={{ marginBottom: '6px', display: 'inline-block' }}>
                  {selectedTopic.cat.toUpperCase()}
                </span>
                <h2>
                  Topik {selectedTopic.w}: {selectedTopic.title}
                </h2>
              </div>
              <button className="st-btn-close" onClick={() => setSelectedTopic(null)} type="button">
                ✕ Tutup
              </button>
            </div>

            <div className="st-stat-box">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" style={{ flexShrink: 0, marginTop: '2px' }}>
                <circle cx="12" cy="12" r="10" />
                <line x1="12" y1="16" x2="12" y2="12" />
                <line x1="12" y1="8" x2="12.01" y2="8" />
              </svg>
              <div>
                <strong>Fakta &amp; Statistik K3:</strong> {selectedTopic.stat}
              </div>
            </div>

            <div className="st-modal-section">
              <h4>Ringkasan Materi</h4>
              <p>{selectedTopic.desc}</p>
            </div>

            <div className="st-modal-section">
              <h4>Poin Diskusi Toolbox Meeting (2 Arah)</h4>
              {selectedTopic.points.map((p, i) => (
                <div key={i} className="st-discuss-box">
                  <strong>{i + 1}.</strong> {p}
                </div>
              ))}
            </div>

            <div className="st-modal-section">
              <h4>Langkah Tindakan Lapangan (Action Points)</h4>
              <ol className="st-action-steps">
                {selectedTopic.steps.map((s, i) => (
                  <li key={i}>{s}</li>
                ))}
              </ol>
            </div>

            <Link className="st-modal-related" href={selectedTopic.related.url}>
              <span>
                Program Pelatihan Terkait: <strong>{selectedTopic.related.label}</strong>
              </span>
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5">
                <polyline points="9 18 15 12 9 6" />
              </svg>
            </Link>

            <div className="st-modal-actions">
              <button
                onClick={() => printTalk(selectedTopic)}
                className="st-btn-detail"
                type="button"
                style={{ padding: '11px 20px', fontSize: '0.84rem' }}
              >
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                  <polyline points="6 9 6 2 18 2 18 9" />
                  <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
                  <rect x="6" y="14" width="12" height="8" />
                </svg>
                <span>Print Materi &amp; Lembar Absensi</span>
              </button>
              <a
                href="https://wa.me/6287759151278?text=Halo%20Wahana%2C%20saya%20gunakan%20materi%20safety%20talk%20dan%20ingin%20tanya%20pelatihan%20K3"
                target="_blank"
                rel="noopener noreferrer"
                className="st-btn-wa"
                style={{ padding: '11px 20px', fontSize: '0.84rem' }}
              >
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.699c.97.53 1.871.815 2.795.815 3.183 0 5.769-2.587 5.77-5.767 0-3.181-2.587-5.766-5.769-5.766zm3.376 8.21c-.14.394-.712.723-1.026.768-.314.045-.697.07-2.008-.475-1.583-.658-2.607-2.274-2.686-2.38-.079-.105-.634-.844-.634-1.611 0-.767.4-1.144.542-1.299.143-.155.314-.194.42-.194.105 0 .211.002.303.007.098.005.228-.037.356.27.132.316.45 1.097.489 1.176.04.079.066.172.013.277-.053.106-.079.172-.158.264-.079.092-.167.206-.238.277-.08.079-.163.165-.07.324.093.159.412.68.884 1.101.608.542 1.121.71 1.28.789.158.079.251.066.344-.04.092-.106.396-.462.502-.62.106-.159.211-.132.356-.079.145.053.924.436 1.082.515.158.08.264.119.303.185.04.066.04.382-.1.776zM12 2C6.477 2 2 6.477 2 12c0 1.891.524 3.662 1.435 5.178L2 22l4.957-1.398A9.957 9.957 0 0 0 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2z" />
                </svg>
                <span>Tanya Pelatihan K3</span>
              </a>
            </div>
          </div>
        </div>
      )}
    </main>
  );
}
