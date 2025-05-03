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
    <title>Students</title>
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
    <div class="content">
        <!-- Content Section -->
        <div class="container">
            <?php
            require("Config.php");
            $students = mysqli_query($conn, "SELECT * FROM students");
            while ($row = mysqli_fetch_array($students)) {
                $student_id = $row["student_id"];
                $image_name = $row["image_name"];
                $student_name = $row["student_name"];
                $student_phone = $row["student_phone"];
                $student_balance = $row["student_balance"]; // Add this line

                echo '<div class="row">';
                echo '<div class="Information-section">';
                echo '<div class="column">';
                echo "<img src='./uploads/$image_name'/>";
                echo '</div>';
                echo '<div class="column">';
                echo "<h3 class='mini-title'>Student Name</h3>";
                echo " <p>$student_name</p>";
                echo '</div>';
                echo '<div class="column">';
                echo "<h3 class='mini-title'>Student Phone</h3>";
                echo " <p>$student_phone</p>";
                echo '</div>';
                echo '<div class="column">';
                echo "<h3 class='mini-title'>Balance</h3>";
                echo " <p>$" . number_format($student_balance, 2) . "</p>";
                echo '</div>';
                echo '</div>';
                echo '<div class="button-area">';
                //
                echo  '<form method="POST" action="admin-DeleteStudent.php">';
                echo  "<input type='hidden' name='student_id' value='$student_id'>";
                echo '<button class="Delete-Button" onclick="return confirmDelete();"> Delete</button>';
                echo '</form>';

                //
                // echo '<button class="Delete-Button">';
                // echo "<a href='admin-DeleteStudent.php?student_id=$student_id'>Delete</a>";
                // echo  '</button>';
                echo '<button class="Update-Button">';
                echo "<a href='admin-UpdateStudent.php?student_id=$student_id'>Update</a>";
                echo "</div>";
                echo '</div>';
            }

            ?>
            <!--Single ROW -->
            <!-- <div class="row">
            <div class="Information-section">
                <div class="column">
                    <img src='./uploads/image1.jpg'/>
                </div>
                <div class="column">
                    <h3 class="mini-title">Name</h3>
                    <p>Arabic</p>
                </div>
                <div class="column">
                    <h3 class="mini-title">Id</h3>
                    <p>1</p>
                </div>
            </div>
            <div class="button-area">
                <button class="Delete-Button">
                    <a href="#">Delete</a>
                </button>
                <button class="Update-Button">
                    <a href="#">Update</a>
                </button>
            </div>    
        </div> -->
            <!-- ADD BUTTON -->
        </div>
        <div>
            <button class="Update-Button">
                <a href="admin-AddStudent.php">Add Student</a>
            </button>
        </div>
    </div>
</body>

</html>