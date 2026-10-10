import React from 'react';
import Link from 'next/link';
import { Calendar, Clock, ArrowRight } from 'lucide-react';

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
  categoryColor = '#F06A25',
  excerpt,
  date,
  readingTime,
  featured = false,
  headingLevel = 'h2',
}: ArticleCardProps) {
  const HeadingTag = headingLevel;

  return (
    <article
      className={`group bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover:border-slate-300 shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col ${
        featured ? 'md:grid md:grid-cols-12 md:gap-6' : ''
      }`}
    >
      {/* Image Thumbnail Wrap */}
      <Link
        href={href}
        className={`relative block overflow-hidden bg-slate-100 ${
          featured ? 'md:col-span-7 aspect-[16/10]' : 'aspect-[16/10]'
        }`}
      >
        <img
          src={imageSrc}
          alt={imageAlt}
          loading={featured ? 'eager' : 'lazy'}
          decoding="async"
          width={featured ? 600 : 400}
          height={featured ? 375 : 250}
          className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
        />
        {category && (
          <span
            className="absolute top-3 left-3 px-3 py-1 rounded-full text-xs font-bold text-white shadow-sm backdrop-blur-xs"
            style={{ backgroundColor: categoryColor || '#F06A25' }}
          >
            {category}
          </span>
        )}
      </Link>

      {/* Card Content Body */}
      <div
        className={`p-5 sm:p-6 flex flex-col flex-grow justify-between ${
          featured ? 'md:col-span-5 md:py-6 md:pr-6 md:pl-0' : ''
        }`}
      >
        <div>
          {/* Metadata Bar */}
          {(date || readingTime) && (
            <div className="flex items-center gap-3 text-xs text-slate-400 font-medium mb-3">
              {date && (
                <div className="flex items-center gap-1">
                  <Calendar className="w-3.5 h-3.5 text-slate-400" />
                  <time>{date}</time>
                </div>
              )}
              {date && readingTime && <span>•</span>}
              {readingTime && (
                <div className="flex items-center gap-1">
                  <Clock className="w-3.5 h-3.5 text-slate-400" />
                  <span>{readingTime}</span>
                </div>
              )}
            </div>
          )}

          {/* Title */}
          <HeadingTag className="font-display font-bold text-slate-900 group-hover:text-[#103A5C] transition-colors leading-snug tracking-tight mb-2.5 text-base sm:text-lg line-clamp-2">
            <Link href={href} className="focus:outline-hidden">
              {title}
            </Link>
          </HeadingTag>

          {/* Excerpt */}
          {excerpt && (
            <p className="text-xs sm:text-sm text-slate-600 leading-relaxed line-clamp-3 mb-4">
              {excerpt}
            </p>
          )}
        </div>

        {/* Read More Link */}
        <div className="pt-3 border-t border-slate-100 mt-auto">
          <Link
            href={href}
            className="inline-flex items-center gap-1.5 text-xs font-bold text-[#103A5C] group-hover:text-[#F06A25] transition-colors"
          >
            <span>Baca Panduan Lengkap</span>
            <ArrowRight className="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" />
          </Link>
        </div>
      </div>
    </article>
  );
}
