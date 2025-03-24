let cart = JSON.parse(localStorage.getItem("cart")) || [];

// Add event listeners to all "Add to Cart" buttons
document.querySelectorAll(".add-to-cart").forEach(button => {
    button.addEventListener("click", function () {
        const itemName = this.getAttribute("data-name");
        const itemPrice = parseFloat(this.getAttribute("data-price"));
        const itemImage = this.closest(".product-item").querySelector("img").src; // Get the image path

        // Check if the item already exists in the cart
        const existingItem = cart.find(item => item.name === itemName);
        if (existingItem) {
            existingItem.quantity += 1; // Increment quantity if item exists
        } else {
            cart.push({ name: itemName, price: itemPrice, quantity: 1, image: itemImage }); // Add new item to cart
        }

        // Save the updated cart to localStorage
        localStorage.setItem("cart", JSON.stringify(cart));
        updateCartCount(); // Update the cart count in the UI
    });
});

// Function to update the cart count in the UI
function updateCartCount() {
    const cartCount = cart.reduce((sum, item) => sum + item.quantity, 0); // Calculate total items in cart
    // Update all elements with the ID "cart-count" (both desktop and mobile)
    document.querySelectorAll("#cart-count").forEach(element => {
        element.innerText = cartCount;
    });
}

// Initialize the cart count when the page loads
updateCartCount();