import fs from 'node:fs';
import { chromium } from 'playwright';

const dir='public/images/articles/k3-guides';
fs.mkdirSync(dir,{recursive:true});
const C={ink:'#17324b',green:'#087b61',blue:'#1764a5',red:'#c93636',yellow:'#ffd64a',muted:'#506579',line:'#ccd7e1',bg:'#f3f7fa'};
const esc=s=>String(s).replaceAll('&','&amp;').replaceAll('<','&lt;');
const text=(x,y,s,size=28,color=C.ink,weight=400,anchor='start')=>`<text x="${x}" y="${y}" font-family="Arial,sans-serif" font-size="${size}" fill="${color}" font-weight="${weight}" text-anchor="${anchor}">${esc(s)}</text>`;
const lines=(x,y,arr,size=25,color=C.muted)=>arr.map((s,i)=>text(x,y+i*(size+12),s,size,color)).join('');
const rect=(x,y,w,h,fill='white',r=16,stroke='none')=>`<rect x="${x}" y="${y}" width="${w}" height="${h}" rx="${r}" fill="${fill}" stroke="${stroke}" stroke-width="3"/>`;
const path=(d,color=C.ink,width=6,fill='none',extra='')=>`<path d="${d}" fill="${fill}" stroke="${color}" stroke-width="${width}" stroke-linecap="round" stroke-linejoin="round" ${extra}/>`;
const circle=(x,y,r,fill,stroke='none',w=4)=>`<circle cx="${x}" cy="${y}" r="${r}" fill="${fill}" stroke="${stroke}" stroke-width="${w}"/>`;
const arrow=(x,y,x2,y2,color=C.green)=>path(`M${x} ${y}L${x2} ${y2}`,color,6,'none','marker-end="url(#arrow)"');
function shell(title,subtitle,body,foot='Ilustrasi edukatif • Wahana Totalita • Baca penjelasan dan sumber pada artikel'){
 return `<svg xmlns="http://www.w3.org/2000/svg" width="1200" height="800" viewBox="0 0 1200 800" role="img" aria-labelledby="title desc"><title id="title">${esc(title)}</title><desc id="desc">${esc(subtitle)}</desc><defs><marker id="arrow" viewBox="0 0 10 10" refX="8" refY="5" markerWidth="4" markerHeight="4" orient="auto-start-reverse"><path d="M0 0L10 5L0 10z" fill="context-stroke"/></marker></defs>${rect(0,0,1200,800,C.bg,0)}${text(52,53,'PANDUAN K3',20,C.green,700)}${text(52,111,title,42,C.ink,700)}${text(52,155,subtitle,23,C.muted)}${body}${path('M52 737H1148',C.line,2)}${text(52,775,foot,18,C.muted)}</svg>`;
}
const assets=[];
function add(slug,title,subtitle,body,alt,foot){assets.push({slug,title,alt,svg:shell(title,subtitle,body,foot)});}
function cylinder(x,y,scale=1){return `<g transform="translate(${x} ${y}) scale(${scale})">${rect(0,38,78,140,C.red,16)}${rect(24,18,30,25,C.ink,3)}${path('M20 14H74M34 25H77',C.ink,8)}${circle(19,38,10,'white',C.ink,3)}${path('M68 38Q108 40 100 112',C.ink,7)}${rect(10,88,58,45,'white',2)}</g>`;}
// A label-first selection map supplements the realistic equipment comparison in the body.
{
 let b='';
 const cards=[['Air / water','Bahan padat biasa',['Periksa rating alat.','Bukan untuk listrik aktif.']],['Powder','ABC berbeda dari BC',['Baca kelas pada label.','Bukan semua logam.']],['CO2','Sesuai rating produk',['Kenali corong pelepas.','Perhatikan ruang pemakaian.']],['Media khusus','Risiko khusus',['Minyak masak atau logam:','pilih produk yang sesuai.']]];
 cards.forEach((a,i)=>{const x=52+(i%2)*560,y=198+Math.floor(i/2)*235;b+=rect(x,y,536,212)+cylinder(x+26,y+24,.7)+text(x+126,y+48,a[0],32,C.ink,700)+text(x+126,y+90,a[1],25,C.green,700)+lines(x+126,y+134,a[2],22);});
 b+=text(600,710,'Pilih dari media dan rating pada label — bukan warna tabung.',27,C.ink,700,'middle');
 add('jenis-apar-dan-fungsinya','Jenis APAR: mulai dari label','Cocokkan bahan yang terbakar, rating alat, dan kondisi area.',b,'Peta pemilihan APAR: air untuk bahan padat sesuai rating, powder ABC atau BC dibedakan, CO2 sesuai label, dan media khusus untuk risiko tertentu.');
}
// Five original, simplified educational sign examples. These are not certified masters.
{
 const sign=(type,cx,cy)=>{
  if(type===0)return circle(cx,cy,62,'white',C.red,10)+path(`M${cx-30} ${cy+8}H${cx+30}M${cx+25} ${cy-13}v-20`,C.ink,12)+path(`M${cx-44} ${cy-44}L${cx+44} ${cy+44}`,C.red,11);
  if(type===1)return circle(cx,cy,65,C.blue)+path(`M${cx-40} ${cy+23}h80M${cx-31} ${cy+14}v-9a31 31 0 0 1 62 0v9M${cx} ${cy-28}v35`,'white',8);
  if(type===2)return `<polygon points="${cx},${cy-66} ${cx+70},${cy+55} ${cx-70},${cy+55}" fill="${C.yellow}" stroke="${C.ink}" stroke-width="7"/>${path(`M${cx+10} ${cy-32}l-30 45h23l-13 30 36-49h-24z`,C.ink,1,C.ink)}`;
  if(type===3)return rect(cx-65,cy-65,130,130,C.green,0)+rect(cx-12,cy-42,24,84,'white',0)+rect(cx-42,cy-12,84,24,'white',0);
  return rect(cx-65,cy-65,130,130,C.red,0)+rect(cx-18,cy-22,38,62,'white',6)+path(`M${cx-5} ${cy-29}v-15h28M${cx+21} ${cy-23}q30 0 29 33`,'white',7);
 };
 let b='';const labels=[['Larangan','Jangan merokok'],['Kewajiban','Pakai pelindung kepala'],['Peringatan','Bahaya listrik'],['Kondisi aman','Pertolongan pertama'],['Pemadam','Lokasi APAR']];
 labels.forEach((a,i)=>{const x=i<3?52+i*374:239+(i-3)*374,y=i<3?194:456;b+=rect(x,y,348,240)+sign(i,x+174,y+83)+text(x+174,y+180,a[0],29,C.ink,700,'middle')+text(x+174,y+216,a[1],22,C.muted,400,'middle');});
 add('rambu-k3','Baca bentuk, warna, dan simbol','Satu warna dapat memiliki fungsi berbeda. Kenali kelima kelompok.',b,'Lima contoh rambu edukatif: larangan merokok merah, kewajiban helm biru, peringatan listrik segitiga kuning, P3K hijau, lokasi APAR merah.','Contoh edukasi, bukan master rambu sesuai standar • Wahana Totalita');
}
{
 const rows=[['1','Ringkas','Pilih yang diperlukan'],['2','Rapi','Tetapkan tempatnya'],['3','Resik','Bersihkan, cari sumbernya'],['4','Rawat','Buat standar area'],['5','Rajin','Periksa dan tindak lanjuti']];let b='';
 rows.forEach((r,i)=>{const y=193+i*101;b+=rect(52,y,1096,86)+circle(99,y+43,27,C.green)+text(99,y+53,r[0],27,'white',700,'middle')+text(154,y+55,r[1],31,C.ink,700)+text(450,y+55,r[2],29,C.muted);});
 b+=text(600,727,'Tata area → sepakati standar → jaga konsistensi.',25,C.green,700,'middle');
 add('5r-adalah','5R: bukan bersih-bersih sekali','Lima langkah yang menghubungkan penataan dan kebiasaan kerja.',b,'Lima langkah 5R: Ringkas memilih barang; Rapi menentukan tempat; Resik membersihkan dan mencari sumber; Rawat membuat standar; Rajin memeriksa dan menindaklanjuti.');
}
{
 let b=path('M600 232L830 555H370Z',C.red,14)+text(600,426,'API',48,C.red,700,'middle');
 b+=rect(428,183,344,95)+text(600,225,'PANAS',30,C.ink,700,'middle')+text(600,259,'Kendalikan penyalaan',23,C.muted,400,'middle');
 b+=rect(72,530,420,112)+text(282,576,'BAHAN BAKAR',30,C.ink,700,'middle')+text(282,615,'Atur bahan dan penyimpanan',23,C.muted,400,'middle');
 b+=rect(708,530,420,112)+text(918,576,'OKSIGEN',30,C.ink,700,'middle')+text(918,615,'Pengendalian khusus proses',23,C.muted,400,'middle');
 b+=text(600,698,'Tetrahedron menambahkan reaksi berantai kimia.',27,C.green,700,'middle');
 add('segitiga-api','Segitiga api: tiga unsur','Pahami kombinasi unsur sebelum memilih pengendalian.',b,'Diagram segitiga api: panas di puncak, bahan bakar dan oksigen di dua sudut bawah; tetrahedron menambahkan reaksi berantai kimia.');
}
function person(cx,cy,color=C.blue){return circle(cx,cy,18,color)+path(`M${cx} ${cy+22}v60m0-38-30 28m30-28 28 25m-28 13-25 48m25-48 28 48`,color,12);}
function rack(x,y){return path(`M${x} ${y}v220m170-220v220m-170-155h170m-170 115h170`,C.muted,10);}
{
 let b='';const titles=['KONDISI BAHAYA','NEAR MISS','ADA CEDERA'];const notes=[['Kotak belum jatuh.','Ada potensi kejadian.'],['Kotak jatuh di dekat orang.','Tanpa cedera/kerusakan.'],['Kotak mengenai orang.','Dampak sudah terjadi.']];
 titles.forEach((s,i)=>{const x=52+i*374;b+=rect(x,200,348,470)+text(x+174,248,s,24,i===2?C.red:C.ink,700,'middle')+rack(x+35,290)+person(x+263,380);if(i===0)b+=rect(x+154,310,68,51,C.yellow,3,C.ink);if(i===1)b+=rect(x+150,466,68,51,C.yellow,3,C.ink)+arrow(x+186,355,x+177,445,C.red);if(i===2)b+=rect(x+214,418,58,47,C.yellow,3,C.ink)+path(`M${x+274} 425l15-14m-12 31h21`,C.red,5);b+=lines(x+24,590,notes[i],21);});
 b+=text(600,715,'Pisahkan kondisi, kejadian, dan dampak dalam laporan.',26,C.green,700,'middle');
 add('near-miss','Near miss atau kondisi bahaya?','Skenario latihan yang sama, tetapi kejadian dan dampaknya berbeda.',b,'Tiga panel: kotak tidak stabil tetapi belum jatuh; kotak jatuh dekat pekerja tanpa dampak; kotak mengenai pekerja dan terjadi cedera.');
}
{
 let b='';const steps=[['PULL','Tarik pin',['Kenali pengaman','pada model alat.']],['AIM','Arahkan nozzle',['Ke pangkal api,','ikuti jarak pada label.']],['SQUEEZE','Tekan tuas',['Pegang bagian','yang dirancang aman.']],['SWEEP','Sapukan',['Pada area pangkal;','jaga jalan keluar.']]];
 steps.forEach((a,i)=>{const x=52+(i%2)*560,y=193+Math.floor(i/2)*231;b+=rect(x,y,536,212)+circle(x+42,y+40,23,C.green)+text(x+42,y+48,String(i+1),23,'white',700,'middle')+text(x+82,y+48,a[0],30,C.ink,700)+text(x+27,y+95,a[1],29,C.ink,700)+lines(x+27,y+140,a[2],23);if(i===0)b+=path(`M${x+408} ${y+76}h52m-52 0v35`,C.ink,7)+circle(x+400,y+76,13,'none',C.red,5)+arrow(x+390,y+50,x+350,y+50,C.red);if(i===1)b+=path(`M${x+365} ${y+85}l55 27`,C.ink,10)+arrow(x+427,y+117,x+481,y+146,C.red);if(i===2)b+=path(`M${x+372} ${y+108}h97m-97-36 97 24`,C.ink,10)+arrow(x+445,y+34,x+445,y+79,C.red);if(i===3)b+=path(`M${x+365} ${y+130}q54-68 108 0`,C.red,6,'none','marker-start="url(#arrow)" marker-end="url(#arrow)"');});
 b+=text(600,702,'Sebelum PASS: alarm • alat sesuai • terlatih • jalur keluar aman',24,C.red,700,'middle');
 add('cara-menggunakan-apar','PASS: urutan memakai APAR','Pengingat operasi; bukan pengganti latihan dan petunjuk alat.',b,'Empat panel PASS: tarik pin, arahkan ke pangkal api, tekan tuas, sapukan. Syarat awal: alarm, alat sesuai, pengguna terlatih, jalan keluar aman.');
}
{
 let b=rect(64,212,215,280)+text(171,256,'SUMBER',29,C.ink,700,'middle')+text(171,292,'Netral dibumikan',19,C.muted,400,'middle');
 b+=rect(358,230,170,270,'white',14,C.line)+text(443,269,'RCD',32,C.ink,700,'middle')+text(443,475,'Memantau L + N',18,C.muted,400,'middle');
 b+=rect(789,246,325,280,'white',18,C.ink)+text(951,286,'BODI LOGAM',28,C.ink,700,'middle')+rect(869,330,126,100,C.bg,8)+text(932,390,'Beban',24,C.ink,400,'middle');
 b+=path('M225 333H869',C.red,7)+path('M225 430H869',C.blue,7)+text(304,319,'L',24,C.red,700)+text(304,464,'N',24,C.blue,700);
 b+=path('M995 360H1064V526',C.red,5,'none','stroke-dasharray="10 9"')+text(951,318,'Gangguan isolasi',18,C.red,700,'middle');
 b+=path('M1064 526V604H975V626',C.green,8)+text(1078,580,'PE',28,C.green,700);
 b+=path('M225 430V626',C.blue,6)+circle(225,430,7,C.blue);
 const earth=(x,y)=>path(`M${x} ${y}v16m-28 0h56m-45 12h34m-26 12h18`,C.green,5);
 b+=earth(225,626)+earth(975,626)+path('M955 680H245',C.red,4,'none','stroke-dasharray="9 9" marker-end="url(#arrow)"')+text(600,657,'Jalur gangguan melalui bumi menuju sumber',21,C.red,400,'middle');
 b+=text(171,717,'Elektroda sumber',19,C.muted,400,'middle')+text(975,717,'Elektroda instalasi',19,C.muted,400,'middle');
 add('grounding-listrik','Grounding + proteksi: satu sistem','Konsep TT disederhanakan. PE terpisah dari netral pada instalasi ini.',b,'Skema konseptual TT: fase dan netral melewati RCD menuju beban; bodi terhubung PE ke elektroda instalasi, netral sumber dibumikan terpisah; jalur gangguan kembali melalui bumi.','Bukan diagram pemasangan • Susunan TT/TN/IT berbeda • Tidak untuk dirakit sendiri');
}
{
 let b='';
 [0,1].forEach(i=>{const x=52+i*560;b+=rect(x,205,536,435)+text(x+268,257,i===0?'TINDAKAN':'KONDISI',31,C.ink,700,'middle')+path(`M${x+45} 528H${x+490}`,C.muted,5);if(i===0){b+=path(`M${x+180} 386v142m95-142v142M${x+180} 399h95`,C.red,9)+person(x+237,342)+arrow(x+310,397,x+410,397,C.red)+lines(x+28,585,['Melangkahi pembatas area.','Amati tindakan, cari konteks.'],24);}else{b+=rect(x+178,428,116,99,C.yellow,3,C.ink)+rect(x+306,465,92,62,C.yellow,3,C.ink)+path(`M${x+110} 339v189m325-189v189`,C.green,7)+lines(x+28,585,['Kotak menutup jalur.','Amati keadaan dan paparannya.'],24);}});
 b+=text(600,691,'Perbaikan: fakta → penyebab → kontrol → verifikasi',27,C.green,700,'middle');
 add('unsafe-action-unsafe-condition','Tindakan atau kondisi tidak aman?','Keduanya bisa terkait. Kategori bukan penetapan siapa yang bersalah.',b,'Perbandingan: tindakan orang melangkahi pembatas versus kondisi kotak menghalangi jalur; langkah perbaikan menelusuri fakta, penyebab, kontrol dan verifikasi.');
}

const browser=await chromium.launch({channel:'chrome'});
const page=await browser.newPage({viewport:{width:1200,height:800},deviceScaleFactor:1});
const visualPath='src/data/article-visuals.json';
const visuals=JSON.parse(fs.readFileSync(visualPath,'utf8'));
for(const asset of assets){
 fs.writeFileSync(`${dir}/${asset.slug}.svg`,asset.svg);
 await page.setContent(`<style>body{margin:0}svg{display:block}</style>${asset.svg}`);
 await page.screenshot({path:`${dir}/${asset.slug}.png`});
 visuals[asset.slug]={src:`/images/articles/k3-guides/${asset.slug}.png`,alt:asset.alt,title:asset.title,width:1200,height:800};
}
const generated=[
 {name:'apar-equipment',path:'C:/Users/ASUS/.codex/generated_images/01a16f6d-1888-7981-b783-ec58a325a1c8/exec-84aaa495-6165-4390-b6bd-c1bda8a7e648.png'},
 {name:'5r-before-after',path:'C:/Users/ASUS/.codex/generated_images/01a16f6d-1888-7981-b783-ec58a325a1c8/exec-9bb832a2-d694-4a99-9b01-8ac96273df84.png'}
];
for(const asset of generated){
 const result=await page.evaluate(async(data)=>{const img=new Image();img.src=data;await img.decode();const c=document.createElement('canvas');c.width=1200;c.height=Math.round(img.height*1200/img.width);c.getContext('2d').drawImage(img,0,0,c.width,c.height);return{data:c.toDataURL('image/webp',.87).split(',')[1],height:c.height};},'data:image/png;base64,'+fs.readFileSync(asset.path).toString('base64'));
 fs.writeFileSync(`${dir}/${asset.name}.webp`,Buffer.from(result.data,'base64'));
 if(asset.name==='5r-before-after'){
  const p='data/articles/5r-adalah.json';const article=JSON.parse(fs.readFileSync(p,'utf8'));
  article.content=article.content.replace(/(5r-before-after\.webp[^>]+width="1200" height=")800/g,`$1${result.height}`);
  fs.writeFileSync(p,JSON.stringify(article,null,4)+'\n');
 }
}
fs.writeFileSync(visualPath,JSON.stringify(visuals,null,2)+'\n');
await browser.close();
console.log(`Saved ${assets.length} educational diagrams and ${generated.length} optimized generated illustrations.`);
