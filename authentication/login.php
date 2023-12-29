<?php
session_start();
if(isset($_SESSION['username'])){
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h1>Login</h1>

    <form action="check_login.php" method="post">
        <?php 
            if(isset($_GET['error'])){
                echo $_GET['error'] . "<br><br>";
            }
        ?>
        <label>Username:</label>
        <br>
        <input type="text" name="username" required>
        <br>
        <label>Password:</label>
        <br>
        <input type="password" name="password" required>
        <br>
        <input type="submit" value="Login" required>
    </form>
    <label>Don't have an account?</label>
    <a href="signup.php">Create an account</a>
</body>
</html>
