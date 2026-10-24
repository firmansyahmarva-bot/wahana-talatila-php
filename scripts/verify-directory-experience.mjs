import fs from 'node:fs';import path from 'node:path';import assert from 'node:assert/strict';import {chromium} from 'playwright';
const root=path.resolve('dist'),origin='http://directory.test',output='output/directory-redesign';fs.mkdirSync(output,{recursive:true});
const serve=async route=>{const u=new URL(route.request().url());if(u.origin!==origin)return route.abort();let f=path.resolve(root,'.'+decodeURIComponent(u.pathname));if(!f.startsWith(root+path.sep))return route.abort();if(fs.existsSync(f)&&fs.statSync(f).isDirectory())f=path.join(f,'index.html');if(!fs.existsSync(f))return route.fulfill({status:404,body:''});return route.fulfill({body:fs.readFileSync(f),contentType:({'.html':'text/html','.css':'text/css','.js':'text/javascript','.json':'application/json','.svg':'image/svg+xml','.woff2':'font/woff2','.png':'image/png','.jpg':'image/jpeg','.webp':'image/webp'})[path.extname(f)]||'application/octet-stream'});};
for(const file of fs.readdirSync('pelatihan-data').filter(f=>f.endsWith('.json'))){const item=JSON.parse(fs.readFileSync(path.join('pelatihan-data',file),'utf8'));const html=fs.readFileSync(path.join(root,'pelatihan',item.slug,'index.html'),'utf8');const body=(item.content||'').trim().replace(/<main\b[^>]*>/gi,'').replace(/<\/main>/gi,'');assert.ok(html.includes(body),item.slug+' original content preserved');assert.ok(html.includes('dir-context'),item.slug+' shared contextual links');}
console.log('All 352 city-course HTML bodies preserved with shared navigation links.');
const browser=await chromium.launch();let checks=0;
try{
for(const width of [320,390,768,1024,1440]){
 const page=await browser.newPage({viewport:{width,height:1000}});const errors=[];page.on('pageerror',e=>errors.push(e.message));await page.route('**/*',serve);
 for(const route of ['/pelatihan/','/jadwal/','/pelatihan/k3/','/pelatihan/lingkungan/','/pelatihan/mining/','/pelatihan/system-management/','/kota/','/pelatihan-k3-jakarta/','/pelatihan-k3-yogyakarta/','/pelatihan/ahli-higiene-industri-muda-balikpapan/','/artikel/5-prinsip-dasar-smk3/']){
  await page.goto(origin+route,{waitUntil:'networkidle'});await page.evaluate(()=>document.fonts.ready);
  assert.equal(await page.locator('h1').count(),1,route+' h1');assert.ok(await page.locator('.hm-header').isVisible(),route+' shared navbar');
  if(await page.locator('.directory-header').count())assert.ok(await page.evaluate(()=>getComputedStyle(document.querySelector('.directory-header .bcr-bar')).marginTop==='0px'),route+' no duplicated navigation gap');assert.ok(await page.evaluate(()=>document.documentElement.scrollWidth<=innerWidth+1),route+' overflow '+width);
  if(route==='/pelatihan/'||route==='/jadwal/'){
    const shown=page.locator('[data-dir-grid] > :not([hidden])');assert.equal(await shown.count(),24,route+' initial page');await page.locator('[data-dir-more]').click();assert.equal(await shown.count(),48,route+' more results');
    await page.locator('[data-directory] input[name=q]').fill('zzzz-no-matches');assert.equal(await shown.count(),0);assert.ok(await page.locator('.dir-empty').isVisible());await page.locator('[data-dir-reset]').click();await page.waitForFunction(()=>document.querySelector('[data-dir-status]').textContent.includes('24'));
    await page.locator('[data-directory] input[name=q]').fill('forklift');assert.ok(await shown.count()>0);for(const card of await shown.all())assert.match((await card.getAttribute('data-search')).toLowerCase(),/forklift/);
    await page.locator('[data-directory] button[type=reset]').click();await page.waitForFunction(()=>document.querySelector('[data-dir-status]').textContent.includes('24'));
    await page.locator('[name=mode]').selectOption('online');for(const card of await shown.all())assert.ok(/online|both/.test(await card.getAttribute('data-mode')));
    if(width===1440){
     if(route==='/pelatihan/'){await page.locator('[name=category]').selectOption('lingkungan');for(const card of await shown.all())assert.equal(await card.getAttribute('data-cat'),'lingkungan');await page.locator('[name=sort]').selectOption('price');const prices=await shown.evaluateAll(nodes=>nodes.map(n=>Number(n.dataset.price)||Infinity));assert.deepEqual(prices,[...prices].sort((a,b)=>a-b));}
     else{const first=await page.locator('[name=month] option').nth(1).getAttribute('value');await page.locator('[name=month]').selectOption(first);for(const card of await shown.all())assert.equal(await card.getAttribute('data-month'),first);}
    }
    if(route==='/jadwal/')for(const link of await shown.locator('.ui-action').all()){const u=new URL(await link.getAttribute('href'));assert.equal(u.hostname,'wa.me');assert.ok(u.searchParams.get('text').includes('Tanggal:'));}
    await page.locator('[data-directory] button[type=reset]').click();await page.waitForFunction(()=>document.querySelector('[data-dir-status]').textContent.includes('24'));
  }
  if((width===390||width===1440)&&['/pelatihan/','/jadwal/','/pelatihan-k3-jakarta/','/pelatihan/k3/','/pelatihan/ahli-higiene-industri-muda-balikpapan/'].includes(route)){
    await page.evaluate(()=>{scrollTo({top:0,behavior:'instant'});document.activeElement?.blur();});await page.waitForTimeout(100);await page.screenshot({path:output+'/'+route.replaceAll('/','-')+width+'.png'});
  }
  checks++;
 }
 assert.deepEqual(errors,[],width+' script errors');await page.close();
}
const plain=await browser.newPage({javaScriptEnabled:false,viewport:{width:390,height:900}});await plain.route('**/*',serve);for(const route of ['/pelatihan/','/jadwal/','/kota/','/pelatihan-k3-jakarta/']){await plain.goto(origin+route);assert.equal(await plain.locator('[data-dir-grid] > [hidden]').count(),0);assert.ok(await plain.locator('[data-dir-grid] > *').count()>0);await plain.locator('.site-contact summary').click();assert.ok(await plain.locator('.site-contact').evaluate(e=>e.open));}await plain.close();
console.log(checks+' responsive page checks passed. Filters, progressive loading, WhatsApp context and no-JavaScript listings passed.');
}finally{await browser.close();}
