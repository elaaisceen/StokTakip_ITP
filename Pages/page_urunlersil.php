<?php

require_once __DIR__ . '/../Sistem/fonksiyon.php';

if($code->user->kullanici_rutbe != 7){

?>
<div class="alert alert-danger">Yetkisiz işlem! Log kayıtlarınız yöneticiye bildirilmiştir.</div>
<?php
go("login.php?do=anasayfa",3);
exit;
}


  $gelenUrun=temizle($_GET["urun_id"]);
  $gelenUrun= (int) $gelenUrun;
  $sil=$code->silUrunler($gelenUrun);

  

?>

<div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0">Ürünler</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="login.php?do=anasayfa">Anasayfa</a></li>
                  <li class="breadcrumb-item " aria-current="page">Ürünler</li>
                  <li class="breadcrumb-item active " aria-current="page"><a href="login.php?do=urunler">Ürünler Listesi</a></li>
                  <li class="breadcrumb-item " aria-current="page">Ürünler Sil</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
          <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <?php if ($sil){ ?>
            <div class="alert alert-success">Ürün başarılı bir şekilde silinmiştir.Lütfen bekleyiniz, yönlendiriliyorsunuz...</div>
            <?php 
              go("Login.php?do=urunler",3);
            }else{ ?>
            <div class="alert alert-danger">Hata ! Ürün silinememiştir. Lütfen tekrar deneyiniz.</div>
            <?php } ?>
</div>
</div>
</div>