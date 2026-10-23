import fs from 'node:fs';
import sharp from 'sharp';

// Edit the existing flattened posters; never regenerate their photographs.
const courses = JSON.parse(fs.readFileSync('data/trainings.json', 'utf8')).filter(t => t.is_active !== 0);
const originals = JSON.parse(fs.readFileSync('src/lib/course-posters.json', 'utf8'));
const directory = 'public/images/jadwal/program';
fs.mkdirSync(directory + '/og', { recursive: true });
fs.mkdirSync('output/jadwal-posters', { recursive: true });
const manifest = {};
const report = [];
const ribbon = Buffer.from(`<svg width="1822" height="662" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="red" x2="0" y2="1"><stop stop-color="#941c29"/><stop offset="1" stop-color="#64101a"/></linearGradient></defs><path d="M70 20 H775 L723 88 H25 Z" fill="url(#red)"/><text x="400" y="70" text-anchor="middle" font-family="Arial, sans-serif" font-style="italic" font-weight="900" font-size="51" letter-spacing="3" fill="white">JADWAL</text></svg>`);

for (const course of courses) {
  const source = originals[course.slug];
  if (!source) throw new Error(`Missing original poster: ${course.slug}`);
  const { data, info } = await sharp('public' + source.image).resize(1822, 662).removeAlpha().raw().toBuffer({ resolveWithObject: true });
  // Restrict the red adjustment to graphic areas on the left and bottom border.
  // Keep the photographic portion, including red PPE, untouched.
  for (let y = 0; y < info.height; y++) {
    for (let x = 0; x < info.width; x++) {
      const graphicArea = x < 1040 - y * 0.34 || y > 625 || (y > 600 && x < 1100);
      if (!graphicArea) continue;
      const i = (y * info.width + x) * info.channels;
      const [r, g, b] = [data[i], data[i + 1], data[i + 2]];
      if (r > 65 && r > g * 1.5 && r > b * 1.35) {
        data[i] = Math.round(r * 0.66);
        data[i + 1] = Math.round(g * 0.8);
        data[i + 2] = Math.min(255, Math.round(b * 0.85 + 7));
      }
    }
  }
  const edited = await sharp(data, { raw: info }).composite([{ input: ribbon }]).png().toBuffer();
  for (const width of [1822, 1200, 640]) {
    await sharp(edited).resize(width).webp({ quality: 90 }).toFile(`${directory}/${course.slug}${width === 1822 ? '' : '-' + width}.webp`);
  }
  await sharp(edited).resize(1200, 630, { fit: 'contain', background: '#f1f2f3' }).webp({ quality: 90 }).toFile(`${directory}/og/${course.slug}.webp`);
  const prefix = '/images/jadwal/program/' + course.slug;
  manifest[course.slug] = {
    image: prefix + '.webp', image1200: prefix + '-1200.webp', image640: prefix + '-640.webp',
    ogImage: '/images/jadwal/program/og/' + course.slug + '.webp',
    alt: `Jadwal ${course.name}, sertifikasi ${course.certification || 'sesuai program'}. Poster program dengan informasi biaya dan metode pelatihan.`,
  };
  report.push({ slug: course.slug, source: source.image, image: manifest[course.slug].image, width: 1822, height: 662 });
}
fs.writeFileSync('src/lib/jadwal-posters.json', JSON.stringify(manifest, null, 2) + '\n');
fs.writeFileSync('output/jadwal-posters/verification.json', JSON.stringify(report, null, 2));
const escape = value => String(value).replaceAll('&', '&amp;').replaceAll('<', '&lt;').replaceAll('"', '&quot;');
fs.writeFileSync('output/jadwal-posters/index.html', `<!doctype html><html lang="id"><meta charset="utf-8"><title>Jadwal — poster review</title><style>body{font:16px Arial;background:#eee;margin:24px}main{display:grid;grid-template-columns:1fr 1fr;gap:20px}figure{margin:0;background:white;padding:12px}img{width:100%;height:auto}@media(max-width:800px){main{grid-template-columns:1fr}}</style><h1>${report.length} poster jadwal</h1><main>${courses.map(c => `<figure><figcaption>${escape(c.name)}</figcaption><img loading="lazy" src="../../public${manifest[c.slug].image}" alt="${escape(manifest[c.slug].alt)}"></figure>`).join('')}</main></html>`);
console.log(`Created ${report.length} schedule posters with responsive and social variants.`);
