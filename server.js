const http = require('http');
const fs = require('fs');
const path = require('path');

const PORT = 3000;
const OUT_DIR = path.join(__dirname, 'out');
const REDIRECTS_FILE = path.join(__dirname, 'data', 'redirects.json');

let redirects = {};
try {
  redirects = JSON.parse(fs.readFileSync(REDIRECTS_FILE, 'utf8'));
} catch (e) {
  console.warn('Could not load redirects.json:', e.message);
}

const MIME_TYPES = {
  '.html': 'text/html; charset=utf-8',
  '.css': 'text/css; charset=utf-8',
  '.js': 'text/javascript; charset=utf-8',
  '.mjs': 'text/javascript; charset=utf-8',
  '.json': 'application/json; charset=utf-8',
  '.png': 'image/png',
  '.jpg': 'image/jpeg',
  '.jpeg': 'image/jpeg',
  '.webp': 'image/webp',
  '.svg': 'image/svg+xml',
  '.ico': 'image/x-icon',
  '.xml': 'application/xml; charset=utf-8',
  '.txt': 'text/plain; charset=utf-8',
  '.woff': 'font/woff',
  '.woff2': 'font/woff2',
  '.ttf': 'font/ttf',
  '.otf': 'font/otf',
};

// Check keyword fallback rules (exact replication of 404.php)
function getKeywordRedirect(cleanPath) {
  const lower = cleanPath.toLowerCase();

  // Obvious junk / security scan probes should 404
  const junkPatterns = [
    'siemens', 'simatic', 'sinamics', 'sirius', 'sitop', 'surplus', 'stock',
    'shop/', 'swagger', 'secrets', 'graphql', 'telescope', 'admin', 'cgi-',
    'suspended', 'ueber-uns', 'unternehmen', 'www.holcim', 'settings.js',
    'sw.js', 'webmail', 'whkd18', 'store-google', 'jenkins', 'solr', 'boaform',
    'phpunit', 'wp-', 'actuator', '.env', '.git', '.sql', '.tar', '.gz',
    '.zip', '.bak', '.action', '.do', '.yml', '.yaml', 'shell', 'aws', '/api/fs/'
  ];
  if (junkPatterns.some(p => lower.includes(p))) {
    return null;
  }

  // City course prefix patterns
  const prefixes = [
    ['petugas-k3-kimia', '/pelatihan/pelatihan-petugas-k3-kimia-sertifikasi-kemnaker-ri/'],
    ['paramedis-k3-utama', '/pelatihan/pelatihan-paramedis-k3-muda-sertifikasi-bnsp/'],
    ['pengkaji-teknis-proteksi-kebakaran', '/pelatihan/pelatihan-regu-penanggulangan-kebakaran-kelas-c-sertifikasi-kemnaker-ri/'],
    ['pengawas-k3-fasyankes', '/ahli-k3-umum/'],
    ['penanganan-bahaya-gas-h2s', '/pelatihan/pelatihan-penanganan-bahaya-gas-h2s-sertifikasi-bnsp/'],
    ['operator-welder-kelas-1', '/pelatihan/pelatihan-k3-operator-welder-kelas-1-sertifikasi-kemnaker-ri/'],
    ['petugas-p3k', '/pelatihan/pelatihan-petugas-p3k-sertifikasi-kemnaker-ri/'],
    ['regu-penanggulangan-kebakaran', '/pelatihan/pelatihan-regu-penanggulangan-kebakaran-kelas-c-sertifikasi-kemnaker-ri/'],
    ['petugas-peran-kebakaran', '/pelatihan/pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri/'],
    ['operator-crane', '/pelatihan/pelatihan-k3-operator-crane-kelas-3-sertifikasi-kemnaker-ri/'],
    ['operator-scaffolding', '/pelatihan/pelatihan-k3-operator-scaffolding-sertifikasi-kemnaker-ri/'],
    ['tkbt-ii', '/pelatihan/pelatihan-tkbt-ii-sertifikasi-kemnaker-ri/'],
    ['sertifikasi-migas-cepu', '/pelatihan/pelatihan-pengawas-k3-migas-sertifikasi-bnsp/'],
    ['operator-forklift', '/pelatihan/pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri/'],
    ['operator-motor-diesel-genset', '/pelatihan/pelatihan-k3-operator-motor-diesel-genset-sertifikasi-kemnaker-ri/'],
    ['ahli-muda-lingkungan-kerja', '/pelatihan/pelatihan-ahli-muda-lingkungan-kerja-sertifikasi-kemnaker-ri/'],
    ['ahli-utama-ruang-terbatas', '/pelatihan/pelatihan-ahli-utama-ruang-terbatas-sertifikasi-bnsp/'],
    ['pop-pertambangan', '/pelatihan/pelatihan-pengawas-operasional-pertama-pop-pertambangan-sertifikasi-bnsp/'],
  ];

  for (const [pfx, target] of prefixes) {
    if (lower.includes(pfx)) return target;
  }

  if (lower.includes('jadwal/daftar/')) return '/jadwal/';
  if (lower.includes('smk3')) return '/smk3/';
  if (lower.includes('bnsp')) return '/sertifikasi-bnsp/';
  if (lower.includes('iso')) return '/pelatihan-iso/';
  if (lower.includes('k3')) return '/k3/';
  if (lower.includes('pelatihan')) return '/pelatihan/';
  if (lower.includes('artikel')) return '/artikel/';

  return null;
}

const server = http.createServer((req, res) => {
  let rawUrl = req.url.split('?')[0];
  let reqPath;
  try {
    reqPath = decodeURI(rawUrl);
  } catch (e) {
    reqPath = rawUrl;
  }

  // Sanitize quotes or escaped quotes like /%22/path/%22 or /\"/path/\"
  let cleanPath = reqPath.replace(/^["'\\]+/, '').replace(/["'\\]+$/, '');
  if (cleanPath !== reqPath) {
    res.writeHead(301, { 'Location': cleanPath });
    res.end();
    return;
  }

  // 1. Direct redirects table
  const mappedTarget = redirects[cleanPath] ||
                       redirects[cleanPath + '/'] ||
                       (cleanPath.endsWith('/') ? redirects[cleanPath.slice(0, -1)] : null);

  if (mappedTarget) {
    res.writeHead(301, {
      'Location': mappedTarget,
      'Cache-Control': 'public, max-age=86400',
    });
    res.end();
    return;
  }

  // 2. Direct file lookup
  let filePath = path.join(OUT_DIR, reqPath);
  if (reqPath.endsWith('/')) {
    filePath = path.join(OUT_DIR, reqPath, 'index.html');
  } else if (!path.extname(reqPath)) {
    const tryDir = path.join(OUT_DIR, reqPath, 'index.html');
    if (fs.existsSync(tryDir)) {
      filePath = tryDir;
    } else {
      const tryHtml = path.join(OUT_DIR, reqPath + '.html');
      if (fs.existsSync(tryHtml)) {
        filePath = tryHtml;
      }
    }
  }

  fs.stat(filePath, (err, stats) => {
    if (!err && stats.isFile()) {
      const ext = path.extname(filePath).toLowerCase();
      const contentType = MIME_TYPES[ext] || 'application/octet-stream';
      res.writeHead(200, {
        'Content-Type': contentType,
        'Cache-Control': 'no-cache',
        'Access-Control-Allow-Origin': '*',
      });
      fs.createReadStream(filePath).pipe(res);
      return;
    }

    // 3. Keyword-matched fallback redirect (replicates 404.php)
    const keywordTarget = getKeywordRedirect(cleanPath);
    if (keywordTarget) {
      res.writeHead(301, {
        'Location': keywordTarget,
        'Cache-Control': 'public, max-age=86400',
      });
      res.end();
      return;
    }

    // 4. Genuine 404 page
    const notFoundPath = path.join(OUT_DIR, '404', 'index.html');
    if (fs.existsSync(notFoundPath)) {
      res.writeHead(404, { 'Content-Type': 'text/html; charset=utf-8' });
      fs.createReadStream(notFoundPath).pipe(res);
    } else {
      res.writeHead(404, { 'Content-Type': 'text/plain; charset=utf-8' });
      res.end('404 Not Found');
    }
  });
});

server.listen(PORT, () => {
  console.log(`\n======================================================`);
  console.log(`Wahana Totalita Next.js Live Server (with SEO Auto-Recovery)`);
  console.log(`>>> Running at http://localhost:${PORT} <<<`);
  console.log(`Loaded ${Object.keys(redirects).length} redirect rules`);
  console.log(`======================================================\n`);
});
