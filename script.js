document.addEventListener('DOMContentLoaded', () => {
    const hamburger = document.querySelector('.hamburger');
    const mobileNavMenu = document.querySelector('.mobile-bottom-nav');

    // Toggle mobile navigation menu
    if (hamburger && mobileNavMenu) {
        hamburger.addEventListener('click', () => {
            mobileNavMenu.classList.toggle('active');
        });
    }

    // Toggle dropdown for products in mobile view
    const productLink = document.querySelector('.mobile-bottom-nav ul li a[href="pages/product.html"]');
    const dropdown = document.querySelector('.mobile-bottom-nav .dropdown');

    if (productLink && dropdown) {
        productLink.addEventListener('click', (e) => {
            e.preventDefault();
            dropdown.classList.toggle('show');
        });
    }
});

// Function to create the header
function createHeader() {
    const header = document.createElement('header');

    // Desktop navigation
    const nav = document.createElement('nav');
    nav.innerHTML = `
        <div class="top-nav">
            <div class="top-nav-left">
                <ul>
                    <li><a href="">About Us</a></li>
                    <li><a href="">Privacy</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="">Careers</a></li>
                </ul>
            </div>
            <div class="top-nav-right">
                <ul>
                    <li><a href="">Watchlist</a></li>
                    <li><a href="">Track Order</a></li>
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
                <img src="images/logo.png" alt="logo">
                <h1>SK Supplements</h1>
            </div>
            <div class="mid-nav-center">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="product.html">Products <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        <ul class="dropdown">
                            <li><a href="product.html">ALL Products</a></li>
                            <li><a href="product.html#Creatine">Creatine</a></li>
                            <li><a href="product.html#Protine">Protine</a></li>
                            <li><a href="product.html#Pre-Workout">Pre-Workout</a></li>
                            <li><a href="product.html#Multivitamin">Multi-Viamins</a></li>
                        </ul>
                    </li> 
                    <li><a href="../pages/contact.html">Contact Us</a></li>
                    <li><a href="../pages/about.html">About Us</a></li>
                </ul>
            </div>
            <div class="mid-nav-right">
                <ul>
                    <li><a href="#"><i class="fa-solid fa-search" aria-hidden="true"></i></a></li>
                    <li><a href="pages/Sign up.html"><i class="fa-solid fa-user"></i></a></li>
                    <li><a href="cart.html" id="cart-icon"><i class="fa-solid fa-cart-shopping"></i>(<span id="cart-count">0</span>)</a></li>
                </ul>
            </div>
        </div>
        <div class="bottom-nav">
            <p>Sale Up To 20% Biggest Discount. Harry! Limited Period Offer <a href="">Shop Now!</a></p>
        </div>
    `;
    header.appendChild(nav);

    // Mobile navigation
    const mobileNav = document.createElement('nav');
    mobileNav.className = 'mobile-nav-bar';
    mobileNav.innerHTML = `
        <div class="mobile-top">
            <p class="mobile-top-p">Sale Up To 20% Biggest Discount. Harry! Limited Period Offer <a href="">Shop Now!</a></p>
        </div>
        <div class="mobile-mid">
            <div class="logo">
                <img src="images/logo.png" alt="logo">
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
                <li><a href="pages/Sign up.html"><i class="fa-solid fa-user"></i></a></li>
                <li><a href="cart.html" id="cart-icon"><i class="fa-solid fa-cart-shopping"></i>(<span id="cart-count">0</span>)</a></li>
            </ul>
        </div>
        <div class="mobile-bottom"></div>
        <div class="mobile-bottom-nav" id="navMenu">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="product.html">Products <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                    <ul class="dropdown">
                        <li><a href="product.html">All Products</a></li>
                        <li><a href="product.html#Creatine">Creatine</a></li>
                        <li><a href="product.html#Protine">Protine</a></li>
                        <li><a href="product.html#Pre-Workout">Pre-Workout</a></li>
                        <li><a href="product.html#Multivitamin">Multi-Viamins</a></li>
                    </ul>
                </li>
                <li><a href="../pages/contact.html">Contact Us</a></li>
                <li><a href="../pages/about.html">About Us</a></li>
            </ul>
        </div>
    `;
    header.appendChild(mobileNav);

    return header;
}

// Function to append the header to the container
function appendHeader(container = document.body) {
    const header = createHeader();
    container.appendChild(header);
    updateCartCount(); // Ensure the cart count is updated when the header is appended
}
