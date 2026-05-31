<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<?php
require_once __DIR__ . '/../Sistem/loader.php'; 
require_once __DIR__ . '/../Sistem/fonksiyon.php';
require_once __DIR__ . '/../Sistem/header.php';

if($code->user->kullanici_rutbe != 7){

?>
<div class="alert alert-danger">Yetkisiz işlem! Log kayıtlarınız yöneticiye bildirilmiştir.</div>
<?php

//var_dump($kullanicilar);
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
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
</div>
<div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-md-12"></div>
              <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">Kullanıcıların Listesi</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th style="width: 10px"></th>
                          <th>Adı</th>
                          <th>Soyadı</th>
                          <th>Email</th>
                          <th>Cinsiyet</th>
                          <th>Rolü</th>
                          <th>Kayıt Tarihi</th>
                          <th>İşlemler</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $kullanicilar=$code->GetirKullanicilar();

                          //var_dump($kullanicilar); //Çıktıyı kontrol etmek çıktının içindekileri görmek için kullanılır.
                        ?>
                        <?php 
                        foreach($kullanicilar as $kSatir):
                        ?>
                        <tr class="align-middle">
                          <td><?php echo temizle($kSatir->kullanici_id); ?></td>
                          <td><?php echo temizle($kSatir->kullanici_adi); ?></td>
                          <td><?php echo temizle($kSatir->kullanici_soyadi); ?></td>
                          <td><?php echo temizle($kSatir->kullanici_eposta); ?></td>
                          <td>
                              <?php if ($kSatir->kullanici_rutbe == "Yönetici"){
                              echo "<span class='badge text-bg-info'>".$kSatir->kullanici_rutbe."</span>";
                              } else if ($kSatir->kullanici_rutbe == "Kullanıcı"){
                              echo "<span class='badge text-bg-success'>".$kSatir->kullanici_rutbe."</
                              span>";
                              } ?>

                          </td>
                          <td>
                          <?php if ($kSatir->kullanici_cinsiyet == "Erkek"){
                              echo "<span class='badge text-bg-info'>".$kSatir->kullanici_cinsiyet. "</span ";
                             } else if ($kSatir->kullanici_cinsiyet == "Kadın"){
                              echo "<span class='badge text-bg-danger'>".$kSatir->kullanici_cinsiyet. "</span ";
                             } ?>
                             </td>
                          <td><?php echo date("d/m/Y", strtotime($kSatir->kayit_tarihi));
                          ?></td>
                          <td class="text-center align-middle justify-content-center align-items-center gap-2">
                            <a href="login.php?do=kullaniciduzenle&kullanici_id=<?php echo $kSatir->kullanici_id; ?>" class="btn btn-outline-primary"> <i class="bi bi-pencil mt-3"></i> </a>

                            <a href="login.php?do=kullanicisil&kullanici_id=<?php echo $kSatir->kullanici_id; ?>" class="btn btn-outline-danger " onclick="return confirm('Bu kaydı silmek istediğinizden emin misiniz?')"> <i  class="bi bi-trash mt-2"></i></a>
                          </td>
                          <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
             
              </div>
              <!-- /.Start col -->
            </div>
            <!-- /.row (main row) -->
          </div>
          <!--end::Container-->
        </div>
<?php require_once("../Sistem/footer.php"); ?>