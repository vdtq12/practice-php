<div>
    <form action="index.php?page=signup" method="post">
        Username: <input type="text" name="username" required><br>
        Password: <input type="text" name="plaintext_password" required><br>
        <input type="submit" name="signup">
    </form>
</div>


<?php 
    $pdo = require 'connect.php';
    require 'testInput.php';

    function insertUser($pdo, $username, $plaintext_password ){
        
        try {
            $sql = "CREATE TABLE users (
                userId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                username varchar(255),
                password varchar(255)
            );";

            // $sql = "INSERT INTO products (productName, prices) VALUES ('$productName', '$price')";
            // $sql = "DROP TABLE products";

            // $conn->exec($sql);

            // insert a single publisher
            // $sql = 'INSERT INTO products (productName, prices) VALUES (:productName, :price)';

            $statement = $pdo->prepare($sql);

            // $statement->execute([
            //     ':productName' => $productName,
            //     ':price' => $price
            // ]);

        } catch(PDOException $e) {
            echo "Connection failed: "
                . $e->getMessage();
        }
    } 

    function showUser($pdo){ 
        try {
            $sql = "SELECT * FROM users";
            $statement = $pdo->query($sql);
          
            $users = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach($users as $user) {
                echo "User Name: " . $product['username'] . "<br>";
                echo "User Price: " . $product['password'] . "<br>";
                echo "User Id: " . $product['userId'] . "<br>";
                echo "<br>";
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    $username = $plaintext_password = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['signup'])){
            $username = test_input($_POST["username"]);
            $plaintext_password = test_input($_POST["plaintext_password"]);
            $hash = password_hash($plaintext_password, PASSWORD_DEFAULT); 
            echo "Generated hash: ".$hash; 
            // insertProducts($pdo, $username, $hash);
        }
    }

    // showProduct($pdo)
?>