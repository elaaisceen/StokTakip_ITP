<?php 

require_once(__DIR__ . "/../Sistem/loader.php");
require_once(__DIR__ . "/../Sistem/fonksiyon.php");
require_once(__DIR__ . "/../Sistem/header.php");

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
                <h3 class="mb-0">Stok Hareketleri</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="login.php?do=anasayfa">Anasayfa</a></li>
                  <li class="breadcrumb-item " aria-current="page">Stok Hareketleri</li>
                  <li class="breadcrumb-item active " aria-current="page"><a href="login.php?do=stokhareketleri">Stok Hareketleri Listesi</a></li>
                  <li class="breadcrumb-item " aria-current="page">Yeni Stok Hareketi Ekle</li>
                  
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
                    <div class="card-title ">Yeni Stok Hareketi Ekle</div>
                  </div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <?php 
                  if($_POST){
                    $entity = new \Entities\StokHareketleriEntity();
                    $entity->hareket_id=temizle($_POST["hareket_id"]);
                    $entity->urun_adi=temizle($_POST["urun_adi"]);
                    $entity->kullanici_adiSoyadi=temizle($_POST["kullanici_adiSoyadi"]);
                    $entity->hareket_durummu=temizle($_POST["hareket_durummu"]);
                    $entity->miktar=temizle($_POST["miktar"]);
                    $entity->islem_durumu=temizle($_POST["islem_durumu"]);
                    $entity->islem_ucreti=temizle($_POST["islem_ucreti"]);
                    $entity->dokuman_no=temizle($_POST["dokuman_no"]);
                    $entity->islem_tarihi=temizle($_POST["islem_tarihi"]);
                 
                    $kaydet=$code->kaydetStokHareketleri($entity);
                    if ($kaydet){
                      ?>
                      <div class="alert alert-success">Stok hareketi başarılı bir şekilde kaydedilmiştir. Lütfen bekleyiniz, yönlendiriliyorsunuz...</div>
                    <?php 
                          go("login.php?do=stokhareketleri", 3);
                        } else { ?>
                        <div class="alert alert-danger">Hata ! Stok hareketi kaydedilemedi. Lütfen tekrar deneyiniz.</div>
                        <?php } ?>
                  
                  <?php } ?>  

                 <form action="" method="POST">
    <div class="row g-3 mb-3 mt-3">
        <div class="col-md-4">
            <label class="form-label">Ürün</label>
            <select name="urun_adi" class="form-select" required>
                <?php foreach($code->GetirUrunler() as $u) { echo "<option value='$u->urun_adi'>$u->urun_adi</option>"; } ?>
            </select>
        </div>
        <div class="col-md-4">
          <option value="">İşlemi Yapanı Seçin</option>
            <select name="kullanici_id" class="form-control">
    
    <?php
    // Veritabanından kullanıcıları getiren kodun burası olmalı
    $kullanicilar = $code->GetirKullanicilar(); // Bu fonksiyon çalışıyor mu?
    foreach ($kullanicilar as $k) {
        echo '<option value="'.$k->kullanici_id.'">'.$k->kullanici_adi.' '.$k->kullanici_soyadi.'</option>';
    }
    ?>
</select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Hareket Durumu</label>
            <select name="hareket_durummu" class="form-select">
                <option value="Giriş Yapıldı">Giriş Yapıldı</option>
                <option value="Çıkış Yapıldı">Çıkış Yapıldı</option>
            </select>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <input type="number" name="miktar" class="form-control" placeholder="Miktar" required>
        </div>
        <div class="col-md-3">
            <input type="text" name="islem_durumu" class="form-control" placeholder="İşlem Durumu">
        </div>
        <div class="col-md-2">
            <input type="number" name="islem_ucreti" class="form-control" placeholder="Ücret" step="0.01">
        </div>
        <div class="col-md-2">
            <input type="number" name="dokuman_no" class="form-control" placeholder="Döküman No">
        </div>
        <div class="col-md-2">
            <input type="date" name="islem_tarihi" class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <button type="submit" name="kaydet" class="btn btn-success w-100">İşlemi Kaydet</button>
        </div>
    </div>
</form>
<?php require_once("../Sistem/footer.php"); ?>