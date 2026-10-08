const http = require('http');
const fs = require('fs');
const path = require('path');

const PORT = process.env.PORT || 3000;
const OUT_DIR = path.join(__dirname, 'out');
const REDIRECTS_FILE = path.join(__dirname, 'data', 'redirects.json');

let redirects = {};
try {
  if (fs.existsSync(REDIRECTS_FILE)) {
    redirects = JSON.parse(fs.readFileSync(REDIRECTS_FILE, 'utf8'));
  }
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

const server = http.createServer((req, res) => {
  let rawUrl = req.url.split('?')[0];
  let reqPath;
  try {
    reqPath = decodeURI(rawUrl);
  } catch (e) {
    reqPath = rawUrl;
  }

  // Normalize quotes and trailing slashes for lookup
  let cleanPath = reqPath.replace(/^["'\\]+/, '').replace(/["'\\]+$/, '');
  if (cleanPath !== reqPath) {
    res.writeHead(301, { Location: cleanPath });
    res.end();
    return;
  }

  // 1. Check exact 301 redirect map
  const mappedTarget =
    redirects[cleanPath] ||
    redirects[cleanPath + '/'] ||
    (cleanPath.endsWith('/') ? redirects[cleanPath.slice(0, -1)] : null);

  if (mappedTarget) {
    res.writeHead(301, {
      Location: mappedTarget,
      'Cache-Control': 'public, max-age=86400',
    });
    res.end();
    return;
  }

  // 2. Resolve static file path
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
        'Cache-Control': ext === '.html' ? 'no-cache' : 'public, max-age=31536000, immutable',
        'Access-Control-Allow-Origin': '*',
      });
      fs.createReadStream(filePath).pipe(res);
      return;
    }

    // 3. Fallback 404 page
    const notFoundPath = path.join(OUT_DIR, '404', 'index.html');
    const rootNotFound = path.join(OUT_DIR, '_not-found', 'index.html');
    const final404 = fs.existsSync(notFoundPath) ? notFoundPath : rootNotFound;

    if (fs.existsSync(final404)) {
      res.writeHead(404, { 'Content-Type': 'text/html; charset=utf-8' });
      fs.createReadStream(final404).pipe(res);
    } else {
      res.writeHead(404, { 'Content-Type': 'text/plain; charset=utf-8' });
      res.end('404 Not Found');
    }
  });
});

server.listen(PORT, () => {
  console.log(`\nWahana Next.js Static Server running on http://localhost:${PORT}`);
  console.log(`Loaded ${Object.keys(redirects).length} redirect rules.\n`);
});
