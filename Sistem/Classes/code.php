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
        $sth=$this->db->prepare("UPDATE kullanicilar SET kullanici_adi=?,kullanici_soyadi=?,kullanici_eposta=?,kullanici_cinsiyet=? WHERE kullanici_id=?");
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
        kategori_aciklama,
        (Case When aktif=2 then 'aktif' else 'pasif' end) as kategori_durum,
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
        kategori_aciklama,
        (Case When aktif=2 then 'aktif' else 'pasif' end) as kategori_durum,
        sil
        from kategoriler where kategori_id=? AND sil=2");

        $sth->execute([$kategori_id]);
        return $sth->rowCount() > 0 ? $sth->fetchObject(kategorilerEntity::class) : new kategorilerEntity();
    }

    public function guncelleKategoriyi($entity, $kategori_id){
        $sth=$this->db->prepare("UPDATE kategoriler SET kategori_adi=?,kategori_aciklama=?,aktif=? WHERE kategori_id=?");
        $sth->execute([
            $entity->kategori_adi,
            $entity->kategori_aciklama,
            $entity->aktif,
            $kategori_id
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
     public function GetirStokHareketlerini($hareket_id)
    {
        $sth=$this->db->prepare("
        Select hareket_id,
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

    public function guncelleStokHareketi($entity, $hareket_id){
        $sth=$this->db->prepare("UPDATE stokhareketleri SET hareket_durummu=?,miktar=?,islem_durumu=?,islem_ucreti=?,dokuman_no=?,islem_tarihi=? WHERE hareket_id=?");
        $sth->execute([
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
        urun_adi,
        urun_aciklama,
        fiyat,
        stok_miktari,
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
        urun_adi,
        urun_aciklama,
        fiyat,
        stok_miktari,
        kategori_id,
        sil
        from urunler where urun_id=? AND sil=2");

        $sth->execute([$urun_id]);
        return $sth->rowCount() > 0 ? $sth->fetchObject(urunlerEntity::class) : new urunlerEntity();
    }

    public function guncelleUrunu($entity, $urun_id){
        $sth=$this->db->prepare("UPDATE urunler SET urun_adi=?,urun_aciklama=?,fiyat=?,stok_miktari=?,kategori_id=? WHERE urun_id=?");
        $sth->execute([
            $entity->urun_adi,
            $entity->urun_aciklama,
            $entity->fiyat,
            $entity->stok_miktari,
            $entity->kategori_id,
            $urun_id
        ]);

        return $sth->rowCount();
    }

    public function silUrunu($urun_id){
        $sth=$this->db->prepare("UPDATE urunler SET sil=1 WHERE urun_id=?");
        $sth->execute([$urun_id]);

        return $sth->rowCount();
    }

    public function metrikler() {
        $sth=$this->db->prepare
        ("SELECT 
                count(kullanici_id) as aktif_kullanici, SUM(case when kullanici_rutbe=7 then 1 else 0 end) as toplam_yonetici,
                (SELECT count(kategori_id) FROM kategoriler where sil=2) as toplam_kategori,
                (SELECT COUNT(hareket_id) from stokhareketleri where sil=2 ) as toplam_miktar,
                (SELECT COUNT(urun_id) from urunler where sil=2 ) as toplam_urun 
                FROM `kullanicilar` WHERE sil=2;");

        $sth->execute([]);
        return $sth->rowCount()>0? $sth->fetchObject() : [];
    }
    

}
