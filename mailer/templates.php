<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';
require_login();

$templates = mailer_list_templates();

layout_header('Templates', 'templates');
?>
<p class="muted">Templates are detected automatically from the <code>/templates/</code> folder — drop in a new folder with <code>template.html</code> + <code>config.json</code> and it appears here with no code changes. See each folder's <code>PROMPT.txt</code> for the design spec an AI should follow to build a new one.</p>

<div class="tpl-grid">
  <?php foreach ($templates as $t): ?>
    <div class="tpl-card">
      <div class="tpl-thumb">
        <?php if ($t['preview']): ?>
          <img src="<?= e(mailer_url('templates/' . $t['slug'] . '/' . $t['preview'])) ?>" alt="<?= e($t['name']) ?>">
        <?php else: ?><?= e($t['name']) ?><?php endif; ?>
      </div>
      <div class="tpl-body">
        <h3><?= e($t['name']) ?></h3>
        <p><?= e($t['description']) ?></p>
        <p class="small muted"><?= count($t['fields']) ?> editable field(s)</p>
        <div class="actions-row">
          <a class="btn btn-sm btn-outline" target="_blank" href="<?= e(mailer_url('preview.php?template=' . urlencode($t['slug']))) ?>">Preview sample</a>
          <a class="btn btn-sm" href="<?= e(mailer_url('compose.php?template=' . urlencode($t['slug']))) ?>">Use this template</a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
  <?php if (!$templates): ?><p class="muted">No templates found.</p><?php endif; ?>
</div>

<?php layout_footer(); ?>
