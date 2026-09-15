<!-- ═══════════════════════════════════════════════════ NAVBAR -->
<nav class="navbar" id="navbar">
  <div class="container nav-inner">

    <a href="/" class="nav-logo">
      <?= theme_logo_html($s) ?>
      <span class="nav-logo-text">
        <strong><?= e($s['site_name'] ?? 'Wahana Totalita') ?></strong>
      </span>
    </a>

    <!-- Mobile search bar (hidden on desktop) — opens the AI program finder -->
    <div class="nav-search-mobile" role="button" tabindex="0"
         aria-label="Cari pelatihan"
         onclick="window.wtcOpen && window.wtcOpen()"
         onkeydown="if(event.key==='Enter'||event.key===' '){event.preventDefault();window.wtcOpen&&window.wtcOpen();}">
      <span class="nav-search-icon">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      </span>
      <span>Cari pelatihan...</span>
    </div>

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
      <div class="nav-socials">
        <?php if (!empty($s['instagram_url'])): ?>
        <a href="<?= e($s['instagram_url']) ?>" target="_blank" rel="noopener" aria-label="Instagram">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r=".5" fill="currentColor" stroke="none"/></svg>
        </a>
        <?php endif; ?>
        <?php if (!empty($s['facebook_url'])): ?>
        <a href="<?= e($s['facebook_url']) ?>" target="_blank" rel="noopener" aria-label="Facebook">
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
        </a>
        <?php endif; ?>
        <?php if (!empty($s['tiktok_url'])): ?>
        <a href="<?= e($s['tiktok_url']) ?>" target="_blank" rel="noopener" aria-label="TikTok">
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V8.69a8.18 8.18 0 0 0 4.78 1.52V6.75a4.84 4.84 0 0 1-1.01-.06z"/></svg>
        </a>
        <?php endif; ?>
        <?php if (!empty($s['youtube_url'])): ?>
        <a href="<?= e($s['youtube_url']) ?>" target="_blank" rel="noopener" aria-label="YouTube">
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 0 0 1.46 6.42 29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58 2.78 2.78 0 0 0 1.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.96-1.96A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75,15.02 15.5,12 9.75,8.98 9.75,15.02" fill="white"/></svg>
        </a>
        <?php endif; ?>
      </div>
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

<!-- ── DROPDOWN CSS (injected inline — no extra HTTP request) ── -->
<style>
.nav-dropdown { position:relative }
.nav-dropdown-toggle { cursor:pointer; display:flex; align-items:center; gap:2px }
.nav-dropdown-menu {
  display:none; position:absolute; top:calc(100% + 10px); left:50%;
  transform:translateX(-50%); z-index:9999;
  background:#fff; border-radius:14px;
  box-shadow:0 8px 40px rgba(0,0,0,.14); border:1px solid #e5e7eb;
  min-width:720px; padding:20px;
}
.nav-dropdown:hover .nav-dropdown-menu,
.nav-dropdown.open .nav-dropdown-menu { display:block }
.nav-dropdown-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:12px }
.nav-dropdown-col {}
.nav-dropdown-heading { font-size:.7rem; font-weight:800; color:#9ca3af; letter-spacing:.06em; text-transform:uppercase; padding:0 0 8px 8px; margin-bottom:4px; border-bottom:1px solid #f3f4f6 }
.nav-dropdown-item {
  display:flex; align-items:flex-start; gap:10px; padding:9px 8px;
  border-radius:8px; text-decoration:none; color:#1f2937;
  transition:background .15s; line-height:1.3;
}
.nav-dropdown-item:hover { background:#f0f9f0; color:var(--green,#0A4A2E) }
.nav-dropdown-item:hover strong { color:var(--green,#0A4A2E) }
.nav-di-icon { font-size:1.1rem; margin-top:1px; flex-shrink:0 }
.nav-dropdown-item strong { font-size:.83rem; display:block }
.nav-dropdown-item small { font-size:.72rem; color:#9ca3af }
/* Mobile: flatten dropdown into list */
@media (max-width:900px) {
  .nav-dropdown-menu { position:static; transform:none; box-shadow:none; border:none; border-radius:0; min-width:auto; padding:0 0 0 16px; display:none }
  .nav-dropdown.open .nav-dropdown-menu { display:block }
  .nav-dropdown-grid { grid-template-columns:1fr }
  .nav-dropdown-heading { display:none }
  .nav-dropdown-item small { display:none }
}
</style>

<!-- ── MOBILE BOTTOM NAVIGATION ── -->
<nav class="mobile-bottom-nav" aria-label="Mobile navigation">
  <a href="/" class="mbn-item">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
    <span>Beranda</span>
  </a>
  <a href="/jadwal/" class="mbn-item">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
    <span>Jadwal</span>
  </a>
  <a href="<?php echo wa_url('Halo Wahana Totalita, saya ingin daftar pelatihan'); ?>" class="mbn-wa" target="_blank" rel="noopener" aria-label="Daftar via WhatsApp">
    <div class="mbn-wa-btn">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
    </div>
    <span>Daftar</span>
  </a>
  <a href="/forum/" class="mbn-item">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
    <span>Forum</span>
  </a>
  <a href="/tools/" class="mbn-item">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
    <span>Tools</span>
  </a>
</nav>

<script>
// Dropdown toggle — keyboard + click
(function(){
  var ddItems = document.querySelectorAll('.nav-dropdown');
  ddItems.forEach(function(dd){
    var toggle = dd.querySelector('.nav-dropdown-toggle');
    toggle.addEventListener('click', function(e){
      e.preventDefault();
      var isOpen = dd.classList.contains('open');
      ddItems.forEach(function(d){ d.classList.remove('open'); d.querySelector('.nav-dropdown-toggle').setAttribute('aria-expanded','false'); });
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
