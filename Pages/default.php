<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v5.5.0
* @link https://coreui.io/product/free-bootstrap-admin-template/
* Copyright (c) 2026 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://github.com/coreui/coreui-free-bootstrap-admin-template/blob/main/LICENSE)
-->
<?php
require_once(__DIR__ . "/../Sistem/loader.php");
require_once(__DIR__ . "/../Sistem/fonksiyon.php");
require_once(__DIR__ . "/../Sistem/header.php");
?>
<html lang="tr">
 <main class="app-main" style="min-height: 79vh;">
    <?php
        $do = $_GET["do"] ?? "anasayfa";
        
        $hedefDosya = __DIR__ . "/page_{$do}.php";

        if(file_exists($hedefDosya)){
            require_once($hedefDosya);
        } else {
            require_once(__DIR__ . "/anasayfa.php");
        }
    ?>
</main>
    

  
<!-- footer -->
  <?php require_once(__DIR__ . "/../Sistem/footer.php"); ?>
</body>

</html>