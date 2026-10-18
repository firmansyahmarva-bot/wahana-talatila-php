# Deployment Guide: Astro SSG Replacement for PHP Site

## 1. Upload Instructions
- Run `npm run verify` to generate `dist/`.
- Upload all contents of `dist/` directly over the live docroot (`public_html/`), including `.htaccess`.

## 2. Preserved PHP Directories & Files (DO NOT DELETE)
- Folders: `admin/`, `api/`, `forum/`, `verifikasi/`, `newsletter/`, `workplace/`, `lp/`, `mailer/`, `cron/`, `data/`, `assets/uploads/`.
- Files: `config.php`, `secrets.php`, `setup.php`, `database.sql`.

## 3. Rollback Plan
- Create docroot backup before upload: `tar -czf backup-live-$(date +%F).tar.gz public_html/`.
- Rollback: untar backup or check out `deploy-production`.

## 4. Post-Launch Verification (10 URLs to Check)
1. `/` (200 OK Home) | 2. `/pelatihan/` (200 OK Catalog) | 3. `/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri/` (200 OK Course)
4. `/in-house-training/` (200 OK Hub) | 5. `/pelatihan-k3-jakarta/` (200 OK City) | 6. `/tools/` (200 OK Tools)
7. `/zh/` (200 OK & Fonts) | 8. `/kontak` (301 -> `/perusahaan/`) | 9. `/sitemap.xml` (200 OK Sitemap)
10. `/verifikasi/` & `/admin/` (200 OK Preserved PHP dynamic features).

## 5. Search Console Action
- Resubmit `https://wahanatotalita.com/sitemap.xml` in Google Search Console immediately after launch.
