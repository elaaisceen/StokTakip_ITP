<?php
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
                <h3 class="mb-0">Kategoriler</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="login.php?do=anasayfa">Anasayfa</a></li>
                  <li class="breadcrumb-item " aria-current="page">Kategoriler</li>
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
                    <h3 class="card-title">Kategorilerin Listesi</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th style="width: 100px"></th>
                          <th>Adı</th>
                          <th >Açıklama</th>
                          <th>İşlemler</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $kategoriler=$code->GetirKategoriler();

                          //var_dump($kategoriler); //Çıktıyı kontrol etmek çıktının içindekileri görmek için kullanılır.
                        ?>
                        <?php 
                        foreach($kategoriler as $kSatir):
                        ?>
                        <tr class="align-middle">
                          <td><?php echo temizle($kSatir->kategori_id); ?></td>
                          <td><?php echo temizle($kSatir->kategori_adi); ?></td>
                          <td><?php echo temizle($kSatir->aciklama); ?></td>
                          <td>
                            <a href="login.php?do=kategoriduzenle&kategori_id=<?php echo $kSatir->kategori_id; ?>" class="btn btn-outline-primary me-2"> <i class="bi bi-pencil"></i> </a>

                            <a href="login.php?do=kategorisil&kategori_id=<?php echo $kSatir->kategori_id; ?>" class="btn btn-outline-danger" onclick="return confirm('Bu kaydı silmek istediğinizden emin misiniz?')"> <i class="bi bi-trash"></i></a>
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