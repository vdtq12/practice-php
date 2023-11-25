<?php 
    if (!isset($_SESSION['login']['username'])) {
        header('location: index.php?page=login');
        exit();
    }

    echo "this is admin dashboard";
?>