'use client';

import React, { useState } from 'react';

export default function WhatsAppFloat() {
  const [isOpen, setIsOpen] = useState(false);

  const phone = '6287759151278';
  const quickOptions = [
    {
      title: 'Tanya Jadwal & Kuota',
      desc: 'Cek jadwal terdekat kelas Jogja, Jakarta & Online',
      msg: 'Halo Wahana Totalita, saya ingin cek jadwal pelatihan K3 terdekat dan kuota yang tersedia.',
      icon: '📅',
    },
    {
      title: 'Konsultasi Sertifikasi',
      desc: 'Kemnaker RI, BNSP, atau Perpanjangan SKP',
      msg: 'Halo Wahana Totalita, saya butuh konsultasi mengenai sertifikasi K3 yang sesuai untuk saya/tim.',
      icon: '🎓',
    },
    {
      title: 'Penawaran In-House Training',
      desc: 'Pelatihan internal khusus perusahaan Anda',
      msg: 'Halo Wahana Totalita, perusahaan kami ingin meminta penawaran proposal in-house training K3.',
      icon: '🏢',
    },
  ];

  return (
    <div className="wa-dock-container" style={{ position: 'fixed', right: '24px', bottom: '24px', zIndex: 9999 }}>
      {/* App Popup Card */}
      {isOpen && (
        <div
          className="wa-popup-card"
          style={{
            position: 'absolute',
            bottom: '72px',
            right: '0',
            width: '320px',
            maxWidth: '90vw',
            background: '#ffffff',
            borderRadius: '18px',
            boxShadow: '0 20px 45px -10px rgba(15, 23, 42, 0.25), 0 0 0 1px rgba(15, 23, 42, 0.08)',
            overflow: 'hidden',
            animation: 'waFadeUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)',
          }}
        >
          {/* Header */}
          <div
            style={{
              background: 'linear-gradient(135deg, #103A5C 0%, #0B2C46 100%)',
              color: '#ffffff',
              padding: '16px 18px',
              display: 'flex',
              alignItems: 'center',
              justifyContent: 'space-between',
            }}
          >
            <div style={{ display: 'flex', alignItems: 'center', gap: '10px' }}>
              <div
                style={{
                  position: 'relative',
                  width: '38px',
                  height: '38px',
                  borderRadius: '50%',
                  background: '#25D366',
                  display: 'flex',
                  alignItems: 'center',
                  justifyContent: 'center',
                  color: '#fff',
                  fontWeight: 800,
                  fontSize: '18px',
                }}
              >
                WT
                <span
                  style={{
                    position: 'absolute',
                    bottom: '1px',
                    right: '1px',
                    width: '10px',
                    height: '10px',
                    background: '#10B981',
                    border: '2px solid #fff',
                    borderRadius: '50%',
                  }}
                />
              </div>
              <div>
                <div style={{ fontSize: '14px', fontWeight: 700 }}>Konsultan K3 Wahana</div>
                <div style={{ fontSize: '11px', color: '#94A3B8' }}>Respon cepat &lt; 5 menit</div>
              </div>
            </div>
            <button
              onClick={() => setIsOpen(false)}
              aria-label="Tutup konsultasi"
              style={{
                background: 'rgba(255, 255, 255, 0.1)',
                border: 'none',
                color: '#fff',
                width: '28px',
                height: '28px',
                borderRadius: '50%',
                cursor: 'pointer',
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'center',
                fontSize: '14px',
              }}
            >
              ✕
            </button>
          </div>

          {/* Body Options */}
          <div style={{ padding: '14px 14px 16px', background: '#F8FAFC' }}>
            <p style={{ margin: '0 0 10px', fontSize: '12.5px', color: '#64748B', fontWeight: 500 }}>
              Pilih kebutuhan Anda untuk terhubung langsung:
            </p>
            <div style={{ display: 'flex', flexDirection: 'column', gap: '8px' }}>
              {quickOptions.map((opt, i) => (
                <a
                  key={i}
                  href={`https://wa.me/${phone}?text=${encodeURIComponent(opt.msg)}`}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="wa-option-btn"
                  style={{
                    display: 'flex',
                    alignItems: 'center',
                    gap: '12px',
                    padding: '10px 12px',
                    borderRadius: '12px',
                    background: '#ffffff',
                    border: '1px solid #E2E8F0',
                    textDecoration: 'none',
                    transition: 'all 0.18s ease',
                  }}
                >
                  <span style={{ fontSize: '20px' }}>{opt.icon}</span>
                  <div style={{ textAlign: 'left', minWidth: 0 }}>
                    <div style={{ fontSize: '13px', fontWeight: 700, color: '#0F172A' }}>
                      {opt.title}
                    </div>
                    <div style={{ fontSize: '11px', color: '#64748B', lineHeight: 1.3 }}>
                      {opt.desc}
                    </div>
                  </div>
                </a>
              ))}
            </div>

            {/* Direct Open Link */}
            <a
              href={`https://wa.me/${phone}?text=${encodeURIComponent('Halo Wahana Totalita, saya ingin bertanya tentang program pelatihan')}`}
              target="_blank"
              rel="noopener noreferrer"
              style={{
                display: 'block',
                marginTop: '12px',
                textAlign: 'center',
                fontSize: '12px',
                fontWeight: 600,
                color: '#0B2C46',
                textDecoration: 'underline',
              }}
            >
              Buka WhatsApp Umum &rarr;
            </a>
          </div>
        </div>
      )}

      {/* Main Floating Trigger Button */}
      <button
        type="button"
        onClick={() => setIsOpen(!isOpen)}
        className="wa-float"
        aria-label="Konsultasi WhatsApp Wahana Totalita"
        style={{
          border: 'none',
          cursor: 'pointer',
          outline: 'none',
          position: 'relative',
        }}
      >
        {!isOpen && (
          <span className="wa-badge" aria-label="Online">
            1
          </span>
        )}
        <svg viewBox="0 0 24 24" fill="currentColor" width="28" height="28">
          <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z" />
        </svg>
      </button>
    </div>
  );
}

