<?php 

require_once("../Sistem/loader.php");
require_once("../Sistem/fonksiyon.php");
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
                <h3 class="mb-0">Kullanıcılar</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="login.php?do=anasayfa">Anasayfa</a></li>
                  <li class="breadcrumb-item " aria-current="page">Kullanıcılar</li>
                  <li class="breadcrumb-item active " aria-current="page"><a href="login.php?do=kullanicilar">Kullanıcıların Listesi</a></li>
                  <li class="breadcrumb-item " aria-current="page">Yeni Kullanıcı Ekle</li>
                  
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
                    <div class="card-title">Yeni Kullanıcı Ekle</div>
                  </div>
                  <!--end::Header-->
                  <!--begin::Form-->

                  <?php 
                  if($_POST){
                    $entity = new \Entities\KullanicilarEntity();
                    $entity->kullanici_adi=temizle($_POST["adi"]);
                    $entity->kullanici_soyadi=temizle($_POST["soyadi"]);
                    $entity->kullanici_eposta=temizle($_POST["eposta"]);
                    $gelen_sifre = $_POST['kullanici_sifre'];
                    $entity->kullanici_sifre = password_hash($gelen_sifre, PASSWORD_ARGON2ID);
                    $entity->kullanici_cinsiyet=temizle($_POST["cinsiyet"]);
                    $entity->kullanici_rutbe=temizle($_POST["rutbe"]);

                    $kaydet=$code->kaydetKullaniciyi($entity);
                    if ($kaydet){
                      ?>
                      <div class="alert alert-success">Kullanıcı başarılı bir şekilde kaydedilmiştir. Lütfen bekleyiniz, yönlendiriliyorsunuz...</div>
                    <?php 
                          go("../login.php?do=kullanicilar",3);
                        } else { ?>
                        <div class="alert alert-danger">Hata ! Kullanıcı kaydedilemedi. Lütfen tekrar deneyiniz.</div>
                        <?php } ?>
                  
                  <?php } ?>  

                  <form action="" method="POST">
                    <!--begin::Body-->
                    <div class="card-body">
                      
                      <div class="mb-3">
                        <label for="adi" class="form-label">Adı</label>
                        <input type="text" class="form-control" id="adi" name="adi" value="" required/>
                      </div>
                      <div class="mb-3">
                        <label for="soyadi" class="form-label">Soyadı</label>
                        <input type="text" class="form-control" id="soyadi" name="soyadi" value="" required/>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label" >E-posta Adresi</label>
                        <input name="eposta"
                          type="email"
                          class="form-control"
                          id="exampleInputEmail1"
                          aria-describedby="emailHelp"
                          value=""
                          required
                        />
                        
                      </div>
                      <div class="mb-3">
                        <label for="cinsiyet" class="form-label">Cinsiyet</label>
                        <select class="form-control" name="cinsiyet" id="cinsiyet" >
                          <option value="1">Kadın</option>
                          <option value="2">Erkek</option>
                        </select>
                      </div>

                      <div class="mb-3">
                        <label for="rolü" class="form-label">Rütbe</label>
                        <select class="form-control" name="rutbe" id="rolü">
                          <option value="2">Kullanıcı</option>
                          <option value="7">Yönetici</option>
                        </select>
                      </div>
                      <div class="mb-3">
							<label class="form-label" for="sifre">Şifreniz</label>
							<input type="password" name="sifre" id="sifre" class="form-control" placeholder="Lütfen şifre oluşturunuz."  required>
						</div>
                        <div class="mb-3">
							<label class="form-label" for="sifreTekrar">Şifreniz</label>
							<input type="password" name="sifreTekrar" id="sifreTekrar" class="form-control" placeholder="Lütfen oluşturduğunuz şifrenizi tekrar giriniz."  required>
						</div>
                      <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" required />
                        <label class="form-check-label" for="exampleCheck1">Bilgilerin doğruluğunu onaylıyorum.</label>
                      </div>
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer text-end">
                      <button type="submit" class="btn btn-success" >Kaydet</button>
                    </div>
                    <!--end::Footer-->
                  </form>
                  <!--end::Form-->
                </div>
                <!--end::Quick Example-->
            </div>
          </div>
         </div>
         <script>
         function sifreKontrol() {
    // Input alanlarındaki değerleri alıyoruz
    const sifre = document.getElementById('sifre').value;
    const sifreTekrar = document.getElementById('sifreTekrar').value;
    const hataMesaji = document.getElementById('hataMesaji');

    // Şifrelerin eşleşip eşleşmediğini kontrol ediyoruz
    if (sifre !== sifreTekrar) {
        hataMesaji.textContent = "Hata: Girdiğiniz şifreler birbiriyle uyuşmuyor!";
        return false; // Formun gönderilmesini durdurur
    }

    // Şifreler eşleşiyorsa hata mesajını temizle ve işleme devam et
    hataMesaji.textContent = "";
    return true; // Formun gönderilmesine izin verir
}
</script>
<?php require_once("../Sistem/footer.php"); ?>