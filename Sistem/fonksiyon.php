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
			
			echo "<meta http-equiv='refresh' content'$saniye;url=$url'>";
			exit;
			
		}
		
		
	}



	function temizle($text){
		//baş ve sondaki boşlukları temizler
		$text=trim($text);
		
		//HTML özel karakterleri temizler ve güvenli hale getirir
		$text=htmlspecialchars($text);
		
		//HTML taglarini kaldır
		$text=strip_tags($text);
		
		
		return $text;
		
		
		
	}
	function g($par){
		$get=$_GET[$par] ?? '';
		return strip_tags(trim(addslashes($get)));
	}
	
	
	function gecerliSifremi($sifre){
		
			$pattern='/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).{8,}$/';

			return preg_match($pattern,$sifre)===1;	
		
		
	}
	
	
	
		function hesapNotumu($not2,$not1){
			
			$sonuc=($not1*40/100)+($not2*60/100);
			
			return $sonuc;
			
			
		}
		
		function durumagoreHesapla($vize,$final,$quiz="yok"){
			
			if($quiz=="yok"){
				$sonuc=($vize*40/100)+($final*60/100);
				
			}else{
				
				$sonuc=($vize*30/100)+($quiz*20/100)+($final*50/100);
			}
			
			return $sonuc;
			
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