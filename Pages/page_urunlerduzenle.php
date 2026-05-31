<?php 

if($code->user->kullanici_rutbe != 7){

?>
<div class="alert alert-danger">Yetkisiz işlem! Log kayıtlarınız yöneticiye bildirilmiştir.</div>
<?php

go("login.php?do=anasayfa",3);
exit;
}

$gelenUrun=temizle($_GET["urun_id"]);
$gelenUrun= (int) $gelenUrun;
$gelenSatir=$code->getirUrunu($gelenUrun);



?>

<div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0">Ürünler</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="login.php?do=anasayfa">Anasayfa</a></li>
                  <li class="breadcrumb-item " aria-current="page">Ürünler</li>
                  <li class="breadcrumb-item active " aria-current="page"><a href="login.php?do=urunler">Ürünler Listesi</a></li>
                  <li class="breadcrumb-item " aria-current="page">Ürünler Düzenle</li>
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

                  <?php 
                  if($_POST){
                    $entity = new \Entities\UrunlerEntity();
                    $entity->urun_adi=temizle($_POST["adi"]);
                    $entity->aciklama=temizle($_POST["aciklama"]);
                    $entity->mevcut_stok=temizle($_POST["mevcut_stok"]);
                    $entity->kritik_stok=temizle($_POST["kritik_stok"]);
                    $entity->guncelB_fiyati=temizle($_POST["fiyat"]);
                    $entity->kategori_id=temizle($_POST["kategori_id"]);

                    $guncelle=$code->guncelleUrunu($entity ,$gelenSatir->urun_id);
                    if ($guncelle){
                      ?>
                      <div class="alert alert-success">Ürün başarılı bir şekilde güncellenmiştir. Lütfen bekleyiniz, yönlendiriliyorsunuz...</div>
                    <?php 
                          go("Login.php?do=urunler",3);
                        } else { ?>
                        <div class="alert alert-danger">Hata ! Ürün güncellenemedi. Lütfen tekrar deneyiniz.</div>
                        <?php } ?>
                  
                  <?php } ?>  

                  <form>
                    <!--begin::Body-->
                    <div class="card-body">
                      
                      <div class="mb-3">
                        <label for="adi" class="form-label">Adı</label>
                        <input type="text" class="form-control" id="adi" name="adi" value=" <?php echo temizle($gelenSatir->urun_adi); ?>" />
                      </div>
                      <div class="mb-3">
                        <label for="aciklama" class="form-label">Açıklama</label>
                        <input type="text" class="form-control" id="aciklama" name="aciklama" value=" <?php echo temizle($gelenSatir->aciklama); ?>" />
                      </div>
                      <div class="mb-3">
                        <label for="fiyat" class="form-label">Fiyat</label>
                        <input type="text" class="form-control" id="fiyat" name="fiyat" value=" <?php echo temizle($gelenSatir->guncelB_fiyati); ?>" />
                      </div>
                      <div class="mb-3">
                        <label for="stok_miktari" class="form-label">Stok Miktarı</label>
                        <input type="text" class="form-control" id="stok_miktari" name="stok_miktari" value=" <?php echo temizle($gelenSatir->mevcut_stok); ?>" />
                      </div>
                      <div class="mb-3">
                          <label class="form-label">Kritik Stok Eşiği</label>
                          <input type="number" name="kritik_stok" class="form-control" value="<?php echo temizle($gelenSatir->kritik_stok); ?>" required>
                      </div>
                      <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori</label>
                        <select class="form-control" name="kategori_id" id="kategori_id">
                          <?php foreach ($code->GetirKategoriler() as $kategori) { ?>
                            <option value="<?php echo $kategori->kategori_id; ?>" <?php if ($gelenSatir->kategori_id == $kategori->kategori_id) { echo 'selected'; } ?>>
                              <?php echo $kategori->kategori_adi; ?>
                            </option>
                          <?php }
                          $kategoriler=$code->GetirKategoriler();
                          foreach($kategoriler as $kategori){ ?>
                            <option value="<?php echo temizle($kategori->kategori_id); ?>"><?php echo temizle($kategori->kategori_adi); ?></option>
                          <?php } ?>
                        </select>
                        <button type="button" class="btn btn-primary mt-2" onclick="window.location.href='Pages/page_kategoriekle.php'">
                         + Kategori Düzenle</button>
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