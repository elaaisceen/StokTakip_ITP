<?php 

namespace Entities;

class urunlerEntity {
	
	
	public $urun_id;
	public $kategori_id;
	public $stok_Kodu;
	public $urun_adi;
	public $aciklama;
	public $mevcut_stok;
	public $kritik_stok;
	public $guncelB_fiyati;
	public $sil;

	const silinmedi=2;
	const silindi=1;
	
} 


?>