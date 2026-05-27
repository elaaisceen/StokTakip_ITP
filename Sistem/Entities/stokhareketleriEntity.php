<?php

namespace Entities;

class stokhareketleriEntity {
	public $hareket_id;
	public $hareket_durummu;
	public $miktar;
	public $islem_durumu;
	public $islem_ucreti;
    public $dokuman_no;
    public $islem_tarihi;
    public $sil;

    const silindi=1;
    const silinmedi=2;
}
?>