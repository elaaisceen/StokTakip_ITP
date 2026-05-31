<head>
<!-- $ayarlar görmedi ve hata kızdı bu nedenle ai'dan bu satırı eklemem gerekti  -->
  <?php /** @var \Entities\ayarlarEntity $ayarlar */ 
  $ayarlar = $code->ayarlariGetir();
  ?>

  <base href="<?php echo $ayarlar->site_url; ?>/">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="description" content="<?php echo $ayarlar->site_desc; ?>">
  <meta name="author" content="Elanur Tuana İŞCEN">
  <meta name="keyword" content="<?php echo $ayarlar->site_key; ?>">
  <title><?php echo $ayarlar->site_baslik; ?></title>
  <link rel="apple-touch-icon" sizes="57x57" href="assets/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="assets/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="assets/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="assets/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="assets/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="assets/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="assets/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="assets/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="assets/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
  <link rel="manifest" href="assets/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <!-- Vendors styles-->
  <link rel="stylesheet" href="vendors/simplebar/css/simplebar.css">
  <link rel="stylesheet" href="css/vendors/simplebar.css">
  <!-- Main styles for this application-->
  <link href="css/style.css" rel="stylesheet">
  <!-- We use those styles to show code examples, you should remove them in your application.-->
  <link href="css/examples.css" rel="stylesheet">
  <script src="js/config.js"></script>
  <script src="js/color-modes.js"></script>
  <link href="vendors/@coreui/chartjs/css/coreui-chartjs.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


</head>

<!-- KRİTİK STOK UYARISI -->
    <?php
$kritikUrunler = $code->getirKritikUrunler();
if(!empty($kritikUrunler)){ ?>

<!-- Kritik Stok Toast Bildirimi -->
<div id="kritikStokToast" style="
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    min-width: 350px;
    max-width: 450px;
    background: #dc3545;
    color: white;
    border-radius: 10px;
    box-shadow: 0 8px 25px rgba(220,53,69,0.5);
    animation: slideIn 0.5s ease;
">
    <div style="padding: 15px 20px; border-bottom: 1px solid rgba(255,255,255,0.2); display:flex; justify-content:space-between; align-items:center;">
        <strong style="font-size:15px;">
            ⚠️ Kritik Stok Uyarısı!
        </strong>
        <button onclick="document.getElementById('kritikStokToast').style.display='none'" 
                style="background:none; border:none; color:white; font-size:20px; cursor:pointer; line-height:1;">
            &times;
        </button>
    </div>
    <div style="padding: 12px 20px;">
        <p style="margin:0 0 8px 0; font-size:13px; opacity:0.9;">
            Stoğu kritik seviyenin altına düşen <strong><?php echo count($kritikUrunler); ?> ürün</strong> var:
        </p>
        <ul style="margin:0; padding-left:18px; font-size:13px;">
            <?php foreach($kritikUrunler as $k){ ?>
            <li style="margin-bottom:4px;">
                <strong><?php echo $k->urun_adi; ?></strong>
                — Stok: <span style="background:white; color:#dc3545; padding:1px 6px; border-radius:10px; font-weight:bold; font-size:12px;"><?php echo $k->mevcut_stok; ?></span>
                / Eşik: <strong><?php echo $k->kritik_stok; ?></strong>
            </li>
            <?php } ?>
        </ul>
    </div>
    <div style="padding: 10px 20px; display:flex; gap:8px; border-top: 1px solid rgba(255,255,255,0.2);">
        <a href="login.php?do=urunler" 
           style="background:white; color:#dc3545; padding:6px 14px; border-radius:6px; text-decoration:none; font-size:13px; font-weight:600;">
            📋 Ürünleri Gör
        </a>
        <button onclick="document.getElementById('kritikStokToast').style.display='none'"
                style="background:rgba(255,255,255,0.2); color:white; border:1px solid rgba(255,255,255,0.4); padding:6px 14px; border-radius:6px; font-size:13px; cursor:pointer;">
            Kapat
        </button>
    </div>
</div>

<style>
@keyframes slideIn {
    from { transform: translateX(120%); opacity: 0; }
    to   { transform: translateX(0);    opacity: 1; }
}
</style>

<?php } ?>

<body>
  <div class="sidebar sidebar-dark sidebar-fixed border-end" id="sidebar">
    <div class="sidebar-header border-bottom">
      <div class="sidebar-brand me-auto">
        <svg role="img" aria-label="CoreUI Logo Full" class="sidebar-brand-full" width="88" height="32"
          xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 312 115">
          <g style="fill: currentColor">
            <path
              d="M96 24.124 57 1.608a12 12 0 0 0-12 0L6 24.124a12.034 12.034 0 0 0-6 10.393V79.55a12.033 12.033 0 0 0 6 10.392l39 22.517a12 12 0 0 0 12 0l39-22.517a12.033 12.033 0 0 0 6-10.392V34.517a12.034 12.034 0 0 0-6-10.393ZM94 79.55a4 4 0 0 1-2 3.464l-39 22.517a4 4 0 0 1-4 0L10 83.014a4 4 0 0 1-2-3.464V34.517a4 4 0 0 1 2-3.464L49 8.536a4 4 0 0 1 4 0l39 22.517a4 4 0 0 1 2 3.464V79.55Z" />
            <path
              d="M74.022 70.071h-2.866a4 4 0 0 0-1.925.494L51.95 80.05 32 68.531V45.554l19.95-11.519 17.29 9.455a4 4 0 0 0 1.919.49h2.863a2 2 0 0 0 2-2v-2.71a2 2 0 0 0-1.04-1.756L55.793 27.02a8.04 8.04 0 0 0-7.843.09L28 38.626a8.025 8.025 0 0 0-4 6.929V68.53a8 8 0 0 0 4 6.928l19.95 11.519a8.043 8.043 0 0 0 7.843.088l19.19-10.532a2 2 0 0 0 1.038-1.753v-2.71a2 2 0 0 0-2-2Z" />
            <g transform="translate(118 33)">
              <path
                d="M50.745.428c-8.28.01-14.99 6.72-15 15v17.277c0 8.285 6.715 15 15 15 8.284 0 15-6.715 15-15V15.428c-.01-8.28-6.72-14.99-15-15Zm7 32.277a7 7 0 0 1-14 0V15.428a7 7 0 0 1 14 0v17.277ZM14.079 8.488a7.01 7.01 0 0 1 7.868 6.075.99.99 0 0 0 .984.865h6.03a1.01 1.01 0 0 0 1-1.097C29.354 6.206 22.38.046 14.243.447 6.161 1-.086 7.762 0 15.864V32.27c-.087 8.101 6.161 14.864 14.244 15.416 8.137.401 15.11-5.759 15.716-13.883a1.01 1.01 0 0 0-.999-1.098h-6.03a.99.99 0 0 0-.985.865 7.01 7.01 0 0 1-7.868 6.076A7.164 7.164 0 0 1 8 32.461V15.672a7.164 7.164 0 0 1 6.079-7.184ZM96.922 27.994a12.158 12.158 0 0 0 7.184-11.077v-3.7c0-6.71-5.44-12.15-12.149-12.15H75a1 1 0 0 0-1 1v44a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-17h6.621l7.916 17.413a1 1 0 0 0 .91.587h6.591a1 1 0 0 0 .91-1.414l-8.026-17.659Zm-.816-11.077a4.154 4.154 0 0 1-4.148 4.15h-9.852v-12h9.852a4.154 4.154 0 0 1 4.148 4.15v3.7ZM139 1.067h-26a1 1 0 0 0-1 1v44a1 1 0 0 0 1 1h26a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1h-19v-12h13a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1h-13v-10h19a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1ZM177 1.067h-6a1 1 0 0 0-1 1v22.647a7.007 7.007 0 1 1-14 0V2.067a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v22.647a15.003 15.003 0 1 0 30 0V2.067a1 1 0 0 0-1-1Z" />
              <rect width="8" height="38" x="186" y="1.067" rx="1" />
            </g>
          </g>
        </svg>
        <svg role="img" aria-label="CoreUI Logo Signet" class="sidebar-brand-narrow" width="88" height="32"
          xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 102 115">
          <g style="fill: currentColor">
            <path
              d="M96 24.124 57 1.608a12 12 0 0 0-12 0L6 24.124a12.034 12.034 0 0 0-6 10.393V79.55a12.033 12.033 0 0 0 6 10.392l39 22.517a12 12 0 0 0 12 0l39-22.517a12.033 12.033 0 0 0 6-10.392V34.517a12.034 12.034 0 0 0-6-10.393ZM94 79.55a4 4 0 0 1-2 3.464l-39 22.517a4 4 0 0 1-4 0L10 83.014a4 4 0 0 1-2-3.464V34.517a4 4 0 0 1 2-3.464L49 8.536a4 4 0 0 1 4 0l39 22.517a4 4 0 0 1 2 3.464V79.55Z" />
            <path
              d="M74.022 70.071h-2.866a4 4 0 0 0-1.925.494L51.95 80.05 32 68.531V45.554l19.95-11.519 17.29 9.455a4 4 0 0 0 1.919.49h2.863a2 2 0 0 0 2-2v-2.71a2 2 0 0 0-1.04-1.756L55.793 27.02a8.04 8.04 0 0 0-7.843.09L28 38.626a8.025 8.025 0 0 0-4 6.929V68.53a8 8 0 0 0 4 6.928l19.95 11.519a8.043 8.043 0 0 0 7.843.088l19.19-10.532a2 2 0 0 0 1.038-1.753v-2.71a2 2 0 0 0-2-2Z" />
          </g>
        </svg>
      </div>
      <button class="btn-close d-lg-none" type="button" data-coreui-theme="dark" aria-label="Close"
        onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()"></button>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
      <li class="nav-item">
        <a class="nav-link" href="/StokTakip/Pages/default.php">Anasayfa</a>
      </li>

      <!-- Menü Yönetimi -->
      <li class="nav-title">Menü Yönetimi</li>
      <li class="nav-item"></li>

      <!-- Kullanıcı Yönetimi Menüsü -->
      <li class="nav-group">
        <a class="nav-link nav-group-toggle" href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
  <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
</svg>
         Kullanıcı Yönetimi
        </a>
        <ul class="nav-group-items compact">
          <li class="nav-item">
            <a class="nav-link" href="<?= URL ?>/Pages/page_kullanicilar.php">
              <span class="nav-icon"><span class="nav-icon-bullet"></span></span>
              Kullanıcı Listesi
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= URL ?>/Pages/page_kullaniciekle.php">
              <span class="nav-icon"><span class="nav-icon-bullet"></span></span>
              Kullanıcı Ekle
            </a>
        </ul>
      </li>

      <!-- Ürün Yönetimi Menüsü -->
      <li class="nav-group">
  
  <a class="nav-link nav-group-toggle" href="javascript:void(0);">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bucket" viewBox="0 0 16 16">
  <path d="M2.522 5H2a.5.5 0 0 0-.494.574l1.372 9.149A1.5 1.5 0 0 0 4.36 16h7.278a1.5 1.5 0 0 0 1.483-1.277l1.373-9.149A.5.5 0 0 0 14 5h-.522A5.5 5.5 0 0 0 2.522 5m1.005 0a4.5 4.5 0 0 1 8.945 0zm9.892 1-1.286 8.574a.5.5 0 0 1-.494.426H4.36a.5.5 0 0 1-.494-.426L2.58 6h10.838z"/>
</svg>
      Ürün Yönetimi
  </a>
  
  <ul class="nav-group-items">
      <li class="nav-item">
        <a class="nav-link" href="<?= URL ?>/Pages/page_urunler.php">
            <span class="nav-icon"><span class="nav-icon-bullet"></span></span>
            Ürün Listesi
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= URL ?>/Pages/page_urunekle.php">
            <span class="nav-icon"><span class="nav-icon-bullet"></span></span>
            Ürün Ekle
        </a>
      </li>
  </ul>

    <!--Kategori Yönetimi Menüsü -->
    <li class="nav-group">
  
  <a class="nav-link nav-group-toggle" href="javascript:void(0);">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tags" viewBox="0 0 16 16">
  <path d="M3 2v4.586l7 7L14.586 9l-7-7zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586z"/>
  <path d="M5.5 5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3M1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1z"/>
</svg>
      Kategori Yönetimi
  </a>
  
  <ul class="nav-group-items">
      <li class="nav-item">
        <a class="nav-link" href="/StokTakip/login.php?do=kategoriler">
            <span class="nav-icon"><span class="nav-icon-bullet"></span></span>
            Kategori Listesi
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= URL ?>/Pages/page_kategoriekle.php">
            <span class="nav-icon"><span class="nav-icon-bullet"></span></span>
            Kategori Ekle
        </a>
      </li>
  </ul>
  
</li>

    <!--Stok Hareketleri Menüsü -->
    
    <li class="nav-group">
  
  <a class="nav-link nav-group-toggle" href="javascript:void(0);">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
  <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.426L5.596 5 8 5.961 14.154 3.5zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z"/>
</svg> 
      Stok Hareketleri
  </a>
  
  <ul class="nav-group-items">
      <li class="nav-item">
        <a class="nav-link" href="/StokTakip/login.php?do=stokHareketleri">
            <span class="nav-icon"><span class="nav-icon-bullet"></span></span>
            Stok Hareketleri Listesi
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/StokTakip/login.php?do=stokHareketleriekle">
            <span class="nav-icon"><span class="nav-icon-bullet"></span></span>
            Stok Hareketi Ekle
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/StokTakip/login.php?do=hareketGecmisi">
            <span class="nav-icon"><span class="nav-icon-bullet"></span></span>
            Hareket Geçmişini Görüntüle
        </a>
      </li>
  </ul>
  
</li>
<!-- Raporlar Menüsü -->
<li class="nav-item">
  <a class="nav-link" href="/StokTakip/login.php?do=raporlar">
    <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
      <path fill="var(--ci-primary-color, currentColor)" 
        d="M496 496H16V16h32v448h448zM96 416V208h64v208zm112 0V96h64v320zm112 0V288h64v128z"/>
    </svg>
    Raporlar
  </a>
</li>
  
</li>


            </ul>
          </li>
        </ul>
      </li>
      
      
      
    </ul>
    <div class="sidebar-footer border-top d-none d-md-flex">
      <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>
  </div>
  <div class="wrapper d-flex flex-column min-vh-100">
    <header class="header header-sticky p-0 mb-4">
      <div class="container-fluid border-bottom px-4">
        <button class="header-toggler" type="button"
          onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()"
          style="margin-inline-start: -14px">
          <svg class="icon icon-lg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path fill="var(--ci-primary-color, currentcolor)" d="M80 96h352v32H80zm0 144h352v32H80zm0 144h352v32H80z"
              class="ci-primary" />
          </svg>
        </button>
        <ul class="header-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="/Pages/page_guvenlicikis.php">
              <svg class="icon icon-lg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="var(--ci-primary-color, currentcolor)"
                  d="m450.27 348.569-43.67-80.624V184c0-83.813-68.187-152-152-152s-152 68.187-152 152v83.945l-43.672 80.623A24 24 0 0 0 80.031 384h86.935a89 89 0 0 0-.367 8 88 88 0 0 0 176 0c0-2.7-.129-5.364-.367-8h86.935a24 24 0 0 0 21.1-35.431ZM310.6 392a56 56 0 1 1-111.419-8h110.837a56 56 0 0 1 .582 8M93.462 352l41.138-75.945V184a120 120 0 0 1 240 0v92.055L415.736 352Z"
                  class="ci-primary" />
              </svg>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <svg class="icon icon-lg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="var(--ci-primary-color, currentcolor)"
                  d="M136 24H16v120h120Zm-32 88H48V56h56Zm32 88H16v120h120Zm-32 88H48v-56h56Zm32 88H16v120h120Zm-32 88H48v-56h56Zm72-440.002h320v32H176zm0 88h256v32H176zm0 88h320v32H176zm0 88h256v32H176zm0 176h256v32H176zm0-88h320v32H176z"
                  class="ci-primary" />
              </svg>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <svg class="icon icon-lg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="var(--ci-primary-color, currentcolor)"
                  d="M274.6 25.623a32.01 32.01 0 0 0-37.2 0L16 183.766V496h480V183.766ZM464 402.693 339.97 322.96 464 226.492ZM256 51.662 454.429 193.4 311.434 304.615 256 268.979l-55.434 35.636L57.571 193.4ZM48 226.492l124.03 96.468L48 402.693ZM464 464H48v-23.265l208-133.714 208 133.714Z"
                  class="ci-primary" />
              </svg>
            </a>
          </li>
        </ul>
        <ul class="header-nav">
          <li class="nav-item py-1">
            <div class="vr h-100 mx-2 text-body text-opacity-75"></div>
          </li>
          <li class="nav-item dropdown">
            <button class="btn btn-link nav-link py-2 px-2 d-flex align-items-center" type="button"
              aria-expanded="false" data-coreui-toggle="dropdown">
              <svg class="icon icon-lg theme-icon-active" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="var(--ci-primary-color, currentcolor)"
                  d="M256 16C123.452 16 16 123.452 16 256s107.452 240 240 240 240-107.452 240-240S388.548 16 256 16m-22 446.849a208.35 208.35 0 0 1-169.667-125.9c-.364-.859-.706-1.724-1.057-2.587L234 429.939Zm0-69.582L50.889 290.76A210 210 0 0 1 48 256q0-9.912.922-19.67L234 339.939Zm0-90L54.819 202.96a206 206 0 0 1 9.514-27.913Q67.1 168.5 70.3 162.191L234 253.934Zm0-86.015L86.914 134.819a209.4 209.4 0 0 1 22.008-25.9q3.72-3.72 7.6-7.228L234 166.027Zm0-87.708-89.648-49.093A206.95 206.95 0 0 1 234 49.151ZM464 256a207.775 207.775 0 0 1-198 207.761V48.239A207.79 207.79 0 0 1 464 256"
                  class="ci-primary" />
              </svg>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" style="--cui-dropdown-min-width: 8rem">
              <li>
                <button class="dropdown-item d-flex align-items-center" type="button" data-coreui-theme-value="light">
                  <svg class="icon icon-lg me-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="var(--ci-primary-color, currentcolor)"
                      d="M256 104c-83.813 0-152 68.187-152 152s68.187 152 152 152 152-68.187 152-152-68.187-152-152-152m0 272a120 120 0 1 1 120-120 120.136 120.136 0 0 1-120 120M240 16h32v48h-32zm0 432h32v48h-32zm208-208h48v32h-48zm-432 0h48v32H16zm372.687 171.314 22.627-22.627 32 32-22.627 22.627zm-320-320 22.628-22.628 32 32-22.628 22.628zm-.002 329.375 32-32 22.628 22.626-32 32zm320.002-320.003 32-32 22.628 22.628-32 32z"
                      class="ci-primary" />
                  </svg>
                  Light
                </button>
              </li>
              <li>
                <button class="dropdown-item d-flex align-items-center" type="button" data-coreui-theme-value="dark">
                  <svg class="icon icon-lg me-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="var(--ci-primary-color, currentcolor)"
                      d="M268.279 496c-67.574 0-130.978-26.191-178.534-73.745S16 311.293 16 243.718A252.25 252.25 0 0 1 154.183 18.676a24.44 24.44 0 0 1 34.46 28.958 220.12 220.12 0 0 0 54.8 220.923A218.75 218.75 0 0 0 399.085 333.2a220.2 220.2 0 0 0 65.277-9.846 24.439 24.439 0 0 1 28.959 34.461A252.26 252.26 0 0 1 268.279 496M153.31 55.781A219.3 219.3 0 0 0 48 243.718C48 365.181 146.816 464 268.279 464a219.3 219.3 0 0 0 187.938-105.31 253 253 0 0 1-57.13 6.513 250.54 250.54 0 0 1-178.268-74.016 252.15 252.15 0 0 1-67.509-235.4Z"
                      class="ci-primary" />
                  </svg>
                  Dark
                </button>
              </li>
              <li>
                <button class="dropdown-item d-flex align-items-center active" type="button"
                  data-coreui-theme-value="auto">
                  <svg class="icon icon-lg me-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="var(--ci-primary-color, currentcolor)"
                      d="M256 16C123.452 16 16 123.452 16 256s107.452 240 240 240 240-107.452 240-240S388.548 16 256 16m-22 446.849a208.35 208.35 0 0 1-169.667-125.9c-.364-.859-.706-1.724-1.057-2.587L234 429.939Zm0-69.582L50.889 290.76A210 210 0 0 1 48 256q0-9.912.922-19.67L234 339.939Zm0-90L54.819 202.96a206 206 0 0 1 9.514-27.913Q67.1 168.5 70.3 162.191L234 253.934Zm0-86.015L86.914 134.819a209.4 209.4 0 0 1 22.008-25.9q3.72-3.72 7.6-7.228L234 166.027Zm0-87.708-89.648-49.093A206.95 206.95 0 0 1 234 49.151ZM464 256a207.775 207.775 0 0 1-198 207.761V48.239A207.79 207.79 0 0 1 464 256"
                      class="ci-primary" />
                  </svg>
                  Auto
                </button>
              </li>
            </ul>
          </li>
          <li class="nav-item py-1">
            <div class="vr h-100 mx-2 text-body text-opacity-75"></div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link py-0 pe-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true"
              aria-expanded="false">
              <div class="avatar avatar-md"><img class="avatar-img" src="assets/img/avatars/8.jpg" alt="user@email.com">
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end pt-0">
              <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold rounded-top mb-2">Account
              </div>
              <a class="dropdown-item" href="#">
                <svg class="icon me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <path fill="var(--ci-primary-color, currentcolor)"
                    d="m450.27 348.569-43.67-80.624V184c0-83.813-68.187-152-152-152s-152 68.187-152 152v83.945l-43.672 80.623A24 24 0 0 0 80.031 384h86.935a89 89 0 0 0-.367 8 88 88 0 0 0 176 0c0-2.7-.129-5.364-.367-8h86.935a24 24 0 0 0 21.1-35.431ZM310.6 392a56 56 0 1 1-111.419-8h110.837a56 56 0 0 1 .582 8M93.462 352l41.138-75.945V184a120 120 0 0 1 240 0v92.055L415.736 352Z"
                    class="ci-primary" />
                </svg>
                Updates
                <span class="badge badge-sm bg-info ms-2">8</span>
              </a>
              <a class="dropdown-item" href="#">
                <svg class="icon me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <path fill="var(--ci-primary-color, currentcolor)"
                    d="M274.6 25.623a32.01 32.01 0 0 0-37.2 0L16 183.766V496h480V183.766ZM464 402.693 339.97 322.96 464 226.492ZM256 51.662 454.429 193.4 311.434 304.615 256 268.979l-55.434 35.636L57.571 193.4ZM48 226.492l124.03 96.468L48 402.693ZM464 464H48v-23.265l208-133.714 208 133.714Z"
                    class="ci-primary" />
                </svg>
                Messages
                <span class="badge badge-sm bg-success ms-2">42</span>
              </a>
              <a class="dropdown-item" href="#">
                <svg class="icon me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <path fill="var(--ci-primary-color, currentcolor)"
                    d="m222.085 235.644-62.01-62.01L81.8 251.905l62.009 62.01-.04.04 66.958 66.957 11.354 11.275.04.039 66.957-66.957 11.273-11.354 202.277-202.271-78.272-78.271Zm44.33 66.958-11.274 11.353-33.057 33.056-.04-.039-33.017-33.017.04-.04-62.009-62.01 33.016-33.016 62.01 62.009L424.356 78.627l33.017 33.017Z"
                    class="ci-primary" />
                  <path fill="var(--ci-primary-color, currentcolor)"
                    d="M448 464H48V64h300.22l32-32H16v464h464V179.095l-32 32z" class="ci-primary" />
                </svg>
                Tasks
              </a>
              <a class="dropdown-item" href="#">
                <svg class="icon me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <path fill="var(--ci-primary-color, currentcolor)"
                    d="M496 496h-47.229l-69.522-128H40a24.03 24.03 0 0 1-24-24V40a24.03 24.03 0 0 1 24-24h432a24.03 24.03 0 0 1 24 24ZM48 336h350.284L464 456.993V48H48Z"
                    class="ci-primary" />
                </svg>
                Comments
              </a>
              <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold my-2">
                <div class="fw-semibold">Settings</div>
              </div>
              <a class="dropdown-item" href="#">
                <svg class="icon me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <path fill="var(--ci-primary-color, currentcolor)"
                    d="m411.6 343.656-72.823-47.334 27.455-50.334A80.2 80.2 0 0 0 376 207.681V128a112 112 0 0 0-224 0v79.681a80.24 80.24 0 0 0 9.768 38.308l27.455 50.333-72.823 47.334A79.72 79.72 0 0 0 80 410.732V496h368v-85.268a79.73 79.73 0 0 0-36.4-67.076M416 464H112v-53.268a47.84 47.84 0 0 1 21.841-40.246l97.66-63.479-41.64-76.341A48.15 48.15 0 0 1 184 207.681V128a80 80 0 0 1 160 0v79.681a48.15 48.15 0 0 1-5.861 22.985L296.5 307.007l97.662 63.479A47.84 47.84 0 0 1 416 410.732Z"
                    class="ci-primary" />
                </svg>
                Profile
              </a>
              <a class="dropdown-item" href="#">
                <svg class="icon me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <path fill="var(--ci-primary-color, currentcolor)"
                    d="M245.151 168a88 88 0 1 0 88 88 88.1 88.1 0 0 0-88-88m0 144a56 56 0 1 1 56-56 56.063 56.063 0 0 1-56 56"
                    class="ci-primary" />
                  <path fill="var(--ci-primary-color, currentcolor)"
                    d="m464.7 322.319-31.77-26.153a193.1 193.1 0 0 0 0-80.332l31.77-26.153a19.94 19.94 0 0 0 4.606-25.439l-32.612-56.483a19.936 19.936 0 0 0-24.337-8.73l-38.561 14.447a192 192 0 0 0-69.54-40.192l-6.766-40.571A19.936 19.936 0 0 0 277.762 16H212.54a19.94 19.94 0 0 0-19.728 16.712l-6.762 40.572a192 192 0 0 0-69.54 40.192L77.945 99.027a19.94 19.94 0 0 0-24.334 8.731L21 164.245a19.94 19.94 0 0 0 4.61 25.438l31.767 26.151a193.1 193.1 0 0 0 0 80.332l-31.77 26.153A19.94 19.94 0 0 0 21 347.758l32.612 56.483a19.94 19.94 0 0 0 24.337 8.73l38.562-14.447a192 192 0 0 0 69.54 40.192l6.762 40.571A19.94 19.94 0 0 0 212.54 496h65.222a19.936 19.936 0 0 0 19.728-16.712l6.763-40.572a192 192 0 0 0 69.54-40.192l38.564 14.449a19.94 19.94 0 0 0 24.334-8.731l32.609-56.487a19.94 19.94 0 0 0-4.6-25.436m-50.636 57.12-48.109-18.024-7.285 7.334a159.96 159.96 0 0 1-72.625 41.973l-10 2.636L267.6 464h-44.89l-8.442-50.642-10-2.636a159.96 159.96 0 0 1-72.625-41.973l-7.285-7.334-48.117 18.024L53.8 340.562l39.629-32.624-2.7-9.973a160.9 160.9 0 0 1 0-83.93l2.7-9.972L53.8 171.439l22.446-38.878 48.109 18.024 7.285-7.334a159.96 159.96 0 0 1 72.625-41.973l10-2.636L222.706 48H267.6l8.442 50.642 10 2.636a159.96 159.96 0 0 1 72.625 41.973l7.285 7.334 48.109-18.024 22.447 38.877-39.629 32.625 2.7 9.972a160.9 160.9 0 0 1 0 83.93l-2.7 9.973 39.629 32.623Z"
                    class="ci-primary" />
                </svg>
                Settings
              </a>
              <a class="dropdown-item" href="#">
                <svg class="icon me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <path fill="var(--ci-primary-color, currentcolor)"
                    d="M472 72H40a24.03 24.03 0 0 0-24 24v320a24.03 24.03 0 0 0 24 24h432a24.03 24.03 0 0 0 24-24V96a24.03 24.03 0 0 0-24-24m-8 32v64H48v-64ZM48 408V232h416v176Z"
                    class="ci-primary" />
                  <path fill="var(--ci-primary-color, currentcolor)" d="M88 312h64v32H88zm96 0h64v32h-64z"
                    class="ci-primary" />
                </svg>
                Payments
              </a>
              <a class="dropdown-item" href="#">
                <svg class="icon me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <path fill="var(--ci-primary-color, currentcolor)"
                    d="M334.627 16H48v480h424V153.373ZM440 166.627V168H320V48h1.373ZM80 464V48h208v152h152v264Z"
                    class="ci-primary" />
                </svg>
                Projects
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">
                <svg class="icon me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <path fill="var(--ci-primary-color, currentcolor)"
                    d="M384 200v-56a128 128 0 0 0-256 0v56H88v128c0 92.635 75.364 168 168 168s168-75.365 168-168V200Zm-224-56a96 96 0 0 1 192 0v56H160Zm232 184c0 74.99-61.01 136-136 136s-136-61.01-136-136v-96h272Z"
                    class="ci-primary" />
                </svg>
                Lock Account
              </a>
              <a class="dropdown-item" href="/authentication/login.html">
                <svg class="icon me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <path fill="var(--ci-primary-color, currentcolor)"
                    d="M77.155 272.034H351.75v-32.001H77.155l75.053-75.053v-.001l-22.628-22.626-113.681 113.68.001.001h-.001L129.58 369.715l22.628-22.627v-.001z"
                    class="ci-primary" />
                  <path fill="var(--ci-primary-color, currentcolor)" d="M160 16v32h304v416H160v32h336V16z"
                    class="ci-primary" />
                </svg>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </div>
      <div class="container-fluid px-4">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0">
            <li class="breadcrumb-item"><a href="/Pages/default.php">Home</a></li>
            <li class="breadcrumb-item active"><span>Dashboard</span></li>
          </ol>
        </nav>
      </div>
    </header>