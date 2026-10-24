import fs from 'node:fs';
import assert from 'node:assert/strict';
import { chromium } from 'playwright';

const dir='output/k3-gap-articles';
fs.mkdirSync(dir,{recursive:true});
const manifest=['jenis-apar-dan-fungsinya','rambu-k3','5r-adalah','segitiga-api','near-miss','cara-menggunakan-apar','grounding-listrik','unsafe-action-unsafe-condition'].map(slug=>({slug}));
const browser=await chromium.launch({channel:'chrome'});
const page=await browser.newPage();
const results=[];
const inlineAssets=html=>html.replace(/<link[^>]+href="([^"]+\.css[^"]*)"[^>]*>/g,(tag,url)=>{
 const p='dist'+url.split('?')[0];return fs.existsSync(p)?'<style>'+fs.readFileSync(p,'utf8')+'</style>':tag;
}).replace(/src="(\/[^"?]+\.(?:png|webp|svg|jpg))(?:\?[^"]*)?"/g,(tag,url)=>{
 const p='dist'+url;return fs.existsSync(p)?`src="data:image/${url.endsWith('.svg')?'svg+xml':url.split('.').pop()};base64,${fs.readFileSync(p).toString('base64')}"`:tag;
}).replace(/<script(?![^>]*type="application\/ld\+json")[^>]*>[\s\S]*?<\/script>/g,'');
const ids=fs.readdirSync('data/articles').filter(f=>f.endsWith('.json')).map(f=>JSON.parse(fs.readFileSync('data/articles/'+f,'utf8')).id);
assert.equal(new Set(ids).size,ids.length,'Article IDs must be unique');
const sitemap=fs.readFileSync('dist/sitemap-0.xml','utf8');
for(const {slug} of manifest){
 const article=JSON.parse(fs.readFileSync(`data/articles/${slug}.json`,'utf8'));
 assert(article.meta_title.length>=30&&article.meta_title.length<=65);
 assert(article.meta_desc.length>=70&&article.meta_desc.length<=160);
 assert(sitemap.includes(`/artikel/${slug}/`),'Missing sitemap URL');
 for(const m of article.content.matchAll(/(?:href|src)="(\/[^"#]+)(?:#[^"]*)?"/g)){
  const target='dist'+m[1];assert(fs.existsSync(target)||fs.existsSync(target+'index.html'),`Missing ${m[1]}`);
 }
 let html=inlineAssets(fs.readFileSync(`dist/artikel/${slug}/index.html`,'utf8'));
 for(const width of [1440,390]){
  await page.setViewportSize({width,height:900});
  await page.setContent(html,{waitUntil:'domcontentloaded'});
  await page.locator('#article-content').evaluate(async node=>{for(const img of node.querySelectorAll('img')){img.loading='eager';await img.decode();}});
  const data=await page.evaluate(()=>({width:innerWidth,overflow:document.documentElement.scrollWidth>innerWidth,h1:document.querySelectorAll('h1').length,title:document.title,canonical:document.querySelector('link[rel=canonical]')?.href,ogImage:document.querySelector('meta[property="og:image"]')?.content,images:[...document.querySelectorAll('.ar-article-image img,#article-content img')].map(i=>({alt:i.alt,loaded:i.complete&&i.naturalWidth>0,width:i.width,height:i.height})),schemas:[...document.querySelectorAll('script[type="application/ld+json"]')].flatMap(s=>{const d=JSON.parse(s.textContent);return Array.isArray(d)?d:[d];}),anchors:[...document.querySelectorAll('#article-content a[href^="#"]')].every(a=>!!document.getElementById(a.hash.slice(1)))}));
  assert.equal(data.overflow,false,`${slug} overflow at ${width}`);
  assert.equal(data.h1,1);
  assert.equal(data.canonical,`https://wahanatotalita.com/artikel/${slug}/`);
  assert(data.ogImage.endsWith(`/k3-guides/${slug}.png`));
  assert(data.images.every(i=>i.loaded&&i.alt));
  assert(data.schemas.some(s=>s['@type']==='Article'));
  assert(data.schemas.some(s=>s['@type']==='BreadcrumbList'));
  assert(data.schemas.some(s=>s['@type']==='FAQPage'&&s.mainEntity.length===article.faq_list.length));
  assert(data.anchors);
  await page.screenshot({path:`${dir}/${slug}-${width}.png`,fullPage:true});
  results.push({slug,...data,schemas:data.schemas.map(s=>s['@type'])});
 }
}
await page.setViewportSize({width:1200,height:1600});
await page.setContent('<style>body{margin:0;display:grid;grid-template-columns:repeat(2,600px)}img{width:600px;height:400px}</style>'+manifest.map(({slug})=>`<img src="data:image/png;base64,${fs.readFileSync(`public/images/articles/k3-guides/${slug}.png`).toString('base64')}" alt="${slug}">`).join(''));
await page.screenshot({path:`${dir}/visual-contact-sheet.png`,fullPage:true});
await page.setContent(fs.readFileSync('public/downloads/form-laporan-near-miss.html','utf8'));
await page.locator('[contenteditable]').first().fill('Uji laporan: waktu dan lokasi');
assert.equal(await page.locator('[contenteditable]').first().textContent(),'Uji laporan: waktu dan lokasi');
await page.emulateMedia({media:'print'});
assert.equal(await page.locator('.nm-form-controls').isVisible(),false);
await page.screenshot({path:`${dir}/near-miss-form-print.png`,fullPage:true});
await browser.close();
fs.writeFileSync(`${dir}/verification.json`,JSON.stringify({date:'2026-10-25',results,form:'Edit and print checks passed'},null,2));
console.log(`Passed ${manifest.length} articles at desktop and mobile: local links, assets, alt text, H1, metadata, canonical, social image, schemas, sitemap, IDs, overflow; editable/printable near-miss form.`);
