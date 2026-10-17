const fs = require('fs');
const path = require('path');

const tools = [
  'apd-selector',
  'ibpr-generator',
  'jsa-builder',
  'kalkulator-biaya-k3',
  'kalkulator-k3',
  'kalkulator-kebisingan',
  'laporan-insiden',
  'regulasi-k3',
  'risk-matrix',
  'safety-talk',
  'social-generator'
];

for (const t of tools) {
  const filePath = path.join(__dirname, '..', 'src', 'pages', 'tools', `${t}.astro`);
  let content = fs.readFileSync(filePath, 'utf8');

  const openTag = t === 'safety-talk' ? '<div class="st-faq-grid">' : '<div class="faq-box">';
  const divStart = content.indexOf(openTag);
  if (divStart === -1) {
    console.error(`Marker not found for ${t}`);
    continue;
  }

  let depth = 0;
  let endIdx = -1;
  const tagRegex = /<\/?div\b[^>]*>/gi;
  tagRegex.lastIndex = divStart;
  let match;
  while ((match = tagRegex.exec(content)) !== null) {
    if (match[0].startsWith('</')) {
      depth--;
      if (depth === 0) {
        endIdx = tagRegex.lastIndex;
        break;
      }
    } else {
      depth++;
    }
  }

  if (endIdx === -1) {
    console.error(`Could not balance div for ${t}`);
    continue;
  }

  const fullBox = content.substring(divStart, endIdx);
  let items = [];

  if (t === 'safety-talk') {
    const cardRegex = /<div class="st-faq-card">\s*<h3>([\s\S]*?)<\/h3>\s*<p>([\s\S]*?)<\/p>\s*<\/div>/gi;
    let cardMatch;
    while ((cardMatch = cardRegex.exec(fullBox)) !== null) {
      items.push({
        q: cardMatch[1].trim(),
        a: cardMatch[2].trim()
      });
    }
  } else {
    const itemRegex = /<div class="faq-item">\s*<button[^>]*>[\s\S]*?<span>([\s\S]*?)<\/span>[\s\S]*?<\/button>\s*<div class="faq-a">([\s\S]*?)<\/div>\s*<\/div>/gi;
    let itemMatch;
    while ((itemMatch = itemRegex.exec(fullBox)) !== null) {
      items.push({
        q: itemMatch[1].trim(),
        a: itemMatch[2].trim()
      });
    }
  }

  console.log(`Tool: ${t}, found ${items.length} items. Box len: ${fullBox.length}`);

  // 1. Replace fullBox in content
  const replacementComponent = t === 'safety-talk'
    ? '<Faq items={toolFaqs} variant="tool" icon="" />'
    : '<Faq items={toolFaqs} variant="tool" />';
  content = content.replace(fullBox, replacementComponent);

  // 2. Add import and toolFaqs to frontmatter using split('---')
  const parts = content.split('---');
  if (parts.length >= 3) {
    let fm = parts[1];
    if (!fm.includes("import Faq from '../../components/Faq.astro';")) {
      fm = fm.replace(/(import Layout from '[^']+';)/, "$1\nimport Faq from '../../components/Faq.astro';");
    }
    const faqsCode = `\nconst toolFaqs = ${JSON.stringify(items, null, 2)};\n`;
    fm = fm + faqsCode;
    parts[1] = fm;
    content = parts.join('---');
  }

  // 3. Remove toggleFaq script if present
  content = content.replace(/\s*function toggleFaq\(btn\) \{[\s\S]*?\}\s*/, '\n');

  fs.writeFileSync(filePath, content, 'utf8');
}

// Also tools/index.astro
const idxPath = path.join(__dirname, '..', 'src', 'pages', 'tools', 'index.astro');
let idxContent = fs.readFileSync(idxPath, 'utf8');

const idxOpenTag = '<div class="faq-box">';
const idxDivStart = idxContent.indexOf(idxOpenTag);
if (idxDivStart !== -1) {
  let depth = 0;
  let endIdx = -1;
  const tagRegex = /<\/?div\b[^>]*>/gi;
  tagRegex.lastIndex = idxDivStart;
  let match;
  while ((match = tagRegex.exec(idxContent)) !== null) {
    if (match[0].startsWith('</')) {
      depth--;
      if (depth === 0) {
        endIdx = tagRegex.lastIndex;
        break;
      }
    } else {
      depth++;
    }
  }
  const fullBox = idxContent.substring(idxDivStart, endIdx);
  const toolFaqsCode = `\nconst toolFaqs = [\n  {\n    q: 'Apakah seluruh tools dan kalkulator K3 di situs ini gratis?',\n    a: 'Ya, 100% gratis dan dapat digunakan secara bebas oleh praktisi HSE, Ahli K3 Umum, mahasiswa, dan manajemen perusahaan di seluruh Indonesia tanpa perlu registrasi.'\n  },\n  {\n    q: 'Apakah hasil perhitungan kalkulator K3 sesuai dengan standar regulasi pemerintah?',\n    a: 'Seluruh formula perhitungan dan dokumen yang dihasilkan mengacu langsung pada peraturan perundang-undangan resmi Republik Indonesia, seperti Kepmenaker No. KEP.372/MEN/1989, Permenaker No. 5 Tahun 2018, Permenaker No. 03/MEN/1998, dan PP No. 50 Tahun 2012 tentang Penerapan SMK3.'\n  }\n];\n`;

  idxContent = idxContent.replace(fullBox, '<Faq items={toolFaqs} icon="" />');
  const parts = idxContent.split('---');
  if (parts.length >= 3) {
    let fm = parts[1];
    if (!fm.includes("import Faq from '../../components/Faq.astro';")) {
      fm = fm.replace(/(import Layout from '[^']+';)/, "$1\nimport Faq from '../../components/Faq.astro';");
    }
    fm = fm + toolFaqsCode;
    parts[1] = fm;
    idxContent = parts.join('---');
  }
  fs.writeFileSync(idxPath, idxContent, 'utf8');
  console.log('Successfully migrated tools/index.astro');
}
