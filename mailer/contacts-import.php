<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';
require_login();

$summary = null;

if (is_post()) {
    csrf_verify();

    if (empty($_FILES['csv']) || $_FILES['csv']['error'] !== UPLOAD_ERR_OK) {
        flash_set('error', 'Please choose a CSV file to upload.');
        redirect(mailer_url('contacts-import.php'));
    }

    $tmpPath = $_FILES['csv']['tmp_name'];
    $originalName = (string)$_FILES['csv']['name'];
    if (strtolower((string)pathinfo($originalName, PATHINFO_EXTENSION)) !== 'csv') {
        flash_set('error', 'File must be a .csv file.');
        redirect(mailer_url('contacts-import.php'));
    }
    if ($_FILES['csv']['size'] > 8 * 1024 * 1024) {
        flash_set('error', 'File is too large (max 8MB).');
        redirect(mailer_url('contacts-import.php'));
    }

    $handle = fopen($tmpPath, 'r');
    if ($handle === false) {
        flash_set('error', 'Could not read the uploaded file.');
        redirect(mailer_url('contacts-import.php'));
    }

    // Strip a UTF-8 BOM if Excel added one.
    $bom = fread($handle, 3);
    if ($bom !== "\xEF\xBB\xBF") {
        rewind($handle);
    }

    $header = fgetcsv($handle);
    if ($header === false) {
        fclose($handle);
        flash_set('error', 'The CSV file appears to be empty.');
        redirect(mailer_url('contacts-import.php'));
    }
    $header = array_map(static fn($h) => strtolower(trim((string)$h)), $header);
    $colIndex = array_flip($header);

    if (!isset($colIndex['email'])) {
        fclose($handle);
        flash_set('error', 'CSV must include an "email" column header.');
        redirect(mailer_url('contacts-import.php'));
    }

    $pdo = db();
    $upsert = $pdo->prepare(
        'INSERT INTO contacts (email, name, company, tags, unsubscribe_token, created_at)
         VALUES (?, ?, ?, ?, ?, NOW())
         ON DUPLICATE KEY UPDATE name = VALUES(name), company = VALUES(company), tags = VALUES(tags)'
    );

    $imported = 0;
    $skipped = 0;
    $pdo->beginTransaction();
    while (($row = fgetcsv($handle)) !== false) {
        $email = trim(strtolower((string)($row[$colIndex['email']] ?? '')));
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $skipped++;
            continue;
        }
        $name = isset($colIndex['name']) ? trim((string)($row[$colIndex['name']] ?? '')) : '';
        $company = isset($colIndex['company']) ? trim((string)($row[$colIndex['company']] ?? '')) : '';
        $tags = isset($colIndex['tags']) ? trim((string)($row[$colIndex['tags']] ?? '')) : '';

        $upsert->execute([$email, $name, $company ?: null, $tags ?: null, bin2hex(random_bytes(20))]);
        $imported++;
    }
    $pdo->commit();
    fclose($handle);

    $summary = ['imported' => $imported, 'skipped' => $skipped];
    flash_set('success', "$imported contact(s) imported/updated, $skipped row(s) skipped (invalid or missing email).");
    redirect(mailer_url('contacts.php'));
}

layout_header('Import Contacts', 'contacts');
?>

<div class="card">
  <h2>Import CSV</h2>
  <p class="muted">The file needs a header row. Only <code>email</code> is required — <code>name</code>, <code>company</code>, and <code>tags</code> are optional and can be in any column order. Importing an email that already exists updates that contact instead of duplicating it.</p>
  <form method="post" action="<?= e(mailer_url('contacts-import.php')) ?>" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <div class="form-row">
      <label for="csv">CSV file</label>
      <input type="file" id="csv" name="csv" accept=".csv" required>
    </div>
    <button type="submit" class="btn">Import</button>
    <a class="btn btn-outline" href="<?= e(mailer_url('contacts.php')) ?>">Back to contacts</a>
  </form>
</div>

<?php layout_footer(); ?>
