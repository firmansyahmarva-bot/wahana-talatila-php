import fs from 'fs';
import path from 'path';

console.log('=== STARTING DEEP SEO AUDIT ===\n');

const pagesDir = path.join(process.cwd(), 'data', 'pages');
const indexPath = path.join(process.cwd(), 'data', 'pages_index.json');
const index = JSON.parse(fs.readFileSync(indexPath, 'utf8'));
const files = fs.readdirSync(pagesDir);

const issues = {
  phpLinks: [],
  httpLinks: [],
  missingH1: [],
  multipleH1: [],
  missingAltImages: 0,
  canonicalMismatch: [],
  shortDescriptions: [],
  duplicateTitles: {},
  missingOgImage: 0,
};

const titleMap = {};

for (const file of files) {
  const filePath = path.join(pagesDir, file);
  const data = JSON.parse(fs.readFileSync(filePath, 'utf8'));
  const html = data.body_html || '';

  // 1. Check for legacy .php links in content
  const phpMatches = html.match(/href=["'][^"']*\.php[^"']*["']/gi);
  if (phpMatches) {
    issues.phpLinks.push({ file, path: data.path, matches: phpMatches.slice(0, 3) });
  }

  // 2. Check for insecure http://wahanatotalita.com links
  const httpMatches = html.match(/href=["']http:\/\/wahanatotalita\.com[^"']*["']/gi);
  if (httpMatches) {
    issues.httpLinks.push({ file, path: data.path, matches: httpMatches.slice(0, 2) });
  }

  // 3. H1 headings check
  const h1Matches = html.match(/<h1[^>]*>[\s\S]*?<\/h1>/gi);
  if (!h1Matches || h1Matches.length === 0) {
    // Check if it's the home page (handled by React)
    if (data.id !== 'index') {
      issues.missingH1.push({ file, path: data.path });
    }
  } else if (h1Matches.length > 1) {
    issues.multipleH1.push({ file, path: data.path, count: h1Matches.length });
  }

  // 4. Images missing alt attribute
  const imgMatches = html.match(/<img[^>]+>/gi) || [];
  for (const img of imgMatches) {
    if (!img.includes('alt=') || img.includes('alt=""') || img.includes("alt=''")) {
      issues.missingAltImages++;
    }
  }

  // 5. Canonical trailing slash check
  if (data.canonical) {
    const isRoot = data.canonical === 'https://wahanatotalita.com/' || data.canonical === 'https://wahanatotalita.com';
    if (!isRoot && !data.canonical.endsWith('/')) {
      issues.canonicalMismatch.push({ path: data.path, canonical: data.canonical });
    }
  }

  // 6. Meta description quality
  if (!data.description || data.description.length < 50) {
    issues.shortDescriptions.push({ path: data.path, len: data.description?.length || 0 });
  }

  // 7. Duplicate titles
  if (data.title) {
    titleMap[data.title] = (titleMap[data.title] || 0) + 1;
  }
}

for (const [title, count] of Object.entries(titleMap)) {
  if (count > 1) {
    issues.duplicateTitles[title] = count;
  }
}

console.log('1. Legacy .php Links inside page bodies:');
console.log(`   Found in ${issues.phpLinks.length} pages.`);
if (issues.phpLinks.length > 0) {
  console.log('   Sample:', JSON.stringify(issues.phpLinks.slice(0, 3), null, 2));
}

console.log('\n2. Insecure http:// internal links:');
console.log(`   Found in ${issues.httpLinks.length} pages.`);
if (issues.httpLinks.length > 0) {
  console.log('   Sample:', JSON.stringify(issues.httpLinks.slice(0, 3), null, 2));
}

console.log('\n3. Canonical Trailing Slash Mismatches:');
console.log(`   Found in ${issues.canonicalMismatch.length} pages:`);
console.log(JSON.stringify(issues.canonicalMismatch, null, 2));

console.log('\n4. Heading Structure:');
console.log(`   Pages missing <h1>: ${issues.missingH1.length}`);
console.log(`   Pages with multiple <h1>: ${issues.multipleH1.length}`);
if (issues.missingH1.length > 0) {
  console.log('   Sample missing <h1>:', JSON.stringify(issues.missingH1.slice(0, 3), null, 2));
}

console.log('\n5. Images without descriptive alt attribute:');
console.log(`   Found: ${issues.missingAltImages} images.`);

console.log('\n6. Meta Descriptions:');
console.log(`   Pages with short (<50 chars) or missing description: ${issues.shortDescriptions.length}`);

console.log('\n7. Duplicate Titles across routes:');
const dupCount = Object.keys(issues.duplicateTitles).length;
console.log(`   Found ${dupCount} duplicate titles affecting multiple routes.`);
if (dupCount > 0) {
  console.log('   Top duplicate titles:');
  const topDups = Object.entries(issues.duplicateTitles)
    .sort((a, b) => b[1] - a[1])
    .slice(0, 5);
  topDups.forEach(([t, c]) => console.log(`   - "${t.slice(0, 70)}..." (${c} pages)`));
}
