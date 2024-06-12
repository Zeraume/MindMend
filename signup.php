<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/signup.css">
        
    <title>Sign Up</title>
    
</head>
<body>
<?php
session_start();
$_SESSION["user"] = "";
$_SESSION["usertype"] = "";

// Set the new timezone
date_default_timezone_set('Asia/Jakarta'); // Adjusting timezone to Indonesia
$date = date('Y-m-d');
$_SESSION["date"] = $date;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "root"; // replace with your database username
    $password = ""; // replace with your database password
    $dbname = "mindmend"; // replace with your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Capture and sanitize user inputs
    $fname = $conn->real_escape_string($_POST['fname']);
    $lname = $conn->real_escape_string($_POST['lname']);
    $address = $conn->real_escape_string($_POST['address']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $tel = $conn->real_escape_string($_POST['tel']);

    // Prepare to insert into patient table
    $sql = "INSERT INTO patient (pemail, pname, ppassword, paddress, pdob, ptel) VALUES ('$email', '$fname $lname', '$password', '$address', '$dob', '$tel')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION["user"] = $email;
        $_SESSION["usertype"] = "p";
        header("Location: patient/index.php"); // Redirect to welcome page after successful signup
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<center>
<div class="container">
    <table border="0">
        <tr>
            <td colspan="2">
                <p class="header-text">Let's Get Started</p>
                <p class="sub-text">Add Your Personal Details to Continue</p>
            </td>
        </tr>
        <tr>
            <form action="" method="POST">
            <td class="label-td" colspan="2">
                <label for="name" class="form-label">Name: </label>
            </td>
        </tr>
        <tr>
            <td class="label-td">
                <input type="text" name="fname" class="input-text" placeholder="First Name" required>
            </td>
            <td class="label-td">
                <input type="text" name="lname" class="input-text" placeholder="Last Name" required>
            </td>
        </tr>
        <tr>
            <td class="label-td" colspan="2">
                <label for="address" class="form-label">Address: </label>
            </td>
        </tr>
        <tr>
            <td class="label-td" colspan="2">
                <input type="text" name="address" class="input-text" placeholder="Address" required>
            </td>
        </tr>
        <tr>
            <td class="label-td" colspan="2">
                <label for="dob" class="form-label">Date of Birth: </label>
            </td>
        </tr>
        <tr>
            <td class="label-td" colspan="2">
                <input type="date" name="dob" class="input-text" required>
            </td>
        </tr>
        <tr>
            <td class="label-td" colspan="2">
                <label for="email" class="form-label">Email: </label>
            </td>
        </tr>
        <tr>
            <td class="label-td" colspan="2">
                <input type="email" name="email" class="input-text" placeholder="Email" required>
            </td>
        </tr>
        <tr>
            <td class="label-td" colspan="2">
                <label for="password" class="form-label">Password: </label>
            </td>
        </tr>
        <tr>
            <td class="label-td" colspan="2">
                <input type="password" name="password" class="input-text" placeholder="Password" required>
            </td>
        </tr>
        <tr>
            <td class="label-td" colspan="2">
                <label for="tel" class="form-label">Phone Number: </label>
            </td>
        </tr>
        <tr>
            <td class="label-td" colspan="2">
                <input type="tel" name="tel" class="input-text" placeholder="Phone Number" required>
            </td>
        </tr>
        <tr>
            <td>
                <input type="reset" value="Reset" class="login-btn btn-primary-soft btn">
            </td>
            <td>
                <input type="submit" value="Next" class="login-btn btn-primary btn">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <br>
                <label for="" class="sub-text" style="font-weight: 280;">Already have an account&#63; </label>
                <a href="login.php" class="hover-link1 non-style-link">Login</a>
                <br><br><br>
            </td>
        </tr>
            </form>
        </tr>
    </table>
</div>
</center>
</body>
</html>
