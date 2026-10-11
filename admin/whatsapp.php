<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/partials/auth.php';
require_auth('whatsapp');

$pdo = get_pdo();
$tab = $_GET['tab'] ?? 'send';

// ── Log sent message ──────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_verify($_POST['csrf_token'] ?? '')) {
    $action = $_POST['action'] ?? '';

    if ($action === 'log_send') {
        $client_id  = ($_POST['client_id']??'') !== '' ? (int)$_POST['client_id'] : null;
        $cert_id    = ($_POST['cert_id']??'') !== '' ? (int)$_POST['cert_id'] : null;
        $phone      = trim($_POST['phone'] ?? '');
        $msg_type   = $_POST['message_type'] ?? 'custom';
        $msg_text   = trim($_POST['message_text'] ?? '');

        if ($phone && $msg_text) {
            $pdo->prepare("INSERT INTO wa_logs (certification_id,client_id,phone,message_type,message_text,sent_by) VALUES (?,?,?,?,?,?)")
                ->execute([$cert_id,$client_id,$phone,$msg_type,$msg_text,current_user_id()]);
        }
        echo json_encode(['ok'=>true]); exit;
    }
}

// ── Load templates ────────────────────────────────────────────────────────
$templates = $pdo->query("SELECT * FROM wa_templates WHERE is_active=1 ORDER BY type ASC")->fetchAll();

// ── Load clients with expiring certs ──────────────────────────────────────
$expiring_clients = $pdo->query(
    "SELECT c.id, c.client_id, c.course_id, c.expiry_date,
            cl.name AS client_name, cl.phone,
            t.name AS course_name,
            DATEDIFF(c.expiry_date, NOW()) AS days_left
     FROM certifications c
     JOIN clients cl ON cl.id = c.client_id
     JOIN trainings t ON t.id  = c.course_id
     WHERE c.expiry_date BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND DATE_ADD(NOW(), INTERVAL 30 DAY)
     AND cl.phone IS NOT NULL AND cl.phone != ''
     ORDER BY c.expiry_date ASC"
)->fetchAll();

// ── Unpaid invoice clients ─────────────────────────────────────────────────
$unpaid_clients = $pdo->query(
    "SELECT i.id AS invoice_id, i.invoice_number, i.total_amount, i.paid_amount,
            COALESCE(co.name, cl.name) AS recipient,
            COALESCE(co.pic_phone, cl.phone) AS phone
     FROM invoices i
     LEFT JOIN companies co ON co.id = i.company_id
     LEFT JOIN clients cl ON cl.id = i.client_id
     WHERE i.status IN ('sent','partial','overdue')
     AND COALESCE(co.pic_phone, cl.phone) IS NOT NULL
     LIMIT 20"
)->fetchAll();

// ── WA Log history ─────────────────────────────────────────────────────────
$log_filter = $_GET['log_filter'] ?? 'all';
$log_where  = $log_filter !== 'all' ? "WHERE wl.message_type='$log_filter'" : '';
$wa_logs    = $pdo->query(
    "SELECT wl.*, cl.name AS client_name, t.name AS course_name
     FROM wa_logs wl
     LEFT JOIN clients cl ON cl.id = wl.client_id
     LEFT JOIN certifications c ON c.id = wl.certification_id
     LEFT JOIN trainings t ON t.id = c.course_id
     $log_where
     ORDER BY wl.sent_at DESC
     LIMIT 50"
)->fetchAll();

// ── All clients for broadcast ──────────────────────────────────────────────
$all_clients = $pdo->query(
    "SELECT cl.id, cl.name, cl.phone, co.name AS company_name
     FROM clients cl
     LEFT JOIN companies co ON co.id = cl.company_id
     WHERE cl.phone IS NOT NULL AND cl.phone != '' AND cl.is_active=1
     ORDER BY cl.name ASC"
)->fetchAll();

$wa_number = get_setting('wa_number', '6287759151278');
$flash = flash_get();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>WhatsApp — Wahana Totalita Admin</title>
<meta name="robots" content="noindex,nofollow">
<link rel="stylesheet" href="/admin/assets/admin.css">
<style>
.wa-msg-preview{background:#dcfce7;border-radius:10px 10px 0 10px;padding:12px 14px;font-size:13px;line-height:1.6;white-space:pre-wrap;word-break:break-word;max-width:380px;border:1px solid #bbf7d0}
.tab-nav{display:flex;border-bottom:2px solid var(--border,#e5e9ef);margin-bottom:20px;gap:0}
.tab-nav a{padding:10px 20px;font-size:13px;font-weight:600;color:var(--muted,#6b7280);border-bottom:2px solid transparent;margin-bottom:-2px;transition:all .15s}
.tab-nav a.active{color:var(--green,#0A4A2E);border-bottom-color:var(--green,#0A4A2E)}
</style>
</head>
<body>
<div class="admin-layout">
  <div class="mobile-overlay" id="mobileOverlay"></div>
  <?php require __DIR__ . '/partials/sidebar.php'; ?>
  <main class="admin-main">
    <div class="admin-topbar">
      <button class="topbar-hamburger" id="hamburger"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg></button>
      <div class="topbar-title">WhatsApp Center</div>
    </div>

    <div class="admin-content">
      <?php if ($flash): ?>
      <div id="flash-message" class="alert alert-<?= $flash['type']==='success'?'success':'error' ?>"><?= e($flash['message']) ?></div>
      <?php endif; ?>

      <!-- Tabs -->
      <div class="tab-nav">
        <a href="?tab=send"      class="<?= $tab==='send'?'active':'' ?>">📤 Kirim Pesan</a>
        <a href="?tab=expiring"  class="<?= $tab==='expiring'?'active':'' ?>">⏰ Reminder Expiry (<?= count($expiring_clients) ?>)</a>
        <a href="?tab=payment"   class="<?= $tab==='payment'?'active':'' ?>">💰 Reminder Bayar (<?= count($unpaid_clients) ?>)</a>
        <a href="?tab=broadcast" class="<?= $tab==='broadcast'?'active':'' ?>">📡 Broadcast</a>
        <a href="?tab=history"   class="<?= $tab==='history'?'active':'' ?>">📋 Riwayat</a>
      </div>

      <!-- ── SEND TAB ── -->
      <?php if ($tab === 'send'): ?>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
        <div class="card">
          <div class="card-header"><div class="card-title">Kirim Pesan Manual</div></div>
          <div class="card-body">
            <div class="form-group">
              <label class="form-label">Nomor WhatsApp</label>
              <input type="tel" id="sendPhone" class="form-input" placeholder="081234567890">
            </div>
            <div class="form-group">
              <label class="form-label">Template Pesan</label>
              <select id="templateSelect" class="form-select" onchange="loadTemplate(this.value)">
                <option value="">-- Pilih Template (opsional) --</option>
                <?php foreach ($templates as $tpl): ?>
                <option value="<?= $tpl['id'] ?>" data-msg="<?= e($tpl['message']) ?>"><?= e($tpl['name']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label class="form-label">Pesan <span>*</span></label>
              <textarea id="sendMessage" class="form-textarea" rows="6" oninput="updatePreview()"
                        placeholder="Ketik pesan Anda..."></textarea>
            </div>
            <div class="btn-group">
              <button class="btn btn-wa" onclick="sendManualWA()">
                📱 Buka WhatsApp & Kirim
              </button>
              <button class="btn btn-outline" onclick="copyMessage()">📋 Copy Pesan</button>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header"><div class="card-title">Preview Pesan</div></div>
          <div class="card-body">
            <div style="background:#f0f4f8;border-radius:12px;padding:20px;min-height:200px">
              <div style="text-align:center;font-size:11px;color:#9ca3af;margin-bottom:12px">Preview tampilan WA</div>
              <div class="wa-msg-preview" id="msgPreview">Pesan akan tampil di sini...</div>
            </div>
          </div>
        </div>
      </div>

      <!-- ── EXPIRING REMINDER TAB ── -->
      <?php elseif ($tab === 'expiring'): ?>
      <div class="card">
        <div class="card-header">
          <div class="card-title">⏰ Kirim Reminder Sertifikasi Akan Kedaluwarsa</div>
          <button class="btn btn-sm btn-wa" onclick="sendAllExpiring()">📡 Kirim Semua (<?= count($expiring_clients) ?>)</button>
        </div>
        <div class="table-wrap">
          <table class="admin-table">
            <thead><tr><th><input type="checkbox" id="checkAll" onchange="toggleAll(this)"></th><th>Peserta</th><th>Program</th><th>Kedaluwarsa</th><th>Sisa</th><th>Aksi</th></tr></thead>
            <tbody>
              <?php foreach ($expiring_clients as $ec):
                $days = (int)$ec['days_left'];
                $badge = $days < 0 ? 'badge-expired' : ($days <= 7 ? 'badge-expired' : 'badge-expiring');
                // Build WA message
                if ($days < 0) {
                  $msg = "Halo {$ec['client_name']}, sertifikasi *{$ec['course_name']}* Anda telah *kedaluwarsa* sejak " . date('d M Y', strtotime($ec['expiry_date'])) . ".\n\nSegera perpanjang:\n🌐 wahanatotalita.com\n📱 wa.me/6287759151278";
                } elseif ($days <= 7) {
                  $msg = "Halo {$ec['client_name']}, PENGINGAT PENTING ⚠️\n\nSertifikasi *{$ec['course_name']}* Anda akan kedaluwarsa dalam *{$days} hari* (" . date('d M Y', strtotime($ec['expiry_date'])) . ").\n\nJangan sampai terlambat!\n🌐 wahanatotalita.com\n📱 wa.me/6287759151278";
                } else {
                  $msg = "Halo {$ec['client_name']}, sertifikasi *{$ec['course_name']}* Anda akan kedaluwarsa pada " . date('d M Y', strtotime($ec['expiry_date'])) . " ({$days} hari lagi).\n\nSegera perpanjang:\n🌐 wahanatotalita.com\n📱 wa.me/6287759151278";
                }
              ?>
              <tr data-phone="<?= e($ec['phone']) ?>" data-msg="<?= e(addslashes($msg)) ?>">
                <td><input type="checkbox" class="row-check" value="1"></td>
                <td><strong><?= e($ec['client_name']) ?></strong><div style="font-size:11px;color:#6b7280"><?= e($ec['phone']) ?></div></td>
                <td><?= e($ec['course_name']) ?></td>
                <td><?= date('d M Y', strtotime($ec['expiry_date'])) ?></td>
                <td><span class="badge <?= $badge ?>"><?= $days < 0 ? abs($days).' hari lalu' : $days.' hari' ?></span></td>
                <td>
                  <button class="btn btn-xs btn-wa"
                          onclick="sendAndLog('<?= e($ec['phone']) ?>','<?= e(addslashes($msg)) ?>',<?= $ec['client_id']??'null' ?>,<?= $ec['id'] ?>,<?= $days<0?'\'expired\'':($days<=7?'\'7_days\'':'\'30_days\'') ?>)">
                    📱 Kirim
                  </button>
                </td>
              </tr>
              <?php endforeach; ?>
              <?php if (empty($expiring_clients)): ?>
              <tr><td colspan="6"><div class="empty-state"><div class="empty-state-icon">✅</div><h3>Tidak ada sertifikasi yang akan kedaluwarsa</h3></div></td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- ── PAYMENT REMINDER TAB ── -->
      <?php elseif ($tab === 'payment'): ?>
      <div class="card">
        <div class="card-header"><div class="card-title">💰 Reminder Pembayaran Belum Lunas</div></div>
        <div class="table-wrap">
          <table class="admin-table">
            <thead><tr><th>Klien / Perusahaan</th><th>No Invoice</th><th>Total</th><th>Terbayar</th><th>Sisa</th><th>Aksi</th></tr></thead>
            <tbody>
              <?php foreach ($unpaid_clients as $uc):
                $sisa = $uc['total_amount'] - $uc['paid_amount'];
                $msg = "Halo {$uc['recipient']}, pembayaran *Invoice {$uc['invoice_number']}* sebesar *Rp " . number_format($sisa,0,',','.') . "* belum lunas.\n\nMohon segera selesaikan pembayaran untuk melanjutkan proses sertifikasi.\n\nTerima kasih 🙏\n\n📱 wa.me/6287759151278";
              ?>
              <tr>
                <td><strong><?= e($uc['recipient']) ?></strong><div style="font-size:11px;color:#6b7280"><?= e($uc['phone']) ?></div></td>
                <td style="font-family:monospace"><?= e($uc['invoice_number']) ?></td>
                <td>Rp <?= number_format($uc['total_amount'],0,',','.') ?></td>
                <td>Rp <?= number_format($uc['paid_amount'],0,',','.') ?></td>
                <td><strong style="color:#ef4444">Rp <?= number_format($sisa,0,',','.') ?></strong></td>
                <td>
                  <button class="btn btn-xs btn-wa"
                          onclick="sendAndLog('<?= e($uc['phone']) ?>','<?= e(addslashes($msg)) ?>',null,null,'payment')">
                    📱 Ingatkan
                  </button>
                </td>
              </tr>
              <?php endforeach; ?>
              <?php if (empty($unpaid_clients)): ?>
              <tr><td colspan="6"><div class="empty-state"><div class="empty-state-icon">✅</div><h3>Semua invoice sudah lunas</h3></div></td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- ── BROADCAST TAB ── -->
      <?php elseif ($tab === 'broadcast'): ?>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
        <div class="card">
          <div class="card-header"><div class="card-title">📡 Broadcast ke Banyak Peserta</div></div>
          <div class="card-body">
            <div class="alert alert-warning">⚠️ Broadcast membuka WA satu per satu. Kirim pesan ke masing-masing secara manual.</div>
            <div class="form-group" style="margin-top:12px">
              <label class="form-label">Pesan Broadcast</label>
              <textarea id="broadcastMsg" class="form-textarea" rows="5" placeholder="Ketik pesan broadcast...">Halo {nama}, kami dari Wahana Totalita Konsultan ingin menyampaikan informasi terbaru mengenai program pelatihan sertifikasi kami. Kunjungi wahanatotalita.com untuk info lebih lanjut.</textarea>
            </div>
            <div class="form-group">
              <label class="form-label">Pilih Penerima</label>
              <div style="max-height:280px;overflow-y:auto;border:1.5px solid var(--border,#e5e9ef);border-radius:8px;padding:8px">
                <div style="padding:6px 8px;border-bottom:1px solid var(--border,#e5e9ef);margin-bottom:6px">
                  <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-weight:600;font-size:13px">
                    <input type="checkbox" id="bcCheckAll" onchange="toggleBroadcast(this)"> Pilih Semua (<?= count($all_clients) ?>)
                  </label>
                </div>
                <?php foreach ($all_clients as $cl): ?>
                <label style="display:flex;align-items:center;gap:8px;padding:5px 8px;cursor:pointer;font-size:12px;border-radius:6px" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background=''">
                  <input type="checkbox" class="bc-check" value="<?= e($cl['phone']) ?>" data-name="<?= e($cl['name']) ?>">
                  <span><strong><?= e($cl['name']) ?></strong><?= $cl['company_name'] ? ' — '.$cl['company_name'] : '' ?></span>
                </label>
                <?php endforeach; ?>
              </div>
            </div>
            <button class="btn btn-wa" onclick="startBroadcast()" style="width:100%;margin-top:8px">
              📡 Mulai Broadcast
            </button>
          </div>
        </div>
        <div class="card">
          <div class="card-header"><div class="card-title">Preview & Progress</div></div>
          <div class="card-body">
            <div id="bcPreview" style="background:#f0f4f8;border-radius:8px;padding:16px;min-height:100px;font-size:13px;color:#6b7280">Preview pesan akan tampil di sini...</div>
            <div id="bcProgress" style="display:none;margin-top:16px">
              <div class="progress"><div id="bcProgressBar" class="progress-bar" style="width:0%"></div></div>
              <div id="bcProgressText" style="font-size:12px;color:#6b7280;margin-top:6px">0 / 0 dikirim</div>
            </div>
          </div>
        </div>
      </div>

      <!-- ── HISTORY TAB ── -->
      <?php elseif ($tab === 'history'): ?>
      <div class="card">
        <div class="card-header">
          <div class="card-title">📋 Riwayat Pesan WhatsApp</div>
        </div>
        <div class="filter-bar">
          <div class="filter-chips">
            <?php foreach (['all'=>'Semua','30_days'=>'30 Hari','7_days'=>'7 Hari','expired'=>'Expired','payment'=>'Pembayaran','custom'=>'Manual','broadcast'=>'Broadcast'] as $k=>$v): ?>
            <a href="?tab=history&log_filter=<?= $k ?>" class="filter-chip <?= $log_filter===$k?'active':'' ?>"><?= $v ?></a>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="table-wrap">
          <table class="admin-table">
            <thead><tr><th>Waktu</th><th>Klien</th><th>No HP</th><th>Tipe</th><th>Pesan</th></tr></thead>
            <tbody>
              <?php foreach ($wa_logs as $log): ?>
              <tr>
                <td style="white-space:nowrap;font-size:12px"><?= date('d M Y H:i', strtotime($log['sent_at'])) ?></td>
                <td><?= e($log['client_name'] ?? '—') ?></td>
                <td><?= e($log['phone']) ?></td>
                <td><span class="badge badge-active" style="font-size:10px"><?= e(str_replace('_',' ', $log['message_type'])) ?></span></td>
                <td style="max-width:300px;font-size:12px">
                  <div style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis" title="<?= e($log['message_text']) ?>">
                    <?= e(substr($log['message_text'],0,80)) ?><?= strlen($log['message_text'])>80?'...':'' ?>
                  </div>
                </td>
              </tr>
              <?php endforeach; ?>
              <?php if (empty($wa_logs)): ?>
              <tr><td colspan="5"><div class="empty-state"><div class="empty-state-icon">📭</div><h3>Belum ada riwayat</h3></div></td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
      <?php endif; ?>

    </div>
  </main>
</div>

<script src="/admin/assets/admin.js"></script>
<script>
// Manual send
function sendManualWA() {
  var phone = document.getElementById('sendPhone').value.trim();
  var msg   = document.getElementById('sendMessage').value.trim();
  if (!phone || !msg) { alert('Isi nomor HP dan pesan terlebih dahulu.'); return; }
  sendWA(phone, msg);
}
function loadTemplate(id) {
  var sel = document.getElementById('templateSelect');
  var opt = sel.options[sel.selectedIndex];
  if (opt && opt.dataset.msg) {
    document.getElementById('sendMessage').value = opt.dataset.msg;
    updatePreview();
  }
}
function updatePreview() {
  var msg = document.getElementById('sendMessage')?.value || '';
  document.getElementById('msgPreview').textContent = msg || 'Pesan akan tampil di sini...';
}
function copyMessage() {
  var msg = document.getElementById('sendMessage').value;
  navigator.clipboard.writeText(msg).then(function(){ alert('Pesan berhasil dicopy!'); });
}

// Send & log
function sendAndLog(phone, msg, clientId, certId, type) {
  sendWA(phone, msg);
  // Log via AJAX
  var fd = new FormData();
  fd.append('action','log_send');
  fd.append('csrf_token','<?= csrf_token() ?>');
  fd.append('phone', phone);
  fd.append('message_text', msg);
  fd.append('message_type', type || 'custom');
  if (clientId) fd.append('client_id', clientId);
  if (certId)   fd.append('cert_id', certId);
  fetch('/admin/whatsapp.php', {method:'POST',body:fd});
}

// Toggle all checkboxes
function toggleAll(cb) {
  document.querySelectorAll('.row-check').forEach(function(c){ c.checked = cb.checked; });
}
function toggleBroadcast(cb) {
  document.querySelectorAll('.bc-check').forEach(function(c){ c.checked = cb.checked; });
}

// Broadcast
var bcQueue = [], bcIdx = 0;
function startBroadcast() {
  var msg = document.getElementById('broadcastMsg').value.trim();
  if (!msg) { alert('Tulis pesan broadcast terlebih dahulu.'); return; }
  var checks = document.querySelectorAll('.bc-check:checked');
  if (checks.length === 0) { alert('Pilih minimal 1 penerima.'); return; }
  if (!confirm('Kirim ke ' + checks.length + ' penerima? WA akan terbuka satu per satu.')) return;
  bcQueue = Array.from(checks).map(function(c){ return {phone:c.value, name:c.dataset.name}; });
  bcIdx = 0;
  document.getElementById('bcProgress').style.display = 'block';
  sendNextBroadcast(msg);
}
function sendNextBroadcast(msg) {
  if (bcIdx >= bcQueue.length) {
    document.getElementById('bcProgressText').textContent = bcQueue.length + ' / ' + bcQueue.length + ' selesai ✅';
    return;
  }
  var rec = bcQueue[bcIdx];
  var personalized = msg.replace('{nama}', rec.name);
  sendAndLog(rec.phone, personalized, null, null, 'broadcast');
  bcIdx++;
  var pct = Math.round((bcIdx/bcQueue.length)*100);
  document.getElementById('bcProgressBar').style.width = pct + '%';
  document.getElementById('bcProgressText').textContent = bcIdx + ' / ' + bcQueue.length + ' dikirim';
  // Small delay to prevent spam detection
  if (bcIdx < bcQueue.length) setTimeout(function(){ sendNextBroadcast(msg); }, 3000);
}

// Broadcast preview
document.getElementById('broadcastMsg')?.addEventListener('input', function(){
  document.getElementById('bcPreview').textContent = this.value || 'Preview...';
});
</script>
</body>
</html>
