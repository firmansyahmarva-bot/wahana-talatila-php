const { execSync } = require('child_process');

const bLines = execSync('git grep -c "style=" phase2-pelatihan -- src/', { encoding: 'utf8' }).trim().split('\n');
const aLines = execSync('git grep --untracked -c "style=" src/', { encoding: 'utf8' }).trim().split('\n');

const bSum = bLines.reduce((acc, line) => {
  const parts = line.split(':');
  const count = parseInt(parts[parts.length - 1], 10);
  return acc + (isNaN(count) ? 0 : count);
}, 0);

const aSum = aLines.reduce((acc, line) => {
  const parts = line.split(':');
  const count = parseInt(parts[parts.length - 1], 10);
  return acc + (isNaN(count) ? 0 : count);
}, 0);

console.log(`Total style= in src/:`);
console.log(`  Before (phase2-pelatihan): ${bSum}`);
console.log(`  After (phase3-components): ${aSum}`);
console.log(`  Net reduction:             ${bSum - aSum}`);
