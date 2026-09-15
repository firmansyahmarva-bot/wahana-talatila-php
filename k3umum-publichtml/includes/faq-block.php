<?php /** FAQ BLOCK — visible accordion. FAQPage JSON-LD only fires for f4 (see schema.php). */
if (!empty($faq)):
?>
<section class="faq" aria-labelledby="faq-h">
  <h2 id="faq-h">Pertanyaan yang Sering Diajukan</h2>
  <?php foreach ($faq as $qa): ?>
  <details class="faq-item">
    <summary><?= e($qa['q']) ?></summary>
    <p><?= e($qa['a']) ?></p>
  </details>
  <?php endforeach; ?>
</section>
<?php endif; ?>
