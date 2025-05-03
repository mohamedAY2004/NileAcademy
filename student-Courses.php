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
    <link rel="stylesheet" href="./tickets.css">
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
    <!-- Content Section -->
    <div class="content">
        <div class="container">
        <?php
        require_once "Config.php";
        $courses= mysqli_query($conn,"SELECT * FROM courses") or die(mysqli_error($conn));
        while ($row = mysqli_fetch_array($courses)) {
            $course_id=$row["course_id"];
            $course_name=$row["course_name"];
            $image_name=$row["image_name"];
            echo '<div class="row">';
            echo '<div class="Information-section">';
            echo '<div class="column">';
            echo "<img src='./uploads/$image_name'/>";
            echo '</div>';
            echo '<div class="column">';
            echo "<h3 class='mini-title'>Course Name</h3>";
            echo " <p>$course_name</p>";
            echo '</div>';
            echo '</div>';
            echo '<div class="button-area">';
            echo "<button class='Update-Button'>";
            echo "<a href='student-teachers.php?course_id=$course_id'>View Teachers</a>";
            echo "</button>";
            echo "</div>";
            echo "</div>";
        }
        $conn->close();
        ?>
        </div>
    </div>
</body>
</html>