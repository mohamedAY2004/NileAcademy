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
        $courses= mysqli_query($conn,"SELECT * FROM courses") or die(mysqli_error($conn));
        while ($row = mysqli_fetch_array($courses)) {
            $course_id=$row["course_id"];
            $course_name=$row["course_name"];
            $image_name=$row["image_name"];
            echo" <a href=student-teachers.php?course_id=$course_id>";
            echo "<div class='card'>";
            echo "<img src='./uploads/$image_name' alt='$course_name Image' width='300px' height='200px'>";
            echo "<hr/>";
            echo "<h3> $course_name </h3>";
            echo "</div>";
            echo "</a>";
        }
        $conn->close();
    ?>
    </div>

</body>

</html>