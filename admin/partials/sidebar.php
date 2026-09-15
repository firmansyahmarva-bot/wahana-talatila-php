<?php
$cur  = basename($_SERVER['PHP_SELF']);
$role = current_role();
$notif_count = get_notification_count();

// Active section detection
function active(string ...$pages): string {
    global $cur;
    return in_array($cur, $pages) ? ' active' : '';
}
?>
<aside class="admin-sidebar" id="sidebar">
  <!-- Logo -->
  <div class="sidebar-logo">
    <div class="sidebar-logo-icon">WT</div>
    <div class="sidebar-logo-text">
      <strong>Wahana Totalita</strong>
      <span>Panel Admin</span>
    </div>
    <button class="sidebar-close" id="sidebarClose" aria-label="Close">✕</button>
  </div>

  <!-- User badge -->
  <div class="sidebar-user">
    <div class="sidebar-user-avatar"><?= strtoupper(substr($_SESSION['admin_name'] ?? 'A', 0, 1)) ?></div>
    <div>
      <div class="sidebar-user-name"><?= e($_SESSION['admin_name'] ?? '') ?></div>
      <div class="sidebar-user-role" style="background:<?= ROLE_LABELS[$role]['color'] ?>22;color:<?= ROLE_LABELS[$role]['color'] ?>">
        <?= ROLE_LABELS[$role]['label'] ?>
      </div>
    </div>
  </div>

  <nav class="sidebar-nav">

    <!-- Dashboard -->
    <a href="/admin/" class="nav-item<?= active('index.php') ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
      <span>Dashboard</span>
      <?php if ($notif_count > 0): ?>
      <span class="nav-badge"><?= $notif_count ?></span>
      <?php endif; ?>
    </a>

    <!-- Incoming leads: kept at the top so daily follow-up never requires scrolling. -->
    <?php if (can('clients') || can('registrations')): ?>
    <div class="nav-group">
      <div class="nav-group-label">Leads Masuk</div>
      <?php if (can('registrations')): ?>
      <a href="/admin/registrations.php" class="nav-item<?= active('registrations.php') ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        <span>Pendaftaran Peserta</span>
        <?php
        try { $sb_nr = (int)get_pdo()->query("SELECT COUNT(*) FROM training_registrations WHERE status='pending'")->fetchColumn(); }
        catch(Exception $e){$sb_nr=0;}
        if ($sb_nr > 0): ?><span class="nav-badge"><?= $sb_nr ?></span><?php endif; ?>
      </a>
      <?php endif; ?>
      <?php if (can('clients')): ?>
      <a href="/admin/leads.php" class="nav-item<?= active('leads.php') ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
        <span>Leads & Prospek</span>
        <?php
        $sb_new_leads = (int)get_pdo()->query("SELECT COUNT(*) FROM leads WHERE status='new'")->fetchColumn();
        if ($sb_new_leads > 0): ?>
        <span class="nav-badge"><?= $sb_new_leads ?></span>
        <?php endif; ?>
      </a>
      <?php endif; ?>
    </div>
    <?php endif; ?>

    <!-- Website -->
    <?php if (can('website')): ?>
    <div class="nav-group">
      <div class="nav-group-label">Website</div>
      <a href="/admin/settings.php" class="nav-item<?= active('settings.php') ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
        <span>Pengaturan</span>
      </a>
      <a href="/admin/trainings.php" class="nav-item<?= active('trainings.php','training-save.php') ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
        <span>Program Pelatihan</span>
      </a>
      <a href="/admin/artikel.php" class="nav-item<?= active('artikel.php','artikel-upload.php') ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
        <span>Artikel Blog</span>
      </a>
    </div>
    <?php endif; ?>

    <!-- Clients & Certifications -->
    <?php if (can('clients')): ?>
    <div class="nav-group">
      <div class="nav-group-label">Klien & Sertifikasi</div>
      <a href="/admin/admin_klien_sertifikasi.php" class="nav-item<?= active('admin_klien_sertifikasi.php') ?>" style="background:linear-gradient(90deg,rgba(240,106,37,.15),transparent)">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
        <span>⚡ Input Cepat</span>
      </a>
      <a href="/admin/companies.php" class="nav-item<?= active('companies.php') ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        <span>Perusahaan</span>
      </a>
      <a href="/admin/clients.php" class="nav-item<?= active('clients.php') ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        <span>Peserta</span>
      </a>
      <a href="/admin/certifications.php" class="nav-item<?= active('certifications.php') ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>
        <span>Sertifikasi</span>
        <?php
        $sb_exp = (int)get_pdo()->query("SELECT COUNT(*) FROM certifications WHERE expiry_date BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 30 DAY)")->fetchColumn();
        if ($sb_exp > 0): ?>
        <span class="nav-badge nav-badge-warn"><?= $sb_exp ?></span>
        <?php endif; ?>
      </a>
    </div>
    <?php endif; ?>

    <!-- Training -->
    <?php if (can('batches')): ?>
    <div class="nav-group">
      <div class="nav-group-label">Pelatihan</div>
      <a href="/admin/batches.php" class="nav-item<?= active('batches.php') ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        <span>Jadwal Batch</span>
      </a>
      <a href="/admin/recurring-batches.php" class="nav-item<?= active('recurring-batches.php') ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 12a8 8 0 1 1-2.34-5.66"/><polyline points="20 4 20 10 14 10"/></svg>
        <span>Jadwal Bulanan</span>
      </a>
      <a href="/admin/instructors.php" class="nav-item<?= active('instructors.php') ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        <span>Instruktur</span>
      </a>
    </div>
    <?php endif; ?>

    <!-- Calendar (all roles) -->
    <a href="/admin/calendar.php" class="nav-item<?= active('calendar.php') ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><line x1="12" y1="14" x2="12" y2="18"/><line x1="10" y1="16" x2="14" y2="16"/></svg>
      <span>Kalender</span>
    </a>

    <!-- Accounts -->
    <?php if (can('accounts')): ?>
    <div class="nav-group">
      <div class="nav-group-label">Keuangan</div>
      <a href="/admin/accounts.php" class="nav-item<?= active('accounts.php') ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
        <span>Dashboard Keuangan</span>
      </a>
      <a href="/admin/invoices.php" class="nav-item<?= active('invoices.php') ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
        <span>Invoice</span>
        <?php
        $sb_overdue = (int)get_pdo()->query("SELECT COUNT(*) FROM invoices WHERE status='overdue'")->fetchColumn();
        if ($sb_overdue > 0): ?>
        <span class="nav-badge nav-badge-warn"><?= $sb_overdue ?></span>
        <?php endif; ?>
      </a>
      <a href="/admin/payments.php" class="nav-item<?= active('payments.php') ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
        <span>Pembayaran</span>
      </a>
      <a href="/admin/expenses.php" class="nav-item<?= active('expenses.php') ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
        <span>Pengeluaran</span>
      </a>
      <a href="/admin/targets.php" class="nav-item<?= active('targets.php') ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
        <span>Target & Realisasi</span>
      </a>
    </div>
    <?php endif; ?>

    <!-- WhatsApp -->
    <?php if (can('whatsapp')): ?>
    <div class="nav-group">
      <div class="nav-group-label">WhatsApp</div>
      <a href="/admin/whatsapp.php" class="nav-item<?= active('whatsapp.php') ?>">
        <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
        <span>Kirim Pesan</span>
      </a>
      <a href="/admin/whatsapp.php?tab=broadcast" class="nav-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 14a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 3.18h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 10a16 16 0 0 0 6.09 6.09l.95-.95a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 17.42z"/></svg>
        <span>Broadcast</span>
      </a>
      <a href="/admin/whatsapp.php?tab=history" class="nav-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        <span>Riwayat Pesan</span>
      </a>
    </div>
    <?php endif; ?>

    <!-- Platform K3 -->
    <?php if (can('resources_admin') || can('registrations') || can('forum_mod') || can('newsletter_admin') || can('incidents_admin') || can('workplace_admin') || can('social_queue') || can('ai_leads')): ?>
    <div class="nav-group">
      <div class="nav-group-label">Platform K3</div>
      <?php if (can('resources_admin')): ?>
      <a href="/admin/resources.php" class="nav-item<?= active('resources.php') ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        <span>Library Resources</span>
      </a>
      <?php endif; ?>
      <?php if (can('forum_mod')): ?>
      <a href="/admin/forum.php" class="nav-item<?= active('forum.php') ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        <span>Forum Moderasi</span>
        <?php
        try { $sb_np = (int)get_pdo()->query("SELECT COUNT(*) FROM forum_topics WHERE is_approved=0 AND is_active=1")->fetchColumn(); }
        catch(Exception $e){$sb_np=0;}
        if ($sb_np > 0): ?><span class="nav-badge"><?= $sb_np ?></span><?php endif; ?>
      </a>
      <?php endif; ?>
      <?php if (can('incidents_admin')): ?>
      <a href="/admin/incidents.php" class="nav-item<?= active('incidents.php') ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        <span>Database Insiden</span>
      </a>
      <?php endif; ?>
      <?php if (can('workplace_admin')): ?>
      <a href="/admin/workplace.php" class="nav-item<?= active('workplace.php') ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
        <span>Workplace K3</span>
      </a>
      <?php endif; ?>
      <?php if (can('newsletter_admin')): ?>
      <a href="/admin/newsletter.php" class="nav-item<?= active('newsletter.php') ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
        <span>Newsletter</span>
      </a>
      <?php endif; ?>
      <?php if (can('ai_leads')): ?>
      <a href="/admin/ai-leads.php" class="nav-item<?= active('ai-leads.php') ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>
        <span>AI Lead Scoring</span>
      </a>
      <?php endif; ?>
      <?php if (can('social_queue')): ?>
      <a href="/admin/social-media.php" class="nav-item<?= active('social-media.php') ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
        <span>Konten Sosmed</span>
      </a>
      <?php endif; ?>
    </div>
    <?php endif; ?>

    <!-- Reports -->
    <?php if (can('reports')): ?>
    <a href="/admin/reports.php" class="nav-item<?= active('reports.php') ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
      <span>Laporan & Analitik</span>
    </a>
    <?php endif; ?>

    <!-- User Management -->
    <?php if (can('users')): ?>
    <a href="/admin/users.php" class="nav-item<?= active('users.php') ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
      <span>Kelola Pengguna</span>
      <?php
      $sb_pending = (int)get_pdo()->query("SELECT COUNT(*) FROM user_registrations WHERE status='pending'")->fetchColumn();
      if ($sb_pending > 0): ?>
      <span class="nav-badge"><?= $sb_pending ?></span>
      <?php endif; ?>
    </a>
    <?php endif; ?>

  </nav>

  <!-- Footer links -->
  <div class="sidebar-footer">
    <a href="/" target="_blank" class="sidebar-footer-link">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
      Lihat Website
    </a>
    <a href="/admin/logout.php" class="sidebar-footer-link sidebar-logout">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
      Keluar
    </a>
  </div>
</aside>
