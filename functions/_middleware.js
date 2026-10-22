import {
  JUNK_PATTERNS,
  JOOMLA_RULES,
  EXACT_REDIRECTS,
  SUBSTRING_REDIRECTS,
  REGEX_RULES,
  KEYWORD_REDIRECTS
} from './redirect-rules.js';

const GONE_HTML = `<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>410 Konten Telah Dihapus | Wahana Totalita</title>
<meta name="robots" content="noindex, nofollow">
<style>
body{font-family:system-ui,-apple-system,sans-serif;background:#0d1117;color:#c9d1d9;display:flex;align-items:center;justify-content:center;height:100vh;margin:0;padding:20px;text-align:center}
.box{max-width:480px;background:#161b22;padding:36px;border-radius:12px;border:1px solid #30363d;box-shadow:0 8px 24px rgba(0,0,0,.3)}
h1{font-size:42px;color:#f85149;margin:0 0 12px;font-weight:800}
p{font-size:15px;line-height:1.6;margin:0 0 24px;color:#8b949e}
a{display:inline-block;background:#238636;color:#fff;text-decoration:none;padding:10px 22px;border-radius:6px;font-weight:600;font-size:14px}
a:hover{background:#2ea043}
</style>
</head>
<body>
<div class="box">
  <h1>410</h1>
  <p>Halaman atau sumber daya yang Anda tuju telah dihapus secara permanen dan tidak lagi tersedia di server kami.</p>
  <a href="/">&larr; Kembali ke Beranda</a>
</div>
</body>
</html>`;

function create410Response() {
  return new Response(GONE_HTML, {
    status: 410,
    headers: {
      'Content-Type': 'text/html; charset=utf-8',
      'X-Robots-Tag': 'noindex, nofollow',
      'Cache-Control': 'public, max-age=86400'
    }
  });
}

function create301Response(location, retainQuery = false, currentSearch = '') {
  let finalLocation = location;
  if (retainQuery && currentSearch && !finalLocation.includes('?')) {
    finalLocation += currentSearch;
  }
  return new Response(null, {
    status: 301,
    headers: {
      Location: finalLocation,
      'Cache-Control': 'public, max-age=31536000'
    }
  });
}

export async function onRequest(context) {
  const { request, next } = context;

  // Only handle GET and HEAD
  if (request.method !== 'GET' && request.method !== 'HEAD') {
    return next();
  }

  // 1. First, call downstream: a real page ALWAYS wins!
  const res = await next();
  if (res.status !== 404) {
    return res;
  }

  // If 404, evaluate our redirect and 410 rules
  const url = new URL(request.url);
  const pathRaw = url.pathname;
  let pathLower = pathRaw.toLowerCase();

  // ---------------------------------------------------------------------------
  // Step A: Quote normalization & double slashes (404.php Section 0)
  // ---------------------------------------------------------------------------
  if (pathLower.includes('%22') || pathLower.includes('"') || pathLower.includes('//')) {
    let clean = pathLower.replace(/%22|"/g, '');
    clean = clean.replace(/\/+/g, '/');
    if (clean !== pathLower && clean.length > 1) {
      return create301Response(clean, true, url.search);
    }
  }

  // ---------------------------------------------------------------------------
  // Step B: Silent Junk & Bot Scanner Patterns -> 410 (404.php Section 1)
  // ---------------------------------------------------------------------------
  for (const junk of JUNK_PATTERNS) {
    if (pathLower.includes(junk)) {
      return create410Response();
    }
  }

  // ---------------------------------------------------------------------------
  // Step C: Joomla com_content query redirects (.htaccess lines 28-52)
  // ---------------------------------------------------------------------------
  const option = url.searchParams.get('option');
  if (option && option.toLowerCase() === 'com_content') {
    const id = url.searchParams.get('id');
    const matchedJoomla = JOOMLA_RULES.find((r) => r.id === id);
    if (matchedJoomla) {
      // In live .htaccess, Joomla redirects end with '?' to discard the query string
      return create301Response(matchedJoomla.target, false);
    }
    // Any other com_content query string -> 410 Gone
    return create410Response();
  }

  // ---------------------------------------------------------------------------
  // Step D: Exact Path Lookups (.htaccess exacts, 404.php exacts, legacyCourseMap, training_redirects)
  // ---------------------------------------------------------------------------
  const pathWithSlash = pathLower.endsWith('/') ? pathLower : pathLower + '/';
  const pathWithoutSlash = pathLower.endsWith('/') ? pathLower.slice(0, -1) : pathLower;

  if (EXACT_REDIRECTS[pathLower]) {
    return create301Response(EXACT_REDIRECTS[pathLower], true, url.search);
  }
  if (EXACT_REDIRECTS[pathWithSlash]) {
    return create301Response(EXACT_REDIRECTS[pathWithSlash], true, url.search);
  }
  if (EXACT_REDIRECTS[pathWithoutSlash]) {
    return create301Response(EXACT_REDIRECTS[pathWithoutSlash], true, url.search);
  }

  // ---------------------------------------------------------------------------
  // Step E: Substring City & Course Redirects (404.php Section 8b)
  // ---------------------------------------------------------------------------
  for (const sub of SUBSTRING_REDIRECTS) {
    if (pathLower.includes(sub.substring)) {
      return create301Response(sub.target, true, url.search);
    }
  }

  // ---------------------------------------------------------------------------
  // Step F: Pattern / Regex Rules (.htaccess WP, /news/, tools, sitemaps, permutations)
  // ---------------------------------------------------------------------------
  const cleanMatchPath = pathLower.startsWith('/') ? pathLower.slice(1) : pathLower;

  for (const rule of REGEX_RULES) {
    const m = cleanMatchPath.match(rule.regex);
    if (m) {
      if (rule.status === 410) {
        return create410Response();
      }
      let target = typeof rule.target === 'function' ? rule.target(m) : rule.target;
      return create301Response(target, true, url.search);
    }
  }

  // ---------------------------------------------------------------------------
  // Step G: Keyword-Matched Slugs (404.php Section 10)
  // ---------------------------------------------------------------------------
  for (const kw of KEYWORD_REDIRECTS) {
    if (kw.pattern.test(pathLower)) {
      return create301Response(kw.target, true, url.search);
    }
  }

  // ---------------------------------------------------------------------------
  // Step H: Fallback: return the original 404 response untouched
  // ---------------------------------------------------------------------------
  return res;
}
