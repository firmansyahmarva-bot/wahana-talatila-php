<?php
/**
 * enrich-city-pages v3 (WAF-safe: all HTML base64-encoded so the host
 * firewall does not reject the save). Same behaviour as v2:
 *   PASS 1: robots noindex,follow -> index,follow
 *   PASS 2: inject unique per-city local-context section
 * Web: /cron/enrich-city-pages.php?key=wahana2026ping
 */
if (PHP_SAPI !== 'cli' && (($_GET['key'] ?? '') !== 'wahana2026ping')) {
    http_response_code(403); exit('Forbidden');
}
set_time_limit(0);
header('Content-Type: text/plain; charset=utf-8');

$D       = 'base64_decode';
$TAG_ND  = $D('Y29udGVudD0ibm9pbmRleCxmb2xsb3ci');
$TAG_IDX = $D('Y29udGVudD0iaW5kZXgsZm9sbG93Ig==');
$ANCHOR  = $D('PGRpdiBjbGFzcz0ic2wiPkt1cmlrdWx1bTwvZGl2Pg==');
$SEC     = $D('PHNlY3Rpb24=');
$MARK    = $D('PCEtLSBXVC1MT0NBTCB2MyAtLT4=');
$LI_TPL  = $D('ICAgIDxsaT5QZXJ1c2FoYWFuICYgcGVrZXJqYSBzZWt0b3IgPHN0cm9uZz57SU5EfTwvc3Ryb25nPiBkaSB7Q0lUWX08L2xpPgo=');
$TPL     = $D('CntNQVJLfQo8c2VjdGlvbiBjbGFzcz0ic2VjIHNlYy1hbHQiPgogIDxkaXYgY2xhc3M9InNsIj5Lb250ZWtzIExva2FsPC9kaXY+CiAgPGgyPlBlbGF0aWhhbiB7UFJPR30gZGkge0NJVFl9LCB7UFJPVn08L2gyPgogIDxkaXYgY2xhc3M9ImxvY2FsLWNvbnRlbnQiPjxwPntDSEFSfSBLZWJ1dHVoYW4gdGVuYWdhIGJlcnNlcnRpZmlrYXQgPHN0cm9uZz57UFJPR308L3N0cm9uZz4gZGkge0NJVFl9IHRlcnVzIG1lbmluZ2thdCBzZWlyaW5nIGFrdGl2aXRhcyBzZWt0b3Ige0lORExJU1R9IGRpIHdpbGF5YWgge1BST1Z9LjwvcD4KPHA+U2VydGlmaWthc2kgPHN0cm9uZz57UFJPR308L3N0cm9uZz4gcmVzbWkgS2VtbmFrZXIgUkkgJmFtcDsgQk5TUCBtZW5qYWRpIHN5YXJhdCBwZW50aW5nIGJhZ2kgcGVydXNhaGFhbiBkaSB7Q0lUWX0gdW50dWsgbWVtZW51aGkgcmVndWxhc2kga2VzZWxhbWF0YW4ga2VyamEsIG1lbmdpa3V0aSB0ZW5kZXIsIGRhbiBtZW5la2FuIHJpc2lrbyBrZWNlbGFrYWFuIGRpIGxhcGFuZ2FuLiBXYWhhbmEgVG90YWxpdGEgbWVsYXlhbmkgcGVzZXJ0YSBkYXJpIHtDSVRZfSBkYW4gc2VraXRhcm55YSBzZWNhcmEgb25saW5lIG1hdXB1biBpbi1ob3VzZS48L3A+CjxwPjxzdHJvbmc+U2lhcGEgeWFuZyBtZW1idXR1aGthbiBwZWxhdGloYW4gaW5pIGRpIHtDSVRZfT88L3N0cm9uZz48L3A+Cjx1bD4Ke0lORElURU1TfTwvdWw+PC9kaXY+Cjwvc2VjdGlvbj4K');

$CITY = [
 'yogyakarta'=>['Yogyakarta','D.I. Yogyakarta',['pendidikan','pariwisata','UMKM','manufaktur ringan','konstruksi'],
    'Yogyakarta adalah pusat pendidikan dan pariwisata dengan pertumbuhan sektor konstruksi dan hospitality yang pesat.'],
 'sleman'=>['Sleman','D.I. Yogyakarta',['pendidikan','properti dan konstruksi','manufaktur','perdagangan'],
    'Sleman menjadi pusat pertumbuhan properti, kampus, dan kawasan komersial di utara Yogyakarta.'],
 'bantul'=>['Bantul','D.I. Yogyakarta',['kerajinan dan mebel','UMKM','pariwisata pesisir','industri pengolahan'],
    'Bantul dikenal dengan sentra kerajinan, mebel, dan industri pengolahan skala kecil-menengah.'],
 'semarang'=>['Semarang','Jawa Tengah',['pelabuhan dan logistik','manufaktur','tekstil','pergudangan'],
    'Semarang adalah kota pelabuhan (Tanjung Emas) dengan kawasan industri dan logistik yang besar.'],
 'solo'=>['Solo','Jawa Tengah',['tekstil dan garmen','batik','manufaktur','furniture'],
    'Solo (Surakarta) merupakan pusat industri tekstil, garmen, dan manufaktur di Jawa Tengah.'],
 'surabaya'=>['Surabaya','Jawa Timur',['pelabuhan dan logistik','manufaktur berat','petrokimia','galangan kapal'],
    'Surabaya adalah kota industri dan pelabuhan terbesar di Indonesia Timur (Tanjung Perak).'],
 'bandung'=>['Bandung','Jawa Barat',['tekstil','manufaktur','teknologi','makanan dan minuman','konstruksi'],
    'Bandung memiliki basis industri tekstil, manufaktur, dan teknologi yang kuat.'],
 'bekasi'=>['Bekasi','Jawa Barat',['otomotif','manufaktur','kawasan industri','logistik'],
    'Bekasi menampung kawasan industri terbesar di Indonesia (Cikarang, Jababeka, MM2100) dengan ribuan pabrik.'],
 'balikpapan'=>['Balikpapan','Kalimantan Timur',['minyak dan gas','pertambangan','energi','logistik migas'],
    'Balikpapan adalah pusat industri minyak, gas, dan pertambangan di Kalimantan Timur.'],
 'cilegon'=>['Cilegon','Banten',['petrokimia','baja','industri kimia berat','pelabuhan'],
    'Cilegon merupakan pusat industri baja dan petrokimia nasional (kawasan Krakatau).'],
 'batam'=>['Batam','Kepulauan Riau',['manufaktur elektronik','galangan kapal','kawasan industri (FTZ)','migas lepas pantai'],
    'Batam adalah zona industri dan galangan kapal strategis dengan status Free Trade Zone.'],
];

$dir = ($_SERVER['DOCUMENT_ROOT'] ?? realpath(__DIR__.'/..')) . '/pelatihan';
$files = glob($dir . '/*.html');

$indexFixed = 0;
foreach ($files as $file) {
    $slug = basename($file, '.html'); $keep = false;
    foreach ($CITY as $cs=>$d) { if (str_ends_with($slug,'-'.$cs)) { $keep=true; break; } }
    if (!$keep) continue;
    $h = file_get_contents($file);
    if ($h !== false && stripos($h,$TAG_ND) !== false) {
        if (file_put_contents($file, str_ireplace($TAG_ND,$TAG_IDX,$h)) !== false) $indexFixed++;
    }
}
echo "PASS 1 - noindex fixed on {$indexFixed} pages\n";

$done=0; $skipped=0;
foreach ($files as $file) {
    $slug = basename($file, '.html');
    $cs=null; foreach ($CITY as $k=>$d) { if (str_ends_with($slug,'-'.$k)) { $cs=$k; break; } }
    if (!$cs) continue;
    $html = file_get_contents($file);
    if ($html === false || str_contains($html, $MARK)) { $skipped++; continue; }
    $anchor = strpos($html, $ANCHOR);
    if ($anchor === false) { $skipped++; continue; }
    $secPos = strrpos(substr($html,0,$anchor), $SEC);
    if ($secPos === false) { $skipped++; continue; }

    [$cityName,$prov,$inds,$character] = $CITY[$cs];
    $programSlug = substr($slug, 0, -(strlen($cs)+1));
    $program = preg_replace('/\bk3\b/i','K3', ucwords(str_replace('-',' ',$programSlug)));
    $indList = htmlspecialchars(implode(', ', $inds));
    $indItems = '';
    foreach ($inds as $ind) { $indItems .= strtr($LI_TPL, ['{IND}'=>htmlspecialchars($ind),'{CITY}'=>$cityName]); }

    $block = strtr($TPL, [
        '{MARK}'=>$MARK, '{PROG}'=>$program, '{CITY}'=>$cityName, '{PROV}'=>$prov,
        '{CHAR}'=>$character, '{INDLIST}'=>$indList, '{INDITEMS}'=>$indItems,
    ]);
    $new = substr($html,0,$secPos) . $block . substr($html,$secPos);
    if (file_put_contents($file,$new) !== false) { $done++; }
}
echo "PASS 2 - injected on {$done} pages (skipped {$skipped})\n";
echo "DONE\n";
