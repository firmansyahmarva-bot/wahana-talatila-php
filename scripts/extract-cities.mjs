import { execSync } from 'child_process';
import fs from 'fs';

const php = execSync('git show 4699233:kota.php').toString();

// Extract all cities from $cities array in kota.php
const cityRegex = /'([a-z0-9-]+)'\s*=>\s*\[\s*'name'\s*=>\s*'([^']*)',\s*'province'\s*=>\s*'([^']*)',\s*'title'\s*=>\s*'([^']*)',\s*'desc'\s*=>\s*'([^']*)',\s*'industries'\s*=>\s*'([^']*)',\s*'demand'\s*=>\s*'([^']*)',\s*'highlight'\s*=>\s*'([^']*)',\s*'companies'\s*=>\s*'([^']*)',\s*'nearby'\s*=>\s*'([^']*)',\s*'img'\s*=>\s*([^,]+),\s*'type'\s*=>\s*'([^']*)'/g;

let match;
const cities = {};

while ((match = cityRegex.exec(php)) !== null) {
  const [
    _,
    slug,
    name,
    province,
    title,
    desc,
    industries,
    demand,
    highlight,
    companies,
    nearby,
    _imgExpr,
    type
  ] = match;

  cities[slug] = {
    slug,
    name,
    province,
    title,
    desc,
    industries,
    demand,
    highlight,
    companies,
    nearby: nearby.split(',').map((s) => s.trim()).filter(Boolean),
    type, // 'urban' | 'industrial' | 'energy_mining'
  };
}

console.log(`Successfully extracted ${Object.keys(cities).length} cities.`);
fs.writeFileSync('src/data/city-hubs.json', JSON.stringify(cities, null, 2), 'utf8');
console.log('Saved to src/data/city-hubs.json');
