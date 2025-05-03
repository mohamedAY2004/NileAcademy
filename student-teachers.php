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
    <title>Teachers</title>
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
        
        // Header Section
        $course_query = mysqli_query($conn, "SELECT course_name FROM courses WHERE course_id='$course_id'") or die(mysqli_error($conn));
        $course_row = mysqli_fetch_array($course_query);
        echo "<div class='header-section'>";
        echo "<h2>" . $course_row['course_name'] . "</h2>";
        echo "<h3>Available Teachers</h3>";
        echo "</div>";
        
        // Teachers Section
        echo "<div class='teachers-section'>";
        $teachers = mysqli_query($conn,"SELECT * FROM teachers WHERE course_id='$course_id'") or die(mysqli_error($conn));
        
        if(mysqli_num_rows($teachers) > 0) {
            echo "<div class='card-container'>";
            while ($row = mysqli_fetch_array($teachers)) {
                $teacher_id=$row["teacher_id"];
                $teacher_name=$row["teacher_name"];
                $image_name=$row["image_name"];
                echo "<a href='student-lectures.php?teacher_id=$teacher_id'>";
                echo "<div class='card'>";
                echo "<img src='./uploads/$image_name' alt='$teacher_name Image' width='300px' height='200px'>";
                echo "<hr/>";
                echo "<h3>$teacher_name</h3>";
                echo "</div>";
                echo "</a>";
            }
            echo "</div>";
        } else {
            echo "<p class='no-teachers'>No teachers available for this course.</p>";
        }
        echo "</div>";
        $conn->close();
        ?>
    </div>

    <style>
    .main-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        min-height: calc(100vh - 100px);
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .header-section {
        text-align: center;
        margin-bottom: 40px;
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 600px;
    }

    .header-section h2 {
        color: #333;
        margin: 0;
        font-size: 2rem;
    }

    .header-section h3 {
        color: #666;
        margin: 10px 0 0 0;
        font-size: 1.5rem;
        font-weight: normal;
    }

    .teachers-section {
        width: 100%;
    }

    .card-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }

    .card {
        background-color: rgba(249, 249, 249, 0.9);
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card img {
        border-radius: 8px;
        object-fit: cover;
    }

    .card hr {
        width: 80%;
        border: 0;
        height: 1px;
        background-color: #ddd;
        margin: 15px auto;
    }

    .card h3 {
        margin: 10px 0;
        color: #333;
        font-size: 1.2rem;
    }

    .no-teachers {
        text-align: center;
        color: #666;
        font-size: 1.1rem;
        margin: 20px 0;
    }

    body::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, #000066 0%, #99ccff 100%);
        z-index: -1;
    }

    a {
        text-decoration: none;
        color: inherit;
    }
    </style>
</body>
</html>