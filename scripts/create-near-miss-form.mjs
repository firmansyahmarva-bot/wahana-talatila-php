import fs from 'node:fs';
const rows=[
 ['Identitas kejadian','Tanggal / Jam: … | Lokasi: … | Nomor laporan: …'],
 ['Pelapor dan pihak yang diberi tahu','Nama / Peran: … | Penerima laporan: … | Waktu pemberitahuan: …'],
 ['Fakta dan urutan kejadian','Apa yang terjadi? Siapa yang berada di area? Apa yang diketahui dan belum diketahui?'],
 ['Dampak aktual dan potensi akibat','Cedera / Kerusakan / Paparan aktual: … | Potensi akibat: … | Kategori sesuai sistem perusahaan: …'],
 ['Tindakan segera','Apa yang diamankan, siapa yang bertindak, dan apakah bahaya masih ada?'],
 ['Informasi pendukung','Saksi / Foto / Rekaman / Dokumen: … | Hindari pengumpulan bukti yang menambah paparan.'],
 ['Dugaan yang perlu diperiksa','Pisahkan dugaan dari fakta: …'],
 ['Tindak lanjut','Tindakan: … | Penanggung jawab: … | Tenggat: …'],
 ['Verifikasi hasil','Bukti efektivitas: … | Diperiksa oleh / Tanggal: … | Temuan lanjutan: …']
];
const body=rows.map(([label,value])=>`<tr><th scope="row">${label}</th><td contenteditable="true" role="textbox" aria-label="${label}">${value}</td></tr>`).join('');
fs.mkdirSync('public/downloads',{recursive:true});
fs.writeFileSync('public/downloads/form-laporan-near-miss.html',`<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><meta name="robots" content="noindex,follow"><title>Form Laporan Near Miss — Wahana Totalita</title><style>body{font:16px/1.5 Arial,sans-serif;color:CanvasText;background:Canvas;max-width:1000px;padding:20px;margin:auto}table{width:100%;border-collapse:collapse}th,td{padding:14px;border:1px solid GrayText;text-align:left;vertical-align:top}th{width:28%}td{min-height:70px;height:70px}button{padding:12px 20px;margin:12px 12px 20px 0;cursor:pointer}[contenteditable]:focus-visible,button:focus-visible{outline:3px solid Highlight}.nm-form-table{overflow:auto}@media print{body{font-size:10pt;margin:0;padding:0}.nm-form-controls{display:none}td{height:42px}th,td{padding:8px}tr{break-inside:avoid}@page{size:A4;margin:12mm}}</style></head><body><h1>Form Laporan Near Miss</h1><div class="nm-form-controls"><p>Contoh edukasi untuk sistem internal. Klik kolom untuk mengetik. Isian tidak disimpan otomatis; cetak atau simpan sebelum menutup halaman. Pelaporan resmi mengikuti jenis kejadian dan ketentuan yang berlaku.</p><button type="button" onclick="window.print()">Cetak / Simpan PDF</button><a href="/artikel/near-miss/">Kembali ke panduan near miss</a></div><div class="nm-form-table"><table><caption>Catat fakta, tindakan, dan verifikasi</caption><tbody>${body}</tbody></table></div><p>Amankan situasi melalui prosedur dan kewenangan yang sesuai. Jangan mengulangi kejadian untuk membuat bukti. Jika ada cedera, kerusakan, atau paparan, catat dampak tersebut dan jangan memaksakan kategori near miss.</p></body></html>`);
console.log('Created printable editable near-miss form.');
