const fs = require('fs');
const path = require('path');

function parseHtaccess(htaccessPath) {
  const content = fs.readFileSync(htaccessPath, 'utf8');
  const lines = content.split('\n');
  const rules = [];

  let currentConds = [];

  for (let i = 0; i < lines.length; i++) {
    const line = lines[i].trim();
    if (!line || line.startsWith('#')) continue;

    const cm = line.match(/^RewriteCond\s+(\S+)\s+(\S+)(?:\s+\[(.*)\])?$/);
    if (cm) {
      currentConds.push({ test: cm[1], pattern: cm[2], flags: cm[3] });
      continue;
    }

    const rm = line.match(/^RewriteRule\s+(\S+)\s+(\S+)(?:\s+\[(.*)\])?$/);
    if (rm) {
      const pattern = rm[1];
      const target = rm[2];
      const flags = (rm[3] || '').split(',').map(f => f.trim().toUpperCase());

      const is301 = flags.some(f => f === 'R=301' || f.startsWith('R=301') || f === 'R');
      const isGone = flags.some(f => f === 'G');

      rules.push({
        conds: currentConds,
        pattern,
        regex: new RegExp(pattern),
        target,
        is301,
        isGone,
        raw: line
      });
      currentConds = [];
    }
  }

  return rules;
}

function evaluate(rules, url) {
  let u = url.trim();
  let host = 'wahanatotalita.com';
  let isHttps = true;
  if (u.startsWith('http://')) {
    isHttps = false;
    u = u.replace('http://', '');
    host = u.split('/')[0];
    u = u.slice(host.length);
  } else if (u.startsWith('https://')) {
    u = u.replace('https://', '');
    host = u.split('/')[0];
    u = u.slice(host.length);
  }

  const queryPart = u.includes('?') ? u.split('?')[1] : '';
  let cleanPath = u.split('?')[0].split('#')[0];
  if (cleanPath.startsWith('/')) cleanPath = cleanPath.slice(1);

  // Check rewrite rules
  for (const rule of rules) {
    let condsPass = true;
    for (const cond of rule.conds) {
      if (cond.test === '%{HTTPS}') {
        const wantsOff = /off/i.test(cond.pattern);
        if (wantsOff && isHttps) condsPass = false;
        if (!wantsOff && !isHttps) condsPass = false;
      } else if (cond.test === '%{HTTP_HOST}') {
        // Test host against pattern regex
        const hostRegex = new RegExp(cond.pattern, 'i');
        if (!hostRegex.test(host)) condsPass = false;
      } else if (cond.test === '%{QUERY_STRING}') {
        const condRegex = new RegExp(cond.pattern.replace(/\\\$/g, '$'), 'i');
        if (!condRegex.test(queryPart)) condsPass = false;
      } else if (cond.test === '%{REQUEST_URI}') {
        const uriRegex = new RegExp(cond.pattern, 'i');
        if (!uriRegex.test('/' + cleanPath)) condsPass = false;
      }
    }

    if (!condsPass) continue;

    if (rule.regex.test(cleanPath)) {
      if (rule.isGone) {
        return { status: 410, location: null };
      }
      if (rule.is301) {
        let dest = rule.target;
        // Host canonicalization dynamic replacements
        if (dest.includes('%{HTTP_HOST}')) {
          dest = dest.replace('%{HTTP_HOST}', host);
        }
        if (dest.includes('%{REQUEST_URI}')) {
          dest = dest.replace('%{REQUEST_URI}', '/' + cleanPath);
        }
        if (dest.includes('%1')) {
          const hostMatch = host.match(/^www\.(.+)$/i);
          if (hostMatch) dest = dest.replace('%1', hostMatch[1]);
        }
        const match = cleanPath.match(rule.regex);
        if (match) {
          for (let g = 1; g < match.length; g++) {
            dest = dest.replace(new RegExp('\\$' + g, 'g'), match[g]);
          }
        }
        // Normalize double slash if any
        dest = dest.replace(/([^:])\/\/+/g, '$1/');
        return { status: 301, location: dest };
      }
    }
  }

  // Check if file exists in dist
  let distPath = cleanPath === '' ? 'dist/index.html' : path.join('dist', cleanPath);
  if (fs.existsSync(distPath) && fs.statSync(distPath).isFile()) {
    return { status: 200, location: null };
  }
  if (fs.existsSync(path.join('dist', cleanPath, 'index.html'))) {
    return { status: 200, location: null };
  }

  return { status: 404, location: '/404.html' };
}

const testSamples = [
  // 1. Host canonicalization (www)
  { url: 'http://www.wahanatotalita.com/', expectStatus: 301, expectDest: 'https://www.wahanatotalita.com/' },
  // 2. Host canonicalization (origen)
  { url: 'https://origen.wahanatotalita.com/pelatihan/', expectStatus: 301, expectDest: 'https://wahanatotalita.com/pelatihan/' },
  // 3. HTTP to HTTPS
  { url: 'http://wahanatotalita.com/kontak', expectStatus: 301, expectDest: 'https://wahanatotalita.com/kontak' },
  // 4. Joomla id=5
  { url: '/index.php?option=com_content&view=article&id=5', expectStatus: 301, expectDest: '/perusahaan/?' },
  // 5. Joomla id=8
  { url: '/index.php?option=com_content&view=article&id=8', expectStatus: 301, expectDest: '/klien/?' },
  // 6. Joomla other id -> 410
  { url: '/index.php?option=com_content&view=article&id=999', expectStatus: 410 },
  // 7. WordPress probe
  { url: '/wp-login.php', expectStatus: 301, expectDest: '/' },
  // 8. Specific old URL
  { url: '/news/dasar-hukum-keselamatan-dan-kesehatan-kerja.html', expectStatus: 301, expectDest: '/artikel/dasar-hukum-keselamatan-dan-kesehatan-kerja/' },
  // 9. Legacy /news/ 410
  { url: '/news/some-random-obsolete-article', expectStatus: 410 },
  // 10. Slashless /in-house-training
  { url: '/in-house-training', expectStatus: 301, expectDest: '/in-house-training/' },
  // 11. Slashless city /pelatihan-k3-jakarta
  { url: '/pelatihan-k3-jakarta', expectStatus: 301, expectDest: '/pelatihan-k3-jakarta/' },
  // 12. In-house folder redirect (/in-house/ -> /in-house-training/)
  { url: '/in-house/balikpapan-ikn/', expectStatus: 301, expectDest: '/in-house-training/balikpapan-ikn/' },
  // 13. Split sitemap redirect
  { url: '/sitemap-core.xml', expectStatus: 301, expectDest: '/sitemap.xml' },
  // 14. Forklift permutation
  { url: '/pelatihan/operator-forklift-kelas-2-balikpapan.html', expectStatus: 301, expectDest: '/pelatihan/pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri/' },
  // 15. Ahli K3 Umum permutation
  { url: '/pelatihan/ahli-k3-umum-surabaya.html', expectStatus: 301, expectDest: '/pelatihan/ak3-bnsp/' },
  // 16. Legacy Course Map
  { url: '/pelatihan/pelatihan-auditor-smk3-kemnaker-ri-online', expectStatus: 301, expectDest: '/pelatihan/pelatihan-auditor-sistem-manajemen-k3-sertifikasi-kemnaker-ri/' },
  // 17. 404 exact match (/kontak)
  { url: '/kontak', expectStatus: 301, expectDest: '/perusahaan/' },
  // 18. 404 exact match (/pelatihan-k3)
  { url: '/pelatihan-k3', expectStatus: 301, expectDest: '/pelatihan/' },
  // 19. 404 exact match (/refreshing-k3)
  { url: '/refreshing-k3', expectStatus: 301, expectDest: '/perpanjangan-skp/' },
  // 20. Substring city rule (crane)
  { url: '/pelatihan/operator-crane-kelas-3-ambon.html', expectStatus: 301, expectDest: '/pelatihan/pelatihan-k3-operator-crane-kelas-3-sertifikasi-kemnaker-ri/' },
  // 21. training_redirects.json entry
  { url: '/pelatihan/pelatihan-teknis-pertek-limbah-b3-dan-emisi-udara-sertifikasi-bnsp-1/', expectStatus: 301, expectDest: '/pelatihan/pelatihan-teknis-pertek-limbah-b3-dan-emisi-udara-sertifikasi-bnsp/' },
  // 22. Astro page (homepage)
  { url: '/', expectStatus: 200 },
  // 23. Astro page (/pelatihan/)
  { url: '/pelatihan/', expectStatus: 200 },
  // 24. Astro page (/zh/)
  { url: '/zh/', expectStatus: 200 },
  // 25. Missing page showing static 404
  { url: '/completely-nonexistent-page-xyz', expectStatus: 404, expectDest: '/404.html' }
];

function runTests() {
  const htaccessPath = path.join(__dirname, '..', 'public', '.htaccess');
  const rules = parseHtaccess(htaccessPath);

  console.log(`Running sample evaluations against public/.htaccess (${testSamples.length} URLs)...\n`);
  let passed = 0;

  testSamples.forEach((s, idx) => {
    const res = evaluate(rules, s.url);
    const statusMatch = res.status === s.expectStatus;
    const destMatch = !s.expectDest || res.location === s.expectDest;

    if (statusMatch && destMatch) {
      console.log(`[PASS] Sample #${idx + 1}: ${s.url} => ${res.status}${res.location ? ' -> ' + res.location : ''}`);
      passed++;
    } else {
      console.error(`[FAIL] Sample #${idx + 1}: ${s.url}`);
      console.error(`       Expected: ${s.expectStatus} ${s.expectDest || ''}`);
      console.error(`       Actual:   ${res.status} ${res.location || ''}`);
    }
  });

  console.log(`\nEvaluation Summary: ${passed}/${testSamples.length} passed.`);
  if (passed !== testSamples.length) process.exit(1);
}

runTests();
