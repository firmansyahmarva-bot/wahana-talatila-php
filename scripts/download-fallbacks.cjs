// scripts/download-fallbacks.cjs
// Downloads 4 category fallback photos from Unsplash for banner backgrounds.
'use strict';
const https = require('https');
const http = require('http');
const fs = require('fs');
const path = require('path');

const OUT_DIR = path.join(__dirname, 'banner-photos');
if (!fs.existsSync(OUT_DIR)) fs.mkdirSync(OUT_DIR, { recursive: true });

const FALLBACKS = [
  {
    cat: 'k3',
    url: 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1400&q=85&auto=format&fit=crop',
    file: 'fallback-k3.jpg',
  },
  {
    cat: 'lingkungan',
    url: 'https://images.unsplash.com/photo-1518020382113-a7e8fc38eac9?w=1400&q=85&auto=format&fit=crop',
    file: 'fallback-lingkungan.jpg',
  },
  {
    cat: 'system-management',
    url: 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=1400&q=85&auto=format&fit=crop',
    file: 'fallback-system-management.jpg',
  },
  {
    cat: 'mining',
    url: 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=1400&q=85&auto=format&fit=crop',
    file: 'fallback-mining.jpg',
  },
];

function downloadFile(url, dest) {
  return new Promise((resolve, reject) => {
    if (fs.existsSync(dest)) {
      const size = fs.statSync(dest).size;
      if (size > 50000) { console.log(`  skip (exists ${(size/1024).toFixed(0)}KB): ${path.basename(dest)}`); return resolve(); }
    }
    const file = fs.createWriteStream(dest);
    const client = url.startsWith('https') ? https : http;

    function get(u) {
      client.get(u, { headers: { 'User-Agent': 'Mozilla/5.0 (banner-builder)' } }, (res) => {
        if (res.statusCode === 301 || res.statusCode === 302 || res.statusCode === 307 || res.statusCode === 308) {
          file.destroy();
          const redir = res.headers.location;
          console.log(`  redirect -> ${redir}`);
          const rc = redir.startsWith('https') ? https : http;
          rc.get(redir, { headers: { 'User-Agent': 'Mozilla/5.0 (banner-builder)' } }, (res2) => {
            if (res2.statusCode !== 200) { reject(new Error(`HTTP ${res2.statusCode} on ${redir}`)); return; }
            const file2 = fs.createWriteStream(dest);
            res2.pipe(file2);
            file2.on('finish', () => { file2.close(); resolve(); });
            file2.on('error', reject);
          }).on('error', reject);
          return;
        }
        if (res.statusCode !== 200) { reject(new Error(`HTTP ${res.statusCode}`)); return; }
        res.pipe(file);
        file.on('finish', () => { file.close(); resolve(); });
        file.on('error', reject);
      }).on('error', reject);
    }
    get(url);
  });
}

async function main() {
  for (const f of FALLBACKS) {
    const dest = path.join(OUT_DIR, f.file);
    process.stdout.write(`Downloading ${f.file}... `);
    try {
      await downloadFile(f.url, dest);
      if (fs.existsSync(dest)) {
        console.log(`OK (${(fs.statSync(dest).size / 1024).toFixed(0)}KB)`);
      }
    } catch (e) {
      console.log(`FAILED: ${e.message}`);
    }
  }
  console.log('Done.');
}

main();
