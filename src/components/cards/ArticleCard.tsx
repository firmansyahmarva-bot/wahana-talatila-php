import React from 'react';
import Link from 'next/link';

export interface ArticleCardProps {
  title: string;
  href: string;
  imageSrc: string;
  imageAlt: string;
  category?: string;
  categoryColor?: string;
  excerpt?: string;
  date?: string;
  featured?: boolean;
}

export default function ArticleCard({
  title,
  href,
  imageSrc,
  imageAlt,
  category = 'K3',
  categoryColor = '#C6621C',
  excerpt,
  date,
  featured = false,
}: ArticleCardProps) {
  return (
    <article className={`ak-card ${featured ? 'ak-card-featured' : ''}`}>
      <Link href={href} className="ak-card-img-wrap">
        <img
          src={imageSrc}
          alt={imageAlt}
          loading={featured ? 'eager' : 'lazy'}
          decoding="async"
          width={featured ? 600 : 400}
          height={featured ? 340 : 230}
        />
        {category && (
          <span className="ak-card-cat" style={{ background: categoryColor }}>
            {category}
          </span>
        )}
      </Link>
      <div className="ak-card-body">
        {date && <span className="ak-card-date">{date}</span>}
        <h3 className="ak-card-title">
          <Link href={href}>{title}</Link>
        </h3>
        {excerpt && <p className="ak-card-excerpt">{excerpt}</p>}
      </div>
    </article>
  );
}
