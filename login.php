<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "Sistem/loader.php";
require_once "Sistem/fonksiyon.php"; 


?>
<!doctype html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Sayfası</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  </head>
  
  <?php 

	require_once $code->checkAccess() ? 'Pages/default.php' : 'Pages/loginform.php';

 
 ?>
</html>