const cp = require('child_process');

const classes = [
  'wb-btn', 'wb-primary', 'wb-secondary', 'wb-link', 'wb-sm', 'wb-md', 'wb-lg', 'wb-icon', 'wb-label',
  'tc-card', 'tc-card-img-wrap', 'tc-card-img', 'tc-card-cat-badge', 'tc-card-body', 'tc-card-badges',
  'tc-card-badge-mode', 'tc-card-badge-cert', 'tc-card-title', 'tc-card-title-link', 'tc-card-footer',
  'tc-card-price-box', 'tc-card-price-label', 'tc-card-price-val', 'tc-card-price-sub', 'tc-card-actions',
  'tc-card-syllabus-link', 'pd-hero-cta-wrap', 'pd-hero-sublinks', 'pd-hero-sublink', 'pd-hero-sublink-dot',
  'pd-schedule-section', 'pd-schedule-fallback', 'pd-schedule-fallback-text', 'pd-ticket-inhouse-link',
  'pd-proof-block', 'pd-proof-grid', 'pd-proof-card', 'pd-proof-icon', 'pd-proof-info',
  'pd-proof-client-strip', 'pd-proof-client-tag', 'pd-proof-client-item', 'pd-sticky-mobile-bar',
  'pd-sticky-price-wrap', 'pd-sticky-price-label', 'pd-sticky-price-val'
];

let duplicates = 0;
for (const c of classes) {
  try {
    const raw = cp.execSync(`git grep -n "\\.${c}[\\s,{,:]" public/assets/css src/`, { encoding: 'utf8' }).trim();
    const lines = raw.split('\n').filter(Boolean);
    if (lines.length > 1) {
      console.log(`Multiple definitions for .${c}:`, lines);
      duplicates++;
    }
  } catch (e) {
    // not found in css
  }
}

if (duplicates === 0) {
  console.log('✅ Every new class name is defined exactly once.');
} else {
  console.log(`❌ Found ${duplicates} duplicated class definitions.`);
  process.exit(1);
}
