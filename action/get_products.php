<?php
try {
    require '../config.php';
    $pdo = require '../db/connect.php';
    $noItem = $_GET["noItem"];
    $page = $_GET["page"];

    $sql = "SELECT * FROM products LIMIT " . ($page*$noItem) . "," . ($page*$noItem + $noItem) . " ;";
    $statement = $pdo->query($sql);

    $products = $statement->fetchAll(PDO::FETCH_ASSOC);

    $query = "SELECT COUNT(*) as total_rows FROM products";
    $stmt = $pdo->query($query);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Echo total rows
    // echo "Total rows: " . $result['total_rows'];

    // Create an XML document
    // $filePath = 'products.xml';
    $dom = new DOMDocument('1.0', 'UTF-8');
    $root = $dom->createElement('products');

    for($i=0; $i<count($products); $i++){
        $q_productId = $products[$i]['productId'];
        $q_productName = $products[$i]['productName'];
        $q_prices = $products[$i]['prices'];

        $product = $dom->createElement('product');
        $product->setAttribute('id', $q_productId);

        $productId = $dom->createElement('productId', $q_productId); 
        $product->appendChild($productId);
        $productName = $dom->createElement('productName', $q_productName); 
        $product->appendChild($productName);
        $prices = $dom->createElement('prices', $q_prices); 
        $product->appendChild($prices);

        $root->appendChild($product);
    }

    $total_products = $dom->createElement('total_products', $result['total_rows']);
    $root->appendChild($total_products);


    $dom->appendChild($root); 
    // $dom->save($filePath); 

    header('Content-Type: text/xml');
    echo $dom->saveXML();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
