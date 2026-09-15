<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';
require_login();

$pdo = db();

if (($_GET['export'] ?? '') === 'csv') {
    $rows = $pdo->query('SELECT email, name, company, tags, status, created_at FROM contacts ORDER BY created_at ASC')->fetchAll();
    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="contacts-export-' . date('Y-m-d') . '.csv"');
    $out = fopen('php://output', 'w');
    fputcsv($out, ['email', 'name', 'company', 'tags', 'status', 'created_at']);
    foreach ($rows as $r) {
        fputcsv($out, [$r['email'], $r['name'], $r['company'], $r['tags'], $r['status'], $r['created_at']]);
    }
    fclose($out);
    exit;
}

if (is_post()) {
    csrf_verify();
    $action = (string)($_POST['action'] ?? '');

    if ($action === 'add' || $action === 'edit') {
        $id = (int)($_POST['id'] ?? 0);
        $name = trim((string)($_POST['name'] ?? ''));
        $email = trim(strtolower((string)($_POST['email'] ?? '')));
        $company = trim((string)($_POST['company'] ?? ''));
        $tags = trim((string)($_POST['tags'] ?? ''));

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            flash_set('error', 'Enter a valid email address.');
        } else {
            try {
                if ($action === 'add') {
                    $stmt = $pdo->prepare('INSERT INTO contacts (email, name, company, tags, unsubscribe_token, created_at) VALUES (?, ?, ?, ?, ?, NOW())');
                    $stmt->execute([$email, $name, $company ?: null, $tags ?: null, bin2hex(random_bytes(20))]);
                    flash_set('success', 'Contact added.');
                } else {
                    $stmt = $pdo->prepare('UPDATE contacts SET email = ?, name = ?, company = ?, tags = ? WHERE id = ?');
                    $stmt->execute([$email, $name, $company ?: null, $tags ?: null, $id]);
                    flash_set('success', 'Contact updated.');
                }
            } catch (PDOException $ex) {
                flash_set('error', 'That email already exists in the contact list.');
            }
        }
    } elseif ($action === 'toggle') {
        $id = (int)($_POST['id'] ?? 0);
        $new = ($_POST['new_status'] ?? '') === 'active' ? 'active' : 'unsubscribed';
        $pdo->prepare('UPDATE contacts SET status = ? WHERE id = ?')->execute([$new, $id]);
        flash_set('success', 'Status updated.');
    } elseif ($action === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        $pdo->prepare('DELETE FROM contacts WHERE id = ?')->execute([$id]);
        flash_set('success', 'Contact deleted.');
    }
    redirect(mailer_url('contacts.php' . (isset($_GET['q']) ? '?q=' . urlencode((string)$_GET['q']) : '')));
}

$q = trim((string)($_GET['q'] ?? ''));
$statusFilter = (string)($_GET['status'] ?? '');
$page = max(1, (int)($_GET['page'] ?? 1));
$perPage = 30;

$where = [];
$params = [];
if ($q !== '') {
    $where[] = '(email LIKE ? OR name LIKE ? OR company LIKE ?)';
    $like = '%' . $q . '%';
    array_push($params, $like, $like, $like);
}
if (in_array($statusFilter, ['active', 'unsubscribed', 'bounced'], true)) {
    $where[] = 'status = ?';
    $params[] = $statusFilter;
}
$whereSql = $where ? ('WHERE ' . implode(' AND ', $where)) : '';

$total = (int)(function () use ($pdo, $whereSql, $params) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM contacts $whereSql");
    $stmt->execute($params);
    return $stmt->fetchColumn();
})();
$totalPages = max(1, (int)ceil($total / $perPage));
$page = min($page, $totalPages);
$offset = ($page - 1) * $perPage;

$stmt = $pdo->prepare("SELECT * FROM contacts $whereSql ORDER BY created_at DESC LIMIT $perPage OFFSET $offset");
$stmt->execute($params);
$contacts = $stmt->fetchAll();

$editId = (int)($_GET['edit'] ?? 0);
$editing = null;
if ($editId > 0) {
    $stmt = $pdo->prepare('SELECT * FROM contacts WHERE id = ?');
    $stmt->execute([$editId]);
    $editing = $stmt->fetch() ?: null;
}

layout_header('Contacts', 'contacts');
?>

<div class="card">
  <h2><?= $editing ? 'Edit contact' : 'Add contact' ?></h2>
  <form method="post" action="<?= e(mailer_url('contacts.php')) ?>">
    <?= csrf_field() ?>
    <input type="hidden" name="action" value="<?= $editing ? 'edit' : 'add' ?>">
    <?php if ($editing): ?><input type="hidden" name="id" value="<?= (int)$editing['id'] ?>"><?php endif; ?>
    <div class="form-inline">
      <div class="form-row" style="flex:1;min-width:180px"><label>Name</label><input type="text" name="name" value="<?= e($editing['name'] ?? '') ?>"></div>
      <div class="form-row" style="flex:1;min-width:200px"><label>Email</label><input type="email" name="email" required value="<?= e($editing['email'] ?? '') ?>"></div>
      <div class="form-row" style="flex:1;min-width:160px"><label>Company</label><input type="text" name="company" value="<?= e($editing['company'] ?? '') ?>"></div>
      <div class="form-row" style="flex:1;min-width:140px"><label>Tags</label><input type="text" name="tags" value="<?= e($editing['tags'] ?? '') ?>"></div>
      <div class="form-row"><button type="submit" class="btn"><?= $editing ? 'Save' : 'Add' ?></button></div>
      <?php if ($editing): ?><div class="form-row"><a class="btn btn-outline" href="<?= e(mailer_url('contacts.php')) ?>">Cancel</a></div><?php endif; ?>
    </div>
  </form>
</div>

<form method="get" action="<?= e(mailer_url('contacts.php')) ?>" class="search-bar">
  <input type="text" name="q" placeholder="Search name, email, company…" value="<?= e($q) ?>">
  <select name="status" onchange="this.form.submit()">
    <option value="">All statuses</option>
    <option value="active" <?= $statusFilter === 'active' ? 'selected' : '' ?>>Active</option>
    <option value="unsubscribed" <?= $statusFilter === 'unsubscribed' ? 'selected' : '' ?>>Unsubscribed</option>
    <option value="bounced" <?= $statusFilter === 'bounced' ? 'selected' : '' ?>>Bounced</option>
  </select>
  <button type="submit" class="btn btn-outline">Filter</button>
  <span class="muted" style="align-self:center"><?= number_format($total) ?> contacts</span>
</form>

<div class="table-wrap">
  <table>
    <thead><tr><th>Name</th><th>Email</th><th>Company</th><th>Tags</th><th>Status</th><th></th></tr></thead>
    <tbody>
    <?php foreach ($contacts as $c): ?>
      <tr>
        <td><?= e($c['name']) ?></td>
        <td><?= e($c['email']) ?></td>
        <td><?= e((string)$c['company']) ?></td>
        <td class="muted small"><?= e((string)$c['tags']) ?></td>
        <td><span class="badge badge-<?= e($c['status']) ?>"><?= e($c['status']) ?></span></td>
        <td>
          <a href="<?= e(mailer_url('contacts.php?edit=' . (int)$c['id'])) ?>">Edit</a>
          &nbsp;
          <form method="post" action="<?= e(mailer_url('contacts.php')) ?>" style="display:inline">
            <?= csrf_field() ?>
            <input type="hidden" name="action" value="toggle">
            <input type="hidden" name="id" value="<?= (int)$c['id'] ?>">
            <input type="hidden" name="new_status" value="<?= $c['status'] === 'active' ? 'unsubscribed' : 'active' ?>">
            <button type="submit" class="btn btn-sm btn-outline"><?= $c['status'] === 'active' ? 'Unsubscribe' : 'Reactivate' ?></button>
          </form>
          <form method="post" action="<?= e(mailer_url('contacts.php')) ?>" style="display:inline" onsubmit="return confirm('Delete this contact permanently?')">
            <?= csrf_field() ?>
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="<?= (int)$c['id'] ?>">
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
    <?php if (!$contacts): ?><tr><td colspan="6" class="muted">No contacts found.</td></tr><?php endif; ?>
    </tbody>
  </table>
</div>

<?php if ($totalPages > 1): ?>
<div class="pagination">
  <?php for ($p = 1; $p <= $totalPages; $p++): ?>
    <?php if ($p === $page): ?><span class="current"><?= $p ?></span>
    <?php else: ?><a href="<?= e(mailer_url('contacts.php?page=' . $p . '&q=' . urlencode($q) . '&status=' . urlencode($statusFilter))) ?>"><?= $p ?></a>
    <?php endif; ?>
  <?php endfor; ?>
</div>
<?php endif; ?>

<div class="actions-row">
  <a class="btn btn-outline" href="<?= e(mailer_url('contacts-import.php')) ?>">Import CSV</a>
  <a class="btn btn-outline" href="<?= e(mailer_url('contacts.php?export=csv')) ?>">Export Contacts (CSV)</a>
</div>

<?php layout_footer(); ?>
