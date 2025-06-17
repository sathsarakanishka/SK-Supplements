let cart = JSON.parse(localStorage.getItem("cart")) || [];

// Function to sync cart with server
async function syncCartWithServer() {
    try {
        const authToken = localStorage.getItem('authToken');
        if (!authToken) {
            return; // Don't sync if not logged in
        }

        const response = await fetch('/api/cart/sync', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${authToken}`
            },
            body: JSON.stringify({ cart: cart })
        });
        
        if (!response.ok) {
            throw new Error('Cart sync failed');
        }

        const data = await response.json();
        cart = mergeCarts(cart, data.cart);
        localStorage.setItem("cart", JSON.stringify(cart));
        updateCartCount();
    } catch (error) {
        console.error('Cart sync failed:', error);
    }
}

function mergeCarts(localCart, serverCart) {
    // Create a map of server cart items by product ID
    const serverItems = new Map();
    serverCart.forEach(item => serverItems.set(item.productId, item));
    
    // Update local cart with server quantities where they exist
    return localCart.map(item => {
        if (serverItems.has(item.productId)) {
            return {
                ...item,
                quantity: Math.max(item.quantity, serverItems.get(item.productId).quantity)
            };
        }
        return item;
    });
}

// Add event listeners to all "Add to Cart" buttons
document.querySelectorAll(".add-to-cart").forEach(button => {
    button.addEventListener("click", async function() {
        const productId = this.getAttribute("data-id");
        const itemName = this.getAttribute("data-name");
        const itemPrice = parseFloat(this.getAttribute("data-price"));
        const itemImage = this.closest(".product-item").querySelector("img").src;

        // Check if the item already exists in the cart
        const existingItem = cart.find(item => item.productId === productId);
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({ 
                productId, 
                name: itemName, 
                price: itemPrice, 
                quantity: 1, 
                image: itemImage 
            });
        }

        // Save the updated cart
        localStorage.setItem("cart", JSON.stringify(cart));
        updateCartCount();
        
        // Sync with server if logged in
        if (localStorage.getItem('authToken')) {
            await syncCartWithServer();
        }
        
        // Show feedback to user
        showCartFeedback(itemName);
    });
});

function showCartFeedback(productName) {
    const feedback = document.createElement('div');
    feedback.className = 'cart-feedback';
    feedback.innerHTML = `
        <span>${productName} added to cart!</span>
        <a href="cart.html">View Cart</a>
    `;
    document.body.appendChild(feedback);
    
    setTimeout(() => {
        feedback.classList.add('show');
    }, 10);
    
    setTimeout(() => {
        feedback.classList.remove('show');
        setTimeout(() => {
            document.body.removeChild(feedback);
        }, 300);
    }, 3000);
}

// Function to update the cart count in the UI
function updateCartCount() {
    try {
        const cartCount = cart.reduce((sum, item) => sum + (item.quantity || 0), 0);
        document.querySelectorAll("#cart-count").forEach(element => {
            element.textContent = cartCount;
        });
    } catch (error) {
        console.error('Error updating cart count:', error);
    }
}

// Initialize the cart count when the page loads
document.addEventListener('DOMContentLoaded', () => {
    try {
        updateCartCount();
        if (localStorage.getItem('authToken')) {
            syncCartWithServer();
        }
    } catch (error) {
        console.error('Cart initialization error:', error);
    }
});

// Enhanced checkout function for cart.html
async function checkout() {
    if (cart.length === 0) {
        alert("Your cart is empty!");
        return;
    }
    
    try {
        const response = await fetch('/api/orders/create', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            },
            body: JSON.stringify({ cart })
        });
        
        if (response.ok) {
            const order = await response.json();
            // Clear cart
            cart = [];
            localStorage.setItem("cart", JSON.stringify(cart));
            updateCartCount();
            
            // Redirect to order confirmation
            window.location.href = `/order-confirmation.html?orderId=${order.orderId}`;
        } else {
            const error = await response.json();
            alert(`Checkout failed: ${error.message}`);
        }
    } catch (error) {
        console.error('Checkout error:', error);
        alert('Checkout failed. Please try again.');
    }
}