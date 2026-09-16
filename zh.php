<?php
/**
 * zh.php — 印尼企业安全生产(K3)法规合规与官方认证指南
 * 专门面向在印尼中资企业管理层、总承包商及工业园区项目决策人的法定合规指南
 * Standalone Chinese Hub (Zero Indonesian Interlink Leakage)
 */
require_once __DIR__ . '/config.php';

$s = get_all_settings();
$wa_number = '6287759151278';
$wa_msg = rawurlencode('您好，我们是在印尼的中资企业，希望咨询安全生产(K3)合规与人员法定持证培训事宜。');
$wa_url = "https://wa.me/{$wa_number}?text={$wa_msg}";

$page_title = '印尼企业安全生产(K3)法规合规与官方认证指南 — Wahana Totalita';
$meta_desc = '专为在印尼投资的中资企业管理层打造的安全生产(K3)法定合规手册。权威解读印尼1970年第1号劳工法、特种设备操作证(SIO)、承压设备年检(SIA)及SMK3审核要点。';
$canonical = SITE_URL . '/zh/';
?>
<!DOCTYPE html>
<html lang="zh-Hans">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?></title>
<meta name="description" content="<?= htmlspecialchars($meta_desc, ENT_QUOTES, 'UTF-8') ?>">
<link rel="canonical" href="<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>">
<link rel="alternate" hreflang="zh-Hans" href="https://wahanatotalita.com/zh/" />
<link rel="alternate" hreflang="id" href="https://wahanatotalita.com/" />
<link rel="alternate" hreflang="x-default" href="https://wahanatotalita.com/" />
<meta name="robots" content="index, follow">
<meta name="keywords" content="印尼安全生产法规,印尼K3合规,印尼安全官AK3U,印尼特种设备年检SIA,印尼特种作业操作证SIO,印尼SMK3金牌认证,P2K3委员会设立,中资企业印尼办厂">
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
                }
            ]
        },
        {
            "@type": "WebPage",
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
                    "name": "1. 中方管理人员或技术人员，能否直接考取印尼劳工部法定证书？",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "原则上不可以。 印尼劳工部（Kemnaker RI）颁发的法定资格证书（如 Ahli K3 Umum 注册安全工程师、叉车/吊车 SIO 操作证）明确要求持有印尼身份证（KTP）的印尼籍合法公民。 实务解决方案： 企业应选拔优秀的印尼籍主管、领班或安全助理参加正规考证，企业获得法定安全团队的设立资质；中方管理人员及技术骨干可作为旁听人员协同培训，以深入掌握印尼当地的安全法规与管理接口。"
                    }
                },
                {
                    "@type": "Question",
                    "name": "2. 从中国国内采购进口的全新或二手机械设备，如何合法在印尼投产？",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "机械设备清关进入印尼现场并完成安装后，不可直接带电带压投产。印尼法律规定，起重机械、叉车、锅炉、空压机、储气罐及发电机组等设备，必须委托具备印尼劳工部特种检验资质的机构（PJK3 Riksa Uji）进行现场无损探伤、负荷试验及安全阀校验。 检验合格后，由劳工部颁发设备合法准用证（Surat Keterangan K3 / Buku Akte Pengesahan），方属于合法合规投产。未取得准用证的设备擅自运行，一旦遭遇突击检查将被查封甚至断电。"
                    }
                },
                {
                    "@type": "Question",
                    "name": "3. 劳工部劳动监察大队 (Pengawas) 进厂突击检查，主要查验哪些材料？",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "劳动监察通常不会走过场，其核查重点非常聚焦： 人员资质： 特种设备操作人员的 SIO 执照是否在 3 年有效期内；现场是否有全职 Ahli K3 Umum 履职。 组织机构： 是否在劳工部完成安全生产委员会（P2K3）备案，并按季度提交安全季报。 设备年检： 叉车、行车、压力容器的安全年检标签是否在有效期内。 工伤保险： 员工是否已全额缴纳印尼国家社保（BPJS Ketenagakerjaan）。"
                    }
                },
                {
                    "@type": "Question",
                    "name": "4. 什么是 SMK3 认证？为什么参与印尼国家工程和矿山投标必须具备？",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "SMK3（Sistem Manajemen Keselamatan dan Kesehatan Kerja）是印尼依据 2012 年第 50 号政府条例（PP 50/2012）推行的国家级职业健康安全管理体系。与自愿性质的 ISO 45001 不同，SMK3 是印尼政府的法定强制性认证。 在印尼国家电力公司（PLN）、印尼国家石油公司（Pertamina）以及各类大型矿企、冶炼厂的工程分包和供应商准入审核（CSMS）中，出具劳工部认可的 SMK3 审核证书（尤其是 85% 以上合规率的金牌认证 Bendera Emas）是绝大部分标段的前置硬性门槛。"
                    }
                },
                {
                    "@type": "Question",
                    "name": "5. 偏远岛屿项目（如苏拉威西青山、纬达贝、加里曼丹）如何开展培训？",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Wahana Totalita 具备承接全印尼各省驻厂定制内训（In-House Corporate Training）的完整资质。对于岛屿或偏远工区企业，我司资深印尼劳工部注册督导与实操考官团队可直接派遣至客户矿山或厂区现场： 理论部分： 支持采用在线互动授课或现场集中授课，最大限度减少停产工时损失。 实操与考核： 在客户现场现有设备上直接开展合规实操、盲区测试及国家级考试，免去大批员工远赴大城市的差旅交通成本与考勤风险。"
                    }
                }
            ]
        }
    ]
}
</script>

<!-- Open Graph -->
">
">
">
<!-- Fonts & Master Stylesheet -->
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
  line-height: 1.75;
  margin: 0;
  padding: 0;
  -webkit-font-smoothing: antialiased;
}

/* Nav */
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
.zh-nav-contact {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: var(--hub-primary);
  color: #ffffff;
  text-decoration: none;
  font-size: 13.5px;
  font-weight: 700;
  padding: 8px 16px;
  border-radius: 8px;
  transition: background .2s ease;
}
.zh-nav-contact:hover {
  background: var(--hub-primary-light);
}

/* Hero Section */
.zh-hero {
  background: linear-gradient(145deg, #0A4A2E 0%, #06321f 100%);
  color: #ffffff;
  padding: 56px 0 50px;
  border-bottom: 4px solid var(--hub-accent);
}
.zh-container {
  max-width: 1180px;
  margin: 0 auto;
  padding: 0 20px;
}
.zh-breadcrumb {
  font-size: 13px;
  color: rgba(255,255,255,0.7);
  margin-bottom: 16px;
}
.zh-breadcrumb a {
  color: rgba(255,255,255,0.85);
  text-decoration: none;
}
.zh-hero-pill {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: rgba(255,255,255,0.12);
  border: 1px solid rgba(255,255,255,0.22);
  color: #a7f3d0;
  padding: 5px 12px;
  border-radius: 999px;
  font-size: 13px;
  font-weight: 700;
  margin-bottom: 16px;
}
.zh-hero h1 {
  font-size: clamp(1.8rem, 4vw, 2.7rem);
  font-weight: 800;
  line-height: 1.3;
  letter-spacing: -0.01em;
  margin: 0 0 16px;
}
.zh-hero-lead {
  font-size: clamp(15px, 1.8vw, 17px);
  color: rgba(255,255,255,0.9);
  max-width: 900px;
  line-height: 1.8;
  margin: 0 0 28px;
}

/* Trust Bar */
.zh-trust-bar {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 14px;
  background: rgba(0,0,0,0.25);
  border: 1px solid rgba(255,255,255,0.15);
  border-radius: 12px;
  padding: 16px 20px;
}
.zh-trust-item {
  display: flex;
  align-items: flex-start;
  gap: 10px;
}
.zh-trust-item svg {
  color: #34d399;
  flex-shrink: 0;
  margin-top: 3px;
}
.zh-trust-item strong {
  display: block;
  font-size: 14px;
  color: #ffffff;
}
.zh-trust-item span {
  font-size: 12.5px;
  color: rgba(255,255,255,0.75);
}

/* Layout Grid */
.zh-body-grid {
  display: grid;
  grid-template-columns: 1fr 340px;
  gap: 36px;
  padding: 50px 0 70px;
}
@media (max-width: 991px) {
  .zh-body-grid {
    grid-template-columns: 1fr;
    gap: 30px;
  }
}

/* Article Sections */
.zh-card {
  background: #ffffff;
  border: 1px solid var(--hub-border);
  border-radius: 14px;
  padding: 32px;
  margin-bottom: 28px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.03);
}
.zh-sec-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 12px;
  font-weight: 800;
  color: var(--hub-accent);
  text-transform: uppercase;
  letter-spacing: 0.05em;
  margin-bottom: 8px;
}
.zh-sec-title {
  font-size: 1.45rem;
  font-weight: 800;
  color: var(--hub-dark);
  margin: 0 0 16px;
  line-height: 1.35;
}
.zh-text {
  font-size: 15px;
  color: #374151;
  line-height: 1.85;
  margin: 0 0 16px;
}

/* Red Line Alert Box */
.zh-alert-box {
  background: #fff7ed;
  border-left: 4px solid #f97316;
  border-radius: 8px;
  padding: 16px 20px;
  margin: 20px 0;
}
.zh-alert-box strong {
  display: block;
  font-size: 15px;
  color: #9a3412;
  margin-bottom: 6px;
}
.zh-alert-box p {
  font-size: 14px;
  color: #7c2d12;
  margin: 0;
  line-height: 1.7;
}

/* Law Comparison Grid */
.zh-law-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 16px;
  margin-top: 20px;
}
.zh-law-card {
  background: #f8fafc;
  border: 1.5px solid #e2e8f0;
  border-radius: 10px;
  padding: 18px 20px;
}
.zh-law-card strong {
  display: block;
  font-size: 15px;
  color: var(--hub-primary);
  margin-bottom: 6px;
}
.zh-law-card p {
  font-size: 13.5px;
  color: #4b5563;
  margin: 0;
  line-height: 1.65;
}

/* Tables */
.zh-table-wrap {
  overflow-x: auto;
  margin: 20px 0 10px;
  border-radius: 10px;
  border: 1px solid #e5e7eb;
}
.zh-table {
  width: 100%;
  border-collapse: collapse;
  text-align: left;
  font-size: 14px;
}
.zh-table th {
  background: #f1f5f9;
  color: var(--hub-dark);
  font-weight: 700;
  padding: 12px 16px;
  border-bottom: 1.5px solid #cbd5e1;
  white-space: nowrap;
}
.zh-table td {
  padding: 12px 16px;
  border-bottom: 1px solid #f1f5f9;
  color: #374151;
  vertical-align: top;
}
.zh-table tr:last-child td {
  border-bottom: none;
}
.zh-tag-must {
  background: #fef2f2;
  color: #dc2626;
  font-size: 12px;
  font-weight: 700;
  padding: 2px 8px;
  border-radius: 4px;
  display: inline-block;
  white-space: nowrap;
}

/* FAQ Accordion */
.zh-faq-item {
  border: 1px solid #e5e7eb;
  border-radius: 10px;
  margin-bottom: 12px;
  overflow: hidden;
  background: #ffffff;
}
.zh-faq-q {
  width: 100%;
  text-align: left;
  background: #f8fafc;
  border: none;
  padding: 16px 20px;
  font-size: 15px;
  font-weight: 700;
  color: var(--hub-dark);
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  font-family: inherit;
}
.zh-faq-q:hover {
  background: #f1f5f9;
}
.zh-faq-a {
  padding: 0 20px;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.3s ease, padding 0.3s ease;
  font-size: 14.5px;
  color: #4b5563;
  line-height: 1.8;
  background: #ffffff;
}
.zh-faq-a.open {
  padding: 16px 20px 20px;
  max-height: 500px;
  border-top: 1px solid #e5e7eb;
}

/* Sidebar Sticky */
.zh-sticky-sidebar {
  position: relative;
}
.zh-sb-box {
  position: sticky;
  top: 86px;
  background: #ffffff;
  border: 1.5px solid #d1fae5;
  border-radius: 14px;
  padding: 26px 22px;
  box-shadow: 0 6px 20px rgba(10,74,46,0.06);
}
.zh-sb-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: #ecfdf5;
  color: #059669;
  font-size: 12px;
  font-weight: 700;
  padding: 4px 10px;
  border-radius: 999px;
  margin-bottom: 12px;
}
.zh-sb-title {
  font-size: 1.15rem;
  font-weight: 800;
  color: var(--hub-dark);
  margin: 0 0 8px;
  line-height: 1.4;
}
.zh-sb-desc {
  font-size: 13.5px;
  color: #6b7280;
  margin: 0 0 18px;
  line-height: 1.65;
}
.zh-sb-wa-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  width: 100%;
  background: #25D366;
  color: #ffffff;
  text-decoration: none;
  font-size: 14.5px;
  font-weight: 700;
  padding: 12px 18px;
  border-radius: 8px;
  box-sizing: border-box;
  box-shadow: 0 4px 12px rgba(37,211,102,0.25);
  transition: transform .2s, background .2s;
}
.zh-sb-wa-btn:hover {
  background: #20ba5a;
  transform: translateY(-2px);
}
.zh-sb-divider {
  height: 1px;
  background: #f1f5f9;
  margin: 20px 0;
}
.zh-sb-info-row {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  font-size: 13px;
  color: #4b5563;
  margin-bottom: 12px;
}
.zh-sb-info-row svg {
  flex-shrink: 0;
  color: var(--hub-primary);
  margin-top: 2px;
}

/* Footer */
.zh-footer {
  background: #111827;
  color: #9ca3af;
  padding: 48px 0 32px;
  font-size: 13.5px;
  line-height: 1.7;
}
.zh-footer-inner {
  max-width: 1180px;
  margin: 0 auto;
  padding: 0 20px;
  display: grid;
  grid-template-columns: 2fr 1fr;
  gap: 40px;
  border-bottom: 1px solid rgba(255,255,255,0.1);
  padding-bottom: 30px;
  margin-bottom: 24px;
}
@media (max-width: 768px) {
  .zh-footer-inner {
    grid-template-columns: 1fr;
    gap: 24px;
  }
}
.zh-footer h4 {
  color: #ffffff;
  font-size: 15px;
  font-weight: 700;
  margin: 0 0 12px;
}
.zh-footer p {
  margin: 0 0 10px;
}
.zh-footer-bottom {
  max-width: 1180px;
  margin: 0 auto;
  padding: 0 20px;
  font-size: 12.5px;
  color: #6b7280;
  text-align: center;
}

/* Mobile Bar */
.zh-mobile-bar {
  display: none;
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  background: #ffffff;
  border-top: 1px solid var(--hub-border);
  padding: 10px 16px;
  z-index: 999;
  box-shadow: 0 -4px 16px rgba(0,0,0,0.08);
}
@media (max-width: 991px) {
  .zh-mobile-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
  }
}
.zh-mb-text {
  font-size: 13px;
  font-weight: 700;
  color: var(--hub-dark);
  line-height: 1.3;
}
.zh-mb-sub {
  font-size: 11.5px;
  color: #6b7280;
}
.zh-mb-btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: #25D366;
  color: #ffffff;
  font-size: 13.5px;
  font-weight: 700;
  padding: 9px 16px;
  border-radius: 8px;
  text-decoration: none;
  white-space: nowrap;
}
</style>
</head>
<body>

<!-- NAVIGATION -->
<header class="zh-nav">
  <div class="zh-nav-inner">
    <a href="/zh/" class="zh-logo">
      <img src="/assets/img/logo-wt.webp" alt="Wahana Totalita Logo" width="160" height="38" onerror="this.onerror=null;this.src='/assets/img/logo-wt.png'">
      <span class="zh-lang-badge">中文版 / 中资企业合规指南</span>
    </a>
    <a href="<?= $wa_url ?>" class="zh-nav-contact" target="_blank" rel="noopener">
      <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
      <span>商务与技术合规咨询</span>
    </a>
  </div>
</header>

<!-- HERO SECTION -->
<section class="zh-hero">
  <div class="zh-container">
    <div class="zh-breadcrumb">
      <span>首页</span> &rsaquo; <span>印尼企业安全生产 (K3) 法定合规专栏</span>
    </div>

    <div class="zh-hero-pill">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
      <span>印尼劳工部官方授权资质机构 · PJK3 No. Kep. 312/BINWASPNAK-PNK3/V/2020</span>
    </div>

    <h1>印尼中资企业安全生产 (K3) 法律合规与认证全解</h1>
    <p class="zh-hero-lead">
      系统梳理印尼劳工部 (Kemnaker) 强制性监管法规。针对中资矿山、冶炼厂、电厂、建筑总包及制造企业的核心关切，厘清法定持证要求、设备检验标准及避免停工处罚的实操路径。
    </p>

    <!-- Trust Bar -->
    <div class="zh-trust-bar">
      <div class="zh-trust-item">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        <div>
          <strong>印尼国家双重资质</strong>
          <span>Kemnaker劳工部 &amp; BNSP国家认证</span>
        </div>
      </div>
      <div class="zh-trust-item">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
        <div>
          <strong>全印尼现场驻厂内训</strong>
          <span>苏拉威西/纬达贝/加里曼丹/爪哇</span>
        </div>
      </div>
      <div class="zh-trust-item">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        <div>
          <strong>正规法务发票与证明</strong>
          <span>符合印尼税务及企业财务合规</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- MAIN CONTENT + SIDEBAR -->
<div class="zh-container">
  <div class="zh-body-grid">

    <!-- LEFT: INFORMATIVE CONTENT -->
    <main>

      <!-- SECTION 1: 核心法律底线 -->
      <article class="zh-card">
        <span class="zh-sec-badge">核心法规监管</span>
        <h2 class="zh-sec-title">一、在印尼办厂与施工，必须清楚的 3 条安全法律红线</h2>
        <p class="zh-text">
          在印尼开展商业投资或工程建设，安全生产（印尼语统称为 <strong>K3: Keselamatan dan Kesehatan Kerja</strong>）并非推荐性的企业文化，而是受到印尼劳工部（Kementerian Ketenagakerjaan RI）及地方劳动监察局（Pengawas Ketenagakerjaan）刑事与行政双重监管的强制性法定责任。
        </p>

        <div class="zh-law-grid">
          <div class="zh-law-card">
            <strong>1. 《1970年第1号安全生产法》</strong>
            <p>全印尼K3法律总纲。赋予政府劳工监察人员随时无须提前通知直接进入厂区、工地检查的权力。若发现重大事故隐患，监察官有权当场签发停工整顿令（Stop-work order）。</p>
          </div>
          <div class="zh-law-card">
            <strong>2. 强制设岗门槛：满100人或高危企业</strong>
            <p>凡聘用员工满 100 人，或员工不满 100 人但生产过程存在火灾、爆炸、有毒有害化学品、粉尘、高压或重型机械等高风险因素的企业，<strong>必须依法设立安全生产委员会 (P2K3) 并配备持证安全官 (Ahli K3 Umum)</strong>。</p>
          </div>
          <div class="zh-law-card">
            <strong>3. 设备与人员的“双证准入”原则</strong>
            <p>特种作业不仅要求操作人员持有劳工部个人操作证（SIO），设备本身（如叉车、天车、锅炉、空压机、储气罐）还必须由具备资质的机构定期检验并持有政府出具的检验合格证（SIA / Riksa Uji）。</p>
          </div>
        </div>

        <div class="zh-alert-box">
          <strong>企业负责人的法律责任风险提示：</strong>
          <p>
            印尼法律严格追究企业最高现场负责人（General Manager / Project Director / Kepala Teknik Tambang）的安全连带责任。若因无证操作特种设备或未按法规开展年检导致重伤或亡人安全事故，企业面临的不仅是巨额赔偿，最高负责人还将面临印尼警方的刑事调查与被限制出境风险。
          </p>
        </div>
      </article>

      <!-- SECTION 2: 常见特种作业持证对照表 -->
      <article class="zh-card">
        <span class="zh-sec-badge">法定资质清单</span>
        <h2 class="zh-sec-title">二、中资企业现场高频特种岗位与法定证件对照表</h2>
        <p class="zh-text">
          为确保企业在劳工部巡检、业主安全审计（CSMS）及政府联合执法时顺利通关，以下重点岗位必须安排人员完成印尼官方考证：
        </p>

        <div class="zh-table-wrap">
          <table class="zh-table">
            <thead>
              <tr>
                <th>中文岗位名称</th>
                <th>印尼官方法定证书 (SIO / SKP)</th>
                <th>法规依据</th>
                <th>合规等级</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>企业通用安全官</strong><br><small>HSE主管/厂区合规代表</small></td>
                <td>Ahli K3 Umum (AK3U) Kemnaker RI</td>
                <td>Permenaker 02/1992</td>
                <td><span class="zh-tag-must">强制必备 (满100人/高危)</span></td>
              </tr>
              <tr>
                <td><strong>叉车驾驶员</strong><br><small>仓储、堆场、车间转运</small></td>
                <td>Lisensi Operator Forklift Kelas 1 / 2</td>
                <td>Permenaker 08/2020</td>
                <td><span class="zh-tag-must">无证作业严禁上车</span></td>
              </tr>
              <tr>
                <td><strong>天车 / 桥式起重机</strong><br><small>车间吊装、铸造、机加工</small></td>
                <td>Operator Overhead Crane (Keran Angkat)</td>
                <td>Permenaker 08/2020</td>
                <td><span class="zh-tag-must">重伤高发，巡检必查</span></td>
              </tr>
              <tr>
                <td><strong>特种焊工 (管道/承压)</strong><br><small>压力管道、结构焊、储罐</small></td>
                <td>Juru Las Kemnaker RI (Kelas 1 / 2 / 3)</td>
                <td>Permenaker 02/1982</td>
                <td><span class="zh-tag-must">承压设备焊接强制</span></td>
              </tr>
              <tr>
                <td><strong>锅炉与压力容器人员</strong><br><small>电厂锅炉、蒸汽发生器、储气罐</small></td>
                <td>Operator Boiler &amp; Teknisi Bejana Tekan</td>
                <td>Permenaker 01/1988 &amp; 37/2016</td>
                <td><span class="zh-tag-must">重大爆炸隐患监控点</span></td>
              </tr>
              <tr>
                <td><strong>高空作业作业人员</strong><br><small>钢构安装、脚手架、塔筒维护</small></td>
                <td>TKBT (Tenaga Kerja Bangunan Tinggi)</td>
                <td>Permenaker 09/2016</td>
                <td><span class="zh-tag-must">2米以上作业许可</span></td>
              </tr>
              <tr>
                <td><strong>企业安全生产体系</strong><br><small>全厂安全管理体系与竞标</small></td>
                <td>Sertifikasi SMK3 PP No. 50 Tahun 2012</td>
                <td>PP 50/2012</td>
                <td><span class="zh-tag-must">大型央企/矿业投标门槛</span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </article>

      <!-- SECTION 3: 决策层高频问题解答 (BOSS FAQ) -->
      <article class="zh-card">
        <span class="zh-sec-badge">决策者问答</span>
        <h2 class="zh-sec-title">三、中资企业管理层最关心的 5 大合规核心问题</h2>
        <p class="zh-text">针对企业主在实操中经常遇到的制度疑惑与误区，提供务实清晰的解答：</p>

        <div class="zh-faq-item">
          <button class="zh-faq-q" onclick="toggleZhFaq(this)">
            <span>1. 中方管理人员或技术人员，能否直接考取印尼劳工部法定证书？</span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
          <div class="zh-faq-a">
            <p>
              <strong>原则上不可以。</strong> 印尼劳工部（Kemnaker RI）颁发的法定资格证书（如 Ahli K3 Umum 注册安全工程师、叉车/吊车 SIO 操作证）明确要求持有印尼身份证（KTP）的印尼籍合法公民。
            </p>
            <p>
              <strong>实务解决方案：</strong> 企业应选拔优秀的印尼籍主管、领班或安全助理参加正规考证，企业获得法定安全团队的设立资质；中方管理人员及技术骨干可作为旁听人员协同培训，以深入掌握印尼当地的安全法规与管理接口。
            </p>
          </div>
        </div>

        <div class="zh-faq-item">
          <button class="zh-faq-q" onclick="toggleZhFaq(this)">
            <span>2. 从中国国内采购进口的全新或二手机械设备，如何合法在印尼投产？</span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
          <div class="zh-faq-a">
            <p>
              机械设备清关进入印尼现场并完成安装后，<strong>不可直接带电带压投产</strong>。印尼法律规定，起重机械、叉车、锅炉、空压机、储气罐及发电机组等设备，必须委托具备印尼劳工部特种检验资质的机构（PJK3 Riksa Uji）进行现场无损探伤、负荷试验及安全阀校验。
            </p>
            <p>
              检验合格后，由劳工部颁发设备合法准用证（Surat Keterangan K3 / Buku Akte Pengesahan），方属于合法合规投产。未取得准用证的设备擅自运行，一旦遭遇突击检查将被查封甚至断电。
            </p>
          </div>
        </div>

        <div class="zh-faq-item">
          <button class="zh-faq-q" onclick="toggleZhFaq(this)">
            <span>3. 劳工部劳动监察大队 (Pengawas) 进厂突击检查，主要查验哪些材料？</span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
          <div class="zh-faq-a">
            <p>劳动监察通常不会走过场，其核查重点非常聚焦：</p>
            <ul>
              <li><strong>人员资质：</strong> 特种设备操作人员的 SIO 执照是否在 3 年有效期内；现场是否有全职 Ahli K3 Umum 履职。</li>
              <li><strong>组织机构：</strong> 是否在劳工部完成安全生产委员会（P2K3）备案，并按季度提交安全季报。</li>
              <li><strong>设备年检：</strong> 叉车、行车、压力容器的安全年检标签是否在有效期内。</li>
              <li><strong>工伤保险：</strong> 员工是否已全额缴纳印尼国家社保（BPJS Ketenagakerjaan）。</li>
            </ul>
          </div>
        </div>

        <div class="zh-faq-item">
          <button class="zh-faq-q" onclick="toggleZhFaq(this)">
            <span>4. 什么是 SMK3 认证？为什么参与印尼国家工程和矿山投标必须具备？</span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
          <div class="zh-faq-a">
            <p>
              SMK3（Sistem Manajemen Keselamatan dan Kesehatan Kerja）是印尼依据 2012 年第 50 号政府条例（PP 50/2012）推行的国家级职业健康安全管理体系。与自愿性质的 ISO 45001 不同，SMK3 是印尼政府的法定强制性认证。
            </p>
            <p>
              在印尼国家电力公司（PLN）、印尼国家石油公司（Pertamina）以及各类大型矿企、冶炼厂的工程分包和供应商准入审核（CSMS）中，出具劳工部认可的 SMK3 审核证书（尤其是 85% 以上合规率的金牌认证 Bendera Emas）是绝大部分标段的前置硬性门槛。
            </p>
          </div>
        </div>

        <div class="zh-faq-item">
          <button class="zh-faq-q" onclick="toggleZhFaq(this)">
            <span>5. 偏远岛屿项目（如苏拉威西青山、纬达贝、加里曼丹）如何开展培训？</span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
          <div class="zh-faq-a">
            <p>
              Wahana Totalita 具备承接全印尼各省驻厂定制内训（In-House Corporate Training）的完整资质。对于岛屿或偏远工区企业，我司资深印尼劳工部注册督导与实操考官团队可直接派遣至客户矿山或厂区现场：
            </p>
            <ul>
              <li><strong>理论部分：</strong> 支持采用在线互动授课或现场集中授课，最大限度减少停产工时损失。</li>
              <li><strong>实操与考核：</strong> 在客户现场现有设备上直接开展合规实操、盲区测试及国家级考试，免去大批员工远赴大城市的差旅交通成本与考勤风险。</li>
            </ul>
          </div>
        </div>

      </article>

      <!-- SECTION 4: 华纳全能咨询支持体系 -->
      <article class="zh-card" style="border-color:#bbf7d0;background:#fcfdfc;">
        <span class="zh-sec-badge">专业服务支撑</span>
        <h2 class="zh-sec-title">四、Wahana Totalita 能够为中资企业提供哪些支持？</h2>
        <p class="zh-text">
          Wahana Totalita Konsultan（PT Wahana Totalita）自 2008 年成立以来，深耕印尼企业合规服务逾 18 年，是印尼劳工部（Kemnaker RI）及国家职业认证局（BNSP）正式授权的综合安全技术机构（PJK3）。
        </p>

        <div class="zh-law-grid">
          <div class="zh-law-card" style="background:#ffffff;">
            <strong style="color:#0A4A2E;">1. 现场合规差距诊断 (Gap Analysis)</strong>
            <p>对照印尼劳工部执法标准，全面梳理企业现场持证人员缺口、设备年检盲区及应急预案短板，出具可执行的整改规划书。</p>
          </div>
          <div class="zh-law-card" style="background:#ffffff;">
            <strong style="color:#0A4A2E;">2. 驻厂定制化考证培训</strong>
            <p>针对冶炼、矿业、建筑及电厂实际工况量身定制内训大纲，提供具备双语对接经验的项目经理协助沟通，官方证书真实可查。</p>
          </div>
          <div class="zh-law-card" style="background:#ffffff;">
            <strong style="color:#0A4A2E;">3. 特种设备法定检测协调 (Riksa Uji)</strong>
            <p>协助企业规范组织起重机、压力容器、锅炉等高危设备的法定第三方无损检测与官方牌照申领换发。</p>
          </div>
          <div class="zh-law-card" style="background:#ffffff;">
            <strong style="color:#0A4A2E;">4. 财务与税务完全合规</strong>
            <p>提供印尼正规对公税务发票（Faktur Pajak）及官方培训资质合同，账务清晰合规，免除企业审计后顾之忧。</p>
          </div>
        </div>
      </article>

            <!-- SECTION 5: 核心合规专题指引与实操手册 -->
      <article class="zh-card">
        <span class="zh-sec-badge">合规专题深入</span>
        <h2 class="zh-sec-title">五、中资企业安全生产法定合规专题专栏 (深度实操手册)</h2>
        <p class="zh-text">
          针对特定岗位配置、事故应急、危化品管理、矿山监管、设备年检及体系审核，我们为您整理了以下细分领域的专业实操手册与自查清单：
        </p>
        <div class="zh-law-grid">
          <div class="zh-law-card" style="background:#f0fdf4;border-color:#bbf7d0;grid-column:1/-1;">
            <strong style="font-size:16px;"><a href="/zh/factory-roadmap/" style="color:#0A4A2E;text-decoration:none;">★ 从零建厂到合法投产：在印尼办厂安全合规全流程实操指南 &rarr;</a></strong>
            <p>一文通晓从规划设计图审、土建施工持证、特种设备进口检验准用（SIA/Riksa Uji）、安全官AK3U配置到SMK3体系认证的五阶段完整全景路线图。</p>
          </div>
          <div class="zh-law-card" style="background:#fefce8;border-color:#fef08a;grid-column:1/-1;">
            <strong style="font-size:16px;"><a href="/zh/checklist/" style="color:#854d0e;text-decoration:none;">📋 中资企业在印尼安全生产法定合规自查排查清单 (Checklist) &rarr;</a></strong>
            <p>管理层对照自检工具：人员持证(AK3U/SIO)、设备年检(SIA)、组织批文(P2K3)与应急预案四大维度逐项打勾。</p>
          </div>
          <div class="zh-law-card" style="background:#f0fdf4;border-color:#bbf7d0;">
            <strong style="font-size:15px;"><a href="/zh/kecelakaan-kerja/" style="color:#0A4A2E;text-decoration:none;">1. 工伤事故官方处置与调查应对 &rarr;</a></strong>
            <p>Permenaker 03/1998 法定 2×24 小时报案程序、BPJS 工伤社保赔付直付及警方与劳工监察局权责边界。</p>
          </div>
          <div class="zh-law-card" style="background:#f0fdf4;border-color:#bbf7d0;">
            <strong style="font-size:15px;"><a href="/zh/k3-kimia/" style="color:#0A4A2E;text-decoration:none;">2. 湿法冶炼与危化品 (K3 Kimia) 合规 &rarr;</a></strong>
            <p>HPAL高压酸浸与RKEF火法冶炼硫酸/危化品安全员与高级安全官(Kepmenaker 187/1999)配比及印尼语LDK/SDS。</p>
          </div>
          <div class="zh-law-card" style="background:#f0fdf4;border-color:#bbf7d0;">
            <strong style="font-size:15px;"><a href="/zh/k3-kebakaran/" style="color:#0A4A2E;text-decoration:none;">3. 工厂消防安全与管网检测 (Damkar) &rarr;</a></strong>
            <p>Kelas D/C/B/A 四级消防员法定配置(Kepmenaker 186/1999)、灭火器与消防栓管网第三方耐压检测与保险理赔合规。</p>
          </div>
          <div class="zh-law-card" style="background:#f0fdf4;border-color:#bbf7d0;">
            <strong style="font-size:15px;"><a href="/zh/k3-pertambangan/" style="color:#0A4A2E;text-decoration:none;">4. 能矿部矿山安全监管 (SMKP & POP/POM) &rarr;</a></strong>
            <p>红土镍矿/煤矿矿长(KTT)法定任命、现场主管POP/POM国家执照及能矿部专属矿山安全管理体系。</p>
          </div>
          <div class="zh-law-card" style="background:#f0fdf4;border-color:#bbf7d0;">
            <strong style="font-size:15px;"><a href="/zh/ahli-k3-umum/" style="color:#0A4A2E;text-decoration:none;">5. 注册安全官 (AK3U) 与 P2K3 设立指引 &rarr;</a></strong>
            <p>满100人强制设岗、企业安全生产委员会印尼劳工部官方备案与法定安全生产季报报送全流程。</p>
          </div>
          <div class="zh-law-card" style="background:#f0fdf4;border-color:#bbf7d0;">
            <strong style="font-size:15px;"><a href="/zh/sio-alat-berat/" style="color:#0A4A2E;text-decoration:none;">6. 特种设备 SIO 操作证与 SIA 检验全解 &rarr;</a></strong>
            <p>叉车、天车、流动吊、锅炉与压力容器的个人持证与机械设备合法开机准用年检双重合规。</p>
          </div>
          <div class="zh-law-card" style="background:#f0fdf4;border-color:#bbf7d0;">
            <strong style="font-size:15px;"><a href="/zh/smk3/" style="color:#0A4A2E;text-decoration:none;">7. SMK3 安全体系审核与金牌认证指南 &rarr;</a></strong>
            <p>PP 50/2012国家级法定安全体系、166项高级审核准则及大型央企/PLN/Pertamina招投标金牌门槛。</p>
          </div>
          <div class="zh-law-card" style="background:#f0fdf4;border-color:#bbf7d0;">
            <strong style="font-size:15px;"><a href="/zh/juru-las/" style="color:#0A4A2E;text-decoration:none;">8. 承压管道与结构特种焊工等级规范 &rarr;</a></strong>
            <p>印尼劳工部 Kelas 1、Kelas 2、Kelas 3 资质划分、X射线探伤抽检及承压特种焊接规范。</p>
          </div>
          <div class="zh-law-card" style="background:#f0fdf4;border-color:#bbf7d0;">
            <strong style="font-size:15px;"><a href="/zh/in-house-training/" style="color:#0A4A2E;text-decoration:none;">9. 偏远工区驻厂培训与双语考证方案 &rarr;</a></strong>
            <p>苏拉威西青山(IMIP)、德龙(VDNI)、纬达贝(IWIP)及矿山现场考官驻厂直考，省去高额差旅与停工损失。</p>
          </div>
        </div>
      </article>

    </main>

    <!-- RIGHT: STICKY CONTACT SIDEBAR -->
    <aside class="zh-sticky-sidebar">
      <div class="zh-sb-box">
        <div class="zh-sb-badge">
          <span>● 官方咨询通道 · 快速响应</span>
        </div>

        <h3 class="zh-sb-title">中资企业安全合规咨询</h3>
        <p class="zh-sb-desc">
          直接与华纳咨询团队对接。协助您核算企业法定持证缺口，量身定制驻厂培训与设备合规检验方案。
        </p>

        <a href="<?= $wa_url ?>" class="zh-sb-wa-btn" target="_blank" rel="noopener">
          <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
          <span>WhatsApp 在线沟通</span>
        </a>

        <div class="zh-sb-divider"></div>

        <div class="zh-sb-nav-title">合规指引与专题手册</div>
<ul class="zh-sb-nav-list">
          <li><a href="/zh/" class="active">&bull; 合规全景总纲 (主页)</a></li>
          <li><a href="/zh/factory-roadmap/">&bull; 从零建厂到投产路线图</a></li>
          <li><a href="/zh/checklist/">&bull; 中资企业安全合规自查清单</a></li>
          <li><a href="/zh/ahli-k3-umum/">&bull; 注册安全官 (AK3U) 与 P2K3</a></li>
          <li><a href="/zh/sio-alat-berat/">&bull; 特种设备操作证 (SIO/SIA)</a></li>
          <li><a href="/zh/kecelakaan-kerja/">&bull; 工伤事故处置与调查应对</a></li>
          <li><a href="/zh/k3-kimia/">&bull; 冶炼危化品 (K3 Kimia) 合规</a></li>
          <li><a href="/zh/k3-kebakaran/">&bull; 厂区消防与管网年检 (Damkar)</a></li>
          <li><a href="/zh/k3-pertambangan/">&bull; 矿山安全 KTT 与 POP/POM</a></li>
          <li><a href="/zh/smk3/">&bull; SMK3 安全体系金牌认证</a></li>
          <li><a href="/zh/juru-las/">&bull; 特种焊工 (Juru Las) 规范</a></li>
          <li><a href="/zh/in-house-training/">&bull; 偏远工区驻厂双语内训</a></li>
        </ul>

        <div class="zh-sb-divider"></div>

        <div class="zh-sb-info-row">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
          <div>
            <strong>印尼全境驻厂服务</strong>
            <div style="font-size:12px;color:#6b7280;">雅加达、苏拉威西、加里曼丹、苏门答腊等各大园区</div>
          </div>
        </div>

        <div class="zh-sb-info-row">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
          <div>
            <strong>官方真实可查执照</strong>
            <div style="font-size:12px;color:#6b7280;">印尼劳工部官方系统注册备案</div>
          </div>
        </div>

        <div class="zh-sb-info-row">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
          <div>
            <strong>正规税务与法务支持</strong>
            <div style="font-size:12px;color:#6b7280;">提供印尼正规增值税发票 (Faktur Pajak)</div>
          </div>
        </div>

      </div>
    </aside>

  </div>
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
        <strong>办公地址：</strong>Jl. Wonosari KM 8.5, Gandu, Sendangtirto, Berbah, Sleman, D.I. Yogyakarta 55573, Indonesia<br>
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
  <a href="<?= $wa_url ?>" class="zh-mb-btn" target="_blank" rel="noopener">
    <svg viewBox="0 0 24 24" fill="currentColor" width="15" height="15"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
    <span>在线咨询</span>
  </a>
</div>

<script>
function toggleZhFaq(btn) {
  var ans = btn.nextElementSibling;
  var isOpen = ans.classList.contains('open');
  // Close others
  document.querySelectorAll('.zh-faq-a').forEach(function(el) {
    el.classList.remove('open');
  });
  if (!isOpen) {
    ans.classList.add('open');
  }
}
</script>

</body>
</html>