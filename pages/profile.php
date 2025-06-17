<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit();
}

// Database connection
require_once 'db_connection.php';

// Fetch user details from database
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$_SESSION['user_name']]);
$user = $stmt->fetch();

// If user not found, redirect to login
if (!$user) {
    header("Location: login.php");
    exit();
}

// Set all user details in session for future use
$_SESSION['user_email'] = $user['email'];
$_SESSION['user_name'] = $user['username'];
$_SESSION['first_name'] = $user['first_name'];
$_SESSION['last_name'] = $user['last_name'];
$_SESSION['phone'] = $user['phone'];    

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - SK Supplements</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/mobilenavbar.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/profile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Header Navigation Bar -->
    <header>
        <nav>
            <div class="top-nav">
                <div class="top-nav-left">
                    <ul>
                        <li><a href="">Privacy</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="">Careers</a></li>
                    </ul>
                </div>
                <div class="top-nav-right">
                    <ul>
                        <li><a href="#"><i class="fa-brands fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-youtube" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-linkedin" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="middle-nav">
                <div class="logo">
                    <img src="../images/logo.png" alt="logo">
                    <h1>SK Supplements</h1>
                </div>
                <div class="mid-nav-center">
                    <ul>
                        <li><a href="home.html">Home</a></li>
                        <li><a href="product.html">Products <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                            <ul class="dropdown">
                                <li><a href="product.html">ALL Products</a></li>
                                <li><a href="product.html#Creatine">Creatine</a></li>
                                <li><a href="product.html#Protine">Protine</a></li>
                                <li><a href="product.html#Pre-Workout">Pre-Workout</a></li>
                                <li><a href="product.html#Multivitamin">Multi-Viamins</a></li>
                            </ul>
                        </li> 
                        <li><a href="contact.html">Contact Us</a></li>
                        <li><a href="about.html">About Us</a></li>
                    </ul>
                </div>
                <div class="mid-nav-right">
                    <ul>
                        <li><a href="#"><i class="fa-solid fa-search" aria-hidden="true"></i></a></li>
                        <li><a href="profile.php"><i class="fa-solid fa-user"></i></a></li>
                        <li><a href="cart.html" id="cart-icon"><i class="fa-solid fa-cart-shopping"></i>(<span id="cart-count">0</span>)</a></li>
                    </ul>
                </div>
            </div>
            <div class="bottom-nav">
                <p>Sale Up To 20% Biggest Discount. Harry! Limited Period Offer <a href="product.html">Shop Now!</a></p>
            </div>
        </nav>

        <!-- Mobile Navigation -->
        <nav class="mobile-nav-bar">
            <div class="mobile-top">
                <p class="mobile-top-p">Sale Up To 20% Biggest Discount. Harry! Limited Period Offer <a href="product.html">Shop Now!</a></p>
            </div>
            <div class="mobile-mid">
                <div class="logo">
                    <img src="../images/logo.png" alt="logo">
                    <h1>SK Supplements</h1>
                </div>
                <div class="hamburger" id="hamburger">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </div>
            <div class="mobile-searchbar">
                <ul>
                    <li>
                        <form class="search-box">
                            <input type="text" placeholder="Search Here" required>
                            <button class="search-btn" type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </li>
                    <li><a href="profile.php"><i class="fa-solid fa-user"></i></a></li>
                    <li><a href="cart.html" id="cart-icon"><i class="fa-solid fa-cart-shopping"></i><span id="cart-count">0</span></a></li>
                </ul>
            </div>
            <div class="mobile-bottom"></div>
            <div class="mobile-bottom-nav" id="navMenu">
                <ul>
                    <li><a href="home.html">Home</a></li>
                    <li><a href="product.html">Products <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        <ul class="dropdown">
                            <li><a href="product.html">All Products</a></li>
                            <li><a href="product.html#Creatine">Creatine</a></li>
                            <li><a href="product.html#Protine">Protine</a></li>
                            <li><a href="product.html#Pre-Workout">Pre-Workout</a></li>
                            <li><a href="product.html#Multivitamin">Multi-Viamins</a></li>
                        </ul>
                    </li>
                    <li><a href="contact.html">Contact Us</a></li>
                    <li><a href="about.html">About Us</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-brand">
                <span class="welcome-text">Welcome,</span>
                <?= htmlspecialchars($_SESSION['user_name']); ?>
            </span>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </nav>

    <!-- Profile Content -->
    <div class="profile-container">
        <div class="profile-header">
            <h2>My Profile</h2>
            <p>Manage your account details and preferences</p>
        </div>
        
        <div class="profile-content">
            <div class="profile-sidebar">
                <div class="profile-picture">
                    <img src="../images/default-profile.png" alt="Profile Picture">
                    <button class="btn btn-secondary btn-sm mt-2">Change Picture</button>
                </div>
                <ul class="profile-menu">
                    <li class="active"><a href="#"><i class="fas fa-user"></i> Account Details</a></li>
                    <li><a href="#"><i class="fas fa-shopping-bag"></i> Orders</a></li>
                    <li><a href="#"><i class="fas fa-map-marker-alt"></i> Addresses</a></li>
                    <li><a href="#"><i class="fas fa-lock"></i> Change Password</a></li>
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </div>
            
            <div class="profile-details">
                <h3>Account Information</h3>
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Username</label>
                                <div class="form-control-static"><?= htmlspecialchars($user['username']); ?></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <div class="form-control-static"><?= htmlspecialchars($user['email']); ?></div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <div class="form-control-static"><?= htmlspecialchars(ucfirst($user['first_name'])); ?></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <div class="form-control-static"><?= htmlspecialchars(ucfirst($user['last_name'])); ?></div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Phone Number</label>
                                <div class="form-control-static"><?= htmlspecialchars($user['phone']); ?></div>
                            </div>
                        </div>
                        <a href="edit-profile.php" class="btn btn-primary">Edit Profile</a>
                    </div>
                </div>
                
                <h3 class="mt-4">Recent Orders</h3>
                <div class="card">
                    <div class="card-body">
                        <p>You haven't placed any orders yet.</p>
                        <a href="product.html" class="btn btn-success">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Follow Us</h3>
                <ul class="social-links">
                    <li><a href="#"><i class="fa-brands fa-facebook"></i> Facebook</a></li>
                    <li><a href="#"><i class="fa-brands fa-instagram"></i> Instagram</a></li>
                    <li><a href="#"><i class="fa-brands fa-twitter"></i> Twitter</a></li>
                    <li><a href="#"><i class="fa-brands fa-youtube"></i> YouTube</a></li>
                    <li><a href="#"><i class="fa-brands fa-linkedin"></i> LinkedIn</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul class="quick-links">
                    <li><a href="home.html">Home</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="product.html">Products</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="cart.html">Cart</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Subscribe to Our Newsletter</h3>
                <form class="newsletter-form">
                    <input type="email" placeholder="Enter your email" required>
                    <button type="submit">Subscribe</button>
                </form>
                <p>Get the latest updates on our products and promotions.</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?= date('Y'); ?> SK Supplements. All rights reserved.</p>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/navbar.js"></script>
</body>
</html>