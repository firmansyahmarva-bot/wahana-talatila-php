<?php
/**
 * zh-factory.php — 从零建厂到合法投产：在印尼办厂安全合规全流程实操指南
 * A complete, one-page chronological roadmap for Chinese investors & factory managers in Indonesia.
 */
require_once __DIR__ . '/config.php';

$page_title = '从零建厂到合法投产：在印尼中资工厂安全生产(K3)全流程实操指南 — Wahana Totalita';
$meta_desc = '一文理清在印尼投资建厂从规划、设备进口、土建施工、设备第三方年检(Riksa Uji)、人员考证(AK3U/SIO)到合法投产运营的完整安全合规路线图。';
$canonical = SITE_URL . '/zh/factory-roadmap/';
$wa_url = 'https://wa.me/6287759151278?text=' . rawurlencode('您好，我们是在印尼筹建/运营工厂的中资企业，想咨询建厂投产全流程的安全生产合规服务。');
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

<!-- Open Graph -->
<meta property="og:type" content="article">
<meta property="og:title" content="<?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:description" content="<?= htmlspecialchars($meta_desc, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:url" content="<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:site_name" content="Wahana Totalita Konsultan">
<meta property="og:locale" content="zh_CN">

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
  font-weight: 700;
  color: var(--hub-primary);
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 4px;
}
.zh-nav-back:hover { text-decoration: underline; }
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
.zh-nav-contact:hover { background: var(--hub-primary-light); }

.zh-hero {
  background: linear-gradient(145deg, #0A4A2E 0%, #06321f 100%);
  color: #ffffff;
  padding: 50px 0 44px;
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
  margin-bottom: 14px;
}
.zh-breadcrumb a {
  color: rgba(255,255,255,0.9);
  text-decoration: none;
}
.zh-breadcrumb a:hover { text-decoration: underline; }
.zh-hero-pill {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: rgba(255,255,255,0.12);
  border: 1px solid rgba(255,255,255,0.22);
  color: #a7f3d0;
  padding: 4px 12px;
  border-radius: 999px;
  font-size: 12.5px;
  font-weight: 700;
  margin-bottom: 14px;
}
.zh-hero h1 {
  font-size: clamp(1.8rem, 4vw, 2.6rem);
  font-weight: 800;
  line-height: 1.3;
  margin: 0 0 14px;
}
.zh-hero-lead {
  font-size: clamp(14.5px, 1.6vw, 16.5px);
  color: rgba(255,255,255,0.9);
  max-width: 900px;
  line-height: 1.8;
  margin: 0;
}

.zh-body-grid {
  display: grid;
  grid-template-columns: 1fr 340px;
  gap: 36px;
  padding: 45px 0 70px;
}
@media (max-width: 991px) {
  .zh-body-grid { grid-template-columns: 1fr; gap: 30px; }
}

/* Timeline Flow Cards */
.zh-timeline-card {
  background: #ffffff;
  border: 1px solid var(--hub-border);
  border-radius: 14px;
  padding: 30px;
  margin-bottom: 30px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.03);
  position: relative;
}
.zh-step-num {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: #e8f4ee;
  color: var(--hub-primary);
  font-size: 13px;
  font-weight: 800;
  padding: 4px 12px;
  border-radius: 6px;
  text-transform: uppercase;
  margin-bottom: 12px;
}
.zh-step-title {
  font-size: 1.45rem;
  font-weight: 800;
  color: var(--hub-dark);
  margin: 0 0 12px;
}
.zh-step-time {
  font-size: 13px;
  color: var(--hub-accent);
  font-weight: 700;
  margin-bottom: 16px;
  display: flex;
  align-items: center;
  gap: 6px;
}

.zh-text {
  font-size: 15px;
  color: #374151;
  line-height: 1.85;
  margin: 0 0 16px;
}

.zh-todo-box {
  background: #f8fafc;
  border: 1.5px solid #e2e8f0;
  border-radius: 10px;
  padding: 20px;
  margin: 18px 0;
}
.zh-todo-box h4 {
  font-size: 14.5px;
  color: var(--hub-dark);
  margin: 0 0 10px;
  font-weight: 800;
}
.zh-todo-list {
  list-style: none;
  padding: 0;
  margin: 0;
}
.zh-todo-list li {
  position: relative;
  padding-left: 24px;
  font-size: 14px;
  color: #374151;
  margin-bottom: 8px;
  line-height: 1.65;
}
.zh-todo-list li::before {
  content: "✔";
  position: absolute;
  left: 0;
  color: var(--hub-primary);
  font-weight: 800;
  font-size: 13px;
}

.zh-pitfall-box {
  background: #fff7ed;
  border-left: 4px solid #ea580c;
  border-radius: 8px;
  padding: 14px 18px;
  margin-top: 14px;
}
.zh-pitfall-box strong {
  display: block;
  font-size: 14px;
  color: #9a3412;
  margin-bottom: 4px;
}
.zh-pitfall-box p {
  font-size: 13px;
  color: #7c2d12;
  margin: 0;
  line-height: 1.6;
}

.zh-table-wrap {
  overflow-x: auto;
  margin: 20px 0;
  border-radius: 10px;
  border: 1px solid #e5e7eb;
}
.zh-table {
  width: 100%;
  border-collapse: collapse;
  text-align: left;
  font-size: 13.5px;
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
.zh-table tr:last-child td { border-bottom: none; }
.zh-tag-must {
  background: #fef2f2;
  color: #dc2626;
  font-size: 11.5px;
  font-weight: 700;
  padding: 2px 7px;
  border-radius: 4px;
  display: inline-block;
}

.zh-sticky-sidebar { position: relative; }
.zh-sb-box {
  position: sticky;
  top: 86px;
  background: #ffffff;
  border: 1.5px solid #d1fae5;
  border-radius: 14px;
  padding: 24px 20px;
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
}
.zh-sb-desc {
  font-size: 13px;
  color: #6b7280;
  margin: 0 0 16px;
  line-height: 1.6;
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
  font-size: 14px;
  font-weight: 700;
  padding: 12px 16px;
  border-radius: 8px;
  box-sizing: border-box;
  box-shadow: 0 4px 12px rgba(37,211,102,0.25);
  transition: transform .2s, background .2s;
}
.zh-sb-wa-btn:hover { background: #20ba5a; transform: translateY(-2px); }
.zh-sb-nav-title {
  font-size: 13px;
  font-weight: 800;
  color: var(--hub-dark);
  text-transform: uppercase;
  letter-spacing: 0.04em;
  margin: 18px 0 8px;
}
.zh-sb-nav-list {
  list-style: none;
  padding: 0;
  margin: 0;
}
.zh-sb-nav-list li { margin-bottom: 6px; }
.zh-sb-nav-list a {
  font-size: 13px;
  color: var(--hub-primary);
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 6px;
  line-height: 1.45;
  padding: 5px 8px;
  border-radius: 6px;
  transition: background .15s;
}
.zh-sb-nav-list a:hover { background: #f1f5f9; }
.zh-sb-nav-list a.active { background: #e8f4ee; color: var(--hub-primary); font-weight: 700; }

.zh-footer {
  background: #111827;
  color: #9ca3af;
  padding: 44px 0 28px;
  font-size: 13px;
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
  padding-bottom: 26px;
  margin-bottom: 20px;
}
@media (max-width: 768px) {
  .zh-footer-inner { grid-template-columns: 1fr; gap: 20px; }
}
.zh-footer h4 { color: #ffffff; font-size: 14.5px; font-weight: 700; margin: 0 0 10px; }
.zh-footer p { margin: 0 0 8px; }
.zh-footer-bottom {
  max-width: 1180px;
  margin: 0 auto;
  padding: 0 20px;
  font-size: 12px;
  color: #6b7280;
  text-align: center;
}

.zh-mobile-bar {
  display: none;
  position: fixed;
  bottom: 0; left: 0; right: 0;
  background: #ffffff;
  border-top: 1px solid var(--hub-border);
  padding: 10px 16px;
  z-index: 999;
  box-shadow: 0 -4px 16px rgba(0,0,0,0.08);
}
@media (max-width: 991px) {
  .zh-mobile-bar { display: flex; align-items: center; justify-content: space-between; gap: 12px; }
}
.zh-mb-text { font-size: 13px; font-weight: 700; color: var(--hub-dark); line-height: 1.3; }
.zh-mb-sub { font-size: 11.5px; color: #6b7280; }
.zh-mb-btn {
  display: inline-flex; align-items: center; gap: 6px;
  background: #25D366; color: #ffffff; font-size: 13.5px; font-weight: 700;
  padding: 8px 15px; border-radius: 8px; text-decoration: none; white-space: nowrap;
}
</style>
</head>
<body>

<!-- NAVIGATION -->
<header class="zh-nav">
  <div class="zh-nav-inner">
    <a href="/zh/" class="zh-logo">
      <img src="/assets/img/logo-light.svg" alt="Wahana Totalita Konsultan" width="160" height="38">
      <span class="zh-lang-badge">专题专栏</span>
    </a>
    <div class="zh-nav-links">
      <a href="/zh/" class="zh-nav-back">&larr; 返回合规总纲</a>
      <a href="<?= $wa_url ?>" class="zh-nav-contact" target="_blank" rel="noopener">建厂全流程合规咨询</a>
    </div>
  </div>
</header>

<!-- HERO SECTION -->
<section class="zh-hero">
  <div class="zh-container">
    <div class="zh-breadcrumb">
      <a href="/zh/">首页</a> &rsaquo; <a href="/zh/">印尼安全生产合规专栏</a> &rsaquo; <span>从零建厂到投产全流程实操指南</span>
    </div>

    <div class="zh-hero-pill">
      <span>一页看懂印尼建厂全流程 · 决策者合规操作图谱</span>
    </div>

    <h1>从零建厂到合法投产：在印尼办厂安全合规全流程实操指南</h1>
    <p class="zh-hero-lead">
      专为中资投资人、厂长、项目总指挥打造的实操时间轴。全面拆解从项目立项、土建安装、设备清关、第三方安全检验（Riksa Uji）、法定人员持证到正式点火开工的 5 个关键里程碑。
    </p>
  </div>
</section>

<!-- MAIN CONTENT + SIDEBAR -->
<div class="zh-container">
  <div class="zh-body-grid">
    <main>

      <!-- INTRO PROSE -->
      <article class="zh-timeline-card" style="border-left:5px solid var(--hub-primary);">
        <h2 style="font-size:1.35rem;font-weight:800;color:var(--hub-dark);margin:0 0 10px;">为什么中资企业在印尼投产前必须前置做好安全规划？</h2>
        <p class="zh-text">
          在印尼投资建厂，许多企业常把精力集中在土地购买、厂房土建与机器安装上，往往等到<strong>厂房建好、机器通电准备点火试产</strong>时，才遭遇印尼劳工监察部门（Pengawas Ketenagakerjaan）的突击检查。
        </p>
        <p class="zh-text">
          此时若发现：特种设备没有政府年检绿标（SIA）、现场作业人员没有印尼特种操作证（SIO）、未依法成立安全委员会（P2K3），企业将被当场签发《停工整顿通知书》，导致重资产沉淀却无法开工，产生每天高达数万美元的停机损失。
        </p>
        <p class="zh-text" style="font-weight:700;color:var(--hub-primary);margin-bottom:0;">
          按照以下 5 个阶段提前规划，让您的项目在合法合规的前提下平稳、准时点火投产：
        </p>
      </article>

      <!-- PHASE 1: 筹备与设计阶段 -->
      <article class="zh-timeline-card">
        <span class="zh-step-num">阶段一</span>
        <div class="zh-step-time">⏱ 时间节点：项目立项后 &bull; 土建开工前 2~4 个月</div>
        <h3 class="zh-step-title">规划设计与前置法务手续 (Pre-Construction)</h3>
        <p class="zh-text">
          在动工前，厂区图纸除了通过公共工程与住房部（PUPR）的建筑许可（PBG，旧称 IMB）审查外，还必须完成特定 K3 专项设计的合规前置审批：
        </p>

        <div class="zh-todo-box">
          <h4>本阶段必须完成的法定要件清单：</h4>
          <ul class="zh-todo-list">
            <li><strong>防雷接地系统方案审批：</strong> 依据 Permenaker 02/1989，厂房防雷带与接地电阻方案必须经具有资质的专业机构验算设计，接地电阻值不得大于 5 欧姆（&le;5&Omega;）。</li>
            <li><strong>厂区消火栓与消防管网设计图审：</strong> 依据 Kepmenaker 186/1999，消防泵房负荷、水池容量与管网走向需报备审核。</li>
            <li><strong>环境许可：</strong> 编制完成 AMDAL（环评）或 UKL-UPL（环境管理监测预案），取得环保批文。</li>
            <li><strong>社保开户：</strong> 在印尼国家劳工社会保障局（BPJS Ketenagakerjaan）完成企业账户设立。</li>
          </ul>
        </div>

        <div class="zh-pitfall-box">
          <strong>阶段一常见踩坑点：</strong>
          <p>很多设计院套用中国标准设计防雷接地，但印尼热带雷暴频发，雷击事故极多，若未按印尼规程做接地探伤与报备，厂房落成后将无法通过政府消防与电气专项联合验收。</p>
        </div>
      </article>

      <!-- PHASE 2: 土建与设备安装施工阶段 -->
      <article class="zh-timeline-card">
        <span class="zh-step-num">阶段二</span>
        <div class="zh-step-time">⏱ 时间节点：土建施工 &bull; 设备机电安装阶段 (6~18个月)</div>
        <h3 class="zh-step-title">施工现场特种作业合规管控 (Construction &amp; Erection)</h3>
        <p class="zh-text">
          现场钢结构吊装、管道铺设及厂房搭建过程中，是印尼政府安全执法巡查频次最高的敏感时期：
        </p>

        <div class="zh-todo-box">
          <h4>本阶段必须落地的现场管控：</h4>
          <ul class="zh-todo-list">
            <li><strong>总包与分包资质准入 (CSMS)：</strong> 审核入场土建及安装承包商的安全资质，严禁使用“草台班子”无资质施工。</li>
            <li><strong>吊装特种操作持证：</strong> 现场使用的汽车吊（Mobile Crane）、履带吊必须持有有效准用证，司机必须持有印尼劳工部颁发的 SIO 操作证。</li>
            <li><strong>特种高空作业防护 (TKBT)：</strong> 钢构安装人员、脚手架工人必须持有高空作业证，脚手架必须由持证架子工（Teknisi Perancah）验收合格挂绿牌（Green Tag）。</li>
            <li><strong>动火作业审批 (Hot Work Permit)：</strong> 焊接作业现场必须配备经培训合格的专职看火人（Fire Watcher），配备有效灭火器。</li>
          </ul>
        </div>

        <div class="zh-pitfall-box">
          <strong>阶段二常见踩坑点：</strong>
          <p>现场发生高坠或吊装砸死工人事故，不仅项目面临停工 1~3 个月，总包及业主方中方高管往往会被印尼警方带走协助调查，直接延误项目交期。</p>
        </div>
      </article>

      <!-- PHASE 3: 机械设备进口与第三方安全检验 (RIUSA UJI) -->
      <article class="zh-timeline-card">
        <span class="zh-step-num">阶段三</span>
        <div class="zh-step-time">⏱ 时间节点：设备就位完成 &bull; 试车前 1~2 个月</div>
        <h3 class="zh-step-title">从中国进口设备的法定安全检验 (Riksa Uji / SIA)</h3>
        <p class="zh-text">
          大量中资企业从国内订购的特种机械设备（锅炉、空压机、天车、储罐、叉车），<strong>在印尼现场绝对不能直接通电通水通汽点火</strong>：
        </p>

        <div class="zh-todo-box">
          <h4>法定设备检验 (Riksa Uji) 流程：</h4>
          <ul class="zh-todo-list">
            <li><strong>委托法定检测机构 (PJK3 Riksa Uji)：</strong> 聘请印尼劳工部授权的第三方检验检测机构工程师进入现场。</li>
            <li><strong>静态探伤与壁厚测试：</strong> 对压力容器和管道进行超声波测厚、探伤及焊缝无损检测。</li>
            <li><strong>超压水压与负荷安全测试：</strong> 锅炉及管道进行水压试验，起重行车进行 1.25 倍额定负荷动静测试，安全阀现场打压铅封。</li>
            <li><strong>申领准用牌照：</strong> 取得印尼劳工部正式颁发的《设备准用证明》（Surat Keterangan K3）与绿底防伪合格金属标牌。</li>
          </ul>
        </div>

        <div class="zh-pitfall-box">
          <strong>阶段三常见踩坑点：</strong>
          <p>国内设备的制造铭牌通常全为中文，没有英文或印尼文参数。提前准备好出厂合格证（Mill Certificate）、材质单及外文图纸，否则劳工部检测师无法核算安全载荷，会直接拒绝出具检验报告。</p>
        </div>
      </article>

      <!-- PHASE 4: 运营人员法定考证与 P2K3 成立 -->
      <article class="zh-timeline-card">
        <span class="zh-step-num">阶段四</span>
        <div class="zh-step-time">⏱ 时间节点：试运行前 1 个月 &bull; 正式投产前</div>
        <h3 class="zh-step-title">人员法定持证上岗与安全委员会 (P2K3) 报备</h3>
        <p class="zh-text">
          机器准备好了，操作这批设备的印尼籍员工必须完成官方执业资格认证：
        </p>

        <div class="zh-todo-box">
          <h4>本阶段人员组织设立清单：</h4>
          <ul class="zh-todo-list">
            <li><strong>培养注册安全官 (Ahli K3 Umum)：</strong> 选拔大专/本科印尼籍员工完成 12 天法定培训，取得劳工部正式 SKP 任命书。</li>
            <li><strong>特种作业工人批量考证 (SIO)：</strong> 仓储叉车司机、车间行车司机、焊工、锅炉工全部取得劳工部 SIO 个人执照。</li>
            <li><strong>成立企业安全生产委员会 (P2K3)：</strong> 企业法人签署决议书，由总厂长担任主席，AK3U 担任秘书，报送地方劳工局获得官方批复印章。</li>
            <li><strong>厂区双语安全警示标志设置：</strong> 厂区按印尼国家标准（SNI）张贴印尼语为主、中文为辅的双语警示牌、职业危害告知牌与应急撤离路线图。</li>
          </ul>
        </div>
      </article>

      <!-- PHASE 5: 正式商业投产与日常法定合规运维 -->
      <article class="zh-timeline-card">
        <span class="zh-step-num">阶段五</span>
        <div class="zh-step-time">⏱ 时间节点：正式商业投产后 &bull; 长期日常运营</div>
        <h3 class="zh-step-title">日常法定合规运维与 SMK3 国家金牌认证</h3>
        <p class="zh-text">
          工厂正式开工后，合规工作转为常态化运营与长效制度防守：
        </p>

        <div class="zh-todo-box">
          <h4>投产后的四大法定日常动作：</h4>
          <ul class="zh-todo-list">
            <li><strong>法定安全季报报送 (Laporan Triwulan P2K3)：</strong> 每 3 个月由 P2K3 秘书编制季报，经厂长签字后报送省劳工厅盖章归档。</li>
            <li><strong>设备定期年检 (Riksa Uji Berkala)：</strong> 特种设备准用证根据类型每 1~2 年到期，必须提前 1 个月安排复检换发新证。</li>
            <li><strong>全员年度职业健康体检 (MCU)：</strong> 针对接触粉尘、高温、噪声及化学毒物的员工，每年组织法定职业健康体检并建档。</li>
            <li><strong>冲刺 SMK3 国家金牌认证 (PP 50/2012)：</strong> 投产稳定后，启动 166 项准则 SMK3 审核辅导，拿下金旗（Bendera Emas），为在印尼承接央企分包、政府招标及大型矿区供应扫清准入门槛。</li>
          </ul>
        </div>
      </article>

      <!-- COMPLETE ROADMAP TABLE -->
      <article class="zh-timeline-card" style="background:#fcfdfc;border-color:#bbf7d0;">
        <h2 style="font-size:1.35rem;font-weight:800;color:var(--hub-dark);margin:0 0 10px;">五大里程碑一览对照表 (建议保存对照)</h2>
        <div class="zh-table-wrap">
          <table class="zh-table">
            <thead>
              <tr>
                <th>阶段</th>
                <th>核心监管部门</th>
                <th>法定交付批文/证件</th>
                <th>违规跳过风险</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>1. 规划设计</strong></td>
                <td>PUPR / 劳工部 / 环保局</td>
                <td>PBG建筑许可、AMDAL环评、防雷接地核准</td>
                <td>厂房落成无法通过政府消防验收</td>
              </tr>
              <tr>
                <td><strong>2. 土建施工</strong></td>
                <td>省劳动监察局</td>
                <td>临时起重SIO、高空TKBT作业许可</td>
                <td>重大死伤事故高发，面临封场停工</td>
              </tr>
              <tr>
                <td><strong>3. 设备检测</strong></td>
                <td>劳工部授权 PJK3</td>
                <td>设备准用合格证明 (SIA / Riksa Uji)</td>
                <td><span class="zh-tag-must">擅自开机当场查封断电</span></td>
              </tr>
              <tr>
                <td><strong>4. 人员发证</strong></td>
                <td>Kemnaker 劳工部</td>
                <td>AK3U安全官任职书、P2K3成立批复、员工SIO</td>
                <td><span class="zh-tag-must">非法无证作业，顶格罚款</span></td>
              </tr>
              <tr>
                <td><strong>5. 投产运维</strong></td>
                <td>省劳工厅 / Lembaga Audit</td>
                <td>P2K3法定安全季报、SMK3国家金牌认证</td>
                <td>丧失政府大型工程投标与供应商准入</td>
              </tr>
            </tbody>
          </table>
        </div>
      </article>

    </main>

    <!-- RIGHT: STICKY CONTACT SIDEBAR -->
    <aside class="zh-sticky-sidebar">
      <div class="zh-sb-box">
        <div class="zh-sb-badge">
          <span>● 官方全流程支持 · 一站式托管</span>
        </div>

        <h3 class="zh-sb-title">印尼建厂安全合规咨询</h3>
        <p class="zh-sb-desc">
          为在印尼投资建厂的中资企业提供从规划图审、设备现场检测（Riksa Uji）、特种作业考证到 SMK3 认证的一站式解决方案。
        </p>

        <a href="<?= $wa_url ?>" class="zh-sb-wa-btn" target="_blank" rel="noopener">
          <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
          <span>WhatsApp 商务咨询</span>
        </a>

        <div class="zh-sb-nav-title">合规指引与专题手册</div>
        <ul class="zh-sb-nav-list">
          <li><a href="/zh/">&bull; 合规全景总纲 (主页)</a></li>
          <li><a href="/zh/factory-roadmap/" class="active">&bull; 从零建厂到投产路线图</a></li>
          <li><a href="/zh/ahli-k3-umum/">&bull; 注册安全官 (AK3U) 与 P2K3</a></li>
          <li><a href="/zh/sio-alat-berat/">&bull; 特种设备操作证 (SIO/SIA)</a></li>
          <li><a href="/zh/smk3/">&bull; SMK3 安全体系金牌认证</a></li>
          <li><a href="/zh/juru-las/">&bull; 特种焊工 (Juru Las) 等级规范</a></li>
          <li><a href="/zh/in-house-training/">&bull; 偏远工区驻厂双语内训</a></li>
        </ul>
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
  <a href="<?= $wa_url ?>" class="zh-mb-btn" target="_blank" rel="noopener">
    <svg viewBox="0 0 24 24" fill="currentColor" width="15" height="15"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
    <span>在线咨询</span>
  </a>
</div>

</body>
</html>