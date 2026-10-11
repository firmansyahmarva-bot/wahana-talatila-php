<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';

if (current_admin()) {
    redirect(mailer_url('dashboard.php'));
}

$error = null;

if (is_post()) {
    csrf_verify();
    $email = trim((string)($_POST['email'] ?? ''));
    $password = (string)($_POST['password'] ?? '');
    $result = attempt_login($email, $password);
    if ($result['ok']) {
        redirect(mailer_url('dashboard.php'));
    }
    $error = $result['error'];
}

// First-run bootstrap: if no admin exists yet, send them to setup instead of a dead-end login.
$adminCount = (int)db()->query('SELECT COUNT(*) FROM admin_users')->fetchColumn();
if ($adminCount === 0) {
    redirect(mailer_url('first-run.php'));
}

layout_header('Login');
?>
<div class="auth-wrap">
  <div class="card">
    <h1>Wahana Mailer</h1>
    <?php if ($error): ?><div class="flash flash-error"><?= e($error) ?></div><?php endif; ?>
    <form method="post" action="<?= e(mailer_url('login.php')) ?>">
      <?= csrf_field() ?>
      <div class="form-row">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required autofocus>
      </div>
      <div class="form-row">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit" class="btn" style="width:100%">Sign in</button>
    </form>
  </div>
</div>
<?php layout_footer(); ?>
