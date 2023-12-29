<?php
session_start();
if(isset($_SESSION['username'])){
    
    switch($_SESSION['role']){
        case 'student':
            header("Location: student_dashboard.php");
            break;
        case 'teacher':
            header("Location: teacher_dashboard.php");
            break;
    }
}
else{
    header("Location: ../authentication/login.php");
}
echo "Hello admin " . $_SESSION['username'];
echo "<br>Role " . $_SESSION['role'];
?>
<br>
<a href="../authentication/logout.php">Logout</a>