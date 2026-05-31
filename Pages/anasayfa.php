<?php require_once(__DIR__ . "/../Sistem/header.php");?>

  <style>
    /* Kartların aşağıdan yukarı doğru sırayla gelmesi için */
    .fade-up-card {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeUpAnim 0.8s ease-out forwards;
    }
    @keyframes fadeUpAnim {
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Progress barların yumuşakça dolması için */
    .animasyonlu-bar {
        transition: width 1.5s ease-in-out;
    }

    /* Dikey Progress Bar Konteyneri */
.progress-vertical {
    display: flex;
    flex-direction: column-reverse; /* İçeriği alttan başlatır */
    width: 16px; /* Barın kalınlığı */
    height: 300px; /* Grafiğin toplam yüksekliği */
    border-radius: 50px; /* Köşeleri yumuşatır */
    background-color: rgba(255, 255, 255, 0.05); /* Arka plan izi */
    margin: 0 auto;
}

/* Yükseklik Animasyonu */
.animasyonlu-dikey-bar {
    width: 100%;
    border-radius: 50px;
    transition: height 1.5s ease-in-out;
}

/* Şık ve Minimalist Renk Paleti */
.bg-bordeaux { background-color: #800020; }
.bg-beige { background-color: #D5C4A1; }
.bg-elegant-white { background-color: #EAEAEA; }
.bg-slate { background-color: #6C757D; }
</style>

<div class="container-fluid ">
<h3 class="mb-0 text-primary">Sisteme Hoş Geldiniz</h3>
<p class="text-muted">Lütfen işleme başlamak için sol taraftaki menüyü kullanın.</p>
<?php $istatistikler = $code->metrikler(); ?>
    <div class="body flex-grow-1">
      <div class="container-lg px-4">
        <div class="row g-4 mb-4">
          <div class="col-sm-6 col-xl-3">

          <!-- Kullanıcılar -->
            <div class="card text-white bg-primary" style="overflow:hidden; position:relative;">
              <div class="card-body pb-0">
                <div class="fs-4 fw-semibold"><?php echo $istatistikler->aktif_kullanici; ?></div>
                <div>Toplam Kullanıcı</div>
              </div>
              <div class="c-chart-wrapper mt-3 mx-3" style="height:70px">
                <canvas class="chart" id="card-chart1" height="70"></canvas>
              </div>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                   style="width:80px;height:80px;opacity:0.15;position:absolute;bottom:-10px;right:-5px;">
                <path fill="white" d="M256 288a112 112 0 1 0-112-112 112.127 112.127 0 0 0 112 112Zm0-192a80 80 0 1 1-80 80 80.091 80.091 0 0 1 80-80Zm112 224H144A144.162 144.162 0 0 0 0 464v16h32v-16a112.127 112.127 0 0 1 112-112h224a112.127 112.127 0 0 1 112 112v16h32v-16a144.162 144.162 0 0 0-144-144Z"/>
              </svg>
            </div>
          </div>

  <!-- Kategoriler -->
  <div class="col-sm-6 col-xl-3">
    <div class="card text-white bg-info" style="overflow:hidden; position:relative;">
      <div class="card-body pb-0">
        <div class="fs-4 fw-semibold"><?php echo $istatistikler->toplam_kategori; ?></div>
        <div>Toplam Kategori</div>
      </div>
      <div class="c-chart-wrapper mt-3 mx-3" style="height:70px">
        <canvas class="chart" id="card-chart2" height="70"></canvas>
      </div>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
           style="width:80px;height:80px;opacity:0.15;position:absolute;bottom:-10px;right:-5px;">
        <path fill="white" d="M448 48H296L261.657 12H64A16.019 16.019 0 0 0 48 28v456a16.019 16.019 0 0 0 16 16h384a16.019 16.019 0 0 0 16-16V64a16.019 16.019 0 0 0-16-16Zm-16 424H80V44h168.343L282.687 80H432Z"/>
        <path fill="white" d="M176 240h160v32H176zm0 80h160v32H176zm0-160h160v32H176z"/>
      </svg>
    </div>
  </div>

  <!-- Ürünler -->
  <div class="col-sm-6 col-xl-3">
    <div class="card text-white bg-warning" style="overflow:hidden; position:relative;">
      <div class="card-body pb-0">
        <div class="fs-4 fw-semibold"><?php echo $istatistikler->toplam_urun; ?></div>
        <div>Toplam Ürün</div>
      </div>
      <div class="c-chart-wrapper mt-3" style="height:70px">
        <canvas class="chart" id="card-chart3" height="70"></canvas>
      </div>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
           style="width:80px;height:80px;opacity:0.15;position:absolute;bottom:-10px;right:-5px;">
        <path fill="white" d="M480 192H352V64a32.036 32.036 0 0 0-32-32H64A32.036 32.036 0 0 0 32 64v256a32.036 32.036 0 0 0 32 32h32v96a32.036 32.036 0 0 0 32 32h320a32.036 32.036 0 0 0 32-32V224a32.036 32.036 0 0 0-32-32ZM64 320V64h256v128H160a32.036 32.036 0 0 0-32 32v96Zm416 128H160V224h320Z"/>
      </svg>
    </div>
  </div>

  <!-- Hareket -->
  <div class="col-sm-6 col-xl-3">
    <div class="card text-white bg-danger" style="overflow:hidden; position:relative;">
      <div class="card-body pb-0">
        <div class="fs-4 fw-semibold"><?php echo $istatistikler->guncel_hareket; ?></div>
        <div>Güncel Hareket Durumu</div>
      </div>
      <div class="c-chart-wrapper mt-3 mx-3" style="height:70px">
        <canvas class="chart" id="card-chart4" height="70"></canvas>
      </div>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
           style="width:80px;height:80px;opacity:0.15;position:absolute;bottom:-10px;right:-5px;">
        <path fill="white" d="M112 160h288v32H112zm0 80h208v32H112zm0 80h288v32H112zM480 32H32A32.036 32.036 0 0 0 0 64v384a32.036 32.036 0 0 0 32 32h448a32.036 32.036 0 0 0 32-32V64a32.036 32.036 0 0 0-32-32Zm0 416H32V64h448Z"/>
      </svg>
    </div>
  </div>

</div>
              <div class="c-chart-wrapper mt-3 mx-3" style="height: 70px">
                <canvas class="chart" id="card-chart4" height="70"></canvas>
              </div>
            </div>
          </div>
          <!-- /.col-->
        </div>
        <!-- /.row-->

        <!-- tarihsel grafik -->

        <?php 
				
					$tarih=date("Y-m-d");
					
					$gunler=array(
							'Monday'=>'Pazartesi',
							'Tuesday'=>'Salı',
							'Wednesday'=>'Çarşamba',
							'Thursday'=>'Perşembe',
							'Friday'=>'Cuma',
							'Saturday'=>'Cumartesi',
							'Sunday'=>'Pazar'
							
					);
					
					$gunIngilizce=date("l", strtotime($tarih));
					$bugun=$gunler[$gunIngilizce];
				?>
        <div class="card mb-4">
          <div class="card-body p-2">
            <div class="d-flex justify-content-between">
              <div>
                <h4 class="card-title mb-0">İstatistikler</h4>
                <div class="small text-body-secondary"><?php echo $bugun; ?>, <?php echo $tarih; ?></div>
              </div>
              <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">

              </div>
            </div>
            
          </div>

            <!--progress bar -->

          <div class="card-footer">
            <?php $istatistikler = $code->metrikler(); ?>
            <div class="row text-center" style="height: 425px;">
              <div class="d-flex justify-content-around text-center" style="border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 20px;">

        <div class="fade-up-card" style="animation-delay: 0.1s; width: 100px;">
            <div class="fw-bold fs-3 mb-3 sayac" data-hedef="<?php echo $istatistikler->aktif_kullanici; ?>">0</div>
            <div class="progress-vertical">
                <?php $yuzdeKullanici = ($istatistikler->aktif_kullanici > 0) ? ($istatistikler->aktif_kullanici / 50) * 100 : 0; ?>
                <div class="progress-bar bg-success animasyonlu-dikey-bar" role="progressbar" data-height="<?php echo $yuzdeKullanici; ?>%" style="height: 0%"></div>
            </div>
            <div class="text-body-secondary mt-3 small">Aktif Kullanıcı</div>
        </div>

        <div class="fade-up-card" style="animation-delay: 0.3s; width: 100px;">
            <div class="fw-bold fs-3 mb-3 sayac" data-hedef="<?php echo $istatistikler->toplam_yonetici; ?>">0</div>
            <div class="progress-vertical">
                <?php $yuzdeYonetici = ($istatistikler->toplam_yonetici > 0) ? ($istatistikler->toplam_yonetici / 50) * 100 : 0; ?>
                <div class="progress-bar bg-bordeaux animasyonlu-dikey-bar" role="progressbar" data-height="<?php echo $yuzdeYonetici; ?>%" style="height: 0%"></div>
            </div>
            <div class="text-body-secondary mt-3 small">Yöneticiler</div>
        </div>

        <div class="fade-up-card" style="animation-delay: 0.5s; width: 100px;">
            <div class="fw-bold fs-3 mb-3 sayac" data-hedef="<?php echo $istatistikler->toplam_kategori; ?>">0</div>
            <div class="progress-vertical">
                <?php $yuzdeKategori = ($istatistikler->toplam_kategori > 0) ? ($istatistikler->toplam_kategori / 50) * 100 : 0; ?>
                <div class="progress-bar bg-beige animasyonlu-dikey-bar" role="progressbar" data-height="<?php echo $yuzdeKategori; ?>%" style="height: 0%"></div>
            </div>
            <div class="text-body-secondary mt-3 small">Kategoriler</div>
        </div>

        <div class="fade-up-card" style="animation-delay: 0.7s; width: 100px;">
            <div class="fw-bold fs-3 mb-3 sayac" data-hedef="<?php echo $istatistikler->toplam_urun; ?>">0</div>
            <div class="progress-vertical">
                <?php $yuzdeUrun = ($istatistikler->toplam_urun > 0) ? ($istatistikler->toplam_urun / 50) * 100 : 0; ?>
                <div class="progress-bar bg-slate animasyonlu-dikey-bar" role="progressbar" data-height="<?php echo $yuzdeUrun; ?>%" style="height: 0%"></div>
            </div>
            <div class="text-body-secondary mt-3 small">Ürünler</div>
        </div>

    </div>
    </div>
            </div>
          </div>
        </div>

      </div>