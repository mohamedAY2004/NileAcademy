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
    <title>Improved Dashboard</title>

    <link rel="stylesheet" href="./tickets.css">
</head>

<body>
    <!-- Top Dashboard -->
    <div class="top-dashboard">
        <img src="./nile-academy-high-resolution-logo.png" alt="Logo">
        <div>
            <a href="admin-Courses.php">Courses</a>
            <a href="admin-Admins.php">Admins</a>
            <a href="admin-Students.php">Students</a>
            <a href="admin-Teachers.php">Teachers</a>
            <a href="Logout.php">Logout</a>
        </div>
    </div>
    <!-- Content Section -->
    <div class="content">
        <div class="container">
            <?php
        require("Config.php");
        $teachers=mysqli_query($conn,"SELECT * FROM teachers");
        while ($row = mysqli_fetch_array($teachers))
        {
            $teacher_id=$row["teacher_id"];
            $image_name=$row["image_name"];
            $teacher_name=$row["teacher_name"];
            $teacher_phone=$row["teacher_phone"];
            echo '<div class="row">';
                echo '<div class="Information-section">';
                    echo '<div class="column">';
                        echo "<img src='./uploads/$image_name'/>";
                    echo '</div>';
                    echo '<div class="column">';
                        echo "<h3 class='mini-title'>Teacher Name</h3>";
                        echo " <p>$teacher_name</p>";
                    echo '</div>';
                    echo '<div class="column">';
                        echo "<h3 class='mini-title'>Teacher Phone</h3>";
                        echo " <p>$teacher_phone</p>";
                    echo '</div>';
                echo '</div>';
                    echo '<div class="button-area">';
                        echo '<button class="Delete-Button">';
                        echo "<a href='admin-DeleteTeacher.php?teacher_id=$teacher_id'>Delete</a>";
                        echo  '</button>';
                        echo '<button class="Update-Button">';
                        echo "<a href='admin-UpdateTeacher.php?teacher_id=$teacher_id'>Update</a>";
                        echo  '</button>';
                    echo "</div>";
                echo '</div>';
        }
        
        ?>
        </div>
        <button class="Update-Button">
            <a href="admin-AddTeacher.php">Add Teacher</a>
        </button>
    </div>
</body>

</html>