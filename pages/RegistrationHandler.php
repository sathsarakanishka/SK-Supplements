<?php
// Get form data
$first_name = $_POST["firstname"];
$last_name = $_POST["lastname"];
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$phone = $_POST["mobile"];

// Connect to database
$con = mysqli_connect("localhost","root","","sk_supplements");
if(!$con) {	
    die("Sorry, We are facing a technical issue");		
}

// Insert data
$sql = "INSERT INTO `users` (`email`, `username`, `first_name`, `last_name`, `password`, `phone`) 
        VALUES ('$email', '" . trim($username) . "', '$first_name', '$last_name', '$password', '$phone')";

if(mysqli_query($con,$sql)) {
    mysqli_close($con);
    header('Location: login.html');
    exit;
} else {
    die("Error: " . mysqli_error($con));
}
?>