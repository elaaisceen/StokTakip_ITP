<?php 

namespace Classes;

use Entities\kategorilerEntity;
use Entities\kullanicilarEntity;
use Entities\stokhareketleriEntity;
use Entities\urunlerEntity;
use Entities\ayarlarEntity;


class code{

    public $db;
    private $dbhost='localhost';
    private $dbname='stoktakip'; 
    private $dbuser='root'; 
    private $dbpass=''; 

    public kullanicilarEntity $user;
    public ayarlarEntity $ayarlar;
    public kategorilerEntity $kategori;
    public stokhareketleriEntity $stokhareketleri;
    public urunlerEntity $urunler;

    public function __construct()
    {
        $this->user=$_SESSION['user'] ?? new kullanicilarEntity();
        $this->ayarlar=$_SESSION['ayarlar'] ?? new ayarlarEntity();
        $this->kategori=$_SESSION['kategori'] ?? new kategorilerEntity();
        $this->stokhareketleri=$_SESSION['stokhareketleri'] ?? new stokhareketleriEntity();
        $this->urunler=$_SESSION['urunler'] ?? new urunlerEntity();
    }

    public function connect2db():void
    {
            try
            {

                   $this->db = new \PDO("mysql:host=$this->dbhost;dbname=$this->dbname;charset=utf8", $this->dbuser, $this->dbpass);
                   $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            }
            catch (\PDOException $error)
            {
                die($error->getMessage());
            }

    }


    public function checkAccess()
    {
        if(!$this->user)
            return false;

        if($this->user->sil!=kullanicilarEntity::silinmedi)
            return false;

        return true;
    }

    public function getSettings() :ayarlarEntity{
        $sth=$this->db->prepare("SELECT * FROM ayarlar WHERE id=1");
        $sth->execute();
        return $sth->rowCount()>0 ? $sth->fetchObject(ayarlarEntity::class) : new ayarlarEntity();
    }

    
    public function login($kullanici_eposta,$kullanici_sifre) : kullanicilarEntity {

        $sth=$this->db->prepare("SELECT * FROM kullanicilar WHERE kullanici_eposta=? AND kullanici_sifre=? AND sil=?");
        $sth->execute([
            $kullanici_eposta,
            $kullanici_sifre,
            kullanicilarEntity::silinmedi
        ]);
        
        return $sth->rowCount()>0 ? $sth->fetObject(kullanicilarEntity::class) : new kullanicilarEntity();
    }

    //Session ayarlama - Oturum açma
    public function setSession($data):void{
        $_SESSION['user']=$data;
    }

    //Session silme - Oturum Kapatma
    public function logout(){

        $this->user=new kullanicilarEntity;
        unset($_SESSION['user']);
    }

    //ayarlar
    public function ayarlariGetir(){
        $sth=$this->db->prepare("SELECT * FROM ayarlar WHERE id=1");
        $sth->execute();
        return $sth->rowCount()>0 ? $sth->fetchObject(ayarlarEntity::class) : new ayarlarEntity();
    }

    //kullanıcı işlemleri
    public function GetirKullanicilar()
    {
        $sth=$this->db->prepare("
        Select kullanici_id,
        kullanici_adi,
        kullanici_soyadi,
        kullanici_eposta,
        (Case When kullanici_cinsiyet=1 then 'Kadın' else 'Erkek' end) as kullanici_cinsiyet,
        (Case when kullanici_rutbe=2 then 'Kullanıcı' else 'Yönetici' end) as kullanici_rutbe,
        kayit_tarihi,
        sil
        from kullanicilar where sil=2");

        $sth->execute();
        return $sth->rowCount()>0? $sth->fetchAll(\PDO::FETCH_CLASS) : [];
    }
     public function getirKullaniciyi($kullanici_id)
    {
        $sth=$this->db->prepare("
        Select kullanici_id,
        kullanici_adi,
        kullanici_soyadi,
        kullanici_eposta,
        kullanici_rutbe,
        (Case When kullanici_cinsiyet=1 then 'Kadın' else 'Erkek' end) as kullanici_cinsiyet,
        kayit_tarihi,
        sil
        from kullanicilar where kullanici_id=? AND sil=2");

        $sth->execute([$kullanici_id]);
        return $sth->rowCount() > 0 ? $sth->fetchObject(kullanicilarEntity::class) : new kullanicilarEntity();
    }

    public function guncelleKullaniciyi($entity, $kullanici_id){
        $sth=$this->db->prepare("UPDATE kullanicilar SET kullanici_adi=?,kullanici_soyadi=?,kullanici_eposta=?,kullanici_cinsiyet=?,kullanici_rutbe=? WHERE kullanici_id=?");
        $sth->execute([
            $entity->kullanici_adi,
            $entity->kullanici_soyadi,
            $entity->kullanici_eposta,
            $entity->kullanici_cinsiyet,
            $entity->kullanici_rutbe,  
            $kullanici_id
        ]);

        return $sth->rowCount(); 

    }

    public function kaydetKullaniciyi($entity,$kullanici_id=null){
        $sth=$this->db->prepare("INSERT INTO kullanicilar (kullanici_adi,kullanici_soyadi,kullanici_eposta,kullanici_sifre,kullanici_cinsiyet,kullanici_rutbe) VALUES (?,?,?,?,?,?)");
        $sth->execute([
            $entity->kullanici_adi,
            $entity->kullanici_soyadi,
            $entity->kullanici_eposta,
            $entity->kullanici_sifre,
            $entity->kullanici_cinsiyet,
            $entity->kullanici_rutbe
        ]);

        return $sth->rowCount(); 

    }

    public function silKullanicilar($kullanici_id){
        $sth=$this->db->prepare("UPDATE kullanicilar SET sil=1 WHERE kullanici_id=?");
        $sth->execute([$kullanici_id]);

        return $sth->rowCount();
    }

    //kategori işlemleri
    public function GetirKategoriler()
    {
        $sth=$this->db->prepare("
        Select kategori_id,
        kategori_adi,
        aciklama,
        sil
        from kategoriler where sil=2");

        $sth->execute();
        return $sth->rowCount()>0? $sth->fetchAll(\PDO::FETCH_CLASS) : [];
    }
     public function getirKategoriye($kategori_id)
    {
        $sth=$this->db->prepare("
        Select kategori_id,
        kategori_adi,
        aciklama,
        sil
        from kategoriler where kategori_id=? AND sil=2");

        $sth->execute([$kategori_id]);
        return $sth->rowCount() > 0 ? $sth->fetchObject(kategorilerEntity::class) : new kategorilerEntity();
    }

    public function guncelleKategoriyi($entity, $kategori_id){
        $sth=$this->db->prepare("UPDATE kategoriler SET kategori_adi=?,aciklama=?,sil=? WHERE kategori_id=?");
        $sth->execute([
            $entity->kategori_adi,
            $entity->aciklama,
            $entity->sil,
            $kategori_id
        ]);

        return $sth->rowCount();
    }

    public function kaydetKategoriyi($entity,$kategori_id=null){
        $sth=$this->db->prepare("INSERT INTO kategoriler (kategori_adi,aciklama) VALUES (?,?)");
        $sth->execute([
            $entity->kategori_adi,
            $entity->aciklama,
        ]);

        return $sth->rowCount(); 

    }

    public function silKategoriyi($kategori_id){
        $sth=$this->db->prepare("UPDATE kategoriler SET sil=1 WHERE kategori_id=?");
        $sth->execute([$kategori_id]);

        return $sth->rowCount();
    }

    //stok hareketleri işlemleri
    public function GetirStokHareketleri()
    {
        $sth=$this->db->prepare("
        Select hareket_id,
        urun_adi,
        kullanici_adiSoyadi,
        hareket_durummu,
        miktar,
        islem_durumu,
	    islem_ucreti,
        dokuman_no,
        islem_tarihi,
        sil
        from stokhareketleri where sil=2");

        $sth->execute();
        return $sth->rowCount()>0? $sth->fetchAll(\PDO::FETCH_CLASS) : [];
    }

    // Fonksiyon içine parametreleri eklemeyi unutma!
public function GetirStokHareket($urun, $hareket, $tarih_bas, $tarih_bit) 
{

    // sh tablosu için takma adımız 'sh', bunu her yerde kullanmalısın
    $sql = "SELECT 
                sh.*, 
                u.urun_adi, 
                CONCAT(k.kullanici_adi, ' ', k.kullanici_soyadi) AS kullanici_tam_ad 
            FROM stokhareketleri sh
            LEFT JOIN urunler u ON sh.urun_adi = u.urun_adi
            LEFT JOIN kullanicilar k ON sh.kullanici_adiSoyadi = CONCAT(k.kullanici_adi, ' ', k.kullanici_soyadi)
            WHERE sh.sil = 2";

    $sth = $this->db->prepare($sql);
    
    // Parametreleri güvenli şekilde bağla
    $params = [];
    if (!empty($urun)) $params[':urun'] = "%$urun%";
    if (!empty($hareket)) $params[':hareket'] = $hareket;
    if (!empty($tarih_bas)) $params[':tarih_bas'] = "$tarih_bas 00:00:00";
    if (!empty($tarih_bit)) $params[':tarih_bit'] = "$tarih_bit 23:59:59";
    
    $sth->execute($params);

    return $sth->fetchAll(\PDO::FETCH_OBJ) ?: [];
}

     public function GetirStokHareketlerini($hareket_id)
    {
        $sth=$this->db->prepare("
        Select hareket_id,
        urun_adi,
        kullanici_adiSoyadi,
        hareket_durummu,
        miktar,
        islem_durumu,
	    islem_ucreti,
        dokuman_no,
        islem_tarihi,
        sil
        from stokhareketleri where hareket_id=? AND sil=2");

        $sth->execute([$hareket_id]);
        return $sth->rowCount() > 0 ? $sth->fetchObject(stokhareketleriEntity::class) : new stokhareketleriEntity();
    }

    public function kaydetStokHareketleri($entity){
    
    $sql = "INSERT INTO stokhareketleri 
            (urun_adi, kullanici_adiSoyadi, hareket_durummu, miktar, islem_durumu, islem_ucreti, dokuman_no, islem_tarihi) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            
    $sth = $this->db->prepare($sql);
    
    // İşlemi gerçekleştir ve sonucu al
    $sonuc = $sth->execute([
        $entity->urun_adi,
        $entity->kullanici_adiSoyadi,
        $entity->hareket_durummu,
        $entity->miktar,
        $entity->islem_durumu,
        $entity->islem_ucreti,
        $entity->dokuman_no,
        $entity->islem_tarihi
    ]);

    return $sth->rowCount(); 
}

    public function guncelleStokHareketi($entity, $hareket_id){
        $sth=$this->db->prepare("UPDATE stokhareketleri SET urun_adi=?,kullanici_adiSoyadi=?,hareket_durummu=?,miktar=?,islem_durumu=?,islem_ucreti=?,dokuman_no=?,islem_tarihi=? WHERE hareket_id=?");
        $sth->execute([
            $entity->urun_adi,
            $entity->kullanici_adiSoyadi,
            $entity->hareket_durummu,
            $entity->miktar,
            $entity->islem_durumu,
            $entity->islem_ucreti,
            $entity->dokuman_no,
            $entity->islem_tarihi,
            $hareket_id
        ]);

        return $sth->rowCount();
    }
    
   public function filtreleStokHareketlerini($urun = '', $hareket = '', $baslangic = '', $bitis = '') {
    
    $sql = "SELECT * FROM stokhareketleri WHERE 1=1";
    
    if (!empty($urun)) {
        $sql .= " AND urun_adi LIKE '%$urun%'";
    }
    if (!empty($hareket)) {
        $sql .= " AND hareket_durummu = '$hareket'";
    }
    if (!empty($baslangic)) {
        $sql .= " AND islem_tarihi >= '$baslangic 00:00:00'";
    }
    if (!empty($bitis)) {
        $sql .= " AND islem_tarihi <= '$bitis 23:59:59'";
    }
    
    $sql .= " ORDER BY islem_tarihi DESC";
    
    $sth = $this->db->prepare($sql);
    $sth->execute();
    return $sth->fetchAll(\PDO::FETCH_OBJ);
}

    public function silStokHareketi($hareket_id){
        $sth=$this->db->prepare("UPDATE stokhareketleri SET sil=1 WHERE hareket_id=?");
        $sth->execute([$hareket_id]);

        return $sth->rowCount();
    }

    //ürün işlemleri
    public function GetirUrunler()
    {
        $sth=$this->db->prepare("
        Select urun_id,
        kategori_id,
        stok_Kodu,
        urun_adi,
        aciklama,
        mevcut_stok,
        kritik_stok,
        guncelB_fiyati,
        kategori_id,
        sil
        from urunler where sil=2");

        $sth->execute();
        return $sth->rowCount()>0? $sth->fetchAll(\PDO::FETCH_CLASS) : [];
    }
     public function GetirUrunu($urun_id)
    {
        $sth=$this->db->prepare("
        Select urun_id,
        kategori_id,
        stok_Kodu,
        urun_adi,
        aciklama,
        mevcut_stok,
        kritik_stok,
        guncelB_fiyati,
        kategori_id,
        sil
        from urunler where urun_id=? AND sil=2");

        $sth->execute([$urun_id]);
        return $sth->rowCount() > 0 ? $sth->fetchObject(urunlerEntity::class) : new urunlerEntity();
    }

    public function kaydetUrunu($entity,$urun_id=null){
        $sth=$this->db->prepare("INSERT INTO urunler (stok_Kodu,urun_adi,kategori_id,aciklama,mevcut_stok,kritik_stok,guncelB_fiyati) VALUES (?,?,?,?,?,?,?)");
        $sth->execute([
            $entity->stok_Kodu,
            $entity->urun_adi,
            $entity->kategori_id,
            $entity->aciklama,
            $entity->mevcut_stok,
            $entity->kritik_stok,
            $entity->guncelB_fiyati
        ]);

        return $sth->rowCount(); 

    }
    public function filtreleUrunu($aranan = '', $kategori_id = '') {
    $sql = "SELECT * FROM urunler WHERE sil=2";
    
    if (!empty($aranan)) {
        $sql .= " AND urun_adi LIKE '%$aranan%'";
    }
    if (!empty($kategori_id)) {
        $sql .= " AND kategori_id = " . (int)$kategori_id;
    }
    
    $sth = $this->db->prepare($sql);
    $sth->execute();
    
    return $sth->fetchAll(\PDO::FETCH_OBJ);
}

    public function guncelleUrunu($entity, $urun_id){
        $sth=$this->db->prepare("UPDATE urunler SET stok_Kodu=?,urun_adi=?,kategori_id=?,aciklama=?,mevcut_stok=?,kritik_stok=?,guncelB_fiyati=?,kategori_id=? WHERE urun_id=?");
        $sth->execute([
            $entity->stok_Kodu, 
            $entity->urun_adi,
            $entity->kategori_id,
            $entity->aciklama,
            $entity->mevcut_stok,
            $entity->kritik_stok,
            $entity->guncelB_fiyati,
            $entity->kategori_id,
            $urun_id
        ]);

        return $sth->rowCount();
    }
    public function getirKritikUrunler() {
    $sql = "SELECT * FROM urunler WHERE mevcut_stok <= kritik_stok ORDER BY mevcut_stok ASC";
    $sth = $this->db->prepare($sql);
    $sth->execute();
    return $sth->fetchAll(\PDO::FETCH_OBJ);
}
    public function silUrunler($urun_id){
        $sth=$this->db->prepare("UPDATE urunler SET sil=1 WHERE urun_id=?");
        $sth->execute([$urun_id]);

        return $sth->rowCount();
    }

    // Toplam stok değeri
public function toplamStokDegeri() {
    $sql = "SELECT SUM(mevcut_stok * guncelB_fiyati) as toplam FROM urunler WHERE sil != 1";
    $sth = $this->db->prepare($sql);
    $sth->execute();
    return $sth->fetch(\PDO::FETCH_OBJ);
}

// Kategori bazlı özet
public function kategoriBazliOzet() {
    $sql = "SELECT k.kategori_adi, 
                   COUNT(u.urun_id) as urun_sayisi,
                   SUM(u.mevcut_stok) as toplam_stok,
                   SUM(u.mevcut_stok * u.guncelB_fiyati) as toplam_deger
            FROM urunler u
            LEFT JOIN kategoriler k ON u.kategori_id = k.kategori_id
            WHERE u.sil != 1
            GROUP BY k.kategori_id, k.kategori_adi
            ORDER BY toplam_deger DESC";
    $sth = $this->db->prepare($sql);
    $sth->execute();
    return $sth->fetchAll(\PDO::FETCH_OBJ);
}

// Kritik ürün listesi
public function kritikUrunListesi() {
    $sql = "SELECT u.*, k.kategori_adi 
            FROM urunler u
            LEFT JOIN kategoriler k ON u.kategori_id = k.kategori_id
            WHERE u.mevcut_stok <= u.kritik_stok
            ORDER BY u.mevcut_stok ASC";
    $sth = $this->db->prepare($sql);
    $sth->execute();
    return $sth->fetchAll(\PDO::FETCH_OBJ);
}

    public function metrikler() {
        $sth=$this->db->prepare
        ("SELECT 
                count(kullanici_id) as aktif_kullanici, SUM(case when kullanici_rutbe=7 then 1 else 0 end) as toplam_yonetici,
                (SELECT count(kategori_id) FROM kategoriler where sil=2) as toplam_kategori,
                (SELECT COUNT(hareket_durummu) from stokhareketleri where sil=2 ) as guncel_hareket,
                (SELECT COUNT(urun_id) from urunler where sil=2 ) as toplam_urun 
                FROM `kullanicilar` WHERE sil=2;");

        $sth->execute([]);
        return $sth->rowCount()>0? $sth->fetchObject() : [];
    }
    

}
