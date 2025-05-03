<?php 
session_start();
if(!isset($_SESSION["Type"]) || $_SESSION["Type"] != "admins"){
    header("Location: Login.php");
    exit(); // Prevents further code execution after the redirect
}
if(isset($_POST["student_id"])){
    require "Config.php";
$student_id=$_POST["student_id"];
$sql="DELETE FROM Students WHERE student_id='$student_id'";
$result=mysqli_query($conn,$sql);
// echo"success";
header("Location: admin-Students.php");
}else{
    // header("Location: Welcome.php");
    echo"failed";
}
?>

