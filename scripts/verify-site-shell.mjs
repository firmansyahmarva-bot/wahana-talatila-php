import { chromium } from 'playwright';
import assert from 'node:assert/strict';
import fs from 'node:fs';
import path from 'node:path';
const origin=process.env.SHELL_TEST_ORIGIN || 'http://site-shell.test';
fs.mkdirSync('output/shared-shell', {recursive: true});
const paths=['/','/pelatihan/','/pelatihan/ak3-bnsp/','/pelatihan-k3-yogyakarta/','/jadwal/','/artikel/','/perusahaan/','/en/','/en/safety-officer-ak3-umum-requirements/','/zh/','/zh/checklist/'];
const browser=await chromium.launch({headless:true});
let checks=0;
try {
 for(const width of [320,390,768,1024,1440]){
  const page=await browser.newPage({viewport:{width,height:900}});
  if (!process.env.SHELL_TEST_ORIGIN) {
   await page.route('**/*', async route => {
    const url = new URL(route.request().url());
    if (url.origin !== origin) return route.abort();
    const root = path.resolve('dist');
    let file = path.resolve(root, '.' + decodeURIComponent(url.pathname));
    if (!file.startsWith(root + path.sep) && file !== root) return route.abort();
    if (fs.existsSync(file) && fs.statSync(file).isDirectory()) file = path.join(file, 'index.html');
    if (!fs.existsSync(file)) return route.fulfill({status: 404, body: ''});
    const types = {'.html':'text/html', '.css':'text/css', '.js':'text/javascript', '.svg':'image/svg+xml', '.png':'image/png', '.jpg':'image/jpeg', '.webp':'image/webp', '.woff2':'font/woff2'};
    return route.fulfill({status: 200, contentType: types[path.extname(file)] || 'application/octet-stream', body: fs.readFileSync(file)});
   });
  }
  let reference;
  for(const route of paths){
   const response=await page.goto(origin+route,{waitUntil:'networkidle'});assert.equal(response.status(),200,route);
   assert.equal(await page.locator('header.hm-header').count(),1,route+' header');
   assert.equal(await page.locator('footer').count(),1,route+' footer');
   assert.equal(await page.locator('.home-contact-bar').count(),1,route+' bottom nav');
   assert.equal(await page.locator('.home-wa-float').count(),1,route+' contact');
   assert.equal(await page.locator('main .zh-nav, main .zh-mobile-bar, main .sticky-mobile-bar').count(),0,route+' duplicate navigation');
   const metrics=await page.evaluate(()=>{const header=document.querySelector('.hm-header'),footer=document.querySelector('.hm-footer'),bar=document.querySelector('.home-contact-bar'),menu=document.querySelector('.hm-mobile-menu');const hs=getComputedStyle(header),fs=getComputedStyle(footer);return {headerHeight:header.getBoundingClientRect().height,headerFont:hs.fontFamily,footerFont:fs.fontFamily,footerColumns:fs.gridTemplateColumns,barVisible:getComputedStyle(bar).display!=='none',padding:parseFloat(getComputedStyle(document.body).paddingBottom),barHeight:bar.getBoundingClientRect().height,headerOverflow:header.scrollWidth>innerWidth,footerOverflow:footer.scrollWidth>innerWidth,menuVisible:getComputedStyle(menu).display!=='none'};});
   assert.equal(metrics.headerOverflow,false,route+' header overflow at '+width);assert.equal(metrics.footerOverflow,false,route+' footer overflow at '+width);
   if(!reference)reference=metrics;else {assert.equal(metrics.headerHeight,reference.headerHeight,route+' consistent header height at '+width);assert.equal(metrics.headerFont,reference.headerFont);assert.equal(metrics.footerFont,reference.footerFont);}
   assert.equal(metrics.barVisible,width<=768);assert.equal(metrics.menuVisible,width<=768);
   if(width<=768){assert.ok(metrics.padding>=metrics.barHeight,route+' bottom clearance');await page.locator('.hm-mobile-menu summary').click();const bounds=await page.locator('.hm-mobile-menu > div').boundingBox();assert.ok(bounds.x>=0&&bounds.x+bounds.width<=width+1,route+' menu in viewport');await page.keyboard.press('Escape');assert.equal(await page.locator('.hm-mobile-menu').getAttribute('open'),null,route+' Escape closes menu');}
   if([390,1440].includes(width)&&['/','/pelatihan/ak3-bnsp/'].includes(route)){await page.screenshot({path:`output/shared-shell/${route==='/'?'home':'course'}-${width}.png`});}
   checks++;
  }
  await page.close();
 }
 console.log(`Shared layout passed on ${checks} page/viewport combinations.`);
}finally{await browser.close();}
