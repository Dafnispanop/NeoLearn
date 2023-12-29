<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: authentication/login.php");
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

<?php
    switch($_SESSION['role']){
        case "teacher":
            header("Location: dashboards/teacher_dashboard.php");
            break;
        case "student":
            header("Location: dashboards/student_dashboard.php");
            break;
        case "admin":
            header("Location: dashboards/admin_dashboard.php");
            break;
    }

?>

</body>
</html>