// scripts/build-scenes.cjs
// Generates banner-scenes.json from data/trainings/*.json
'use strict';
const fs = require('fs');
const path = require('path');

const TRAININGS_DIR = path.join(__dirname, '..', 'data', 'trainings');
const OUT = path.join(__dirname, 'banner-scenes.json');
const SUFFIX = 'photorealistic, bright daylight, Indonesian workers in white helmets and green hi-vis vests, clean sky, subject on the RIGHT 55% of frame, left 45% calm and uncluttered for text overlay, landscape 2.75:1 ratio, no text no logos no letters no numbers anywhere';

function categorize(slug, name, cat) {
  const s = slug.toLowerCase();
  const n = name.toLowerCase();

  if (s.includes('forklift')) return { scene: 'forklift operating in a warehouse loading dock with pallets and shelving', cat: 'k3' };
  if (s.includes('excavator') || s.includes('alat-berat') || s.includes('backhoe')) return { scene: 'excavator loading haul truck at construction site', cat: 'mining' };
  if (s.includes('bulldozer')) return { scene: 'bulldozer leveling ground at mining site', cat: 'mining' };
  if (s.includes('motor-grader') || s.includes('grader')) return { scene: 'motor grader on road construction site', cat: 'mining' };
  if (s.includes('compactor')) return { scene: 'vibratory compactor on road construction site', cat: 'mining' };
  if (s.includes('water-truck')) return { scene: 'water truck spraying dust suppression on mining haul road', cat: 'mining' };
  if (s.includes('fuel-truck')) return { scene: 'fuel truck refueling mining equipment on site', cat: 'mining' };
  if (s.includes('service-truck')) return { scene: 'service truck maintenance crew at open pit mine', cat: 'mining' };
  if (s.includes('underground-truck')) return { scene: 'underground haul truck in mine tunnel', cat: 'mining' };
  if (s.includes('tele-handler') || s.includes('telehandler')) return { scene: 'telescopic handler lifting load at construction site', cat: 'mining' };
  if (s.includes('crane') || s.includes('pesawat-angkat') || s.includes('overhead-crane')) return { scene: 'tower crane lifting steel beams at construction highrise site', cat: 'k3' };
  if (s.includes('mobile-crane')) return { scene: 'mobile crane lifting heavy load at industrial plant', cat: 'k3' };
  if (s.includes('drilling-rig') || s.includes('hydraulic-drilling')) return { scene: 'hydraulic drilling rig operating at oil well site', cat: 'k3' };
  if (s.includes('kebakaran') || s.includes('damkar') || s.includes('penanggulangan-kebakaran') || s.includes('kebakaran-kelas')) return { scene: 'fire fighting drill with foam hose and fire truck at industrial facility', cat: 'k3' };
  if (s.includes('proteksi-kebakaran') || s.includes('pengkaji-teknis')) return { scene: 'fire protection system inspection at industrial building', cat: 'k3' };
  if (s.includes('confined-space') || s.includes('ruang-terbatas')) return { scene: 'confined space entry team with tripod rescue equipment', cat: 'k3' };
  if (s.includes('listrik') || s.includes('electrical') || s.includes('k3-listrik')) return { scene: 'electrical substation with switchgear panels and power transformers', cat: 'k3' };
  if (s.includes('bejana-tekan') || s.includes('boiler') || s.includes('pressure-vessel') || s.includes('pesawat-uap')) return { scene: 'large industrial boiler room with pressure vessels and piping', cat: 'k3' };
  if (s.includes('ktinggian') || s.includes('bangunan-tinggi') || s.includes('tkbt')) return { scene: 'workers on scaffolding at high-rise building wearing safety harness', cat: 'k3' };
  if (s.includes('p3k') || s.includes('first-aid') || s.includes('pertolongan-pertama')) return { scene: 'first aid training session with mannequin and bandaging demonstration', cat: 'k3' };
  if (s.includes('migas') || s.includes('h2s') || s.includes('gas-tester') || s.includes('oil-gas') || s.includes('minyak-gas')) return { scene: 'oil refinery with gas detector equipment and process towers', cat: 'k3' };
  if (s.includes('kimia') || s.includes('k3-kimia') || s.includes('bahan-berbahaya')) return { scene: 'chemical plant with storage tanks and pipe racks', cat: 'k3' };
  if (s.includes('welder') || s.includes('juru-las') || s.includes('welding') || s.includes('las-')) return { scene: 'welding sparks in fabrication workshop with arc welding', cat: 'k3' };
  if (s.includes('pop-') || s.includes('pop-pertambangan') || n.includes('pengawas operasional pertama')) return { scene: 'open pit coal mine with haul trucks and excavators', cat: 'mining' };
  if (s.includes('pom-') || s.includes('pom-pertambangan') || n.includes('pengawas operasional madya')) return { scene: 'mining operations center with supervisors overseeing open pit mine', cat: 'mining' };
  if (s.includes('pou-') || s.includes('pou-pertambangan') || n.includes('pengawas operasional utama')) return { scene: 'senior mining manager at open pit mine site overview', cat: 'mining' };
  if (s.includes('reklamasi') || s.includes('reklamasi-pertambangan')) return { scene: 'mine reclamation and land rehabilitation with replanted vegetation', cat: 'mining' };
  if (s.includes('lingkungan') || s.includes('amdal') || s.includes('pencemaran') || cat === 'lingkungan') return { scene: 'wastewater treatment plant with aeration basins and emission monitoring stack', cat: 'lingkungan' };
  if (s.includes('limbah') || s.includes('b3') || s.includes('pplb3') || s.includes('pppa') || s.includes('pppu') || s.includes('poippu') || s.includes('popal')) return { scene: 'industrial waste treatment facility with storage tanks', cat: 'lingkungan' };
  if (s.includes('pcua') || s.includes('contoh-uji-air')) return { scene: 'environmental technician taking water quality samples from river', cat: 'lingkungan' };
  if (s.includes('pertek') || s.includes('emisi')) return { scene: 'emission monitoring equipment at industrial smokestack', cat: 'lingkungan' };
  if (s.includes('iso') || s.includes('qhse') || s.includes('smk3') || s.includes('audit') || cat === 'system-management') return { scene: 'safety audit meeting in modern conference room with professionals reviewing documents', cat: 'system-management' };
  if (s.includes('rotating-equipment') || s.includes('kompressor')) return { scene: 'industrial compressor and rotating equipment maintenance at plant', cat: 'k3' };
  if (s.includes('scuba') || s.includes('diving') || s.includes('penyelaman')) return { scene: 'industrial diving operation with diver and support crew at water facility', cat: 'k3' };
  if (s.includes('fasyankes') || s.includes('rumah-sakit') || s.includes('laboratorium')) return { scene: 'hospital or medical laboratory safety inspection', cat: 'k3' };
  if (s.includes('human-resources') || s.includes('hr-')) return { scene: 'professional HR training session in modern corporate office', cat: 'system-management' };
  if (s.includes('pengadaan') || s.includes('procurement') || s.includes('vendor') || s.includes('contract')) return { scene: 'procurement team reviewing contracts in modern office', cat: 'system-management' };
  if (s.includes('public-speaking') || s.includes('communication') || s.includes('sosial-media') || s.includes('marketing')) return { scene: 'professional presentation and communication training in conference hall', cat: 'system-management' };
  if (s.includes('cash-flow') || s.includes('project-cost') || s.includes('manajemen-keuangan')) return { scene: 'financial management training with charts and data analysis', cat: 'system-management' };
  if (s.includes('skkni') || s.includes('bnsp') || s.includes('perpanjangan-sertifikasi') || s.includes('uji-kompetensi')) return { scene: 'certification exam room with professionals taking competency assessment', cat: 'k3' };
  if (s.includes('safety-inspector') || s.includes('ahli-k3') || n.includes('ahli k3')) return { scene: 'safety officer inspecting industrial plant with clipboard and PPE', cat: 'k3' };
  if (s.includes('p2k3') || s.includes('panitia')) return { scene: 'workplace safety committee meeting at industrial company boardroom', cat: 'k3' };
  if (s.includes('operator-pesawat') || s.includes('ptp') || s.includes('tenaga-produksi')) return { scene: 'industrial production machinery operator at manufacturing plant', cat: 'k3' };

  // Default per category
  if (cat === 'mining') return { scene: 'open pit mine with haul trucks and excavators under blue sky', cat: 'mining' };
  if (cat === 'lingkungan') return { scene: 'environmental inspection at industrial facility with emission monitoring', cat: 'lingkungan' };
  if (cat === 'system-management') return { scene: 'ISO management system audit in modern office environment', cat: 'system-management' };
  return { scene: 'industrial safety inspection at refinery with process towers', cat: 'k3' };
}

const files = fs.readdirSync(TRAININGS_DIR).filter(f => f.endsWith('.json'));
const scenes = {};
let count = 0;

for (const file of files) {
  const raw = JSON.parse(fs.readFileSync(path.join(TRAININGS_DIR, file), 'utf8'));
  if (raw.is_active === 0) continue;
  const { scene, cat } = categorize(raw.slug, raw.name || '', raw.category_slug || 'k3');
  scenes[raw.slug] = {
    prompt: `${scene}, ${SUFFIX}`,
    category: cat,
  };
  count++;
}

fs.writeFileSync(OUT, JSON.stringify(scenes, null, 2), 'utf8');
console.log(`Wrote ${count} entries to banner-scenes.json`);
