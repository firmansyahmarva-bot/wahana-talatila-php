'use client';

import React, { useState, useMemo } from 'react';
import Link from 'next/link';
import { Calendar, Search, X, MessageCircle, Building2, CheckCircle2 } from 'lucide-react';
import { ScheduleBatch } from '@/data/schedules';
import PageHeader from '@/components/layout/PageHeader';

interface ScheduleCatalogAppProps {
  batches: ScheduleBatch[];
}

const TABS = [
  { id: 'all', label: 'Semua' },
  { id: 'online', label: 'Online' },
  { id: 'offline', label: 'Tatap Muka' },
  { id: 'kemnaker', label: 'KEMNAKER RI' },
  { id: 'bnsp', label: 'BNSP' },
];

export default function ScheduleCatalogApp({ batches }: ScheduleCatalogAppProps) {
  const [activeTab, setActiveTab] = useState('all');
  const [searchQuery, setSearchQuery] = useState('');

  const filteredBatches = useMemo(() => {
    return batches.filter((b) => {
      // Tab filter
      let matchesTab = true;
      if (activeTab === 'online') {
        matchesTab = b.mode.toLowerCase().includes('online') || b.filterTags.includes('online');
      } else if (activeTab === 'offline') {
        matchesTab = b.mode.toLowerCase().includes('tatap') || b.filterTags.includes('offline');
      } else if (activeTab === 'kemnaker') {
        matchesTab = b.certification.toLowerCase().includes('kemnaker') || b.title.toLowerCase().includes('kemnaker');
      } else if (activeTab === 'bnsp') {
        matchesTab = b.certification.toLowerCase().includes('bnsp') || b.title.toLowerCase().includes('bnsp');
      }

      // Search keyword filter
      const q = searchQuery.toLowerCase().trim();
      const matchesSearch =
        !q ||
        b.title.toLowerCase().includes(q) ||
        b.date.toLowerCase().includes(q) ||
        b.certification.toLowerCase().includes(q) ||
        b.mode.toLowerCase().includes(q);

      return matchesTab && matchesSearch;
    });
  }, [batches, activeTab, searchQuery]);

  return (
    <main id="konten-utama" className="min-h-screen bg-slate-50">
      {/* ══════════════════════════════════════════════════════════
           UNIFIED APP PAGE HEADER
           ══════════════════════════════════════════════════════════ */}
      <PageHeader
        eyebrow="Agenda & Kalender Pembinaan 2026"
        title="Jadwal Pelatihan K3"
        highlightTitle="& Sertifikasi 2026"
        description="Jadwal lengkap batch pembinaan dan sertifikasi KEMNAKER RI, BNSP, dan KLHK tahun 2026. Diperbarui setiap bulan dengan kuota transparan."
        badges={[
          'Update Batch Tiap Bulan',
          'Sertifikasi Kemnaker & BNSP',
          'Tersedia Kelas Online & Tatap Muka',
          'Layanan In-House Corporate',
        ]}
        breadcrumbs={[
          { name: 'Beranda', href: '/' },
          { name: 'Jadwal Pelatihan' },
        ]}
      />

      {/* ══════════════════════════════════════════════════════════
           SCHEDULE CONTROLS & TABLE
           ══════════════════════════════════════════════════════════ */}
      <section className="schedule-section" id="jadwal">
        <div className="container">
          {/* Controls: Tabs & Search Input */}
          <div className="schedule-controls">
            <div className="filter-tabs" role="tablist" aria-label="Filter Jadwal">
              {TABS.map((tab) => (
                <button
                  key={tab.id}
                  type="button"
                  className={`tab ${activeTab === tab.id ? 'active' : ''}`}
                  onClick={() => setActiveTab(tab.id)}
                >
                  {tab.label}
                </button>
              ))}
            </div>

            <div className="schedule-search-box">
              <input
                type="search"
                className="schedule-search-input"
                placeholder="Cari jadwal program atau tanggal..."
                aria-label="Cari jadwal batch"
                value={searchQuery}
                onChange={(e) => setSearchQuery(e.target.value)}
              />
              {searchQuery && (
                <button
                  type="button"
                  className="schedule-search-clear"
                  onClick={() => setSearchQuery('')}
                  aria-label="Hapus filter pencarian"
                >
                  ✕
                </button>
              )}
            </div>
          </div>

          <div className="schedule-results-count">
            Menampilkan <strong>{filteredBatches.length}</strong> batch pelatihan tersedia
          </div>

          {/* Schedule Table */}
          <div className="schedule-table-wrap">
            <table className="schedule-table" id="scheduleTable">
              <thead>
                <tr>
                  <th style={{ width: '130px' }}>Tanggal</th>
                  <th>Program Pelatihan</th>
                  <th style={{ width: '180px' }}>Sertifikasi</th>
                  <th style={{ width: '110px' }}>Kota / Mode</th>
                  <th style={{ width: '120px' }}>Sisa Kursi</th>
                  <th style={{ width: '100px' }}>Aksi</th>
                </tr>
              </thead>
              <tbody>
                {filteredBatches.length === 0 ? (
                  <tr>
                    <td colSpan={6} style={{ textAlign: 'center', padding: '40px 20px', color: '#64748b' }}>
                      <p style={{ fontWeight: 700, fontSize: '1rem', color: '#1e293b', marginBottom: '6px' }}>
                        Tidak Ada Jadwal yang Cocok
                      </p>
                      <p style={{ fontSize: '0.9rem' }}>
                        Coba kata kunci lain atau pilih tab &ldquo;Semua&rdquo; untuk melihat seluruh jadwal batch.
                      </p>
                    </td>
                  </tr>
                ) : (
                  filteredBatches.map((b) => (
                    <tr key={b.id || b.title}>
                      <td data-label="Tanggal">
                        <strong>{b.date}</strong>
                      </td>
                      <td data-label="Program">
                        {b.batchHref ? (
                          <Link href={b.batchHref} className="batch-link">
                            {b.title}
                          </Link>
                        ) : (
                          <strong className="batch-link">{b.title}</strong>
                        )}
                        <br />
                        <Link href={b.programHref} style={{ fontSize: '12px', color: '#64748b' }}>
                          Lihat silabus program &rarr;
                        </Link>
                      </td>
                      <td data-label="Sertifikasi">
                        <span className="badge badge-cert">{b.certification}</span>
                      </td>
                      <td data-label="Kota/Mode">
                        <span className={`badge badge-${b.mode.toLowerCase().includes('online') ? 'online' : 'offline'}`}>
                          {b.mode}
                        </span>
                      </td>
                      <td data-label="Sisa Kursi">
                        <span className="badge badge-ok">{b.seats}</span>
                      </td>
                      <td data-label="Daftar">
                        <a
                          href={b.waLink}
                          target="_blank"
                          rel="noopener noreferrer"
                          className="btn-daftar"
                          aria-label={`Daftar ${b.title}`}
                        >
                          Daftar
                        </a>
                      </td>
                    </tr>
                  ))
                )}
              </tbody>
            </table>
          </div>
        </div>
      </section>

      {/* ══════════════════════════════════════════════════════════
           HOW TO REGISTER (6 STEPS)
           ══════════════════════════════════════════════════════════ */}
      <section className="steps-section" style={{ background: '#f8fafc', padding: '60px 0' }}>
        <div className="container">
          <div className="section-header text-center" style={{ marginBottom: '40px' }}>
            <span className="section-eyebrow">Panduan Registrasi</span>
            <h2 className="section-title">📝 Cara Mendaftar Pelatihan</h2>
            <p className="section-desc">Proses pendaftaran cepat, transparan, dan terverifikasi secara resmi.</p>
          </div>

          <div
            className="steps-grid"
            style={{
              display: 'grid',
              gridTemplateColumns: 'repeat(auto-fit, minmax(280px, 1fr))',
              gap: '24px',
            }}
          >
            <div className="step-card" style={{ background: '#fff', padding: '24px', borderRadius: '12px', border: '1px solid #e2e8f0' }}>
              <div style={{ fontSize: '1.75rem', marginBottom: '8px' }}>1️⃣</div>
              <h4 style={{ margin: '0 0 8px', fontSize: '1.05rem', color: '#103A5C' }}>Pilih Jadwal &amp; Program</h4>
              <p style={{ margin: 0, fontSize: '0.9rem', color: '#64748b' }}>
                Pilih program sertifikasi dan tanggal batch yang sesuai dengan jadwal Anda pada tabel di atas.
              </p>
            </div>
            <div className="step-card" style={{ background: '#fff', padding: '24px', borderRadius: '12px', border: '1px solid #e2e8f0' }}>
              <div style={{ fontSize: '1.75rem', marginBottom: '8px' }}>2️⃣</div>
              <h4 style={{ margin: '0 0 8px', fontSize: '1.05rem', color: '#103A5C' }}>Klik Daftar / WhatsApp</h4>
              <p style={{ margin: 0, fontSize: '0.9rem', color: '#64748b' }}>
                Klik tombol Daftar untuk langsung terhubung dengan tim representatif kami dengan format pesan otomatis.
              </p>
            </div>
            <div className="step-card" style={{ background: '#fff', padding: '24px', borderRadius: '12px', border: '1px solid #e2e8f0' }}>
              <div style={{ fontSize: '1.75rem', marginBottom: '8px' }}>3️⃣</div>
              <h4 style={{ margin: '0 0 8px', fontSize: '1.05rem', color: '#103A5C' }}>Konfirmasi Data Peserta</h4>
              <p style={{ margin: 0, fontSize: '0.9rem', color: '#64748b' }}>
                Kirim dokumen persyaratan (KTP, pas foto latar merah, dan salinan ijazah terakhir) untuk verifikasi lisensi.
              </p>
            </div>
            <div className="step-card" style={{ background: '#fff', padding: '24px', borderRadius: '12px', border: '1px solid #e2e8f0' }}>
              <div style={{ fontSize: '1.75rem', marginBottom: '8px' }}>4️⃣</div>
              <h4 style={{ margin: '0 0 8px', fontSize: '1.05rem', color: '#103A5C' }}>Pembayaran</h4>
              <p style={{ margin: 0, fontSize: '0.9rem', color: '#64748b' }}>
                Lakukan pembayaran melalui rekening resmi perusahaan PT Wahana Totalita Konsultan dengan invoice legal.
              </p>
            </div>
            <div className="step-card" style={{ background: '#fff', padding: '24px', borderRadius: '12px', border: '1px solid #e2e8f0' }}>
              <div style={{ fontSize: '1.75rem', marginBottom: '8px' }}>5️⃣</div>
              <h4 style={{ margin: '0 0 8px', fontSize: '1.05rem', color: '#103A5C' }}>Ikuti Pelatihan</h4>
              <p style={{ margin: 0, fontSize: '0.9rem', color: '#64748b' }}>
                Akses link kelas Zoom interaktif atau hadir di fasilitas training center kami sesuai tanggal batch.
              </p>
            </div>
            <div className="step-card" style={{ background: '#fff', padding: '24px', borderRadius: '12px', border: '1px solid #e2e8f0' }}>
              <div style={{ fontSize: '1.75rem', marginBottom: '8px' }}>6️⃣</div>
              <h4 style={{ margin: '0 0 8px', fontSize: '1.05rem', color: '#103A5C' }}>Terima Sertifikat</h4>
              <p style={{ margin: 0, fontSize: '0.9rem', color: '#64748b' }}>
                Sertifikat kelulusan resmi Kemnaker RI / BNSP diterbitkan dan dikirimkan ke alamat peserta/kantor.
              </p>
            </div>
          </div>
        </div>
      </section>

      {/* ══════════════════════════════════════════════════════════
           CTA WHATSAPP SECTION
           ══════════════════════════════════════════════════════════ */}
      <section className="schedule-cta" style={{ background: '#103A5C', color: '#fff', padding: '60px 0', textAlign: 'center' }}>
        <div className="container">
          <h2 style={{ fontSize: '1.85rem', marginBottom: '14px', color: '#fff' }}>
            Butuh Jadwal Khusus atau In-House Training Perusahaan?
          </h2>
          <p style={{ maxWidth: '640px', margin: '0 auto 28px', color: '#cbd5e1', fontSize: '1rem', lineHeight: 1.6 }}>
            Kami dapat menyesuaikan tanggal, materi, dan lokasi pelatihan sesuai kebutuhan operasional perusahaan Anda di seluruh wilayah Indonesia.
          </p>
          <a
            href="https://wa.me/6287759151278?text=Halo%20Wahana%20Totalita%2C%20kami%20ingin%20jadwal%20khusus%20in-house%20training%20K3"
            target="_blank"
            rel="noopener noreferrer"
            className="btn-primary"
            style={{ padding: '14px 32px', fontSize: '1.05rem' }}
          >
            💬 Hubungi Konsultan Pelatihan Kami &rarr;
          </a>
        </div>
      </section>
    </main>
  );
}
