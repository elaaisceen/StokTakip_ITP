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
$gelenSatir=$code->getirStokHareketlerini($girilenHareket);



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
                  <li class="breadcrumb-item " aria-current="page">Stok Hareketleri Düzenle</li>
                  
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
               <!--begin::Quick Example-->
                <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header">
                    <div class="card-title">Stok Hareketi Düzenle</div>
                  </div>
                  <!--end::Header-->
                  <!--begin::Form-->

                  <?php 
                  if($_POST){
                    $entity = new \Entities\StokHareketleriEntity();
                    $entity->urun_adi=temizle($_POST["urun_adi"]);
                    $entity->kullanici_adiSoyadi=temizle($_POST["kullanici_adiSoyadi"]);
                    $entity->hareket_durummu=temizle($_POST["hareket_durummu"]);
                    $entity->miktar=temizle($_POST["miktar"]);
                    $entity->islem_durumu=temizle($_POST["islem_durumu"]);
                    $entity->islem_ucreti=temizle($_POST["islem_ucreti"]);
                    $entity->dokuman_no=temizle($_POST["dokuman_no"]);
                    $entity->islem_tarihi=temizle($_POST["islem_tarihi"]);
                    $guncelle=$code->guncelleStokHareketi($entity ,$gelenSatir->hareket_id);
                    if ($guncelle){
                      ?>
                      <div class="alert alert-success">Stok hareketi başarılı bir şekilde güncellenmiştir. Lütfen bekleyiniz, yönlendiriliyorsunuz...</div>
                    <?php 
                          go("Login.php?do=stokHareketleri",3);
                        } else { ?>
                        <div class="alert alert-danger">Hata ! Stok hareketi güncellenemedi. Lütfen tekrar deneyiniz.</div>
                        <?php } ?>
                  
                  <?php } ?>  

                  <form action="" method="POST">
                    <!--begin::Body-->
                    <div class="card-body">
                      
                      <div class="mb-3">
                        <label for="urun_adi" class="form-label">Ürün Adı</label>
                        <input type="text" class="form-control" id="urun_adi" name="urun_adi" value=" <?php echo temizle($gelenSatir->urun_adi); ?>" />
                      </div>
                      <div class="mb-3">
                        <label for="kullanici_adiSoyadi" class="form-label">Kullanıcı Adı Soyadı</label>
                        <input type="text" class="form-control" id="kullanici_adiSoyadi" name="kullanici_adiSoyadi" value=" <?php echo temizle($gelenSatir->kullanici_adiSoyadi); ?>" />
                      </div>
                      <div class="mb-3">
                        <label for="hareket_durummu" class="form-label">Hareket Durumu</label>
                        <input type="text" class="form-control" id="hareket_durummu" name="hareket_durummu" value=" <?php echo temizle($gelenSatir->hareket_durummu); ?>" />
                      </div>
                      <div class="mb-3">
                        <label for="miktar" class="form-label">Miktar</label>
                        <input type="text" class="form-control" id="miktar" name="miktar" value=" <?php echo temizle($gelenSatir->miktar); ?>" />
                      </div>
                      <div class="mb-3">
                        <label for="islem_durumu" class="form-label">İşlem Durumu</label>
                        <input type="text" class="form-control" id="islem_durumu" name="islem_durumu" value=" <?php echo temizle($gelenSatir->islem_durumu); ?>" />
                      </div>
                      <div class="mb-3">
                        <label for="islem_ucreti" class="form-label">İşlem Ücreti</label>
                        <input type="text" class="form-control" id="islem_ucreti" name="islem_ucreti" value=" <?php echo temizle($gelenSatir->islem_ucreti); ?>" />
                      </div>
                      <div class="mb-3">
                        <label for="dokuman_no" class="form-label">Doküman No</label>
                        <input type="text" class="form-control" id="dokuman_no" name="dokuman_no" value=" <?php echo temizle($gelenSatir->dokuman_no); ?>" />
                      </div>
                      <div class="mb-3">
                        <label for="islem_tarihi" class="form-label">İşlem Tarihi</label>
                        <input type="text" class="form-control" id="islem_tarihi" name="islem_tarihi" value=" <?php echo temizle($gelenSatir->islem_tarihi); ?>" />
                      </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer text-end">
                      <button type="submit" class="btn btn-warning" >Güncelle</button>
                    </div>
                    <!--end::Footer-->
                  </form>
                  <!--end::Form-->
                </div>
                <!--end::Quick Example-->
            </div>
          </div>
         </div>
<?php require_once("../Sistem/footer.php"); ?>