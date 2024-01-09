<?php
require ("../connect.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

    $email = test_input($_POST['user_email']);
    $password = test_input($_POST['user_password']);
    
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $stored_hashed_password = $row['password'];

        if (password_verify($password, $stored_hashed_password)) {
            session_start();
            $_SESSION['id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
           // header("Location: ../index.php");
           echo "You have successfully logged in";
        } else {
            header("Location: login.php?error=Incorrect password");
        }
    } else {
        header("Location: login.php?error=User not found");
    }

}

?>