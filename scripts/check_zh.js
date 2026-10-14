import fs from 'fs';

const files = fs.readdirSync('.').filter(f => f.startsWith('zh') && f.endsWith('.php'));
files.forEach(f => {
  const c = fs.readFileSync(f, 'utf8');
  const can = c.match(/\$canonical\s*=\s*(.*?);/);
  const tit = c.match(/\$page_title\s*=\s*['"]([^'"]+)['"]/);
  console.log(f, '=>', can ? can[1] : 'NO CANONICAL', '| Title:', tit ? tit[1].slice(0, 30) : 'NO TITLE');
});
