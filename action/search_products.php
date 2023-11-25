<?php
try {
    require '../config.php';
    $pdo = require '../db/connect.php';

    $searchTerm = $_POST['searchTerm'];
    
    $sql = "SELECT * FROM products WHERE productName LIKE :searchTerm";
    
    $statement = $pdo->prepare($sql);
    
    
    $statement->execute([
        ':searchTerm' => $searchTerm . '%'
    ]);
    
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    header('Content-Type: application/json');
    echo json_encode($products);
    // header('Content-Type: application/x-www-form-urlencoded');
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
