import React from 'react';
import Link from 'next/link';
import { CheckCircle2, MessageCircle, ArrowRight } from 'lucide-react';
import Card, { CardBody, CardFooter } from '@/components/ui/Card';
import Badge from '@/components/ui/Badge';
import Button from '@/components/ui/Button';

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
    <Card hoverable className="group flex flex-col h-full">
      {/* Thumbnail Header */}
      <Link href={href} className="relative block aspect-[16/10] overflow-hidden bg-slate-100 shrink-0">
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
          <div className="absolute top-3 left-3">
            <Badge variant="brand" size="sm" className="shadow-sm uppercase">
              {catBadge}
            </Badge>
          </div>
        )}

        <div className="absolute bottom-3 left-3 right-3 flex items-center justify-between text-xs font-semibold text-white">
          <Badge variant="neutral" size="sm" className="bg-[#0B2C46]/80 text-white border-transparent backdrop-blur-md">
            {mode}
          </Badge>
          <Badge variant="accent" size="sm" className="shadow-sm">
            {certification}
          </Badge>
        </div>
      </Link>

      {/* Card Content Body */}
      <CardBody className="flex flex-col flex-1 p-5">
        <h3 className="font-display font-bold text-lg text-slate-900 group-hover:text-[#103A5C] transition-colors line-clamp-2 leading-snug mb-3">
          <Link href={href}>{title}</Link>
        </h3>

        {/* Feature Highlights */}
        {features.length > 0 && (
          <ul className="space-y-1.5 mb-5 flex-1">
            {features.slice(0, 3).map((feat, idx) => (
              <li key={idx} className="flex items-center gap-2 text-xs text-slate-600">
                <CheckCircle2 className="w-3.5 h-3.5 text-emerald-500 shrink-0" />
                <span className="truncate">{feat}</span>
              </li>
            ))}
          </ul>
        )}
      </CardBody>

      {/* Price & Action Footer */}
      <CardFooter className="mt-auto flex items-center justify-between gap-3">
        <div>
          {price ? (
            <div>
              <span className="text-xs text-slate-400 font-medium block">Mulai</span>
              <span className="font-extrabold text-base text-[#103A5C]">{price}</span>
              <span className="text-[11px] text-slate-500 ml-1">{priceUnit}</span>
            </div>
          ) : (
            <Badge variant="brand" size="sm">
              Jadwal Tersedia
            </Badge>
          )}
        </div>

        <div className="flex items-center gap-2">
          <Button
            href={href}
            variant="ghost"
            size="sm"
            className="p-2 border border-slate-200"
            aria-label={`Detail ${title}`}
          >
            <ArrowRight className="w-4 h-4" />
          </Button>

          <Button
            href={waUrl}
            isExternal
            variant="accent"
            size="sm"
            leftIcon={<MessageCircle className="w-3.5 h-3.5" />}
            className="bg-[#25D366] hover:bg-[#20ba5a] text-white"
          >
            Daftar
          </Button>
        </div>
      </CardFooter>
    </Card>
  );
}
