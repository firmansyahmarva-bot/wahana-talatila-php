const fs = require('fs');
const path = require('path');

const rootDir = process.cwd();

function getFiles(dir, extList) {
  let res = [];
  try {
    const list = fs.readdirSync(dir);
    list.forEach(file => {
      const full = path.join(dir, file);
      const stat = fs.statSync(full);
      if (stat && stat.isDirectory()) {
        res = res.concat(getFiles(full, extList));
      } else {
        if (extList.some(ext => full.endsWith(ext))) res.push(full);
      }
    });
  } catch (e) {}
  return res;
}

// 1. Gather defined tokens from tokens.css
const tokensCssPath = path.join(rootDir, 'public', 'assets', 'css', 'tokens.css');
let definedTokens = new Set();
if (fs.existsSync(tokensCssPath)) {
  const tokensContent = fs.readFileSync(tokensCssPath, 'utf8');
  const tokenRegex = /(--[a-zA-Z0-9_-]+)\s*:/g;
  let tm;
  while ((tm = tokenRegex.exec(tokensContent)) !== null) {
    definedTokens.add(tm[1]);
  }
}

// Gather all variables defined in other CSS files (scoped component variables)
const cssFiles = getFiles(path.join(rootDir, 'public', 'assets', 'css'), ['.css']);
let scopedCssVars = new Map(); // varName -> Set of files where defined
cssFiles.forEach(file => {
  const relPath = path.relative(rootDir, file);
  const content = fs.readFileSync(file, 'utf8');
  const tokenRegex = /(--[a-zA-Z0-9_-]+)\s*:/g;
  let tm;
  while ((tm = tokenRegex.exec(content)) !== null) {
    if (!scopedCssVars.has(tm[1])) scopedCssVars.set(tm[1], new Set());
    scopedCssVars.get(tm[1]).add(relPath);
  }
});

// Standard media query widths allowed
const allowedBreakpoints = new Set(['640px', '768px', '1024px', '1200px']);

const srcFiles = getFiles(path.join(rootDir, 'src'), ['.astro', '.html', '.ts', '.js']);

let violations = {
  hexOutsideTokens: [],
  undefinedVars: [],
  nonStandardMediaQueries: [],
  inlineStyleForbiddenProps: []
};

// Check CSS files
cssFiles.forEach(file => {
  const isTokens = path.normalize(file) === path.normalize(tokensCssPath);
  const relPath = path.relative(rootDir, file);
  const content = fs.readFileSync(file, 'utf8');

  // Rule 1: Hex colors outside tokens.css
  if (!isTokens) {
    const isHomeCss = relPath.includes('home.css');
    const hexRegex = /#([0-9a-fA-F]{3,8})\b/g;
    let m;
    while ((m = hexRegex.exec(content)) !== null) {
      // Exclude HTML entities if any
      const prevChar = content[m.index - 1];
      if (prevChar === '&') continue;
      // Exclude protected legacy colors in home.css (#103A5C and #F06A25)
      if (isHomeCss && ['#103A5C', '#103a5c', '#F06A25', '#f06a25'].includes(m[0])) {
        continue;
      }
      violations.hexOutsideTokens.push({
        file: relPath,
        match: m[0],
        index: m.index
      });
    }
  }

  // Rule 2: var(--x) not defined in tokens.css or in scoped CSS
  const varRegex = /var\(\s*(--[a-zA-Z0-9_-]+)/g;
  let vm;
  while ((vm = varRegex.exec(content)) !== null) {
    const varName = vm[1];
    if (!definedTokens.has(varName) && !scopedCssVars.has(varName)) {
      violations.undefinedVars.push({
        file: relPath,
        match: varName
      });
    }
  }

  // Rule 3: @media widths outside standard set (640 / 768 / 1024)
  const mqRegex = /@media[^{]+{/g;
  let mm;
  while ((mm = mqRegex.exec(content)) !== null) {
    const rawMq = mm[0];
    const widthMatches = rawMq.match(/(?:max-width|min-width)\s*:\s*([0-9]+px)/g);
    if (widthMatches) {
      widthMatches.forEach(wm => {
        const val = wm.match(/[0-9]+px/)[0];
        if (!allowedBreakpoints.has(val)) {
          violations.nonStandardMediaQueries.push({
            file: relPath,
            mediaQuery: rawMq.replace(/\{$/, '').trim(),
            badWidth: val
          });
        }
      });
    }
  }
});

// Check SRC files
srcFiles.forEach(file => {
  const relPath = path.relative(rootDir, file);
  const content = fs.readFileSync(file, 'utf8');

  // Rule 1: Hex colors in src
  // Match 3, 4, 6, or 8 digit hex colors (e.g. #fff, #1a1a1a) but not HTML entities &#...; or href="#..."
  const hexRegex = /#([0-9a-fA-F]{3,8})\b/g;
  let m;
  while ((m = hexRegex.exec(content)) !== null) {
    const prevChar = content[m.index - 1];
    // Ignore HTML entities like &#8249; or &#10003;
    if (prevChar === '&') continue;
    // Ignore href="#..." anchor links
    const beforeSnippet = content.slice(Math.max(0, m.index - 10), m.index);
    if (/href=["']?$/i.test(beforeSnippet) || /id=["']?$/i.test(beforeSnippet)) continue;

    violations.hexOutsideTokens.push({
      file: relPath,
      match: m[0],
      index: m.index
    });
  }

  // Rule 2: Undefined CSS variables in src
  const varRegex = /var\(\s*(--[a-zA-Z0-9_-]+)/g;
  let vm;
  while ((vm = varRegex.exec(content)) !== null) {
    const varName = vm[1];
    if (!definedTokens.has(varName) && !scopedCssVars.has(varName)) {
      violations.undefinedVars.push({
        file: relPath,
        match: varName
      });
    }
  }

  // Rule 4: style="" containing color, background, or border
  const styleRegex = /style=(?:"([^"]*)"|'([^']*)'|\{`([^`]*)`\})/g;
  let sm;
  while ((sm = styleRegex.exec(content)) !== null) {
    const styleVal = (sm[1] || sm[2] || sm[3] || '');
    const forbidden = [];
    if (/(?:^|;|\s)(?:[a-z-]*)color\s*:/i.test(styleVal)) forbidden.push('color');
    if (/(?:^|;|\s)background(?:-[a-z]+)?\s*:/i.test(styleVal)) forbidden.push('background');
    if (/(?:^|;|\s)border(?:-[a-z]+)?\s*:/i.test(styleVal)) forbidden.push('border');

    if (forbidden.length > 0) {
      violations.inlineStyleForbiddenProps.push({
        file: relPath,
        forbidden: forbidden.join(', '),
        snippet: styleVal.slice(0, 70)
      });
    }
  }
});

// Report results
console.log('====================================================');
console.log('           DESIGN LINTER REPORT                     ');
console.log('====================================================\n');

console.log(`1. Hex colors outside tokens.css:          ${violations.hexOutsideTokens.length}`);
console.log(`2. Undefined var(--x) (truly undefined):   ${violations.undefinedVars.length}`);
console.log(`3. Non-standard @media query widths:       ${violations.nonStandardMediaQueries.length}`);
console.log(`4. style="" with color/background/border:  ${violations.inlineStyleForbiddenProps.length}`);

const totalViolations = 
  violations.hexOutsideTokens.length +
  violations.undefinedVars.length +
  violations.nonStandardMediaQueries.length +
  violations.inlineStyleForbiddenProps.length;

console.log('----------------------------------------------------');
console.log(`TOTAL DESIGN VIOLATIONS:                   ${totalViolations}`);
console.log('====================================================\n');

if (totalViolations > 0) {
  console.log(`❌ lint:design failed with ${totalViolations} violations.\n`);
  process.exit(1);
} else {
  console.log('✅ lint:design passed! All styles conform to tokens and design rules.\n');
  process.exit(0);
}
