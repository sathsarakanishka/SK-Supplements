let cart = JSON.parse(localStorage.getItem("cart")) || [];

document.querySelectorAll(".add-to-cart").forEach(button => {
    button.addEventListener("click", function () {
        const itemName = this.getAttribute("data-name");
        const itemPrice = parseFloat(this.getAttribute("data-price"));

        const existingItem = cart.find(item => item.name === itemName);
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({ name: itemName, price: itemPrice, quantity: 1 });
        }

        localStorage.setItem("cart", JSON.stringify(cart));
        updateCartCount();
        alert(`${itemName} has been added to your cart!`);
    });
});

function updateCartCount() {
    const cartCount = cart.reduce((sum, item) => sum + item.quantity, 0);
    document.getElementById("cart-count").innerText = cartCount;
}

updateCartCount();