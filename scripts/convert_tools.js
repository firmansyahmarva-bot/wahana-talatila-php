import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const toolsDir = path.join(__dirname, '..', 'tools');
const pagesDir = path.join(__dirname, '..', 'src', 'pages', 'tools');
if (!fs.existsSync(pagesDir)) {
  fs.mkdirSync(pagesDir, { recursive: true });
}

const phpFiles = fs.readdirSync(toolsDir).filter(f => f.endsWith('.php') && f !== 'index.php');

phpFiles.forEach(phpFile => {
  const slug = phpFile.replace('.php', '');
  const targetAstro = path.join(pagesDir, `${slug}.astro`);
  
  let content = fs.readFileSync(path.join(toolsDir, phpFile), 'utf8');

  // Extract page_title
  const mTitle = content.match(/\$page_title\s*=\s*['"]([^'"]+)['"]/);
  const pageTitle = mTitle ? mTitle[1] : `${slug.replace(/-/g, ' ').replace(/\b\w/g, l => l.toUpperCase())} - Tools K3`;

  // Extract meta_desc
  const mDesc = content.match(/\$meta_desc\s*=\s*['"]([^'"]+)['"]/);
  const metaDesc = mDesc ? mDesc[1] : '';

  // Extract page_css
  const mCss = content.match(/\[\s*['"]([^'"]+)['"]\s*\]\s*\);/);
  const cssName = mCss ? mCss[1] : `tools-${slug}`;
  const pageCss = `/assets/css/page/${cssName}.css`;

  // Extract JSON-LD script tags
  const jsonLdBlocks = [];
  const scriptRegex = /<script type="application\/ld\+json">([\s\S]*?)<\/script>/gi;
  let match;
  while ((match = scriptRegex.exec(content)) !== null) {
    const raw = match[1].trim();
    if (raw) {
      jsonLdBlocks.push(raw.replace(/<\?=\s*SITE_URL\s*\?>/g, 'https://wahanatotalita.com').replace(/<\?php\s*echo\s*SITE_URL\s*;\s*\?>/g, 'https://wahanatotalita.com'));
    }
  }

  // Extract body content: remove php headers and includes
  let body = content;
  // Remove top PHP block up to after navbar include
  body = body.replace(/^<\?php[\s\S]*?(?:require.*?navbar\.php['"]\s*;\s*\?>|ob_get_clean[\s\S]*?\?>)/i, '');
  // Remove stray navbar include
  body = body.replace(/<\?php\s*require.*?navbar\.php.*?;\s*\?>/gi, '');
  // Remove footer & script includes at bottom
  body = body.replace(/<\?php\s*require.*?footer\.php.*?;\s*\?>[\s\S]*/i, '');
  body = body.replace(/<\?php\s*require.*?scripts\.php.*?;\s*\?>[\s\S]*/i, '');
  body = body.replace(/<\/body>\s*<\/html>/gi, '');
  // Remove JSON-LD scripts from body
  body = body.replace(/<script type="application\/ld\+json">[\s\S]*?<\/script>/gi, '');
  // Remove remaining PHP tags
  body = body.replace(/<\?=(.*?)\?>/g, '{$1}');
  body = body.replace(/<\?php\s*echo\s*(.*?);\s*\?>/g, '{$1}');
  body = body.replace(/<\?php[\s\S]*?\?>/g, '');

  // Add is:inline to all remaining <script> tags
  body = body.replace(/<script(?![^>]*is:inline)/gi, '<script is:inline');

  let schemasCode = '[\n';
  jsonLdBlocks.forEach(j => {
    schemasCode += `    ${j},\n`;
  });
  schemasCode += '  ]';

  const astroOutput = `---
import Layout from '../../layouts/Layout.astro';

const pageTitle = ${JSON.stringify(pageTitle)};
const metaDesc = ${JSON.stringify(metaDesc)};
const canonical = "https://wahanatotalita.com/tools/${slug}/";

const schemas = ${schemasCode};
---

<Layout
  title={pageTitle}
  description={metaDesc}
  canonical={canonical}
  schemas={schemas}
  pageCss={['${pageCss}']}
>
${body.trim()}
</Layout>
`;

  fs.writeFileSync(targetAstro, astroOutput, 'utf8');
  console.log(`Generated: ${targetAstro}`);
});

console.log('Done converting all tools!');
