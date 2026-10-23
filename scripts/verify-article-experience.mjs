import fs from 'node:fs';
import path from 'node:path';
import assert from 'node:assert/strict';
import {chromium} from 'playwright';
const root=path.resolve('dist'),out='output/article-redesign';fs.mkdirSync(out,{recursive:true});
const baseline=JSON.parse(fs.readFileSync('output/course-redesign/seo-baseline.json','utf8'));
const metadata=html=>[...html.matchAll(/<meta\b[^>]*>|<title>[\s\S]*?<\/title>|<link\b[^>]*rel="(?:canonical|alternate)"[^>]*>/g)].map(m=>m[0]);
const clean=value=>value.replace(/<[^>]+>/g,' ').replace(/\s+/g,' ').trim();
const snap=html=>({metadata:metadata(html.match(/<head>([\s\S]*?)<\/head>/)?.[1]||''),h1:[...html.matchAll(/<h1\b[^>]*>([\s\S]*?)<\/h1>/g)].map(m=>clean(m[1])),schemas:[...html.matchAll(/<script[^>]*type="application\/ld\+json"[^>]*>([\s\S]*?)<\/script>/g)].map(m=>m[1])});
for(const [file,before] of Object.entries(baseline)){const current=fs.readFileSync(path.join(root,file),'utf8');assert.deepEqual(snap(current),{...before,h1:before.h1.map(clean)},file+' SEO unchanged');}
console.log('SEO metadata, H1 text and schemas unchanged across '+Object.keys(baseline).length+' existing pages.');
const source=fs.readdirSync('data/articles').filter(f=>f.endsWith('.json')).map(f=>JSON.parse(fs.readFileSync(path.join('data/articles',f),'utf8')));
const stripIds=s=>s.replace(/(<h[23]\b[^>]*?) id="[^"]*"/g,'$1').trim();
for(const a of source){const html=fs.readFileSync(path.join(root,'artikel',a.slug,'index.html'),'utf8');const body=html.match(/<div class="ar-prose article-body" id="article-content">([\s\S]*?)<\/div>\s*(?:<section|<div|<\/div>)/)?.[1];assert.ok(body,a.slug+' body');assert.ok(stripIds(html).includes(stripIds(a.content||'')),a.slug+' full original HTML');const ids=[...html.matchAll(/\bid="([^"]+)"/g)].map(m=>m[1]);assert.equal(ids.length,new Set(ids).size,a.slug+' unique IDs');const related=html.match(/<section class="ar-related[\s\S]*?<\/section>/)?.[0]||'';assert.ok(!related.includes('href="/artikel/'+a.slug+'/"'),a.slug+' no self related');}
console.log(source.length+' article bodies preserved; IDs unique and no self recommendations.');
const seen=new Set(),queue=['/artikel/'],reachable=new Set();
while(queue.length){
 const url=queue.shift();if(seen.has(url))continue;seen.add(url);
 const html=fs.readFileSync(path.join(root,url,'index.html'),'utf8');
 assert.ok((html.match(/class="ar-card"/g)||[]).length<=24,url+' bounded archive');
 if(url.includes('/halaman/'))assert.ok(html.includes('href="https://wahanatotalita.com'+url+'"'),url+' self canonical');
 for(const match of html.matchAll(/href="(\/artikel\/[^"#?]*)"/g)){
  const href=match[1],file=path.join(root,href,'index.html');assert.ok(fs.existsSync(file),href+' exists');
  if(fs.readFileSync(file,'utf8').includes('class="editorial ar-archive"'))queue.push(href);else reachable.add(href);
 }
}
assert.equal(reachable.size,source.length);console.log('All articles reachable through '+seen.size+' crawlable archive pages.');
const index=JSON.parse(fs.readFileSync(path.join(root,'api/article-search.json'),'utf8'));assert.equal(index.length,source.length);console.log('Search index '+Math.round(fs.statSync(path.join(root,'api/article-search.json')).size/1024)+' KB.');
const origin='http://articles.test';const browser=await chromium.launch();let checks=0,indexRequests=0;
try{
for(const width of [320,390,768,1440]){
 const page=await browser.newPage({viewport:{width,height:1000}});const errors=[];page.on('pageerror',e=>errors.push(e.message));
 await page.route('**/*',async route=>{const u=new URL(route.request().url());if(u.origin!==origin)return route.abort();if(u.pathname==='/api/article-search.json')indexRequests++;let file=path.resolve(root,'.'+decodeURIComponent(u.pathname));if(!file.startsWith(root+path.sep))return route.abort();if(fs.existsSync(file)&&fs.statSync(file).isDirectory())file=path.join(file,'index.html');if(!fs.existsSync(file))return route.fulfill({status:404,body:''});return route.fulfill({body:fs.readFileSync(file),contentType:({'.html':'text/html','.css':'text/css','.js':'text/javascript','.json':'application/json','.svg':'image/svg+xml','.woff2':'font/woff2','.png':'image/png','.webp':'image/webp'})[path.extname(file)]||'application/octet-stream'});});
 for(const route of ['/artikel/','/artikel/halaman/2/','/artikel/k3/','/artikel/5-prinsip-dasar-smk3/','/artikel/ahli-k3-kimia-tugas-sertifikasi/']){
  await page.goto(origin+route,{waitUntil:'networkidle'});await page.evaluate(()=>document.fonts.ready);assert.equal(await page.locator('h1').count(),1);assert.ok(await page.evaluate(()=>document.documentElement.scrollWidth<=innerWidth+1),width+' overflow '+route);
  if(route==='/artikel/'){
   const initial=indexRequests;assert.equal(await page.locator('.ar-archive-content .ar-card').count(),24);await page.locator('.ar-search input').fill('SMK3');await page.waitForFunction(()=>document.querySelector('.ar-search-status').textContent.includes('ditemukan'));assert.equal(indexRequests,initial+1);assert.ok(await page.locator('.ar-search-card').count()>0);
   await page.locator('.ar-search input').fill('k3');await page.waitForFunction(()=>!!document.querySelector('.ar-search-more'));await page.locator('.ar-search-more').click();assert.equal(await page.locator('.ar-search-card').count(),48);
   await page.locator('.ar-search input').fill('');await page.waitForFunction(()=>!document.querySelector('.ar-archive-content').hidden);
  }
  if(route.includes('5-prinsip')){
   const toc=page.locator('.ar-toc');assert.equal(await toc.evaluate(e=>e.open),width>=1000);if(width<1000)await toc.locator('summary').click();await toc.locator('a').first().click();assert.ok(new URL(page.url()).hash);await page.evaluate(()=>scrollTo(0,0));
   const contact=page.locator('.site-contact');await contact.locator('summary').click();assert.ok(await contact.evaluate(e=>e.open));const box=await page.locator('.contact-panel').boundingBox();assert.ok(box.x>=0&&box.x+box.width<=width+1&&box.y>=0,'panel bounds '+width);assert.ok((await page.locator('.contact-panel .home-wa-float').getAttribute('href')).includes('artikel'));await page.keyboard.press('Escape');assert.equal(await contact.evaluate(e=>e.open),false);
   if(width===390||width===1440){await page.screenshot({path:out+'/reader-'+width+'.png'});await contact.locator('summary').click();await page.screenshot({path:out+'/contact-'+width+'.png'});await page.keyboard.press('Escape');}
  }
  if(route==='/artikel/'&&(width===390||width===1440))await page.screenshot({path:out+'/archive-'+width+'.png',fullPage:true});checks++;
 }
 assert.deepEqual(errors,[]);await page.close();
}
}finally{await browser.close();}
console.log(checks+' responsive reader/archive checks passed, including search, TOC and contact panel.');
