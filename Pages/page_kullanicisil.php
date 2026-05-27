<?php

include("../databaseConnection.php"); // session_start() zaten içinde
include("../fonsiyon.php");


if($code->user->kullanici_rutbe != 7){

?>
<div class="alert alert-danger">Yetkisiz işlem! Log kayıtlarınız yöneticiye bildirilmiştir.</div>
<?php
go("login.php?do=anasayfa",3);
exit;
}


  $gelenKullanici=temizle($_GET["kullanici_id"]);
  $gelenKullanici= (int) $gelenKullanici;
  $sil=$code->silKullanicilar($gelenKullanici);

  

?>

<div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0">Kullanıcılar</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="login.php?do=anasayfa">Anasayfa</a></li>
                  <li class="breadcrumb-item " aria-current="page">Kullanıcılar</li>
                  <li class="breadcrumb-item active " aria-current="page"><a href="login.php?do=kullanicilar">Kullanıcıların Listesi</a></li>
                  <li class="breadcrumb-item " aria-current="page">Kullanıcılar Sil</li>
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
            <div class="alert alert-success">Kullanıcı başarılı bir şekilde silinmiştir.Lütfen bekleyiniz, yönlendiriliyorsunuz...</div>
            <?php 
              go("Login.php?do=kullanicilar",3);
            }else{ ?>
            <div class="alert alert-danger">Hata ! Kullanııcı silinememiştir. Lütfen tekrar deneyiniz.</div>
            <?php } ?>
</div>
</div>
</div>