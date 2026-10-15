const fs = require('fs');
const path = require('path');
const crypto = require('crypto');

const distPelatihan = path.join(__dirname, '..', 'dist', 'pelatihan');
const outFile = process.argv[2] || path.join(__dirname, 'out', 'before.json');

if (!fs.existsSync(distPelatihan)) {
  console.error('dist/pelatihan does not exist! Run npm run build first.');
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
    } else if (file === 'index.html') {
      results.push(fullPath);
    }
  }
  return results;
}

const htmlFiles = walk(distPelatihan).sort();

function extractMeta(content) {
  // Title
  const titleMatch = content.match(/<title[^>]*>([\s\S]*?)<\/title>/i);
  const title = titleMatch ? titleMatch[1].trim() : '';

  // Meta description
  const metaDescMatch = content.match(/<meta\s+[^>]*name=["']description["'][^>]*content=["']([^"']*)["']/i) ||
                        content.match(/<meta\s+[^>]*content=["']([^"']*)["'][^>]*name=["']description["']/i);
  const description = metaDescMatch ? metaDescMatch[1].trim() : '';

  // Canonical
  const canonicalMatch = content.match(/<link\s+[^>]*rel=["']canonical["'][^>]*href=["']([^"']*)["']/i) ||
                         content.match(/<link\s+[^>]*href=["']([^"']*)["'][^>]*rel=["']canonical["']/i);
  const canonical = canonicalMatch ? canonicalMatch[1].trim() : '';

  // h1 text
  const h1Match = content.match(/<h1[^>]*>([\s\S]*?)<\/h1>/i);
  let h1Text = '';
  if (h1Match) {
    h1Text = h1Match[1].replace(/<[^>]+>/g, '').trim();
  }

  // count of h2
  const h2Matches = content.match(/<h2[\s>]/gi);
  const h2Count = h2Matches ? h2Matches.length : 0;

  // JSON-LD blocks hash
  const jsonLdBlocks = [];
  const scriptRegex = /<script\s+[^>]*type=["']application\/ld\+json["'][^>]*>([\s\S]*?)<\/script>/gi;
  let match;
  while ((match = scriptRegex.exec(content)) !== null) {
    const raw = match[1].trim();
    // Normalize JSON representation if valid JSON, otherwise hash normalized raw string
    try {
      const parsed = JSON.parse(raw);
      jsonLdBlocks.push(JSON.stringify(parsed));
    } catch (e) {
      jsonLdBlocks.push(raw.replace(/\s+/g, ' '));
    }
  }
  jsonLdBlocks.sort();
  const jsonLdHash = crypto.createHash('sha256').update(jsonLdBlocks.join('|||')).digest('hex');

  return {
    title,
    description,
    canonical,
    h1Text,
    h2Count,
    jsonLdHash
  };
}

const snapshot = {};

for (const file of htmlFiles) {
  const relPath = path.relative(path.join(__dirname, '..'), file).replace(/\\/g, '/');
  const content = fs.readFileSync(file, 'utf8');
  snapshot[relPath] = {
    path: relPath,
    ...extractMeta(content)
  };
}

fs.mkdirSync(path.dirname(outFile), { recursive: true });
fs.writeFileSync(outFile, JSON.stringify(snapshot, null, 2), 'utf8');
console.log(`Snapshot saved to ${outFile} with ${Object.keys(snapshot).length} pages.`);
