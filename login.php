<div>
    <form action="index.php?page=login" method="post">
        Email: <input type="email" name="email" id="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" pattern=".+@.+\.com" title="Input must be in the email form" required><br>
        Password: <input type="text" name="plaintext_password" id="plaintext_password" value="<?php echo isset($_POST['plaintext_password']) ? $_POST['plaintext_password'] : ''; ?>" pattern="^(?=.*[a-zA-Z])(?=.*\d).{8,}$" title="Must contain at least one number and one letter, and at least 8 or more characters" required><br>
        <input type="submit" name="login" value="Log in">
    </form>
</div>


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
require 'action/login_process.php';
require 'ults/test_input.php';

$plaintext_password = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        $email = test_input($_POST["email"]);
        $plaintext_password = test_pasword($_POST["plaintext_password"]);
        if (!$plaintext_password) {
            echo "Password must contain at least one number and one letter, and at least 8 or more characters";
            return ;
        }
        validateUser($pdo, $plaintext_password, $email);
    }
}

?>