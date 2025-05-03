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
    <title>Admins</title>
    <link rel="stylesheet" href="./tickets.css">
</head>

<body>
    <!-- Top Dashboard -->
    <div class="content">
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
        <div class="container">
            <?php
        require("Config.php");
        $admins=mysqli_query($conn,"SELECT * FROM admins");
        while ($row = mysqli_fetch_array($admins))
        {
            $admin_id=$row["admin_id"];
            if($admin_id == $_SESSION["Row"]["admin_id"])continue;
            $image_name=$row["image_name"];
            $admin_name=$row["admin_name"];
            $admin_phone=$row["admin_phone"];
            echo '<div class="row">';
                echo '<div class="Information-section">';
                    echo '<div class="column">';
                        echo "<img src='./uploads/$image_name'/>";
                    echo '</div>';
                    echo '<div class="column">';
                        echo "<h3 class='mini-title'>Admin Name</h3>";
                        echo " <p>$admin_name</p>";
                    echo '</div>';
                    echo '<div class="column">';
                        echo "<h3 class='mini-title'>Admin Phone</h3>";
                        echo " <p>$admin_phone</p>";
                    echo '</div>';
                echo '</div>';
                    echo '<div class="button-area">';
                        echo '<button class="Delete-Button">';
                        echo "<a href='admin-DeleteAdmin.php?id=$admin_id'>Delete</a>";
                        echo  '</button>';
                        echo '<button class="Update-Button">';
                        echo "<a href='admin-UpdateAdmin.php?id=$admin_id'>Update</a>";
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
        <div class="add-button">
            <button class="Update-Button">
                <a href="admin-AddAdmin.php">Add Admin</a>
            </button>
        </div>
    </div>
</body>

</html>