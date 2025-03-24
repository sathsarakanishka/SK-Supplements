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

function appendHeader(container = document.body) {
    const header = createHeader();
    container.appendChild(header);
    updateCartCount(); // Ensure the cart count is updated when the header is appended
}