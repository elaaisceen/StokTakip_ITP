<?php 

// Tüm Hataları Göster
error_reporting(E_ALL);

ini_set("display_errors",1);

ob_start();
spl_autoload_register(function ($className){
	
	
	$className=str_replace('\\',DIRECTORY_SEPARATOR,$className);
	$file=__DIR__.DIRECTORY_SEPARATOR."{$className}.php";
	if (is_readable($file)) require_once $file;
	
});
session_start();

$code = new Classes\code();
$code->connect2db();

$ayarlar=$code->getSettings();

define("PATH", realpath("."));
define("URL", $ayarlar->site_url);
define("TEMA_URL", $ayarlar->site_url."/tema/".$ayarlar->site_tema);
define("TEMA",PATH."/tema/".$ayarlar->site_tema);

$kullanici_rutbe = $_SESSION['kullanici_rutbe'] ?? 0;
$kullanici_id    = $_SESSION['kullanici_id'] ?? 0;
$kullanici_adi   = $_SESSION['kullanici_adi'] ?? '';

?>