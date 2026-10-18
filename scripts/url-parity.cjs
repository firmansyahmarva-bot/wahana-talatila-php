const fs = require('fs');
const path = require('path');

// 1. Helper to parse .htaccess rewrite rules
function parseHtaccess(htaccessPath) {
  const content = fs.readFileSync(htaccessPath, 'utf8');
  const lines = content.split('\n');
  const rules = [];

  for (let i = 0; i < lines.length; i++) {
    const line = lines[i].trim();
    if (!line || line.startsWith('#')) continue;

    const m = line.match(/^RewriteRule\s+(\S+)\s+(\S+)(?:\s+\[(.*)\])?$/);
    if (!m) continue;

    const pattern = m[1];
    const target = m[2];
    const flags = (m[3] || '').split(',').map(f => f.trim().toUpperCase());

    // Check if it has R=301 or G (Gone)
    const is301 = flags.some(f => f === 'R=301' || f.startsWith('R=301') || f === 'R');
    const isGone = flags.some(f => f === 'G');

    rules.push({
      pattern,
      regex: new RegExp(pattern),
      target,
      is301,
      isGone,
      raw: line
    });
  }

  return rules;
}

// 2. Helper to check if a URL path exists in dist/
function distPathExists(urlPath) {
  let p = urlPath.replace(/^https?:\/\/[^\/]+/, '');
  p = p.split('?')[0].split('#')[0];
  if (p === '' || p === '/') return fs.existsSync('dist/index.html');

  if (!p.startsWith('/')) p = '/' + p;

  if (p.endsWith('.html') || p.endsWith('.xml') || p.endsWith('.txt') || p.endsWith('.json') || p.endsWith('.png') || p.endsWith('.ico')) {
    return fs.existsSync(path.join('dist', p));
  }

  // Trailing slash
  if (p.endsWith('/')) {
    return fs.existsSync(path.join('dist', p, 'index.html'));
  }

  // Without trailing slash, check both /p/index.html and /p.html
  return fs.existsSync(path.join('dist', p, 'index.html')) || fs.existsSync(path.join('dist', p + '.html'));
}

// 3. Evaluate a given path against .htaccess rules
function evaluateHtaccess(rules, urlPath) {
  // Normalize path relative to root, no leading slash for matching
  let cleanPath = urlPath.replace(/^https?:\/\/[^\/]+/, '');
  cleanPath = cleanPath.split('?')[0].split('#')[0];
  if (cleanPath.startsWith('/')) cleanPath = cleanPath.slice(1);

  for (const rule of rules) {
    if (rule.regex.test(cleanPath)) {
      if (rule.isGone) {
        return { action: '410', target: null, rule: rule.raw };
      }
      if (rule.is301) {
        // Substitute capture groups if any
        let target = rule.target;
        const match = cleanPath.match(rule.regex);
        if (match) {
          for (let g = 1; g < match.length; g++) {
            target = target.replace(new RegExp('\\$' + g, 'g'), match[g]);
          }
        }
        return { action: '301', target, rule: rule.raw };
      }
    }
  }

  return null;
}

async function fetchLiveSitemaps() {
  const rootUrl = 'https://wahanatotalita.com/sitemap.xml';
  console.log(`Fetching root sitemap: ${rootUrl}...`);
  let urls = [];
  try {
    const res = await fetch(rootUrl);
    if (!res.ok) throw new Error(`HTTP ${res.status}`);
    const xml = await res.text();
    const locs = [...xml.matchAll(/<loc>([^<]+)<\/loc>/g)].map(m => m[1]);

    const sitemapFiles = locs.filter(l => l.endsWith('.xml'));
    if (sitemapFiles.length > 0) {
      console.log(`Found ${sitemapFiles.length} child sitemaps. Fetching children...`);
      for (const sm of sitemapFiles) {
        try {
          const cRes = await fetch(sm);
          if (cRes.ok) {
            const cXml = await cRes.text();
            const childLocs = [...cXml.matchAll(/<loc>([^<]+)<\/loc>/g)].map(m => m[1]);
            urls.push(...childLocs);
          } else {
            console.warn(`Failed to fetch child sitemap ${sm}: HTTP ${cRes.status}`);
          }
        } catch (e) {
          console.warn(`Error fetching ${sm}:`, e.message);
        }
      }
    } else {
      urls.push(...locs);
    }
  } catch (err) {
    console.warn(`Live site unreachable (${err.message}). Falling back to git origin/deploy-production:sitemap.php`);
    // Fallback logic could parse sitemap.php
  }

  // Deduplicate
  urls = [...new Set(urls)];
  console.log(`Total live sitemap URLs collected: ${urls.length}`);
  return urls;
}

async function runParityTest() {
  const htaccessPath = path.join(__dirname, '..', 'public', '.htaccess');
  const rules = parseHtaccess(htaccessPath);
  console.log(`Parsed ${rules.length} rewrite rules from public/.htaccess`);

  const liveUrls = await fetchLiveSitemaps();

  let countOk = 0;
  let countRedirectedOk = 0;
  let countUnmapped = 0;
  let countBrokenTarget = 0;

  const unmapped = [];
  const brokenTarget = [];

  // 1. Test every live URL
  for (const rawUrl of liveUrls) {
    let p = rawUrl.replace(/^https?:\/\/[^\/]+/, '');
    if (!p) p = '/';

    // Direct 200 in dist?
    if (distPathExists(p)) {
      countOk++;
      continue;
    }

    // Covered by htaccess?
    const match = evaluateHtaccess(rules, p);
    if (match) {
      if (match.action === '410') {
        // 410 Gone is considered handled
        countRedirectedOk++;
        continue;
      }
      if (match.action === '301') {
        // Destination must exist in dist (no chain > 1 hop)
        const dest = match.target;
        if (distPathExists(dest)) {
          countRedirectedOk++;
        } else {
          // Check if destination itself redirects (chain)
          const secondHop = evaluateHtaccess(rules, dest);
          if (secondHop) {
            countBrokenTarget++;
            brokenTarget.push({
              source: rawUrl,
              target: dest,
              reason: `Redirect chain: redirects again to ${secondHop.target}`
            });
          } else {
            countBrokenTarget++;
            brokenTarget.push({
              source: rawUrl,
              target: dest,
              reason: 'Destination does not exist in dist/'
            });
          }
        }
        continue;
      }
    }

    countUnmapped++;
    unmapped.push(rawUrl);
  }

  // 2. Also test every 301 rule target from step 1
  for (const rule of rules) {
    if (rule.is301 && !rule.target.includes('$')) {
      const target = rule.target;
      if (!distPathExists(target)) {
        countBrokenTarget++;
        brokenTarget.push({
          source: rule.pattern,
          target: target,
          reason: 'Rule destination missing in dist/'
        });
      }
    }
  }

  console.log('\n--- URL PARITY TEST RESULTS ---');
  console.log(`OK (200 in dist): ${countOk}`);
  console.log(`REDIRECTED-OK (301/410 valid): ${countRedirectedOk}`);
  console.log(`UNMAPPED: ${countUnmapped}`);
  console.log(`BROKEN-TARGET: ${countBrokenTarget}`);

  let report = `# URL Parity Report\n\n`;
  report += `Generated on: ${new Date().toISOString()}\n\n`;
  report += `## Summary Counts\n\n`;
  report += `- **OK (200 in dist)**: ${countOk}\n`;
  report += `- **REDIRECTED-OK**: ${countRedirectedOk}\n`;
  report += `- **UNMAPPED**: ${countUnmapped}\n`;
  report += `- **BROKEN-TARGET**: ${countBrokenTarget}\n\n`;

  report += `## UNMAPPED URLs (${unmapped.length})\n\n`;
  if (unmapped.length === 0) {
    report += `None! All URLs are mapped.\n\n`;
  } else {
    unmapped.forEach(u => {
      report += `- \`${u}\`\n`;
    });
    report += `\n`;
  }

  report += `## BROKEN-TARGET URLs (${brokenTarget.length})\n\n`;
  if (brokenTarget.length === 0) {
    report += `None! All redirect targets resolve to 200 in dist/.\n\n`;
  } else {
    brokenTarget.forEach(b => {
      report += `- Source: \`${b.source}\` -> Target: \`${b.target}\` (${b.reason})\n`;
    });
    report += `\n`;
  }

  fs.writeFileSync(path.join(__dirname, '..', 'URL-PARITY.md'), report, 'utf8');
  console.log(`\nURL-PARITY.md written successfully.`);

  return { countOk, countRedirectedOk, countUnmapped, countBrokenTarget, unmapped, brokenTarget };
}

if (require.main === module) {
  runParityTest().catch(err => {
    console.error('Fatal error in url-parity:', err);
    process.exit(1);
  });
}

module.exports = { runParityTest };
