<?php 

namespace Entities;

class urunlerEntity {
	
	
	public $urun_id;
	public $stok_Kodu;
	public $urun_adi;
	public $aciklama;
	public $mevcut_stok;
	public $kritik_stok;
	public $guncelB_fiyat;

	const aktif=2;
	const pasif=1;

	const silinmedi=2;
	const silindi=1;
	
} 


?>