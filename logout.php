<?php 
    if (!isset($_SESSION['login']['username'])) {
        header('location: index.php?page=login');
        exit();
    }

    unset($_SESSION['login']);
    unset($_COOKIE['user']); 
    setcookie('user', '', time() - 3600); 
    setcookie('role', '', time() - 3600); 
    header('location: index.php?page=login');
?>