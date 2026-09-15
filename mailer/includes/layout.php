<?php
declare(strict_types=1);

function layout_header(string $title, string $active = ''): void
{
    $admin = current_admin();
    $flash = flash_get();
    $nav = [
        'dashboard' => ['dashboard.php', 'Dashboard'],
        'contacts'  => ['contacts.php', 'Contacts'],
        'campaigns' => ['campaigns.php', 'Campaigns'],
        'templates' => ['templates.php', 'Templates'],
        'settings'  => ['settings.php', 'Settings'],
    ];
    ?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<title><?= e($title) ?> — Wahana Mailer</title>
<link rel="stylesheet" href="<?= e(mailer_url('assets/admin.css')) ?>">
</head>
<body>
<?php if ($admin): ?>
<header class="topbar">
  <div class="topbar-inner">
    <a class="brand" href="<?= e(mailer_url('dashboard.php')) ?>">Wahana Mailer</a>
    <nav>
      <?php foreach ($nav as $key => [$href, $label]): ?>
        <a href="<?= e(mailer_url($href)) ?>" class="<?= $active === $key ? 'active' : '' ?>"><?= e($label) ?></a>
      <?php endforeach; ?>
    </nav>
    <div class="topbar-user">
      <span><?= e($admin['name'] !== '' ? $admin['name'] : $admin['email']) ?></span>
      <a href="<?= e(mailer_url('logout.php')) ?>">Logout</a>
    </div>
  </div>
</header>
<?php endif; ?>
<main class="page">
  <?php if ($flash): ?>
    <div class="flash flash-<?= e($flash['type']) ?>"><?= e($flash['message']) ?></div>
  <?php endif; ?>
  <h1 class="page-title"><?= e($title) ?></h1>
<?php
}

function layout_footer(): void
{
    ?>
</main>
</body>
</html>
<?php
}
