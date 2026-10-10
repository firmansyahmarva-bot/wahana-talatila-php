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
  readingTime?: string;
  featured?: boolean;
  headingLevel?: 'h2' | 'h3';
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
  readingTime,
  featured = false,
  headingLevel = 'h2',
}: ArticleCardProps) {
  const HeadingTag = headingLevel;

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
        {(date || readingTime) && (
          <div className="ak-card-meta">
            {date && <time>{date}</time>}
            {date && readingTime && <span>•</span>}
            {readingTime && <span>{readingTime}</span>}
          </div>
        )}
        <HeadingTag className="ak-card-title">
          <Link href={href}>{title}</Link>
        </HeadingTag>
        {excerpt && <p className="ak-card-desc">{excerpt}</p>}
        <Link href={href} className="ak-read-more">
          Baca selengkapnya <span>&rarr;</span>
        </Link>
      </div>
    </article>
  );
}
