<?php 
require ("connect.php"); // to connect database
require ("/email_procces/email_validate.php");//check if the email is valid
require ("/email_procces/email_send.php");// to send verification codes to emails with PHPMailer
require ("/email_procces/email_verify.php");// Email verification logic

$verify_token = md5(rand());
if( sendMail_verify($email, $verify_token) == false ) echo "<br> Can't send verification Link to this email. Try again or try another mail !!";    
    
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST["Sign Up"])) {
    $email = $_POST["email"]; 
    $password = $_POST["password"]; 
    $username = $_POST["username"]; 
    
    $hashedPassword = password_hash($password, 'SHA1'); 
    $verify_token = md5(rand());

    if( haveMail($email) ) echo "<br>A user with that E-Mail already exists";
    else if( validate_email($email)  == false) echo "<br>E-Mail is not valid";
    else if( sendMail_verify($email, $verify_token) == false ) echo "<br> Can't send verification Link to this email. Try again or try another mail !!";    
    else{
        insertUser ($conn, $email, $password, $username , $verify_token);
        
        echo "<h2><br> Check your E-Mail for verification link</h2><br><br>";
    }
} 
        
    

function insertUser($conn, $email, $password, $username , $verify_token){
        //INSERT USER
        $query = "INSERT INTO user(email, password, username, verify_token) VALUES ?,?,?,?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssss", $email, $password, $username, $verify_token);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if($result) echo "<br>Registarration Succcesfull ! <br>Check your E-Mail for verification link";
        else echo "Try again!! Something went wrong ";
        /*OR 
        $stmt = $pdo -> prepare ("INSERT INTO user(user_type, user_email, user_password, user_name) VALUES ?,?,?,?");
        $stmt -> bind_param( "isss", $user_type, $email, $password, $username);
        $stmt -> execute();
        */
      

}

//Check if the email has alraedy exist
function haveMail($email){
    global $conn;
    $query = "SELECT * FROM user WHERE email = ? LIMIT 1" ;
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) return true;
    else return false;
}
?>