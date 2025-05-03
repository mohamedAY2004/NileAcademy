<?php 
session_start();
if(!isset($_SESSION["Type"]) || $_SESSION["Type"] != "students"){
    header("Location: Login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lectures</title>
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
    <div class="main-content">
        <?php
        require_once "Config.php";
        $teacher_id = $_GET["teacher_id"];
        
        // Get teacher information
        $teacher_query = mysqli_query($conn, "SELECT t.*, c.course_name 
                                            FROM teachers t 
                                            LEFT JOIN courses c ON t.course_id = c.course_id 
                                            WHERE t.teacher_id='$teacher_id'") 
                                            or die(mysqli_error($conn));
        $teacher_row = mysqli_fetch_array($teacher_query);
        
        // Header Section
        echo "<div class='header-section'>";
        echo "<h2>" . $teacher_row['teacher_name'] . "</h2>";
        echo "<h3>" . $teacher_row['course_name'] . "</h3>";
        echo "</div>";
        
        // Lectures Section
        echo "<div class='lectures-section'>";
        $lectures = mysqli_query($conn, "SELECT lecture_day, GROUP_CONCAT(lecture_id) as lecture_ids, GROUP_CONCAT(starting_hour ORDER BY starting_hour) as hours 
                                       FROM lectures 
                                       WHERE teacher_id='$teacher_id' 
                                       GROUP BY lecture_day 
                                       ORDER BY FIELD(lecture_day, 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday')") 
                    or die(mysqli_error($conn));
        
        if(mysqli_num_rows($lectures) > 0) {
            echo "<div class='card-container'>";
            while ($row = mysqli_fetch_array($lectures)) {
                $lecture_ids = explode(',', $row["lecture_ids"]);
                $hours = explode(',', $row["hours"]);
                $lecture_day = ucfirst($row["lecture_day"]);
                
                echo "<div class='card'>";
                echo "<div class='lecture-info'>";
                echo "<h3>$lecture_day</h3>";
                echo "<hr/>";
                echo "<div class='time-slots'>";
                foreach ($hours as $index => $hour) {
                    $time_format = ($hour >= 12) ? 'PM' : 'AM';
                    $display_hour = ($hour > 12) ? $hour - 12 : $hour;
                    echo "<div class='time-slot'>";
                    echo "<p>$display_hour:00 $time_format</p>";
                    echo "<form action='book-lecture.php' method='POST'>";
                    echo "<input type='hidden' name='lecture_id' value='" . $lecture_ids[$index] . "'>";
                    echo "<button type='submit' class='book-button'>Book</button>";
                    echo "</form>";
                    echo "</div>";
                }
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<p class='no-lectures'>No lectures available for this teacher.</p>";
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

    .lectures-section {
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
        flex: 0 1 250px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .lecture-info {
        width: 100%;
        margin-bottom: 15px;
    }

    .card h3 {
        margin: 0;
        font-size: 1.2rem;
        color: #333;
    }

    .card hr {
        width: 80%;
        border: 0;
        height: 1px;
        background-color: #ddd;
        margin: 15px 0;
    }

    .card p {
        margin: 10px 0;
        color: #666;
    }

    .time-slots {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 15px;
    }

    .time-slot {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 5px 10px;
        background-color: rgba(255, 255, 255, 0.5);
        border-radius: 5px;
    }

    .time-slot p {
        margin: 0;
        font-size: 0.9rem;
    }

    .book-button {
        background: #007bff;
        color: white;
        border: none;
        padding: 4px 12px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
        font-size: 0.9rem;
    }

    .book-button:hover {
        background: #0056b3;
    }

    .no-lectures {
        width: 100%;
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
    </style>
</body>
</html>