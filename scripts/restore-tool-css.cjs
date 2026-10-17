const fs = require('fs');

const restores = {
  'public/assets/css/page/tools-ibpr-generator.css': `
body{font-family:'Segoe UI',Arial,sans-serif;padding:24px;max-width:1050px;margin:0 auto;color:var(--slate-900);line-height:1.4}
    h1{font-size:16pt;margin:0;color:var(--brand);border-bottom:2px solid var(--brand);padding-bottom:6px}
    .sub{font-size:8.5pt;color:var(--slate-500);margin:4px 0 12px}
    table{width:100%;border-collapse:collapse;margin:10px 0;font-size:8.5pt}
    th,td{border:1px solid var(--slate-300);padding:6px 8px;text-align:left;vertical-align:top}
    th{background:var(--brand);color:var(--surface)}
    .sig{margin-top:30px;display:grid;grid-template-columns:1fr 1fr;gap:40px;text-align:center;font-size:9pt}
    .line{margin-top:50px;border-top:1px solid var(--black);font-weight:bold}
`,
  'public/assets/css/page/tools-jsa-builder.css': `
body{font-family:'Segoe UI',Arial,sans-serif;padding:24px;max-width:960px;margin:0 auto;color:var(--slate-900);line-height:1.4}
    .header{border-bottom:3px solid var(--brand);padding-bottom:12px;margin-bottom:16px;display:flex;justify-content:space-between;align-items:flex-end}
    h1{font-size:16pt;margin:0;color:var(--brand)}
    .sub{font-size:8.5pt;color:var(--slate-500)}
    table.meta{width:100%;border-collapse:collapse;margin-bottom:16px;font-size:9pt}
    table.meta td{padding:4px 8px;border:1px solid var(--slate-300)}
    table.meta th{background:var(--slate-100);text-align:left;padding:4px 8px;border:1px solid var(--slate-300);width:18%}
    table.data{width:100%;border-collapse:collapse;margin:12px 0;font-size:8.5pt}
    table.data th{background:var(--brand);color:var(--surface);padding:8px;border:1px solid var(--brand);text-align:left}
    table.data td{padding:8px;border:1px solid var(--slate-300);vertical-align:top}
    .badge-h{background:var(--danger-bg);color:var(--danger-dark);padding:2px 6px;border-radius:4px;font-weight:bold;font-size:8pt}
    .badge-m{background:var(--warning-bg);color:var(--warning-text);padding:2px 6px;border-radius:4px;font-weight:bold;font-size:8pt}
    .badge-l{background:var(--success-soft);color:var(--success-dark);padding:2px 6px;border-radius:4px;font-weight:bold;font-size:8pt}
    .sig-grid{display:grid;grid-template-columns:1fr 1fr 1fr;gap:20px;margin-top:28px;text-align:center;font-size:8.5pt}
    .sig-line{margin-top:50px;border-top:1px solid var(--black);font-weight:bold;padding-top:4px}
`,
  'public/assets/css/page/tools-kalkulator-biaya-k3.css': `
body{font-family:'Segoe UI',Arial,sans-serif;padding:32px;max-width:760px;margin:0 auto;color:var(--slate-900);line-height:1.5}
    h1{font-size:16pt;margin:0;color:var(--brand);border-bottom:2px solid var(--brand);padding-bottom:8px}
    .sub{font-size:8.5pt;color:var(--slate-500);margin:6px 0 16px}
    table{width:100%;border-collapse:collapse;margin:16px 0;font-size:10pt}
    th,td{border:1px solid var(--slate-300);padding:8px 12px;text-align:left}
    th{background:var(--slate-100);color:var(--brand)}
    .sig{margin-top:40px;display:grid;grid-template-columns:1fr 1fr;gap:40px;text-align:center;font-size:9pt}
    .line{margin-top:60px;border-top:1px solid var(--black);font-weight:bold}
`,
  'public/assets/css/page/tools-kalkulator-k3.css': `
/* PRINT STYLES */
@media print {
  body { background: var(--surface); color: var(--black); }
  .calc-hero, .pill-btn, .btn-row, nav, footer, .faq-box, .unit-toggle, .form-input, .k3-editorial-section { display: none !important; }
  .calc-wrapper { padding: 0; }
  .calc-grid { display: block; }
  .card-box { border: none; box-shadow: none; padding: 0; }
  .print-header { display: block !important; border-bottom: 2px solid var(--black); padding-bottom: 12px; margin-bottom: 20px; }
}
.print-header { display: none; }

body{font-family:'Segoe UI',Arial,sans-serif;padding:32px;max-width:760px;margin:0 auto;color:var(--slate-900);line-height:1.6}
    .header{border-bottom:3px solid var(--brand);padding-bottom:12px;margin-bottom:20px;display:flex;justify-content:space-between;align-items:flex-end}
    h1{font-size:18pt;margin:0;color:var(--brand)}
    .sub{font-size:9pt;color:var(--slate-500)}
    table{width:100%;border-collapse:collapse;margin:16px 0;font-size:10pt}
    th,td{border:1px solid var(--slate-300);padding:8px 12px;text-align:left}
    th{background:var(--slate-100);color:var(--brand)}
    .badge{display:inline-block;padding:2px 8px;border-radius:4px;font-weight:bold;background:var(--accent);color:var(--surface);font-size:8.5pt}
    .sig-grid{display:grid;grid-template-columns:1fr 1fr;gap:40px;margin-top:40px;text-align:center}
    .sig-line{margin-top:60px;border-top:1px solid var(--black);font-weight:bold}
`,
  'public/assets/css/page/tools-kalkulator-kebisingan.css': `
body{font-family:'Segoe UI',Arial,sans-serif;padding:32px;max-width:760px;margin:0 auto;color:var(--slate-900);line-height:1.5}
    h1{font-size:16pt;margin:0;color:var(--brand);border-bottom:2px solid var(--brand);padding-bottom:8px}
    .sub{font-size:8.5pt;color:var(--slate-500);margin:6px 0 16px}
    table{width:100%;border-collapse:collapse;margin:16px 0;font-size:9pt}
    th,td{border:1px solid var(--slate-300);padding:8px 10px;text-align:left}
    th{background:var(--slate-100);color:var(--brand)}
    .sig{margin-top:40px;display:grid;grid-template-columns:1fr 1fr;gap:40px;text-align:center;font-size:9pt}
    .line{margin-top:60px;border-top:1px solid var(--black);font-weight:bold}
`,
  'public/assets/css/page/tools-laporan-insiden.css': `
body{font-family:'Segoe UI',Arial,sans-serif;padding:32px;max-width:860px;margin:0 auto;color:var(--slate-900);line-height:1.5}
    h1{font-size:16pt;margin:0;color:var(--brand);border-bottom:2px solid var(--brand);padding-bottom:8px}
    .sub{font-size:8.5pt;color:var(--slate-500);margin:6px 0 16px}
    table{width:100%;border-collapse:collapse;margin:12px 0;font-size:9pt}
    th,td{border:1px solid var(--slate-300);padding:8px 10px;text-align:left}
    th{background:var(--slate-100);color:var(--brand);width:24%}
    .why-box{background:var(--slate-50);border:1px solid var(--slate-300);padding:10px;margin:6px 0;font-size:8.5pt}
    .sig{margin-top:40px;display:grid;grid-template-columns:1fr 1fr;gap:40px;text-align:center;font-size:9pt}
    .line{margin-top:60px;border-top:1px solid var(--black);font-weight:bold}
`,
  'public/assets/css/page/tools-risk-matrix.css': `
body{font-family:'Segoe UI',Arial,sans-serif;padding:32px;max-width:860px;margin:0 auto;color:var(--slate-900);line-height:1.5}
    h1{font-size:16pt;margin:0;color:var(--brand);border-bottom:2px solid var(--brand);padding-bottom:8px}
    .sub{font-size:8.5pt;color:var(--slate-500);margin:6px 0 16px}
    table{width:100%;border-collapse:collapse;margin-top:12px;font-size:9pt}
    th,td{border:1px solid var(--slate-300);padding:8px 10px;text-align:left}
    th{background:var(--slate-100);color:var(--brand)}
    .sig{margin-top:40px;display:grid;grid-template-columns:1fr 1fr;gap:40px;text-align:center;font-size:9pt}
    .line{margin-top:60px;border-top:1px solid var(--black);font-weight:bold}
`
};

for (const [file, content] of Object.entries(restores)) {
  const current = fs.readFileSync(file, 'utf8');
  fs.writeFileSync(file, current.trimEnd() + '\n' + content.trimStart(), 'utf8');
  console.log(`Restored trailing rules to ${file}`);
}
