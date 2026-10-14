import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const talksPath = path.join(__dirname, '..', 'data', 'tools_safety_talk.json');
const talks = JSON.parse(fs.readFileSync(talksPath, 'utf8'));

const topic_destinations = {
  'umum': { url: '/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri/', label: 'Program Ahli K3 Umum Kemnaker RI' },
  'ketinggian': { url: '/pelatihan/pelatihan-tkbt-ii-sertifikasi-kemnaker-ri/', label: 'Program TKBT II Kemnaker RI' },
  'kebakaran': { url: '/pelatihan/pelatihan-regu-penanggulangan-kebakaran-kelas-c-sertifikasi-kemnaker-ri/', label: 'Program Regu Kebakaran Kelas C' },
  'listrik': { url: '/pelatihan/pelatihan-ahli-k3-listrik-sertifikasi-kemnaker-ri/', label: 'Program Ahli K3 Listrik Kemnaker RI' },
  'kimia': { url: '/pelatihan/pelatihan-petugas-k3-kimia-sertifikasi-kemnaker-ri/', label: 'Program Petugas K3 Kimia Kemnaker RI' },
  'alatberat': { url: '/pelatihan/pelatihan-k3-operator-alat-berat-sertifikasi-kemnaker-ri/', label: 'Program Operator Alat Berat Kemnaker RI' },
  'kesehatan': { url: '/pelatihan/pelatihan-petugas-p3k-sertifikasi-kemnaker-ri/', label: 'Program Petugas P3K Kemnaker RI' },
  'konstruksi': { url: '/pelatihan/pelatihan-ahli-muda-k3-konstruksi-sertifikasi-kemnaker-ri/', label: 'Program Ahli Muda K3 Konstruksi' },
  'tambang': { url: '/pelatihan/pelatihan-pop-pertambangan-sertifikasi-bnsp-online/', label: 'Program POP Pertambangan BNSP' },
  'lingkungan': { url: '/pelatihan/pelatihan-ahli-muda-lingkungan-kerja-sertifikasi-kemnaker-ri/', label: 'Program Ahli Muda Lingkungan Kerja' },
  'teknologi': { url: '/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-bnsp-online/', label: 'Program Ahli K3 Umum BNSP Online' }
};

const topic_overrides = {
  17: { url: '/pelatihan/pelatihan-k3-operator-welder-kelas-3-sertifikasi-kemnaker-ri/', label: 'Program Operator Welder Kemnaker RI' },
  18: { url: '/pelatihan/pelatihan-teknisi-confined-space-sertifikasi-kemnaker-ri/', label: 'Program Teknisi Confined Space Kemnaker RI' },
  19: { url: '/pelatihan/pelatihan-petugas-p3k-sertifikasi-kemnaker-ri/', label: 'Program Petugas P3K Kemnaker RI' },
  28: { url: '/pelatihan/pelatihan-k3-operator-crane-kelas-3-sertifikasi-kemnaker-ri/', label: 'Program Operator Crane Kelas 3' },
  29: { url: '/pelatihan/pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri/', label: 'Program Operator Forklift Kelas 2' },
  87: { url: '/pelatihan/pelatihan-k3-operator-motor-diesel-genset-sertifikasi-kemnaker-ri/', label: 'Program Operator Motor Diesel/Genset' }
};

talks.forEach(t => {
  t.related = topic_overrides[t.w] || topic_destinations[t.cat] || topic_destinations['umum'];
});

fs.writeFileSync(talksPath, JSON.stringify(talks, null, 2), 'utf8');
console.log('Updated tools_safety_talk.json with related links!');
