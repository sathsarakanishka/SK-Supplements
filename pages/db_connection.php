<?php
$host = 'localhost';
$db   = 'sk_supplements';
$user = 'root';
$pass = '';

$con = mysqli_connect($host, $user, $pass, $db);
if (!$con) {
    die("Sorry, We are facing a technical issue");
}

