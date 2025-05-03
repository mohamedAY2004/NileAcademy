<?php	session_start(); session_regenerate_id();?>
<?php

if(isset($_SESSION["Type"]) ){
    switch($_SESSION["Type"]){
        case "students":
            header("Location: student-Courses.php");
            exit();  // It's good practice to call exit() after a header redirect
        case "admins":
            header("Location: admin-Courses.php");
            exit();
        case "teachers":
            header("Location: teacher.php");
    
    }
}else{
    session_destroy();
    header("Location: Login.php");
}
?>