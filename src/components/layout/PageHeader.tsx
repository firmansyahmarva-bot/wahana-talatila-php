import React from 'react';
import Link from 'next/link';
import { ChevronRight } from 'lucide-react';

interface BreadcrumbItem {
  name: string;
  href?: string;
}

interface PageHeaderProps {
  eyebrow?: string;
  title: string;
  highlightTitle?: string;
  description?: string;
  breadcrumbs?: BreadcrumbItem[];
  badges?: string[];
  ctaText?: string;
  ctaHref?: string;
  children?: React.ReactNode;
}

export default function PageHeader({
  eyebrow,
  title,
  highlightTitle,
  description,
  breadcrumbs,
  badges,
  ctaText,
  ctaHref,
  children,
}: PageHeaderProps) {
  return (
    <section className="relative overflow-hidden bg-gradient-to-br from-[#16486E] via-[#103A5C] to-[#0B2C46] text-white pt-28 pb-14 md:pt-32 md:pb-16 border-b border-white/10">
      {/* Background Dot Texture */}
      <div 
        className="absolute inset-0 pointer-events-none opacity-40 bg-[radial-gradient(rgba(255,255,255,0.12)_1px,transparent_1px)] [background-size:20px_20px]" 
        aria-hidden="true"
      />

      <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Breadcrumbs */}
        {breadcrumbs && breadcrumbs.length > 0 && (
          <nav aria-label="Breadcrumb" className="flex items-center gap-2 text-xs text-slate-300 mb-4 flex-wrap">
            {breadcrumbs.map((crumb, idx) => (
              <React.Fragment key={idx}>
                {idx > 0 && <ChevronRight className="w-3.5 h-3.5 text-slate-400" />}
                {crumb.href ? (
                  <Link href={crumb.href} className="hover:text-white transition-colors">
                    {crumb.name}
                  </Link>
                ) : (
                  <span className="text-white font-medium">{crumb.name}</span>
                )}
              </React.Fragment>
            ))}
          </nav>
        )}

        {/* Eyebrow Pill */}
        {eyebrow && (
          <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#F06A25]/20 border border-[#F06A25]/40 text-[#FF8A3D] mb-4 shadow-sm">
            {eyebrow}
          </div>
        )}

        {/* Title */}
        <h1 className="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white mb-4 leading-tight font-display">
          {title}{' '}
          {highlightTitle && <span className="text-[#FF8A3D]">{highlightTitle}</span>}
        </h1>

        {/* Description */}
        {description && (
          <p className="text-base sm:text-lg text-slate-200 max-w-3xl leading-relaxed mb-6 font-sans">
            {description}
          </p>
        )}

        {/* Trust Badges */}
        {badges && badges.length > 0 && (
          <div className="flex flex-wrap gap-2 sm:gap-3 mb-6">
            {badges.map((badge, idx) => (
              <span
                key={idx}
                className="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs sm:text-sm font-semibold bg-white/10 backdrop-blur-md border border-white/20 text-white shadow-sm"
              >
                ✔ {badge}
              </span>
            ))}
          </div>
        )}

        {/* Optional Action / Children (e.g. search bar or filter buttons) */}
        {ctaText && ctaHref && (
          <div className="mt-4">
            <a
              href={ctaHref}
              target="_blank"
              rel="noopener noreferrer"
              className="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl font-bold text-sm bg-gradient-to-r from-[#25D366] to-[#128C7E] text-white shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all"
            >
              {ctaText}
            </a>
          </div>
        )}

        {children}
      </div>
    </section>
  );
}
