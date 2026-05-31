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
                <h3 class="mb-0">Stok Hareketleri</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="login.php?do=anasayfa">Anasayfa</a></li>
                  <li class="breadcrumb-item " aria-current="page">Stok Hareketleri</li>
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
                    <h3 class="card-title">Stok Hareketlerinin Listesi</h3>
                  </div>
                  <!-- /.card-header -->
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
            <th>Dokuman No</th>
            <th>İşlem Tarihi</th>
            <th>İşlemler</th>
        </tr>
    </thead>

    
    <tbody>
        <?php foreach($code->GetirStokHareketleri() as $s) { 
            // Renk belirleme
            $renk = ($s->hareket_durummu == 'Giriş Yapıldı') ? 'bg-success' : 'bg-danger';
        ?>
        <tr>
            <td><?php echo temizle($s->hareket_id); ?></td>
            <td><?php echo temizle($s->urun_adi); ?></td> 
            <td><?php echo temizle($s->kullanici_adiSoyadi); ?></td>
            <td><span class="badge <?php echo $renk; ?>"><?php echo $s->hareket_durummu; ?></span></td>
            <td><?php echo $s->miktar; ?></td>
            <td><?php echo $s->islem_durumu; ?></td>
            <td><?php echo $s->islem_ucreti; ?></td>
            <td><?php echo $s->dokuman_no; ?></td>
            <td><?php echo $s->islem_tarihi; ?></td>
            <td>
                <a href="login.php?do=stokHareketleriduzenle&hareket_id=<?php echo $s->hareket_id; ?>" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></a>
                <a href="login.php?do=stokHareketlerisil&hareket_id=<?php echo $s->hareket_id; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Emin misiniz?')"><i class="bi bi-trash"></i></a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php require_once("../Sistem/footer.php"); ?>