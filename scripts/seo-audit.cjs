const fs = require('fs');
const path = require('path');

const distDir = path.join(__dirname, '..', 'dist');

if (!fs.existsSync(distDir)) {
  console.error('dist directory does not exist! Please build the site first.');
  process.exit(1);
}

function walk(dir) {
  let results = [];
  const list = fs.readdirSync(dir);
  for (const file of list) {
    const fullPath = path.join(dir, file);
    const stat = fs.statSync(fullPath);
    if (stat && stat.isDirectory()) {
      results = results.concat(walk(fullPath));
    } else if (file.endsWith('.html')) {
      results.push(fullPath);
    }
  }
  return results;
}

const htmlFiles = walk(distDir).sort();

// Collect all existing files in dist for fast link & asset existence lookup
const allDistFiles = new Set();
function walkAll(dir) {
  for (const file of fs.readdirSync(dir)) {
    const full = path.join(dir, file);
    if (fs.statSync(full).isDirectory()) walkAll(full);
    else allDistFiles.add(path.relative(distDir, full).replace(/\\/g, '/'));
  }
}
walkAll(distDir);

function checkPathExists(p) {
  let clean = p.replace(/^\//, '');
  if (clean === '' || clean.endsWith('/')) {
    clean += 'index.html';
  }
  if (allDistFiles.has(clean)) return true;
  if (allDistFiles.has(clean + '/index.html')) return true;
  if (allDistFiles.has(clean + '.html')) return true;
  if (allDistFiles.has(clean.replace(/\/index\.html$/, '.html'))) return true;
  return false;
}

const audit = {
  titleLength: [],
  descLength: [],
  dupTitles: new Map(),
  dupDescs: new Map(),
  canonicalIssues: [],
  h1Issues: [],
  missingOgImages: [],
  hreflangIssues: [],
  jsonLdIssues: [],
  imgNoAlt: [],
  brokenLinks: []
};

const titleToPages = new Map();
const descToPages = new Map();
const pageHreflangs = new Map();

console.log(`Auditing ${htmlFiles.length} pages in dist...`);

for (const file of htmlFiles) {
  const rel = path.relative(distDir, file).replace(/\\/g, '/');
  const pageUrl = 'https://wahanatotalita.com/' + (rel === 'index.html' ? '' : rel.replace(/\/index\.html$/, '/').replace(/\.html$/, ''));
  const pagePath = '/' + (rel === 'index.html' ? '' : rel.replace(/\/index\.html$/, '/').replace(/\.html$/, ''));
  const content = fs.readFileSync(file, 'utf8');

  // Check if page is a redirect stub (e.g., meta refresh)
  const isRedirect = /<meta\s+[^>]*http-equiv=["']refresh["']/i.test(content);

  // 1. Title
  const titleMatch = content.match(/<title[^>]*>([\s\S]*?)<\/title>/i);
  const title = titleMatch ? titleMatch[1].trim() : '';
  if (!isRedirect) {
    if (!title) {
      audit.titleLength.push({ page: pagePath, issue: 'Missing title', len: 0 });
    } else {
      if (title.length < 30 || title.length > 65) {
        audit.titleLength.push({ page: pagePath, title, len: title.length });
      }
      if (!titleToPages.has(title)) titleToPages.set(title, []);
      titleToPages.get(title).push(pagePath);
    }
  }

  // 2. Description
  const descMatch = content.match(/<meta\s+[^>]*name=["']description["'][^>]*content=["']([^"']*)["']/i) ||
                    content.match(/<meta\s+[^>]*content=["']([^"']*)["'][^>]*name=["']description["']/i);
  const desc = descMatch ? descMatch[1].trim() : '';
  if (!isRedirect) {
    if (!desc) {
      audit.descLength.push({ page: pagePath, issue: 'Missing description', len: 0 });
    } else {
      if (desc.length < 70 || desc.length > 160) {
        audit.descLength.push({ page: pagePath, desc, len: desc.length });
      }
      if (!descToPages.has(desc)) descToPages.set(desc, []);
      descToPages.get(desc).push(pagePath);
    }
  }

  // 3. Canonical
  if (!isRedirect) {
    const canonMatch = content.match(/<link\s+[^>]*rel=["']canonical["'][^>]*href=["']([^"']*)["']/i) ||
                       content.match(/<link\s+[^>]*href=["']([^"']*)["'][^>]*rel=["']canonical["']/i);
    const canonical = canonMatch ? canonMatch[1].trim() : '';
    if (!canonical) {
      audit.canonicalIssues.push({ page: pagePath, issue: 'Missing canonical' });
    } else {
      const issues = [];
      if (!canonical.startsWith('https://')) issues.push('Not https');
      if (!canonical.endsWith('/')) issues.push('Missing trailing slash');
      if (canonical !== pageUrl && canonical !== pageUrl + '/') issues.push(`Mismatch: expected "${pageUrl}", got "${canonical}"`);
      if (issues.length > 0) {
        audit.canonicalIssues.push({ page: pagePath, canonical, issue: issues.join(', ') });
      }
    }
  }

  // 4. H1
  if (!isRedirect) {
    const h1Matches = content.match(/<h1[\s>]/gi);
    const h1Count = h1Matches ? h1Matches.length : 0;
    if (h1Count !== 1) {
      audit.h1Issues.push({ page: pagePath, count: h1Count });
    }
  }

  // 5. OG Image
  if (!isRedirect) {
    const ogImgMatch = content.match(/<meta\s+[^>]*property=["']og:image["'][^>]*content=["']([^"']*)["']/i) ||
                       content.match(/<meta\s+[^>]*content=["']([^"']*)["'][^>]*property=["']og:image["']/i);
    if (!ogImgMatch || !ogImgMatch[1].trim()) {
      audit.missingOgImages.push({ page: pagePath, issue: 'Missing og:image tag' });
    } else {
      const ogImg = ogImgMatch[1].trim();
      let localPath = ogImg;
      if (localPath.startsWith('https://wahanatotalita.com/')) {
        localPath = localPath.replace('https://wahanatotalita.com/', '');
      } else if (localPath.startsWith('/')) {
        localPath = localPath.slice(1);
      }
      if (!ogImg.startsWith('http://') && !ogImg.startsWith('https://') || ogImg.includes('wahanatotalita.com/')) {
        if (!allDistFiles.has(localPath)) {
          audit.missingOgImages.push({ page: pagePath, ogImage: ogImg, localPath });
        }
      }
    }
  }

  // 6. Hreflangs
  const hlRegex = /<link\s+[^>]*hreflang=["']([^"']*)["'][^>]*href=["']([^"']*)["']/gi;
  const hlRegex2 = /<link\s+[^>]*href=["']([^"']*)["'][^>]*hreflang=["']([^"']*)["']/gi;
  const hreflangs = [];
  let m;
  while ((m = hlRegex.exec(content)) !== null) {
    hreflangs.push({ lang: m[1], href: m[2] });
  }
  while ((m = hlRegex2.exec(content)) !== null) {
    if (!hreflangs.find(h => h.lang === m[2])) {
      hreflangs.push({ lang: m[2], href: m[1] });
    }
  }
  if (hreflangs.length > 0) {
    pageHreflangs.set(pageUrl, { pagePath, hreflangs });
  }

  // 7. JSON-LD validation
  const scriptRegex = /<script\s+[^>]*type=["']application\/ld\+json["'][^>]*>([\s\S]*?)<\/script>/gi;
  let sMatch;
  while ((sMatch = scriptRegex.exec(content)) !== null) {
    const raw = sMatch[1].trim();
    try {
      const parsed = JSON.parse(raw);
      const items = Array.isArray(parsed) ? parsed : [parsed];
      for (const it of items) {
        if (it['@graph']) {
          if (!it['@context']) {
            audit.jsonLdIssues.push({ page: pagePath, issue: 'Missing @context in graph root', raw: raw.slice(0, 100) });
          }
          for (const gItem of it['@graph']) {
            if (!gItem['@type']) {
              audit.jsonLdIssues.push({ page: pagePath, issue: 'Missing @type in graph item', raw: raw.slice(0, 100) });
            }
          }
        } else {
          if (!it['@context'] || !it['@type']) {
            audit.jsonLdIssues.push({ page: pagePath, issue: 'Missing @context or @type', raw: raw.slice(0, 100) });
          }
        }
      }
    } catch (e) {
      audit.jsonLdIssues.push({ page: pagePath, issue: 'JSON.parse error: ' + e.message, raw: raw.slice(0, 100) });
    }
  }

  // 8. <img> without alt
  const imgRegex = /<img\b([^>]*)>/gi;
  let imgMatch;
  while ((imgMatch = imgRegex.exec(content)) !== null) {
    const attrs = imgMatch[1];
    if (!/\balt\s*=/i.test(attrs)) {
      const srcMatch = attrs.match(/\bsrc=["']([^"']*)["']/i);
      audit.imgNoAlt.push({ page: pagePath, src: srcMatch ? srcMatch[1] : 'unknown' });
    }
  }

  // 9. Internal links check
  const linkRegex = /<a\b[^>]*href=["']([^"'#?]+)["']/gi;
  let linkMatch;
  while ((linkMatch = linkRegex.exec(content)) !== null) {
    let target = linkMatch[1].trim();
    if (target.startsWith('mailto:') || target.startsWith('tel:') || target.startsWith('javascript:')) continue;
    if (target.startsWith('http://') || target.startsWith('https://')) {
      if (!target.startsWith('https://wahanatotalita.com') && !target.startsWith('http://wahanatotalita.com')) {
        continue; // external
      }
      target = target.replace(/^https?:\/\/wahanatotalita\.com/, '');
    }
    if (!target.startsWith('/')) {
      // relative link, skip or resolve
      continue;
    }
    if (!checkPathExists(target)) {
      audit.brokenLinks.push({ page: pagePath, target });
    }
  }
}

// Check Duplicate Titles and Descriptions
for (const [title, pages] of titleToPages.entries()) {
  if (pages.length > 1) {
    audit.dupTitles.set(title, pages);
  }
}
for (const [desc, pages] of descToPages.entries()) {
  if (pages.length > 1) {
    audit.dupDescs.set(desc, pages);
  }
}

// Check Reciprocal Hreflangs
for (const [pUrl, { pagePath, hreflangs }] of pageHreflangs.entries()) {
  for (const hl of hreflangs) {
    if (hl.href === pUrl) continue; // self
    if (hl.lang === 'x-default') continue;
    const targetData = pageHreflangs.get(hl.href) || pageHreflangs.get(hl.href + '/');
    if (!targetData) {
      audit.hreflangIssues.push({ page: pagePath, target: hl.href, issue: 'Target page has no hreflang tags or not found' });
    } else {
      // Check if targetData has reciprocal link to pUrl
      const hasBack = targetData.hreflangs.some(th => th.href === pUrl || th.href === pUrl + '/' || th.href + '/' === pUrl);
      if (!hasBack) {
        audit.hreflangIssues.push({ page: pagePath, target: hl.href, issue: 'Target does not link back to source' });
      }
    }
  }
}

// Print Summary Report
console.log('\n====================================================');
console.log('             SEO AUDIT DETAILED REPORT              ');
console.log('====================================================\n');

function printSection(title, list, formatter) {
  console.log(`--- ${title}: ${list.length} ---`);
  if (list.length > 0) {
    list.slice(0, 10).forEach(item => console.log('  *', formatter(item)));
    if (list.length > 10) console.log(`  ... and ${list.length - 10} more`);
  }
  console.log('');
}

printSection('1. Title length outside 30-65 chars (COPY WARNING)', audit.titleLength, (i) => `${i.page} [len: ${i.len}] "${i.title || i.issue}"`);
printSection('2. Description length outside 70-160 chars (COPY WARNING)', audit.descLength, (i) => `${i.page} [len: ${i.len}] "${i.desc || i.issue}"`);

console.log(`--- 3. Duplicate Titles: ${audit.dupTitles.size} groups (COPY WARNING) ---`);
let tCount = 0;
for (const [t, pages] of audit.dupTitles.entries()) {
  if (tCount++ < 5) console.log(`  * "${t}" (${pages.length} pages: ${pages.slice(0, 3).join(', ')}${pages.length > 3 ? '...' : ''})`);
}
console.log('');

console.log(`--- 4. Duplicate Descriptions: ${audit.dupDescs.size} groups (COPY WARNING) ---`);
let dCount = 0;
for (const [d, pages] of audit.dupDescs.entries()) {
  if (dCount++ < 5) console.log(`  * "${d.slice(0, 60)}..." (${pages.length} pages: ${pages.slice(0, 3).join(', ')}${pages.length > 3 ? '...' : ''})`);
}
console.log('');

printSection('5. Canonical Issues', audit.canonicalIssues, (i) => `${i.page}: ${i.issue} (val: "${i.canonical}")`);
printSection('6. H1 Issues (0 or >1 H1)', audit.h1Issues, (i) => `${i.page} (count: ${i.count})`);
printSection('7. Missing og:image Files', audit.missingOgImages, (i) => `${i.page}: ${i.ogImage || i.issue}`);
printSection('8. Non-reciprocal Hreflangs', audit.hreflangIssues, (i) => `${i.page} -> ${i.target}: ${i.issue}`);
printSection('9. JSON-LD Issues (invalid or missing @context/@type)', audit.jsonLdIssues, (i) => `${i.page}: ${i.issue}`);
printSection('10. <img> Missing alt Attribute', audit.imgNoAlt, (i) => `${i.page} -> <img src="${i.src}">`);
printSection('11. Broken Internal Links', audit.brokenLinks, (i) => `${i.page} -> "${i.target}"`);

const criticalIssues = audit.canonicalIssues.length +
                       audit.h1Issues.length +
                       audit.missingOgImages.length +
                       audit.hreflangIssues.length +
                       audit.jsonLdIssues.length +
                       audit.imgNoAlt.length +
                       audit.brokenLinks.length;

console.log('====================================================');
console.log(`CRITICAL MECHANICAL ISSUES: ${criticalIssues}`);
console.log(`COPY ISSUES (Informational): ${audit.titleLength.length + audit.descLength.length + audit.dupTitles.size + audit.dupDescs.size}`);
console.log('====================================================\n');

if (criticalIssues > 0) {
  process.exit(1);
} else {
  console.log('SEO Audit passed (0 critical issues).');
  process.exit(0);
}
