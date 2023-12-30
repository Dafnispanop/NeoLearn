<?php
//require ("signHeader.php");
require ("connect.php");
?>
<h1> Verify Account</h1>

<?php
//require ("signFooter.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["token"]) ){
        $verify_token = $_GET["token"];
        $verify_status = haveToken( $conn, $verify_token);

        // Handle the verification status
        if ($verify_status == 1)  echo "<h3>Your Account has been verified <strong>Successfully</strong></h3>";
        else if($verify_status == 2) echo "<h3>Your account has <strong> already<strong> been verified</strong>";
        else if($verify_status == 0)echo "<br><br>The link is <strong>invalid</strong>";
        echo "Wait <strong>3 seconds</strong> to redirect you to <strong>sign in</strong> page";
        header("refresh:3;url=process_signIn.php"); // Redirect for sign in after 5 seconds 
}

// Function to check if a token is valid and update the verification status
function haveToken($conn, $verify_token) {
        $query = "SELECT verify_token, verified FROM users WHERE verify_token = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $verify_token);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
    
            if ($row['verified'] == 1) return 2; // Already verified
            else return 1; // Not verified
        } else {
            return 0; // Invalid token Can't be verified
        }
    }
?>
