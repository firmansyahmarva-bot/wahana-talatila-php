# Deployment Guide: Cloudflare Pages (Astro SSG + Functions)

## 1. Cloudflare Pages Project Settings
- **Framework Preset**: Astro | **Build command**: `npm run build` | **Build output directory**: `dist`
- **Environment variables**: `NODE_VERSION`: `20` (or `22`). Pages Functions free tier includes 100,000 requests/day.

## 2. DNS Cutover & SSL Settings
- Copy existing MX, TXT, and mail records to Cloudflare DNS *before* changing nameservers to avoid email downtime.
- In Cloudflare SSL/TLS settings: Enable **Always Use HTTPS**.
- Add Cloudflare Redirect Rule or Page Rule for **www -> apex**: `https://www.wahanatotalita.com/*` -> `https://wahanatotalita.com/$1` (301).

## 3. Search Console & Rollback
- Resubmit `https://wahanatotalita.com/sitemap.xml` in Google Search Console immediately after DNS cutover.
- **Rollback**: To revert to Hostinger PHP immediately, change the DNS `A` records back to the Hostinger server IP.

## 4. Post-Launch Verification (10 URLs to Check)
1. `/` (200 Home) | 2. `/pelatihan/` (200 Catalog) | 3. `/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri/` (200 Course)
4. `/in-house-training/` (200 Hub) | 5. `/pelatihan-k3-jakarta/` (200 City) | 6. `/tools/` (200 Tools) | 7. `/zh/` (200 Chinese)
8. `/k3/` (301 -> `/pelatihan/k3/`) | 9. `/kontak` (301 -> `/perusahaan/`) | 10. `/.env` (410 Gone).

## 5. How to Add a Redirect Later
- Open `functions/redirect-rules.js` and add your route under `EXACT_REDIRECTS` (e.g. `'/old-url/': '/new-url/'`). Commit & push.


## 6. Daily Scheduled Rebuild & Deploy
- Create a Deploy Hook in Cloudflare Pages (**Settings** > **Builds & deployments** > **Deploy hooks**).
- Save its URL as the GitHub secret CF_PAGES_DEPLOY_HOOK in your repository (**Settings** > **Secrets and variables** > **Actions**).
