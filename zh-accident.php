<?php
/**
 * Standard Header for Wahana Totalita Chinese Authority Cluster
 */
require_once __DIR__ . '/config.php';

$page_title = '印尼工厂工伤事故法定处置与劳动监察调查应对指南 — Wahana Totalita';
$meta_desc = '发生工伤、火灾或重大伤亡事故如何依法处置？印尼劳工部2×24小时法定报备(Form 3-3A)、BPJS理赔、警务调查与劳工监察权责界定实操。';
$canonical = SITE_URL . '/zh/kecelakaan-kerja/';
$wa_url = 'https://wa.me/6287759151278?text=' . rawurlencode('您好，我们是在印尼的中资企业，想咨询工伤事故法定申报流程及应急合规支持。');
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
<meta name="keywords" content="印尼工伤事故处置,印尼劳工部Formulir 3-3A,印尼BPJS工伤社保理赔,印尼警方现场封锁,工伤2x24小时报案,印尼劳动监察调查">
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
                    "name": "工伤事故官方处置与劳动监察调查应对",
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
        },
        {
            "@type": "FAQPage",
            "@id": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>#faq",
            "mainEntity": [
                {
                    "@type": "Question",
                    "name": "1. 现场被警方拉了警戒线（Police Line），如何尽快申请复工？",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "警察封锁现场的主要目的是开展物证勘验（Olah TKP）和尸检鉴定。企业切勿私自撕毁警戒线进入生产，否则构成破坏物证刑事重罪。企业应通过法务律师及专职安全官（AK3U），向劳动监察局提交完整的整改报告与安全保障承诺书，由劳工部门向警方出具技术评估函，方可向警方申请解除现场警戒线恢复生产。"
                    }
                },
                {
                    "@type": "Question",
                    "name": "2. 如果伤亡员工是外协分包商或劳务中介工人，总包中资企业有连带责任吗？",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "有连带管理责任。 印尼劳工法规定，业主/总承包商对其施工红线内的所有作业安全负有法定监督义务。若分包商未为员工缴纳 BPJS 社保或工人无特种作业证，劳工局将直接向总包单位问责。总包必须严格落实承包商安全管理系统（CSMS），在进场前强制查验分包商工人的 SIO 证件与社保参保记录。"
                    }
                }
            ]
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
      <a href="/zh/">中文合规首页</a> &gt; <span>工伤事故官方处置与调查应对</span>
    </div>
    <span class="zh-hero-badge">危机应急与法务合规</span>
    <h1>在印尼突发工伤事故，管理层必须遵循的法定程序与应急处置</h1>
    <p>
      当冶炼厂、矿山或工程施工现场发生机械伤害、火灾爆炸或高坠亡人事故时，中资管理层往往因不了解印尼法定程序而产生误判。私了索赔、延误报案或擅自改动现场极易触发刑事妨碍司法调查罪与劳工部停工重罚。本指南为您拆解印尼工伤法定应对标准闭环。
    </p>
    <div class="zh-hero-meta">
      <span>● 依据法规：Permenaker No. 03/MEN/1998</span>
      <span>● 法定时效：2×24 小时强制通报</span>
      <span>● 社保理赔：BPJS Ketenagakerjaan JKK</span>
    </div>
  </div>
</section>

<!-- BODY GRID -->
<div class="zh-container">
  <div class="zh-body-grid">
    <main>
      <article class="zh-card">
        <span class="zh-sec-badge">核心法定红线</span>
        <h2 class="zh-sec-title">一、2×24 小时强制报案：切勿延误或隐瞒不报</h2>
        <p class="zh-text">
          根据印尼现行《1998年第3号劳工部令》（Permenaker No. 03/MEN/1998）关于工伤事故申报与调查规范，企业在工作场所发生任何导致员工暂时丧失劳动能力、残疾或死亡的安全事故后，<strong>必须在事故发生之日起 2×24 小时（48小时）内向所在省/市劳动监察局（Disnaker / Pengawas Ketenagakerjaan）书面报送初次事故报告（Formulir Bentuk 3 KK2 A）</strong>。
        </p>

        <div class="zh-law-grid">
          <div class="zh-law-card">
            <strong>第一阶段：48小时初次通报 (Tahap I)</strong>
            <p>填写并提交官方 Form 3 KK2 A，如实陈述事故发生时间、地点、受害人身份、初步伤害原因及送医救治医院。此表格是后续启动政府工伤定性与社保赔偿的法定前置凭证。</p>
          </div>
          <div class="zh-law-card">
            <strong>第二阶段：事故调查与结案报告 (Tahap II)</strong>
            <p>在医疗终结或事故发生后根据调查进展提交 Form 3 KK2 B，附上内部事故根本原因调查报告（RCA）、整改纠正措施（CAPA）及主治医生证明。</p>
          </div>
        </div>

        <div class="zh-alert-box">
          <strong>严重警示：为什么千万不能“私了隐瞒”？</strong>
          <p>
            部分企业误以为通过巨额私了赔偿家属即可平息事件。在印尼，一旦重伤或亡人信息通过社交媒体、医院系统或工会泄露，劳动监察局与警方将联合立案。企业若存在“隐瞒未报（Menutup-nutupi）”行为，最高现场中方负责人将直接被追究妨碍执法与过失责任，甚至导致项目现场被拉设警戒线长期强制停工。
          </p>
        </div>
      </article>

      <article class="zh-card">
        <span class="zh-sec-badge">双重执法应对</span>
        <h2 class="zh-sec-title">二、印尼警方 (Polri) 与 劳动监察局 (Pengawas) 的调查管辖界限</h2>
        <p class="zh-text">
          在发生重大伤亡事故时，通常会同时介入两支国家行政力量。中资企业管理层必须理清两者的权责差异，针对性开展法律对接：
        </p>

        <div class="zh-table-wrap">
          <table class="zh-table">
            <thead>
              <tr>
                <th>调查机构</th>
                <th>法定管辖依据</th>
                <th>调查核心重点</th>
                <th>对企业的直接风险</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>印尼国家警察 (Polri)</strong></td>
                <td>印尼刑法典 (KUHP) 第359条（重大过失致人死亡）</td>
                <td>
                  • 是否存在人为故意或严重疏忽<br>
                  • 事故现场保全（Police Line）<br>
                  • 现场中印方直接主管的刑事责任笔录
                </td>
                <td>中方负责人/项目经理被列为嫌疑人、限制离境甚至拘留。</td>
              </tr>
              <tr>
                <td><strong>省劳动监察官 (Pengawas Disnaker)</strong></td>
                <td>1970年第1号安全生产法及相关部颁法令</td>
                <td>
                  • 设备是否具备合法检验合格证 (SIA)<br>
                  • 操作人员是否持有效劳工部操作证 (SIO)<br>
                  • 企业是否配备合规注册安全官 (AK3U) 与 P2K3
                </td>
                <td>下发停工整顿令（Nota Pemeriksaan / Stop Work）、行政罚款、企业安全资质降级。</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="zh-tip-box">
          <strong>合规防线：平时抓牢“双证”，战时规避刑事指控</strong>
          <p>
            如果事发设备具备合法有效的政府检验合格证（SIA），操作人员持有正规劳工部操作证（SIO），企业内部有 P2K3 安全培训打卡记录，警方便很难定性为“管理层重大疏忽刑事犯罪（Kelalaian Berat）”，案件可作为一般生产意外依法通过工伤保险结算与行政整改结案。
          </p>
        </div>
      </article>

      <article class="zh-card">
        <span class="zh-sec-badge">社保索赔流程</span>
        <h2 class="zh-sec-title">三、BPJS Ketenagakerjaan 工伤社保 (JKK) 理赔全流程</h2>
        <p class="zh-text">
          在印尼，工伤赔偿绝不是由雇主无底线承担，国家工伤保险（Jaminan Kecelakaan Kerja: JKK）提供了极高力度的兜底保障。企业应合法运用国家社保政策，避免陷入家属或外部非政府组织的敲诈索赔：
        </p>
        <ul>
          <li><strong>医疗救治费用无上限（Sesuai Kebutuhan Medis）：</strong> 在与 BPJS 合作的公立/私立医院（Puskesmas / RS Trauma Center），一切合理的住院、手术、重症监护及康复费用均由 BPJS 100% 直付或报销。</li>
          <li><strong>暂时丧失劳动能力工资补偿 (STMB)：</strong> 事故发生后前 6 个月，BPJS 补偿 100% 原工资金额，后 6 个月补偿 75%，直至康复或被鉴定为永久残疾。</li>
          <li><strong>法定因公死亡赔偿金：</strong> 因公死亡由 BPJS 支付相当于 48 个月基本工资的抚恤赔偿，另加安葬费（Rp 10.000.000）及两名子女直至大学毕业的奖学金资助（最高累计可达 Rp 174.000.000）。</li>
        </ul>
      </article>

      <article class="zh-card">
        <span class="zh-sec-badge">高管常见疑问</span>
        <h2 class="zh-sec-title">四、关于工伤处理的高频实务问答</h2>
        
        <div class="zh-faq-item">
          <button class="zh-faq-q" onclick="toggleZhFaq(this)">
            <span>1. 现场被警方拉了警戒线（Police Line），如何尽快申请复工？</span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
          <div class="zh-faq-a">
            <p>警察封锁现场的主要目的是开展物证勘验（Olah TKP）和尸检鉴定。企业切勿私自撕毁警戒线进入生产，否则构成破坏物证刑事重罪。企业应通过法务律师及专职安全官（AK3U），向劳动监察局提交完整的整改报告与安全保障承诺书，由劳工部门向警方出具技术评估函，方可向警方申请解除现场警戒线恢复生产。</p>
          </div>
        </div>

        <div class="zh-faq-item">
          <button class="zh-faq-q" onclick="toggleZhFaq(this)">
            <span>2. 如果伤亡员工是外协分包商或劳务中介工人，总包中资企业有连带责任吗？</span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
          <div class="zh-faq-a">
            <p><strong>有连带管理责任。</strong> 印尼劳工法规定，业主/总承包商对其施工红线内的所有作业安全负有法定监督义务。若分包商未为员工缴纳 BPJS 社保或工人无特种作业证，劳工局将直接向总包单位问责。总包必须严格落实承包商安全管理系统（CSMS），在进场前强制查验分包商工人的 SIO 证件与社保参保记录。</p>
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
        <a href="https://wa.me/6287759151278?text=%E6%82%A8%E5%A5%BD%EF%BC%8C%E6%88%91%E4%BB%AC%E6%98%AF%E5%9C%A8%E5%8D%B0%E5%B0%BC%E7%9A%84%E4%B8%AD%E8%B5%84%E4%BC%81%E4%B8%9A%EF%BC%8C%E6%83%B3%E5%92%A8%E8%AF%A2%E5%B7%A5%E4%BC%A4%E4%BA%8B%E6%95%85%E6%B3%95%E5%AE%9A%E7%94%B3%E6%8A%A5%E6%B5%81%E7%A8%8B%E5%8F%8A%E5%BA%94%E6%80%A5%E5%90%88%E8%A7%84%E6%94%AF%E6%8C%81%E3%80%82" class="zh-sb-wa-btn" target="_blank" rel="noopener">
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
          <li><a href="/zh/kecelakaan-kerja/" class="active">&bull; 工伤事故处置与调查应对</a></li>
          <li><a href="/zh/k3-kimia/">&bull; 冶炼危化品 (K3 Kimia) 合规</a></li>
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
  <a href="https://wa.me/6287759151278?text=%E6%82%A8%E5%A5%BD%EF%BC%8C%E6%88%91%E4%BB%AC%E6%98%AF%E5%9C%A8%E5%8D%B0%E5%B0%BC%E7%9A%84%E4%B8%AD%E8%B5%84%E4%BC%81%E4%B8%9A%EF%BC%8C%E6%83%B3%E5%92%A8%E8%AF%A2%E5%B7%A5%E4%BC%A4%E4%BA%8B%E6%95%85%E6%B3%95%E5%AE%9A%E7%94%B3%E6%8A%A5%E6%B5%81%E7%A8%8B%E5%8F%8A%E5%BA%94%E6%80%A5%E5%90%88%E8%A7%84%E6%94%AF%E6%8C%81%E3%80%82" class="zh-mb-btn" target="_blank" rel="noopener">
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