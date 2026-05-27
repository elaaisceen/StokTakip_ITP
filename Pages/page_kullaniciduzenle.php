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
$gelenSatir=$code->getirKullaniciyi($gelenKullanici);



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
                  <li class="breadcrumb-item " aria-current="page">Kullanıcılar Düzenle</li>
                  
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
                    <div class="card-title">Quick Example</div>
                  </div>
                  <!--end::Header-->
                  <!--begin::Form-->

                  <?php 
                  if($_POST){
                    $entity = new \Entities\KullanicilarEntity();
                    $entity->kullanici_adi=temizle($_POST["adi"]);
                    $entity->kullanici_soyadi=temizle($_POST["soyadi"]);
                    $entity->kullanici_eposta=temizle($_POST["eposta"]);
                    $entity->kullanici_cinsiyet=temizle($_POST["cinsiyet"]);
                    $entity->kullanici_rutbe=temizle($_POST["rutbe"]);

                    $guncelle=$code->guncelleKullaniciyi($entity ,$gelenSatir->kullanici_id);
                    if ($guncelle){
                      ?>
                      <div class="alert alert-success">Kullanıcı başarılı bir şekilde güncellenmiştir. Lütfen bekleyiniz, yönlendiriliyorsunuz...</div>
                    <?php 
                          go("Login.php?do=kullanicilar",3);
                        } else { ?>
                        <div class="alert alert-danger">Hata ! Kullanıcı güncellenemedi. Lütfen tekrar deneyiniz.</div>
                        <?php } ?>
                  
                  <?php } ?>  

                  <form>
                    <!--begin::Body-->
                    <div class="card-body">
                      
                      <div class="mb-3">
                        <label for="adi" class="form-label">Adı</label>
                        <input type="text" class="form-control" id="adi" name="adi" value=" <?php echo temizle($gelenSatir->kullanici_adi); ?>" />
                      </div>
                      <div class="mb-3">
                        <label for="soyadi" class="form-label">Soyadı</label>
                        <input type="text" class="form-control" id="soyadi" name="soyadi" value=" <?php echo temizle($gelenSatir->kullanici_soyadi); ?>" />
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label" name="eposta">E-posta Adresi</label>
                        <input
                          type="email"
                          class="form-control"
                          id="exampleInputEmail1"
                          aria-describedby="emailHelp"
                          value=" <?php echo temizle($gelenSatir->kullanici_eposta); ?>"
                        />
                        
                      </div>
                      <div class="mb-3">
                        <label for="cinsiyet" class="form-label">Cinsiyet</label>
                        <select class="form-control" name="cinsiyet" id="cinsiyet" >
                          <option value="1" <?php if ($gelenSatir->kullanici_cinsiyet == 1) { echo 'selected'; } ?>>Kadın</option>
                          <option value="2" <?php if ($gelenSatir->kullanici_cinsiyet == 2) { echo 'selected'; } ?>>Erkek</option>
                        </select>
                      </div>

                      <div class="mb-3">
                        <label for="rolü" class="form-label">Rütbe</label>
                        <select class="form-control" name="rutbe" id="rolü">
                          <option value="2" <?php if($gelenSatir->kullanici_rutbe==2){echo "selected";} ?>>Kullanıcı</option>
                          <option value="7" <?php if($gelenSatir->kullanici_rutbe==7){echo "selected";} ?>>Yönetici</option>
                        </select>
                      </div>
                      <div class="input-group mb-3">
                        <input type="file" class="form-control" id="inputGroupFile02" />
                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                      </div>
                      <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                      </div>
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