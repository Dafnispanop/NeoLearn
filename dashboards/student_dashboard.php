<?php
session_start();
if(isset($_SESSION['username'])){
    switch($_SESSION['role']){
        case 'teacher':
            header("Location: teacher_dashboard.php");
            break;
        case 'admin':
            header("Location: admin_dashboard.php");
            break;
    }
}
else{
    header("Location: ../authentication/login.php");
}
echo "Hello student " . $_SESSION['username'];
echo "<br>Role " . $_SESSION['role'];
?>
<br>
<a href="../authentication/logout.php">Logout</a>