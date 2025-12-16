<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SK Supplements</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../css/signup_login.css">
    <style>
        .error-message {
            color: red;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body background="../images/bg/29e258148379789.62d4fe5d6d7d8.jpg">
    
    <div class="container">
        <h2>Log In</h2>
        
        <?php if (isset($_SESSION['login_error'])): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($_SESSION['login_error']); ?>
                <?php unset($_SESSION['login_error']); ?>
            </div>
        <?php endif; ?>
        
        <form method="post" action="LoginHandler.php">
            <div class="input-group">
                <input type="text" name="name" placeholder="Username" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="button">Login</button>
            <br>
            <br>
            <p>Don't have an account? <a href="Sign up.html">Sign Up</a></p>
            <p><a href="../pages/home.html">Go Back to Home</a></p>
        </form>
    </div>
</body>
</html>