<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Optional: Verify user still exists in database
require_once 'db_connection.php';
$stmt = $pdo->prepare("SELECT id FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
if ($stmt->rowCount() === 0) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>