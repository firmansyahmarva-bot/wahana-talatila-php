<?php
/**
 * Standard Header for Wahana Totalita Chinese Authority Cluster
 */
require_once __DIR__ . '/config.php';

$page_title = '印尼矿山安全(SMKP Minerba)与KTT/POP/POM认证指南 — Wahana Totalita';
$meta_desc = '在印尼投资镍矿、煤矿与采石场如何满足能矿部(ESDM)严苛安全监管？矿长KTT执业条件、初中级现场安全主管POP/POM国家执照与SMKP体系。';
$canonical = SITE_URL . '/zh/k3-pertambangan/';
$wa_url = 'https://wa.me/6287759151278?text=' . rawurlencode('您好，我们是在印尼的矿业/采矿中资企业，想咨询能矿部矿山安全(POP/POM/KTT)认证与合规服务。');
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
<meta name="keywords" content="印尼矿山安全监管,印尼能矿部ESDM,矿长KTT任命,POP初级安全主管,POM中级安全主管,POU高级安全主管,SMKP Minerba,红土镍矿合规">
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
                "url": "https://wahanatotalita.com/assets/img/logo.png"
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
                    "name": "印尼矿山安全(SMKP Minerba)与KTT/POP/POM认证",
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
      <img src="/assets/img/logo.png" alt="Wahana Totalita Logo" onerror="this.style.display='none'">
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
      <a href="/zh/">中文合规首页</a> &gt; <span>矿山安全监管 (K3 Pertambangan)</span>
    </div>
    <span class="zh-hero-badge">能矿部 ESDM 专项监管</span>
    <h1>在印尼从事矿业开发与采掘，必须掌握的能矿部（ESDM）双轨安全体系</h1>
    <p>
      印尼的采矿业（包括红土镍矿、煤矿、金矿及石灰石采石场）不仅受到劳工部（Kemnaker）的综合安全监管，更受到<strong>印尼能源与矿产资源部（Kementerian ESDM）</strong>极其严厉的专项行业监管。缺少矿长任命（KTT）或主管人员无证上岗，矿区采矿许可证（IUP）将直接面临暂停乃至吊销风险。
    </p>
    <div class="zh-hero-meta">
      <span>● 法定依据：Kepmen ESDM No. 1827 K/30/MEM/2018</span>
      <span>● 核心体系：SMKP Minerba (矿山安全管理体系)</span>
      <span>● 执照层级：POP (初级) / POM (中级) / POU (高级)</span>
    </div>
  </div>
</section>

<div class="zh-container">
  <div class="zh-body-grid">
    <main>
      <article class="zh-card">
        <span class="zh-sec-badge">矿山第一责任人</span>
        <h2 class="zh-sec-title">一、矿长 (KTT: Kepala Teknik Tambang) 官方任命制</h2>
        <p class="zh-text">
          在印尼开矿，采矿权持有企业（IUP）以及具备采矿服务资质的工程外包商（IUJP），<strong>依法必须任命一名全职在矿区常驻的矿长（KTT）或现场项目负责人（PJO: Penanggung Jawab Operasional）</strong>。
        </p>
        <div class="zh-law-grid">
          <div class="zh-law-card">
            <strong>KTT 的法定权力与责任</strong>
            <p>KTT 是印尼能矿部唯一认可的现场最高技术与安全法定负责人。如果发生滑坡、重型卡车翻车坠崖等重大恶性事故，能矿部调查官员将直接传唤质询 KTT，严查其批准的采矿作业规程（SOP）是否存在漏洞。</p>
          </div>
          <div class="zh-law-card">
            <strong>KTT 任命前置条件</strong>
            <p>候选人必须具备采矿工程相关技术背景，且必须通过能矿部矿山监察局（Direktur Teknik dan Lingkungan Mineral dan Batubara）的面对面答辩评估（Uji Kelayakan），取得官方正式任职核准信（Surat Pengesahan KTT）。</p>
          </div>
        </div>
      </article>

      <article class="zh-card">
        <span class="zh-sec-badge">一线管理执照</span>
        <h2 class="zh-sec-title">二、基层安全监护人三级认证体系 (POP / POM / POU)</h2>
        <p class="zh-text">
          能矿部强制规定，矿区现场直接带班的主管、队长、工段长必须持有由国家职业认证局（BNSP）颁发的国家标准技能等级证书（SKKNI Minerba）：
        </p>

        <div class="zh-table-wrap">
          <table class="zh-table">
            <thead>
              <tr>
                <th>认证级别</th>
                <th>适用岗位对象</th>
                <th>考核核心能力要求</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>POP<br>(Pengawas Operasional Pertama)</strong></td>
                <td>
                  • 采坑一线班组长 (Foreman / Supervisor)<br>
                  • 渣场排土场带班主管<br>
                  • 选矿车间工段长
                </td>
                <td>危险源识别与风险控制 (IBPR)、班前早会交底 (Safety Talk)、现场工作许可审批 (JSA / PTW)。</td>
              </tr>
              <tr>
                <td><strong>POM<br>(Pengawas Operasional Madya)</strong></td>
                <td>
                  • 采矿部副经理 / 生产部长<br>
                  • 机电动力部门负责人<br>
                  • 矿山安全环保主管
                </td>
                <td>矿山安全管理体系（SMKP）运行督导、事故初步技术调查与统筹防范、应急救援队伍指挥协调。</td>
              </tr>
              <tr>
                <td><strong>POU<br>(Pengawas Operasional Utama)</strong></td>
                <td>
                  • 矿业公司常务副总 / 总工程师<br>
                  • 拟出任大中型矿山 KTT 的高级技术总监
                </td>
                <td>矿山安全中长期战略规划、重大地质灾害评估、采矿全生命周期环保与闭矿复垦规划。</td>
              </tr>
            </tbody>
          </table>
        </div>
      </article>

      <article class="zh-card">
        <span class="zh-sec-badge">双轨运行体系</span>
        <h2 class="zh-sec-title">三、劳工部 SMK3 与 能矿部 SMKP 体系有何不同？</h2>
        <p class="zh-text">
          很多中资矿企常问：我们已经做了劳工部的 SMK3 认证，还需要做能矿部的 SMKP 吗？
        </p>
        <div class="zh-law-grid">
          <div class="zh-law-card">
            <strong>SMK3（劳工部监管，PP 50/2012）</strong>
            <p>普适于印尼所有行业企业的通用职业健康安全管理体系。冶炼厂区、选矿厂车间等固定工业场地以此体系为主。</p>
          </div>
          <div class="zh-law-card">
            <strong>SMKP Minerba（能矿部监管，Kepmen 1827/2018）</strong>
            <p><strong>矿区不可替代的专属强制体系！</strong> 专注于露天采坑边坡稳定性、尾矿库坝体沉降监测、高落差重型运矿车防刹车失灵等矿业专属高危场景，每年必须向能矿部报送 SMKP 内部审计报告。</p>
          </div>
        </div>
      </article>
    </main>    <!-- RIGHT: STICKY CONTACT SIDEBAR -->
    <aside class="zh-sticky-sidebar">
      <div class="zh-sb-box">
        <div class="zh-sb-badge">● 官方通道 · 快速对接</div>
        <h3 class="zh-sb-title">中资企业安全合规咨询</h3>
        <p class="zh-sb-desc">
          印尼劳工部官方授权机构 (PJK3) 资深专家团队，提供政策解读、驻厂双语培训与特种设备法定检验。
        </p>
        <a href="https://wa.me/6287759151278?text=%E6%82%A8%E5%A5%BD%EF%BC%8C%E6%88%91%E4%BB%AC%E6%98%AF%E5%9C%A8%E5%8D%B0%E5%B0%BC%E7%9A%84%E7%9F%BF%E4%B8%9A%2F%E9%87%87%E7%9F%BF%E4%B8%AD%E8%B5%84%E4%BC%81%E4%B8%9A%EF%BC%8C%E6%83%B3%E5%92%A8%E8%AF%A2%E8%83%BD%E7%9F%BF%E9%83%A8%E7%9F%BF%E5%B1%B1%E5%AE%89%E5%85%A8%28POP%2FPOM%2FKTT%29%E8%AE%A4%E8%AF%81%E4%B8%8E%E5%90%88%E8%A7%84%E6%9C%8D%E5%8A%A1%E3%80%82" class="zh-sb-wa-btn" target="_blank" rel="noopener">
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
          <li><a href="/zh/k3-kimia/">&bull; 冶炼危化品 (K3 Kimia) 合规</a></li>
          <li><a href="/zh/k3-kebakaran/">&bull; 厂区消防与管网年检 (Damkar)</a></li>
          <li><a href="/zh/k3-pertambangan/" class="active">&bull; 矿山安全 KTT 与 POP/POM</a></li>
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
  <a href="https://wa.me/6287759151278?text=%E6%82%A8%E5%A5%BD%EF%BC%8C%E6%88%91%E4%BB%AC%E6%98%AF%E5%9C%A8%E5%8D%B0%E5%B0%BC%E7%9A%84%E7%9F%BF%E4%B8%9A%2F%E9%87%87%E7%9F%BF%E4%B8%AD%E8%B5%84%E4%BC%81%E4%B8%9A%EF%BC%8C%E6%83%B3%E5%92%A8%E8%AF%A2%E8%83%BD%E7%9F%BF%E9%83%A8%E7%9F%BF%E5%B1%B1%E5%AE%89%E5%85%A8%28POP%2FPOM%2FKTT%29%E8%AE%A4%E8%AF%81%E4%B8%8E%E5%90%88%E8%A7%84%E6%9C%8D%E5%8A%A1%E3%80%82" class="zh-mb-btn" target="_blank" rel="noopener">
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