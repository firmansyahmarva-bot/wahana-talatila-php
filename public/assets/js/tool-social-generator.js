/* Restored from the original tools/social-generator.php in origin/main. */

let currentAspect = '1:1';
let currentTheme = 'navy';

const slogans = {
  bulank3: {
    title: "BULAN K3 NASIONAL 2026",
    sub: "Wujudkan Budaya K3 Unggul Menuju Zero Incident & Produktivitas Berkelanjutan"
  },
  zero: {
    title: "TARGET ZERO ACCIDENT",
    sub: "Bekerja Selamat Hari Ini, Pulang Sehat Menemui Keluarga Tercinta"
  },
  apd: {
    title: "DISIPLIN PAKAI APD",
    sub: "Alat Pelindung Diri Adalah Nyawa Kedua Anda di Area Operasional"
  },
  height: {
    title: "BEKERJA DI KETINGGIAN",
    sub: "100% Tie-Off Lanyard Harness ke Anchor Point Aman Sebelum Bergerak"
  },
  housekeeping: {
    title: "BUDAYA 5S DI TEMPAT KERJA",
    sub: "Ringkas, Rapi, Resik, Rawat, Rajin: Kunci Lingkungan Bersih dan Bebas Insiden"
  }
};

function loadSlogan(key){
  const s = slogans[key];
  if(!s) return;
  document.querySelectorAll('.pill-group .pill-btn').forEach(b => b.classList.remove('active'));
  [...document.querySelectorAll('[onclick]')].find(button => button.getAttribute('onclick') === `loadSlogan('${key}')`)?.classList.add('active');

  document.getElementById('inpJudul').value = s.title;
  document.getElementById('inpSub').value = s.sub;
  drawPoster();
}

function setRatio(r){
  currentAspect = r;
  document.getElementById('btnRatio1').classList.toggle('active', r === '1:1');
  document.getElementById('btnRatio2').classList.toggle('active', r === '4:5');
  document.getElementById('btnRatio3').classList.toggle('active', r === '16:9');

  const canvas = document.getElementById('posterCanvas');
  if(r === '1:1'){ canvas.width = 800; canvas.height = 800; }
  else if(r === '4:5'){ canvas.width = 800; canvas.height = 1000; }
  else if(r === '16:9'){ canvas.width = 1200; canvas.height = 675; }

  drawPoster();
}

function setColorTheme(theme){
  currentTheme = theme;
  document.getElementById('btnColor1').classList.toggle('active', theme === 'navy');
  document.getElementById('btnColor2').classList.toggle('active', theme === 'forest');
  document.getElementById('btnColor3').classList.toggle('active', theme === 'danger');
  drawPoster();
}

function drawPoster(){
  const canvas = document.getElementById('posterCanvas');
  const ctx = canvas.getContext('2d');
  const w = canvas.width;
  const h = canvas.height;

  const judul = document.getElementById('inpJudul').value;
  const sub = document.getElementById('inpSub').value;
  const company = document.getElementById('inpCompany').value;

  // Background
  if(currentTheme === 'navy'){
    const grad = ctx.createLinearGradient(0, 0, w, h);
    grad.addColorStop(0, '#071524');
    grad.addColorStop(1, '#0D233A');
    ctx.fillStyle = grad;
    ctx.fillRect(0, 0, w, h);

    // Border line
    ctx.strokeStyle = '#E8611A';
    ctx.lineWidth = 14;
    ctx.strokeRect(20, 20, w - 40, h - 40);

    // Badge
    ctx.fillStyle = '#E8611A';
    ctx.fillRect(w / 2 - 120, 60, 240, 36);
    ctx.fillStyle = '#FFFFFF';
    ctx.font = 'bold 15px sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('SAFETY FIRST • K3 UTAMA', w / 2, 84);

    // Title
    ctx.fillStyle = '#FFFFFF';
    ctx.font = 'bold ' + (w > 1000 ? '44px' : '36px') + ' sans-serif';
    wrapText(ctx, judul, w / 2, h / 2 - 30, w - 120, 48);

    // Subtitle
    ctx.fillStyle = '#FFA573';
    ctx.font = '20px sans-serif';
    wrapText(ctx, sub, w / 2, h / 2 + 70, w - 140, 30);

    // Footer company
    ctx.fillStyle = '#CBD5E1';
    ctx.font = 'bold 16px sans-serif';
    ctx.fillText(company, w / 2, h - 60);

  } else if(currentTheme === 'forest'){
    ctx.fillStyle = '#06402B';
    ctx.fillRect(0, 0, w, h);

    ctx.strokeStyle = '#C8EF84';
    ctx.lineWidth = 14;
    ctx.strokeRect(20, 20, w - 40, h - 40);

    ctx.fillStyle = '#C8EF84';
    ctx.fillRect(w / 2 - 120, 60, 240, 36);
    ctx.fillStyle = '#04291B';
    ctx.font = 'bold 15px sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('ZERO INCIDENT • BUDAYA K3', w / 2, 84);

    ctx.fillStyle = '#FFFFFF';
    ctx.font = 'bold ' + (w > 1000 ? '44px' : '36px') + ' sans-serif';
    wrapText(ctx, judul, w / 2, h / 2 - 30, w - 120, 48);

    ctx.fillStyle = '#C8EF84';
    ctx.font = '20px sans-serif';
    wrapText(ctx, sub, w / 2, h / 2 + 70, w - 140, 30);

    ctx.fillStyle = '#E2E8F0';
    ctx.font = 'bold 16px sans-serif';
    ctx.fillText(company, w / 2, h - 60);

  } else {
    // Yellow Danger Theme
    ctx.fillStyle = '#FDE047';
    ctx.fillRect(0, 0, w, h);

    ctx.strokeStyle = '#000000';
    ctx.lineWidth = 14;
    ctx.strokeRect(20, 20, w - 40, h - 40);

    ctx.fillStyle = '#000000';
    ctx.fillRect(w / 2 - 120, 60, 240, 36);
    ctx.fillStyle = '#FDE047';
    ctx.font = 'bold 15px sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('PERINGATAN BAHAYA K3', w / 2, 84);

    ctx.fillStyle = '#000000';
    ctx.font = 'bold ' + (w > 1000 ? '44px' : '36px') + ' sans-serif';
    wrapText(ctx, judul, w / 2, h / 2 - 30, w - 120, 48);

    ctx.fillStyle = '#713F12';
    ctx.font = 'bold 20px sans-serif';
    wrapText(ctx, sub, w / 2, h / 2 + 70, w - 140, 30);

    ctx.fillStyle = '#000000';
    ctx.font = 'bold 16px sans-serif';
    ctx.fillText(company, w / 2, h - 60);
  }
}

function wrapText(ctx, text, x, y, maxWidth, lineHeight){
  const words = text.split(' ');
  let line = '';
  let curY = y;

  for(let n = 0; n < words.length; n++){
    const testLine = line + words[n] + ' ';
    const metrics = ctx.measureText(testLine);
    if(metrics.width > maxWidth && n > 0){
      ctx.fillText(line, x, curY);
      line = words[n] + ' ';
      curY += lineHeight;
    } else {
      line = testLine;
    }
  }
  ctx.fillText(line, x, curY);
}

function downloadPoster(){
  const canvas = document.getElementById('posterCanvas');
  const link = document.createElement('a');
  link.download = `Poster_K3_${Date.now()}.png`;
  link.href = canvas.toDataURL('image/png');
  link.click();
}

function toggleFaq(btn){
  btn.parentElement.classList.toggle('active');
}

window.addEventListener('DOMContentLoaded', () => {
  drawPoster();
});
