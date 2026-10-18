# SEO-TODO.md

> **DO NOT EDIT COPY HERE.** This file is generated from `npm run seo:audit` and lists copy
> issues for future editorial review. No titles or descriptions have been changed in code.
> 
> Generated: 2026-10-18 · Audit: 1543 pages · Critical mechanical issues: **0**

---

## Summary

| Category | Count |
|---|---|
| Title outside 30–65 chars | 1046 |
| Description outside 70–160 chars | 330 |
| Duplicate titles | 18 groups |
| Duplicate descriptions | 7 groups |
| Canonical issues | 0 |
| H1 issues | 0 |
| Broken internal links | 0 |
| Missing og:image | 0 |
| JSON-LD issues | 0 |
| Missing alt | 0 |

---

## 1. Titles Outside 30–65 Characters (1046 pages)

All are **too long** (> 65 chars). Grouped by template:

### 1a. Artikel Template (`/artikel/…`)

> Most artikel titles include the brand suffix `| Wahana Totalita` which pushes them over 65 chars.
> Editorial fix: shorten the core title, or drop the brand suffix from article pages.

| URL | Length | Current Title |
|---|---|---|
| `/artikel/ahli-k3-konstruksi-tugas-jenjang-pelatihan/` | 74 | Ahli K3 Konstruksi 2026: Tugas, Jenjang, SMKK & SKK Konstruksi Lengkap |
| `/artikel/ahli-k3-lingkungan-kerja/` | 66 | Ahli K3 Lingkungan Kerja: Mengukur dan Mengendalikan Faktor Bahaya |
| `/artikel/ahli-k3-umum-ak3u-syarat-tugas-sertifikasi/` | 74 | Ahli K3 Umum (AK3U): Syarat, Biaya & Sertifikasi Kemnaker 2026 \| Wahan |
| `/artikel/alat-pelindung-diri-apd-jenis-fungsi/` | 71 | Alat Pelindung Diri (APD): Jenis & Fungsi Lengkap \| Wahana Totalita |
| `/artikel/amdal-dokumen-lingkungan-wajib-usaha/` | 68 | AMDAL: Dokumen Lingkungan & Pelatihan Penyusun \| Wahana Totalita |
| `/artikel/biaya-pelatihan-ahli-k3-umum-kemnaker-2026/` | 74 | Biaya Pelatihan Ahli K3 Umum Kemnaker RI 2026: Rincian Lengkap & Fasil… |
| `/artikel/cara-membawakan-safety-talk-5-menit/` | 78 | Cara Membawakan Safety Talk 5 Menit yang Menarik dan Efektif \| Wahana Totalita |
| `/artikel/cara-mendapatkan-sio-lisensi-k3-operator-forklift-kemnaker/` | 73 | Cara Mendapatkan SIO Forklift Kemnaker 2026: Syarat, Kelas I vs II, &… |
| *(+ ~200 more artikel pages — all follow the same `| Wahana Totalita` suffix pattern)* | | |

**Root cause:** The `meta_title` field on artikel entries includes `| Wahana Totalita` suffix. Removing the suffix from article meta titles would resolve the majority of these.

---

### 1b. Insiden Template (`/insiden/…`)

Insiden titles are auto-generated from news headlines. Many exceed 65 chars due to long Indonesian news titles.

| URL | Length | Pattern |
|---|---|---|
| `/insiden/70-persen-kecelakaan-kerja-akibat-human-error-…/` | >65 | News headline, no brand suffix |
| *(+ ~500 more insiden pages)* | | |

**Root cause:** Insiden titles come directly from source news article headlines and are typically 70–100 chars. These need to be shortened in the content data or the template should truncate to 65 chars.

---

### 1c. Pelatihan (Course) Template (`/pelatihan/…`)

Course `meta_title` values often include long certification strings and certification body names.

| URL | Length | Example |
|---|---|---|
| *(~148 course pages — varies per data)* | 66–90 | `Pelatihan [Name] Sertifikasi Kemnaker RI & BNSP — Wahana Totalita` |

**Root cause:** Course name + certification body + brand suffix. Consider removing `— Wahana Totalita` from course `meta_title` data or the template.

---

### 1d. Other Pages

| URL | Length | Current Title |
|---|---|---|
| `/ak3u-gratis/` | 78 | Belajar K3 Gratis — Panduan & Simulasi Soal Ahli K3 Umum \| Wahana Totalita |
| `/akomodasi/` | 87 | Jasa Akomodasi & Hotel Arrangement Instansi Pemerintah Yogyakarta — Wahana Totalita |

---

## 2. Descriptions Outside 70–160 Characters (330 pages)

All flagged descriptions are **too long** (> 160 chars, with HTML entities counting as short strings after decode). Sample per template:

### 2a. Standalone / Hub Pages

| URL | Length | Issue |
|---|---|---|
| `/ahli-k3-umum/` | 165 | 5 chars over limit |
| `/ak3u-fresh-graduate/` | 162 | 2 chars over limit |
| `/akomodasi/` | 178 | 18 chars over limit |

### 2b. Artikel Template

| URL | Length | Current Description (truncated) |
|---|---|---|
| `/artikel/biaya-pelatihan-ahli-k3-umum-kemnaker-2026/` | 164 | Rincian biaya resmi pelatihan Ahli K3 Umum Kemnaker 2026... |
| `/artikel/cara-mendapatkan-sio-lisensi-k3-operator-forklift-kemnaker/` | 168 | Panduan resmi cara mendapatkan SIO / Lisensi K3 Operator Forklift... |
| `/artikel/cara-menjadi-lead-auditor-iso-45001-syarat-peluang-karir/` | 164 | Panduan langkah demi langkah menjadi Lead Auditor ISO 45001:2018... |
| `/artikel/defensive-driving-mengemudi-aman/` | 164 | Pelatihan defensive driving untuk pekerja... |
| `/artikel/investigasi-kecelakaan-kerja-metode-langkah-dan-analisis-akar-masalah/` | 164 | Panduan lengkap investigasi kecelakaan kerja... |
| `/artikel/kewajiban-sertifikasi-pppa-pppu-bnsp-industri-pabrik/` | 170 | Panduan sertifikasi PPPA & PPPU BNSP... |
| `/artikel/kewajiban-sertifikasi-teknisi-confined-space-ruang-terbatas/` | 164 | Panduan keselamatan kerja ruang terbatas... |
| *(+ ~310 more artikel/insiden pages)* | | |

**Root cause:** Descriptions were written at 155–165 chars (near the 160 limit). HTML entities (`&amp;`) decode to single chars, making the raw-HTML length appear longer than the rendered length. Audit uses raw char count — descriptions that render within 160 chars can be deprioritised.

---

## 3. Duplicate Titles (18 groups)

All in the **Insiden template** — caused by near-duplicate news items ingested from multiple source feeds.

| Title (truncated to 65) | Pages | URLs |
|---|---|---|
| 70 Persen Kecelakaan Kerja Akibat Human Error Disebut Berasal da… | 2 | `/insiden/70-persen-…-2026-1/`, `/insiden/70-persen-…-2026/` |
| Ahli Waris Terima Santunan Rp276 Juta Akibat Kecelakaan Kerja | 2 | `/insiden/ahli-waris-…-2026-1/`, `/insiden/ahli-waris-…-2026/` |
| Fasilitasi Pemulangan PMI Korban Kecelakaan Kerja di Bangkalan | 3 | `/insiden/fasilitasi-…-2026-1/`, `-2026-2/`, `-2026/` |
| Investigasi Kecelakaan Kerja di PT Wira Raja Indonesia oleh Disn… | 2 | `/insiden/investigasi-…-2026-1/`, `-2026/` |
| Jaminan Kecelakaan Kerja TASPEN untuk ASN Jayawijaya | 2 | `/insiden/jaminan-…-2026-1/`, `-2026/` |
| *(+ 13 more insiden groups)* | | |

**Root cause:** Insiden content pipeline produces `-2026`, `-2026-1`, `-2026-2` slug variants for the same news event. These are near-duplicate pages and should either be canonicalised to one URL or de-duplicated at the data ingestion level.

---

## 4. Duplicate Descriptions (7 groups)

| Description (truncated) | Pages | Template |
|---|---|---|
| `<?= htmlspecialchars($meta_desc, ENT_QUOTES,...` | 29 | `/en/…` pages — PHP template placeholder leaked into meta_desc field |
| `Artikel ini melaporkan fasilitasi yang diberikan oleh Pemeri…` | 2 | Insiden template |
| `Artikel ini melaporkan bahwa Pemerintah Kabupaten (Pemkab) B…` | 4 | Insiden template |
| `Artikel ini melaporkan penyaluran Jaminan Kecelakaan Kerja (…` | 2 | Insiden template |
| `Artikel ini melaporkan penyaluran Jaminan Kecelakaan Kerja (…` | 2 | Insiden template |
| *(+ 2 more insiden groups)* | | |

**Priority fix — EN pages:** 29 English pages have a raw PHP `<?= htmlspecialchars(...)` string as their meta description. This is a **data quality** issue in the EN content source. The `meta_desc` field in those content entries needs to be replaced with actual descriptions.

**Insiden pages:** Duplicate descriptions stem from the same near-duplicate news event producing multiple slug variants (see §3).

---

## Action Priority

| Priority | Item | Effort |
|---|---|---|
| 🔴 HIGH | Fix 29 EN pages with PHP placeholder as description | Edit EN content data |
| 🟠 MEDIUM | De-duplicate insiden slug variants (`-2026`, `-2026-1`, `-2026-2`) | Data pipeline fix |
| 🟡 LOW | Shorten artikel titles by removing `| Wahana Totalita` suffix | Template or data edit |
| 🟡 LOW | Trim over-160 descriptions by 5–10 chars | Editorial |
| ⚪ DEFER | Course title length (≥66 chars) — minor, brand recognition value | Editorial |
