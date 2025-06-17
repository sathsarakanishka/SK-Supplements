<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['user_name'] ?? $_SESSION['user_name'];

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SK Supplements</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/mobilenavbar.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/home.css">
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
    
</body>
</html>