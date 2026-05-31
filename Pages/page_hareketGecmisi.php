<?php
if($code->user->kullanici_rutbe != 7){
?>
<div class="alert alert-danger">Yetkisiz işlem! Log kayıtlarınız yöneticiye bildirilmiştir.</div>
<?php
go("login.php?do=anasayfa",3);
exit;
}

// Filtre değerlerini al
$filtre_urun    = isset($_GET["urun_adi"]) ? temizle($_GET["urun_adi"]) : "";
$filtre_hareket = isset($_GET["hareket_durummu"]) ? temizle($_GET["hareket_durummu"]) : "";
$filtre_baslang = isset($_GET["tarih_baslangic"]) ? temizle($_GET["tarih_baslangic"]) : "";
$filtre_bitis   = isset($_GET["tarih_bitis"]) ? temizle($_GET["tarih_bitis"]) : "";

// Fonksiyonu çağır
$hareketler = $code->filtreleStokHareketlerini($filtre_urun, $filtre_hareket, $filtre_baslang, $filtre_bitis);

?>

<div class="app-content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <h3 class="mb-0">Stok Hareketleri</h3>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
          <li class="breadcrumb-item"><a href="login.php?do=anasayfa">Anasayfa</a></li>
          <li class="breadcrumb-item active">Stok Hareketleri</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div class="app-content">
  <div class="container-fluid">

  <!-- FİLTRE KARTI -->
  
<form method="GET" action="login.php">
    <input type="hidden" name="do" value="hareketGecmisi">
    
    <div class="card mb-3">
      <div class="card-header"><h3 class="card-title">Filtrele</h3></div>
      <div class="card-body">
          <div class="row g-2">
            <div class="col-md-3">
              <input type="text" name="urun_adi" class="form-control" 
                     placeholder="Ürün Adı" value="<?php echo $filtre_urun; ?>">
            </div>
            <div class="col-md-3">
              <select name="hareket_durummu" class="form-select">
                <option value="">Tüm Hareketler</option>
                <option value="Giriş Yapıldı" <?php echo $filtre_hareket=="Giriş Yapıldı" ? "selected" : ""; ?>>Giriş</option>
                <option value="Çıkış Yapıldı" <?php echo $filtre_hareket=="Çıkış Yapıldı" ? "selected" : ""; ?>>Çıkış</option>
              </select>
            </div>
            <div class="col-md-2">
              <input type="date" name="tarih_baslangic" class="form-control" 
                     value="<?php echo $filtre_baslang; ?>">
            </div>
            <div class="col-md-2">
              <input type="date" name="tarih_bitis" class="form-control" 
                     value="<?php echo $filtre_bitis; ?>">
            </div>
            <div class="col-md-1">
              <button type="submit" class="btn btn-primary w-100">Filtrele</button>
            </div>
            <div class="col-md-1">
              <a href="login.php?do=hareketGecmisi" class="btn btn-secondary w-100">Temizle</a>
            </div>
          </div>
      </div>
    </div>

</form>
      </div>
    </div>

    <!-- LİSTE KARTI -->
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-header">
            <h3 class="card-title">Stok Hareketlerinin Listesi</h3>
          </div>
          <div class="card-body p-0">
            <table class="table table-sm align-middle">
              <thead>
                <tr>
                  <th>Hareket ID</th>
                  <th>Ürün Adı</th>
                  <th>İşlemi Yapan</th>
                  <th>Hareket Durumu</th>
                  <th>Miktar</th>
                  <th>İşlem Durumu</th>
                  <th>İşlem Ücreti</th>
                  <th>Doküman No</th>
                  <th>İşlem Tarihi</th>
                  <th>İşlemler</th>
                </tr>
              </thead>
              <tbody>
                <?php
                
                if(empty($hareketler)){ ?>
                  <tr>
                    <td colspan="10" class="text-center text-muted py-3">Kayıt bulunamadı.</td>
                  </tr>
                <?php } else {
                  foreach($hareketler as $s) {
                    $renk = ($s->hareket_durummu == 'Giriş Yapıldı') ? 'bg-success' : 'bg-danger';
                ?>
                <tr>
                  <td><?php echo temizle($s->hareket_id); ?></td>
                  <td><?php echo temizle($s->urun_adi); ?></td>
                  <td><?php echo temizle($s->kullanici_adiSoyadi); ?></td>
                  <td><span class="badge <?php echo $renk; ?>"><?php echo $s->hareket_durummu; ?></span></td>
                  <td><?php echo $s->miktar; ?></td>
                  <td><?php echo $s->islem_durumu; ?></td>
                  <td><?php echo number_format($s->islem_ucreti, 2); ?> ₺</td>
                  <td><?php echo $s->dokuman_no; ?></td>
                  <td><?php echo date("d.m.Y H:i", strtotime($s->islem_tarihi)); ?></td>
                  <td>
                    <a href="login.php?do=stokHareketiduzenle&hareket_id=<?php echo $s->hareket_id; ?>" 
                       class="btn btn-outline-primary btn-sm">
                       <i class="bi bi-pencil"></i>
                    </a>
                    <a href="login.php?do=stokHareketlerisil&hareket_id=<?php echo $s->hareket_id; ?>" 
                       class="btn btn-outline-danger btn-sm" 
                       onclick="return confirm('Bu hareketi silmek istediğinize emin misiniz?')">
                       <i class="bi bi-trash"></i>
                    </a>
                  </td>
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
<script>
function filtrele() {
    var urun    = document.getElementById('filtre_urun').value;
    var hareket = document.getElementById('filtre_hareket').value;
    var baslang = document.getElementById('filtre_baslangic').value;
    var bitis   = document.getElementById('filtre_bitis').value;
    
    var url = 'login.php?do=hareketGecmisi';
    if(urun)    url += '&urun_adi='          + encodeURIComponent(urun);
    if(hareket) url += '&hareket_durummu='   + encodeURIComponent(hareket);
    if(baslang) url += '&tarih_baslangic='   + baslang;
    if(bitis)   url += '&tarih_bitis='       + bitis;
    
    window.location.href = url;
}
</script>
<?php require_once("../Sistem/footer.php"); ?>