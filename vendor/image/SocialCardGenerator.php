<?php
/**
 * SocialCardGenerator — generates social media card HTML/JS that renders in browser.
 * Uses HTML5 Canvas → downloads PNG. No server-side GD extension needed.
 * Usage: echo (new SocialCardGenerator())->renderWidget($options);
 */
class SocialCardGenerator {
    private const BRAND_GREEN  = '#0A4A2E';
    private const BRAND_ORANGE = '#C6621C';
    private const SITE_URL     = 'wahanatotalita.com';

    /**
     * Returns a self-contained HTML+JS snippet that renders a canvas card
     * and provides a download button.
     *
     * $options keys:
     *   type: 'tip'|'schedule'|'news'|'promo'|'certificate'
     *   title: string
     *   subtitle: string
     *   body: string (max ~120 chars)
     *   emoji: string (optional)
     *   bg_color: hex (optional, default brand green)
     *   hashtags: string (optional)
     *   size: '1080x1080'|'1080x1920' (default square)
     */
    public function renderWidget(array $options = []): string {
        $type     = $options['type']     ?? 'tip';
        $title    = htmlspecialchars($options['title']    ?? 'Wahana Totalita Konsultan', ENT_QUOTES);
        $subtitle = htmlspecialchars($options['subtitle'] ?? 'Pelatihan K3 & Sertifikasi BNSP Yogyakarta', ENT_QUOTES);
        $body     = htmlspecialchars($options['body']     ?? '', ENT_QUOTES);
        $emoji    = $options['emoji']    ?? '🦺';
        $bgColor  = $options['bg_color'] ?? self::BRAND_GREEN;
        $hashtags = $options['hashtags'] ?? '#K3 #BNSP #WahanaTotalita';
        $isStory  = ($options['size'] ?? '') === '1080x1920';
        $w = 1080; $h = $isStory ? 1920 : 1080;
        $canvasId = 'sc_' . substr(md5(uniqid()), 0, 8);

        $bgR = hexdec(substr(ltrim($bgColor,'#'),0,2));
        $bgG = hexdec(substr(ltrim($bgColor,'#'),2,2));
        $bgB = hexdec(substr(ltrim($bgColor,'#'),4,2));

        ob_start(); ?>
<div class="social-card-widget" style="max-width:540px;margin:0 auto;text-align:center;">
  <canvas id="<?= $canvasId ?>" width="<?= $w ?>" height="<?= $h ?>"
          style="width:100%;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.2);"></canvas>
  <div style="margin-top:12px;display:flex;gap:8px;justify-content:center;flex-wrap:wrap;">
    <button onclick="downloadCard('<?= $canvasId ?>')"
            style="background:<?= self::BRAND_GREEN ?>;color:#fff;border:none;padding:10px 20px;border-radius:8px;cursor:pointer;font-size:14px;font-weight:600;">
      ⬇ Download PNG
    </button>
    <button onclick="copyHashtags('<?= htmlspecialchars($hashtags,ENT_QUOTES) ?>')"
            style="background:#f0f0f0;color:#333;border:none;padding:10px 20px;border-radius:8px;cursor:pointer;font-size:14px;">
      # Copy Hashtag
    </button>
  </div>
  <p style="font-size:12px;color:#999;margin-top:8px;">Caption & hashtag tersedia di bawah form</p>
</div>
<script>
(function(){
  const canvas = document.getElementById('<?= $canvasId ?>');
  const ctx    = canvas.getContext('2d');
  const W = <?= $w ?>, H = <?= $h ?>;
  const BG   = '<?= $bgColor ?>';
  const ACC  = '<?= self::BRAND_ORANGE ?>';
  const WHITE= '#FFFFFF';

  function wrapText(ctx, text, x, y, maxW, lineH) {
    const words = text.split(' ');
    let line = '';
    for (let n = 0; n < words.length; n++) {
      const testLine  = line + words[n] + ' ';
      const testWidth = ctx.measureText(testLine).width;
      if (testWidth > maxW && n > 0) {
        ctx.fillText(line, x, y);
        line = words[n] + ' ';
        y += lineH;
      } else { line = testLine; }
    }
    ctx.fillText(line, x, y);
    return y;
  }

  function drawCard() {
    // Background gradient
    const grad = ctx.createLinearGradient(0, 0, 0, H);
    grad.addColorStop(0, BG);
    grad.addColorStop(1, adjustColor(BG, -40));
    ctx.fillStyle = grad;
    ctx.fillRect(0, 0, W, H);

    // Decorative circles
    ctx.save();
    ctx.globalAlpha = 0.08;
    ctx.fillStyle = WHITE;
    ctx.beginPath(); ctx.arc(W*0.85, H*0.12, W*0.35, 0, Math.PI*2); ctx.fill();
    ctx.beginPath(); ctx.arc(W*0.1,  H*0.88, W*0.25, 0, Math.PI*2); ctx.fill();
    ctx.restore();

    // Orange accent bar
    ctx.fillStyle = ACC;
    ctx.fillRect(60, <?= $isStory ? 160 : 80 ?>, 8, <?= $isStory ? 120 : 80 ?>);

    // Brand name top
    ctx.fillStyle = 'rgba(255,255,255,0.7)';
    ctx.font = 'bold <?= $isStory ? 42 : 32 ?>px "Arial", sans-serif';
    ctx.fillText('WAHANA TOTALITA KONSULTAN', 80, <?= $isStory ? 100 : 55 ?>);

    // Emoji
    ctx.font = '<?= $isStory ? 140 : 100 ?>px serif';
    ctx.fillText('<?= $emoji ?>', W - <?= $isStory ? 200 : 160 ?>, <?= $isStory ? 280 : 200 ?>);

    // Title
    ctx.fillStyle = WHITE;
    ctx.font = 'bold <?= $isStory ? 96 : 72 ?>px "Arial", sans-serif';
    wrapText(ctx, '<?= addslashes($title) ?>', 80, <?= $isStory ? 340 : 200 ?>, W - 160, <?= $isStory ? 110 : 85 ?>);

    // Subtitle
    ctx.fillStyle = ACC;
    ctx.font = 'bold <?= $isStory ? 52 : 40 ?>px "Arial", sans-serif';
    wrapText(ctx, '<?= addslashes($subtitle) ?>', 80, <?= $isStory ? 560 : 370 ?>, W - 160, <?= $isStory ? 65 : 50 ?>);

    // Body
    ctx.fillStyle = 'rgba(255,255,255,0.9)';
    ctx.font = '<?= $isStory ? 46 : 36 ?>px "Arial", sans-serif';
    wrapText(ctx, '<?= addslashes($body) ?>', 80, <?= $isStory ? 700 : 470 ?>, W - 160, <?= $isStory ? 58 : 46 ?>);

    // Divider
    ctx.fillStyle = 'rgba(255,255,255,0.2)';
    ctx.fillRect(80, H - <?= $isStory ? 260 : 200 ?>, W - 160, 2);

    // Footer
    ctx.fillStyle = 'rgba(255,255,255,0.6)';
    ctx.font = '<?= $isStory ? 40 : 30 ?>px "Arial", sans-serif';
    ctx.fillText('🌐 <?= self::SITE_URL ?>', 80, H - <?= $isStory ? 200 : 155 ?>);
    ctx.fillText('📞 WA: 0877-5915-1278', 80, H - <?= $isStory ? 145 : 115 ?>);

    // Hashtags
    ctx.fillStyle = ACC;
    ctx.font = 'bold <?= $isStory ? 36 : 26 ?>px "Arial", sans-serif';
    ctx.fillText('<?= addslashes($hashtags) ?>', 80, H - <?= $isStory ? 90 : 70 ?>);
  }

  function adjustColor(hex, amount) {
    hex = hex.replace('#','');
    let r = Math.min(255, Math.max(0, parseInt(hex.substr(0,2),16)+amount));
    let g = Math.min(255, Math.max(0, parseInt(hex.substr(2,2),16)+amount));
    let b = Math.min(255, Math.max(0, parseInt(hex.substr(4,2),16)+amount));
    return '#'+ r.toString(16).padStart(2,'0') + g.toString(16).padStart(2,'0') + b.toString(16).padStart(2,'0');
  }

  drawCard();
})();

function downloadCard(id) {
  const canvas = document.getElementById(id);
  const a = document.createElement('a');
  a.href     = canvas.toDataURL('image/png');
  a.download = 'wahana-k3-post-' + Date.now() + '.png';
  a.click();
}
function copyHashtags(text) {
  navigator.clipboard.writeText(text).then(()=>alert('Hashtag disalin!')).catch(()=>alert(text));
}
</script>
<?php
        return ob_get_clean();
    }

    /**
     * Generate multiple card variations as array of options.
     */
    public function generateVariations(string $topic, string $type = 'tip'): array {
        $emojis = ['tip'=>'💡','schedule'=>'📅','news'=>'📢','promo'=>'🎓','certificate'=>'🏆'];
        return [
            ['type'=>$type,'emoji'=>$emojis[$type]??'🦺','bg_color'=>self::BRAND_GREEN],
            ['type'=>$type,'emoji'=>$emojis[$type]??'🦺','bg_color'=>'#1a3a5c'],
            ['type'=>$type,'emoji'=>$emojis[$type]??'🦺','bg_color'=>'#2d1a4a'],
        ];
    }
}
