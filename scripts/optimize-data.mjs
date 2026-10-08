import fs from 'fs';
import path from 'path';

const pagesDir = path.join(process.cwd(), 'data', 'pages');
const indexPath = path.join(process.cwd(), 'data', 'pages_index.json');
const indexBackupPath = path.join(process.cwd(), 'data', 'pages_index.backup.json');

console.log('Starting optimization of pages and index...');

// 1. Clean every page JSON
const files = fs.readdirSync(pagesDir);
let totalOriginalBytes = 0;
let totalCleanedBytes = 0;
let cleanedPagesCount = 0;

function cleanBodyHtml(rawHtml) {
  if (!rawHtml) return '';
  let html = rawHtml;

  // If full document, strip up to <body...>
  if (html.includes('<!DOCTYPE') || html.includes('<!doctype') || html.includes('<html')) {
    const bodyIdx = html.search(/<body[^>]*>/i);
    if (bodyIdx !== -1) {
      const match = html.match(/<body[^>]*>/i);
      html = html.slice(bodyIdx + match[0].length);
    }
  }

  // Remove skip-link, scroll-progress, GTM noscript
  html = html.replace(/<div id="scroll-progress"[^>]*><\/div>/gi, '');
  html = html.replace(/<a href="#konten-utama"[^>]*>[\s\S]*?<\/a>/gi, '');
  html = html.replace(/<noscript><iframe[^>]*><\/iframe><\/noscript>/gi, '');
  html = html.replace(/<noscript><link[^>]*><\/noscript>/gi, '');

  // Remove all headers and navbars
  html = html.replace(/<nav class="navbar[\s\S]*?<\/nav>/gi, '');
  html = html.replace(/<nav class="mobile-bottom-nav[\s\S]*?<\/nav>/gi, '');
  html = html.replace(/<header class="nav[\s\S]*?<\/header>/gi, '');
  html = html.replace(/<header class="site-header[\s\S]*?<\/header>/gi, '');
  html = html.replace(/<header class="en-nav[\s\S]*?<\/header>/gi, '');
  html = html.replace(/<header class="zh-nav[\s\S]*?<\/header>/gi, '');
  html = html.replace(/<nav class="zh-nav[\s\S]*?<\/nav>/gi, '');
  html = html.replace(/<nav class="nav[\s\S]*?<\/nav>/gi, '');
  html = html.replace(/<nav[\s\S]*?<\/nav>/gi, '');

  // Remove photo strip
  html = html.replace(/<section class="footer-photo-strip[\s\S]*?<\/section>/gi, '');
  html = html.replace(/<div class="footer-photo-strip[\s\S]*?<\/div>\s*<\/div>\s*<\/div>/gi, '');

  // Remove footers
  html = html.replace(/<footer class="footer[\s\S]*?<\/footer>/gi, '');
  html = html.replace(/<footer class="site-footer[\s\S]*?<\/footer>/gi, '');
  html = html.replace(/<footer class="en-footer[\s\S]*?<\/footer>/gi, '');
  html = html.replace(/<footer class="zh-footer[\s\S]*?<\/footer>/gi, '');
  html = html.replace(/<footer class="pr-foot[\s\S]*?<\/footer>/gi, '');
  html = html.replace(/<footer class="foot[\s\S]*?<\/footer>/gi, '');
  html = html.replace(/<footer[\s\S]*?<\/footer>/gi, '');

  // Remove floating WhatsApp button
  html = html.replace(/<a[^>]+class="[^"]*wa-float[^"]*"[\s\S]*?<\/a>/gi, '');

  // Remove all script tags
  html = html.replace(/<script[\s\S]*?<\/script>/gi, '');

  // Remove layout comment markers
  html = html.replace(/<!--\s*═+.*?═+\s*-->/gi, '');
  html = html.replace(/<!--\s*──.*?──\s*-->/gi, '');
  html = html.replace(/<!--\s*FOOTER[\s\S]*?-->/gi, '');
  html = html.replace(/<!--\s*Floating WhatsApp[\s\S]*?-->/gi, '');
  html = html.replace(/<!--\s*Quick Contact Strip[\s\S]*?-->/gi, '');
  html = html.replace(/<!--\s*AI Training Finder Chat Widget\s*-->/gi, '');

  // Remove orphaned print stylesheets or widgets
  html = html.replace(/<link rel="stylesheet" href="\/assets\/css\/ai-chat\.css"[^>]*>/gi, '');

  html = html.trim();

  // If page doesn't have an outer <main>, wrap it for semantic consistency
  if (!html.startsWith('<main') && !html.includes('<main id="konten-utama"')) {
    html = `<main id="konten-utama">${html}</main>`;
  }

  return html;
}

for (const file of files) {
  const filePath = path.join(pagesDir, file);
  const data = JSON.parse(fs.readFileSync(filePath, 'utf8'));
  const origLen = Buffer.byteLength(data.body_html || '', 'utf8');
  totalOriginalBytes += origLen;

  const cleaned = cleanBodyHtml(data.body_html || '');
  const cleanedLen = Buffer.byteLength(cleaned, 'utf8');
  totalCleanedBytes += cleanedLen;

  data.body_html = cleaned;
  fs.writeFileSync(filePath, JSON.stringify(data));
  cleanedPagesCount++;
}

console.log(`Cleaned ${cleanedPagesCount} pages.`);
console.log(`Original body size: ${(totalOriginalBytes / (1024 * 1024)).toFixed(2)} MB`);
console.log(`Cleaned body size: ${(totalCleanedBytes / (1024 * 1024)).toFixed(2)} MB`);
console.log(`Saved: ${((totalOriginalBytes - totalCleanedBytes) / (1024 * 1024)).toFixed(2)} MB`);

// 2. Optimize pages_index.json
if (fs.existsSync(indexPath)) {
  const origIndexRaw = fs.readFileSync(indexPath, 'utf8');
  const origIndexSize = Buffer.byteLength(origIndexRaw, 'utf8');

  // Backup original index
  if (!fs.existsSync(indexBackupPath)) {
    fs.writeFileSync(indexBackupPath, origIndexRaw);
    console.log(`Created backup at ${indexBackupPath}`);
  }

  const origIndex = JSON.parse(origIndexRaw);
  const leanIndex = {};

  for (const [key, val] of Object.entries(origIndex)) {
    leanIndex[key] = {
      id: val.id,
      title: val.title,
      description: val.description,
      canonical: val.canonical,
      type: val.type || 'website',
    };
  }

  const leanIndexRaw = JSON.stringify(leanIndex);
  fs.writeFileSync(indexPath, leanIndexRaw);

  const leanIndexSize = Buffer.byteLength(leanIndexRaw, 'utf8');
  console.log(`Optimized pages_index.json: ${(origIndexSize / (1024 * 1024)).toFixed(2)} MB -> ${(leanIndexSize / 1024).toFixed(2)} KB!`);
}

console.log('Optimization complete!');
