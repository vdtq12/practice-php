<?php 
    if (!isset($_SESSION['login']['username'])) {
        header('location: index.php?page=login');
        exit();
    }

    require "components/loadDoc.php";
    require "components/select_country.php";
?>

