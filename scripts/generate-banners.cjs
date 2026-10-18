// scripts/generate-banners.cjs
// Playwright-based banner renderer for all active pelatihan courses.
// Usage:
//   node scripts/generate-banners.cjs              -- generate all, skip existing
//   node scripts/generate-banners.cjs --force      -- overwrite all
//   node scripts/generate-banners.cjs --only <slug>
//   node scripts/generate-banners.cjs --render-only  (skip photo download)
//   node scripts/generate-banners.cjs --photos-only  (future: only gen photos)
'use strict';

const fs = require('fs');
const path = require('path');
const { chromium } = require('playwright');

// ── Paths ──────────────────────────────────────────────────────────────────
const ROOT = path.join(__dirname, '..');
const TRAININGS_DIR = path.join(ROOT, 'data', 'trainings');
const PHOTOS_DIR = path.join(__dirname, 'banner-photos');
const SCENES_FILE = path.join(__dirname, 'banner-scenes.json');
const TEMPLATE = path.join(__dirname, 'banner-template.html');
const OUT_DIR = path.join(ROOT, 'public', 'images', 'pelatihan');
const OG_DIR = path.join(OUT_DIR, 'og');

// ── CLI flags ──────────────────────────────────────────────────────────────
const args = process.argv.slice(2);
const FORCE = args.includes('--force');
const RENDER_ONLY = args.includes('--render-only');
const PHOTOS_ONLY = args.includes('--photos-only');
const ONLY_IDX = args.indexOf('--only');
const ONLY_SLUG = ONLY_IDX >= 0 ? args[ONLY_IDX + 1] : null;

// ── Ensure output dirs ─────────────────────────────────────────────────────
[OUT_DIR, OG_DIR, PHOTOS_DIR].forEach(d => fs.mkdirSync(d, { recursive: true }));

// ── Helpers ────────────────────────────────────────────────────────────────
function formatPrice(price) {
  if (!price) return 'Hubungi Kami';
  const num = typeof price === 'string' ? parseInt(price, 10) : price;
  if (isNaN(num) || num <= 0) return 'Hubungi Kami';
  return 'Rp ' + num.toLocaleString('id-ID');
}

/** Derive cert short label: 'BNSP' | 'Kemnaker RI' | 'Lainnya' */
function deriveCert(certification) {
  if (!certification) return 'BNSP';
  const c = certification.toLowerCase();
  if (c.includes('kemnaker')) return 'Kemnaker RI';
  if (c.includes('bnsp')) return 'BNSP';
  return 'Lainnya';
}

/** Derive line3 from certification */
function deriveLine3(certification) {
  if (!certification) return 'Bersertifikat BNSP';
  const c = certification.toLowerCase();
  if (c.includes('kemnaker')) return 'Sertifikasi Kemnaker RI';
  if (c.includes('bnsp')) return 'Bersertifikat BNSP';
  return certification.replace(/^sertifikasi\s*/i, 'Bersertifikat ');
}

/** Shorten a name to the core course topic, stripping standard prefixes/suffixes */
const STRIP_PREFIXES = [
  /^pelatihan\s+(dan\s+)?sertifikasi\s+/i,
  /^pelatihan\s+(&\s+)?sertifikasi\s+/i,
  /^sertifikasi\s+/i,
  /^pelatihan\s+/i,
  /^layanan\s+/i,
  /^training\s+/i,
];
const STRIP_SUFFIXES = [
  /\s+sertifikasi\s+bnsp(\s+online)?$/i,
  /\s+sertifikasi\s+kemnaker\s+ri$/i,
  /\s+bersertifikat\s+bnsp$/i,
  /\s+sertifikasi\s+resmi$/i,
  /\s+online(\s+bersertifikat\s+bnsp)?$/i,
  /\s+offline$/i,
  /\s+reguler$/i,
  /\s+kemnaker\s+ri$/i,
  /\s+bnsp$/i,
  /\s+\(rcc\s*\/.*?\)$/i,
];

function extractCoreName(name) {
  let s = name.trim();
  for (const re of STRIP_PREFIXES) { s = s.replace(re, ''); if (s !== name.trim()) break; }
  // Apply suffix strips iteratively
  let changed = true;
  while (changed) {
    changed = false;
    for (const re of STRIP_SUFFIXES) {
      const next = s.replace(re, '').trim();
      if (next !== s) { s = next; changed = true; }
    }
  }
  s = s.trim();
  // If still too long (>38 chars), abbreviate common long words
  if (s.length > 38) {
    s = s
      .replace(/Pengawas Operasional Pertama/i, 'POP')
      .replace(/Pengawas Operasional Madya/i, 'POM')
      .replace(/Pengawas Operasional Utama/i, 'POU')
      .replace(/Penanggulangan Kebakaran/i, 'Damkar')
      .replace(/Tenaga Kerja Bangunan Tinggi/i, 'TKBT')
      .replace(/Penanggung Jawab Operasional/i, 'PJ Operasional')
      .replace(/Penanggung Jawab Pengendalian/i, 'PJ Pengendalian')
      .replace(/Pengoperasian Alat Angkut/i, 'Op. Alat Angkut')
      .replace(/Peralatan Pendukung/i, 'Peralatan')
      .replace(/Pencemaran Udara/i, 'Pencemaran Udara')
      .replace(/Pencemaran Air/i, 'Pencemaran Air')
      .replace(/Pengolahan Air Limbah/i, 'Pengolahan Limbah')
      .trim();
  }
  // Hard truncate at 45 chars
  if (s.length > 45) s = s.slice(0, 43).trimEnd() + '…';
  return s || name.slice(0, 43);
}

/** Load course data from JSON files */
function loadCourses() {
  return fs.readdirSync(TRAININGS_DIR)
    .filter(f => f.endsWith('.json'))
    .map(f => {
      try { return JSON.parse(fs.readFileSync(path.join(TRAININGS_DIR, f), 'utf8')); }
      catch { return null; }
    })
    .filter(d => d && d.is_active !== 0 && d.slug);
}

/** Load scenes map */
function loadScenes() {
  if (!fs.existsSync(SCENES_FILE)) return {};
  try { return JSON.parse(fs.readFileSync(SCENES_FILE, 'utf8')); }
  catch { return {}; }
}

/** Load photo as base64 data URI, with category fallback */
function loadPhoto(slug, category) {
  const candidates = [
    path.join(PHOTOS_DIR, `${slug}.jpg`),
    path.join(PHOTOS_DIR, `${slug}.jpeg`),
    path.join(PHOTOS_DIR, `${slug}.png`),
    path.join(PHOTOS_DIR, `fallback-${category}.jpg`),
    path.join(PHOTOS_DIR, 'fallback-k3.jpg'),
  ];
  for (const p of candidates) {
    if (fs.existsSync(p) && fs.statSync(p).size > 5000) {
      const buf = fs.readFileSync(p);
      const ext = path.extname(p).slice(1).replace('jpg', 'jpeg');
      return `data:image/${ext};base64,${buf.toString('base64')}`;
    }
  }
  return ''; // no photo found, template will show gradient only
}

/** Render one banner using Playwright. Returns { ok, error } */
async function renderBanner(page, course, scenes) {
  const slug = course.slug;
  const outPath = path.join(OUT_DIR, `${slug}.webp`);
  const ogPath = path.join(OG_DIR, `${slug}.webp`);

  if (!FORCE && fs.existsSync(outPath) && fs.statSync(outPath).size > 10000) {
    return { ok: true, skipped: true };
  }

  const scene = scenes[slug] || {};
  const category = scene.category || course.category_slug || 'k3';
  const coreName = extractCoreName(course.name || slug);
  const photoSrc = loadPhoto(slug, category);

  const bannerData = {
    slug,
    line1: 'Pelatihan',
    line2: coreName,
    line3: deriveLine3(course.certification),
    sub: (course.description || '').replace(/\n/g, ' ').slice(0, 120),
    price: formatPrice(course.price),
    cert: deriveCert(course.certification),
    mode: course.mode || 'both',
    photoSrc,
  };

  const encoded = Buffer.from(JSON.stringify(bannerData)).toString('base64');
  const templateUrl = `file:///${TEMPLATE.replace(/\\/g, '/')}?data=${encodeURIComponent(encoded)}`;

  await page.goto(templateUrl, { waitUntil: 'networkidle', timeout: 15000 });
  // Extra wait for fonts
  await page.waitForTimeout(800);

  // Screenshot at banner size
  await page.setViewportSize({ width: 1822, height: 662 });

  // Full-size WebP
  await page.screenshot({
    path: outPath,
    type: 'webp',
    quality: 82,
    clip: { x: 0, y: 0, width: 1822, height: 662 },
  });

  // OG crop: 1200x630 — crop from center
  const ogX = Math.round((1822 - 1200) / 2);
  const ogY = Math.round((662 - 630) / 2);
  await page.screenshot({
    path: ogPath,
    type: 'webp',
    quality: 80,
    clip: { x: ogX, y: ogY, width: 1200, height: 630 },
  });

  const size = fs.existsSync(outPath) ? fs.statSync(outPath).size : 0;
  if (size < 5000) throw new Error(`Output too small: ${size} bytes`);

  return { ok: true, coreName };
}

// ── Main ───────────────────────────────────────────────────────────────────
async function main() {
  const allCourses = loadCourses();
  const scenes = loadScenes();

  let courses = allCourses;
  if (ONLY_SLUG) {
    courses = allCourses.filter(c => c.slug === ONLY_SLUG);
    if (!courses.length) {
      console.error(`No active course found with slug: ${ONLY_SLUG}`);
      process.exit(1);
    }
  }

  console.log(`\nWahana Totalita — Banner Generator`);
  console.log(`Courses: ${courses.length} | Force: ${FORCE} | Only: ${ONLY_SLUG || 'all'}\n`);

  if (PHOTOS_ONLY) {
    console.log('--photos-only: nothing to do without AI image tool. Exiting.');
    return;
  }

  const browser = await chromium.launch({ headless: true });
  const context = await browser.newContext();
  const page = await context.newPage();

  let generated = 0;
  let skipped = 0;
  const failed = [];
  const shortened = [];

  for (const course of courses) {
    process.stdout.write(`  [${generated + skipped + failed.length + 1}/${courses.length}] ${course.slug.slice(0, 55).padEnd(55)} `);
    try {
      const result = await renderBanner(page, course, scenes);
      if (result.skipped) {
        process.stdout.write('skip\n');
        skipped++;
      } else {
        process.stdout.write('OK\n');
        generated++;
        if (result.coreName && result.coreName.includes('…')) {
          shortened.push({ slug: course.slug, coreName: result.coreName });
        }
      }
    } catch (e) {
      process.stdout.write(`FAIL: ${e.message.slice(0, 60)}\n`);
      failed.push({ slug: course.slug, error: e.message });
    }
  }

  // Retry failures once
  if (failed.length > 0) {
    console.log(`\nRetrying ${failed.length} failures...\n`);
    const retryList = [...failed];
    failed.length = 0;
    for (const f of retryList) {
      const course = allCourses.find(c => c.slug === f.slug);
      if (!course) continue;
      process.stdout.write(`  RETRY ${course.slug.slice(0, 55).padEnd(55)} `);
      try {
        await renderBanner(page, course, scenes);
        process.stdout.write('OK\n');
        generated++;
      } catch (e) {
        process.stdout.write(`FAIL: ${e.message.slice(0, 60)}\n`);
        failed.push({ slug: f.slug, error: e.message });
      }
    }
  }

  await browser.close();

  console.log('\n─────────────────────────────────────────');
  console.log(`Generated: ${generated}  |  Skipped: ${skipped}  |  Failed: ${failed.length}`);
  if (shortened.length > 0) {
    console.log(`\nShortened titles (${shortened.length}):`);
    shortened.slice(0, 10).forEach(s => console.log(`  ${s.slug}: "${s.coreName}"`));
  }
  if (failed.length > 0) {
    console.log(`\nFailed slugs:`);
    failed.forEach(f => console.log(`  ${f.slug}: ${f.error}`));
  }
  console.log('─────────────────────────────────────────\n');
}

main().catch(e => { console.error(e); process.exit(1); });
