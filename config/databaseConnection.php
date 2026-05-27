<?php 

	$servername="localhost";
	$username="root";
	$password="";
	$database="stokTakip";
	
	try{
		//PDO bağlantısını oluştur.
		$pdo= new PDO ("mysql:host=$servername;dbname=$database;charset=utf8mb4", $username, $password);
		
		//PDO Hata modunu ayarla
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		
		//echo "Bağlantı Başarılı";
		
	}catch(PDOException $error){
		
		echo "Bağlantı Başarısız";
		die("Bağlantı Hatası:".$error->getMessage() );
	}
	

	//document.cookie   =>PHPSESSID="abc342435dfgdf"; başka_cerez=değer
	
	ini_set('session.cookie_httponly',1);
	
	//Session ID/Kimliğini URL'de taşınmasın
	ini_set('session.use_only_cookies',1);
	
	
	/*
	  $username="root";
	  $password=""; 
	  
	*/
	session_start();


?>