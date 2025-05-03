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
    <title>Courses</title>
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
        $courses=mysqli_query($conn,"SELECT * FROM courses");
        while ($row = mysqli_fetch_array($courses))
        {
            $course_id=$row["course_id"];
            $image_name=$row["image_name"];
            $course_name=$row["course_name"];
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
                        echo '<button class="Delete-Button">';
                        echo "<a href='admin-DeleteCourse.php?course_id=$course_id'>Delete</a>";
                        echo  '</button>';
                        echo '<button class="Update-Button">';
                        echo "<a href='admin-UpdateCourse.php?course_id=$course_id'>Update</a>";
                        echo  '</button>';
                    echo "</div>";
                echo '</div>';
        }
        
        ?>
        </div>
        <div>
            <button class="Update-Button">
                <a href="admin-AddCourse.php">Add Course</a>
            </button>
        </div>
        <div class="confirm hidden">
            <button class="close-confirm">&times;</button>
            <h1>I'm a Confirm window 😍</h1>

        </div>
        <div class="overlay hidden"></div>
        <script>
        const confirm = document.querySelector('.confirm');
        const overlay = document.querySelector('.overlay');
        const closeConfirm = () => {
            if (confirm.classList.contains('hidden')) return;
            confirm.classList.add('hidden');
            overlay.classList.add('hidden');
        }
        const openConfirm = () => {
            if (confirm.classList.contains('hidden')) {
                confirm.classList.remove('hidden');
                overlay.classList.remove('hidden');
            }
        }
        document.addEventListener('click', closeConfirm);
        document.addEventListener('keydown', function(e) {

            if (e.keyCode === 27) closeConfirm();
            else openConfirm();
        })
        </script>
</body>

</html>