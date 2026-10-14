<?php
$lines = file('csms.php');
$inMain = false;
$mainLines = [];
foreach ($lines as $line) {
    if (strpos($line, '<main id="konten-utama">') !== false) {
        $inMain = true;
    }
    if ($inMain) {
        $cleanLine = preg_replace('/<\?=\s*e\(\$wa_consult\)\s*\?>/', 'https://wa.me/6287759151278?text=Halo%20Wahana%20Totalita%2C%20kami%20ingin%20konsultasi%20pendampingan%20pembuatan%20%26%20audit%20dokumen%20CSMS%20Pertamina%20%2F%20BUMN%20agar%20lolos%20kualifikasi%20High%20Risk.', $line);
        $cleanLine = preg_replace('/<\?=\s*e\(\$wa_template\)\s*\?>/', 'https://wa.me/6287759151278?text=Halo%20Wahana%20Totalita%2C%20saya%20ingin%20meminta%20contoh%20format%20dokumen%20CSMS%20Pertamina%20lengkap%2C%20checklist%207%20elemen%2C%20dan%20panduan%20HSE%20Plan%20untuk%20persiapan%20tender.', $cleanLine);
        $cleanLine = preg_replace('/<\?=\s*\$year\s*\?>/', '2026', $cleanLine);
        $mainLines[] = $cleanLine;
    }
    if ($inMain && strpos($line, '</main>') !== false) {
        break;
    }
}

// Extract JSON-LD script from lines 37-149
$jsonLdBlock = '';
$inJsonLd = false;
foreach ($lines as $line) {
    if (strpos($line, '<script type="application/ld+json">') !== false) {
        $inJsonLd = true;
        continue;
    }
    if ($inJsonLd) {
        if (strpos($line, '</script>') !== false) {
            $inJsonLd = false;
            break;
        }
        $jsonLdBlock .= $line;
    }
}
$schemas = json_decode($jsonLdBlock, true);
$graph = $schemas['@graph'] ?? [];

$astroContent = "---
import Layout from '../layouts/Layout.astro';

const pageTitle = 'Panduan Lengkap CSMS Indonesia: 7 Elemen, Siklus K3LL Pertamina, & Lolos High Risk';
const metaDesc = 'Panduan komprehensif CSMS (Contractor Safety Management System) Indonesia 2026: Siklus K3LL Pertamina, 7 elemen penilaian, penyusunan laporan kinerja CHSEMS manajemen puncak, dokumen prakualifikasi, & jasa pendampingan lolos High Risk.';
const canonical = 'https://wahanatotalita.com/csms/';

const schemas = " . json_encode($graph, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . ";
---

<Layout
  title={pageTitle}
  description={metaDesc}
  canonical={canonical}
  schemas={schemas}
  pageCss={['/assets/css/page/csms.css', '/assets/css/page/csms-modern.css']}
>
" . implode("", $mainLines) . "

  <!-- STICKY BOTTOM LEAD BAR -->
  <div class=\"csms-sticky-bar\" id=\"csmsStickyBar\" aria-hidden=\"true\">
    <div class=\"csms-sticky-inner\">
      <div class=\"csms-sticky-text\">
        <strong>⚠️ Butuh Lolos CSMS Pertamina / BUMN untuk Tender?</strong>
        <span>Dapatkan pendampingan dokumen 7 elemen &amp; draf HSE Plan siap lolos High Risk.</span>
      </div>
      <a href=\"https://wa.me/6287759151278?text=Halo%20Wahana%20Totalita%2C%20kami%20ingin%20konsultasi%20pendampingan%20pembuatan%20%26%20audit%20dokumen%20CSMS%20Pertamina%20%2F%20BUMN%20agar%20lolos%20kualifikasi%20High%20Risk.\" class=\"csms-sticky-btn\" target=\"_blank\" rel=\"noopener\">
        <svg viewBox=\"0 0 24 24\" width=\"18\" height=\"18\" fill=\"currentColor\"><path d=\"M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347\"/></svg>
        <span>Konsultasi CSMS via WhatsApp</span>
      </a>
    </div>
  </div>

  <script is:inline>
  (function(){
    var bar = document.getElementById('csmsStickyBar');
    if(!bar) return;
    var shown = false;
    window.addEventListener('scroll', function(){
      var shouldShow = window.scrollY > 500;
      if(shouldShow !== shown){
        shown = shouldShow;
        bar.classList.toggle('is-visible', shown);
        bar.setAttribute('aria-hidden', !shown);
      }
    }, {passive: true});
  })();
  </script>
</Layout>
";

file_put_contents('src/pages/csms.astro', $astroContent);
echo "Successfully generated src/pages/csms.astro (" . strlen($astroContent) . " bytes)\n";
