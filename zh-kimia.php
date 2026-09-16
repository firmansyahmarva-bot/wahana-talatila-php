<?php
/**
 * Standard Header for Wahana Totalita Chinese Authority Cluster
 */
require_once __DIR__ . '/config.php';

$page_title = '印尼危化品与湿法冶炼(K3 Kimia)安全合规实操指南 — Wahana Totalita';
$meta_desc = '高压酸浸(HPAL)、镍火法(RKEF)及化工企业在印尼如何满足危化品法定安全监管？化学品安全员、注册安全官配比(Kepmenaker 187/1999)与印尼语LDK/SDS规范。';
$canonical = SITE_URL . '/zh/k3-kimia/';
$wa_url = 'https://wa.me/6287759151278?text=' . rawurlencode('您好，我们是在印尼的冶炼/化工/新能源中资企业，想咨询危化品(K3 Kimia)持证与合规规划。');
?>
<!DOCTYPE html>
<html lang="zh-Hans">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?></title>
<meta name="description" content="<?= htmlspecialchars($meta_desc, ENT_QUOTES, 'UTF-8') ?>">
<link rel="canonical" href="<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>">
<meta name="robots" content="index, follow">
<meta name="keywords" content="印尼危化品合规,印尼湿法冶炼安全,HPAL高压酸浸,RKEF镍冶炼,Petugas K3 Kimia,Ahli K3 Kimia,Kepmenaker 187/1999,印尼语LDK说明书">
<meta name="author" content="PT Wahana Totalita Konsultan">

<!-- Open Graph / Social Media -->
<meta property="og:type" content="article">
<meta property="og:site_name" content="Wahana Totalita Konsultan">
<meta property="og:locale" content="zh_CN">
<meta property="og:title" content="<?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:description" content="<?= htmlspecialchars($meta_desc, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:url" content="<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:image" content="https://wahanatotalita.com/assets/img/og-cover.jpg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="Wahana Totalita Konsultan - 印尼安全合规">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?>">
<meta name="twitter:description" content="<?= htmlspecialchars($meta_desc, ENT_QUOTES, 'UTF-8') ?>">
<meta name="twitter:image" content="https://wahanatotalita.com/assets/img/og-cover.jpg">

<!-- Structured Data (JSON-LD) -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@graph": [
        {
            "@type": "Organization",
            "@id": "https://wahanatotalita.com/#organization",
            "name": "PT Wahana Totalita Konsultan",
            "url": "https://wahanatotalita.com",
            "logo": {
                "@type": "ImageObject",
                "url": "https://wahanatotalita.com/assets/img/logo-wt.png"
            },
            "description": "印尼劳工部官方授权综合安全技术与培训机构 (PJK3 No. Kep. 312/BINWASPNAK-PNK3/V/2020)",
            "contactPoint": {
                "@type": "ContactPoint",
                "telephone": "+62-877-5915-1278",
                "contactType": "customer service",
                "availableLanguage": [
                    "Chinese",
                    "Indonesian",
                    "English"
                ]
            }
        },
        {
            "@type": "BreadcrumbList",
            "@id": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>#breadcrumb",
            "itemListElement": [
                {
                    "@type": "ListItem",
                    "position": 1,
                    "name": "首页",
                    "item": "https://wahanatotalita.com/"
                },
                {
                    "@type": "ListItem",
                    "position": 2,
                    "name": "中文合规指引",
                    "item": "https://wahanatotalita.com/zh/"
                },
                {
                    "@type": "ListItem",
                    "position": 3,
                    "name": "印尼危化品与湿法冶炼(K3 Kimia)安全合规",
                    "item": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>"
                }
            ]
        },
        {
            "@type": "Article",
            "@id": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>#webpage",
            "url": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>",
            "name": "<?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?>",
            "description": "<?= htmlspecialchars($meta_desc, ENT_QUOTES, 'UTF-8') ?>",
            "inLanguage": "zh-Hans",
            "isPartOf": {
                "@type": "WebSite",
                "@id": "https://wahanatotalita.com/#website",
                "name": "Wahana Totalita Konsultan",
                "url": "https://wahanatotalita.com/"
            },
            "publisher": {
                "@id": "https://wahanatotalita.com/#organization"
            },
            "datePublished": "2026-09-01T08:00:00+07:00",
            "dateModified": "2026-09-16T13:30:00+07:00"
        }
    ]
}
</script>

">
">
">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Noto+Sans+SC:wght@400;500;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/page/hub-master.css">

<style>
:root {
  --zh-font: "Noto Sans SC", -apple-system, BlinkMacSystemFont, "PingFang SC", "Microsoft YaHei", "Source Han Sans SC", sans-serif;
  --hub-primary: #0A4A2E;
  --hub-primary-light: #0d5f3a;
  --hub-accent: #C6621C;
  --hub-dark: #111827;
  --hub-muted: #4b5563;
  --hub-border: #e5e7eb;
  --hub-bg: #f8fafc;
}
body {
  font-family: var(--zh-font);
  color: #1f2937;
  background: #fdfdfd;
  line-height: 1.8;
  margin: 0;
  padding: 0;
  -webkit-font-smoothing: antialiased;
}
.zh-nav {
  background: #ffffff;
  border-bottom: 1px solid var(--hub-border);
  padding: 14px 0;
  position: sticky;
  top: 0;
  z-index: 100;
}
.zh-nav-inner {
  max-width: 1180px;
  margin: 0 auto;
  padding: 0 20px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.zh-logo {
  display: flex;
  align-items: center;
  gap: 12px;
  text-decoration: none;
}
.zh-logo img {
  height: 38px;
  width: auto;
  display: block;
}
.zh-lang-badge {
  background: #e8f4ee;
  color: var(--hub-primary);
  font-size: 12px;
  font-weight: 700;
  padding: 3px 10px;
  border-radius: 6px;
  display: inline-flex;
  align-items: center;
  gap: 4px;
}
.zh-nav-links {
  display: flex;
  align-items: center;
  gap: 16px;
}
.zh-nav-back {
  font-size: 13.5px;
  color: var(--hub-muted);
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  transition: color 0.15s ease;
}
.zh-nav-back:hover {
  color: var(--hub-primary);
}
.zh-cta-btn-sm {
  background: var(--hub-primary);
  color: #ffffff;
  font-size: 13px;
  font-weight: 700;
  padding: 7px 15px;
  border-radius: 6px;
  text-decoration: none;
  transition: background 0.15s ease;
}
.zh-cta-btn-sm:hover {
  background: var(--hub-primary-light);
}
.zh-hero {
  background: linear-gradient(135deg, #073520 0%, #0A4A2E 50%, #0e633d 100%);
  color: #ffffff;
  padding: 44px 0 50px;
  position: relative;
}
.zh-container {
  max-width: 1180px;
  margin: 0 auto;
  padding: 0 20px;
}
.zh-breadcrumb {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 13px;
  color: rgba(255,255,255,0.7);
  margin-bottom: 14px;
}
.zh-breadcrumb a {
  color: rgba(255,255,255,0.85);
  text-decoration: none;
}
.zh-breadcrumb a:hover {
  color: #ffffff;
  text-decoration: underline;
}
.zh-hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: rgba(255,255,255,0.12);
  border: 1px solid rgba(255,255,255,0.22);
  color: #bbf7d0;
  font-size: 12.5px;
  font-weight: 700;
  padding: 4px 12px;
  border-radius: 9999px;
  margin-bottom: 12px;
}
.zh-hero h1 {
  font-size: 30px;
  font-weight: 800;
  line-height: 1.35;
  margin: 0 0 14px;
  letter-spacing: -0.01em;
}
.zh-hero p {
  font-size: 15px;
  line-height: 1.7;
  color: #e2e8f0;
  margin: 0 0 20px;
  max-width: 860px;
}
.zh-hero-meta {
  display: flex;
  flex-wrap: wrap;
  gap: 16px;
  font-size: 13px;
  color: rgba(255,255,255,0.8);
  align-items: center;
}
.zh-hero-meta span {
  display: inline-flex;
  align-items: center;
  gap: 6px;
}
.zh-body-grid {
  display: grid;
  grid-template-columns: minmax(0, 1fr) 320px;
  gap: 36px;
  margin-top: 36px;
  margin-bottom: 60px;
}
.zh-card {
  background: #ffffff;
  border: 1px solid var(--hub-border);
  border-radius: 12px;
  padding: 30px;
  margin-bottom: 26px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.03);
}
.zh-sec-badge {
  font-size: 12px;
  font-weight: 800;
  color: var(--hub-primary);
  text-transform: uppercase;
  letter-spacing: 0.05em;
  background: #e8f4ee;
  padding: 3px 10px;
  border-radius: 4px;
  display: inline-block;
  margin-bottom: 10px;
}
.zh-sec-title {
  font-size: 20px;
  font-weight: 800;
  color: var(--hub-dark);
  margin: 0 0 14px;
  line-height: 1.4;
}
.zh-text {
  font-size: 14.5px;
  color: #374151;
  line-height: 1.8;
  margin: 0 0 14px;
}
.zh-law-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 16px;
  margin: 18px 0;
}
.zh-law-card {
  background: var(--hub-bg);
  border: 1px solid var(--hub-border);
  border-radius: 8px;
  padding: 16px;
}
.zh-law-card strong {
  display: block;
  font-size: 14px;
  color: var(--hub-dark);
  margin-bottom: 6px;
}
.zh-law-card p {
  font-size: 13px;
  color: #4b5563;
  line-height: 1.6;
  margin: 0;
}
.zh-alert-box {
  background: #fef2f2;
  border-left: 4px solid #ef4444;
  border-radius: 0 8px 8px 0;
  padding: 16px 18px;
  margin: 18px 0;
}
.zh-alert-box strong {
  color: #991b1b;
  font-size: 14px;
  display: block;
  margin-bottom: 6px;
}
.zh-alert-box p {
  font-size: 13px;
  color: #7f1d1d;
  margin: 0;
  line-height: 1.6;
}
.zh-tip-box {
  background: #f0fdf4;
  border-left: 4px solid #10b981;
  border-radius: 0 8px 8px 0;
  padding: 16px 18px;
  margin: 18px 0;
}
.zh-tip-box strong {
  color: #065f46;
  font-size: 14px;
  display: block;
  margin-bottom: 6px;
}
.zh-tip-box p {
  font-size: 13px;
  color: #047857;
  margin: 0;
  line-height: 1.6;
}
.zh-table-wrap {
  overflow-x: auto;
  margin: 18px 0;
  border: 1px solid var(--hub-border);
  border-radius: 8px;
}
.zh-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 13px;
  text-align: left;
}
.zh-table th {
  background: #f3f4f6;
  color: var(--hub-dark);
  font-weight: 700;
  padding: 12px 14px;
  border-bottom: 1px solid var(--hub-border);
  white-space: nowrap;
}
.zh-table td {
  padding: 12px 14px;
  border-bottom: 1px solid var(--hub-border);
  color: #374151;
  vertical-align: top;
}
.zh-table tr:last-child td {
  border-bottom: none;
}
.zh-faq-item {
  border: 1px solid var(--hub-border);
  border-radius: 8px;
  margin-bottom: 12px;
  overflow: hidden;
}
.zh-faq-q {
  width: 100%;
  text-align: left;
  background: #ffffff;
  border: none;
  padding: 16px 18px;
  font-size: 14.5px;
  font-weight: 700;
  color: var(--hub-dark);
  cursor: pointer;
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-family: inherit;
}
.zh-faq-q:hover {
  background: #f9fafb;
}
.zh-faq-a {
  padding: 0 18px 16px;
  display: none;
  font-size: 13.5px;
  color: #4b5563;
  line-height: 1.7;
}
.zh-faq-a.open {
  display: block;
}
.zh-sticky-sidebar {
  position: sticky;
  top: 86px;
  height: fit-content;
}
.zh-sb-box {
  background: #ffffff;
  border: 1px solid var(--hub-border);
  border-radius: 12px;
  padding: 24px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.04);
}
.zh-sb-badge {
  font-size: 11.5px;
  font-weight: 800;
  color: var(--hub-primary);
  background: #e8f4ee;
  padding: 3px 8px;
  border-radius: 4px;
  display: inline-block;
  margin-bottom: 10px;
}
.zh-sb-title {
  font-size: 16px;
  font-weight: 800;
  color: var(--hub-dark);
  margin: 0 0 8px;
}
.zh-sb-desc {
  font-size: 12.5px;
  color: #6b7280;
  line-height: 1.6;
  margin: 0 0 16px;
}
.zh-sb-wa-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  background: #25D366;
  color: #ffffff;
  font-size: 13.5px;
  font-weight: 700;
  padding: 11px 16px;
  border-radius: 8px;
  text-decoration: none;
  box-shadow: 0 3px 8px rgba(37,211,102,0.3);
  transition: transform 0.15s ease, background 0.15s ease;
}
.zh-sb-wa-btn:hover {
  background: #22c35e;
  transform: translateY(-1px);
}
.zh-sb-nav-title {
  font-size: 13px;
  font-weight: 800;
  color: var(--hub-dark);
  text-transform: uppercase;
  letter-spacing: 0.04em;
  margin: 20px 0 10px;
  padding-top: 16px;
  border-top: 1px solid var(--hub-border);
}
.zh-sb-nav-list {
  list-style: none;
  padding: 0;
  margin: 0;
}
.zh-sb-nav-list li {
  margin-bottom: 6px;
}
.zh-sb-nav-list a {
  font-size: 12.5px;
  color: var(--hub-muted);
  text-decoration: none;
  display: block;
  padding: 5px 8px;
  border-radius: 6px;
  line-height: 1.4;
  transition: all 0.15s ease;
}
.zh-sb-nav-list a:hover {
  color: var(--hub-primary);
  background: #f0fdf4;
}
.zh-sb-nav-list a.active {
  color: var(--hub-primary);
  font-weight: 700;
  background: #e8f4ee;
}
.zh-footer {
  background: #0f172a;
  color: #cbd5e1;
  padding: 44px 0 30px;
  font-size: 13px;
  line-height: 1.8;
  margin-top: 60px;
}
.zh-footer-inner {
  max-width: 1180px;
  margin: 0 auto;
  padding: 0 20px;
  display: grid;
  grid-template-columns: 2fr 1fr;
  gap: 40px;
}
.zh-footer h4 {
  color: #ffffff;
  font-size: 15px;
  margin: 0 0 12px;
}
.zh-footer p {
  margin: 0 0 10px;
  color: #94a3b8;
}
.zh-footer-bottom {
  max-width: 1180px;
  margin: 30px auto 0;
  padding: 20px 20px 0;
  border-top: 1px solid #1e293b;
  text-align: center;
  font-size: 12px;
  color: #64748b;
}
.zh-mobile-bar {
  display: none;
}
@media (max-width: 860px) {
  .zh-body-grid {
    grid-template-columns: 1fr;
  }
  .zh-sticky-sidebar {
    position: static;
  }
  .zh-mobile-bar {
    display: flex;
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: #ffffff;
    border-top: 1px solid var(--hub-border);
    padding: 10px 16px;
    z-index: 999;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 -2px 10px rgba(0,0,0,0.08);
  }
  .zh-mb-text {
    font-size: 12px;
    font-weight: 700;
    color: var(--hub-dark);
  }
  .zh-mb-sub {
    font-size: 11px;
    color: #6b7280;
  }
  .zh-mb-btn {
    background: #25D366;
    color: #ffffff;
    font-size: 12px;
    font-weight: 700;
    padding: 8px 14px;
    border-radius: 6px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }
  body {
    padding-bottom: 60px;
  }
}
</style>
</head>
<body>

<nav class="zh-nav">
  <div class="zh-nav-inner">
    <a href="/zh/" class="zh-logo">
      <img src="/assets/img/logo-wt.webp" alt="Wahana Totalita Logo" width="160" height="38" onerror="this.onerror=null;this.src='/assets/img/logo-wt.png'">
      <span style="font-weight:800;font-size:16px;color:var(--hub-primary);">WAHANA TOTALITA</span>
      <span class="zh-lang-badge">中文合规指引</span>
    </a>
    <div class="zh-nav-links">
      <a href="/zh/" class="zh-nav-back">&larr; 返回中文主纲</a>
      <a href="<?= $wa_url ?>" class="zh-cta-btn-sm" target="_blank" rel="noopener">官方快速咨询</a>
    </div>
  </div>
</nav><!-- HERO -->
<section class="zh-hero">
  <div class="zh-container">
    <div class="zh-breadcrumb">
      <a href="/zh/">中文合规首页</a> &gt; <span>冶炼与危化品安全 (K3 Kimia)</span>
    </div>
    <span class="zh-hero-badge">冶炼 · 化工 · 新能源专项</span>
    <h1>印尼湿法冶炼与危化品生产企业安全合规（K3 Kimia）法定实操规范</h1>
    <p>
      印尼的镍矿高压酸浸（HPAL）、RKEF火法冶炼、电池正极材料前驱体及化工厂大量使用浓硫酸、液氧、液氨、硫化氢及危险气体。印尼劳工部对此类高危场所实施极其严苛的定级审批与专职持证要求。本指引为您梳理 Kepmenaker 187/1999 核心红线。
    </p>
    <div class="zh-hero-meta">
      <span>● 法定依据：Kepmenaker No. KEP.187/MEN/1999</span>
      <span>● 强制人员：Petugas K3 Kimia & Ahli K3 Kimia</span>
      <span>● 核心技术：印尼语 LDK / SDS 与风险评估</span>
    </div>
  </div>
</section>

<div class="zh-container">
  <div class="zh-body-grid">
    <main>
      <article class="zh-card">
        <span class="zh-sec-badge">法定定级门槛</span>
        <h2 class="zh-sec-title">一、企业危化品危害等级评定 (Potensi Bahaya Kimia)</h2>
        <p class="zh-text">
          根据印尼劳工部第 187 号部长令，所有在生产、使用、储存或运输过程中涉及危险化学品的企业，必须依据危化品库存上限向劳工部进行危害等级申报，分为<strong>重度危险企业 (Potensi Bahaya Besar)</strong> 与 <strong>中度危险企业 (Potensi Bahaya Menengah)</strong>。
        </p>

        <div class="zh-table-wrap">
          <table class="zh-table">
            <thead>
              <tr>
                <th>企业危化品等级</th>
                <th>典型判定条件 (以印尼常见为例)</th>
                <th>法定必须配置的专职人员</th>
                <th>日常强制合规动作</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>重大危害等级<br>(Bahaya Besar)</strong></td>
                <td>
                  • 浓硫酸储存量 &ge; 100 吨<br>
                  • 易燃气体/液化气 &ge; 50 吨<br>
                  • 有毒化学品超过门槛上限 (NKA)
                </td>
                <td>
                  • <strong>至少 2 名</strong> 化学品安全员 (Petugas K3 Kimia)<br>
                  • <strong>至少 1 名</strong> 注册化学品安全官 (Ahli K3 Kimia)
                </td>
                <td>每 6 个月报送一次专项化学品危害控制报告，每年开展一次综合泄漏应急演练。</td>
              </tr>
              <tr>
                <td><strong>中度危害等级<br>(Bahaya Menengah)</strong></td>
                <td>储存或使用量低于重度危险上限，但超过日常基础豁免门槛的企业。</td>
                <td>
                  • <strong>至少 1 名</strong> 化学品安全员 (Petugas K3 Kimia)
                </td>
                <td>编制完备的 LDK 技术说明书，并在车间张贴印尼语警示标签。</td>
              </tr>
            </tbody>
          </table>
        </div>
      </article>

      <article class="zh-card">
        <span class="zh-sec-badge">双语合规实务</span>
        <h2 class="zh-sec-title">二、中资企业高发的 3 大危化品合规雷区</h2>
        
        <div class="zh-law-grid">
          <div class="zh-law-card">
            <strong>1. 中文/英文 MSDS 在印尼不具备完全合法性</strong>
            <p>印尼法规强制要求，现场化学品安全技术说明书必须采用<strong>印尼官方语言（Lembar Data Keselamatan: LDK）</strong>。仅有中文或英文说明书，劳动监察官在巡检时将直接开具违规罚单，因印尼籍本地一线工人无法正确阅读中文危化品防护指引。</p>
          </div>
          <div class="zh-law-card">
            <strong>2. 储罐与防渗围堰 (Secondary Containment) 违规</strong>
            <p>硫酸罐区、酸洗池必须配备容积不低于最大单罐储量 110% 的防腐防渗围堰，并配备联动紧急洗眼器与冲淋装置（Emergency Eyewash & Shower），且检测水压需符合要求。</p>
          </div>
          <div class="zh-law-card">
            <strong>3. 危险化学品运输与转运车辆资质缺失</strong>
            <p>厂区内部以及厂外运输酸液、液氯的槽车不仅需要交通部通行证，司机必须持有危险品运输上岗资质，槽车本身属于压力容器检验范畴，需持有有效检验合格证（SIA）。</p>
          </div>
        </div>
      </article>

      <article class="zh-card">
        <span class="zh-sec-badge">专业考证规划</span>
        <h2 class="zh-sec-title">三、化学品安全人员 (Petugas vs Ahli K3 Kimia) 培训考证</h2>
        <p class="zh-text">
          Wahana Totalita 作为印尼劳工部直属授权的 PJK3 培训机构，为中资冶炼厂与化工厂提供完整的危化品持证内训解决方案：
        </p>
        <ul>
          <li><strong>化学品安全员 (Petugas K3 Kimia)：</strong> 面向车间一线中印方班组长与工段长，培训时长 6 天，聚焦化学品分类、个人防护装备（PPE）选型、泄漏围堵与洗眼装置维护。</li>
          <li><strong>注册化学品安全官 (Ahli K3 Kimia)：</strong> 面向企业安全总监、工艺工程师，培训时长 12 天，深入化学品量化风险评估（QRA）、安全仪表联锁系统及重大危害事故控制计划编制。</li>
        </ul>
      </article>
    </main>    <!-- RIGHT: STICKY CONTACT SIDEBAR -->
    <aside class="zh-sticky-sidebar">
      <div class="zh-sb-box">
        <div class="zh-sb-badge">● 官方通道 · 快速对接</div>
        <h3 class="zh-sb-title">中资企业安全合规咨询</h3>
        <p class="zh-sb-desc">
          印尼劳工部官方授权机构 (PJK3) 资深专家团队，提供政策解读、驻厂双语培训与特种设备法定检验。
        </p>
        <a href="https://wa.me/6287759151278?text=%E6%82%A8%E5%A5%BD%EF%BC%8C%E6%88%91%E4%BB%AC%E6%98%AF%E5%9C%A8%E5%8D%B0%E5%B0%BC%E7%9A%84%E5%86%B6%E7%82%BC%2F%E5%8C%96%E5%B7%A5%2F%E6%96%B0%E8%83%BD%E6%BA%90%E4%B8%AD%E8%B5%84%E4%BC%81%E4%B8%9A%EF%BC%8C%E6%83%B3%E5%92%A8%E8%AF%A2%E5%8D%B1%E5%8C%96%E5%93%81%28K3%20Kimia%29%E6%8C%81%E8%AF%81%E4%B8%8E%E5%90%88%E8%A7%84%E8%A7%84%E5%88%92%E3%80%82" class="zh-sb-wa-btn" target="_blank" rel="noopener">
          <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
          <span>WhatsApp 商务咨询</span>
        </a>

        <div class="zh-sb-nav-title">合规指引与专题手册</div>
        <ul class="zh-sb-nav-list">
          <li><a href="/zh/">&bull; 合规全景总纲 (主页)</a></li>
          <li><a href="/zh/factory-roadmap/">&bull; 从零建厂到投产路线图</a></li>
          <li><a href="/zh/checklist/">&bull; 中资企业安全合规自查清单</a></li>
          <li><a href="/zh/ahli-k3-umum/">&bull; 注册安全官 (AK3U) 与 P2K3</a></li>
          <li><a href="/zh/sio-alat-berat/">&bull; 特种设备操作证 (SIO/SIA)</a></li>
          <li><a href="/zh/kecelakaan-kerja/">&bull; 工伤事故处置与调查应对</a></li>
          <li><a href="/zh/k3-kimia/" class="active">&bull; 冶炼危化品 (K3 Kimia) 合规</a></li>
          <li><a href="/zh/k3-kebakaran/">&bull; 厂区消防与管网年检 (Damkar)</a></li>
          <li><a href="/zh/k3-pertambangan/">&bull; 矿山安全 KTT 与 POP/POM</a></li>
          <li><a href="/zh/smk3/">&bull; SMK3 安全体系金牌认证</a></li>
          <li><a href="/zh/juru-las/">&bull; 特种焊工 (Juru Las) 规范</a></li>
          <li><a href="/zh/in-house-training/">&bull; 偏远工区驻厂双语内训</a></li>
        </ul>
      </div>
    </aside>  </div>
</div>

<!-- FOOTER -->
<footer class="zh-footer">
  <div class="zh-footer-inner">
    <div>
      <h4>PT Wahana Totalita Konsultan — 法定合规咨询机构</h4>
      <p>
        印尼劳工部官方授权资质机构 (PJK3 No. Kep. 312/BINWASPNAK-PNK3/V/2020)。专注为在印尼中资冶炼、矿山、电厂、工程总包及制造企业提供全方位安全生产（K3）法律合规支持、特种设备检验及法定持证培训服务。
      </p>
      <p>
        <strong>办公地址：</strong>Jl. Wonosari KM 8.5, Berbah, Sleman, D.I. Yogyakarta 55573, Indonesia<br>
        <strong>官方邮箱：</strong>info@wahanatotalita.com &nbsp;|&nbsp; <strong>官方联络：</strong>+62 877-5915-1278
      </p>
    </div>
    <div>
      <h4>免责与合规声明</h4>
      <p style="font-size:12.5px;">
        本页面内容系依据印尼现行《1970年第1号安全生产法》及印尼劳工部相关部颁标准整理，旨在为管理层厘清合规逻辑与制度常识，具体执法实施以印尼国家法律法规及主管劳工部门最新文书为准。
      </p>
    </div>
  </div>
  <div class="zh-footer-bottom">
    &copy; 2008 - 2026 PT Wahana Totalita Konsultan. 版权所有，保留所有权利。
  </div>
</footer>

<!-- MOBILE STICKY CONTACT BAR -->
<div class="zh-mobile-bar">
  <div>
    <div class="zh-mb-text">中资企业安全生产(K3)合规咨询</div>
    <div class="zh-mb-sub">印尼劳工部官方授权机构 · 快速对接</div>
  </div>
  <a href="https://wa.me/6287759151278?text=%E6%82%A8%E5%A5%BD%EF%BC%8C%E6%88%91%E4%BB%AC%E6%98%AF%E5%9C%A8%E5%8D%B0%E5%B0%BC%E7%9A%84%E5%86%B6%E7%82%BC%2F%E5%8C%96%E5%B7%A5%2F%E6%96%B0%E8%83%BD%E6%BA%90%E4%B8%AD%E8%B5%84%E4%BC%81%E4%B8%9A%EF%BC%8C%E6%83%B3%E5%92%A8%E8%AF%A2%E5%8D%B1%E5%8C%96%E5%93%81%28K3%20Kimia%29%E6%8C%81%E8%AF%81%E4%B8%8E%E5%90%88%E8%A7%84%E8%A7%84%E5%88%92%E3%80%82" class="zh-mb-btn" target="_blank" rel="noopener">
    <svg viewBox="0 0 24 24" fill="currentColor" width="15" height="15"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
    <span>在线咨询</span>
  </a>
</div>

<script>
function toggleZhFaq(btn) {
  var ans = btn.nextElementSibling;
  var isOpen = ans.classList.contains('open');
  document.querySelectorAll('.zh-faq-a').forEach(function(el) { el.classList.remove('open'); });
  if (!isOpen) { ans.classList.add('open'); }
}
</script>
</body>
</html>