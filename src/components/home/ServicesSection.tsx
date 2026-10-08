import React from 'react';
import Link from 'next/link';

interface ServiceItem {
  href: string;
  icon: string;
  title: string;
  desc: string;
  count: string;
  accent: string;
}

const services: ServiceItem[] = [
  {
    href: '/keselamatan-kerja/',
    icon: '🦺',
    title: 'K3',
    desc: 'Keselamatan dan Kesehatan Kerja — program bersertifikasi BNSP & KEMNAKER RI mencakup seluruh sektor industri.',
    count: '86 Program',
    accent: '#C6621C',
  },
  {
    href: '/k3-lingkungan/',
    icon: '🌿',
    title: 'Lingkungan',
    desc: 'Pengelolaan Lingkungan Hidup — pelatihan pengelolaan limbah dan izin lingkungan bersertifikasi BNSP.',
    count: '16 Program',
    accent: '#0A4A2E',
  },
  {
    href: '/pelatihan-iso/',
    icon: '⚙️',
    title: 'System Management',
    desc: 'QHSE Awareness terintegrasi mencakup ISO 9001, ISO 14001, dan ISO 45001.',
    count: '22 Program',
    accent: '#2D7DD2',
  },
  {
    href: '/k3-pertambangan/',
    icon: '⛏️',
    title: 'Mining',
    desc: 'Pelatihan Pengawas Operasional Pertambangan — POP, POM, POU bersertifikasi BNSP.',
    count: '22 Program',
    accent: '#8B5A2B',
  },
];

export default function ServicesSection() {
  return (
    <section className="section-services" id="layanan">
      <div className="container">
        <div className="section-header">
          <p className="section-eyebrow">Layanan Kami</p>
          <h2 className="section-title">Bidang Pelatihan &amp; Sertifikasi</h2>
          <p className="section-subtitle">
            Empat bidang utama pelatihan bersertifikasi resmi KEMNAKER RI, BNSP, dan kompetensi.
          </p>
        </div>
        <div className="services-grid">
          {services.map((item, idx) => (
            <Link
              key={idx}
              href={item.href}
              className="service-card"
              data-reveal="up"
              data-reveal-delay={String(idx + 1)}
              style={{ '--accent': item.accent } as React.CSSProperties}
            >
              <div className="service-card-icon">{item.icon}</div>
              <h3 className="service-card-title">{item.title}</h3>
              <p className="service-card-desc">{item.desc}</p>
              <span className="service-card-count">{item.count}</span>
              <span className="service-card-arrow">→</span>
            </Link>
          ))}
        </div>
      </div>
    </section>
  );
}
