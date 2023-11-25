<?php 
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function test_email($data, $pdo) {
        $data = test_input($data);
        try {
            $sql = 'SELECT * FROM users WHERE email = :email';
    
            $statement = $pdo->prepare($sql);
    
            $statement->execute([
                ':email' => $data,
            ]);

            $row = $statement->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return null;
            }
            else {
                return $data;
            }
        } catch (PDOException $e) {
            echo "Connection failed: "
                . $e->getMessage();
        }
    }
    
    function test_pasword($data){
        $data = test_input($data);
        if( preg_match('/^(?=.*[a-zA-Z])(?=.*\d).{8,}$/', $data)) {
            return $data;
        }
        else {
            return null;
        }
    }

    function test_username($data, $pdo) {
        $data = test_input($data);
        try {
            $sql = 'SELECT * FROM users WHERE username = :username';
    
            $statement = $pdo->prepare($sql);
    
            $statement->execute([
                ':username' => $data,
            ]);

            $row = $statement->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return null;
            }
            else {
                return $data;
            }
        } catch (PDOException $e) {
            echo "Connection failed: "
                . $e->getMessage();
        }
    }
?>