import React from 'react';
import { 
  ShieldCheck, 
  Award, 
  MapPin, 
  CheckCircle2, 
  Clock, 
  BookOpen, 
  FileText, 
  HelpCircle, 
  Phone, 
  MessageCircle, 
  ChevronRight,
  ArrowRight
} from 'lucide-react';
import Link from 'next/link';

export interface CleanCourseData {
  title: string;
  city?: string;
  description?: string;
  metaDesc?: string;
  waLink: string;
  image?: string;
  facts: { label: string; value: string }[];
  steps: { step: string; title: string; desc: string }[];
  competencies: { title: string; desc: string }[];
  faqs: { question: string; answer: string }[];
  relatedCourses?: { title: string; href: string; desc: string }[];
}

// Lightweight HTML parser to extract structured content from legacy template
export function parseCourseFromHtml(html: string, title: string, path: string): CleanCourseData {
  const cityMatch = html.match(/data-city=["']([^"']+)["']/i) || html.match(/·\s*([A-Za-z\s]+)<\/span>/i);
  const city = cityMatch ? cityMatch[1].trim() : 'Nasional';

  // Extract clean facts
  const facts: { label: string; value: string }[] = [];
  const factRegex = /<div class=["']fact["']><b>([^<]+)<\/b>([^<]+)<\/div>/gi;
  let factMatch;
  while ((factMatch = factRegex.exec(html)) !== null) {
    facts.push({
      label: factMatch[1].trim(),
      value: factMatch[2].trim(),
    });
  }

  // Extract steps / workflow
  const steps: { step: string; title: string; desc: string }[] = [];
  const stepRegex = /<h3>(\d+)\s*[^A-Za-z0-9]*\s*([A-Za-z\s]+)<\/h3><p>([^<]+)<\/p>/gi;
  let stepMatch;
  while ((stepMatch = stepRegex.exec(html)) !== null) {
    const rawTitle = stepMatch[2].trim();
    // Default fallback titles if single character corrupted
    const cleanTitle = rawTitle.length > 2 ? rawTitle : (
      stepMatch[1] === '01' ? 'Konsultasi & Verifikasi' :
      stepMatch[1] === '02' ? 'Pembelajaran Teori' :
      stepMatch[1] === '03' ? 'Praktik & Simulasi' :
      'Evaluasi & Sertifikasi'
    );
    steps.push({
      step: stepMatch[1].trim(),
      title: cleanTitle,
      desc: stepMatch[3].trim(),
    });
  }


  // Extract FAQs
  const faqs: { question: string; answer: string }[] = [];
  const faqRegex = /<details[^>]*><summary>([^<]+)<\/summary><p>([^<]+)<\/p><\/details>/gi;
  let faqMatch;
  while ((faqMatch = faqRegex.exec(html)) !== null) {
    faqs.push({
      question: faqMatch[1].trim(),
      answer: faqMatch[2].trim(),
    });
  }

  // Extract competencies
  const competencies: { title: string; desc: string }[] = [];
  const compRegex = /<article class=["']card["']><h3>([^<]+)<\/h3><p>([^<]+)<\/p><\/article>/gi;
  let compMatch;
  while ((compMatch = compRegex.exec(html)) !== null) {
    // Only add if not duplicate of steps
    const t = compMatch[1].trim();
    if (!t.match(/^\d+/)) {
      competencies.push({
        title: t,
        desc: compMatch[2].trim(),
      });
    }
  }

  const cleanCourseTitle = title.split('|')[0].split('–')[0].split('-')[0].trim();
  const waText = encodeURIComponent(`Halo Wahana Totalita, saya ingin informasi dan jadwal untuk ${cleanCourseTitle} di ${city}.`);
  const waLink = `https://wa.me/6287759151278?text=${waText}`;

  return {
    title: cleanCourseTitle,
    city,
    waLink,
    facts: facts.length > 0 ? facts : [
      { label: 'Sertifikasi', value: 'Resmi Kemnaker / BNSP' },
      { label: 'Metode', value: 'Teori & Praktik' },
      { label: 'Mode', value: 'Online / Tatap Muka' },
      { label: 'Fasilitas', value: 'Modul & Sertifikat' },
    ],
    steps: steps.slice(0, 4),
    competencies: competencies.slice(0, 4),
    faqs: faqs.slice(0, 5),
  };
}

export default function CourseDetailTemplate({ data }: { data: CleanCourseData }) {
  return (
    <div className="bg-slate-50 min-h-screen">
      {/* Modern Breadcrumb */}
      <div className="bg-white border-b border-slate-200">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
          <nav className="flex items-center text-xs text-slate-500 font-medium space-x-2">
            <Link href="/" className="hover:text-[#103A5C]">Beranda</Link>
            <ChevronRight className="w-3 h-3 text-slate-400" />
            <Link href="/pelatihan/" className="hover:text-[#103A5C]">Pelatihan</Link>
            <ChevronRight className="w-3 h-3 text-slate-400" />
            <span className="text-slate-900 truncate max-w-xs sm:max-w-md">{data.title}</span>
          </nav>
        </div>
      </div>

      {/* Hero Section */}
      <section className="relative bg-gradient-to-br from-[#16486E] via-[#103A5C] to-[#0B2C46] text-white py-14 md:py-20">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div className="lg:col-span-8">
              <div className="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-bold bg-white/10 text-emerald-300 border border-white/20 mb-4 backdrop-blur-sm">
                <ShieldCheck className="w-4 h-4 text-emerald-400" />
                <span>Sertifikasi Resmi Kemnaker RI &amp; BNSP · Wilayah {data.city}</span>
              </div>
              <h1 className="text-2xl sm:text-4xl lg:text-5xl font-extrabold font-display leading-tight tracking-tight text-white mb-4">
                {data.title}
              </h1>
              <p className="text-slate-200 text-sm sm:text-base leading-relaxed max-w-2xl mb-8">
                Tingkatkan kompetensi kerja dan penuhi standar kepatuhan regulasi K3 nasional bersama instruktur berpengalaman. Tersedia kelas publik, online via Zoom, dan in-house perusahaan di {data.city}.
              </p>

              <div className="flex flex-wrap items-center gap-3">
                <a
                  href={data.waLink}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="inline-flex items-center gap-2 bg-[#25D366] hover:bg-[#20ba5a] text-white px-6 py-3.5 rounded-xl font-bold text-sm shadow-lg hover:shadow-xl transition-all"
                >
                  <MessageCircle className="w-5 h-5" />
                  <span>Daftar / Tanya Biaya via WhatsApp</span>
                </a>
                <Link
                  href="/jadwal/"
                  className="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white px-5 py-3.5 rounded-xl font-bold text-sm border border-white/20 backdrop-blur-sm transition-all"
                >
                  <span>Cek Kalender Jadwal</span>
                  <ArrowRight className="w-4 h-4" />
                </Link>
              </div>
            </div>

            {/* Quick Summary Card */}
            <div className="lg:col-span-4">
              <div className="bg-white rounded-2xl p-6 text-slate-800 shadow-xl border border-slate-100">
                <h2 className="text-base font-bold font-display text-[#103A5C] mb-4 pb-3 border-b border-slate-100 flex items-center justify-between">
                  <span>Ringkasan Program</span>
                  <Award className="w-5 h-5 text-[#F06A25]" />
                </h2>
                <div className="space-y-3">
                  {data.facts.map((f, i) => (
                    <div key={i} className="flex items-center justify-between text-xs py-1.5 border-b border-slate-50 last:border-none">
                      <span className="text-slate-500 font-medium">{f.label}</span>
                      <span className="font-bold text-slate-800">{f.value}</span>
                    </div>
                  ))}
                </div>
                <div className="mt-6 pt-4 border-t border-slate-100">
                  <div className="flex items-center gap-2 text-xs text-emerald-700 bg-emerald-50 p-2.5 rounded-lg font-semibold">
                    <CheckCircle2 className="w-4 h-4 flex-shrink-0" />
                    <span>Lengkap Modul, Ujian, &amp; Sertifikat Resmi</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Main Content Details */}
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-10">
          <div className="lg:col-span-8 space-y-12">
            
            {/* Steps / Alur Pelatihan */}
            {data.steps.length > 0 && (
              <section className="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/80 shadow-sm">
                <div className="mb-6">
                  <span className="text-xs font-bold text-[#F06A25] tracking-wider uppercase">Alur Program</span>
                  <h2 className="text-xl sm:text-2xl font-bold font-display text-[#103A5C] mt-1">
                    Tahapan Pelatihan hingga Sertifikasi
                  </h2>
                </div>
                <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  {data.steps.map((s, idx) => (
                    <div key={idx} className="p-4 rounded-xl bg-slate-50 border border-slate-200/60 flex flex-col justify-between">
                      <div>
                        <span className="inline-block px-2.5 py-1 rounded-md bg-[#103A5C] text-white text-xs font-bold mb-2">
                          Tahap {s.step}
                        </span>
                        <h3 className="font-bold text-slate-900 text-sm mb-1">{s.title}</h3>
                        <p className="text-xs text-slate-600 leading-relaxed">{s.desc}</p>
                      </div>
                    </div>
                  ))}
                </div>
              </section>
            )}

            {/* Scope / Materi Utama */}
            {data.competencies.length > 0 && (
              <section className="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/80 shadow-sm">
                <div className="mb-6">
                  <span className="text-xs font-bold text-[#F06A25] tracking-wider uppercase">Materi Pembelajaran</span>
                  <h2 className="text-xl sm:text-2xl font-bold font-display text-[#103A5C] mt-1">
                    Ruang Lingkup Kompetensi &amp; Praktik
                  </h2>
                </div>
                <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  {data.competencies.map((c, idx) => (
                    <div key={idx} className="p-4 rounded-xl bg-emerald-50/40 border border-emerald-100 flex gap-3">
                      <CheckCircle2 className="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" />
                      <div>
                        <h3 className="font-bold text-slate-900 text-sm mb-1">{c.title}</h3>
                        <p className="text-xs text-slate-600 leading-relaxed">{c.desc}</p>
                      </div>
                    </div>
                  ))}
                </div>
              </section>
            )}

            {/* FAQ Accordion */}
            {data.faqs.length > 0 && (
              <section className="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/80 shadow-sm">
                <div className="mb-6">
                  <span className="text-xs font-bold text-[#F06A25] tracking-wider uppercase">Tanya Jawab</span>
                  <h2 className="text-xl sm:text-2xl font-bold font-display text-[#103A5C] mt-1">
                    Pertanyaan yang Sering Diajukan (FAQ)
                  </h2>
                </div>
                <div className="space-y-3">
                  {data.faqs.map((faq, idx) => (
                    <details key={idx} className="group border border-slate-200 rounded-xl p-4 bg-slate-50/50 open:bg-white transition-all">
                      <summary className="font-bold text-slate-900 text-sm cursor-pointer list-none flex items-center justify-between">
                        <span>{faq.question}</span>
                        <ChevronRight className="w-4 h-4 text-slate-400 group-open:rotate-90 transition-transform flex-shrink-0 ml-2" />
                      </summary>
                      <p className="mt-3 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        {faq.answer}
                      </p>
                    </details>
                  ))}
                </div>
              </section>
            )}

          </div>

          {/* Right Sidebar: Sticky Registration Consultation Dock */}
          <div className="lg:col-span-4 space-y-6">
            <div className="sticky top-24 bg-white rounded-2xl p-6 border border-slate-200/90 shadow-lg">
              <div className="flex items-center gap-2 mb-3">
                <span className="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse" />
                <span className="text-xs font-bold uppercase tracking-wider text-emerald-700">Pendaftaran Aktif</span>
              </div>
              <h3 className="font-bold font-display text-lg text-[#103A5C] mb-2">
                Konsultasi &amp; Pendaftaran Batch
              </h3>
              <p className="text-xs text-slate-600 leading-relaxed mb-6">
                Butuh proposal pelatihan, silabus lengkap, penawaran harga perusahaan (in-house), atau konfirmasi kuota batch terdekat di {data.city}? Hubungi kami langsung.
              </p>

              <div className="space-y-3 mb-6">
                <a
                  href={data.waLink}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="w-full inline-flex items-center justify-center gap-2 bg-[#25D366] hover:bg-[#20ba5a] text-white py-3.5 px-4 rounded-xl font-bold text-sm shadow-md transition-all"
                >
                  <MessageCircle className="w-5 h-5" />
                  <span>Chat WhatsApp Admin</span>
                </a>
                <Link
                  href="/jadwal/"
                  className="w-full inline-flex items-center justify-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-800 py-3 px-4 rounded-xl font-bold text-xs transition-all"
                >
                  <span>Lihat Jadwal Seluruh Kota</span>
                </Link>
              </div>

              <div className="border-t border-slate-100 pt-4 space-y-2 text-xs text-slate-500">
                <div className="flex items-center gap-2">
                  <ShieldCheck className="w-4 h-4 text-emerald-600" />
                  <span>PJK3 Resmi Terakreditasi Kemnaker RI</span>
                </div>
                <div className="flex items-center gap-2">
                  <Award className="w-4 h-4 text-[#F06A25]" />
                  <span>Sertifikat Berlaku Nasional &amp; Tender</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
