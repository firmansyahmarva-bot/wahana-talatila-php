<?php
/**
 * Standard Header for Wahana Totalita Chinese Authority Cluster
 */
require_once __DIR__ . '/config.php';

$page_title = '印尼工厂消防安全(K3 Kebakaran)与管网检测实操指南 — Wahana Totalita';
$meta_desc = '厂区消防如何通过印尼劳工部与消防局验收？Kelas D/C/B/A消防员配置要求(Kepmenaker 186/1999)、灭火器与消防栓管网第三方检测(Riksa Uji Damkar)。';
$canonical = SITE_URL . '/zh/k3-kebakaran/';
$wa_url = 'https://wa.me/6287759151278?text=' . rawurlencode('您好，我们是在印尼的中资企业，想咨询工厂消防安全人员考证与管网检验事宜。');
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

<meta property="og:type" content="article">
<meta property="og:title" content="<?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:description" content="<?= htmlspecialchars($meta_desc, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:url" content="<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:site_name" content="Wahana Totalita Konsultan">
<meta property="og:locale" content="zh_CN">

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
      <a href="/zh/">中文合规首页</a> &gt; <span>工厂消防合规 (K3 Kebakaran)</span>
    </div>
    <span class="zh-hero-badge">消防验收与设施年检</span>
    <h1>在印尼投资办厂，工厂消防系统（K3 Kebakaran）法定配置与检验全解</h1>
    <p>
      厂房消防合规不仅是印尼劳工部（Kemnaker）与地方消防局（Dinas Pemadam Kebakaran）的联合监管核心，更是厂房取得建筑使用功能证书（SLF）以及购买工商业财产保险的强制前置条件。缺少消防合格批文，一旦起火保险公司将直接全额拒赔。
    </p>
    <div class="zh-hero-meta">
      <span>● 法定依据：Kepmenaker No. KEP.186/MEN/1999</span>
      <span>● 消防队伍：Kelas D / Kelas C / Kelas B / Kelas A</span>
      <span>● 设施检验：消防栓、灭火器、火灾报警与自动喷淋</span>
    </div>
  </div>
</section>

<div class="zh-container">
  <div class="zh-body-grid">
    <main>
      <article class="zh-card">
        <span class="zh-sec-badge">人员架构法规</span>
        <h2 class="zh-sec-title">一、印尼企业消防应急队伍的四级法定配置</h2>
        <p class="zh-text">
          依据《1999年第186号部长令》（Kepmenaker 186/1999），企业必须在内部建立分层次的兼职或专职消防应急组织，严禁在发生火灾时“全厂无人会操作专业消防栓系统”：
        </p>

        <div class="zh-table-wrap">
          <table class="zh-table">
            <thead>
              <tr>
                <th>人员等级</th>
                <th>法定职责与岗位定位</th>
                <th>强制配备比例门槛</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>Kelas D<br>(初级基层灭火员)</strong></td>
                <td>一线灭火器（APAR）快速扑救、初期火警疏散引导、火灾警报拉响与员工集结清点。</td>
                <td><strong>每 25 名员工至少配置 2 名</strong> 持证人员（高危场所按班组递增）。</td>
              </tr>
              <tr>
                <td><strong>Kelas C<br>(消防应急小队长)</strong></td>
                <td>负责操作厂区室外消火栓（Hydrant）、操纵消防水枪接力、组织排烟与隔断防火分区。</td>
                <td><strong>每个工作区域/车间至少配置 1 名</strong>，中大型工厂通常按车间配置。</td>
              </tr>
              <tr>
                <td><strong>Kelas B<br>(全厂消防统筹协调员)</strong></td>
                <td>负责编制全厂年度消防演习方案、联络政府消防大队、监督灭火器材月度点检台账。</td>
                <td>凡员工达 <strong>300 人以上或高危场所</strong>，必须配备至少 1 名持证人员。</td>
              </tr>
              <tr>
                <td><strong>Kelas A<br>(高级消防注册安全官)</strong></td>
                <td>全厂消防工程总监（Ahli K3 Kebakaran），全面负责火灾风险评估、图审验收与自动喷淋维护。</td>
                <td>超大型工厂、重化工及特大型冶炼综合体推荐专职配置。</td>
              </tr>
            </tbody>
          </table>
        </div>
      </article>

      <article class="zh-card">
        <span class="zh-sec-badge">设施检验规范</span>
        <h2 class="zh-sec-title">二、工厂消防设施法定检验合格证明 (Riksa Uji Damkar)</h2>
        <p class="zh-text">
          除了人员持证，厂区安装的所有被动与主动消防设施必须由具备劳工部资质的第三方（PJK3）定期进行物理耐压检验与功能核验，出具官方合格检验批文：
        </p>

        <div class="zh-law-grid">
          <div class="zh-law-card">
            <strong>1. 便携式手提灭火器 (APAR)</strong>
            <p>悬挂高度离地 1.2 米、无杂物遮挡。<strong>每年必须进行一次物理称重与药剂压力复验</strong>，干粉/二氧化碳/泡沫灭火器瓶身需加贴合格年检检验标贴。</p>
          </div>
          <div class="zh-law-card">
            <strong>2. 室内外消防栓管网系统 (Hydrant)</strong>
            <p>每 1~2 年开展水压试验（Hydrotest），核验消防管网静压与末端出水动压，确保主柴油消防泵能在断电时 30 秒内自动强启。</p>
          </div>
          <div class="zh-law-card">
            <strong>3. 火灾自动报警与喷淋系统 (Alarm & Sprinkler)</strong>
            <p>烟感/温感探头灵敏度测试、报警联动警铃音量测试，以及稳压水箱液位自动联锁保护功能检测。</p>
          </div>
        </div>
      </article>

      <article class="zh-card">
        <span class="zh-sec-badge">商业保险利益</span>
        <h2 class="zh-sec-title">三、为什么消防合规直接决定外资财产保险理赔成败？</h2>
        <div class="zh-alert-box">
          <strong>财产险免责陷阱风险提示：</strong>
          <p>
            几乎所有跨国商业保险公司（包括中资企业常投保的人保、太保在印尼的承保分公司或印尼本地保险公司）在签署商业财产一切险（Property All Risks）条款中，均列明了“合规保证条款（Warranty of Compliance）”。若厂区发生火灾，保险公司公估人进场首要调查的就是：消防管网是否取得政府检验合格证（SIA）？现场操作人员是否持证？如果缺失，保险公司有充分法律依据拒绝支付千万级巨额赔偿！
          </p>
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
        <a href="https://wa.me/6287759151278?text=%E6%82%A8%E5%A5%BD%EF%BC%8C%E6%88%91%E4%BB%AC%E6%98%AF%E5%9C%A8%E5%8D%B0%E5%B0%BC%E7%9A%84%E4%B8%AD%E8%B5%84%E4%BC%81%E4%B8%9A%EF%BC%8C%E6%83%B3%E5%92%A8%E8%AF%A2%E5%B7%A5%E5%8E%82%E6%B6%88%E9%98%B2%E5%AE%89%E5%85%A8%E4%BA%BA%E5%91%98%E8%80%83%E8%AF%81%E4%B8%8E%E7%AE%A1%E7%BD%91%E6%A3%80%E9%AA%8C%E4%BA%8B%E5%AE%9C%E3%80%82" class="zh-sb-wa-btn" target="_blank" rel="noopener">
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
          <li><a href="/zh/k3-kebakaran/" class="active">&bull; 厂区消防与管网年检 (Damkar)</a></li>
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
  <a href="https://wa.me/6287759151278?text=%E6%82%A8%E5%A5%BD%EF%BC%8C%E6%88%91%E4%BB%AC%E6%98%AF%E5%9C%A8%E5%8D%B0%E5%B0%BC%E7%9A%84%E4%B8%AD%E8%B5%84%E4%BC%81%E4%B8%9A%EF%BC%8C%E6%83%B3%E5%92%A8%E8%AF%A2%E5%B7%A5%E5%8E%82%E6%B6%88%E9%98%B2%E5%AE%89%E5%85%A8%E4%BA%BA%E5%91%98%E8%80%83%E8%AF%81%E4%B8%8E%E7%AE%A1%E7%BD%91%E6%A3%80%E9%AA%8C%E4%BA%8B%E5%AE%9C%E3%80%82" class="zh-mb-btn" target="_blank" rel="noopener">
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