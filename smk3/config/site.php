<?php
/**
 * SITE CONFIGURATION — global constants used by every template.
 * Change contact details, brand info, or main-site editorial link
 * targets HERE, once, and the whole site follows.
 */

return [

  // Canonical base URL — no trailing slash.
  'base_url'   => 'https://smk3.wahanatotalita.com',

  'site_name'  => 'SMK3 Indonesia',
  'tagline'    => 'Panduan & Jasa Konsultan SMK3',

  // Company identity (real, from wahanatotalita.com)
  'org_name'   => 'Wahana Totalita Konsultan',
  'org_url'    => 'https://wahanatotalita.com',
  'org_city'   => 'Yogyakarta',
  'org_region' => 'Daerah Istimewa Yogyakarta',
  'org_country'=> 'ID',

  // Contact & CTA
  'wa_number'    => '6287759151278',            // digits only, for wa.me link
  'wa_display'   => '+62 812-3503-6420',
  'wa_prefill'   => 'Halo, saya ingin konsultasi mengenai SMK3 untuk perusahaan kami.',
  'email'        => 'info@wahanatotalita.com',

  /**
   * Editorial links to the main domain. Referenced from content files via
   * ext_link('key', 'anchor text') so URLs are managed centrally.
   * Each key is used at most once sitewide, mid-content, unique anchors.
   */
  'external' => [
    'wt_perusahaan'   => 'https://wahanatotalita.com/perusahaan',
    'wt_smk3'         => 'https://wahanatotalita.com/smk3',
    'wt_klien'        => 'https://wahanatotalita.com/klien',
    'wt_ketinggian'   => 'https://wahanatotalita.com/k3-ketinggian',
    'wt_kebakaran'    => 'https://wahanatotalita.com/penanggulangan-kebakaran',
    'wt_higiene'      => 'https://wahanatotalita.com/higiene-industri',
    'wt_jadwal'       => 'https://wahanatotalita.com/jadwal/',
  ],

  /**
   * SLUG RENAME SAFETY NET. If a page's 'path' in config/pages.php is ever
   * changed, add the OLD path here mapped to the page key, then run
   * `php build/gen_stubs.php`. The old URL becomes a permanent 301 to the new
   * canonical URL — no duplicate pages, no 404s, link equity preserved.
   * Example: 'regulasi/166-kriteria/' => '166-kriteria-smk3',
   */
  'redirects' => [],

  // Top navigation: label => page key
  'nav' => [
    'Beranda'      => 'home',
    'Regulasi'     => 'regulasi',
    'Implementasi' => 'implementasi',
    'Industri'     => 'industri',
    'Biaya'        => 'biaya',
    'Topik K3'     => 'k3-pendukung',
    'Jasa Konsultan' => 'jasa-konsultan-smk3',
    'Kontak'       => 'kontak',
  ],

  // Footer money links (persistent on every page)
  'footer_money' => ['home', 'jasa-konsultan-smk3', 'jasa-audit-sertifikasi-smk3', 'harga-sertifikasi-smk3', 'kontak'],

  // Hub display names for breadcrumbs
  'hub_names' => [
    'regulasi'     => 'Regulasi',
    'implementasi' => 'Implementasi',
    'industri'     => 'Industri',
    'biaya'        => 'Biaya & Keputusan',
    'pendukung'    => 'Topik K3 Pendukung',
  ],

  // Hub landing page key per hub slug (for breadcrumb links)
  'hub_pages' => [
    'regulasi'     => 'regulasi',
    'implementasi' => 'implementasi',
    'industri'     => 'industri',
    'biaya'        => 'biaya',
    'pendukung'    => 'k3-pendukung',
  ],
];
