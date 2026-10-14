import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const baseDir = path.join(__dirname, '..');
const zhDir = path.join(baseDir, 'src', 'pages', 'zh');
if (!fs.existsSync(zhDir)) {
  fs.mkdirSync(zhDir, { recursive: true });
}

const zhMapping = [
  { file: 'zh.php', slug: 'index', canonical: 'https://wahanatotalita.com/zh/' },
  { file: 'zh-ak3u.php', slug: 'ahli-k3-umum', canonical: 'https://wahanatotalita.com/zh/ahli-k3-umum/' },
  { file: 'zh-accident.php', slug: 'kecelakaan-kerja', canonical: 'https://wahanatotalita.com/zh/kecelakaan-kerja/' },
  { file: 'zh-checklist.php', slug: 'checklist', canonical: 'https://wahanatotalita.com/zh/checklist/' },
  { file: 'zh-factory.php', slug: 'factory-roadmap', canonical: 'https://wahanatotalita.com/zh/factory-roadmap/' },
  { file: 'zh-fire.php', slug: 'k3-kebakaran', canonical: 'https://wahanatotalita.com/zh/k3-kebakaran/' },
  { file: 'zh-inhouse.php', slug: 'in-house-training', canonical: 'https://wahanatotalita.com/zh/in-house-training/' },
  { file: 'zh-kimia.php', slug: 'k3-kimia', canonical: 'https://wahanatotalita.com/zh/k3-kimia/' },
  { file: 'zh-mining.php', slug: 'k3-pertambangan', canonical: 'https://wahanatotalita.com/zh/k3-pertambangan/' },
  { file: 'zh-sio.php', slug: 'sio-alat-berat', canonical: 'https://wahanatotalita.com/zh/sio-alat-berat/' },
  { file: 'zh-smk3.php', slug: 'smk3', canonical: 'https://wahanatotalita.com/zh/smk3/' },
  { file: 'zh-welder.php', slug: 'juru-las', canonical: 'https://wahanatotalita.com/zh/juru-las/' }
];

zhMapping.forEach(({ file, slug, canonical }) => {
  const srcPath = path.join(baseDir, file);
  if (!fs.existsSync(srcPath)) {
    console.log(`Missing file ${file}`);
    return;
  }
  let content = fs.readFileSync(srcPath, 'utf8');

  // Extract title
  let title = '';
  const mTitleTag = content.match(/<title>([\s\S]*?)<\/title>/i);
  if (mTitleTag) {
    title = mTitleTag[1].replace(/<\?.*?\?>/g, '').trim();
  }
  if (!title) {
    const mTitleVar = content.match(/\$page_title\s*=\s*['"]([^'"]+)['"]/);
    if (mTitleVar) title = mTitleVar[1];
  }

  // Extract meta description
  let desc = '';
  const mDescTag = content.match(/<meta\s+name=["']description["']\s+content=["']([\s\S]*?)["']/i);
  if (mDescTag) {
    desc = mDescTag[1].replace(/<\?.*?\?>/g, '').trim();
  }
  if (!desc) {
    const mDescVar = content.match(/\$meta_desc\s*=\s*['"]([^'"]+)['"]/);
    if (mDescVar) desc = mDescVar[1];
  }

  // Extract JSON-LD script tags
  const jsonLdBlocks = [];
  const scriptRegex = /<script type=["']application\/ld\+json["']>([\s\S]*?)<\/script>/gi;
  let match;
  while ((match = scriptRegex.exec(content)) !== null) {
    let raw = match[1].trim();
    raw = raw.replace(/<\?=\s*htmlspecialchars\(\$canonical.*?\)\s*\?>/g, canonical)
             .replace(/<\?=\s*\$canonical\s*\?>/g, canonical)
             .replace(/<\?=\s*SITE_URL\s*\?>/g, 'https://wahanatotalita.com')
             .replace(/<\?php\s*echo\s*SITE_URL\s*;\s*\?>/g, 'https://wahanatotalita.com')
             .replace(/<\?=\s*htmlspecialchars\(\$page_title.*?\)\s*\?>/g, title);
    if (raw) jsonLdBlocks.push(raw);
  }

  // Extract body between header and footer
  // Look for end of </header> and start of <footer class="zh-footer">
  let body = '';
  const headerIdx = content.indexOf('</header>');
  const footerIdx = content.indexOf('<footer class="zh-footer">');
  if (headerIdx !== -1 && footerIdx !== -1) {
    body = content.substring(headerIdx + '</header>'.length, footerIdx).trim();
  } else {
    // Fallback: take content inside <body>
    const bodyMatch = content.match(/<body[^>]*>([\s\S]*?)<\/body>/i);
    body = bodyMatch ? bodyMatch[1].trim() : content;
  }

  // Clean PHP code from body
  const waUrl = "https://wa.me/6287759151278?text=" + encodeURIComponent("您好，我们是在印尼的中资企业，希望咨询安全生产(K3)合规与人员法定持证培训事宜。");
  body = body.replace(/<\?=\s*\$wa_url\s*\?>/g, waUrl);
  body = body.replace(/<\?php\s*echo\s*\$wa_url;\s*\?>/g, waUrl);
  body = body.replace(/<\?=\s*SITE_URL\s*\?>/g, 'https://wahanatotalita.com');
  body = body.replace(/<\?php\s*echo\s*SITE_URL;\s*\?>/g, 'https://wahanatotalita.com');
  body = body.replace(/<\?php[\s\S]*?\?>/g, '');
  body = body.replace(/<\?=[\s\S]*?\?>/g, '');

  // Add is:inline to any inline script in body
  body = body.replace(/<script(?![^>]*is:inline)/gi, '<script is:inline');

  let schemasCode = '[\n';
  jsonLdBlocks.forEach(j => {
    schemasCode += `    ${j},\n`;
  });
  schemasCode += '  ]';

  const astroOutput = `---
import ZhLayout from '../../layouts/ZhLayout.astro';

const pageTitle = ${JSON.stringify(title)};
const metaDesc = ${JSON.stringify(desc)};
const canonical = ${JSON.stringify(canonical)};

const schemas = ${schemasCode};
---

<ZhLayout
  title={pageTitle}
  description={metaDesc}
  canonical={canonical}
  schemas={schemas}
>
${body}
</ZhLayout>
`;

  const destPath = path.join(zhDir, `${slug}.astro`);
  fs.writeFileSync(destPath, astroOutput, 'utf8');
  console.log(`Generated: ${destPath}`);
});

console.log('Done converting Chinese pages!');
