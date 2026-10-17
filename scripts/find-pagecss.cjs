const fs = require('fs');
const path = require('path');
const distDir = 'd:/wahana-transform/temp-ca82039/dist';

function walk(dir) {
  let results = [];
  const list = fs.readdirSync(dir);
  for (const file of list) {
    const fullPath = path.join(dir, file);
    const stat = fs.statSync(fullPath);
    if (stat && stat.isDirectory()) results = results.concat(walk(fullPath));
    else if (file.endsWith('.html')) results.push(fullPath);
  }
  return results;
}

const files = walk(distDir);
console.log('Total HTML files:', files.length);

const cssMap = new Map();
for (const file of files) {
  const content = fs.readFileSync(file, 'utf8');
  const hasBreadcrumb = content.includes('breadcrumb') || content.includes('Breadcrumb');
  const hasFaq = content.includes('faq') || content.includes('FAQ') || content.includes('<details');
  if (!hasBreadcrumb && !hasFaq) continue;

  const cssMatches = [...content.matchAll(/<link[^>]+rel=["']stylesheet["'][^>]+href=["']([^"']+)["']/gi)].map(m => m[1]);
  const cssKey = cssMatches.sort().join('|');
  let url = file.substring(distDir.length).replace(/\\/g, '/');
  if (url.endsWith('/index.html')) url = url.slice(0, -10) || '/';
  else if (url.endsWith('index.html')) url = url.slice(0, -10) || '/';

  if (!cssMap.has(cssKey)) {
    cssMap.set(cssKey, { url, hasBreadcrumb, hasFaq, cssMatches });
  }
}

console.log('Distinct combinations count:', cssMap.size);
for (const [key, val] of cssMap.entries()) {
  console.log(val.url);
}
