<?php

require_once __DIR__ . '/../Sistem/loader.php';
require_once(__DIR__ . '/../Sistem/fonksiyon.php');
require_once(__DIR__ . '/../Sistem/header.php');

if($code->user->kullanici_rutbe != 7){

?>
<div class="alert alert-danger">Yetkisiz işlem! Log kayıtlarınız yöneticiye bildirilmiştir.</div>
<?php

//var_dump($kullanicilar);
go("login.php?do=anasayfa",3);
exit;
}

$aranan = $_GET['ara'] ?? '';
$kategori_id = $_GET['kategori'] ?? '';

// Filtreleme fonksiyonunu çağırıyoruz
$urunler = $code->filtreleUrunu($aranan, $kategori_id);

?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0">Ürünler</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="login.php?do=anasayfa">Anasayfa</a></li>
                  <li class="breadcrumb-item " aria-current="page">Ürünler</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
</div>

<!-- FİLTRE KARTI -->
    <div class="card mb-3">
      <div class="card-header"><h3 class="card-title">Filtrele</h3></div>
      <div class="card-body">
                  
<form method="GET" action="login.php" class="d-flex justify-content-between mb-3">
    
    <input type="hidden" name="do" value="urunler">
    
    <input type="text" name="ara" class="form-control w-50" placeholder="Ürün adı ile ara..." value="<?= htmlspecialchars($aranan) ?>">
    
    <select name="kategori" class="form-select">
        <option value="">Tüm Kategoriler</option>
        <?php 
        $kategoriler = $code->GetirKategoriler();
        if($kategoriler) {
            foreach($kategoriler as $kategori) {
                $selected = ($kategori_id == $kategori->kategori_id) ? 'selected' : '';
                echo "<option value='{$kategori->kategori_id}' $selected>{$kategori->kategori_adi}</option>";
            }
        }
        ?>
    </select>
    
    <button type="submit" class="btn btn-primary">Filtrele</button>
</form>
      </div>
    </div>


<div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-md-12"></div>
              <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">Ürünlerin Listesi</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th>Ürün Adı</th>
                          <th style="width: 35%;">Açıklama</th>
                          <th>Fiyat</th>
                          <th>Stok Miktarı</th>
                          <th>Kritik Stok</th>
                          <th>Kategori</th>
                          <th style="height: 50px;">İşlemler</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $urunler = $code->filtreleUrunu($aranan, $kategori_id);

                          //var_dump($urunler); //Çıktıyı kontrol etmek çıktının içindekileri görmek için kullanılır.
                        foreach ($urunler as $uSatir):
                        ?>
                        
                        <tr class="align-middle" style="height: 50px;">
                        
                          <td><?php echo temizle($uSatir->urun_adi); ?></td>
                          <td><?php echo temizle($uSatir->aciklama); ?></td>
                          <td style="text-align: center;"><?php echo temizle($uSatir->guncelB_fiyati); ?></td>
                          <td style="text-align: center;">
                          <?php
                              if ($uSatir->mevcut_stok <= $uSatir->kritik_stok) {
                                  $badge = "bg-danger text-white"; // Kritik (Kırmızı)
                              } elseif ($uSatir->mevcut_stok <= ($uSatir->kritik_stok + 10)) {
                                  $badge = "bg-warning text-dark"; // Yaklaşıyor (Sarı)
                              } else {
                                  $badge = "bg-success text-white"; // Normal (Yeşil)
                              }
                              ?>
                              
                              <span class="badge <?php echo $badge; ?>">
                                  <?php echo temizle($uSatir->mevcut_stok); ?>
                              </span>
                          </td>
                          <td style="text-align: center;"><?php echo temizle($uSatir->kritik_stok); ?></td>
                          <th>
                              <?php 
                              $kategori=$code->getirKategoriye($uSatir->kategori_id);
                              echo temizle($kategori->kategori_adi);
                              ?>
                          </th>
                          <td class="text-center align-middle justify-content-center align-items-center gap-2">
                            <a href="login.php?do=urunlerduzenle&urun_id=<?php echo $uSatir->urun_id; ?>" class="btn btn-outline-primary"> <i class="bi bi-pencil mt-3"></i> </a>

                            <a href="login.php?do=urunlersil&urun_id=<?php echo $uSatir->urun_id; ?>" class="btn btn-outline-danger " onclick="return confirm('Bu kaydı silmek istediğinizden emin misiniz?')"> <i  class="bi bi-trash mt-2"></i></a>
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