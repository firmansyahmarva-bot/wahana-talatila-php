<?php
$_nav_uri = $_SERVER['REQUEST_URI'] ?? '/';
$_nav_path = strtok($_nav_uri, '?');
$is_home_active = ($_nav_path === '/' || $_nav_path === '');
$is_jadwal_active = str_starts_with($_nav_path, '/jadwal');
$is_pelatihan_active = (str_starts_with($_nav_path, '/pelatihan') || str_starts_with($_nav_path, '/k3'));
$is_panduan_active = str_starts_with($_nav_path, '/artikel');
?>
<!-- ═══════════════════════════════════════════════════ NAVBAR -->
<nav class="navbar <?= $is_home_active ? '' : 'on-light-hero' ?>" id="navbar">
  <div class="container nav-inner">

    <a href="/" class="nav-logo" aria-label="Wahana Totalita Konsultan — Pelatihan K3 &amp; Sertifikasi Resmi">
      <?= theme_logo_html($s) ?>
      <span class="nav-logo-text">
        <strong><?= e($s['site_name'] ?? 'Wahana Totalita') ?></strong>
      </span>
    </a>

    <!-- Single Unified Responsive Search Form (Desktop in actions bar, Mobile in top bar) -->
    <form action="/pelatihan/" method="get" class="nav-search" role="search">
      <span class="nav-search-icon" aria-hidden="true">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      </span>
      <input type="search" name="q" class="nav-search-input" placeholder="Cari pelatihan..." aria-label="Cari pelatihan" autocomplete="off" value="<?= e($_GET['q'] ?? '') ?>">
      <button type="submit" class="nav-search-btn" aria-label="Cari">
        <span class="nav-search-btn-label">Cari</span>
        <svg class="nav-search-btn-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      </button>
    </form>

    <ul class="nav-links" id="nav-links">
      <li><a href="/pelatihan/">Pelatihan</a></li>
      <li><a href="/jadwal/">Jadwal</a></li>
      <li><a href="/keselamatan-kerja/">Bidang K3</a></li>

      <!-- Platform K3 mega dropdown -->
      <li class="nav-dropdown">
        <a href="#" class="nav-dropdown-toggle" aria-haspopup="true" aria-expanded="false">
          Platform K3
          <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" style="vertical-align:middle;margin-left:3px"><polyline points="6 9 12 15 18 9"/></svg>
        </a>
        <div class="nav-dropdown-menu" role="menu">
          <div class="nav-dropdown-grid">
            <div class="nav-dropdown-col">
              <div class="nav-dropdown-heading">📚 Referensi K3</div>
              <a href="/resources/" class="nav-dropdown-item">
                <span class="nav-di-icon">📄</span>
                <span><strong>Resources</strong><br><small>Panduan &amp; template K3</small></span>
              </a>
              <a href="/glosarium/" class="nav-dropdown-item">
                <span class="nav-di-icon">📖</span>
                <span><strong>Glosarium K3</strong><br><small>Kamus istilah K3 &amp; HSE</small></span>
              </a>
              <a href="/insiden/" class="nav-dropdown-item">
                <span class="nav-di-icon">⚠️</span>
                <span><strong>Database Insiden</strong><br><small>Kasus kecelakaan kerja RI</small></span>
              </a>
            </div>
            <div class="nav-dropdown-col">
              <div class="nav-dropdown-heading">🛠️ Tools Gratis</div>
              <a href="/tools/" class="nav-dropdown-item">
                <span class="nav-di-icon">🧮</span>
                <span><strong>Tools K3 Online</strong><br><small>Kalkulator, JSA, Risk Matrix</small></span>
              </a>
              <a href="/tools/ai-analyzer" class="nav-dropdown-item">
                <span class="nav-di-icon">🤖</span>
                <span><strong>AI Analyzer Dokumen</strong><br><small>Analisis dokumen K3 gratis</small></span>
              </a>
              <a href="/verifikasi/" class="nav-dropdown-item">
                <span class="nav-di-icon">✅</span>
                <span><strong>Verifikasi Sertifikat</strong><br><small>Cek keaslian sertifikat</small></span>
              </a>
            </div>
            <div class="nav-dropdown-col">
              <div class="nav-dropdown-heading">🤝 Komunitas</div>
              <a href="/forum/" class="nav-dropdown-item">
                <span class="nav-di-icon">💬</span>
                <span><strong>Forum Diskusi K3</strong><br><small>Tanya jawab &amp; share ilmu</small></span>
              </a>
              <a href="/lowongan/" class="nav-dropdown-item">
                <span class="nav-di-icon">💼</span>
                <span><strong>Lowongan HSE</strong><br><small>Info kerja K3 &amp; HSE</small></span>
              </a>
              <a href="/workplace/" class="nav-dropdown-item">
                <span class="nav-di-icon">🏢</span>
                <span><strong>Workplace K3 App</strong><br><small>Kelola K3 perusahaan</small></span>
              </a>
            </div>
          </div>
        </div>
      </li>

      <li><a href="/perusahaan">Perusahaan</a></li>
      <li><a href="/artikel/">Artikel</a></li>
      <li><a href="/perusahaan#kontak">Kontak</a></li>
    </ul>

    <div class="nav-actions">
      <a href="<?= wa_url('Halo Wahana Totalita, saya ingin bertanya tentang program pelatihan') ?>"
         class="btn-wa-nav" target="_blank" rel="noopener">
        <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
        Hubungi Kami
      </a>
    </div>

    <button class="nav-hamburger" id="nav-hamburger"
            aria-label="Toggle menu" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>

  </div>
</nav>


<!-- ── MOBILE BOTTOM NAVIGATION (Matches Reference Screenshot 1) ── -->
<nav class="mobile-bottom-nav" aria-label="Mobile navigation">
  <a href="/" class="mbn-item <?= $is_home_active ? 'active' : '' ?>">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
    <span>Beranda</span>
  </a>
  <a href="/jadwal/" class="mbn-item <?= $is_jadwal_active ? 'active' : '' ?>">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
    <span>Jadwal</span>
  </a>
  <a href="/pelatihan/" class="mbn-item <?= $is_pelatihan_active ? 'active' : '' ?>">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
    <span>Pelatihan</span>
  </a>
  <a href="/artikel/" class="mbn-item <?= $is_panduan_active ? 'active' : '' ?>">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 6h10"/><path d="M6 10h10"/></svg>
    <span>Panduan</span>
  </a>
</nav>

<script>
// Hamburger & Dropdown toggle handlers (Self-contained for all templates)
(function(){
  // Hamburger menu toggle
  var hamburger = document.getElementById('nav-hamburger');
  var links = document.getElementById('nav-links');
  if (hamburger && links) {
    hamburger.addEventListener('click', function(e){
      e.stopPropagation();
      var isOpen = links.classList.contains('open');
      links.classList.toggle('open', !isOpen);
      hamburger.setAttribute('aria-expanded', !isOpen);
    });
    document.addEventListener('click', function(e){
      if (!links.contains(e.target) && !hamburger.contains(e.target)) {
        links.classList.remove('open');
        hamburger.setAttribute('aria-expanded', 'false');
      }
    });
  }

  // Mega dropdown toggle (keyboard + click)
  var ddItems = document.querySelectorAll('.nav-dropdown');
  ddItems.forEach(function(dd){
    var toggle = dd.querySelector('.nav-dropdown-toggle');
    if (!toggle) return;
    toggle.addEventListener('click', function(e){
      e.preventDefault();
      var isOpen = dd.classList.contains('open');
      ddItems.forEach(function(d){ d.classList.remove('open'); var t = d.querySelector('.nav-dropdown-toggle'); if(t) t.setAttribute('aria-expanded','false'); });
      if(!isOpen){ dd.classList.add('open'); toggle.setAttribute('aria-expanded','true'); }
    });
  });
  document.addEventListener('click', function(e){
    if(!e.target.closest('.nav-dropdown')) ddItems.forEach(function(d){ d.classList.remove('open'); });
  });
  document.addEventListener('keydown', function(e){
    if(e.key==='Escape') ddItems.forEach(function(d){ d.classList.remove('open'); });
  });
})();
</script>
