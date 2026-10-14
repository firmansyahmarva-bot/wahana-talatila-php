async function main() {
  const url = process.argv[2] || 'http://localhost:4321/pelatihan-k3-surabaya/';
  const res = await fetch(url);
  const html = await res.text();
  const urls = [];
  const regex = /(href|src)="(\/[^"]+\.(css|js|png|jpg|jpeg|svg|webp))"/g;
  let match;
  while ((match = regex.exec(html)) !== null) {
    urls.push(match[2]);
  }
  const unique = [...new Set(urls)];
  console.log(`Checking ${unique.length} assets on ${url}:`);
  let hasFail = false;
  for (const u of unique) {
    const aRes = await fetch('http://localhost:4321' + u);
    if (aRes.status !== 200) {
      console.log('❌ ' + aRes.status + ' -> ' + u);
      hasFail = true;
    } else {
      console.log('✓ 200 -> ' + u);
    }
  }
  if (!hasFail) console.log('ALL ASSETS OK (200)!');
}
main();
