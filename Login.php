<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Nile Academy</title>
    <link rel="stylesheet" href="./Login.css"/>
</head>

<body>
    <div class="logo">
        <img src="./nile-academy-high-resolution-logo.png" alt="Nile Academy Logo">
    </div>
    <form action="Login.php" method="post">
        <fieldset>
            <legend>Login</legend>
            <?php
            if (isset($_POST["submit"])) 
            {
                require("Config.php");
                $phone = $_POST["phone"];
                $password = $_POST["password"];
                $Type = $_POST["Type"];
                $sql = "";
                switch ($Type) {
                    case "students":
                        $sql = "SELECT * FROM $Type WHERE student_phone='$phone' AND student_pass='$password' ";
                        break;
                    case "teachers":
                        $sql = "SELECT * FROM $Type WHERE teacher_phone='$phone' AND teacher_pass='$password' ";
                        break;
                    case "admins":
                        $sql = "SELECT * FROM $Type WHERE admin_phone='$phone' AND admin_pass='$password' ";
                        break;
                }
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    session_start();
                    $row=mysqli_fetch_array($result);
                    $_SESSION["Type"] = $Type;
                    $_SESSION["Row"]=$row;
                    header("Location: index.php");
                } else {
                    echo '<div class="error-message">Wrong phone number or password or type</div>';
                }
                $conn->close();
            }
            ?>

            <label for="phone">Phone:</label>
            <input type="tel" id="phone" placeholder="Write your phone" name="phone" minlength="11" maxlength="11" required>

            <label for="password">Password:</label>
            <input type="password" id="password" placeholder="Write your password" name="password" required>

            <label for="type">Type:</label>
            <select name="Type" id="type">
                <option value="students">Student</option>
                <option value="teachers">Teacher</option>
                <option value="admins">Admin</option>
            </select>

            <div class="form-actions">
                <input type="reset" value="Reset">
                <input type="submit" name="submit" value="Log in">
            </div>
        </fieldset>
    </form>
</body>

</html>