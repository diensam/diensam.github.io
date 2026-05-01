<?php
require_once 'includes/config.php';
$gg = getGanjilGenap();
$gg_class = $gg['status'] === 'bebas' ? 'bebas' : ($gg['is_ganjil'] ? 'ganjil' : 'genap');
$hari_ini = date('l, d F Y');
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<title><?= APP_NAME ?> — Panduan Lengkap Driver Jabodetabek</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<style>
/* ============ RESET & VARS ============ */
:root {
  --bg: #0c0c10;
  --surface: #18181f;
  --surface2: #21212a;
  --surface3: #2a2a36;
  --border: #2e2e3e;
  --border2: #3a3a4e;
  --accent: #f59e0b;
  --accent-dim: rgba(245,158,11,0.12);
  --accent2: #38bdf8;
  --accent2-dim: rgba(56,189,248,0.1);
  --green: #34d399;
  --green-dim: rgba(52,211,153,0.12);
  --red: #f87171;
  --red-dim: rgba(248,113,113,0.12);
  --yellow: #fbbf24;
  --yellow-dim: rgba(251,191,36,0.12);
  --text: #e2e2ee;
  --text2: #9090aa;
  --text3: #5a5a72;
  --font: 'Plus Jakarta Sans', sans-serif;
  --mono: 'JetBrains Mono', monospace;
  --radius: 14px;
  --radius-sm: 10px;
  --shadow: 0 4px 24px rgba(0,0,0,0.4);
}
* { box-sizing: border-box; margin: 0; padding: 0; -webkit-tap-highlight-color: transparent; }
html, body { height: 100%; }
body {
  background: var(--bg);
  color: var(--text);
  font-family: var(--font);
  overflow-x: hidden;
  overscroll-behavior: none;
}

/* ============ HEADER ============ */
.app-header {
  position: fixed; top: 0; left: 0; right: 0; z-index: 500;
  background: rgba(12,12,16,0.9);
  backdrop-filter: blur(16px) saturate(180%);
  border-bottom: 1px solid var(--border);
  height: 58px;
  display: flex; align-items: center; padding: 0 16px;
  gap: 12px;
}
.app-logo {
  font-size: 22px; font-weight: 800; letter-spacing: -0.8px;
  color: var(--accent); flex-shrink: 0;
}
.app-logo span { color: var(--text); font-weight: 400; }
.header-gg {
  display: flex; align-items: center; gap: 6px;
  background: var(--surface2); border: 1px solid var(--border);
  border-radius: 20px; padding: 4px 10px; margin-left: auto;
}
.header-gg-dot { width: 7px; height: 7px; border-radius: 50%; }
.header-gg-dot.ganjil { background: var(--accent); box-shadow: 0 0 6px var(--accent); }
.header-gg-dot.genap { background: var(--accent2); box-shadow: 0 0 6px var(--accent2); }
.header-gg-dot.bebas { background: var(--green); box-shadow: 0 0 6px var(--green); }
.header-gg-text { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
.header-clock { font-family: var(--mono); font-size: 13px; color: var(--text2); font-weight: 500; }

/* ============ LAYOUT ============ */
.app-body {
  padding-top: 58px;
  padding-bottom: 68px;
  min-height: 100vh;
  overflow-y: auto;
}

/* ============ BOTTOM NAV ============ */
.bottom-nav {
  position: fixed; bottom: 0; left: 0; right: 0; z-index: 500;
  background: rgba(12,12,16,0.95);
  backdrop-filter: blur(20px);
  border-top: 1px solid var(--border);
  display: flex; height: 68px; padding-bottom: env(safe-area-inset-bottom);
}
.nav-btn {
  flex: 1; display: flex; flex-direction: column; align-items: center;
  justify-content: center; gap: 4px;
  cursor: pointer; border: none; background: none; color: var(--text3);
  font-family: var(--font); font-size: 10px; font-weight: 600;
  text-transform: uppercase; letter-spacing: 0.4px;
  transition: color 0.2s;
}
.nav-btn.active { color: var(--accent); }
.nav-btn .nav-ico { font-size: 22px; line-height: 1; }

/* ============ PAGES ============ */
.page { display: none; animation: fadeSlide 0.25s ease; }
.page.active { display: block; }
@keyframes fadeSlide {
  from { opacity: 0; transform: translateY(6px); }
  to   { opacity: 1; transform: translateY(0); }
}

/* ============ COMMON COMPONENTS ============ */
.section { padding: 14px 16px; }
.section + .section { padding-top: 0; }

.sec-title {
  font-size: 10px; font-weight: 700; text-transform: uppercase;
  letter-spacing: 1.5px; color: var(--text3);
  display: flex; align-items: center; gap: 8px; margin-bottom: 12px;
}
.sec-title::after { content: ''; flex: 1; height: 1px; background: var(--border); }

.card {
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  padding: 14px 16px;
  margin-bottom: 10px;
  transition: border-color 0.15s, background 0.15s;
}
.card:hover { border-color: var(--border2); }
.card.clickable { cursor: pointer; }
.card.clickable:hover { border-color: var(--accent2); background: var(--surface2); }

.badge {
  display: inline-flex; align-items: center; gap: 4px;
  padding: 3px 9px; border-radius: 20px;
  font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.3px;
}
.badge.lancar { background: var(--green-dim); color: var(--green); }
.badge.padat  { background: var(--yellow-dim); color: var(--yellow); }
.badge.macet  { background: var(--red-dim); color: var(--red); }
.badge.ganjil { background: var(--accent-dim); color: var(--accent); }
.badge.genap  { background: var(--accent2-dim); color: var(--accent2); }
.badge.bebas  { background: var(--green-dim); color: var(--green); }

.tag {
  display: inline-block; padding: 3px 9px; border-radius: 20px;
  font-size: 10px; font-weight: 600; border: 1px solid var(--border);
  background: var(--surface2); color: var(--text2);
}
.tag.hl { border-color: var(--accent); color: var(--accent); background: var(--accent-dim); }
.tag.warn { border-color: var(--red); color: var(--red); background: var(--red-dim); }

/* Filter Tabs */
.tab-row {
  display: flex; gap: 6px; padding: 10px 16px 12px;
  overflow-x: auto; scrollbar-width: none;
}
.tab-row::-webkit-scrollbar { display: none; }
.tab-btn {
  padding: 7px 14px; border-radius: 20px; white-space: nowrap; cursor: pointer;
  border: 1px solid var(--border); background: var(--surface); color: var(--text2);
  font-family: var(--font); font-size: 12px; font-weight: 600; transition: all 0.15s;
}
.tab-btn.active { background: var(--accent); border-color: var(--accent); color: #000; }

/* Form Controls */
.form-label { font-size: 11px; font-weight: 700; color: var(--text3); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 7px; display: block; }
.form-control {
  width: 100%; background: var(--surface2); border: 1px solid var(--border);
  border-radius: var(--radius-sm); padding: 11px 14px;
  color: var(--text); font-family: var(--font); font-size: 14px; outline: none;
  margin-bottom: 10px; appearance: none; transition: border-color 0.15s;
}
.form-control:focus { border-color: var(--accent); }
.form-control::placeholder { color: var(--text3); }

.btn-primary {
  width: 100%; background: var(--accent); color: #000; border: none;
  border-radius: var(--radius-sm); padding: 13px; cursor: pointer;
  font-family: var(--font); font-size: 14px; font-weight: 800; letter-spacing: 0.3px;
  transition: opacity 0.15s, transform 0.1s;
}
.btn-primary:hover { opacity: 0.9; }
.btn-primary:active { transform: scale(0.98); }
.btn-primary:disabled { opacity: 0.5; cursor: not-allowed; }

.btn-secondary {
  background: var(--surface2); color: var(--text2); border: 1px solid var(--border);
  border-radius: var(--radius-sm); padding: 9px 16px; cursor: pointer;
  font-family: var(--font); font-size: 13px; font-weight: 600;
  transition: all 0.15s;
}
.btn-secondary:hover { border-color: var(--accent2); color: var(--accent2); }

/* Result Box */
.result-box {
  background: var(--surface2); border: 1px solid var(--border);
  border-radius: var(--radius); padding: 16px; margin-top: 12px;
  display: none;
}
.result-box.show { display: block; }
.result-box.green { border-color: var(--green); background: var(--green-dim); }
.result-box.red   { border-color: var(--red); background: var(--red-dim); }
.result-box.yellow { border-color: var(--yellow); background: var(--yellow-dim); }
.result-main { font-size: 26px; font-weight: 800; font-family: var(--mono); margin-bottom: 6px; }
.result-main.green { color: var(--green); }
.result-main.red { color: var(--red); }
.result-main.yellow { color: var(--yellow); }
.result-main.accent { color: var(--accent); }
.result-sub { font-size: 12px; color: var(--text2); line-height: 1.6; }

/* Detail row */
.det-row {
  display: flex; justify-content: space-between; align-items: center;
  padding: 9px 0; border-bottom: 1px solid var(--border); font-size: 13px;
}
.det-row:last-child { border-bottom: none; }
.det-label { color: var(--text2); }
.det-val { font-weight: 700; font-family: var(--mono); }
.det-val.accent { color: var(--accent); }
.det-val.green { color: var(--green); }
.det-val.red { color: var(--red); }

/* Search Bar */
.search-wrap { position: relative; margin-bottom: 10px; }
.search-wrap .ico { position: absolute; left: 13px; top: 50%; transform: translateY(-50%); font-size: 16px; }
.search-wrap .form-control { padding-left: 40px; margin-bottom: 0; }

/* Place Card */
.place-card {
  display: flex; gap: 12px; align-items: flex-start;
}
.place-icon {
  width: 46px; height: 46px; border-radius: 12px;
  background: var(--surface2); border: 1px solid var(--border);
  display: flex; align-items: center; justify-content: center;
  font-size: 22px; flex-shrink: 0;
}
.place-body { flex: 1; min-width: 0; }
.place-name { font-size: 14px; font-weight: 700; margin-bottom: 3px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.place-meta { font-size: 12px; color: var(--text2); margin-bottom: 6px; }
.place-tags { display: flex; flex-wrap: wrap; gap: 4px; margin-bottom: 6px; }
.place-route-btn {
  display: inline-flex; align-items: center; gap: 5px;
  background: var(--accent-dim); border: 1px solid var(--accent);
  color: var(--accent); border-radius: 20px; padding: 4px 12px;
  font-size: 11px; font-weight: 700; cursor: pointer; transition: all 0.15s;
}
.place-route-btn:hover { background: var(--accent); color: #000; }

/* ============ HERO SECTION ============ */
.hero-banner {
  margin: 14px 16px 0;
  background: linear-gradient(135deg, var(--surface) 0%, var(--surface2) 100%);
  border: 1px solid var(--border);
  border-left: 4px solid var(--accent);
  border-radius: var(--radius);
  padding: 16px;
  display: flex; align-items: center; gap: 16px;
}
.hero-gg { flex: 1; }
.hero-gg-label { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: var(--text3); margin-bottom: 4px; }
.hero-gg-status { font-size: 32px; font-weight: 800; letter-spacing: -1px; }
.hero-gg-status.ganjil { color: var(--accent); }
.hero-gg-status.genap  { color: var(--accent2); }
.hero-gg-status.bebas  { color: var(--green); }
.hero-gg-info { font-size: 11px; color: var(--text2); margin-top: 4px; line-height: 1.5; }
.hero-right { text-align: right; }
.hero-aktif { font-size: 11px; font-weight: 700; }
.hero-aktif.aktif { color: var(--red); }
.hero-aktif.off { color: var(--green); }
.hero-date { font-size: 10px; color: var(--text3); margin-top: 4px; }

/* Nav Grid */
.nav-grid {
  display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px;
  padding: 14px 16px;
}
.nav-tile {
  background: var(--surface); border: 1px solid var(--border);
  border-radius: var(--radius); padding: 14px 8px;
  text-align: center; cursor: pointer;
  transition: all 0.15s;
}
.nav-tile:hover, .nav-tile:active { border-color: var(--accent); background: var(--accent-dim); }
.nav-tile .ico { font-size: 26px; margin-bottom: 6px; }
.nav-tile .lbl { font-size: 11px; font-weight: 700; color: var(--text2); line-height: 1.3; }

/* Kondisi Ticker */
.ticker-item {
  display: flex; align-items: center; gap: 10px;
  padding: 10px 14px;
  background: var(--surface2); border: 1px solid var(--border);
  border-radius: var(--radius-sm); margin-bottom: 8px; font-size: 12px;
}
.ticker-dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }
.ticker-dot.lancar { background: var(--green); box-shadow: 0 0 5px var(--green); }
.ticker-dot.padat  { background: var(--yellow); box-shadow: 0 0 5px var(--yellow); }
.ticker-dot.macet  { background: var(--red); box-shadow: 0 0 5px var(--red); }
.ticker-ruas { flex: 1; color: var(--text2); }
.ticker-waktu { font-family: var(--mono); font-size: 11px; color: var(--text3); }

/* ============ MAPS ============ */
#map-container {
  height: 260px; border-radius: var(--radius);
  overflow: hidden; margin-bottom: 12px;
  border: 1px solid var(--border);
  position: relative;
}
#map { width: 100%; height: 100%; }
.map-placeholder {
  width: 100%; height: 100%;
  display: flex; flex-direction: column; align-items: center; justify-content: center;
  background: var(--surface2); color: var(--text3); gap: 10px; text-align: center;
  padding: 20px;
}
.map-placeholder .map-ico { font-size: 40px; }
.map-placeholder p { font-size: 13px; line-height: 1.6; }
.map-placeholder a { color: var(--accent2); font-size: 12px; }

.map-panel {
  background: var(--surface); border: 1px solid var(--border);
  border-radius: var(--radius); padding: 14px 16px; margin-bottom: 10px;
}
.map-panel-title { font-size: 12px; font-weight: 700; color: var(--text2); margin-bottom: 10px; }

.distance-result {
  background: var(--surface2); border: 1px solid var(--accent);
  border-radius: var(--radius); padding: 14px 16px;
  margin-bottom: 10px; display: none;
}
.distance-result.show { display: block; }
.distance-result h3 { font-size: 12px; color: var(--text3); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px; }
.dist-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
.dist-item { text-align: center; }
.dist-val { font-family: var(--mono); font-size: 22px; font-weight: 700; color: var(--accent); }
.dist-label { font-size: 11px; color: var(--text2); margin-top: 3px; }

/* ============ SOS ============ */
.sos-card {
  background: var(--red-dim); border: 1px solid rgba(248,113,113,0.3);
  border-radius: var(--radius); padding: 14px 16px; margin-bottom: 10px;
  display: flex; align-items: center; gap: 12px;
}
.sos-ico { font-size: 28px; flex-shrink: 0; }
.sos-body { flex: 1; }
.sos-name { font-size: 14px; font-weight: 700; }
.sos-num { font-family: var(--mono); font-size: 14px; color: var(--accent); margin: 3px 0; }
.sos-desc { font-size: 11px; color: var(--text2); }
.btn-call {
  background: var(--red); color: #fff; border: none;
  border-radius: 10px; padding: 8px 14px;
  font-family: var(--font); font-size: 12px; font-weight: 700; cursor: pointer;
  transition: opacity 0.15s; flex-shrink: 0;
}
.btn-call:hover { opacity: 0.85; }

/* ============ MODAL ============ */
.modal-overlay {
  display: none; position: fixed; inset: 0;
  background: rgba(0,0,0,0.75); z-index: 900;
  backdrop-filter: blur(4px); align-items: flex-end;
}
.modal-overlay.open { display: flex; }
.modal-sheet {
  background: var(--surface); border: 1px solid var(--border);
  border-bottom: none; border-radius: 20px 20px 0 0;
  width: 100%; max-height: 85vh; overflow-y: auto;
  padding: 20px; position: relative;
  animation: slideUp 0.3s cubic-bezier(0.4,0,0.2,1);
}
@keyframes slideUp {
  from { transform: translateY(100%); } to { transform: translateY(0); }
}
.modal-handle { width: 40px; height: 4px; background: var(--border2); border-radius: 2px; margin: 0 auto 16px; }
.modal-title { font-size: 18px; font-weight: 800; margin-bottom: 4px; }
.modal-sub { font-size: 12px; color: var(--text2); margin-bottom: 16px; }
.btn-close {
  position: absolute; top: 18px; right: 16px;
  background: var(--surface2); border: 1px solid var(--border);
  border-radius: 50%; width: 32px; height: 32px;
  display: flex; align-items: center; justify-content: center;
  cursor: pointer; font-size: 14px; color: var(--text2);
}

/* ============ LOADING SPINNER ============ */
.spinner {
  width: 20px; height: 20px; border-radius: 50%;
  border: 2px solid var(--border2);
  border-top-color: var(--accent);
  animation: spin 0.7s linear infinite; margin: 0 auto;
}
@keyframes spin { to { transform: rotate(360deg); } }

/* ============ INFO BOX ============ */
.info-box {
  background: var(--accent2-dim); border: 1px solid rgba(56,189,248,0.2);
  border-radius: var(--radius-sm); padding: 12px 14px; margin-bottom: 12px;
  font-size: 12px; color: var(--text2); line-height: 1.7;
}
.info-box strong { color: var(--accent2); }

/* Toll card */
.toll-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px; }
.toll-name { font-size: 14px; font-weight: 700; }
.toll-tarif { font-family: var(--mono); font-size: 14px; color: var(--accent); font-weight: 600; }
.toll-meta { display: flex; flex-wrap: wrap; gap: 8px; align-items: center; }
.toll-meta-item { font-size: 12px; color: var(--text2); display: flex; align-items: center; gap: 4px; }

/* GG Table */
.gg-table { width: 100%; border-collapse: collapse; font-size: 12px; }
.gg-table th { background: var(--surface2); padding: 8px 10px; text-align: left; color: var(--text3); font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid var(--border); }
.gg-table td { padding: 10px; border-bottom: 1px solid var(--border); vertical-align: top; }
.gg-table tr:last-child td { border-bottom: none; }
.gg-table tr:hover td { background: var(--surface2); }

/* Responsive */
@media (min-width: 480px) {
  body, .app-header, .bottom-nav { max-width: 480px; margin-left: auto; margin-right: auto; }
  .app-header, .bottom-nav { left: 50%; right: auto; transform: translateX(-50%); width: 480px; }
}
</style>
</head>
<body>

<!-- ============ HEADER ============ -->
<header class="app-header">
  <div class="app-logo">S<span>upir</span>Info</div>
  <div class="header-clock" id="clock">--:--:--</div>
  <div class="header-gg">
    <div class="header-gg-dot <?= $gg_class ?>"></div>
    <span class="header-gg-text" id="gg-header-label"><?= strtoupper($gg['status']) ?></span>
  </div>
</header>

<div class="app-body">

<!-- ======================================================= -->
<!-- PAGE: BERANDA                                            -->
<!-- ======================================================= -->
<div class="page active" id="page-beranda">

  <!-- Hero GG Banner -->
  <div class="hero-banner">
    <div class="hero-gg">
      <div class="hero-gg-label">Status Hari Ini</div>
      <div class="hero-gg-status <?= $gg_class ?>" id="gg-hero-status">
        <?= strtoupper($gg['status']) ?>
      </div>
      <div class="hero-gg-info" id="gg-hero-info">
        <?php if ($gg['is_weekend']): ?>
          Akhir pekan — tidak ada pembatasan ganjil genap
        <?php else: ?>
          Plat <?= $gg['is_ganjil'] ? 'GENAP' : 'GANJIL' ?> boleh melintas hari ini<br>
          Berlaku 06:00–10:00 &amp; 16:00–21:00
        <?php endif; ?>
      </div>
    </div>
    <div class="hero-right">
      <div class="hero-aktif <?= $gg['aktif'] ? 'aktif' : 'off' ?>" id="gg-aktif-label">
        <?= $gg['aktif'] ? '🔴 Sedang Aktif' : '🟢 Tidak Aktif' ?>
      </div>
      <div class="hero-date"><?= date('d M Y') ?></div>
    </div>
  </div>

  <!-- Nav Grid -->
  <div class="nav-grid">
    <div class="nav-tile" onclick="goPage('ganjil-genap')"><div class="ico">🚗</div><div class="lbl">Ganjil Genap</div></div>
    <div class="nav-tile" onclick="goPage('toll')"><div class="ico">🛣️</div><div class="lbl">Info Tol & Tarif</div></div>
    <div class="nav-tile" onclick="goPage('rute')"><div class="ico">🗺️</div><div class="lbl">Rute & Jarak</div></div>
    <div class="nav-tile" onclick="goPage('tempat')"><div class="ico">📍</div><div class="lbl">Tempat Tujuan</div></div>
    <div class="nav-tile" onclick="goPage('bandara')"><div class="ico">✈️</div><div class="lbl">Bandara & Stasiun</div></div>
    <div class="nav-tile" onclick="goPage('mall')"><div class="ico">🏬</div><div class="lbl">Mall & Hotel</div></div>
  </div>

  <!-- Kondisi Jalan -->
  <div class="section">
    <div class="sec-title">Update Kondisi Jalan <span id="cond-time" style="font-size:10px;color:var(--text3);text-transform:none;letter-spacing:0"></span></div>
    <div id="kondisi-list">
      <div style="text-align:center;padding:20px"><div class="spinner"></div></div>
    </div>
    <button class="btn-secondary" onclick="loadKondisi()" style="width:100%;margin-top:4px">🔄 Refresh Kondisi</button>
  </div>
</div>

<!-- ======================================================= -->
<!-- PAGE: GANJIL GENAP                                       -->
<!-- ======================================================= -->
<div class="page" id="page-ganjil-genap">
  <div class="section">
    <div class="info-box">
      <strong>Ganjil Genap 2024</strong> berlaku Senin–Jumat (kecuali hari libur nasional),
      pukul <strong>06:00–10:00</strong> dan <strong>16:00–21:00</strong>.
      Pelanggaran didenda <strong>Rp 500.000</strong>.
    </div>

    <!-- Cek Plat -->
    <div class="card">
      <label class="form-label">🔍 Cek Plat Nomor Kendaraan</label>
      <input class="form-control" type="text" id="plat-input" placeholder="Contoh: B 1234 ABC"
        style="text-transform:uppercase" oninput="this.value=this.value.toUpperCase()">
      <button class="btn-primary" onclick="cekPlat()">CEK STATUS SEKARANG</button>
      <div class="result-box" id="plat-result">
        <div class="result-main" id="plat-label">—</div>
        <div class="result-sub" id="plat-msg">—</div>
      </div>
    </div>

    <!-- Tabel Ruas -->
    <div class="sec-title" style="margin-top:8px">Ruas Berlaku Ganjil Genap</div>
    <div style="overflow-x:auto; border-radius:var(--radius); border:1px solid var(--border)">
      <table class="gg-table">
        <thead>
          <tr><th>Ruas Jalan</th><th>Segmen</th><th>Jam</th></tr>
        </thead>
        <tbody>
          <?php foreach ($ganjil_genap_routes as $r): ?>
          <tr>
            <td><strong><?= htmlspecialchars($r['jalan']) ?></strong></td>
            <td style="color:var(--text2);font-size:11px"><?= htmlspecialchars($r['dari']) ?> → <?= htmlspecialchars($r['sampai']) ?></td>
            <td><span style="font-family:var(--mono);font-size:11px;color:var(--accent2)"><?= $r['jam'] ?></span></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- ======================================================= -->
<!-- PAGE: INFO TOL                                           -->
<!-- ======================================================= -->
<div class="page" id="page-toll">
  <div class="section">

    <!-- Kalkulator -->
    <div class="card">
      <div class="sec-title" style="margin-bottom:10px">Kalkulator Tarif Tol</div>
      <label class="form-label">Pilih Rute Tol</label>
      <select class="form-control" id="toll-kode">
        <option value="">-- Pilih Rute --</option>
        <?php foreach ($toll_data as $t): ?>
        <option value="<?= $t['kode'] ?>"><?= htmlspecialchars($t['nama']) ?> (<?= htmlspecialchars($t['dari']) ?> → <?= htmlspecialchars($t['tujuan']) ?>)</option>
        <?php endforeach; ?>
      </select>
      <label class="form-label">Golongan Kendaraan</label>
      <select class="form-control" id="toll-gol">
        <option value="1">Golongan I — Sedan, SUV, Minibus</option>
        <option value="2">Golongan II — MPV Besar, Pickup Kecil</option>
        <option value="3">Golongan III — Truk 2 As</option>
        <option value="4">Golongan IV — Truk 3 As</option>
        <option value="5">Golongan V — Truk 5 As / Kontainer</option>
      </select>
      <button class="btn-primary" onclick="hitungToll()">HITUNG TARIF TOL</button>
      <div class="result-box" id="toll-result">
        <div class="sec-title" style="margin-bottom:8px">Hasil Perhitungan</div>
        <div class="result-main accent" id="toll-tarif">—</div>
        <div class="result-sub" id="toll-info">—</div>
        <div id="toll-extra" style="margin-top:12px"></div>
        <button class="btn-secondary" onclick="showTollOnMap()" style="margin-top:12px;width:100%">
          🗺️ Lihat di Peta
        </button>
      </div>
    </div>

    <!-- Daftar Rute -->
    <div class="sec-title">Semua Rute Tol</div>
    <?php foreach ($toll_data as $t): ?>
    <div class="card clickable" onclick="openTollDetail('<?= $t['kode'] ?>')">
      <div class="toll-header">
        <div class="toll-name"><?= htmlspecialchars($t['nama']) ?></div>
        <div class="toll-tarif"><?= formatRupiah($t['tarif'][1]) ?></div>
      </div>
      <div class="toll-meta">
        <span class="toll-meta-item">📏 <?= $t['jarak'] ?> km</span>
        <span class="toll-meta-item">🕐 ~<?= $t['waktu'] ?> mnt</span>
        <span class="badge <?= $t['status'] ?>"><?= ucfirst($t['status']) ?></span>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- ======================================================= -->
<!-- PAGE: RUTE & JARAK (Google Maps)                         -->
<!-- ======================================================= -->
<div class="page" id="page-rute">
  <div class="section">
    <div class="info-box">
      <strong>📍 Fitur Rute & Jarak</strong> — Hitung jarak dari lokasi Anda sekarang ke tempat tujuan,
      lengkap dengan panduan arah via Google Maps.
    </div>

    <!-- Peta -->
    <div id="map-container">
      <?php if (GOOGLE_MAPS_API_KEY === 'MASUKKAN_API_KEY_GOOGLE_MAPS_ANDA'): ?>
      <div class="map-placeholder">
        <div class="map-ico">🗺️</div>
        <p><strong>Google Maps API Key Diperlukan</strong><br>
        Buka file <code>includes/config.php</code> dan isi <code>GOOGLE_MAPS_API_KEY</code> dengan API Key Anda.</p>
        <a href="https://console.cloud.google.com/google/maps-apis/" target="_blank">Dapatkan API Key Gratis →</a>
      </div>
      <?php else: ?>
      <div id="map"></div>
      <?php endif; ?>
    </div>

    <!-- Panel Input Rute -->
    <div class="map-panel">
      <div class="map-panel-title">📍 Titik Asal</div>
      <div style="display:flex;gap:8px;margin-bottom:10px">
        <input class="form-control" id="origin-input" placeholder="Ketik alamat atau klik Lokasi Saya" style="margin-bottom:0;flex:1">
        <button class="btn-secondary" onclick="getMyLocation()" title="Gunakan Lokasi Saya">📡</button>
      </div>
      <div class="map-panel-title">🏁 Tujuan</div>
      <div class="search-wrap" style="margin-bottom:10px">
        <span class="ico">🔍</span>
        <input class="form-control" id="dest-search" placeholder="Cari tempat tujuan..." oninput="searchDest(this.value)">
      </div>
      <div id="dest-suggestions" style="margin-bottom:10px"></div>
      <input type="hidden" id="dest-lat">
      <input type="hidden" id="dest-lng">
      <input type="hidden" id="dest-name">
      <select class="form-control" id="travel-mode">
        <option value="DRIVING">🚗 Berkendara</option>
        <option value="TRANSIT">🚌 Transportasi Umum</option>
        <option value="WALKING">🚶 Berjalan Kaki</option>
      </select>
      <button class="btn-primary" onclick="hitungRute()">HITUNG RUTE & JARAK</button>
    </div>

    <!-- Hasil Rute -->
    <div class="distance-result" id="dist-result">
      <h3>Hasil Perhitungan Rute</h3>
      <div class="dist-grid">
        <div class="dist-item">
          <div class="dist-val" id="dr-jarak">—</div>
          <div class="dist-label">Jarak</div>
        </div>
        <div class="dist-item">
          <div class="dist-val" id="dr-waktu">—</div>
          <div class="dist-label">Estimasi Waktu</div>
        </div>
      </div>
      <div style="margin-top:12px;display:flex;gap:8px">
        <button class="btn-primary" onclick="bukaGoogleMaps()" style="flex:1;font-size:12px">
          📱 Buka di Google Maps
        </button>
        <button class="btn-secondary" onclick="bukaWaze()" style="font-size:12px">
          🔵 Waze
        </button>
      </div>
      <div id="dr-steps" style="margin-top:12px"></div>
    </div>

    <!-- Shortcut Tujuan Populer -->
    <div class="sec-title">Tujuan Populer</div>
    <?php
    $populer = array_filter($places_data, fn($p) => in_array($p['cat'][0], ['bandara','stasiun','golf','mall']));
    $populer = array_slice(array_values($populer), 0, 8);
    foreach ($populer as $p): ?>
    <div class="card clickable" onclick="pilihTujuan(<?= $p['lat'] ?>, <?= $p['lng'] ?>, '<?= addslashes($p['nama']) ?>')">
      <div class="place-card">
        <div class="place-icon"><?= $p['icon'] ?></div>
        <div class="place-body">
          <div class="place-name"><?= htmlspecialchars($p['nama']) ?></div>
          <div class="place-meta">📍 <?= htmlspecialchars($p['area']) ?> · 📏 <?= $p['jarak_jkt'] ?> dari Jakarta</div>
          <div class="place-route-btn">🗺️ Pilih Tujuan</div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- ======================================================= -->
<!-- PAGE: TEMPAT TUJUAN                                      -->
<!-- ======================================================= -->
<div class="page" id="page-tempat">
  <div class="search-wrap" style="margin:12px 16px 0">
    <span class="ico">🔍</span>
    <input class="form-control" id="tempat-search" placeholder="Cari tempat..." oninput="filterTempat()">
  </div>
  <div class="tab-row" id="tempat-tabs">
    <button class="tab-btn active" onclick="setTempatCat('semua',this)">Semua</button>
    <button class="tab-btn" onclick="setTempatCat('wisata',this)">🎡 Wisata</button>
    <button class="tab-btn" onclick="setTempatCat('golf',this)">⛳ Golf</button>
    <button class="tab-btn" onclick="setTempatCat('jakarta',this)">Jakarta</button>
    <button class="tab-btn" onclick="setTempatCat('bekasi',this)">Bekasi</button>
    <button class="tab-btn" onclick="setTempatCat('bogor',this)">Bogor</button>
    <button class="tab-btn" onclick="setTempatCat('karawang',this)">Karawang</button>
    <button class="tab-btn" onclick="setTempatCat('tangerang',this)">Tangerang</button>
  </div>
  <div class="section" id="tempat-list">
    <div style="text-align:center;padding:30px"><div class="spinner"></div></div>
  </div>
</div>

<!-- ======================================================= -->
<!-- PAGE: BANDARA & STASIUN                                  -->
<!-- ======================================================= -->
<div class="page" id="page-bandara">
  <div class="section">
    <div class="sec-title">Bandara</div>
    <?php
    $bandara = array_filter($places_data, fn($p) => in_array('bandara', $p['cat']));
    foreach ($bandara as $p): renderPlaceCard($p); endforeach;
    ?>
    <div class="sec-title" style="margin-top:8px">Stasiun Kereta</div>
    <?php
    $stasiun = array_filter($places_data, fn($p) => in_array('stasiun', $p['cat']));
    foreach ($stasiun as $p): renderPlaceCard($p); endforeach;
    ?>
  </div>
</div>

<!-- ======================================================= -->
<!-- PAGE: MALL & HOTEL                                       -->
<!-- ======================================================= -->
<div class="page" id="page-mall">
  <div class="tab-row" id="mall-tabs">
    <button class="tab-btn active" onclick="setMallCat('semua',this)">Semua</button>
    <button class="tab-btn" onclick="setMallCat('mall',this)">🏬 Mall</button>
    <button class="tab-btn" onclick="setMallCat('hotel',this)">🏨 Hotel</button>
    <button class="tab-btn" onclick="setMallCat('jakarta',this)">Jakarta</button>
    <button class="tab-btn" onclick="setMallCat('bekasi',this)">Bekasi</button>
    <button class="tab-btn" onclick="setMallCat('bogor',this)">Bogor</button>
    <button class="tab-btn" onclick="setMallCat('karawang',this)">Karawang</button>
    <button class="tab-btn" onclick="setMallCat('tangerang',this)">Tangerang</button>
  </div>
  <div class="section" id="mall-list">
    <div style="text-align:center;padding:30px"><div class="spinner"></div></div>
  </div>
</div>

<!-- ======================================================= -->
<!-- PAGE: SOS                                                -->
<!-- ======================================================= -->
<div class="page" id="page-sos">
  <div class="section">
    <div class="sec-title">Kontak Darurat & Penting</div>

    <?php
    $sos_list = [
      ['ico'=>'🛣️','nama'=>'Jasa Marga (Info Tol & Derek)','num'=>'14080','desc'=>'Info tol, gangguan, kecelakaan, derek gratis di tol Jasa Marga'],
      ['ico'=>'🚑','nama'=>'Ambulans / Darurat Medis','num'=>'119','desc'=>'Layanan gawat darurat medis nasional 24 jam'],
      ['ico'=>'🚔','nama'=>'Polisi / Darurat Keamanan','num'=>'110','desc'=>'Laporan kejahatan, kecelakaan, keamanan umum'],
      ['ico'=>'🚒','nama'=>'Pemadam Kebakaran','num'=>'113','desc'=>'Darurat kebakaran'],
      ['ico'=>'🏥','nama'=>'BASARNAS (SAR)','num'=>'115','desc'=>'Pencarian dan pertolongan'],
      ['ico'=>'📞','nama'=>'Call Center BPJS Kesehatan','num'=>'1500400','desc'=>'Info layanan kesehatan BPJS'],
      ['ico'=>'🔋','nama'=>'PLN (Listrik)','num'=>'123','desc'=>'Gangguan listrik & penerangan jalan'],
      ['ico'=>'🛣️','nama'=>'Waskita Toll Road','num'=>'14088','desc'=>'Info & darurat tol Waskita'],
    ];
    foreach ($sos_list as $s): ?>
    <div class="sos-card">
      <div class="sos-ico"><?= $s['ico'] ?></div>
      <div class="sos-body">
        <div class="sos-name"><?= htmlspecialchars($s['nama']) ?></div>
        <div class="sos-num"><?= $s['num'] ?></div>
        <div class="sos-desc"><?= htmlspecialchars($s['desc']) ?></div>
      </div>
      <button class="btn-call" onclick="window.location.href='tel:<?= $s['num'] ?>'">TELP</button>
    </div>
    <?php endforeach; ?>

    <div class="info-box" style="margin-top:8px">
      <strong>Tips:</strong> Simpan nomor darurat di kontak HP Anda sebelum berangkat perjalanan jauh.
      Derek gratis tersedia di seluruh ruas tol Jasa Marga — hubungi <strong>14080</strong>.
    </div>
  </div>
</div>

</div><!-- end app-body -->

<!-- ============ BOTTOM NAV ============ -->
<nav class="bottom-nav">
  <button class="nav-btn active" id="nav-beranda" onclick="goPage('beranda')"><span class="nav-ico">🏠</span>Beranda</button>
  <button class="nav-btn" id="nav-toll" onclick="goPage('toll')"><span class="nav-ico">🛣️</span>Info Tol</button>
  <button class="nav-btn" id="nav-rute" onclick="goPage('rute')"><span class="nav-ico">🗺️</span>Rute</button>
  <button class="nav-btn" id="nav-tempat" onclick="goPage('tempat')"><span class="nav-ico">📍</span>Tempat</button>
  <button class="nav-btn" id="nav-sos" onclick="goPage('sos')"><span class="nav-ico">🆘</span>SOS</button>
</nav>

<!-- ============ MODAL ============ -->
<div class="modal-overlay" id="modal" onclick="closeModalIfBg(event)">
  <div class="modal-sheet">
    <div class="modal-handle"></div>
    <button class="btn-close" onclick="closeModal()">✕</button>
    <div class="modal-title" id="modal-title">Detail</div>
    <div class="modal-sub" id="modal-sub"></div>
    <div id="modal-body"></div>
  </div>
</div>

<!-- ============ GOOGLE MAPS SCRIPT ============ -->
<?php if (GOOGLE_MAPS_API_KEY !== 'MASUKKAN_API_KEY_GOOGLE_MAPS_ANDA'): ?>
<script>
  window.initMap = function() { window.mapsReady = true; initMapUI(); };
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?= GOOGLE_MAPS_API_KEY ?>&libraries=places,geometry&callback=initMap&language=id" async defer></script>
<?php endif; ?>

<script>
// ============================================================
//  APP STATE
// ============================================================
const API = 'api/handler.php';
const PLACES = <?= json_encode(array_values($places_data)) ?>;
const TOLLS   = <?= json_encode(array_values($toll_data)) ?>;

let currentPage = 'beranda';
let tempatCat   = 'semua';
let mallCat     = 'semua';
let myLat = null, myLng = null;
let destLat = null, destLng = null, destName = '';
let map = null, directionsService = null, directionsRenderer = null;
let myMarker = null;
let currentTollData = null;

// ============================================================
//  CLOCK & INIT
// ============================================================
function updateClock() {
  const n = new Date();
  const pad = v => String(v).padStart(2,'0');
  document.getElementById('clock').textContent = `${pad(n.getHours())}:${pad(n.getMinutes())}:${pad(n.getSeconds())}`;
}
setInterval(updateClock, 1000);
updateClock();

document.addEventListener('DOMContentLoaded', () => {
  loadKondisi();
  loadTempat('semua');
  loadMall('semua');
});

// ============================================================
//  PAGE NAVIGATION
// ============================================================
function goPage(page) {
  document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.nav-btn').forEach(b => b.classList.remove('active'));
  const pageEl = document.getElementById('page-' + page);
  const navEl  = document.getElementById('nav-' + page);
  if (pageEl) pageEl.classList.add('active');
  if (navEl)  navEl.classList.add('active');
  currentPage = page;
  document.querySelector('.app-body').scrollTop = 0;
}

// ============================================================
//  KONDISI JALAN
// ============================================================
async function loadKondisi() {
  const el = document.getElementById('kondisi-list');
  el.innerHTML = '<div style="text-align:center;padding:20px"><div class="spinner"></div></div>';
  try {
    const res = await fetch(`${API}?action=kondisi_jalan`);
    const d = await res.json();
    if (d.success) {
      document.getElementById('cond-time').textContent = '· diupdate ' + d.updated_at;
      el.innerHTML = d.data.map(k => `
        <div class="ticker-item">
          <div class="ticker-dot ${k.status}"></div>
          <div class="ticker-ruas">${k.ruas}</div>
          <div class="ticker-waktu">~${k.waktu} mnt</div>
          <span class="badge ${k.status}">${k.status}</span>
        </div>
      `).join('');
    }
  } catch(e) { el.innerHTML = '<p style="color:var(--text3);text-align:center;padding:16px">Gagal memuat data</p>'; }
}

// ============================================================
//  CEK PLAT
// ============================================================
async function cekPlat() {
  const plat = document.getElementById('plat-input').value.trim();
  if (!plat) { alert('Masukkan nomor plat terlebih dahulu'); return; }
  const res = await fetch(`${API}?action=cek_plat`, {
    method: 'POST', headers: {'Content-Type':'application/x-www-form-urlencoded'},
    body: 'plat=' + encodeURIComponent(plat)
  });
  const d = await res.json();
  const box = document.getElementById('plat-result');
  const lbl = document.getElementById('plat-label');
  const msg = document.getElementById('plat-msg');
  box.className = 'result-box show ' + (d.success ? d.data.color : 'yellow');
  if (d.success) {
    lbl.className = 'result-main ' + d.data.color;
    lbl.textContent = d.data.label;
    msg.textContent = d.data.pesan;
  } else {
    lbl.textContent = '❓ Error';
    msg.textContent = d.message;
  }
}

// ============================================================
//  HITUNG TOL
// ============================================================
async function hitungToll() {
  const kode = document.getElementById('toll-kode').value;
  const gol  = document.getElementById('toll-gol').value;
  if (!kode) { alert('Pilih rute tol terlebih dahulu'); return; }
  const res = await fetch(`${API}?action=hitung_toll`, {
    method: 'POST', headers: {'Content-Type':'application/x-www-form-urlencoded'},
    body: `kode=${kode}&golongan=${gol}`
  });
  const d = await res.json();
  const box = document.getElementById('toll-result');
  if (d.success) {
    currentTollData = d.data;
    document.getElementById('toll-tarif').textContent = d.data.tarif_fmt;
    document.getElementById('toll-info').textContent =
      `Jarak ±${d.data.jarak} km · Estimasi ~${d.data.waktu} mnt · Gol ${d.data.golongan}`;
    let extra = '';
    if (d.data.gerbang.length) extra += `<div style="font-size:12px;color:var(--text2);margin-bottom:8px">🚧 Gerbang: ${d.data.gerbang.join(' → ')}</div>`;
    if (d.data.rest_area.length) extra += `<div style="font-size:12px;color:var(--text2)">☕ Rest Area: ${d.data.rest_area.join(', ')}</div>`;
    document.getElementById('toll-extra').innerHTML = extra;
    box.classList.add('show');
  }
}

function showTollOnMap() {
  if (!currentTollData) return;
  goPage('rute');
  setTimeout(() => {
    pilihTujuan(currentTollData.lat_tujuan, currentTollData.lng_tujuan, currentTollData.nama);
  }, 300);
}

function openTollDetail(kode) {
  const t = TOLLS.find(x => x.kode === kode);
  if (!t) return;
  const tarifRows = Object.entries(t.tarif).map(([g, harga]) =>
    `<div class="det-row"><span class="det-label">Golongan ${g}</span><span class="det-val accent">${formatRp(harga)}</span></div>`
  ).join('');
  document.getElementById('modal-title').textContent = t.nama;
  document.getElementById('modal-sub').textContent = `${t.dari} → ${t.tujuan}`;
  document.getElementById('modal-body').innerHTML = `
    <div class="det-row"><span class="det-label">Jarak</span><span class="det-val">${t.jarak} km</span></div>
    <div class="det-row"><span class="det-label">Estimasi Waktu</span><span class="det-val">~${t.waktu} menit</span></div>
    <div class="det-row"><span class="det-label">Status</span><span class="badge ${t.status}">${t.status}</span></div>
    ${tarifRows}
    ${t.gerbang.length ? `<div class="det-row"><span class="det-label">Gerbang</span><span class="det-val" style="font-size:11px;text-align:right">${t.gerbang.join(' → ')}</span></div>` : ''}
    ${t.rest_area.length ? `<div class="det-row"><span class="det-label">Rest Area</span><span class="det-val" style="font-size:11px">${t.rest_area.join(', ')}</span></div>` : ''}
    <button class="btn-primary" onclick="closeModal();goPage('rute');setTimeout(()=>pilihTujuan(${t.lat_tujuan},${t.lng_tujuan},'${t.nama.replace(/'/g,"\\'")}'),400)" style="margin-top:14px">
      🗺️ Hitung Rute ke Tujuan Ini
    </button>
  `;
  openModal();
}

// ============================================================
//  TEMPAT & MALL
// ============================================================
async function loadTempat(cat) {
  const el = document.getElementById('tempat-list');
  el.innerHTML = '<div style="text-align:center;padding:30px"><div class="spinner"></div></div>';
  const res = await fetch(`${API}?action=get_places&cat=${cat}`);
  const d = await res.json();
  if (d.success) renderPlaces(d.data, el);
}

function filterTempat() {
  const q = document.getElementById('tempat-search').value.toLowerCase();
  const filtered = PLACES.filter(p =>
    (!q || p.nama.toLowerCase().includes(q) || p.area.toLowerCase().includes(q)) &&
    (tempatCat === 'semua' || p.cat.includes(tempatCat))
  );
  renderPlaces(filtered, document.getElementById('tempat-list'));
}

function setTempatCat(cat, el) {
  tempatCat = cat;
  document.querySelectorAll('#tempat-tabs .tab-btn').forEach(b => b.classList.remove('active'));
  el.classList.add('active');
  filterTempat();
}

async function loadMall(cat) {
  const el = document.getElementById('mall-list');
  el.innerHTML = '<div style="text-align:center;padding:30px"><div class="spinner"></div></div>';
  const mallPlaces = PLACES.filter(p => p.cat.some(c => ['mall','hotel'].includes(c)));
  const filtered = cat === 'semua' ? mallPlaces : mallPlaces.filter(p => p.cat.includes(cat));
  renderPlaces(filtered, el);
}

function setMallCat(cat, el) {
  mallCat = cat;
  document.querySelectorAll('#mall-tabs .tab-btn').forEach(b => b.classList.remove('active'));
  el.classList.add('active');
  loadMall(cat);
}

function renderPlaces(data, el) {
  if (!data.length) { el.innerHTML = '<p style="color:var(--text3);text-align:center;padding:20px">Tidak ada hasil ditemukan</p>'; return; }
  el.innerHTML = data.map(p => `
    <div class="card">
      <div class="place-card">
        <div class="place-icon">${p.icon}</div>
        <div class="place-body">
          <div class="place-name">${p.nama}</div>
          <div class="place-meta">📍 ${p.area} · 📏 ${p.jarak_jkt}</div>
          <div class="place-tags">
            <span class="tag">💳 ${formatRp(p.toll_from_jkt)}</span>
            <span class="tag">🅿️ ${p.parkir}</span>
          </div>
          <div style="font-size:11px;color:var(--text3);margin:4px 0 8px">${p.info}</div>
          <div style="display:flex;gap:6px">
            <div class="place-route-btn" onclick="pilihDanHitungRute(${p.lat},${p.lng},'${p.nama.replace(/'/g,"\\'")}')">
              🗺️ Rute dari Lokasi Saya
            </div>
          </div>
        </div>
      </div>
    </div>
  `).join('');
}

// ============================================================
//  GOOGLE MAPS & RUTE
// ============================================================
function initMapUI() {
  if (!window.mapsReady) return;
  map = new google.maps.Map(document.getElementById('map'), {
    center: { lat: -6.2088, lng: 106.8456 },
    zoom: 11,
    styles: darkMapStyles(),
    disableDefaultUI: false,
    zoomControl: true,
    mapTypeControl: false,
    streetViewControl: false,
    fullscreenControl: false,
  });
  directionsService  = new google.maps.DirectionsService();
  directionsRenderer = new google.maps.DirectionsRenderer({
    map, suppressMarkers: false,
    polylineOptions: { strokeColor: '#f59e0b', strokeWeight: 5, strokeOpacity: 0.85 }
  });
  // Autocomplete untuk origin
  const autocomplete = new google.maps.places.Autocomplete(
    document.getElementById('origin-input'),
    { componentRestrictions: { country: 'id' } }
  );
}

function getMyLocation() {
  if (!navigator.geolocation) { alert('Browser tidak mendukung geolokasi'); return; }
  const btn = document.querySelector('[onclick="getMyLocation()"]');
  btn.textContent = '⏳'; btn.disabled = true;
  navigator.geolocation.getCurrentPosition(pos => {
    myLat = pos.coords.latitude;
    myLng = pos.coords.longitude;
    btn.textContent = '📡'; btn.disabled = false;
    document.getElementById('origin-input').value = `${myLat.toFixed(5)}, ${myLng.toFixed(5)}`;
    if (map) {
      map.setCenter({ lat: myLat, lng: myLng });
      map.setZoom(13);
      if (myMarker) myMarker.setMap(null);
      myMarker = new google.maps.Marker({
        position: { lat: myLat, lng: myLng }, map,
        title: 'Lokasi Anda',
        icon: { path: google.maps.SymbolPath.CIRCLE, scale: 10, fillColor: '#38bdf8', fillOpacity: 1, strokeColor: '#fff', strokeWeight: 2 }
      });
    }
    // Reverse geocode
    if (window.mapsReady) {
      const gc = new google.maps.Geocoder();
      gc.geocode({ location: { lat: myLat, lng: myLng } }, (res, st) => {
        if (st === 'OK' && res[0]) document.getElementById('origin-input').value = res[0].formatted_address;
      });
    }
  }, err => {
    btn.textContent = '📡'; btn.disabled = false;
    alert('Gagal mendapatkan lokasi. Pastikan izin lokasi aktif.');
  });
}

function searchDest(q) {
  const box = document.getElementById('dest-suggestions');
  if (q.length < 2) { box.innerHTML = ''; return; }
  const filtered = PLACES.filter(p =>
    p.nama.toLowerCase().includes(q.toLowerCase()) ||
    p.area.toLowerCase().includes(q.toLowerCase())
  ).slice(0, 5);
  box.innerHTML = filtered.map(p => `
    <div onclick="pilihTujuan(${p.lat},${p.lng},'${p.nama.replace(/'/g,"\\'")}'); document.getElementById('dest-search').value='${p.nama.replace(/'/g,"\\'")}'; document.getElementById('dest-suggestions').innerHTML='';"
      style="padding:10px 12px;background:var(--surface2);border:1px solid var(--border);border-radius:var(--radius-sm);margin-bottom:6px;cursor:pointer;font-size:13px;display:flex;align-items:center;gap:8px">
      <span>${p.icon}</span>
      <span><strong>${p.nama}</strong><br><span style="font-size:11px;color:var(--text2)">${p.area}</span></span>
    </div>
  `).join('');
}

function pilihTujuan(lat, lng, nama) {
  destLat = lat; destLng = lng; destName = nama;
  document.getElementById('dest-lat').value = lat;
  document.getElementById('dest-lng').value = lng;
  document.getElementById('dest-name').value = nama;
  document.getElementById('dest-search').value = nama;
  document.getElementById('dest-suggestions').innerHTML = '';
  if (map) {
    map.panTo({ lat, lng });
    new google.maps.Marker({ position: { lat, lng }, map, title: nama });
  }
}

function pilihDanHitungRute(lat, lng, nama) {
  goPage('rute');
  setTimeout(() => {
    pilihTujuan(lat, lng, nama);
    getMyLocation();
  }, 400);
}

function hitungRute() {
  if (!destLat || !destLng) { alert('Pilih tujuan terlebih dahulu'); return; }
  if (!window.mapsReady) {
    // Fallback: buka Google Maps langsung
    bukaGoogleMaps(); return;
  }
  const originInput = document.getElementById('origin-input').value.trim();
  const mode = document.getElementById('travel-mode').value;
  let origin;
  if (myLat && !originInput.includes(',') === false && myLat) {
    origin = new google.maps.LatLng(myLat, myLng);
  } else {
    origin = originInput || (myLat ? new google.maps.LatLng(myLat, myLng) : null);
  }
  if (!origin) { alert('Aktifkan lokasi atau isi alamat asal'); return; }

  directionsService.route({
    origin, destination: { lat: destLat, lng: destLng },
    travelMode: google.maps.TravelMode[mode],
    region: 'id',
  }, (result, status) => {
    if (status === 'OK') {
      directionsRenderer.setDirections(result);
      const leg = result.routes[0].legs[0];
      document.getElementById('dr-jarak').textContent = leg.distance.text;
      document.getElementById('dr-waktu').textContent = leg.duration.text;
      document.getElementById('dist-result').classList.add('show');
      // Steps
      const steps = leg.steps.slice(0,5).map((s,i) =>
        `<div style="padding:8px 0;border-bottom:1px solid var(--border);font-size:12px;color:var(--text2)">
          <strong style="color:var(--text)">${i+1}.</strong> ${s.instructions.replace(/<[^>]+>/g,'')} (${s.distance.text})
        </div>`
      ).join('');
      document.getElementById('dr-steps').innerHTML = steps;
    } else {
      alert('Gagal menghitung rute: ' + status);
    }
  });
}

function bukaGoogleMaps() {
  const origin = (myLat && myLng) ? `${myLat},${myLng}` : '';
  const dest   = `${destLat},${destLng}`;
  const mode   = { DRIVING: 'driving', TRANSIT: 'transit', WALKING: 'walking' }[document.getElementById('travel-mode').value] || 'driving';
  const url    = `https://www.google.com/maps/dir/?api=1&origin=${origin}&destination=${dest}&travelmode=${mode}`;
  window.open(url, '_blank');
}

function bukaWaze() {
  if (!destLat || !destLng) return;
  window.open(`https://waze.com/ul?ll=${destLat},${destLng}&navigate=yes`, '_blank');
}

// ============================================================
//  MODAL
// ============================================================
function openModal() { document.getElementById('modal').classList.add('open'); }
function closeModal() { document.getElementById('modal').classList.remove('open'); }
function closeModalIfBg(e) { if (e.target === document.getElementById('modal')) closeModal(); }

// ============================================================
//  HELPERS
// ============================================================
function formatRp(n) {
  if (!n) return 'Rp 0';
  return 'Rp ' + parseInt(n).toLocaleString('id-ID');
}

// ============================================================
//  DARK MAP STYLES
// ============================================================
function darkMapStyles() {
  return [
    {elementType:'geometry',stylers:[{color:'#1a1a24'}]},
    {elementType:'labels.text.fill',stylers:[{color:'#746855'}]},
    {elementType:'labels.text.stroke',stylers:[{color:'#242f3e'}]},
    {featureType:'road',elementType:'geometry',stylers:[{color:'#2c2c3e'}]},
    {featureType:'road',elementType:'geometry.stroke',stylers:[{color:'#1a1a28'}]},
    {featureType:'road.highway',elementType:'geometry',stylers:[{color:'#3d3d52'}]},
    {featureType:'road.highway',elementType:'geometry.stroke',stylers:[{color:'#1a1a28'}]},
    {featureType:'road.highway',elementType:'labels.text.fill',stylers:[{color:'#f59e0b'}]},
    {featureType:'water',elementType:'geometry',stylers:[{color:'#0d1117'}]},
    {featureType:'poi',elementType:'geometry',stylers:[{color:'#1e1e2a'}]},
    {featureType:'poi.park',elementType:'geometry',stylers:[{color:'#1a2a1a'}]},
    {featureType:'transit',elementType:'geometry',stylers:[{color:'#2f3948'}]},
  ];
}
</script>

<?php
// PHP helper function untuk render place card
function renderPlaceCard($p) {
    echo '<div class="card clickable" onclick="pilihDanHitungRute(' . $p['lat'] . ',' . $p['lng'] . ',\'' . addslashes($p['nama']) . '\')">';
    echo '<div class="place-card">';
    echo '<div class="place-icon">' . $p['icon'] . '</div>';
    echo '<div class="place-body">';
    echo '<div class="place-name">' . htmlspecialchars($p['nama']) . '</div>';
    echo '<div class="place-meta">📍 ' . htmlspecialchars($p['area']) . ' · 📏 ' . $p['jarak_jkt'] . '</div>';
    echo '<div style="font-size:11px;color:var(--text3);margin-bottom:6px">' . htmlspecialchars($p['info']) . '</div>';
    echo '<div class="place-tags">';
    if ($p['toll_from_jkt'] > 0) echo '<span class="tag">💳 Rp ' . number_format($p['toll_from_jkt'], 0, ',', '.') . '</span>';
    echo '<span class="tag">🅿️ ' . htmlspecialchars($p['parkir']) . '</span>';
    echo '</div>';
    echo '<div class="place-route-btn" style="margin-top:8px">🗺️ Hitung Rute</div>';
    echo '</div></div></div>';
}
?>
</body>
</html>
