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

    <a href="/" class="nav-logo">
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
      <li><a href="/layanan">Layanan</a></li>
      <li><a href="/pelatihan/">Program</a></li>
      <li><a href="/jadwal/">Jadwal</a></li>

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

      <li><a href="/perusahaan">Untuk Perusahaan</a></li>
      <li><a href="/artikel/">Artikel</a></li>
      <li><a href="/perusahaan">Tentang</a></li>
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

<!-- ── SELF-CONTAINED NAVBAR, SEARCH & MOBILE BOTTOM NAV CSS ── -->
<style>
/* ─── BASE NAVBAR LAYOUT ─── */
.navbar {
  position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
  height: var(--nav-h, 72px);
  background: rgba(255,255,255,.97);
  box-shadow: 0 2px 20px rgba(0,0,0,.06);
  border-bottom: 1px solid #e8e8e8;
  transition: background .3s, box-shadow .3s;
}
.navbar.on-light-hero:not(.scrolled) {
  background: rgba(255,255,255,.97);
  border-bottom-color: #e8e8e8;
}
.navbar.scrolled {
  background: rgba(255,255,255,.98);
  box-shadow: 0 4px 24px rgba(0,0,0,.08);
}
.nav-inner {
  display: flex; align-items: center; justify-content: space-between;
  gap: 16px; height: 100%; position: relative;
}
.nav-logo {
  order: 1; display: flex; align-items: center; gap: 10px;
  text-decoration: none; color: var(--green, #0A4A2E); flex-shrink: 0;
}
.nav-logo-text strong {
  font-size: 15px; color: var(--green, #0A4A2E);
}
.nav-links {
  order: 2; display: flex; align-items: center; gap: 4px;
  margin-left: auto; list-style: none; padding: 0;
}
.nav-links a {
  padding: 8px 14px; border-radius: 8px; font-size: 14px; font-weight: 600;
  color: #1e293b; text-decoration: none; transition: all .15s;
}
.nav-links a:hover { background: #f0f9f0; color: var(--green, #0A4A2E); }

/* ─── UNIFIED SINGLE SEARCH FORM (Desktop) ─── */
.nav-search {
  order: 3; position: relative; display: flex; align-items: center;
  flex-shrink: 0; margin-left: 8px;
}
.nav-search-icon { display: none; }
.nav-search-input {
  width: 175px; height: 36px; padding: 0 34px 0 14px;
  background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 999px;
  font-size: 13px; color: #1e293b; outline: none; transition: all .25s ease;
}
.nav-search-input:focus {
  width: 230px; background: #fff; border-color: var(--green, #0A4A2E);
  box-shadow: 0 0 0 3px rgba(10,74,46,.12);
}
.nav-search-btn {
  position: absolute; right: 3px; top: 50%; transform: translateY(-50%);
  width: 30px; height: 30px; background: transparent; border: none;
  border-radius: 50%; color: #64748b; cursor: pointer; display: flex;
  align-items: center; justify-content: center; transition: color .2s;
}
.nav-search-btn:hover { color: var(--green, #0A4A2E); }
.nav-search-btn-label { display: none; }
.nav-search-btn-icon { display: flex; align-items: center; justify-content: center; }

/* ─── ACTIONS & HAMBURGER (Desktop) ─── */
.nav-actions { order: 4; display: flex; align-items: center; gap: 10px; flex-shrink: 0; }
.btn-wa-nav {
  display: inline-flex; align-items: center; gap: 6px;
  background: #25D366; color: #fff; padding: 9px 18px; border-radius: 999px;
  font-size: 13px; font-weight: 700; text-decoration: none;
  box-shadow: 0 2px 10px rgba(37,211,102,.3); transition: all .2s;
}
.btn-wa-nav:hover { background: #1da855; transform: translateY(-1px); }
.nav-hamburger {
  order: 5; display: none; flex-direction: column; gap: 5px;
  background: none; border: none; cursor: pointer; padding: 6px;
}
.nav-hamburger span {
  display: block; width: 22px; height: 2px;
  background: #1e293b; border-radius: 2px; transition: all .3s;
}

/* ─── MEGA DROPDOWN ─── */
.nav-dropdown { position: relative; }
.nav-dropdown-toggle { cursor: pointer; display: flex; align-items: center; gap: 2px; }
.nav-dropdown-menu {
  display: none; position: absolute; top: calc(100% + 10px); left: 50%;
  transform: translateX(-50%); z-index: 9999;
  background: #fff; border-radius: 14px;
  box-shadow: 0 8px 40px rgba(0,0,0,.14); border: 1px solid #e5e7eb;
  min-width: 720px; padding: 20px;
}
.nav-dropdown:hover .nav-dropdown-menu,
.nav-dropdown.open .nav-dropdown-menu { display: block; }
.nav-dropdown-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 12px; }
.nav-dropdown-heading { font-size: .7rem; font-weight: 800; color: #9ca3af; letter-spacing: .06em; text-transform: uppercase; padding: 0 0 8px 8px; margin-bottom: 4px; border-bottom: 1px solid #f3f4f6; }
.nav-dropdown-item {
  display: flex; align-items: flex-start; gap: 10px; padding: 9px 8px;
  border-radius: 8px; text-decoration: none; color: #1f2937;
  transition: background .15s; line-height: 1.3;
}
.nav-dropdown-item:hover { background: #f0f9f0; color: var(--green,#0A4A2E); }
.nav-dropdown-item:hover strong { color: var(--green,#0A4A2E); }
.nav-di-icon { font-size: 1.1rem; margin-top: 1px; flex-shrink: 0; }
.nav-dropdown-item strong { font-size: .83rem; display: block; }
.nav-dropdown-item small { font-size: .72rem; color: #9ca3af; }

/* ─── MOBILE RESPONSIVE (<= 900px) ─── */
@media (max-width: 900px) {
  :root { --nav-h: 56px; }
  .navbar {
    height: 56px !important; background: #fff !important;
    box-shadow: 0 2px 10px rgba(0,0,0,.08) !important;
    border-bottom: 1px solid #e8e8e8 !important;
  }
  .nav-inner {
    height: 56px !important; gap: 6px !important;
    justify-content: space-between !important;
  }
  .nav-logo { order: 1 !important; flex-shrink: 0 !important; }
  .nav-logo-text { display: none !important; }
  .nav-search {
    order: 2 !important; flex: 1 !important; margin: 0 4px !important;
    min-width: 0 !important; position: relative !important; display: flex !important;
  }
  .nav-search-icon {
    display: flex !important; position: absolute !important; left: 10px !important;
    top: 50% !important; transform: translateY(-50%) !important;
    color: #94a3b8 !important; pointer-events: none !important;
  }
  .nav-search-input {
    width: 100% !important; height: 38px !important; padding: 0 66px 0 32px !important;
    background: #f8fafc !important; border: 1.5px solid #e2e8f0 !important;
    border-radius: 999px !important; font-size: 13px !important;
  }
  .nav-search-btn {
    right: 3px !important; width: auto !important; height: auto !important;
    background: var(--green, #0A4A2E) !important; color: #fff !important;
    border-radius: 999px !important; padding: 6px 14px !important;
    font-size: 12px !important; font-weight: 700 !important;
  }
  .nav-search-btn:hover { background: #063320 !important; }
  .nav-search-btn-label { display: inline !important; color: #fff !important; }
  .nav-search-btn-icon { display: none !important; }
  .nav-actions { display: none !important; }
  .nav-hamburger { order: 3 !important; display: flex !important; }

  .nav-links {
    display: none; position: fixed; top: 56px; left: 0; right: 0;
    background: #fff; flex-direction: column; align-items: stretch;
    padding: 16px 20px 24px; box-shadow: 0 16px 36px rgba(0,0,0,.16);
    gap: 4px; max-height: calc(100vh - 120px); overflow-y: auto; z-index: 9999;
  }
  .nav-links.open { display: flex !important; }
  .nav-links a {
    color: #1e293b !important; padding: 12px 14px; border-radius: 8px;
    font-size: 14.5px; font-weight: 600; border-bottom: 1px solid #f1f5f9;
  }
  .nav-links a:hover { background: #f8fafc; color: var(--green, #0A4A2E) !important; }

  /* Flatten dropdown on mobile */
  .nav-dropdown-menu { position: static; transform: none; box-shadow: none; border: none; border-radius: 0; min-width: auto; padding: 0 0 0 16px; display: none; }
  .nav-dropdown.open .nav-dropdown-menu { display: block; }
  .nav-dropdown-grid { grid-template-columns: 1fr; }
  .nav-dropdown-heading { display: none; }
  .nav-dropdown-item small { display: none; }
}

/* ─── MOBILE BOTTOM NAVIGATION (Fixed Bottom) ─── */
.mobile-bottom-nav {
  display: none; position: fixed; bottom: 0; left: 0; right: 0;
  z-index: 998; background: rgba(255,255,255,.98);
  backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
  border-top: 1px solid #e2e8f0; height: 60px;
  padding-bottom: env(safe-area-inset-bottom, 0);
  box-shadow: 0 -4px 20px rgba(0,0,0,.06);
}
.mbn-item {
  flex: 1; display: flex; flex-direction: column;
  align-items: center; justify-content: center; gap: 3px;
  font-size: 11px; font-weight: 600; color: #64748b;
  text-decoration: none; transition: all .15s;
}
.mbn-item svg { flex-shrink: 0; transition: transform .15s, stroke .15s; stroke: #64748b; }
.mbn-item:hover { color: var(--green, #0A4A2E); }
.mbn-item.active { color: var(--green, #0A4A2E) !important; font-weight: 700; }
.mbn-item.active svg { stroke: var(--green, #0A4A2E) !important; transform: translateY(-1px); }

/* ─── WHATSAPP FLOATING BUTTON (Sitewide Guaranteed) ─── */
.wa-float {
  position: fixed !important; right: 24px; bottom: 24px; z-index: 9999;
  width: 56px; height: 56px; border-radius: 50%;
  background: #25D366 !important; color: #fff !important;
  display: flex !important; align-items: center !important; justify-content: center !important;
  box-shadow: 0 4px 20px rgba(37,211,102,.5);
  transition: transform .2s, box-shadow .2s; text-decoration: none;
}
.wa-float:hover { transform: scale(1.08); box-shadow: 0 6px 24px rgba(37,211,102,.6); }
.wa-float svg { width: 28px; height: 28px; }
.wa-badge {
  position: absolute; top: -3px; right: -3px;
  background: #F06A25; color: #fff; font-size: 11px; font-weight: 800;
  width: 20px; height: 20px; border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  border: 2px solid #fff; box-shadow: 0 2px 6px rgba(0,0,0,.2);
  animation: wa-badge-pulse 2s infinite;
}
@keyframes wa-badge-pulse { 0%,100%{transform:scale(1)} 50%{transform:scale(1.15)} }

@media (max-width: 768px) {
  body { padding-bottom: 74px !important; }
  .mobile-bottom-nav { display: flex !important; }
  .wa-float {
    display: flex !important; position: fixed !important;
    bottom: calc(74px + env(safe-area-inset-bottom, 0)) !important;
    right: 18px !important; z-index: 9999 !important;
    width: 52px !important; height: 52px !important;
  }
  .wa-float svg { width: 26px !important; height: 26px !important; }
}
</style>

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
