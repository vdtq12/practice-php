<div class="position-relative my-4">
    <form action="index.php?page=products" method="post" class="d-flex ">
        <input type="text" autocomplete="off" name="searchTerm" id="searchTerm" placeholder="Input name of product..." value="<?php echo isset($_POST['searchTerm']) ? $_POST['searchTerm'] : ''; ?>" onkeyup="searchProducts(this.value)" required class="w-25"><br>
        <input type="submit" name="search" value="Search">
    </form>
    <div id="searchResults" ></div>
</div>

<?php
function getProducts($searchTerm, $pdo)
{
    try {
        $sql = "SELECT * FROM products WHERE productName LIKE :searchTerm";

        $statement = $pdo->prepare($sql);


        $statement->execute([
            ':searchTerm' => $searchTerm . '%'
        ]);

        $products = $statement->fetchAll(PDO::FETCH_ASSOC);

        if ($products) {
            foreach ($products as $product) {
                echo "Product Name: " . $product['productName'] . "<br>";
                echo "Product Price: " . $product['prices'] . "<br>";
                echo "Product Id: " . $product['productId'] . "<br>";
                echo "<br>";
            }
        } else {
            echo "No product founded!";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['search'])) {
        $searchterm = test_input($_POST["searchTerm"]);
        getProducts($searchterm, $pdo);
    }
}
?>