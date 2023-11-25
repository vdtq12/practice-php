<?php
    function validateUser($pdo, $plaintext_password, $email){
            
        try {
            $sql = 'SELECT * FROM users WHERE email = :email';

            $statement = $pdo->prepare($sql);

        
            $statement->execute([
                ':email' => $email
            ]);

            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if (password_verify($plaintext_password, $user['password'])) {
                $_SESSION['login']['username'] = $user['username'];
                $_SESSION['login']['usermail'] = $user['email'];
                setcookie('user', $user['username'], time() + 3600);
                if ($user['role'] == 1){
                    $_SESSION['login']['role'] = 'admin';
                    setcookie('role', 'admin', time() + 3600);
                    header("location: index.php?page=dashboard");
                }
                else if ($user['role'] == 2) {
                    $_SESSION['login']['role'] = 'user';
                    setcookie('role', 'user', time() + 3600);                   
                    header("location: index.php?page=home");
                }
            } else {
                echo "Wrong email or password";
            }

        } catch(PDOException $e) {
            echo "Connection failed: "
                . $e->getMessage();
        }
    } 
?>