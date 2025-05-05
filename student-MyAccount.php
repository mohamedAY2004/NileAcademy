<?php 
session_start();
if(!isset($_SESSION["Type"]) || $_SESSION["Type"] != "students"){
    header("Location: Login.php");
    exit(); // Prevents further code execution after the redirect
}

// Get student_id from URL parameter or session
$student_id = isset($_GET["student_id"]) ? $_GET["student_id"] : $_SESSION["Row"]["student_id"];

// Ensure the logged-in student can only view their own account
if($_SESSION["Row"]["student_id"] != $student_id) {
    header("Location: student-Courses.php");
    exit();
}

require_once "Config.php";
// Get student information
$student_query = mysqli_query($conn, "SELECT * FROM students WHERE student_id='$student_id'") or die(mysqli_error($conn));
$student = mysqli_fetch_array($student_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link rel="stylesheet" href="./tickets.css">
    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }
        .profile-section {
            display: flex;
            margin-bottom: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
        }
        .profile-image {
            width: 150px;
            height: 150px;
            margin-right: 20px;
            border-radius: 50%;
            object-fit: cover;
        }
        .profile-details {
            flex: 1;
        }
        .profile-details h2 {
            margin-top: 0;
            color: #333;
        }
        .balance {
            font-size: 24px;
            font-weight: bold;
            color: #2c7be5;
            margin: 10px 0;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border-radius: 5px;
            overflow: hidden;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid #e0e0e0;
            padding: 12px;
            text-align: left;
        }
        .invoice-table th {
            background-color: #2c7be5;
            color: white;
            font-weight: 500;
        }
        .invoice-table tr:nth-child(even) {
            background-color: #eaf2ff;
        }
        .invoice-table tr:nth-child(odd) {
            background-color: #ffffff;
        }
        .invoice-table tr:hover {
            background-color: #d9e8ff;
            transition: background-color 0.2s ease;
        }
        .invoice-table td:last-child {
            font-weight: 500;
        }
        .section-title {
            margin-top: 30px;
            margin-bottom: 15px;
            color: #333;
            border-bottom: 2px solid #2c7be5;
            padding-bottom: 5px;
        }
    </style>
</head>
<body>
    <!-- Top Dashboard -->
    <div class="top-dashboard">
        <img src="./nile-academy-high-resolution-logo.png" alt="Logo">
        <div>
            <a href="student-Courses.php">Courses</a>
            <a href="Logout.php">Logout</a>
        </div>
    </div>
    <!-- Content Section -->
    <div class="content">
        <div class="container">
            <!-- Profile Section -->
            <div class="profile-section">
                <img src="./uploads/<?php echo $student['image_name']; ?>" alt="Profile Image" class="profile-image">
                <div class="profile-details">
                    <h2><?php echo $student['student_name']; ?></h2>
                    <p><strong>Phone:</strong> <?php echo $student['student_phone']; ?></p>
                    <p><strong>Parent Phone:</strong> <?php echo $student['parent_phone']; ?></p>
                    <div class="balance">Balance: <?php echo $student['student_balance']; ?> EGP</div>
                </div>
            </div>
            
            <!-- Invoices Section -->
            <h3 class="section-title">Invoice History</h3>
            <?php
            // Get student's invoices with lecture details
            $invoices_query = mysqli_query($conn, 
                "SELECT i.*, l.lecture_day, l.starting_hour, t.teacher_name, c.course_name 
                FROM invoices i 
                LEFT JOIN lectures l ON i.lecture_id = l.lecture_id 
                LEFT JOIN teachers t ON l.teacher_id = t.teacher_id 
                LEFT JOIN courses c ON t.course_id = c.course_id 
                WHERE i.student_id='$student_id' 
                ORDER BY i.date DESC") or die(mysqli_error($conn));
            
            if(mysqli_num_rows($invoices_query) > 0) {
                echo '<table class="invoice-table">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Invoice ID</th>';
                echo '<th>Date</th>';
                echo '<th>Course</th>';
                echo '<th>Teacher</th>';
                echo '<th>Day</th>';
                echo '<th>Hour</th>';
                echo '<th>Amount</th>';
                echo '<th>Attendance</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                
                while($invoice = mysqli_fetch_array($invoices_query)) {
                    echo '<tr>';
                    echo '<td>' . $invoice['invoice_id'] . '</td>';
                    echo '<td>' . $invoice['date'] . '</td>';
                    echo '<td>' . ($invoice['course_name'] ? $invoice['course_name'] : 'N/A') . '</td>';
                    echo '<td>' . ($invoice['teacher_name'] ? $invoice['teacher_name'] : 'N/A') . '</td>';
                    echo '<td>' . ($invoice['lecture_day'] ? $invoice['lecture_day'] : 'N/A') . '</td>';
                    echo '<td>' . ($invoice['starting_hour'] ? $invoice['starting_hour'] : 'N/A') . '</td>';
                    echo '<td>' . $invoice['ammount'] . ' EGP</td>';
                    echo '<td>' . ucfirst($invoice['attendendence']) . '</td>';
                    echo '</tr>';
                }
                
                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<p>No invoices found.</p>';
            }
            
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>