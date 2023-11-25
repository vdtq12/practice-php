<div>
    <form action="index.php?page=signup" id="signupform" method="post">
        Email: <input type="email" name="email" id="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" pattern=".+@.+\.com" title="Input must be in the email form" required><br>
        Username: <input type="text" name="username" id="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" required><br>
        Password: <input type="text" name="plaintext_password" id="plaintext_password" value="<?php echo isset($_POST['plaintext_password']) ? $_POST['plaintext_password'] : ''; ?>" pattern="^(?=.*[a-zA-Z])(?=.*\d).{8,}$" title="Must contain at least one number and one letter, and at least 8 or more characters" required><br>
        <input type="submit" name="signup" value="Sign up">
    </form>
</div>

<script>
    // email input must be email: validate at email input form
    // username must not be duplicate
    // pwd must be at least 8 chars + contain both letter and number: validate at password input form
    // pattern=".+@.+\.com" title="Input must be in the email form"
    // pattern="^(?=.*[a-zA-Z])(?=.*\d).{8,}$" title="Must contain at least one number and one letter, and at least 8 or more characters"
</script>


<?php
if (isset($_SESSION['login']['username']) && $_SESSION['login']['role'] == 'admin') {
    header('location: index.php?page=dashboard');
    exit();
} else if (isset($_SESSION['login']['username']) && $_SESSION['login']['role'] == 'user') {
    header('location: index.php?page=home');
    exit();
}

require 'config.php';
$pdo = require 'db/connect.php';
require 'ults/test_input.php';

function insertUser($pdo, $username, $hash_password, $email)
{

    try {
        // $sql = "CREATE TABLE users (
        //     userId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
        //     username varchar(255),
        //     password varchar(255),
        //     email varchar(255),
        //     role int
        // );";
        // role = 1 - admin; 2 - user;

        // insert a single publisher
        $sql = 'INSERT INTO users (username, password, email, role) VALUES (:username, :password, :email, 2)';

        $statement = $pdo->prepare($sql);

        $statement->execute([
            ':username' => $username,
            ':password' => $hash_password,
            ':email' => $email
        ]);
    } catch (PDOException $e) {
        echo "Connection failed: "
            . $e->getMessage();
    }

    return true;
}

$username = $plaintext_password = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['signup'])) {
        $display = array(
            'username' => '',
            'email' => '',
            'password' => ''
        );
        foreach($_POST as $key => $value){
            if(isset($display[$key])){
                $display[$key] = htmlspecialchars($value);
            }
        }

        $username = test_username($_POST["username"], $pdo);
        if (!$username) {
            echo "This username has been used";
            return ;
        }
        $email = test_email($_POST["email"], $pdo);
        if (!$email) {
            echo "This email has been used";
            return ;
        }
        $plaintext_password = test_pasword($_POST["plaintext_password"]);
        if (!$plaintext_password) {
            echo "Password must contain at least one number and one letter, and at least 8 or more characters";
            return ;
        }
        $hash = password_hash($plaintext_password, PASSWORD_DEFAULT);
        if (insertUser($pdo, $username, $hash, $email)) {
            header('location: index.php?page=login');
        }
        else {
            echo 'There are some errors. Please sign up again!';
        }
    }
}
?>