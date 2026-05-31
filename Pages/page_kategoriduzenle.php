<?php 


if($code->user->kullanici_rutbe != 7){

?>
<div class="alert alert-danger">Yetkisiz işlem! Log kayıtlarınız yöneticiye bildirilmiştir.</div>
<?php

go("login.php?do=anasayfa",3);
exit;
}

$girilenKategori=temizle($_GET["kategori_id"]);
$girilenKategori= (int) $girilenKategori;
$gelenSatir=$code->getirKategoriye($girilenKategori);



?>

<div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
          
               

              <div class="col-sm-6">
                <h3 class="mb-0">Kategoriler</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="login.php?do=anasayfa">Anasayfa</a></li>
                  <li class="breadcrumb-item " aria-current="page">Kategoriler</li>
                  <li class="breadcrumb-item active " aria-current="page"><a href="login.php?do=kategoriler">Kategorilerin Listesi</a></li>
                  <li class="breadcrumb-item " aria-current="page">Kategoriler Düzenle</li>
                  
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
                    <div class="card-title">Kategori Düzenle</div>
                  </div>
                  <!--end::Header-->
                  <!--begin::Form-->

                  <?php 
                  if($_POST){
                    $entity = new \Entities\KategorilerEntity();
                    $entity->kategori_adi=temizle($_POST["adi"]);
                    $entity->aciklama=temizle($_POST["aciklama"]);

                    $guncelle=$code->guncelleKategoriyi($entity ,$gelenSatir->kategori_id);
                    if ($guncelle){
                      ?>
                      <div class="alert alert-success">Kategori başarılı bir şekilde güncellenmiştir. Lütfen bekleyiniz, yönlendiriliyorsunuz...</div>
                    <?php 
                          go("Login.php?do=kategoriler",3);
                        } else { ?>
                        <div class="alert alert-danger">Hata ! Kategori güncellenemedi. Lütfen tekrar deneyiniz.</div>
                        <?php } ?>
                  
                  <?php } ?>  

                  <form action="" method="POST">
                    <!--begin::Body-->
                    <div class="card-body">
                      
                      <div class="mb-3">
                        <label for="adi" class="form-label">Adı</label>
                        <input type="text" class="form-control" id="adi" name="adi" value=" <?php echo temizle($gelenSatir->kategori_adi); ?>" />
                      </div>
                      <div class="mb-3">
                        <label for="aciklama" class="form-label">Açıklama</label>
                        <input type="text" class="form-control" id="aciklama" name="aciklama" value=" <?php echo temizle($gelenSatir->aciklama); ?>" />
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