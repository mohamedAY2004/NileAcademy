<?php 
session_start();
if(!isset($_SESSION["Type"]) || $_SESSION["Type"] != "admins"){
    header("Location: Login.php");
    exit(); // Prevents further code execution after the redirect
}
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
// define variables and set to empty values
$student_name = $student_phone = $student_pass = $parent_phone="" ;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $student_name = clean_input($_POST["student_name"]);
  $student_phone =clean_input($_POST["student_phone"]);
  $student_pass = clean_input($_POST["student_pass"]);
  $parent_phone = clean_input($_POST["parent_phone"]);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nile Academy - Add Course</title>
    <link rel="stylesheet" href="./insertion.css"/>
</head>

<body>
    <form action="admin-AddStudent.php" method="POST" enctype="multipart/form-data">
        <h1>Nile Academy</h1>

        <label for="student_name">Student Name</label>
        <?php
        if(isset(($_POST["student_name"]))&&empty($student_name)){
            echo "<h5 style='color: red;'>Name Can't be empty</h5>";
            unset($_POST["submit"]);
        }
        ?>
        <input type="text" id="student_name" name="student_name" placeholder="Enter Student Name" required>
        <?php
        if(isset(($_POST["student_phone"]))){
            require "Config.php";
            $student_phone=$_POST["student_phone"];
            $sql="SELECT student_name FROM students WHERE student_phone ='$student_phone'";
            $students=mysqli_query($conn,$sql);
            if($row=mysqli_fetch_array($students)){
                echo "<h5 style='color: red;'>Student Phone already exists</h5>";
                unset($_POST["submit"]);
            }
            $conn->close();
        }
        ?>   
     <?php
                if(isset(($_POST["student_phone"]))&&trim($student_phone) === ""){
                    echo "<h5 style='color: red;'>Student Phone Can't be empty</h5>";
                    unset($_POST["submit"]);
                }
        ?><label for="student_phone">Student Phone</label>
        <input type="tel" id="student_phone" name="student_phone" placeholder="Enter Student Phone" minlength="11" maxlength="11" required>
        <?php
                if(isset(($_POST["parent_phone"]))&&trim($parent_phone) === ""){
                    echo "<h5 style='color: red;'>Parent Phone Can't be empty</h5>";
                    unset($_POST["submit"]);
                }
        ?>
        <label for="parent_phone">Parent Phone</label>
        <input type="tel" id="parent_phone" name="parent_phone" placeholder="Enter Parent Phone" minlength="11" maxlength="11" required>
        <?php
        if(isset(($_POST["student_pass"]))&&trim($student_pass) === ""){
            echo "<h5 style='color: red;'>Name Can't be empty</h5>";
            unset($_POST["submit"]);
        }
        ?>
        <label for="student_pass">Student Password</label>
        <input type="password" id="student_pass" name="student_pass" placeholder="Enter Password"  required>
       <?php
        if(isset($_POST["confirm_pass"])){
            $password=$_POST["student_pass"];
            $confirm=$_POST["confirm_pass"];
            if($password!==$confirm){
                echo "<a style='color: red;'>Student Phone already exists</a>";
                unset($_POST["submit"]);
            }
        }
       
       
       
       ?>
        <label for="confirm_pass">Confirm Password</label>
        <input type="password" id="confirm_pass" name="confirm_pass" placeholder="Confirm Password"  required>
       <?php
       if(isset($_FILES["image"])){


          // Define the upload directory
          $targetDir = "uploads/";
    
          // Check if the 'uploads' directory exists, if not create it
          if (!is_dir($targetDir)) {
              mkdir($targetDir, 0777, true);
          }
      
          // Get the uploaded file details
          $fileName = basename($_FILES["image"]["name"]);
          $targetFilePath = $targetDir . $fileName;
          // Allowed file types
          $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
          $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
      
          // Check if the file is a valid image
          if (!in_array($fileType, $allowedTypes)){
            echo "<h5 style='color: red;'>Type mismatch only accept'jpg', 'jpeg', 'png', 'gif'</h5>";
                unset($_POST["submit"]);
          }
       }
       
       ?>
        <label for="image">Student Image:</label>
        <input type="file" name="image" id="image" >
        <input type="submit" name="submit" value="Upload">
        <button class="Delete-Button">
            <a href="admin-Students.php">Cancel</a>
        </button>
    </form>
</body>

</html>
 <?php
if (isset(($_POST["submit"]))) 
{
        require "Config.php";
        // Define the upload directory
        $targetDir = "uploads/";
    
        // Check if the 'uploads' directory exists, if not create it
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
    
        // Get the uploaded file details
        $fileName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $fileName;
   
            // Upload file to server
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                echo "Image Added Successfully";
            } 
        
        $student_name = $_POST["student_name"];
        $student_phone = $_POST["student_phone"];
        $student_pass = $_POST["student_pass"];
        $parent_phone= $_POST["parent_phone"];
        $image_name = $fileName;
        $sql = "INSERT INTO Students (student_name,student_phone,student_pass,parent_phone,image_name) values ('$student_name','$student_phone','$student_pass','$parent_phone','$image_name')";
        if (mysqli_query($conn, $sql)) {
            echo 'One row added';
        } else
            echo mysqli_error($con);
        $conn->close();
        header("Location: admin-Students.php");
        exit();
}
    
?>

