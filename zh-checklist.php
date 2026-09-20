<?php
/**
 * Standard Header for Wahana Totalita Chinese Authority Cluster
 */
require_once __DIR__ . '/config.php';

$page_title = '在印尼中资企业安全生产(K3)合规自查排查清单 (Checklist) — Wahana Totalita';
$meta_desc = '高管与厂长可直接对照自查的印尼现场安全生产排查表格：涵盖法定持证人员(AK3U/SIO)、特种设备检验(SIA)、组织备案(P2K3)与应急四维体系。';
$canonical = SITE_URL . '/zh/checklist/';
$wa_url = 'https://wa.me/6287759151278?text=' . rawurlencode('您好，我们是在印尼的中资企业，已核对自查清单，想预约华纳专家进行现场合规差距诊断(Gap Analysis)。');
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
<meta name="keywords" content="印尼安全合规自查清单,印尼K3自检表,印尼工厂持证排查,印尼设备检验台账,印尼劳工部检查应对,Checklist K3">
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
                    "name": "安全生产法定合规自查排查清单",
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
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Noto+Sans+SC:wght@400;500;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= asset_v('/assets/css/page/zh.min.css') ?>">
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
      <a href="/zh/">中文合规首页</a> &gt; <span>安全合规自查排查清单 (Checklist)</span>
    </div>
    <span class="zh-hero-badge">管理层实操自测工具</span>
    <h1>中资企业在印尼工厂与项目现场《安全生产法定合规自查排查清单》</h1>
    <p>
      为方便赴印尼投资的中方董事长、总经理、总工程师及安全负责人迅速掌握现场合规现状，Wahana Totalita 依照印尼劳工监察局（Pengawas Ketenagakerjaan）现场稽查检查表，为您梳理出以下四大维度的核心自查打勾项。
    </p>
    <div class="zh-hero-meta">
      <span>● 四大维度：法定人员 · 特种设备 · 组织备案 · 应急体系</span>
      <span>● 适用对象：冶炼厂、矿山、电厂、建筑工地、制造工厂</span>
    </div>
  </div>
</section>

<div class="zh-container">
  <div class="zh-body-grid">
    <main>
      <article class="zh-card">
        <span class="zh-sec-badge">模块一：法定人员配置自查</span>
        <h2 class="zh-sec-title">1. 法定关键安全岗位与人员持证排查 (Personnel Audit)</h2>
        <div class="zh-table-wrap">
          <table class="zh-table">
            <thead>
              <tr>
                <th style="width:40px;">序号</th>
                <th>排查项目内容</th>
                <th>印尼官方对应证件名称</th>
                <th>现状自检</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1.1</td>
                <td>员工满100人或高危场所，是否配备专职注册安全官？</td>
                <td>Ahli K3 Umum (SKP 劳工部正式任职书)</td>
                <td><input type="checkbox"> 已持有效正本</td>
              </tr>
              <tr>
                <td>1.2</td>
                <td>叉车司机、装载机司机是否持有效操作证？</td>
                <td>SIO Forklift (Surat Izin Operator)</td>
                <td><input type="checkbox"> 全部持证上岗</td>
              </tr>
              <tr>
                <td>1.3</td>
                <td>天车(行车)、龙门吊、汽车吊司机是否持有效操作证？</td>
                <td>SIO Crane (Kelas I / II / III)</td>
                <td><input type="checkbox"> 全部持证上岗</td>
              </tr>
              <tr>
                <td>1.4</td>
                <td>承压管道与结构特种焊工是否持有印尼劳工部焊工证？</td>
                <td>Sertifikat Juru Las (Kelas 1 / 2 / 3)</td>
                <td><input type="checkbox"> 证件在5年有效期内</td>
              </tr>
              <tr>
                <td>1.5</td>
                <td>锅炉司炉工与压力容器操作人员是否持证？</td>
                <td>SIO Boiler (Kelas 1 / 2)</td>
                <td><input type="checkbox"> 已经过官方考证</td>
              </tr>
              <tr>
                <td>1.6</td>
                <td>离地2米以上高处作业工人是否持有印尼高空作业证书？</td>
                <td>TKBT (Tenaga Kerja Bangunan Tinggi)</td>
                <td><input type="checkbox"> 符合Permenaker 09/2016</td>
              </tr>
            </tbody>
          </table>
        </div>
      </article>

      <article class="zh-card">
        <span class="zh-sec-badge">模块二：特种设备合法牌照</span>
        <h2 class="zh-sec-title">2. 机械设备与压力管道法定检验合格证排查 (Machinery SIA)</h2>
        <div class="zh-table-wrap">
          <table class="zh-table">
            <thead>
              <tr>
                <th style="width:40px;">序号</th>
                <th>排查设备种类</th>
                <th>法定准用证明</th>
                <th>检测复检周期</th>
                <th>现状自检</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>2.1</td>
                <td>厂区所有叉车、装载机、挖掘机</td>
                <td>SIA / Buku Pengesahan</td>
                <td>每 1 年定期复验</td>
                <td><input type="checkbox"> 有效期内</td>
              </tr>
              <tr>
                <td>2.2</td>
                <td>厂区行车 (Overhead Crane)、流动吊</td>
                <td>SIA (Surat Izin Alat)</td>
                <td>每 1~2 年定期复检</td>
                <td><input type="checkbox"> 有效期内</td>
              </tr>
              <tr>
                <td>2.3</td>
                <td>生产蒸汽锅炉、导热油炉</td>
                <td>SIA Boiler</td>
                <td>每 1 年强制水压内检</td>
                <td><input type="checkbox"> 有效期内</td>
              </tr>
              <tr>
                <td>2.4</td>
                <td>空气压缩机、储气罐、氮气罐</td>
                <td>SIA Bejana Tekan</td>
                <td>每 2 年复检 / 5年耐压</td>
                <td><input type="checkbox"> 有效期内</td>
              </tr>
              <tr>
                <td>2.5</td>
                <td>厂房防雷接地与主配电房接地系统</td>
                <td>Sertifikat Instalasi Petir</td>
                <td>每 1~2 年测地阻 (&lt;5欧姆)</td>
                <td><input type="checkbox"> 有效期内</td>
              </tr>
            </tbody>
          </table>
        </div>
      </article>

      <article class="zh-card">
        <span class="zh-sec-badge">模块三：机构组织与日常报备</span>
        <h2 class="zh-sec-title">3. 法定安全组织与行政批文排查 (Organization & Reporting)</h2>
        <div class="zh-table-wrap">
          <table class="zh-table">
            <thead>
              <tr>
                <th style="width:40px;">序号</th>
                <th>法定机构/报告要求</th>
                <th>主管审核机构</th>
                <th>现状自检</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>3.1</td>
                <td>企业是否成立安全生产委员会并取得官方红头批文？</td>
                <td>SK Pengesahan P2K3 (省/市劳工厅批复)</td>
                <td><input type="checkbox"> 批复函已归档</td>
              </tr>
              <tr>
                <td>3.2</td>
                <td>是否按季度向劳动监察局报送法定安全生产季度报告？</td>
                <td>Laporan Triwulan P2K3 (需盖劳工局回执章)</td>
                <td><input type="checkbox"> 连续报备无中断</td>
              </tr>
              <tr>
                <td>3.3</td>
                <td>全体中印籍员工是否 100% 参保印尼工伤医疗社保？</td>
                <td>BPJS Ketenagakerjaan (JKK / JKM / JHT)</td>
                <td><input type="checkbox"> 无脱保漏保</td>
              </tr>
            </tbody>
          </table>
        </div>
      </article>

      <article class="zh-card" style="border-color:#bbf7d0;background:#fcfdfc;">
        <span class="zh-sec-badge">快速闭环整改服务</span>
        <h2 class="zh-sec-title">自查发现有未勾选的合规盲区？华纳为您提供全链条补全服务</h2>
        <p class="zh-text">
          如果您的工厂在上述自查中有任何 1~2 项存在空白或证件逾期，说明企业现场已暴露在印尼劳工监察局随时突击查封与顶格行政罚款的法律风险之下。
        </p>
        <p class="zh-text">
          <strong>Wahana Totalita（PT Wahana Totalita Konsultan）</strong> 可为您提供全流程委托服务：从派遣工程师入厂进行设备法定物理检验（Riksa Uji）、到现场组织叉车/天车/安全官考证直考，协助编写规章并代办 P2K3 委员会官方报备，让企业用最快时间实现合规清零。
        </p>
        <div style="margin-top:20px;">
          <a href="<?= $wa_url ?>" class="zh-sb-wa-btn" style="display:inline-flex;max-width:320px;" target="_blank" rel="noopener">
            <span>联系华纳专家获取定制整改方案 &rarr;</span>
          </a>
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
        <a href="https://wa.me/6287759151278?text=%E6%82%A8%E5%A5%BD%EF%BC%8C%E6%88%91%E4%BB%AC%E6%98%AF%E5%9C%A8%E5%8D%B0%E5%B0%BC%E7%9A%84%E4%B8%AD%E8%B5%84%E4%BC%81%E4%B8%9A%EF%BC%8C%E5%B7%B2%E6%A0%B8%E5%AF%B9%E8%87%AA%E6%9F%A5%E6%B8%85%E5%8D%95%EF%BC%8C%E6%83%B3%E9%A2%84%E7%BA%A6%E5%8D%8E%E7%BA%B3%E4%B8%93%E5%AE%B6%E8%BF%9B%E8%A1%8C%E7%8E%B0%E5%9C%BA%E5%90%88%E8%A7%84%E5%B7%AE%E8%B7%9D%E8%AF%8A%E6%96%AD%28Gap%20Analysis%29%E3%80%82" class="zh-sb-wa-btn" target="_blank" rel="noopener">
          <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
          <span>WhatsApp 商务咨询</span>
        </a>

        <div class="zh-sb-nav-title">合规指引与专题手册</div>
        <ul class="zh-sb-nav-list">
          <li><a href="/zh/">&bull; 合规全景总纲 (主页)</a></li>
          <li><a href="/zh/factory-roadmap/">&bull; 从零建厂到投产路线图</a></li>
          <li><a href="/zh/checklist/" class="active">&bull; 中资企业安全合规自查清单</a></li>
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
  <a href="https://wa.me/6287759151278?text=%E6%82%A8%E5%A5%BD%EF%BC%8C%E6%88%91%E4%BB%AC%E6%98%AF%E5%9C%A8%E5%8D%B0%E5%B0%BC%E7%9A%84%E4%B8%AD%E8%B5%84%E4%BC%81%E4%B8%9A%EF%BC%8C%E5%B7%B2%E6%A0%B8%E5%AF%B9%E8%87%AA%E6%9F%A5%E6%B8%85%E5%8D%95%EF%BC%8C%E6%83%B3%E9%A2%84%E7%BA%A6%E5%8D%8E%E7%BA%B3%E4%B8%93%E5%AE%B6%E8%BF%9B%E8%A1%8C%E7%8E%B0%E5%9C%BA%E5%90%88%E8%A7%84%E5%B7%AE%E8%B7%9D%E8%AF%8A%E6%96%AD%28Gap%20Analysis%29%E3%80%82" class="zh-mb-btn" target="_blank" rel="noopener">
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