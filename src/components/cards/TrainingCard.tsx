import React from 'react';
import Link from 'next/link';
import { CheckCircle2, MessageCircle, ArrowRight } from 'lucide-react';

export interface TrainingCardProps {
  title: string;
  href: string;
  imageSrc: string;
  imageAlt: string;
  category?: string;
  catBadge?: string;
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
  catBadge,
  mode = 'Online & Tatap Muka',
  certification = 'Sertifikasi Resmi',
  features = [],
  price,
  priceUnit = '/orang',
  whatsappMessage,
}: TrainingCardProps) {
  const defaultWaMessage = `Halo Wahana Totalita, saya ingin informasi jadwal & pendaftaran ${title}`;
  const waUrl = `https://wa.me/6287759151278?text=${encodeURIComponent(
    whatsappMessage || defaultWaMessage
  )}`;

  return (
    <article className="group flex flex-col bg-white rounded-2xl border border-slate-200/90 shadow-sm hover:shadow-xl hover:border-slate-300 hover:-translate-y-1 transition-all duration-300 overflow-hidden">
      {/* Thumbnail Header */}
      <Link href={href} className="relative block aspect-[16/10] overflow-hidden bg-slate-100">
        <img
          src={imageSrc}
          alt={imageAlt}
          loading="lazy"
          decoding="async"
          width={400}
          height={250}
          className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
        />
        <div className="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent opacity-80" />
        
        {catBadge && (
          <span className="absolute top-3 left-3 px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-lg bg-white/95 backdrop-blur-md text-[#103A5C] shadow-sm">
            {catBadge}
          </span>
        )}

        <div className="absolute bottom-3 left-3 right-3 flex items-center justify-between text-xs font-semibold text-white">
          <span className="px-2.5 py-1 rounded-md bg-[#0B2C46]/80 backdrop-blur-md">
            {mode}
          </span>
          <span className="px-2.5 py-1 rounded-md bg-[#F06A25] shadow-sm">
            {certification}
          </span>
        </div>
      </Link>

      {/* Card Content Body */}
      <div className="flex flex-col flex-1 p-5">
        <h3 className="font-display font-bold text-lg text-slate-900 group-hover:text-[#103A5C] transition-colors line-clamp-2 leading-snug mb-3">
          <Link href={href}>{title}</Link>
        </h3>

        {/* Feature Highlights */}
        {features.length > 0 && (
          <ul className="space-y-1.5 mb-5 flex-1">
            {features.slice(0, 3).map((feat, idx) => (
              <li key={idx} className="flex items-center gap-2 text-xs text-slate-600">
                <CheckCircle2 className="w-3.5 h-3.5 text-[#10B981] shrink-0" />
                <span className="truncate">{feat}</span>
              </li>
            ))}
          </ul>
        )}

        {/* Price & Action Strip */}
        <div className="pt-4 border-t border-slate-100 mt-auto flex items-center justify-between gap-3">
          <div>
            {price ? (
              <div>
                <span className="text-xs text-slate-400 font-medium block">Mulai</span>
                <span className="font-extrabold text-base text-[#103A5C]">{price}</span>
                <span className="text-[11px] text-slate-500 ml-1">{priceUnit}</span>
              </div>
            ) : (
              <span className="text-xs font-bold text-[#103A5C] bg-[#E8F0F7] px-2.5 py-1 rounded-md">
                Jadwal Tersedia
              </span>
            )}
          </div>

          <div className="flex items-center gap-2">
            <Link
              href={href}
              className="p-2.5 rounded-xl border border-slate-200 text-slate-600 hover:text-[#103A5C] hover:bg-slate-50 transition-colors"
              aria-label={`Detail ${title}`}
            >
              <ArrowRight className="w-4 h-4" />
            </Link>

            <a
              href={waUrl}
              target="_blank"
              rel="noopener noreferrer"
              className="inline-flex items-center gap-1.5 px-3.5 py-2.5 rounded-xl text-xs font-bold bg-[#25D366] hover:bg-[#20ba5a] text-white shadow-sm hover:shadow transition-all"
              aria-label={`Daftar ${title} via WhatsApp`}
            >
              <MessageCircle className="w-4 h-4" />
              <span>Daftar</span>
            </a>
          </div>
        </div>
      </div>
    </article>
  );
}
