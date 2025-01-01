<?php 
session_start();
if(!isset($_SESSION["Type"]) || $_SESSION["Type"] != "admins"){
    header("Location: Login.php");
    exit(); // Prevents further code execution after the redirect
}
if(isset($_GET["teacher_id"])){
    require "Config.php";
$teacher_id=$_GET["teacher_id"];
$sql="DELETE FROM Teachers WHERE teacher_id='$teacher_id'";
$result=mysqli_query($conn,$sql);
// echo"success";
header("Location: admin-Teachers.php");
}else{
    // header("Location: Welcome.php");
    // echo"failed";
}
?>
