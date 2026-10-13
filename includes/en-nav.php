<?php
/**
 * includes/en-nav.php — Navigation and Common Sidebar for English Hub
 */

function get_en_nav_items() {
    return [
        ['slug' => '', 'title' => 'Executive Overview (Hub)', 'badge' => 'Main Hub'],
        ['slug' => 'indonesia-occupational-safety-law', 'title' => 'Law No. 1/1970 & Regulations', 'badge' => 'Legal Basis'],
        ['slug' => 'p2k3-safety-committee-requirements', 'title' => 'P2K3 Committee Requirements', 'badge' => 'Governance'],
        ['slug' => 'workplace-accident-reporting-procedure', 'title' => 'Accident Reporting Protocol', 'badge' => 'Compliance'],
        ['slug' => 'smk3-certification-guide', 'title' => 'SMK3 Gold Audit Guide', 'badge' => 'Management'],
        ['slug' => 'smk3-vs-iso-45001', 'title' => 'SMK3 vs ISO 45001', 'badge' => 'Tenders'],
        ['slug' => 'csms-contractor-safety-management-system', 'title' => 'CSMS Pre-Qualification', 'badge' => 'Supply Chain'],
        ['slug' => 'safety-officer-ak3-umum-requirements', 'title' => 'AK3 Umum Safety Officer', 'badge' => 'Personnel'],
        ['slug' => 'chemical-safety-officer-requirements', 'title' => 'Chemical Safety (K3 Kimia)', 'badge' => 'Hazchem'],
        ['slug' => 'electrical-safety-expert-requirements', 'title' => 'Electrical Safety (K3 Listrik)', 'badge' => 'HV & Power'],
        ['slug' => 'industrial-hygiene-officer-guide', 'title' => 'Industrial Hygiene (Higiene)', 'badge' => 'Environment'],
        ['slug' => 'heavy-equipment-operator-license-sio', 'title' => 'Operator Licenses (SIO)', 'badge' => 'Mobile Plant'],
        ['slug' => 'statutory-equipment-inspection-sia', 'title' => 'Statutory Inspection (SIA)', 'badge' => 'Machinery'],
        ['slug' => 'boiler-pressure-vessel-certification', 'title' => 'Boilers & Pressure Vessels', 'badge' => 'Steam Plant'],
        ['slug' => 'certified-welder-regulations-indonesia', 'title' => 'Certified Welder (Juru Las)', 'badge' => 'Fabrication'],
        ['slug' => 'working-at-height-regulations', 'title' => 'Working at Height (TKBT/TKPK)', 'badge' => 'High Risk'],
        ['slug' => 'confined-space-safety-standards', 'title' => 'Confined Space Standards', 'badge' => 'High Risk'],
        ['slug' => 'workplace-fire-safety-classification', 'title' => 'Fire Safety Classes (Damkar)', 'badge' => 'Emergency'],
        ['slug' => 'mining-safety-regulations-smkp', 'title' => 'Mining Safety (SMKP & POP)', 'badge' => 'Mining'],
        ['slug' => 'oil-gas-safety-migas-requirements', 'title' => 'Oil & Gas Safety (Migas)', 'badge' => 'Energy'],
        ['slug' => 'construction-safety-system-smkk', 'title' => 'Construction Safety (SMKK)', 'badge' => 'EPC Projects'],
        ['slug' => 'factory-setup-safety-checklist', 'title' => 'New Factory HSE Checklist', 'badge' => 'FDI Roadmap']
    ];
}

function render_en_header($current_slug = '', $breadcrumb_title = '') {
    $back_url = '/en/';
    ?>
    <header class="en-nav">
      <div class="en-nav-inner">
        <a href="/en/" class="en-logo">
          <img src="/assets/img/logo-wt.webp" alt="Wahana Totalita Logo" width="160" height="38" onerror="this.onerror=null;this.src='/assets/img/logo-wt.png'">
          <span class="en-lang-badge">Indonesia HSE Portal</span>
        </a>
        <div class="en-nav-links">
          <?php if (!empty($current_slug)): ?>
          <a href="/en/" class="en-nav-back">&larr; All English Guides</a>
          <?php endif; ?>
          <a href="https://wa.me/6287759151278?text=Hello%20Wahana%20Totalita,%20we%20are%20an%20international%20company%20operating%20in%20Indonesia%20and%20require%20HSE%20compliance%20and%20licensing%20support." class="en-nav-contact" target="_blank" rel="noopener">Contact Legal HSE Team</a>
        </div>
      </div>
    </header>
    <?php
}

function render_en_sidebar($current_slug = '') {
    $items = get_en_nav_items();
    $wa_msg = rawurlencode("Hello Wahana Totalita, we would like to consult on HSE statutory requirements and certification in Indonesia.");
    $wa_url = "https://wa.me/6287759151278?text={$wa_msg}";
    ?>
    <aside class="en-sticky-sidebar">
      <div class="en-sb-box">
        <div class="en-sb-badge">Licensed PJK3 Body</div>
        <h3 class="en-sb-title">Statutory HSE Advisory</h3>
        <p class="en-sb-desc">
          Official Ministry of Manpower (Kemnaker) licensed inspection and certification body (SKP No. Kep. 312/BINWASPNAK-PNK3/V/2020). We assist foreign firms, joint ventures, and EPC contractors across Indonesia.
        </p>

        <a href="<?= $wa_url ?>" class="en-sb-wa-btn" target="_blank" rel="noopener">
          <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
          <span>Chat via WhatsApp</span>
        </a>

        <div class="en-sb-divider"></div>

        <div class="en-sb-info-row">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
          <div><strong>Direct Hotline:</strong> +62 877-5915-1278</div>
        </div>
        <div class="en-sb-info-row">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
          <div><strong>Corporate Email:</strong> info@wahanatotalita.com</div>
        </div>

        <div class="en-sb-nav-title">All Compliance Guides (22)</div>
        <ul class="en-sb-nav-list">
          <?php foreach ($items as $item): 
            $url = empty($item['slug']) ? '/en/' : '/en/' . $item['slug'] . '/';
            $isActive = ($current_slug === $item['slug']);
          ?>
          <li>
            <a href="<?= $url ?>" class="<?= $isActive ? 'active' : '' ?>">
              &bull; <?= htmlspecialchars($item['title']) ?>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </aside>
    <?php
}

function render_en_footer() {
    $wa_msg = rawurlencode("Hello Wahana Totalita, we would like to consult on HSE statutory requirements in Indonesia.");
    $wa_url = "https://wa.me/6287759151278?text={$wa_msg}";
    ?>
    <footer class="en-footer">
      <div class="en-footer-inner">
        <div>
          <h4>PT Wahana Totalita Konsultan — Statutory HSE & Technical Inspection Body</h4>
          <p>
            Official PJK3 licensed by the Ministry of Manpower Republic of Indonesia (Kep. 312/BINWASPNAK-PNK3/V/2020). We provide complete statutory compliance consulting, equipment inspection (Riksa Uji / SIA), operator licensing (SIO), and certified safety management audits (SMK3) for foreign companies, mining operators, petrochemical plants, and infrastructure contractors nationwide.
          </p>
          <p>
            <strong>Headquarters:</strong> Jl. Wonosari KM 8.5, Berbah, Sleman, D.I. Yogyakarta 55573, Indonesia<br>
            <strong>Email:</strong> info@wahanatotalita.com &nbsp;|&nbsp; <strong>Direct Line:</strong> +62 877-5915-1278
          </p>
        </div>
        <div>
          <h4>Legal Disclaimer</h4>
          <p style="font-size:12.5px;">
            The regulatory overviews on this portal are based on Law No. 1/1970, Law No. 13/2003, Government Regulation PP 50/2012, and corresponding Ministerial Decrees issued by the Indonesian Ministry of Manpower (Kemnaker) and Ministry of Energy and Mineral Resources (ESDM). Official enforcement and statutory audits are subject to regional labor inspection offices (Disnaker).
          </p>
        </div>
      </div>
      <div class="en-footer-bottom">
        &copy; 2008 - 2026 PT Wahana Totalita Konsultan. All rights reserved.
      </div>
    </footer>

    <div class="en-mobile-bar">
      <div>
        <div class="en-mb-text">Indonesia HSE & Licensing Advisory</div>
        <div class="en-mb-sub">Ministry of Manpower Licensed PJK3 Body</div>
      </div>
      <a href="<?= $wa_url ?>" class="en-mb-btn" target="_blank" rel="noopener">
        <svg viewBox="0 0 24 24" fill="currentColor" width="15" height="15"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
        <span>Consult Now</span>
      </a>
    </div>

    <script>
    function toggleEnFaq(btn) {
      var ans = btn.nextElementSibling;
      var isOpen = ans.classList.contains('open');
      document.querySelectorAll('.en-faq-a').forEach(function(el) { el.classList.remove('open'); });
      if (!isOpen) { ans.classList.add('open'); }
    }
    </script>
    <?php
}
