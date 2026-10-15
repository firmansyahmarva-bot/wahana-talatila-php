import fs from 'fs';
import path from 'path';

const galeriDir = 'D:/wahana-transform/wahana-astro/public/galeri';
const thumbsDir = 'D:/wahana-transform/wahana-astro/public/galeri/thumbs';
const allowedExt = ['.jpg', '.jpeg', '.png', '.webp', '.gif'];

const seoTopics = [
  'Pelatihan Ahli K3 Umum Kemnaker RI — Wahana Totalita',
  'Praktik Simulasi Tanggap Darurat & Kebakaran Pelatihan K3',
  'Uji Kompetensi & Sertifikasi BNSP K3 Wahana Totalita',
  'Pembinaan Calon Ahli K3 Umum Sertifikasi Kemnaker RI',
  'Praktik Lapangan & Identifikasi Bahaya Pelatihan K3',
  'Sertifikasi Petugas K3 & Lisensi Kemnaker RI',
  'In-House Training K3 Korporasi & Sertifikasi Industri',
  'Sesi Teori & Evaluasi Regulasi K3 Wahana Totalita',
  'Pelatihan K3 Bekerja di Ketinggian & Ruang Terbatas',
  'Pelatihan & Sertifikasi Auditor SMK3 Kemnaker RI',
  'Dokumentasi Pembinaan K3 Lingkungan & Laboratorium',
  'Ujian Evaluasi & Pembekalan Calon Ahli K3 Umum',
];

function crc32(str) {
  let crc = 0 ^ (-1);
  for (let i = 0; i < str.length; i++) {
    crc = (crc >>> 8) ^ ((crc ^ str.charCodeAt(i)) & 0xff);
  }
  return (crc ^ (-1)) >>> 0;
}

const files = fs.readdirSync(galeriDir);
const photos = [];

for (const file of files) {
  const ext = path.extname(file).toLowerCase();
  if (!allowedExt.includes(ext)) continue;

  const fullPath = path.join(galeriDir, file);
  const stat = fs.statSync(fullPath);
  if (!stat.isFile()) continue;

  const thumbFile = file;
  const thumbExists = fs.existsSync(path.join(thumbsDir, thumbFile));

  const rawFn = path.parse(file).name;
  const isRawName = /^(dsc|img|file|photo|wp|whatsapp|\d+)/i.test(rawFn) || !isNaN(Number(rawFn));

  let caption = '';
  if (isRawName) {
    const hash = Math.abs(crc32(file));
    caption = seoTopics[hash % seoTopics.length];
  } else {
    const clean = rawFn.replace(/[-_]/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
    caption = (!clean.toLowerCase().includes('k3') && !clean.toLowerCase().includes('pelatihan'))
      ? `Pelatihan K3 — ${clean} Sertifikasi Kemnaker RI / BNSP`
      : `${clean} — Wahana Totalita`;
  }

  photos.push({
    file,
    url: `/galeri/${encodeURIComponent(file)}`,
    thumbUrl: thumbExists ? `/galeri/thumbs/${encodeURIComponent(thumbFile)}` : `/galeri/${encodeURIComponent(file)}`,
    caption,
    mtime: stat.mtimeMs
  });
}

// Sort newest first
photos.sort((a, b) => b.mtime - a.mtime);

fs.mkdirSync('D:/wahana-transform/wahana-astro/src/data', { recursive: true });
fs.writeFileSync('D:/wahana-transform/wahana-astro/src/data/galeri.json', JSON.stringify(photos, null, 2));
console.log(`Generated galeri.json with ${photos.length} photos.`);
