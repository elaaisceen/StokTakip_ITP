<?php 

	function go ($url,$saniye=0){
		
		if(!headers_sent()){
			
			if ($saniye == 0){
				
				header("Location: $url");
			}else{
				
				header("Refresh: $saniye; URL=$url");
			}
			exit;
		}else{
			
			echo "<meta http-equiv='refresh' content='$saniye;url=$url'>";
			exit;
			
		}
		
		
	}



	function temizle($veri) {
    // Veri null gelirse boş string'e çevir, yoksa string tipine zorla (cast)
    $veri = (string)$veri; 
    return trim(htmlspecialchars(strip_tags($veri)));
}
		
	function g($par){
		$get=$_GET[$par] ?? '';
		return strip_tags(trim(addslashes($get)));
	}
	
	
	function gecerliSifremi($sifre){
		
			$pattern='/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).{8,}$/';

			return preg_match($pattern,$sifre)===1;	
		
		
	}
	
		
		function giris($user,$password){
				global $kullanici_adi;
				global $sifre;global $kullanici_adi;
				global $sifre;
				if ($user==$kullanici_adi and $password==$sifre){
					$login=true;
				}else{
					$login=false;
				}
			return $login;
			
		}


?>