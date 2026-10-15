import fs from 'fs';

const sql = fs.readFileSync('D:/wahana-transform/u566907099_wahana_db.sql', 'utf8');

function getTableDump(tableName) {
  const marker = `INSERT INTO \`${tableName}\``;
  const idx = sql.indexOf(marker);
  if (idx === -1) return null;
  const endIdx = sql.indexOf(';\n', idx);
  return sql.substring(idx, endIdx + 1);
}

console.log('--- RESOURCE CATEGORIES ---');
console.log(getTableDump('resource_categories'));
console.log('--- RESOURCES ---');
console.log(getTableDump('resources'));
console.log('--- JOBS ---');
console.log(getTableDump('jobs'));
