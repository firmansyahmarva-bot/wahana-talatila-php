import React from 'react';
import { notFound } from 'next/navigation';
import Link from 'next/link';
import trainingsData from '@/data/trainings.json';

interface TrainingCourse {
  name: string;
  short_name?: string;
  meta_title?: string;
  meta_desc?: string;
  wa_text?: string;
  description?: string;
  curriculum?: string[];
  long_content?: string;
  slug: string;
}

const trainingsMap = trainingsData as unknown as Record<string, TrainingCourse>;

export async function generateStaticParams() {
  return Object.keys(trainingsMap).map((slug) => ({
    slug,
  }));
}

export async function generateMetadata({ params }: { params: Promise<{ slug: string }> }) {
  const { slug } = await params;
  const course = trainingsMap[slug];
  if (!course) return {};

  return {
    title: course.meta_title || course.name,
    description: course.meta_desc || course.description?.slice(0, 160),
  };
}

export default async function TrainingDetailPage({ params }: { params: Promise<{ slug: string }> }) {
  const { slug } = await params;
  const course = trainingsMap[slug];

  if (!course) {
    notFound();
  }

  const waMessage = encodeURIComponent(course.wa_text || `Halo Wahana Totalita, saya ingin konsultasi pendaftaran ${course.name}`);
  const waUrl = `https://wa.me/6287759151278?text=${waMessage}`;

  return (
    <article className="page-wrapper">
      {/* HEADER */}
      <section style={{ background: 'linear-gradient(135deg, #0f172a 0%, #1e293b 100%)', color: '#fff', padding: '60px 0' }}>
        <div className="container">
          <p style={{ color: '#10b981', fontWeight: 700, fontSize: 13, textTransform: 'uppercase', marginBottom: 8 }}>
            🟢 Pelatihan &amp; Sertifikasi Resmi
          </p>
          <h1 style={{ fontSize: '2.2rem', fontWeight: 800, lineHeight: 1.3, marginBottom: 16 }}>
            {course.name}
          </h1>
          <p style={{ color: '#cbd5e1', fontSize: '1.05rem', maxWidth: 780, lineHeight: 1.6, marginBottom: 24 }}>
            {course.meta_desc}
          </p>
          <div style={{ display: 'flex', gap: 16, flexWrap: 'wrap' }}>
            <a
              href={waUrl}
              target="_blank"
              rel="noopener noreferrer"
              className="btn btn-primary"
              style={{ background: '#25D366', borderColor: '#25D366', padding: '12px 28px', fontWeight: 700 }}
            >
              Daftar Program via WhatsApp
            </a>
            <Link href="/pelatihan/" className="btn btn-outline" style={{ color: '#fff', borderColor: '#475569', padding: '12px 24px' }}>
              &larr; Katalog Pelatihan
            </Link>
          </div>
        </div>
      </section>

      {/* CONTENT & CURRICULUM */}
      <section style={{ padding: '60px 0', background: '#fff' }}>
        <div className="container" style={{ maxWidth: 900 }}>
          {course.description && (
            <div style={{ marginBottom: 40, fontSize: 16, lineHeight: 1.7, color: '#334155' }}>
              <h2 style={{ fontSize: 24, fontWeight: 700, color: '#0f172a', marginBottom: 16 }}>Deskripsi Program</h2>
              <p style={{ whiteSpace: 'pre-line' }}>{course.description}</p>
            </div>
          )}

          {course.curriculum && course.curriculum.length > 0 && (
            <div style={{ marginBottom: 40, background: '#f8fafc', padding: 32, borderRadius: 12, border: '1px solid #e2e8f0' }}>
              <h2 style={{ fontSize: 22, fontWeight: 700, color: '#0f172a', marginBottom: 20 }}>Materi &amp; Silabus Pelatihan</h2>
              <ul style={{ listStyle: 'none', padding: 0, margin: 0, display: 'flex', flexDirection: 'column', gap: 12 }}>
                {course.curriculum.map((item, idx) => (
                  <li key={idx} style={{ display: 'flex', gap: 12, alignItems: 'flex-start', color: '#334155', fontSize: 15 }}>
                    <span style={{ color: '#059669', fontWeight: 800 }}>✓</span>
                    <span>{item}</span>
                  </li>
                ))}
              </ul>
            </div>
          )}

          {course.long_content && (
            <div
              className="training-long-content"
              style={{ fontSize: 16, lineHeight: 1.7, color: '#334155' }}
              dangerouslySetInnerHTML={{ __html: course.long_content }}
            />
          )}

          {/* CTA BOX */}
          <div style={{ marginTop: 60, background: 'linear-gradient(135deg, #0284c7 0%, #0369a1 100%)', color: '#fff', padding: 36, borderRadius: 16, textAlign: 'center' }}>
            <h3 style={{ fontSize: 24, fontWeight: 800, marginBottom: 12 }}>Amankan Kuota Pelatihan Anda Sekarang</h3>
            <p style={{ fontSize: 15, opacity: 0.9, marginBottom: 24 }}>
              Dapatkan jadwal batch terdekat, rincian fasilitas, dan brosur resmi dari tim konsultan kami.
            </p>
            <a
              href={waUrl}
              target="_blank"
              rel="noopener noreferrer"
              className="btn btn-primary"
              style={{ background: '#25D366', borderColor: '#25D366', padding: '14px 32px', fontSize: 16, fontWeight: 700 }}
            >
              Hubungi Konsultan via WhatsApp
            </a>
          </div>
        </div>
      </section>
    </article>
  );
}
