<?php
include ('db_connection.php');

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$phone = $_POST["mobile"];

$hash = password_hash($password, PASSWORD_DEFAULT);
// Insert data
$sql = "INSERT INTO users (email, username, first_name, last_name, password, phone) 
        VALUES ('$email', '" . trim($username) . "', '".trim($firstname)."', '".trim($lastname)."', '$$hash', '$phone')";

if(mysqli_query($con,$sql)) {
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    echo "<script>alert('Registration Successful');</script>";

    header('Location: login.html');
    exit;
} else {
    die("Error: " . mysqli_error($con));
}

mysqli_close($con);
?>