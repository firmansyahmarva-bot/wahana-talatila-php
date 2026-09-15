<?php
/**
 * SITE CONFIGURATION — global constants used by every template.
 * Change contact details, brand info, or main-site link targets HERE, once.
 */

return [

  'base_url'   => 'https://k3umum.wahanatotalita.com',
  'site_name'  => 'Ahli K3 Umum',
  'tagline'    => 'Panduan Lengkap Sertifikasi, Tugas, dan Karir Ahli K3 Umum',

  // Company identity (real, from wahanatotalita.com)
  'org_name'   => 'Wahana Totalita Konsultan',
  'org_url'    => 'https://wahanatotalita.com',
  'org_city'   => 'Yogyakarta',
  'org_region' => 'Daerah Istimewa Yogyakarta',
  'org_country'=> 'ID',

  // Contact & lead capture — verified LIVE on wahanatotalita.com homepage 2026-07-20
  // (differs from an older number recorded in project notes; live site wins)
  'wa_number'  => '628122969435',
  'wa_display' => '+62 812-2969-435',
  'wa_prefill' => 'Halo, saya ingin tanya seputar Ahli K3 Umum.',
  'email'      => 'info@wahanatotalita.com',

  /**
   * Author / reviewer for E-E-A-T. REAL credentials pending from the user
   * ("Bu Dias") — do NOT publish with placeholder values filled in below.
   * Fill in: full name, AK3U/HSE certification number, cert issuer, years
   * of experience, and a real photo before this site goes live. Until then
   * every content file's author block renders these placeholders verbatim
   * so it's obvious in a build/QA pass if this was missed.
   */
  'author' => [
    'name'        => 'Dias', // TODO: full name from user
    'title'       => 'Ahli K3 Umum', // TODO: confirm exact credential/title
    'cert_number' => null, // TODO: real SKP/registration number
    'bio'         => 'TODO: bio belum diisi — tunggu data dari pengguna sebelum publish.',
    'photo'       => null, // TODO: /assets/img/author-dias.jpg
  ],

  /**
   * Verified real pages on the main domain — ONLY confirmed-live paths go
   * here (checked 2026-07-20). Referenced via ext_link('key','anchor').
   * This subdomain otherwise carries NO editorial links to the main domain
   * or sister subdomains — every outbound link here is a deliberate,
   * capped lead-generation CTA, never a sitewide/contextual link.
   */
  'external' => [
    'wt_jadwal'     => 'https://wahanatotalita.com/jadwal/',
    'wt_perusahaan' => 'https://wahanatotalita.com/perusahaan',
  ],

  // Slug-rename safety net — see build/gen_stubs.php. Empty until a page is renamed.
  'redirects' => [],

  // Top navigation: label => page key (depth-1 pages only)
  'nav' => [
    'Beranda'      => 'home',
    'Dasar Hukum'  => 'a',
    'Sertifikasi'  => 'b',
    'Praktik K3'   => 'c',
    'Per Industri' => 'd',
    'Statistik'    => 'e',
    'Glosarium'    => 'f3',
    'FAQ'          => 'f4',
  ],

  // Footer link sets (persistent on every page)
  'footer_pillars' => ['a', 'b', 'c', 'd', 'e', 'f1', 'f2', 'f3', 'f4'],
];
