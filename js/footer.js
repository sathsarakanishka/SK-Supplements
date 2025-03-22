function createFooter() {
    const footer = document.createElement('footer');
    footer.className = 'site-footer';

    // Footer Content
    footer.innerHTML = `
        <div class="footer-content">
            <!-- Social Media Links -->
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

            <!-- Quick Links -->
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul class="quick-links">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="product.html">Products</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="cart.html">Cart</a></li>
                </ul>
            </div>

            <!-- Newsletter Subscription -->
            <div class="footer-section">
                <h3>Subscribe to Our Newsletter</h3>
                <form class="newsletter-form">
                    <input type="email" placeholder="Enter your email" required>
                    <button type="submit">Subscribe</button>
                </form>
                <p>Get the latest updates on our products and promotions.</p>
            </div>
        </div>

        <!-- Copyright -->
        <div class="footer-bottom">
            <p>&copy; 2023 SK Supplements. All rights reserved.</p>
        </div>
    `;

    return footer;
}

// Function to append the footer to the body or a specific container
function appendFooter(container = document.body) {
    const footer = createFooter();
    container.appendChild(footer);
}