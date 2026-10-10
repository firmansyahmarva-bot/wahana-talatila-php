import React from 'react';
import Link from 'next/link';
import { 
  Calendar, 
  Clock, 
  ChevronRight, 
  Share2, 
  MessageCircle, 
  FileText, 
  CheckCircle2, 
  ShieldCheck,
  Building,
  HelpCircle
} from 'lucide-react';

export interface CleanArticleData {
  title: string;
  category: string;
  date?: string;
  readingTime?: string;
  image?: string;
  bodyHtml: string;
  faqs?: { question: string; answer: string }[];
  waLink: string;
}

export function parseArticleFromHtml(html: string, title: string, path: string): CleanArticleData {
  // Category extraction
  const catMatch = html.match(/class=["'][^"']*cat-badge[^"']*["'][^>]*>([^<]+)<\//i);
  const category = catMatch ? catMatch[1].trim() : 'K3';

  // Date extraction
  const dateMatch = html.match(/<time[^>]*>([\s\S]*?)<\/time>/i);
  const date = dateMatch ? dateMatch[1].replace(/<[^>]+>/g, '').trim() : '';

  // Reading time extraction
  const readMatch = html.match(/(\d+\s*menit\s*baca)/i);
  const readingTime = readMatch ? readMatch[1] : '5 menit baca';

  // Hero image
  const imgMatch = html.match(/<img[^>]+src=["']([^"']+)["'][^>]*alt=["']([^"']*)["'][^>]*>/i);
  const image = imgMatch ? imgMatch[1] : undefined;

  // Extract core body paragraphs (excluding legacy header, navbar, footer, sidebar)
  let cleanBody = html;
  
  // Strip out old navbar, footers, legacy headers, progress bar
  cleanBody = cleanBody
    .replace(/<div class=["']ak-progress-bar[\s\S]*?<\/div>/gi, '')
    .replace(/<header[\s\S]*?<\/header>/gi, '')
    .replace(/<aside[\s\S]*?<\/aside>/gi, '')
    .replace(/<nav[\s\S]*?<\/nav>/gi, '')
    .replace(/<footer[\s\S]*?<\/footer>/gi, '')
    .replace(/<style[\s\S]*?<\/style>/gi, '')
    .replace(/class=["'][^"']*ak-top-hook[\s\S]*?<\/div>\s*<\/div>/gi, '');

  const cleanTitle = title.split('|')[0].split('–')[0].split('-')[0].trim();
  const waText = encodeURIComponent(`Halo Wahana Totalita, saya sedang membaca artikel "${cleanTitle}" dan ingin konsultasi terkait sertifikasi/pelatihannya.`);
  const waLink = `https://wa.me/6287759151278?text=${waText}`;

  return {
    title: cleanTitle,
    category,
    date,
    readingTime,
    image,
    bodyHtml: cleanBody,
    waLink,
  };
}

export default function ArticleDetailTemplate({ data }: { data: CleanArticleData }) {
  return (
    <div className="bg-slate-50 min-h-screen">
      {/* Breadcrumb Bar */}
      <div className="bg-white border-b border-slate-200">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
          <nav className="flex items-center text-xs text-slate-500 font-medium space-x-2">
            <Link href="/" className="hover:text-[#103A5C]">Beranda</Link>
            <ChevronRight className="w-3 h-3 text-slate-400" />
            <Link href="/artikel/" className="hover:text-[#103A5C]">Panduan K3</Link>
            <ChevronRight className="w-3 h-3 text-slate-400" />
            <span className="text-slate-900 truncate max-w-xs sm:max-w-md">{data.title}</span>
          </nav>
        </div>
      </div>

      {/* Article Header Container */}
      <header className="bg-white border-b border-slate-200/80 pt-10 pb-12">
        <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-[#E8F0F7] text-[#103A5C] mb-4">
            <span>🦺 {data.category}</span>
          </div>

          <h1 className="text-2xl sm:text-4xl lg:text-4xl font-extrabold font-display text-[#103A5C] tracking-tight leading-tight mb-4">
            {data.title}
          </h1>

          <div className="flex flex-wrap items-center gap-4 text-xs text-slate-500 font-medium pb-6 border-b border-slate-100">
            <div className="flex items-center gap-1.5">
              <span className="w-6 h-6 rounded-full bg-[#103A5C] text-white flex items-center justify-center font-bold text-[10px]">WT</span>
              <span className="font-semibold text-slate-800">Wahana Totalita Tim Ahli K3</span>
            </div>
            {data.date && (
              <div className="flex items-center gap-1">
                <Calendar className="w-3.5 h-3.5 text-slate-400" />
                <span>{data.date}</span>
              </div>
            )}
            <div className="flex items-center gap-1">
              <Clock className="w-3.5 h-3.5 text-slate-400" />
              <span>{data.readingTime}</span>
            </div>
            <div className="flex items-center gap-1 text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded font-semibold">
              <ShieldCheck className="w-3.5 h-3.5" />
              <span>Ditinjau Praktisi Kemnaker</span>
            </div>
          </div>

          {/* Featured Image */}
          {data.image && (
            <div className="mt-8 rounded-2xl overflow-hidden shadow-sm border border-slate-200 max-h-[460px]">
              <img 
                src={data.image} 
                alt={data.title} 
                className="w-full h-full object-cover"
                loading="eager"
              />
            </div>
          )}
        </div>
      </header>

      {/* Main Body + Sidebar */}
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-10">
          
          {/* Article Main Text */}
          <div className="lg:col-span-8 bg-white rounded-2xl p-6 sm:p-10 border border-slate-200 shadow-xs">
            <div 
              className="legacy-prose prose-slate max-w-none text-slate-700 leading-relaxed"
              dangerouslySetInnerHTML={{ __html: data.bodyHtml }}
            />

            {/* Bottom In-Article CTA Banner */}
            <div className="mt-12 bg-gradient-to-br from-[#103A5C] to-[#0B2C46] rounded-2xl p-6 sm:p-8 text-white shadow-md">
              <div className="flex items-center gap-2 mb-2 text-xs font-bold text-[#FF8A3D] uppercase tracking-wider">
                <span>Butuh Sertifikasi Terkait Topik Ini?</span>
              </div>
              <h3 className="text-xl sm:text-2xl font-bold font-display text-white mb-2">
                Konsultasikan Kualifikasi &amp; Jadwal Pelatihan Resmi
              </h3>
              <p className="text-xs sm:text-sm text-slate-200 leading-relaxed mb-6">
                Wahana Totalita menyelenggarakan pembinaan sertifikasi Kemnaker RI &amp; BNSP untuk individu maupun in-house training perusahaan di seluruh Indonesia.
              </p>
              <div className="flex flex-wrap items-center gap-3">
                <a
                  href={data.waLink}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="inline-flex items-center gap-2 bg-[#25D366] hover:bg-[#20ba5a] text-white px-5 py-3 rounded-xl font-bold text-xs sm:text-sm shadow-sm transition-all"
                >
                  <MessageCircle className="w-4 h-4" />
                  <span>Tanya Info &amp; Biaya via WhatsApp</span>
                </a>
                <Link
                  href="/jadwal/"
                  className="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white px-4 py-3 rounded-xl font-bold text-xs border border-white/20 transition-all"
                >
                  <span>Cek Kalender Jadwal</span>
                </Link>
              </div>
            </div>
          </div>

          {/* Sidebar: Consultation Card */}
          <aside className="lg:col-span-4 space-y-6">
            <div className="sticky top-24 bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
              <div className="flex items-center gap-2 mb-3">
                <span className="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse" />
                <span className="text-xs font-bold text-slate-700 uppercase tracking-wider">Konsultasi Terbuka</span>
              </div>
              <h4 className="font-bold font-display text-base text-[#103A5C] mb-2">
                Punya Pertanyaan Seputar Topik Ini?
              </h4>
              <p className="text-xs text-slate-600 leading-relaxed mb-5">
                Spesialis regulasi dan instruktur kami siap membantu menjawab pertanyaan Anda terkait persyaratan, kurikulum, dan regulasi K3 terkini.
              </p>

              <a
                href={data.waLink}
                target="_blank"
                rel="noopener noreferrer"
                className="w-full inline-flex items-center justify-center gap-2 bg-[#25D366] hover:bg-[#20ba5a] text-white py-3 px-4 rounded-xl font-bold text-xs shadow-sm transition-all mb-4"
              >
                <MessageCircle className="w-4 h-4" />
                <span>Hubungi Konsultan via WA</span>
              </a>

              <div className="border-t border-slate-100 pt-4 space-y-2.5 text-xs text-slate-500">
                <div className="flex items-center gap-2">
                  <CheckCircle2 className="w-4 h-4 text-emerald-600 shrink-0" />
                  <span>Sertifikat Resmi Kemnaker RI &amp; BNSP</span>
                </div>
                <div className="flex items-center gap-2">
                  <CheckCircle2 className="w-4 h-4 text-emerald-600 shrink-0" />
                  <span>Jadwal Batch Fleksibel Online &amp; Offline</span>
                </div>
                <div className="flex items-center gap-2">
                  <CheckCircle2 className="w-4 h-4 text-emerald-600 shrink-0" />
                  <span>Fasilitas Lengkap &amp; Bebas Konsultasi</span>
                </div>
              </div>

              <div className="mt-6 pt-4 border-t border-slate-100">
                <Link
                  href="/artikel/"
                  className="text-xs font-bold text-[#103A5C] hover:text-[#F06A25] transition-colors flex items-center justify-between"
                >
                  <span>Jelajahi Semua Artikel K3</span>
                  <span>&rarr;</span>
                </Link>
              </div>
            </div>
          </aside>

        </div>
      </div>
    </div>
  );
}
