import fs from 'fs';
import path from 'path';

const dir = './pelatihan-data';
const files = fs.readdirSync(dir).filter(f => f.endsWith('.json'));
const missing = new Set();
const found = new Set();

for (const f of files) {
  const content = JSON.parse(fs.readFileSync(path.join(dir, f), 'utf8'));
  const html = content.content || '';
  const regex = /src="([^"]+)"/g;
  let match;
  while ((match = regex.exec(html)) !== null) {
    let src = decodeURIComponent(match[1]);
    if (src.startsWith('/')) {
      const pubPath = path.join('./public', src.slice(1));
      if (!fs.existsSync(pubPath)) {
        missing.add(match[1]);
      } else {
        found.add(match[1]);
      }
    }
  }
}

console.log('Valid image files in 352 programmatic pages:', found.size);
console.log('Missing image files:', missing.size);
if (missing.size > 0) {
  console.log('List of missing images:');
  for (const m of missing) console.log('  -', m);
}
