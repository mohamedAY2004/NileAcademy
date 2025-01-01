<?php 
session_start();
if(!isset($_SESSION["Type"]) || $_SESSION["Type"] != "admins"){
    header("Location: Login.php");
    exit(); // Prevents further code execution after the redirect
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
    <form action="admin-AddCourse.php" method="POST" enctype="multipart/form-data">
        <h1>Nile Academy</h1>

        <label for="course_name">Course Name</label>
        <input type="text" id="course_name" name="course_name" placeholder="Enter Course Name" required>

        <label for="image">Course Image:</label>
        <input type="file" name="image" id="image" required>
        <input type="submit" name="submit" value="Upload">
        <button class="Delete-Button">
            <a href="admin-Courses.php">Cancel</a>
        </button>
    </form>
</body>

</html>


<?php
if (isset(($_POST["submit"]))) {
    echo "before :";
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
        echo $fileName;
        // Allowed file types
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    
        // Check if the file is a valid image
        if (in_array($fileType, $allowedTypes)) {
            // Upload file to server
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                echo "Image Added Successfully";
            } 
        }
        $course_name = $_POST["course_name"];
        $image_name = $fileName;
        $sql = "INSERT INTO Courses (course_name,image_name) values ('$course_name','$image_name')";
        echo "course added successfully";
        if (mysqli_query($conn, $sql)) {
            echo 'One row added';
        } else
            echo mysqli_error($con);
        $conn->close();
        header("Location: admin-Courses.php");
        exit();
    }

?>