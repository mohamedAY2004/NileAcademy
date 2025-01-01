<?php 
session_start();
if(!isset($_SESSION["Type"]) || $_SESSION["Type"] != "students"){
    header("Location: Login.php");
    exit(); // Prevents further code execution after the redirect
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <link rel="stylesheet" href="./student-courses.css" />
    <link rel="stylesheet" href="./nav-bar.css" />
</head>

<body>

    <!-- Top Dashboard -->
    <div class="top-dashboard">
        <img src="./nile-academy-high-resolution-logo.png" alt="Logo">
        <div>
            <a href="MyAccount.php?student_id=<?php echo $_SESSION["Row"]["student_id"];?>">MyAccount</a>
            <a href="Logout.php">Logout</a>
        </div>
    </div>
    <!-- Cards Section -->
    <div class="card-container">
        <?php
       require_once "Config.php";
       $course_id=$_GET["course_id"];
       $teachers= mysqli_query($conn,"SELECT * FROM teachers WHERE course_id='$course_id'") or die(mysqli_error($conn));
       while ($row = mysqli_fetch_array($teachers))
        {
            $teacher_id=$row["teacher_id"];
            $teacher_name=$row["teacher_name"];
            $image_name=$row["image_name"];
           echo "<a href=student-lectures.php?teacher_id=$teacher_id>";
            echo "<div class='card'>";
            echo "<img src='./uploads/$image_name' alt='$teacher_name Image' width='300px' height='200px'>";
            echo "<hr/>";
            echo "<h3> $teacher_name </h3>";
            echo "</div>";
            echo "</a>";
        }
        $conn->close();
        ?>


    </div>

</body>

</html>