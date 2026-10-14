import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const sqlPath = path.resolve(__dirname, '../../u566907099_wahana_db.sql');
const outJsonPath = path.resolve(__dirname, '../data/incidents.json');

console.log('Reading SQL dump...');
const text = fs.readFileSync(sqlPath, 'utf8');

const startPos = text.indexOf('Dumping data for table `incidents`');
if (startPos === -1) {
  console.error('Could not find incidents table dump!');
  process.exit(1);
}
const endPos = text.indexOf('Table structure for table `inquiries`', startPos);
const incidentsSql = text.slice(startPos, endPos !== -1 ? endPos : undefined);

console.log(`Extracted incidents SQL chunk: ${(incidentsSql.length / 1024).toFixed(2)} KB`);

// Find all `INSERT INTO \`incidents\` (...) VALUES` statements
const columns = [
  'id', 'title', 'slug', 'company', 'province', 'city', 'industry', 'incident_type', 
  'incident_date', 'deaths', 'injured', 'description', 'root_cause', 'regulation_violated', 
  'prevention', 'source_url', 'source_name', 'is_verified', 'is_active', 'view_count', 
  'meta_title', 'meta_desc', 'created_at', 'updated_at'
];

// Split by INSERT INTO `incidents`
const insertBlocks = incidentsSql.split(/INSERT INTO `incidents`[^(]*\([^)]+\)\s*VALUES\s*/i);
// The first element is the comment header before the first INSERT
insertBlocks.shift();

console.log(`Found ${insertBlocks.length} INSERT INTO blocks`);

const records = [];

for (const block of insertBlocks) {
  // block contains tuples: (row1), (row2), ... ;
  let i = 0;
  const len = block.length;

  while (i < len) {
    // Find next '('
    const startIdx = block.indexOf('(', i);
    if (startIdx === -1) break;

    i = startIdx + 1;
    const values = [];
    let currentVal = '';
    let inString = false;
    let escape = false;

    while (i < len) {
      const char = block[i];

      if (inString) {
        if (escape) {
          if (char === 'n') currentVal += '\n';
          else if (char === 'r') currentVal += '\r';
          else if (char === 't') currentVal += '\t';
          else if (char === '\\') currentVal += '\\';
          else if (char === '\'') currentVal += '\'';
          else currentVal += char;
          escape = false;
        } else if (char === '\\') {
          escape = true;
        } else if (char === '\'') {
          if (i + 1 < len && block[i + 1] === '\'') {
            currentVal += '\'';
            i++;
          } else {
            inString = false;
          }
        } else {
          currentVal += char;
        }
      } else {
        if (char === '\'') {
          inString = true;
          currentVal = '';
        } else if (char === ',' || char === ')') {
          let trimmed = currentVal.trim();
          if (trimmed === 'NULL') {
            values.push(null);
          } else if (trimmed !== '' && !isNaN(trimmed) && (!trimmed.startsWith('0') || trimmed === '0')) {
            values.push(Number(trimmed));
          } else {
            values.push(currentVal.trim() === '' ? null : currentVal);
          }
          currentVal = '';
          if (char === ')') {
            i++;
            break;
          }
        } else {
          currentVal += char;
        }
      }
      i++;
    }

    if (values.length >= columns.length) {
      const obj = {};
      columns.forEach((col, idx) => {
        obj[col] = values[idx] !== undefined ? values[idx] : null;
      });
      if (obj.is_active === 1 || obj.is_active === null) {
        records.push(obj);
      }
    }
  }
}

console.log(`Successfully extracted ${records.length} active incidents!`);
if (records.length > 0) {
  console.log('Sample record 1:', {
    id: records[0].id,
    title: records[0].title,
    slug: records[0].slug,
    date: records[0].incident_date,
    deaths: records[0].deaths,
    injured: records[0].injured
  });
  console.log('Sample record last:', {
    id: records[records.length - 1].id,
    title: records[records.length - 1].title,
    slug: records[records.length - 1].slug,
    date: records[records.length - 1].incident_date,
    deaths: records[records.length - 1].deaths,
    injured: records[records.length - 1].injured
  });

  fs.writeFileSync(outJsonPath, JSON.stringify(records, null, 2), 'utf8');
  console.log('Saved to:', outJsonPath);
}
