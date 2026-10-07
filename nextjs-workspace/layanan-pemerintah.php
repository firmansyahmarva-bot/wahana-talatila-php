<?php
/**
 * layanan-pemerintah.php
 * B2G & Procurement landing page:
 * Targets:
 *   "vendor pelatihan k3", "vendor k3", "vendor k3 pemerintah",
 *   "penyedia pelatihan k3 lpse", "pengadaan pelatihan k3 bumn",
 *   "pelatihan k3 dinas", "jasa training k3 instansi pemerintah"
 *
 * Integrated with site navbar, full footer, rich internal links,
 * modern glassmorphism styling, and Schema.org FAQ & Service markup.
 */
require_once __DIR__ . '/config.php';
$s = get_all_settings();

$wa_number  = preg_replace('/\D/', '', get_setting('wa_number', '6287759151278'));
$phone_disp = '0' . substr($wa_number, 2);
$phone_disp = trim(chunk_split($phone_disp, 4, '-'), '-');

$wa_tender_msg   = 'Halo Wahana Totalita, kami dari instansi pemerintah/BUMN ingin konsultasi pengadaan pelatihan K3 dan permohonan RAB resmi. Mohon informasinya.';
$wa_inhouse_msg  = 'Halo Wahana Totalita, kami ingin mengajukan penawaran In-House Training K3 untuk instansi kami. Mohon kirimkan company profile dan proposal.';
$wa_url          = "https://wa.me/{$wa_number}?text=" . rawurlencode($wa_tender_msg);
$wa_inhouse_url  = "https://wa.me/{$wa_number}?text=" . rawurlencode($wa_inhouse_msg);
$year            = date('Y');

$page_title = 'Vendor Pelatihan K3 Pemerintah & BUMN — Pengadaan Resmi LPSE';
$meta_desc  = 'Vendor pelatihan K3 resmi Kemnaker RI & BNSP untuk pengadaan instansi pemerintah, BUMN, kementerian, dan dinas. Siap SPK pengadaan langsung, LPSE, dan RAB 24 jam.';
$canonical  = 'https://wahanatotalita.com/layanan-pemerintah';

require __DIR__ . '/includes/head.php';
?>

<!-- JSON-LD Structured Data: ProfessionalService & FAQPage for Rich Snippets -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "ProfessionalService",
      "@id": "https://wahanatotalita.com/layanan-pemerintah#service",
      "name": "Vendor Pelatihan K3 & Pengadaan B2G Wahana Totalita Konsultan",
      "alternateName": "Penyedia Jasa Pelatihan K3 Instansi Pemerintah & BUMN",
      "serviceType": "Vendor Pelatihan K3, In-House Safety Training, & Sertifikasi Resmi",
      "provider": {
        "@type": "EducationalOrganization",
        "name": "Wahana Totalita Konsultan",
        "url": "https://wahanatotalita.com",
        "telephone": "+<?= e($wa_number) ?>",
        "email": "info@wahanatotalita.com",
        "address": {
          "@type": "PostalAddress",
          "streetAddress": "Jl. Wonosari KM 8.5",
          "addressLocality": "Sleman",
          "addressRegion": "Daerah Istimewa Yogyakarta",
          "addressCountry": "ID"
        }
      },
      "areaServed": {
        "@type": "Country",
        "name": "Indonesia"
      },
      "description": "Vendor pelatihan K3 resmi Kemnaker RI dan lembaga terakreditasi BNSP untuk pengadaan instansi pemerintah, BUMN, dinas daerah, dan kementerian di seluruh Indonesia. Mendukung SPK pengadaan langsung, penunjukan langsung, dan tender LPSE.",
      "hasOfferCatalog": {
        "@type": "OfferCatalog",
        "name": "Paket Pengadaan Pelatihan K3 Instansi",
        "itemListElement": [
          {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Pelatihan Ahli K3 Umum Sertifikasi Kemnaker RI"}},
          {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Pelatihan K3 Operator Forklift & Alat Berat"}},
          {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Pelatihan & Simulasi Tanggap Darurat Kebakaran K3"}},
          {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Pelatihan Petugas P3K di Tempat Kerja"}},
          {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "In-House Training K3 & Pendampingan SMK3 PP 50/2012"}}
        ]
      }
    },
    {
      "@type": "FAQPage",
      "@id": "https://wahanatotalita.com/layanan-pemerintah#faq",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "Apakah Wahana Totalita memenuhi syarat legalitas sebagai vendor pengadaan pemerintah?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Ya, kami memiliki legalitas perseroan lengkap (NIB Berbasis Risiko, NPWP & PKP aktif, SPT Tahunan, rekening giro atas nama perusahaan PT) serta memiliki SKP PJK3 Resmi dari Kemnaker RI dan lisensi skema BNSP."
          }
        },
        {
          "@type": "Question",
          "name": "Mekanisme pengadaan apa saja yang dapat difasilitasi?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Kami siap melayani mekanisme Pengadaan Langsung melalui Surat Perintah Kerja (SPK), Penunjukan Langsung, maupun tender/seleksi melalui sistem SPSE/LPSE dan E-Katalog sesuai ketentuan pagu anggaran instansi."
          }
        },
        {
          "@type": "Question",
          "name": "Apakah instansi dapat meminta penyusunan Rencana Anggaran Biaya (RAB) dan proposal teknis (SPH)?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Bisa. Tim kami dapat membantu PPK, PPTK, atau panitia pengadaan dalam menyiapkan draf Kerangka Acuan Kerja (KAK/TOR), Surat Penawaran Harga (SPH), Rencana Anggaran Biaya (RAB) rincian komponen, hingga profil instruktur dalam waktu 1x24 jam."
          }
        },
        {
          "@type": "Question",
          "name": "Apakah melayani paket all-in (pelatihan, hotel/akomodasi, katering, dan transportasi)?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Ya. Untuk mempermudah pelaporan dan pertanggungjawaban SPJ instansi, kami menyediakan paket all-in yang mencakup ruang diklat/hotel, akomodasi penginapan peserta dinas, katering, modul pelatihan, APD praktikum, sertifikasi resmi, dan BAST lengkap."
          }
        },
        {
          "@type": "Question",
          "name": "Apakah Wahana Totalita dapat menyelenggarakan In-House Training di luar kota / seluruh Indonesia?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Sangat bisa. Kami telah berpengalaman menyelenggarakan pelatihan K3 in-house di kantor instansi pemerintah, balai diklat, fasilitas BUMN, dan proyek lapangan di berbagai provinsi dari Sumatra, Jawa, Kalimantan, Sulawesi, hingga Papua."
          }
        }
      ]
    }
  ]
}
</script>

<style id="gov-modern-css">
/* ═════════════════════════════════════════════════════════════
   B2G VENDOR PELATIHAN K3 — MODERN STYLING
   Scoped strictly under .gov-page / .gov-* to eliminate CSS collision
   ═════════════════════════════════════════════════════════════ */
.gov-page {
  font-family: 'Source Sans 3', system-ui, -apple-system, sans-serif;
  color: #1e293b;
  line-height: 1.7;
  background-color: #f8fafc;
}
.gov-page a {
  text-decoration: none;
  transition: color 0.15s ease, border-color 0.15s ease;
}

/* ─── Hero Section ─────────────────────────────────────────── */
.gov-hero {
  min-height: auto !important;
  display: block !important;
  position: relative;
  background: radial-gradient(1000px circle at 85% 15%, rgba(16, 185, 129, 0.22) 0%, rgba(10, 74, 46, 0.45) 40%, #071524 95%), #050d18;
  color: #ffffff;
  padding: 68px 0 76px;
  overflow: hidden;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
}
.gov-hero::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: radial-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px);
  background-size: 24px 24px;
  pointer-events: none;
  opacity: 0.7;
}
.gov-hero-inner {
  position: relative;
  z-index: 2;
  max-width: 900px;
}
.gov-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(16, 185, 129, 0.15);
  border: 1px solid rgba(52, 211, 153, 0.35);
  padding: 6px 14px;
  border-radius: 999px;
  font-family: 'Lexend', sans-serif;
  font-size: 12.5px;
  font-weight: 700;
  color: #6ee7b7;
  letter-spacing: 0.04em;
  text-transform: uppercase;
  margin-bottom: 20px;
  backdrop-filter: blur(8px);
}
.gov-eyebrow-icon {
  font-size: 14px;
}
.gov-hero h1 {
  font-family: 'Lexend', sans-serif;
  font-size: clamp(2rem, 4.4vw, 3.1rem);
  font-weight: 800;
  line-height: 1.18;
  letter-spacing: -0.025em;
  color: #ffffff;
  margin-bottom: 18px;
}
.gov-hero h1 .highlight {
  background: linear-gradient(135deg, #34d399 0%, #60a5fa 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.gov-hero-lede {
  font-size: clamp(1.05rem, 1.8vw, 1.2rem);
  color: #cbd5e1;
  max-width: 780px;
  margin-bottom: 30px;
  font-weight: 400;
  line-height: 1.68;
}
.gov-hero-actions {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-bottom: 36px;
}
.gov-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  font-family: 'Lexend', sans-serif;
  font-size: 15px;
  font-weight: 700;
  padding: 14px 26px;
  border-radius: 10px;
  cursor: pointer;
  transition: transform 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
}
.gov-btn-primary {
  background: #059669;
  color: #ffffff !important;
  border: 1px solid #10b981;
  box-shadow: 0 4px 14px rgba(5, 150, 105, 0.4);
}
.gov-btn-primary:hover {
  background: #047857;
  transform: translateY(-2px);
  box-shadow: 0 8px 22px rgba(5, 150, 105, 0.5);
  color: #ffffff !important;
}
.gov-btn-secondary {
  background: rgba(255, 255, 255, 0.08);
  color: #ffffff !important;
  border: 1px solid rgba(255, 255, 255, 0.22);
  backdrop-filter: blur(8px);
}
.gov-btn-secondary:hover {
  background: rgba(255, 255, 255, 0.16);
  border-color: #38bdf8;
  color: #38bdf8 !important;
  transform: translateY(-2px);
}
.gov-hero-metrics {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
  gap: 14px;
  max-width: 820px;
  padding-top: 24px;
  border-top: 1px solid rgba(255, 255, 255, 0.12);
}
.gov-metric-item {
  display: flex;
  flex-direction: column;
}
.gov-metric-val {
  font-family: 'Lexend', sans-serif;
  font-weight: 800;
  font-size: 22px;
  color: #f8fafc;
  line-height: 1.2;
}
.gov-metric-label {
  font-size: 13px;
  color: #94a3b8;
  font-weight: 500;
}

/* ─── Trust Bar ────────────────────────────────────────────── */
.gov-trustbar {
  background: #0b1e33;
  border-bottom: 1px solid #1e293b;
  padding: 16px 0;
}
.gov-trust-inner {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: center;
  gap: 14px 24px;
}
.gov-trust-chip {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 13.5px;
  font-weight: 600;
  color: #e2e8f0;
}
.gov-trust-chip svg {
  color: #34d399;
  flex-shrink: 0;
}

/* ─── Common Section Blocks ────────────────────────────────── */
.gov-section {
  padding: 68px 0;
}
.gov-section-alt {
  background-color: #ffffff;
  border-block: 1px solid #e2e8f0;
}
.gov-section-header {
  margin-bottom: 40px;
}
.gov-section-badge {
  font-family: 'Lexend', sans-serif;
  font-size: 12px;
  font-weight: 700;
  color: #059669;
  text-transform: uppercase;
  letter-spacing: 0.06em;
  margin-bottom: 8px;
  display: block;
}
.gov-section-title {
  font-family: 'Lexend', sans-serif;
  font-size: clamp(1.6rem, 3.2vw, 2.3rem);
  font-weight: 800;
  letter-spacing: -0.02em;
  color: #0f172a;
  line-height: 1.25;
  margin-bottom: 12px;
}
.gov-section-desc {
  font-size: 16px;
  color: #475569;
  max-width: 720px;
  line-height: 1.7;
}

/* ─── 4 Pillars Grid (Keunggulan Vendor K3) ─────────────────── */
.gov-pillars-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 22px;
}
.gov-pillar-card {
  background: #ffffff;
  border: 1px solid #e2e8f0;
  border-radius: 16px;
  padding: 28px 24px;
  box-shadow: 0 4px 12px rgba(15, 23, 42, 0.03);
  transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
}
.gov-pillar-card:hover {
  transform: translateY(-4px);
  border-color: #cbd5e1;
  box-shadow: 0 12px 28px rgba(15, 23, 42, 0.07);
}
.gov-pillar-icon {
  width: 48px;
  height: 48px;
  border-radius: 12px;
  background: #ecfdf5;
  color: #059669;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  margin-bottom: 18px;
  border: 1px solid #a7f3d0;
}
.gov-pillar-card h3 {
  font-family: 'Lexend', sans-serif;
  font-size: 17px;
  font-weight: 700;
  color: #0f172a;
  margin-bottom: 10px;
  line-height: 1.35;
}
.gov-pillar-card p {
  font-size: 14.5px;
  color: #64748b;
  line-height: 1.65;
  margin: 0;
}

/* ─── Unterlinks & Program Pengadaan Grid ──────────────────── */
.gov-catalog-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(310px, 1fr));
  gap: 24px;
}
.gov-cat-box {
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: 16px;
  padding: 24px;
  display: flex;
  flex-direction: column;
}
.gov-cat-box-header {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 14px;
  padding-bottom: 12px;
  border-bottom: 1px solid #e2e8f0;
}
.gov-cat-box-icon {
  font-size: 24px;
  line-height: 1;
}
.gov-cat-box h3 {
  font-family: 'Lexend', sans-serif;
  font-size: 17px;
  font-weight: 700;
  color: #0f172a;
  margin: 0;
}
.gov-cat-box p {
  font-size: 13.5px;
  color: #64748b;
  margin-bottom: 16px;
  line-height: 1.6;
}
.gov-cat-links {
  list-style: none;
  padding: 0;
  margin: 0 0 18px;
  display: flex;
  flex-direction: column;
  gap: 8px;
  flex-grow: 1;
}
.gov-cat-link-item a {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 8px 12px;
  background: #ffffff;
  border: 1px solid #e2e8f0;
  border-radius: 8px;
  font-size: 13.5px;
  font-weight: 600;
  color: #1e293b;
  transition: all 0.15s ease;
}
.gov-cat-link-item a:hover {
  background: #f0fdf4;
  border-color: #86efac;
  color: #047857;
  padding-left: 15px;
}
.gov-cat-link-arrow {
  color: #94a3b8;
  font-size: 13px;
  transition: transform 0.15s ease;
}
.gov-cat-link-item a:hover .gov-cat-link-arrow {
  color: #059669;
  transform: translateX(3px);
}
.gov-cat-btn-wa {
  font-size: 13px;
  font-weight: 700;
  color: #059669;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  margin-top: auto;
}
.gov-cat-btn-wa:hover {
  color: #047857;
  text-decoration: underline;
}

/* ─── Procurement Mechanisms ───────────────────────────────── */
.gov-mech-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
  gap: 20px;
}
.gov-mech-card {
  background: #ffffff;
  border: 1.5px solid #e2e8f0;
  border-radius: 14px;
  padding: 24px;
}
.gov-mech-badge {
  display: inline-block;
  font-family: 'Lexend', sans-serif;
  font-size: 11.5px;
  font-weight: 700;
  color: #0284c7;
  background: #f0f9ff;
  border: 1px solid #bae6fd;
  padding: 4px 10px;
  border-radius: 6px;
  text-transform: uppercase;
  letter-spacing: 0.04em;
  margin-bottom: 12px;
}
.gov-mech-card h3 {
  font-family: 'Lexend', sans-serif;
  font-size: 17px;
  font-weight: 700;
  color: #0f172a;
  margin-bottom: 8px;
}
.gov-mech-card p {
  font-size: 14px;
  color: #64748b;
  line-height: 1.65;
  margin-bottom: 14px;
}
.gov-mech-checklist {
  list-style: none;
  padding: 0;
  margin: 0;
  font-size: 13px;
  color: #334155;
  display: flex;
  flex-direction: column;
  gap: 6px;
}
.gov-mech-checklist li {
  display: flex;
  align-items: center;
  gap: 6px;
}
.gov-mech-checklist li svg {
  color: #059669;
  flex-shrink: 0;
}

/* ─── 4 Steps Procurement Workflow ─────────────────────────── */
.gov-steps-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
  gap: 18px;
  counter-reset: govstep;
}
.gov-step-item {
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: 14px;
  padding: 24px 20px;
  position: relative;
}
.gov-step-num {
  counter-increment: govstep;
  width: 38px;
  height: 38px;
  background: #0f172a;
  color: #ffffff;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: 'Lexend', sans-serif;
  font-weight: 800;
  font-size: 16px;
  margin-bottom: 16px;
  box-shadow: 0 4px 10px rgba(15, 23, 42, 0.15);
}
.gov-step-item h3 {
  font-family: 'Lexend', sans-serif;
  font-size: 16px;
  font-weight: 700;
  color: #0f172a;
  margin-bottom: 8px;
}
.gov-step-item p {
  font-size: 13.5px;
  color: #64748b;
  line-height: 1.6;
  margin: 0;
}

/* ─── Client Proof / Portofolio BUMN ───────────────────────── */
.gov-clients-wrap {
  background: #ffffff;
  border: 1px solid #e2e8f0;
  border-radius: 16px;
  padding: 30px;
  box-shadow: 0 4px 16px rgba(15, 23, 42, 0.04);
}
.gov-clients-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-bottom: 24px;
}
.gov-client-tag {
  background: #f1f5f9;
  border: 1px solid #cbd5e1;
  border-radius: 8px;
  padding: 8px 14px;
  font-size: 13.5px;
  font-weight: 600;
  color: #1e293b;
}
.gov-client-tag.is-highlight {
  background: #eff6ff;
  border-color: #bfdbfe;
  color: #1d4ed8;
}
.gov-clients-note {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 12px;
  padding-top: 20px;
  border-top: 1px solid #f1f5f9;
  font-size: 14px;
  color: #64748b;
}
.gov-clients-link {
  font-weight: 700;
  color: #059669;
  display: inline-flex;
  align-items: center;
  gap: 4px;
}
.gov-clients-link:hover {
  color: #047857;
  text-decoration: underline;
}

/* ─── FAQ Accordion ────────────────────────────────────────── */
.gov-faq-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
  max-width: 860px;
}
.gov-faq-item {
  background: #ffffff;
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  overflow: hidden;
  transition: border-color 0.15s ease;
}
.gov-faq-item[open] {
  border-color: #94a3b8;
  box-shadow: 0 4px 12px rgba(15, 23, 42, 0.04);
}
.gov-faq-item summary {
  padding: 18px 22px;
  font-family: 'Lexend', sans-serif;
  font-size: 15.5px;
  font-weight: 700;
  color: #0f172a;
  cursor: pointer;
  list-style: none;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
}
.gov-faq-item summary::-webkit-details-marker {
  display: none;
}
.gov-faq-icon {
  width: 24px;
  height: 24px;
  border-radius: 50%;
  background: #f1f5f9;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 14px;
  color: #475569;
  flex-shrink: 0;
  transition: transform 0.2s ease, background 0.2s ease, color 0.2s ease;
}
.gov-faq-item[open] .gov-faq-icon {
  transform: rotate(45deg);
  background: #059669;
  color: #ffffff;
}
.gov-faq-content {
  padding: 0 22px 20px;
  font-size: 14.5px;
  color: #475569;
  line-height: 1.7;
}

/* ─── Final CTA Banner ─────────────────────────────────────── */
.gov-final-cta {
  background: radial-gradient(1000px circle at 85% 15%, rgba(16, 185, 129, 0.3) 0%, rgba(10, 74, 46, 0.75) 45%, #071524 95%), #050d18;
  border-radius: 20px;
  padding: 56px 40px;
  color: #ffffff;
  text-align: center;
  margin: 0 auto;
  position: relative;
  overflow: hidden;
  box-shadow: 0 20px 45px -15px rgba(0, 0, 0, 0.4);
}
.gov-final-cta h2 {
  font-family: 'Lexend', sans-serif;
  font-size: clamp(1.8rem, 3.5vw, 2.5rem);
  font-weight: 800;
  color: #ffffff;
  margin-bottom: 14px;
  letter-spacing: -0.02em;
}
.gov-final-cta p {
  font-size: 16px;
  color: #cbd5e1;
  max-width: 640px;
  margin: 0 auto 30px;
  line-height: 1.7;
}
.gov-final-btns {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  justify-content: center;
  align-items: center;
  margin-bottom: 24px;
}
.gov-final-note {
  font-size: 13px;
  color: #94a3b8;
}

@media (max-width: 768px) {
  .gov-hero {
    padding: 48px 0 54px;
  }
  .gov-hero-actions {
    flex-direction: column;
    align-items: stretch;
  }
  .gov-btn {
    width: 100%;
  }
  .gov-final-cta {
    padding: 40px 20px;
    border-radius: 14px;
  }
}
</style>

<!-- ═══════════════════════════════════════════════════ NAVBAR -->
<?php require __DIR__ . '/includes/navbar.php'; ?>

<!-- ═══════════════════════════════════════════════════ MAIN CONTENT -->
<main id="konten-utama" class="gov-page">

  <!-- 1. HERO SECTION -->
  <section class="gov-hero">
    <div class="container gov-hero-inner">
      <div class="gov-eyebrow">
        <span class="gov-eyebrow-icon">🏛️</span>
        <span>Mitra Pengadaan Pemerintah &amp; BUMN (B2G)</span>
      </div>
      <h1>
        Vendor Pelatihan K3 Resmi untuk <span class="highlight">Instansi Pemerintah &amp; BUMN</span> di Indonesia
      </h1>
      <p class="gov-hero-lede">
        Wahana Totalita Konsultan adalah <strong>PJK3 resmi Kemnaker RI</strong> dan lembaga pelaksana sertifikasi BNSP terpercaya. Kami siap bertindak sebagai penyedia jasa pelatihan K3, in-house training, dan sertifikasi personel melalui mekanisme <strong>Pengadaan Langsung (SPK)</strong>, <strong>Penunjukan Langsung</strong>, maupun proses tender melalui <strong>LPSE / SPSE</strong> di seluruh Indonesia.
      </p>

      <div class="gov-hero-actions">
        <a href="<?= e($wa_url) ?>" class="gov-btn gov-btn-primary" target="_blank" rel="noopener">
          <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
          <span>Konsultasi Pengadaan via WhatsApp</span>
        </a>
        <a href="<?= e($wa_inhouse_url) ?>" class="gov-btn gov-btn-secondary" target="_blank" rel="noopener">
          <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M16 13H8M16 17H8M10 9H8"/></svg>
          <span>Minta SPH &amp; RAB Resmi (24 Jam)</span>
        </a>
      </div>

      <div class="gov-hero-metrics">
        <div class="gov-metric-item">
          <span class="gov-metric-val">70+ Rekanan</span>
          <span class="gov-metric-label">BUMN &amp; Multinasional</span>
        </div>
        <div class="gov-metric-item">
          <span class="gov-metric-val">65+ Program</span>
          <span class="gov-metric-label">Kemnaker RI &amp; BNSP</span>
        </div>
        <div class="gov-metric-item">
          <span class="gov-metric-val">100% Legal</span>
          <span class="gov-metric-label">NIB, PKP, SPT, SKP Lengkap</span>
        </div>
        <div class="gov-metric-item">
          <span class="gov-metric-val">Nasional</span>
          <span class="gov-metric-label">Melayani Seluruh Indonesia</span>
        </div>
      </div>
    </div>
  </section>

  <!-- 2. TRUST BAR -->
  <div class="gov-trustbar">
    <div class="container gov-trust-inner">
      <div class="gov-trust-chip">
        <svg viewBox="0 0 20 20" fill="currentColor" width="18" height="18" aria-hidden="true"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
        <span>PJK3 Resmi Kemnaker RI</span>
      </div>
      <div class="gov-trust-chip">
        <svg viewBox="0 0 20 20" fill="currentColor" width="18" height="18" aria-hidden="true"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
        <span>Lembaga Terakreditasi BNSP</span>
      </div>
      <div class="gov-trust-chip">
        <svg viewBox="0 0 20 20" fill="currentColor" width="18" height="18" aria-hidden="true"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
        <span>Siap Pengadaan Langsung (SPK) &amp; LPSE</span>
      </div>
      <div class="gov-trust-chip">
        <svg viewBox="0 0 20 20" fill="currentColor" width="18" height="18" aria-hidden="true"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
        <span>Kelengkapan Faktur Pajak PPN &amp; PPh 23</span>
      </div>
    </div>
  </div>

  <!-- 3. KEUNGGULAN VENDOR K3 UNTUK PENGADAAN -->
  <section class="gov-section">
    <div class="container">
      <div class="gov-section-header">
        <span class="gov-section-badge">Akuntabilitas &amp; Legalitas</span>
        <h2 class="gov-section-title">Mengapa PPK, PPTK, &amp; Pokja Memilih Wahana Totalita</h2>
        <p class="gov-section-desc">
          Sebagai <strong>vendor pelatihan K3</strong> profesional, kami memahami ketatnya persyaratan administrasi, kepatuhan audit BPK/Inspektorat, dan regulasi pengadaan barang/jasa pemerintah.
        </p>
      </div>

      <div class="gov-pillars-grid">
        <div class="gov-pillar-card">
          <div class="gov-pillar-icon">📋</div>
          <h3>Dokumen Kualifikasi Lengkap</h3>
          <p>NIB Berbasis Risiko, NPWP &amp; SK Pengukuhan PKP, SPT Tahunan terakhir, akta pendirian &amp; SK Kemenkumham, serta rekening giro atas nama PT untuk pencairan termin yang aman.</p>
        </div>

        <div class="gov-pillar-card">
          <div class="gov-pillar-icon">🎖️</div>
          <h3>Legalitas PJK3 &amp; Instruktur Ber-SKP</h3>
          <p>Memiliki Surat Keputusan Penunjukan (SKP) PJK3 dari Kementerian Ketenagakerjaan RI serta LSP BNSP. Dipandu oleh instruktur senior bersertifikat &amp; praktisi industri kawakan.</p>
        </div>

        <div class="gov-pillar-card">
          <div class="gov-pillar-icon">🏨</div>
          <h3>Paket All-In (One-Stop Procurement)</h3>
          <p>Mencakup biaya instruktur, ujian lisensi resmi, penginapan hotel representatif, katering dinas, modul pelatihan, APD praktikum, hingga transportasi rombongan peserta.</p>
        </div>

        <div class="gov-pillar-card">
          <div class="gov-pillar-icon">📑</div>
          <h3>Laporan SPJ &amp; BAST Rapi</h3>
          <p>Setiap kegiatan disertai Berita Acara Serah Terima (BAST), daftar hadir presensi, dokumentasi foto &amp; video, sertifikat resmi, dan laporan pertanggungjawaban untuk memudahkan audit.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- 4. PROGRAM & LAYANAN PENGADAAN (DENGAN UNTERLINKS KONTEKSTUAL) -->
  <section class="gov-section gov-section-alt">
    <div class="container">
      <div class="gov-section-header">
        <span class="gov-section-badge">Katalog Program B2G</span>
        <h2 class="gov-section-title">Layanan &amp; Program Prioritas Pengadaan Instansi</h2>
        <p class="gov-section-desc">
          Berikut adalah kelompok program pelatihan dan sertifikasi K3 yang paling sering masuk dalam paket pengadaan dinas, kementerian, BUMN, dan lembaga negara:
        </p>
      </div>

      <div class="gov-catalog-grid">

        <!-- Box 1: K3 Wajib & Perkantoran -->
        <div class="gov-cat-box">
          <div class="gov-cat-box-header">
            <span class="gov-cat-box-icon">🏢</span>
            <h3>K3 Umum &amp; Perkantoran Instansi</h3>
          </div>
          <p>Pemenuhan regulasi keselamatan kerja gedung perkantoran, fasyankes, dan balai diklat dinas.</p>
          <ul class="gov-cat-links">
            <li class="gov-cat-link-item">
              <a href="/pelatihan/ahli-k3-umum-sertifikasi-kemnaker-ri">
                <span>Pelatihan Ahli K3 Umum Kemnaker RI</span>
                <span class="gov-cat-link-arrow">&rarr;</span>
              </a>
            </li>
            <li class="gov-cat-link-item">
              <a href="/penanggulangan-kebakaran/">
                <span>K3 Penanggulangan Kebakaran (Damkar)</span>
                <span class="gov-cat-link-arrow">&rarr;</span>
              </a>
            </li>
            <li class="gov-cat-link-item">
              <a href="/p3k/">
                <span>Petugas P3K di Tempat Kerja</span>
                <span class="gov-cat-link-arrow">&rarr;</span>
              </a>
            </li>
            <li class="gov-cat-link-item">
              <a href="/k3-rumah-sakit/">
                <span>K3 Rumah Sakit &amp; Fasyankes (RSUD/RSUP)</span>
                <span class="gov-cat-link-arrow">&rarr;</span>
              </a>
            </li>
          </ul>
          <a href="<?= e($wa_url) ?>" class="gov-cat-btn-wa" target="_blank" rel="noopener">
            <span>Minta Penawaran K3 Kantor</span> &rarr;
          </a>
        </div>

        <!-- Box 2: Infrastruktur, Logistik & Alat Berat -->
        <div class="gov-cat-box">
          <div class="gov-cat-box-header">
            <span class="gov-cat-box-icon">🚜</span>
            <h3>Infrastruktur, PU &amp; Logistik</h3>
          </div>
          <p>Sertifikasi operator alat berat dan pengawas keselamatan proyek fisik dinas PU, perhubungan, &amp; pergudangan.</p>
          <ul class="gov-cat-links">
            <li class="gov-cat-link-item">
              <a href="/pelatihan/pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri">
                <span>K3 Operator Forklift (Kelas 1 &amp; 2)</span>
                <span class="gov-cat-link-arrow">&rarr;</span>
              </a>
            </li>
            <li class="gov-cat-link-item">
              <a href="/k3-konstruksi/">
                <span>Ahli K3 Konstruksi (Muda, Madya, Utama)</span>
                <span class="gov-cat-link-arrow">&rarr;</span>
              </a>
            </li>
            <li class="gov-cat-link-item">
              <a href="/k3-pesawat-angkat-angkut/">
                <span>K3 Operator Crane, Rigger, &amp; Alat Angkat</span>
                <span class="gov-cat-link-arrow">&rarr;</span>
              </a>
            </li>
            <li class="gov-cat-link-item">
              <a href="/k3-listrik/">
                <span>Teknisi &amp; Ahli K3 Listrik Kemnaker</span>
                <span class="gov-cat-link-arrow">&rarr;</span>
              </a>
            </li>
          </ul>
          <a href="<?= e($wa_url) ?>" class="gov-cat-btn-wa" target="_blank" rel="noopener">
            <span>Minta Penawaran K3 Teknis</span> &rarr;
          </a>
        </div>

        <!-- Box 3: Energi, Lingkungan & BUMN Tambang -->
        <div class="gov-cat-box">
          <div class="gov-cat-box-header">
            <span class="gov-cat-box-icon">⚡</span>
            <h3>Energi, ESDM, &amp; Lingkungan Hidup</h3>
          </div>
          <p>Pelatihan kepatuhan regulasi ESDM, KLHK, dan keselamatan operasi industri strategis BUMN.</p>
          <ul class="gov-cat-links">
            <li class="gov-cat-link-item">
              <a href="/k3-pertambangan/">
                <span>Pengawas Operasional Tambang (POP, POM, POU)</span>
                <span class="gov-cat-link-arrow">&rarr;</span>
              </a>
            </li>
            <li class="gov-cat-link-item">
              <a href="/k3-migas/">
                <span>K3 Migas &amp; Keselamatan Proses Kimia</span>
                <span class="gov-cat-link-arrow">&rarr;</span>
              </a>
            </li>
            <li class="gov-cat-link-item">
              <a href="/k3-lingkungan/">
                <span>Pengelolaan Limbah B3 &amp; K3 Lingkungan</span>
                <span class="gov-cat-link-arrow">&rarr;</span>
              </a>
            </li>
            <li class="gov-cat-link-item">
              <a href="/smk3/">
                <span>Audit &amp; Implementasi SMK3 PP 50/2012</span>
                <span class="gov-cat-link-arrow">&rarr;</span>
              </a>
            </li>
          </ul>
          <a href="<?= e($wa_url) ?>" class="gov-cat-btn-wa" target="_blank" rel="noopener">
            <span>Minta Penawaran Sektor Energi</span> &rarr;
          </a>
        </div>

      </div>

      <!-- Hub & Catalog Navigation Bar -->
      <div style="margin-top: 28px; padding: 20px; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 14px;">
        <div style="font-size: 14px; color: #475569;">
          <strong>Navigasi Tambahan:</strong> Jelajahi seluruh ekosistem sertifikasi &amp; layanan kami:
        </div>
        <div style="display: flex; flex-wrap: wrap; gap: 10px;">
          <a href="/pelatihan/" style="font-size: 13.5px; font-weight: 700; color: #059669; padding: 4px 10px; background: #ecfdf5; border-radius: 6px;">Katalog Pelatihan &rarr;</a>
          <a href="/in-house/" style="font-size: 13.5px; font-weight: 700; color: #0284c7; padding: 4px 10px; background: #f0f9ff; border-radius: 6px;">In-House Training &rarr;</a>
          <a href="/perusahaan/" style="font-size: 13.5px; font-weight: 700; color: #475569; padding: 4px 10px; background: #f1f5f9; border-radius: 6px;">Layanan B2B Perusahaan &rarr;</a>
          <a href="/jadwal/" style="font-size: 13.5px; font-weight: 700; color: #475569; padding: 4px 10px; background: #f1f5f9; border-radius: 6px;">Jadwal Public Training &rarr;</a>
          <a href="/csms" style="font-size: 13.5px; font-weight: 700; color: #475569; padding: 4px 10px; background: #f1f5f9; border-radius: 6px;">Sistem CSMS &rarr;</a>
        </div>
      </div>
    </div>
  </section>

  <!-- 5. MEKANISME PENGADAAN PEMERINTAH (B2G PROCUREMENT READY) -->
  <section class="gov-section">
    <div class="container">
      <div class="gov-section-header">
        <span class="gov-section-badge">Mekanisme Pengadaan Fleksibel</span>
        <h2 class="gov-section-title">Mendukung Seluruh Jalur Pengadaan Resmi</h2>
        <p class="gov-section-desc">
          Kami menyesuaikan metode kontrak pengadaan dengan aturan teknis Perpres Pengadaan Barang/Jasa Pemerintah (PBJP) dan peraturan internal BUMN/BUMD:
        </p>
      </div>

      <div class="gov-mech-grid">
        <div class="gov-mech-card">
          <span class="gov-mech-badge">Cepat &amp; Praktis</span>
          <h3>Pengadaan Langsung (SPK)</h3>
          <p>Cocok untuk pelatihan dengan nilai pagu hingga Rp 200 juta. Kami siapkan draf SPH (Surat Penawaran Harga), RAB, dan dokumen legalitas perseroan dalam waktu 1x24 jam.</p>
          <ul class="gov-mech-checklist">
            <li><svg viewBox="0 0 20 20" fill="currentColor" width="16" height="16"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> SPH &amp; RAB rincian komponen</li>
            <li><svg viewBox="0 0 20 20" fill="currentColor" width="16" height="16"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Faktur Pajak &amp; bukti potong</li>
          </ul>
        </div>

        <div class="gov-mech-card">
          <span class="gov-mech-badge">Sistem Elektronik</span>
          <h3>Tender LPSE &amp; E-Katalog</h3>
          <p>Siap mengikuti tahapan kualifikasi dan evaluasi teknis melalui portal SPSE / LPSE kementerian, pemprov, pemkab, pemkot, perguruan tinggi negeri (PTN), dan lembaga negara.</p>
          <ul class="gov-mech-checklist">
            <li><svg viewBox="0 0 20 20" fill="currentColor" width="16" height="16"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Dokumen kualifikasi SPSE lengkap</li>
            <li><svg viewBox="0 0 20 20" fill="currentColor" width="16" height="16"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Berpengalaman tender B2G</li>
          </ul>
        </div>

        <div class="gov-mech-card">
          <span class="gov-mech-badge">Khusus Korporasi</span>
          <h3>Kontrak Pengadaan BUMN</h3>
          <p>Mendukung mekanisme pengadaan vendor BUMN (Pertamina, PLN, BUMN Karya, Pupuk Indonesia, dll.) melalui sistem vendor management (VMS) dan purchase order (PO).</p>
          <ul class="gov-mech-checklist">
            <li><svg viewBox="0 0 20 20" fill="currentColor" width="16" height="16"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Sesuai SOP procurement BUMN</li>
            <li><svg viewBox="0 0 20 20" fill="currentColor" width="16" height="16"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Verifikasi CSMS &amp; HSE plan</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- 6. PORTOFOLIO BUMN & BUKTI KEPERCAYAAN -->
  <section class="gov-section gov-section-alt">
    <div class="container">
      <div class="gov-section-header">
        <span class="gov-section-badge">Rekam Jejak Kredibel</span>
        <h2 class="gov-section-title">Dipercaya 70+ BUMN &amp; Perusahaan Strategis Nasional</h2>
        <p class="gov-section-desc">
          Kepercayaan berkelanjutan dari sektor migas, perbankan negara, pertambangan, dan industri manufaktur menjadi bukti mutu sertifikasi dan integritas kemitraan kami.
        </p>
      </div>

      <div class="gov-clients-wrap">
        <div class="gov-clients-tags">
          <span class="gov-client-tag is-highlight">PT Pertamina (Persero)</span>
          <span class="gov-client-tag is-highlight">PT PLN (Persero)</span>
          <span class="gov-client-tag is-highlight">PT PJB (Pembangkitan Jawa-Bali)</span>
          <span class="gov-client-tag is-highlight">PT Indonesia Asahan Aluminium (INALUM)</span>
          <span class="gov-client-tag is-highlight">PT Krakatau Steel (Persero)</span>
          <span class="gov-client-tag">Bank Mandiri (Persero)</span>
          <span class="gov-client-tag">Bank BRI (Persero)</span>
          <span class="gov-client-tag">Bank BTN (Persero)</span>
          <span class="gov-client-tag">PT Pupuk Kaltim</span>
          <span class="gov-client-tag">PT Pupuk Kujang</span>
          <span class="gov-client-tag">PT Pusri</span>
          <span class="gov-client-tag">PT Biofarma (Persero)</span>
          <span class="gov-client-tag">Perum Peruri</span>
          <span class="gov-client-tag">PT Sucofindo (Persero)</span>
          <span class="gov-client-tag">PT Badak LNG</span>
          <span class="gov-client-tag">PT MedcoEnergi</span>
        </div>
        <div class="gov-clients-note">
          <span>Tersedia portofolio lengkap, salinan sertifikat kompetensi, dan referensi pekerjaan terdahulu untuk kebutuhan evaluasi lelang.</span>
          <a href="/klien" class="gov-clients-link">
            <span>Lihat Halaman Klien &amp; Testimoni Lengkap</span> &rarr;
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- 7. ALUR KERJASAMA PENGADAAN (4 LANGKAH) -->
  <section class="gov-section">
    <div class="container">
      <div class="gov-section-header">
        <span class="gov-section-badge">Alur Koordinasi Cepat</span>
        <h2 class="gov-section-title">4 Langkah Mudah Realisasi Pengadaan Pelatihan</h2>
        <p class="gov-section-desc">
          Kami memandu tim pengadaan instansi Anda dari tahap formulasi anggaran hingga pelaporan SPJ rampung:
        </p>
      </div>

      <div class="gov-steps-grid">
        <div class="gov-step-item">
          <div class="gov-step-num">1</div>
          <h3>Konsultasi KAK &amp; Jadwal</h3>
          <p>Diskusikan topik pelatihan, jumlah target ASN/personel, lokasi pelaksanaan (In-House atau di Yogyakarta), dan waktu tentatif.</p>
        </div>

        <div class="gov-step-item">
          <div class="gov-step-num">2</div>
          <h3>Penyusunan SPH &amp; RAB</h3>
          <p>Tim pengadaan kami menerbitkan Surat Penawaran Harga (SPH), draf RAB resmi, silabus silabi, dan berkas legalitas dalam 24 jam.</p>
        </div>

        <div class="gov-step-item">
          <div class="gov-step-num">3</div>
          <h3>Penerbitan SPK / Kontrak</h3>
          <p>Pemrosesan dokumen pengadaan langsung (SPK) atau input tender LPSE sesuai mekanisme baku instansi Anda.</p>
        </div>

        <div class="gov-step-item">
          <div class="gov-step-num">4</div>
          <h3>Pelaksanaan &amp; BAST</h3>
          <p>Pelatihan diselenggarakan, ujian lisensi dilaksanakan, sertifikat resmi diterbitkan, serta berkas BAST &amp; SPJ diserahterimakan.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- 8. FAQ SEPUTAR VENDOR & PENGADAAN K3 -->
  <section class="gov-section gov-section-alt">
    <div class="container">
      <div class="gov-section-header">
        <span class="gov-section-badge">Tanya Jawab Pengadaan</span>
        <h2 class="gov-section-title">Pertanyaan Sering Diajukan oleh PPK &amp; Panitia Pengadaan</h2>
        <p class="gov-section-desc">
          Jawaban transparan atas aspek regulasi, sertifikasi, perpajakan, dan teknis pelaksanaan pelatihan K3 pemerintah:
        </p>
      </div>

      <div class="gov-faq-list">
        <details class="gov-faq-item" open>
          <summary>
            <span>Apakah Wahana Totalita memiliki SKP PJK3 resmi dan berbadan hukum PT?</span>
            <span class="gov-faq-icon">+</span>
          </summary>
          <div class="gov-faq-content">
            Ya. Wahana Totalita Konsultan berada di bawah naungan PT berbadan hukum resmi dengan NIB Berbasis Risiko, NPWP &amp; PKP aktif, serta mengantongi Surat Keputusan Penunjukan (SKP) Perusahaan Jasa K3 (PJK3) dari Kementerian Ketenagakerjaan RI serta lisensi Lembaga Sertifikasi Profesi (LSP) BNSP.
          </div>
        </details>

        <details class="gov-faq-item">
          <summary>
            <span>Bagaimana penyesuaian dokumen penawaran untuk mekanisme Pengadaan Langsung vs LPSE?</span>
            <span class="gov-faq-icon">+</span>
          </summary>
          <div class="gov-faq-content">
            Untuk Pengadaan Langsung (SPK di bawah pagu tender), kami menyediakan SPH lengkap beserta rincian Rencana Anggaran Biaya (RAB), pakta integritas, dan dokumen legalitas. Untuk tender melalui LPSE / SPSE, tim tender kami siap mengunggah berkas kualifikasi teknis, sertifikat instruktur, dan bukti pengalaman kerja sesuai dokumen pemilihan.
          </div>
        </details>

        <details class="gov-faq-item">
          <summary>
            <span>Apakah instansi bisa meminta satu paket lengkap (pelatihan, hotel, katering, dan transportasi)?</span>
            <span class="gov-faq-icon">+</span>
          </summary>
          <div class="gov-faq-content">
            Sangat bisa. Kami menyediakan paket all-in (one-stop service) yang mencakup ruang diklat/ballroom hotel, akomodasi kamar peserta dinas, konsumsi harian (coffee break &amp; makan siang/malam), modul materi, seminar kit, APD praktikum, ujian sertifikasi, hingga transportasi lokal. Hal ini mempermudah pertanggungjawaban anggaran dan SPJ instansi dalam satu kontrak.
          </div>
        </details>

        <details class="gov-faq-item">
          <summary>
            <span>Apakah sertifikat yang diterbitkan sah untuk angka kredit dan kompetensi ASN / Pegawai BUMN?</span>
            <span class="gov-faq-icon">+</span>
          </summary>
          <div class="gov-faq-content">
            Ya. Sertifikat dan Surat Keputusan Penunjukan (SKP) diterbitkan langsung oleh Kementerian Ketenagakerjaan RI atau Badan Nasional Sertifikasi Profesi (BNSP). Dokumen ini memiliki nomor registrasi nasional yang sah, diakui secara hukum, dan memenuhi persyaratan kompetensi kepegawaian maupun audit SMK3.
          </div>
        </details>

        <details class="gov-faq-item">
          <summary>
            <span>Apakah dapat menerbitkan Faktur Pajak resmi (PPN &amp; PPh 23)?</span>
            <span class="gov-faq-icon">+</span>
          </summary>
          <div class="gov-faq-content">
            Tentu. Perusahaan kami adalah Pengusaha Kena Pajak (PKP) aktif. Kami menerbitkan Faktur Pajak elektronik (e-Faktur) resmi serta siap memfasilitasi bukti potong PPh Pasal 23 sesuai ketentuan perpajakan bendahara instansi pemerintah dan BUMN.
          </div>
        </details>

        <details class="gov-faq-item">
          <summary>
            <span>Bisakah pelatihan diadakan di kota atau kantor instansi kami (In-House Training)?</span>
            <span class="gov-faq-icon">+</span>
          </summary>
          <div class="gov-faq-content">
            Bisa. Tim instruktur dan asesor kami siap hadir langsung ke kantor kementerian, kantor dinas daerah, balai pelatihan, maupun site operasional BUMN di seluruh wilayah Indonesia dari Sabang sampai Merauke.
          </div>
        </details>
      </div>
    </div>
  </section>

  <!-- 9. FINAL CALL TO ACTION -->
  <section class="gov-section">
    <div class="container">
      <div class="gov-final-cta">
        <h2>Rencanakan Pengadaan Pelatihan K3 Instansi Anda Sekarang</h2>
        <p>
          Diskusikan Kerangka Acuan Kerja (KAK), kebutuhan jadwal, dan dapatkan draf Rencana Anggaran Biaya (RAB) serta proposal teknis resmi dalam 1x24 jam — konsultasi gratis tanpa komitmen.
        </p>
        <div class="gov-final-btns">
          <a href="<?= e($wa_url) ?>" class="gov-btn gov-btn-primary" target="_blank" rel="noopener">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
            <span>Hubungi Tim Pengadaan B2G via WhatsApp</span>
          </a>
          <a href="mailto:info@wahanatotalita.com" class="gov-btn gov-btn-secondary">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
            <span>Kirim Surat / KAK via Email</span>
          </a>
        </div>
        <p class="gov-final-note">
          Hotline Pengadaan: <a href="tel:+<?= e($wa_number) ?>" style="color:#ffffff; font-weight:700; text-decoration:underline;"><?= e($phone_disp) ?></a> &nbsp;&middot;&nbsp; Layanan Resmi PT Kreasi Ultimate Berjaya
        </p>
      </div>
    </div>
  </section>

</main>

<!-- ═══════════════════════════════════════════════════ FOOTER -->
<?php require __DIR__ . '/includes/footer.php'; ?>
<?php require __DIR__ . '/includes/scripts.php'; ?>

</body>
</html>