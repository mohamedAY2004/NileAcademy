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
    <title>Teachers</title>
    <link rel="stylesheet" href="./tickets.css">
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
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
            $teachers = mysqli_query($conn, "SELECT t.*, c.course_name 
                                           FROM teachers t 
                                           LEFT JOIN courses c ON t.course_id = c.course_id");
            while ($row = mysqli_fetch_array($teachers)) {
                $teacher_id = $row["teacher_id"];
                $image_name = $row["image_name"];
                $teacher_name = $row["teacher_name"];
                $teacher_phone = $row["teacher_phone"];
                $course_name = $row["course_name"];
                $teacher_balance = $row["teacher_balance"]; // Add this line

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
                echo '<div class="column">';
                echo "<h3 class='mini-title'>Course</h3>";
                echo " <p>$course_name</p>";
                echo '</div>';
                echo '<div class="column">';
                echo "<h3 class='mini-title'>Balance</h3>";
                echo " <p>$" . number_format($teacher_balance, 2) . "</p>";
                echo '</div>';
                echo '</div>';
                    echo '<div class="button-area">';
                        echo '<form method="POST" action="admin-DeleteTeacher.php">';
                        echo  "<input type='hidden' name='teacher_id' value='$teacher_id'>";
                        echo '<button class="Delete-Button" onclick="return confirmDelete();"> Delete</button>';
                        echo '</form>';
                        echo '<button class="Update-Button">';
                        echo "<a href='admin-UpdateTeacher.php?teacher_id=$teacher_id'>Update</a>";
                        echo "</button>";
                        echo "</div>";
                echo '</div>';
        }
        
        ?>
        </div>
        <div>
            <button class="Update-Button">
                <a href="admin-AddTeacher.php">Add Teacher</a>
            </button>
        </div>
    </div>
</body>
</html>
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this record?");
    }
</script>