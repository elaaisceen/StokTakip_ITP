<?php 
require_once("../Sistem/loader.php");
include("../Sistem/fonksiyon.php");
require_once("../Sistem/header.php");

if($code->user->kullanici_rutbe != 7){

?>
<div class="alert alert-danger">Yetkisiz işlem! Log kayıtlarınız yöneticiye bildirilmiştir.</div>
<?php

go("login.php?do=anasayfa",3);
exit;
}



?>

<div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
          
               

              <div class="col-sm-6">
                <h3 class="mb-0">Ürün Ekle</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="login.php?do=anasayfa">Anasayfa</a></li>
                  <li class="breadcrumb-item " aria-current="page">Ürünler</li>
                  <li class="breadcrumb-item active " aria-current="page"><a href="login.php?do=urunler">Ürünlerin Listesi</a></li>
                  <li class="breadcrumb-item " aria-current="page">Yeni Ürün Ekle</li>
                  
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
                    <div class="card-title">Yeni Ürün Ekle</div>
                  </div>
                  <!--end::Header-->
                  <!--begin::Form-->

                  <?php 
                  if($_POST){
                    $entity = new \Entities\UrunlerEntity();
                    $entity->stok_Kodu=temizle($_POST["stok_kodu"]);
                    $entity->urun_adi=temizle($_POST["adi"]);
                    $entity->aciklama=temizle($_POST["aciklama"]);
                    $entity->guncelB_fiyati=temizle($_POST["fiyat"]);
                    $entity->mevcut_stok=temizle($_POST["stok"]);
                    $entity->kritik_stok=temizle($_POST["kritik_stok"]);
                    $entity->kategori_id=temizle($_POST["kategori_id"]);


                    $kaydet=$code->kaydetUrunu($entity);
                    if ($kaydet){
                      ?>
                      <div class="alert alert-success">Ürün başarılı bir şekilde kaydedilmiştir. Lütfen bekleyiniz, yönlendiriliyorsunuz...</div>
                    <?php 
                          go("<StokTakip>login.php?do=urunler",3);
                        } else { ?>
                        <div class="alert alert-danger">Hata ! Ürün kaydedilemedi. Lütfen tekrar deneyiniz.</div>
                        <?php } ?>
                  
                  <?php } ?>  

                  <form action="" method="POST">
                    <!--begin::Body-->
                    <div class="card-body">

                      <div class="mb-3">
                        <label for="stok_kodu" class="form-label">Stok Kodu</label>
                        <input type="number" class="form-control" id="stok_kodu" name="stok_kodu" value="" required/>
                      </div>
                      
                      <div class="mb-3">
                        <label for="adi" class="form-label">Ürün Adı</label>
                        <input type="text" class="form-control" id="adi" name="adi" value="" required/>
                      </div>
                      <div class="mb-3">
                        <label for="aciklama" class="form-label">Ürün Açıklaması</label>
                        <input type="text" class="form-control" id="aciklama" name="aciklama" value="" required/>
                      </div>
                      <div class="mb-3">
                        <label for="fiyat" class="form-label">Fiyat</label>
                        <input type="number" class="form-control" id="fiyat" name="fiyat" value="" required/>
                      </div>
                      <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" value="" required/>
                      </div>
                      <div class="mb-3">
                        <label for="kritik_stok" class="form-label">Kritik Stok</label>
                        <input type="number" class="form-control" id="kritik_stok" name="kritik_stok" value="0" required/>
                      </div>
                      <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori<p style="font-size: 13px; color: #6c757d;">(Lütfen uygun kategori seçiniz. Uygun kategori olmaması halinde kategori ekle butonu ile kategori ekleyiniz.)</p></label>
                        <select class="form-control" id="kategori_id" name="kategori_id" required>
                          <option value="">Lütfen kategori seçiniz </option>
                          <?php 
                          $kategoriler=$code->GetirKategoriler();
                          foreach($kategoriler as $kategori){ ?>
                            <option value="<?php echo temizle($kategori->kategori_id); ?>"><?php echo temizle($kategori->kategori_adi); ?></option>
                          <?php } ?>
                        </select>
                        <button type="button" class="btn btn-primary mt-2" onclick="window.location.href='Pages/page_kategoriekle.php'">
                         + Yeni Kategori Ekle</button>
                      </div>
 
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer text-end">
                      <button type="submit" class="btn btn-success" >Ekle</button>
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