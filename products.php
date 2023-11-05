<div>
    <form action="index.php?page=products" method="post">
        ProductName: <input type="text" name="productName" required><br>
        Price: <input type="text" name="price" required><br>
        <input type="submit" name="insert">
    </form>

    <form method="post"> 
        <input type="submit" name="deleteLast" value="Delete Last" /> 
    </form> 
</div>


<?php 
    $pdo = require 'connect.php';
    require 'testInput.php';

    function insertProducts($pdo, $productName, $price){
        
        try {
            // SQL query to create the database
            // $sql = "CREATE DATABASE OnlineStore";
            // $sql = "CREATE TABLE products (
            //     productId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
            //     productName varchar(255),
            //     prices varchar(255)
            // );";

            // $sql = "INSERT INTO products (productName, prices) VALUES ('$productName', '$price')";
            // $sql = "DROP TABLE products";

            // $conn->exec($sql);

            // insert a single publisher
            $sql = 'INSERT INTO products (productName, prices) VALUES (:productName, :price)';

            $statement = $pdo->prepare($sql);

            $statement->execute([
                ':productName' => $productName,
                ':price' => $price
            ]);

        } catch(PDOException $e) {
            echo "Connection failed: "
                . $e->getMessage();
        }
    } 

    function showProduct($pdo){ 
        try {
            $sql = "SELECT * FROM products";
            $statement = $pdo->query($sql);
          
            $products = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach($products as $product) {
                echo "Product Name: " . $product['productName'] . "<br>";
                echo "Product Price: " . $product['prices'] . "<br>";
                echo "Product Id: " . $product['productId'] . "<br>";
                echo "<br>";
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function deleteLast($pdo) {
        try {
            $sql = "DELETE FROM products ORDER BY productId DESC LIMIT 1;";

            $statement = $pdo->prepare($sql);
            
            $statement->execute();

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    $productName = $price = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['insert'])){
            $productName = test_input($_POST["productName"]);
            $price = test_input($_POST["price"]);
            insertProducts($pdo, $productName, $price);
        }
        else if (isset($_POST['deleteLast'])){
            deleteLast($pdo);
        }
    }

    showProduct($pdo)
?>