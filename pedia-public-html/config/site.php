<?php
/**
 * SITE CONFIGURATION — pedia.wahanatotalita.com
 * Non-commercial K3/HSE knowledge library. All contacts, nav, footer sets,
 * and external link targets live HERE — never in content files.
 */

return [

  'base_url'   => 'https://pedia.wahanatotalita.com',

  'site_name'  => 'PediaK3',
  'tagline'    => 'Pustaka Pengetahuan K3 & HSE Indonesia',

  'org_name'   => 'Wahana Totalita Konsultan',
  'org_url'    => 'https://wahanatotalita.com',
  'org_city'   => 'Yogyakarta',
  'org_region' => 'Daerah Istimewa Yogyakarta',
  'org_country'=> 'ID',

  'email'      => 'info@wahanatotalita.com',

  /** Slug-rename safety net — same mechanism as smk3_site/iso_site. */
  'redirects' => [],

  /**
   * External editorial links.
   * - Exactly 3 to the parent domain (one each in: ahli-k3-umum,
   *   smk3-pp-50-2012, audit-smk3) — unique anchors, mid-body, via ext_link().
   * - Max 2 cross-links each to the sister subdomains (smk3., iso.).
   * - Official government sources (jdih/peraturan.go.id) are cited freely.
   */
  'external' => [
'wt_pelatihan_k3' => 'https://wahanatotalita.com/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri/',    'wt_smk3'         => 'https://wahanatotalita.com/smk3',
    'wt_perusahaan'   => 'https://wahanatotalita.com/perusahaan',
    'smk3_home'       => 'https://smk3.wahanatotalita.com/',
    'iso_home'        => 'https://iso.wahanatotalita.com/',
    'jdih_kemnaker'   => 'https://jdih.kemnaker.go.id/',
    'peraturan_go_id' => 'https://peraturan.go.id/',
  ],

  // Top navigation: label => page key
  'nav' => [
    'Beranda'      => 'home',
    'K3 Dasar'     => 'k3-dasar',
    'Bahaya'       => 'bahaya',
    'Regulasi'     => 'regulasi',
    'Kesehatan'    => 'kesehatan-kerja',
    'Lingkungan'   => 'lingkungan',
    'Studi Kasus'  => 'studi-kasus',
  ],

  /**
   * MEGA-FOOTER: every page permanently links all regulasi entries and all
   * bahaya entries + platform links → zero orphans, 1-click reachability.
   */
  'footer_regulasi' => ['regulasi', 'uu-1-1970-keselamatan-kerja', 'smk3-pp-50-2012', 'permenaker-5-2018-lingkungan-kerja', 'permenaker-8-2020-alat-angkat', 'permenaker-15-2008-p3k', 'sanksi-pelanggaran-k3'],
  'footer_bahaya'   => ['bahaya', 'hierarki-pengendalian-risiko', 'alat-pelindung-diri', 'bekerja-di-ketinggian', 'ruang-terbatas', 'k3-listrik', 'kebakaran-di-tempat-kerja'],
  'footer_platform' => ['tentang-redaksi', 'standar-editorial', 'kontribusi', 'kontak', 'kebijakan-privasi', 'syarat-ketentuan'],

  'hub_names' => [
    'k3-dasar'        => 'K3 Dasar & SMK3',
    'bahaya'          => 'Bahaya & Pengendalian',
    'regulasi'        => 'Regulasi K3',
    'kesehatan-kerja' => 'Kesehatan Kerja',
    'lingkungan'      => 'Lingkungan & Limbah B3',
    'studi-kasus'     => 'Studi Kasus & Investigasi',
    'utility'         => 'Informasi',
  ],

  'hub_pages' => [
    'k3-dasar'        => 'k3-dasar',
    'bahaya'          => 'bahaya',
    'regulasi'        => 'regulasi',
    'kesehatan-kerja' => 'kesehatan-kerja',
    'lingkungan'      => 'lingkungan',
    'studi-kasus'     => 'studi-kasus',
    'utility'         => 'home',
  ],
];
