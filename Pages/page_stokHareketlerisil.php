<?php
if($code->user->kullanici_rutbe != 7){

?>
<div class="alert alert-danger">Yetkisiz işlem! Log kayıtlarınız yöneticiye bildirilmiştir.</div>
<?php
go("login.php?do=anasayfa",3);
exit;
}


  $girilenHareket=temizle($_GET["hareket_id"]);
  $girilenHareket= (int) $girilenHareket;
  $sil=$code->silStokHareketi($girilenHareket);
?>

<div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0">Stok Hareketleri</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="login.php?do=anasayfa">Anasayfa</a></li>
                  <li class="breadcrumb-item " aria-current="page">Stok Hareketleri</li>
                  <li class="breadcrumb-item active " aria-current="page"><a href="login.php?do=stokHareketleri">Stok Hareketleri Listesi</a></li>
                  <li class="breadcrumb-item " aria-current="page">Stok Hareketi Sil</li>
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
            <div class="alert alert-success">Stok Hareketi başarılı bir şekilde silinmiştir.Lütfen bekleyiniz, yönlendiriliyorsunuz...</div>
            <?php 
              go("Login.php?do=stokHareketleri",3);
            }else{ ?>
            <div class="alert alert-danger">Hata ! Stok Hareketi silinememiştir. Lütfen tekrar deneyiniz.</div>
            <?php } ?>
</div>
</div>
</div>
