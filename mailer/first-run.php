<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';

/**
 * One-time bootstrap to create the first admin account. Self-locks forever
 * once any row exists in admin_users. Delete this file after use if you want
 * the extra peace of mind — it is safe to leave in place either way.
 *
 * Named "first-run.php" rather than "setup.php" because Hostinger's platform
 * firewall blocks requests to common installer filenames (setup.php,
 * install.php, etc.) by pattern before they even reach PHP.
 */

$adminCount = (int)db()->query('SELECT COUNT(*) FROM admin_users')->fetchColumn();
if ($adminCount > 0) {
    layout_header('Setup');
    echo '<div class="auth-wrap"><div class="card"><p>Setup has already been completed. '
       . '<a href="' . e(mailer_url('login.php')) . '">Go to login</a>.</p></div></div>';
    layout_footer();
    exit;
}

$error = null;

if (is_post()) {
    csrf_verify();
    $name = trim((string)($_POST['name'] ?? ''));
    $email = trim((string)($_POST['email'] ?? ''));
    $password = (string)($_POST['password'] ?? '');
    $confirm = (string)($_POST['confirm'] ?? '');

    if ($name === '' || $email === '' || $password === '') {
        $error = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Enter a valid email address.';
    } elseif (strlen($password) < 10) {
        $error = 'Password must be at least 10 characters.';
    } elseif ($password !== $confirm) {
        $error = 'Passwords do not match.';
    } else {
        $stmt = db()->prepare('INSERT INTO admin_users (email, password_hash, name, created_at) VALUES (?, ?, ?, NOW())');
        $stmt->execute([$email, password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]), $name]);
        session_regenerate_id(true);
        $_SESSION['admin_id'] = (int)db()->lastInsertId();
        flash_set('success', 'Admin account created. For extra safety, consider deleting first-run.php from the server now.');
        redirect(mailer_url('dashboard.php'));
    }
}

layout_header('Setup');
?>
<div class="auth-wrap">
  <div class="card">
    <h1>Create the first admin account</h1>
    <?php if ($error): ?><div class="flash flash-error"><?= e($error) ?></div><?php endif; ?>
    <form method="post" action="<?= e(mailer_url('first-run.php')) ?>">
      <?= csrf_field() ?>
      <div class="form-row">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required autofocus>
      </div>
      <div class="form-row">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-row">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required minlength="10">
        <div class="hint">Minimum 10 characters.</div>
      </div>
      <div class="form-row">
        <label for="confirm">Confirm password</label>
        <input type="password" id="confirm" name="confirm" required minlength="10">
      </div>
      <button type="submit" class="btn" style="width:100%">Create account</button>
    </form>
  </div>
</div>
<?php layout_footer(); ?>
