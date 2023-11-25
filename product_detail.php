<?php
if (!isset($_SESSION['login']['username'])) {
    header('location: index.php?page=login');
    exit();
}

require 'config.php';
$pdo = require 'db/connect.php';

if (isset($url_components['query'])) { // isset check if url component query is there or not
    parse_str($url_components['query'], $params);
    if (!$params['product_id']) {
        require "products.php";
    }

    $product_id = $params['product_id'];

    try {
        $sql = "SELECT * FROM products WHERE productId = :product_id";

        $statement = $pdo->prepare($sql);


        $statement->execute([
            ':product_id' => $product_id
        ]);

        $product = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            header('location: index.php?page=products');
            exit();
        }

        echo "<h3>This is the detail information of product " . $product['productName'] . "</h3>";
        echo "Product Name: " . $product['productName'] . "<br>";
        echo "Product Price: " . $product['prices'] . "<br>";
        echo "Product Id: " . $product['productId'] . "<br>";
        echo "<br>";

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header('location: index.php?page=home');
    exit();
}
