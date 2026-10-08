import React from 'react';
import Link from 'next/link';

export interface TrainingCardProps {
  title: string;
  href: string;
  imageSrc: string;
  imageAlt: string;
  mode?: string;
  certification?: string;
  features?: string[];
  price?: string;
  priceUnit?: string;
  accentColor?: string;
  whatsappMessage?: string;
}

export default function TrainingCard({
  title,
  href,
  imageSrc,
  imageAlt,
  mode = 'Online',
  certification = 'Sertifikasi BNSP',
  features = [],
  price,
  priceUnit = '/orang',
  accentColor = '#C6621C',
  whatsappMessage,
}: TrainingCardProps) {
  const defaultWaMessage = `Halo Wahana Totalita, saya ingin konsultasi pendaftaran ${title}`;
  const waUrl = `https://wa.me/6287759151278?text=${encodeURIComponent(
    whatsappMessage || defaultWaMessage
  )}`;

  return (
    <article
      className="training-card"
      data-reveal="up"
      data-reveal-delay="1"
      style={{ '--accent': accentColor } as React.CSSProperties}
    >
      <Link href={href} className="training-card-thumb" tabIndex={-1} aria-hidden="true">
        <img
          src={imageSrc}
          alt={imageAlt}
          loading="lazy"
          decoding="async"
          width={400}
          height={250}
        />
      </Link>
      <div className="training-card-body">
        <div className="training-card-meta">
          {mode && <span className="badge-mode">{mode}</span>}
          {certification && <span className="badge-cert">{certification}</span>}
        </div>
        <h3 className="training-card-title">
          <Link href={href}>{title}</Link>
        </h3>
        {features.length > 0 && (
          <ul className="training-card-features">
            {features.map((feat, idx) => (
              <li key={idx}>
                <span className="tcf-ico">✓</span> {feat}
              </li>
            ))}
          </ul>
        )}
        <div className="training-card-footer">
          {price && (
            <span className="training-price">
              {price} <small>{priceUnit}</small>
            </span>
          )}
          <a
            href={waUrl}
            target="_blank"
            rel="noopener noreferrer"
            className="btn-wa-card"
            aria-label={`Daftar ${title} via WhatsApp`}
          >
            Daftar
          </a>
        </div>
      </div>
    </article>
  );
}
