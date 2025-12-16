<?php
session_start();

include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && isset($_POST['password'])) {
    $username = trim($_POST['name']);
    $password = $_POST['password'];

    // Admin login check (in production, move these to config file)
    $adminUsername = "admin";
    $adminPassword = "admin123"; // In production, use password_hash() and store hash
    
    if ($username === $adminUsername && $password === $adminPassword) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $adminUsername;
        $_SESSION['user_type'] = 'admin';
        
        // Regenerate session ID for security
        session_regenerate_id(true);
        
        header("Location: admin_dashboard.php");
        exit();
    }
    
    // Regular user login
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch();
        
        if ($user && $password === $user['password']) { // In production, use password_verify()
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['username'];
            $_SESSION['user_type'] = 'user';
            
            session_regenerate_id(true);
            
            header("Location: dashboard.php");
            exit();
        } else {
            // Login failed
            $_SESSION['login_error'] = "Invalid username or password";
            header("Location: login.html");
            exit();
        }
    } catch (PDOException $e) {
        error_log("Login error: " . $e->getMessage());
        $_SESSION['login_error'] = "Database error occurred";
        header("Location: login.html");
        exit();
    }
} else {
    // Invalid request
    header("Location: login.html");
    exit();
}
?>