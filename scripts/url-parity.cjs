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
  let countShadowed = 0;
  let countChainsOrLoops = 0;

  const unmapped = [];
  const brokenTarget = [];
  const shadowedViolations = [];
  const chainViolations = [];

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
        countRedirectedOk++;
        continue;
      }
      if (match.action === '301') {
        const dest = match.target;
        if (distPathExists(dest)) {
          countRedirectedOk++;
        } else {
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

  // 3. NEW CHECK: For every redirect rule whose source is a plain path (no regex groups),
  // fail if that path (with trailing slash) exists as a page in dist/.
  for (const rule of rules) {
    if (!rule.is301) continue;
    const p = rule.pattern;
    // Check if plain path without regex groups
    if (!p.includes('(') && !p.includes('*') && !p.includes('+') && !p.includes('.')) {
      let targetClean = rule.target.replace(/^\/+|\/+$/g, '');
      let srcExact = p.replace(/^\^/, '');
      if (srcExact.endsWith('$')) srcExact = srcExact.slice(0, -1);

      // Trailing slash enforcer (e.g. ^kota$ -> /kota/) routes to the page, does not shadow it
      if (srcExact === targetClean) {
        continue;
      }

      let clean = p.replace(/^\^/, '');
      if (clean.endsWith('/?$')) clean = clean.slice(0, -3);
      else if (clean.endsWith('/$')) clean = clean.slice(0, -2);
      else if (clean.endsWith('$')) clean = clean.slice(0, -1);
      clean = clean.replace(/^\/+/, '').replace(/\/+$/, '');

      if (clean) {
        const distFile = path.join('dist', clean, 'index.html');
        if (fs.existsSync(distFile)) {
          countShadowed++;
          shadowedViolations.push({
            pattern: rule.pattern,
            target: rule.target,
            existingDistPath: `/${clean}/`
          });
        }
      }
    }
  }

  // 4. NEW CHECK: Fail on any redirect chain longer than 1 hop or any loop
  const forwardMap = new Map();
  for (const r of rules) {
    if (!r.is301) continue;
    let src = r.pattern.replace(/^\^/, '');
    if (src.endsWith('/?$')) src = src.slice(0, -3);
    else if (src.endsWith('/$')) src = src.slice(0, -2);
    else if (src.endsWith('$')) src = src.slice(0, -1);
    src = src.replace(/^\/+/, '').replace(/\/+$/, '');

    let tgt = r.target.split('?')[0].replace(/^\/+/, '').replace(/\/+$/, '');
    if (src && tgt && !r.pattern.includes('(')) {
      if (src !== tgt) {
        forwardMap.set(src, tgt);
      }
    }
  }

  for (const [src, tgt] of forwardMap.entries()) {
    if (forwardMap.has(tgt)) {
      countChainsOrLoops++;
      chainViolations.push({
        from: src,
        hop: tgt,
        final: forwardMap.get(tgt)
      });
    }
  }

  console.log('\n--- URL PARITY TEST RESULTS ---');
  console.log(`OK (200 in dist): ${countOk}`);
  console.log(`REDIRECTED-OK (301/410 valid): ${countRedirectedOk}`);
  console.log(`UNMAPPED: ${countUnmapped}`);
  console.log(`BROKEN-TARGET: ${countBrokenTarget}`);
  console.log(`SHADOWED-PAGE VIOLATIONS: ${countShadowed}`);
  console.log(`CHAIN/LOOP VIOLATIONS: ${countChainsOrLoops}`);

  let report = `# URL Parity Report\n\n`;
  report += `Generated on: ${new Date().toISOString()}\n\n`;
  report += `## Summary Counts\n\n`;
  report += `- **OK (200 in dist)**: ${countOk}\n`;
  report += `- **REDIRECTED-OK**: ${countRedirectedOk}\n`;
  report += `- **UNMAPPED**: ${countUnmapped}\n`;
  report += `- **BROKEN-TARGET**: ${countBrokenTarget}\n`;
  report += `- **SHADOWED-PAGE VIOLATIONS**: ${countShadowed}\n`;
  report += `- **CHAIN/LOOP VIOLATIONS**: ${countChainsOrLoops}\n\n`;

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

  report += `## SHADOWED-PAGE VIOLATIONS (${shadowedViolations.length})\n\n`;
  if (shadowedViolations.length === 0) {
    report += `None! No redirect rule shadows an existing Astro page.\n\n`;
  } else {
    shadowedViolations.forEach(s => {
      report += `- Rule: \`${s.pattern}\` -> \`${s.target}\` (Shadows existing page \`${s.existingDistPath}\`)\n`;
    });
    report += `\n`;
  }

  report += `## CHAIN / LOOP VIOLATIONS (${chainViolations.length})\n\n`;
  if (chainViolations.length === 0) {
    report += `None! No multi-hop redirect chains or loops.\n\n`;
  } else {
    chainViolations.forEach(c => {
      report += `- Chain: \`${c.from}\` -> \`${c.hop}\` -> \`${c.final}\`\n`;
    });
    report += `\n`;
  }

  fs.writeFileSync(path.join(__dirname, '..', 'URL-PARITY.md'), report, 'utf8');
  console.log(`\nURL-PARITY.md written successfully.`);

  const hasFailures = countUnmapped > 0 || countBrokenTarget > 0 || countShadowed > 0 || countChainsOrLoops > 0;
  if (hasFailures && require.main === module) {
    process.exit(1);
  }

  return { countOk, countRedirectedOk, countUnmapped, countBrokenTarget, countShadowed, countChainsOrLoops };
}

if (require.main === module) {
  runParityTest().catch(err => {
    console.error('Fatal error in url-parity:', err);
    process.exit(1);
  });
}

module.exports = { runParityTest };
