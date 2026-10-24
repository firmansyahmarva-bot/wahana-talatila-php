import fs from 'node:fs';import path from 'node:path';import assert from 'node:assert/strict';import {chromium} from 'playwright';
const root=path.resolve('dist'),output='output/analytics-verification';fs.mkdirSync(output,{recursive:true});
if(process.argv.includes('--download')){for(const [file,url] of [['output/gtm-published-audit.txt','https://www.googletagmanager.com/gtm.js?id=GTM-MMZHD3HN'],['output/ga4-published-audit.txt','https://www.googletagmanager.com/gtag/js?id=G-CD5YR72WXR']]){const response=await fetch(url);assert.ok(response.ok,url);fs.writeFileSync(file,await response.text());}}
for(const file of ['output/gtm-published-audit.txt','output/ga4-published-audit.txt'])assert.ok(fs.existsSync(file),'Download the published public tag scripts first: '+file);
const browser=await chromium.launch();
const mime={'.html':'text/html','.css':'text/css','.js':'text/javascript','.json':'application/json','.svg':'image/svg+xml','.woff2':'font/woff2','.png':'image/png','.jpg':'image/jpeg','.webp':'image/webp'};
function decode(request){const url=new URL(request.url()),base=Object.fromEntries(url.searchParams);return (request.postData()||'').split('\n').map(line=>({...base,...Object.fromEntries(new URLSearchParams(line))}));}
async function setup(origin,options={}){
 const page=await browser.newPage();const events=[],errors=[];let containers=0;
 page.on('pageerror',e=>errors.push(e.message));
 await page.route('**/*',async route=>{
  const request=route.request(),u=new URL(request.url());

  if(u.hostname==='www.googletagmanager.com'&&u.pathname==='/gtm.js'){containers++;if(options.delay)await new Promise(r=>setTimeout(r,options.delay));return route.fulfill({contentType:'text/javascript',body:fs.readFileSync('output/gtm-published-audit.txt')});}
  if(u.hostname==='www.googletagmanager.com'&&u.pathname==='/gtag/js')return route.fulfill({contentType:'text/javascript',body:fs.readFileSync('output/ga4-published-audit.txt')});
  if((/(^|\.)google-analytics\.com$/.test(u.hostname)||u.hostname==='analytics.google.com'||u.hostname==='www.google.com')&&u.pathname.endsWith('/collect')){events.push(...decode(request).filter(event=>event.tid==='G-CD5YR72WXR'));return route.fulfill({status:204,headers:{'Access-Control-Allow-Origin':'*'}});}
  if(u.origin!==origin)return route.abort();
  if(u.pathname==='/api/public-schedules.php')return route.fulfill({status:200,contentType:'application/json',body:'{"success":true,"schedules":[]}'});
  let file=path.resolve(root,'.'+decodeURIComponent(u.pathname));if(!file.startsWith(root+path.sep))return route.abort();if(fs.existsSync(file)&&fs.statSync(file).isDirectory())file=path.join(file,'index.html');if(!fs.existsSync(file))return route.fulfill({status:404,body:''});return route.fulfill({contentType:mime[path.extname(file)]||'application/octet-stream',body:fs.readFileSync(file)});
 });
 // Keep tests on the page and never open/send a WhatsApp message.
 await page.addInitScript(()=>{document.addEventListener('click',e=>{if(e.target instanceof Element&&e.target.closest('a[href*="wa.me"]'))e.preventDefault();});});
 return {page,events,errors,get containers(){return containers;}};
}
try{
 const local=await setup('http://127.0.0.1:4331');await local.page.goto('http://127.0.0.1:4331/pelatihan/',{waitUntil:'networkidle'});assert.equal(local.containers,0);assert.equal(await local.page.evaluate(()=>typeof window.__wtAnalytics),'undefined');await local.page.close();
 for(const [route,selector,position] of [['/pelatihan/ak3-bnsp/','.ce-registration > .ce-button','registration'],['/jadwal/','.dir-batch .ui-action','schedule_card'],['/artikel/5-prinsip-dasar-smk3/','.ar-conversion .ui-action:not(.ui-action-secondary)','article']]){
  const run=await setup('https://wahanatotalita.com');await run.page.goto('https://wahanatotalita.com'+route,{waitUntil:'networkidle'});
  await run.page.waitForFunction(()=>!!window.google_tag_manager?.['GTM-MMZHD3HN']);await run.page.waitForTimeout(1500);
  if(!run.events.length)console.log('No events; page errors:',run.errors,await run.page.evaluate(()=>({gtag:typeof window.gtag,queue:window.dataLayer.map(x=>x.event||x[0])})));
  assert.equal(run.containers,1,route+' single GTM loader');assert.equal(run.events.filter(e=>e.en==='page_view').length,1,route+' single page view');
  await run.page.addScriptTag({content:fs.readFileSync('public/assets/js/analytics-leads.js','utf8')});
  await run.page.locator(selector).first().evaluate(link=>link.click());for(let attempt=0;attempt<120&&!run.events.some(e=>e.en==='generate_lead');attempt++)await run.page.waitForTimeout(100);
  const leads=run.events.filter(e=>e.en==='generate_lead'),clicks=run.events.filter(e=>e.en==='whatsapp_click');
  fs.writeFileSync(output+'/'+route.replaceAll('/','-')+'.json',JSON.stringify(run.events,null,2));
  assert.equal(leads.length,1,route+' one lead');assert.equal(clicks.length,1,route+' one GTM WhatsApp event');assert.equal(leads[0]['ep.cta_position'],position);assert.equal(leads[0].tid,'G-CD5YR72WXR');assert.ok(!JSON.stringify(leads).includes('text='),'No WhatsApp message in custom payload');
  assert.deepEqual(run.errors,[]);console.log(route+': one page_view, one whatsapp_click, one generate_lead; position='+position);await run.page.close();
 }
 const debug=await setup('http://127.0.0.1:4331',{delay:1000});await debug.page.goto('http://127.0.0.1:4331/pelatihan/ak3-bnsp/?analytics_debug=1',{waitUntil:'domcontentloaded'});await debug.page.locator('.ce-registration > .ce-button').evaluate(link=>link.click());for(let attempt=0;attempt<150&&!debug.events.some(e=>e.en==='generate_lead');attempt++)await debug.page.waitForTimeout(100);assert.equal(debug.containers,1);const early=debug.events.filter(e=>e.en==='generate_lead');fs.writeFileSync(output+'/early-click.json',JSON.stringify(debug.events,null,2));assert.equal(early.length,1,'First click queued before GTM finishes');assert.ok(early[0]._dbg==='1'||early[0]['ep.debug_mode']==='true','Explicit local debugging');await debug.page.close();
 console.log('Local traffic excluded by default; opt-in debug and early queued click passed. Collection requests were intercepted; no test events sent to GA.');
}finally{await browser.close();}
