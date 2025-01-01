<?php 
session_start();
if(!isset($_SESSION["Type"]) || $_SESSION["Type"] != "admins"){
    header("Location: Login.php");
    exit(); // Prevents further code execution after the redirect
}
if(isset($_GET["course_id"])){
    require "Config.php";
$course_id=$_GET["course_id"];
$sql="DELETE FROM Courses WHERE course_id='$course_id'";
$result=mysqli_query($conn,$sql);
header("Location: admin-Courses.php");
}else{
    // header("Location: Welcome.php");
    echo"failed";
}

?>

