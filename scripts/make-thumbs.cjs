const fs = require('fs');
const path = require('path');
const sharp = require('sharp');

const thumbsDir = path.join(__dirname, '..', 'public', 'galeri', 'thumbs');

async function makeThumbs() {
  if (!fs.existsSync(thumbsDir)) {
    console.error('Thumbs directory does not exist:', thumbsDir);
    return;
  }

  const files = fs.readdirSync(thumbsDir);
  let converted = 0;
  let skipped = 0;

  for (const file of files) {
    if (file.toLowerCase().endsWith('.webp')) continue;

    const ext = path.extname(file);
    const base = path.basename(file, ext);
    const srcPath = path.join(thumbsDir, file);
    const destPath = path.join(thumbsDir, `${base}.webp`);

    const srcStat = fs.statSync(srcPath);

    if (fs.existsSync(destPath)) {
      const destStat = fs.statSync(destPath);
      if (destStat.mtimeMs >= srcStat.mtimeMs) {
        skipped++;
        continue;
      }
    }

    try {
      await sharp(srcPath)
        .webp({ quality: 78 })
        .toFile(destPath);
      converted++;
      console.log(`Converted: ${file} -> ${base}.webp`);
    } catch (err) {
      console.error(`Failed to convert ${file}:`, err.message);
    }
  }

  console.log(`Thumbnail generation complete. Converted: ${converted}, Skipped: ${skipped}`);
}

makeThumbs().catch(err => {
  console.error('Error generating thumbs:', err);
  process.exit(1);
});
