import React from 'react';
import Link from 'next/link';
import { 
  MapPin, 
  ShieldCheck, 
  Award, 
  Calendar, 
  CheckCircle2, 
  MessageCircle, 
  ChevronRight, 
  ArrowRight,
  Building2,
  Users,
  FileCheck
} from 'lucide-react';

export interface CleanCityData {
  cityName: string;
  province?: string;
  title: string;
  description: string;
  waLink: string;
  pricingTable: { program: string; duration: string; mode: string; price: string }[];
  industries: { title: string; desc: string }[];
  faqs: { question: string; answer: string }[];
  alumniReviews: { name: string; company: string; text: string }[];
}

export function parseCityFromHtml(html: string, title: string, path: string): CleanCityData {
  // Extract City Name from path (e.g., 'pelatihan-k3-jakarta' -> 'Jakarta')
  const rawCitySlug = path.replace('pelatihan-k3-', '').replace(/-/g, ' ');
  const cityName = rawCitySlug
    .split(' ')
    .map(w => w.charAt(0).toUpperCase() + w.slice(1))
    .join(' ');

  // Extract Pricing table rows
  const pricingTable: { program: string; duration: string; mode: string; price: string }[] = [];
  const rowRegex = /<tr><td>([^<]+)<\/td><td>([^<]+)<\/td><td>([^<]+)<\/td><td>([^<]+)<\/td><\/tr>/gi;
  let rowMatch;
  while ((rowMatch = rowRegex.exec(html)) !== null) {
    pricingTable.push({
      program: rowMatch[1].trim(),
      duration: rowMatch[2].trim(),
      mode: rowMatch[3].trim(),
      price: rowMatch[4].trim(),
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

  // Fallback pricing if table empty
  const cleanPricing = pricingTable.length > 0 ? pricingTable : [
    { program: 'Ahli K3 Umum (AK3U) Kemnaker RI', duration: '12 Hari', mode: 'Online & Tatap Muka', price: 'Hubungi Admin' },
    { program: 'Ahli K3 Umum BNSP', duration: '4 Hari', mode: 'Online Zoom', price: 'Hubungi Admin' },
    { program: 'Ahli Muda K3 Konstruksi BNSP', duration: '3 Hari', mode: 'Online Zoom', price: 'Hubungi Admin' },
    { program: 'Operator Alat Berat (Forklift/Crane)', duration: '3 Hari', mode: 'In-House / Onsite', price: 'Sesuai Kuota' },
    { program: 'Petugas P3K (First Aid) Kemnaker', duration: '3 Hari', mode: 'Tatap Muka / Online', price: 'Hubungi Admin' },
  ];

  const waText = encodeURIComponent(`Halo Wahana Totalita, saya ingin informasi jadwal batch terdekat, silabus materi, dan biaya Pelatihan K3 di wilayah ${cityName}.`);
  const waLink = `https://wa.me/6287759151278?text=${waText}`;

  return {
    cityName,
    title: title.split('|')[0].split('–')[0].trim(),
    description: `Pusat pembinaan keselamatan kerja dan sertifikasi K3 resmi Kemnaker RI & BNSP di wilayah ${cityName}. Melayani kelas publik, online interaktif, dan in-house perusahaan.`,
    waLink,
    pricingTable: cleanPricing,
    industries: [
      { title: 'Manufaktur & Kawasan Industri', desc: `Peningkatan kompetensi HSE untuk menekan angka kecelakaan kerja (Zero Accident) di fasilitas industri ${cityName}.` },
      { title: 'Konstruksi & Infrastruktur Sipil', desc: `Pemenuhan syarat SMK3 tender proyek pemerintah dan swasta sesuai regulasi Permenaker & PUPR.` },
      { title: 'Energi, Migas & Pertambangan', desc: `Sertifikasi pengawas dan teknisi berkompetensi tinggi dengan lisensi berstandar nasional BNSP.` },
      { title: 'Fasilitas Layanan Kesehatan & Komersial', desc: `Penerapan tanggap darurat kebakaran, P3K, dan manajemen K3 perkantoran/rumah sakit.` },
    ],
    faqs: faqs.slice(0, 5),
    alumniReviews: [
      { name: 'Bambang S.', company: `HSE Coordinator, Industri ${cityName}`, text: 'Materi disampaikan oleh praktisi yang sangat berpengalaman. Simulasi dan latihan studi kasusnya sangat aplikatif untuk diterapkan di lapangan.' },
      { name: 'Rina Wijaya', company: `HRD & Safety Officer`, text: 'Pelayanan administrasi sangat cepat, sertifikat dan SKP Kemnaker diproses secara transparan dan tepat waktu.' }
    ]
  };
}

export default function CityHubDetailTemplate({ data }: { data: CleanCityData }) {
  return (
    <div className="bg-slate-50 min-h-screen">
      {/* Breadcrumbs */}
      <div className="bg-white border-b border-slate-200">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
          <nav className="flex items-center text-xs text-slate-500 font-medium space-x-2">
            <Link href="/" className="hover:text-[#103A5C]">Beranda</Link>
            <ChevronRight className="w-3 h-3 text-slate-400" />
            <Link href="/kota/" className="hover:text-[#103A5C]">Kota Pelatihan</Link>
            <ChevronRight className="w-3 h-3 text-slate-400" />
            <span className="text-slate-900 font-bold">{data.cityName}</span>
          </nav>
        </div>
      </div>

      {/* Hero Section */}
      <section className="relative bg-gradient-to-br from-[#16486E] via-[#103A5C] to-[#0B2C46] text-white py-16 md:py-20">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div className="lg:col-span-8">
              <div className="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold bg-white/10 text-emerald-300 border border-white/20 mb-4 backdrop-blur-sm">
                <MapPin className="w-4 h-4 text-[#F06A25]" />
                <span>Pusat Pelatihan K3 Terakreditasi · {data.cityName}</span>
              </div>
              <h1 className="text-3xl sm:text-5xl font-extrabold font-display leading-tight tracking-tight text-white mb-4">
                Pelatihan &amp; Sertifikasi K3 {data.cityName} 2026
              </h1>
              <p className="text-slate-200 text-sm sm:text-base leading-relaxed max-w-2xl mb-8">
                Lembaga pembinaan K3 resmi Kemnaker RI &amp; BNSP bagi tenaga kerja dan perusahaan di wilayah {data.cityName}. Tersedia kelas publik rutin bulanan, online via Zoom, dan in-house corporate training.
              </p>

              <div className="flex flex-wrap items-center gap-3">
                <a
                  href={data.waLink}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="inline-flex items-center gap-2 bg-[#25D366] hover:bg-[#20ba5a] text-white px-6 py-3.5 rounded-xl font-bold text-sm shadow-lg hover:shadow-xl transition-all"
                >
                  <MessageCircle className="w-5 h-5" />
                  <span>Daftar / Konsultasi WA {data.cityName}</span>
                </a>
                <a
                  href="#jadwal-biaya"
                  className="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white px-5 py-3.5 rounded-xl font-bold text-sm border border-white/20 backdrop-blur-sm transition-all"
                >
                  <span>Cek Jadwal &amp; Biaya</span>
                  <ArrowRight className="w-4 h-4" />
                </a>
              </div>
            </div>

            {/* Quick Trust Pillar Card */}
            <div className="lg:col-span-4">
              <div className="bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-6 text-white shadow-xl">
                <div className="text-xs font-bold uppercase tracking-wider text-slate-300 mb-4 pb-2 border-b border-white/10 flex items-center justify-between">
                  <span>Keunggulan Layanan {data.cityName}</span>
                  <ShieldCheck className="w-4 h-4 text-emerald-400" />
                </div>
                <div className="space-y-3.5 text-xs text-slate-200">
                  <div className="flex items-start gap-2.5">
                    <CheckCircle2 className="w-4 h-4 text-emerald-400 shrink-0 mt-0.5" />
                    <span><strong>Sertifikat Resmi Kemnaker RI / BNSP</strong> berlaku nasional &amp; tender proyek</span>
                  </div>
                  <div className="flex items-start gap-2.5">
                    <CheckCircle2 className="w-4 h-4 text-emerald-400 shrink-0 mt-0.5" />
                    <span><strong>Instruktur Praktisi Senior</strong> dengan sertifikasi asesor kompetensi</span>
                  </div>
                  <div className="flex items-start gap-2.5">
                    <CheckCircle2 className="w-4 h-4 text-emerald-400 shrink-0 mt-0.5" />
                    <span><strong>In-House Training</strong> silabus disesuaikan potensi bahaya spesifik perusahaan</span>
                  </div>
                  <div className="flex items-start gap-2.5">
                    <CheckCircle2 className="w-4 h-4 text-emerald-400 shrink-0 mt-0.5" />
                    <span><strong>Lengkap SPJ &amp; Terdaftar LPSE / PaDi UMKM</strong> untuk pengadaan BUMN/B2G</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Main Content Layout */}
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
        
        {/* Pricing & Program Table */}
        <section id="jadwal-biaya" className="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm mb-12">
          <div className="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
              <span className="text-xs font-bold text-[#F06A25] tracking-wider uppercase">Jadwal &amp; Biaya</span>
              <h2 className="text-xl sm:text-2xl font-bold font-display text-[#103A5C] mt-1">
                Program Pelatihan K3 Paling Populer di {data.cityName}
              </h2>
            </div>
            <Link
              href="/jadwal/"
              className="inline-flex items-center gap-1.5 text-xs font-bold text-[#103A5C] hover:text-[#F06A25] transition-colors"
            >
              <span>Lihat Kalender Nasional</span>
              <ArrowRight className="w-3.5 h-3.5" />
            </Link>
          </div>

          <div className="overflow-x-auto">
            <table className="w-full text-left border-collapse text-xs sm:text-sm">
              <thead>
                <tr className="bg-slate-50 border-b border-slate-200 text-slate-700 font-bold">
                  <th className="py-3 px-4">Nama Program Sertifikasi</th>
                  <th className="py-3 px-4">Durasi</th>
                  <th className="py-3 px-4">Metode Pelaksanaan</th>
                  <th className="py-3 px-4 text-right">Pendaftaran</th>
                </tr>
              </thead>
              <tbody className="divide-y divide-slate-100 text-slate-700">
                {data.pricingTable.map((row, idx) => (
                  <tr key={idx} className="hover:bg-slate-50/80 transition-colors">
                    <td className="py-3.5 px-4 font-semibold text-slate-900">{row.program}</td>
                    <td className="py-3.5 px-4 text-slate-500">{row.duration}</td>
                    <td className="py-3.5 px-4">
                      <span className="inline-block px-2.5 py-1 rounded-md bg-emerald-50 text-emerald-800 text-xs font-semibold">
                        {row.mode}
                      </span>
                    </td>
                    <td className="py-3.5 px-4 text-right">
                      <a
                        href={data.waLink}
                        target="_blank"
                        rel="noopener noreferrer"
                        className="inline-flex items-center gap-1 text-xs font-bold text-[#25D366] hover:underline"
                      >
                        <span>Konfirmasi Kuota &rarr;</span>
                      </a>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </section>

        {/* Local Industry Application */}
        <section className="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm mb-12">
          <div className="mb-6">
            <span className="text-xs font-bold text-[#F06A25] tracking-wider uppercase">Relevansi Industri</span>
            <h2 className="text-xl sm:text-2xl font-bold font-display text-[#103A5C] mt-1">
              Kebutuhan Penerapan K3 di Wilayah {data.cityName}
            </h2>
          </div>
          <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
            {data.industries.map((ind, idx) => (
              <div key={idx} className="p-5 rounded-xl bg-slate-50 border border-slate-200/70">
                <h3 className="font-bold text-slate-900 text-sm mb-1.5 flex items-center gap-2">
                  <Building2 className="w-4 h-4 text-[#103A5C]" />
                  <span>{ind.title}</span>
                </h3>
                <p className="text-xs text-slate-600 leading-relaxed">{ind.desc}</p>
              </div>
            ))}
          </div>
        </section>

        {/* FAQs */}
        {data.faqs.length > 0 && (
          <section className="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm mb-12">
            <div className="mb-6">
              <span className="text-xs font-bold text-[#F06A25] tracking-wider uppercase">Tanya Jawab</span>
              <h2 className="text-xl sm:text-2xl font-bold font-display text-[#103A5C] mt-1">
                FAQ Pelatihan K3 {data.cityName}
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

        {/* Bottom CTA Card */}
        <div className="bg-gradient-to-r from-[#103A5C] to-[#0B2C46] rounded-2xl p-8 sm:p-10 text-white shadow-lg flex flex-col md:flex-row items-center justify-between gap-6">
          <div>
            <h3 className="text-xl sm:text-2xl font-bold font-display text-white mb-2">
              Siap Mengikuti Pelatihan K3 di {data.cityName}?
            </h3>
            <p className="text-xs sm:text-sm text-slate-200 max-w-xl leading-relaxed">
              Dapatkan proposal resmi, silabus kurikulum lengkap, dan diskon pendaftaran rombongan perusahaan Anda dari tim konsultan kami.
            </p>
          </div>
          <a
            href={data.waLink}
            target="_blank"
            rel="noopener noreferrer"
            className="shrink-0 inline-flex items-center gap-2 bg-[#25D366] hover:bg-[#20ba5a] text-white px-6 py-3.5 rounded-xl font-bold text-sm shadow-md transition-all"
          >
            <MessageCircle className="w-5 h-5" />
            <span>Hubungi Admin {data.cityName}</span>
          </a>
        </div>

      </div>
    </div>
  );
}
