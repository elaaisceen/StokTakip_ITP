<?php
if($code->user->kullanici_rutbe != 7){
?>
<div class="alert alert-danger">Yetkisiz işlem!</div>
<?php
go("login.php?do=anasayfa", 3);
exit;
}

$toplamDeger    = $code->toplamStokDegeri();
$kategoriOzet   = $code->kategoriBazliOzet();
$kritikUrunler  = $code->kritikUrunListesi();
?>

<div class="app-content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <h3 class="mb-0">Raporlar</h3>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
          <li class="breadcrumb-item"><a href="login.php?do=anasayfa">Anasayfa</a></li>
          <li class="breadcrumb-item active">Raporlar</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div class="app-content">
  <div class="container-fluid">

    <!-- ÖZET KARTLAR -->
    <div class="row mb-4">

      <!-- Toplam Stok Değeri -->
      <div class="col-md-4">
        <div class="card text-white" style="background: linear-gradient(135deg, #667eea, #764ba2);">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <div style="font-size:13px; opacity:0.85;">Toplam Stok Değeri</div>
              <div style="font-size:28px; font-weight:700;">
                ₺<?php echo number_format($toplamDeger->toplam ?? 0, 2, ',', '.'); ?>
              </div>
            </div>
            <div style="font-size:48px; opacity:0.3;">💰</div>
          </div>
        </div>
      </div>

      <!-- Toplam Ürün Sayısı -->
      <div class="col-md-4">
        <div class="card text-white" style="background: linear-gradient(135deg, #11998e, #38ef7d);">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <div style="font-size:13px; opacity:0.85;">Toplam Ürün Çeşidi</div>
              <div style="font-size:28px; font-weight:700;">
                <?php 
                $toplamUrun = array_sum(array_column((array)$kategoriOzet, 'urun_sayisi'));
                echo $toplamUrun; 
                ?> Ürün
              </div>
            </div>
            <div style="font-size:48px; opacity:0.3;">📦</div>
          </div>
        </div>
      </div>

      <!-- Kritik Ürün Sayısı -->
      <div class="col-md-4">
        <div class="card text-white" style="background: linear-gradient(135deg, #f7971e, #ffd200);">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <div style="font-size:13px; opacity:0.85;">Kritik Stok Ürün Sayısı</div>
              <div style="font-size:28px; font-weight:700;">
                <?php echo count($kritikUrunler); ?> Ürün
              </div>
            </div>
            <div style="font-size:48px; opacity:0.3;">⚠️</div>
          </div>
        </div>
      </div>

    </div>

    <div class="row">

      <!-- KATEGORİ BAZLI ÖZET -->
      <div class="col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-header">
            <h5 class="card-title mb-0">📊 Kategori Bazlı Özet</h5>
          </div>
          <div class="card-body p-0">
            <table class="table table-sm align-middle mb-0">
              <thead>
                <tr>
                  <th>Kategori</th>
                  <th class="text-center">Ürün Sayısı</th>
                  <th class="text-center">Toplam Stok</th>
                  <th class="text-end">Toplam Değer</th>
                </tr>
              </thead>
              <tbody>
                <?php if(empty($kategoriOzet)){ ?>
                <tr><td colspan="4" class="text-center text-muted py-3">Veri bulunamadı.</td></tr>
                <?php } else { 
                  foreach($kategoriOzet as $k){ ?>
                <tr>
                  <td><strong><?php echo $k->kategori_adi ?? 'Kategorisiz'; ?></strong></td>
                  <td class="text-center">
                    <span class="badge bg-primary"><?php echo $k->urun_sayisi; ?></span>
                  </td>
                  <td class="text-center"><?php echo $k->toplam_stok; ?></td>
                  <td class="text-end">₺<?php echo number_format($k->toplam_deger, 2, ',', '.'); ?></td>
                </tr>
                <?php }} ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- KRİTİK ÜRÜN LİSTESİ -->
      <div class="col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-header bg-danger text-white">
            <h5 class="card-title mb-0">🚨 Kritik Stok Ürünleri</h5>
          </div>
          <div class="card-body p-0">
            <table class="table table-sm align-middle mb-0">
              <thead>
                <tr>
                  <th>Ürün Adı</th>
                  <th>Kategori</th>
                  <th class="text-center">Mevcut</th>
                  <th class="text-center">Kritik Eşik</th>
                  <th class="text-center">Durum</th>
                </tr>
              </thead>
              <tbody>
                <?php if(empty($kritikUrunler)){ ?>
                <tr>
                  <td colspan="5" class="text-center text-success py-3">
                    ✅ Kritik stok ürünü yok!
                  </td>
                </tr>
                <?php } else {
                  foreach($kritikUrunler as $u){ 
                    $fark = $u->mevcut_stok - $u->kritik_stok;
                    if($u->mevcut_stok == 0){
                        $durum = '<span class="badge bg-dark">Tükendi</span>';
                    } elseif($fark < 0){
                        $durum = '<span class="badge bg-danger">Kritik</span>';
                    } else {
                        $durum = '<span class="badge bg-warning text-dark">Yaklaşıyor</span>';
                    }
                  ?>
                <tr>
                  <td><strong><?php echo $u->urun_adi; ?></strong></td>
                  <td><?php echo $u->kategori_adi ?? '-'; ?></td>
                  <td class="text-center">
                    <span class="badge bg-danger"><?php echo $u->mevcut_stok; ?></span>
                  </td>
                  <td class="text-center"><?php echo $u->kritik_stok; ?></td>
                  <td class="text-center"><?php echo $durum; ?></td>
                </tr>
                <?php }} ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<?php require_once("../Sistem/footer.php"); ?>