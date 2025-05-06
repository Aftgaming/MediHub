<?php
session_start(); // Start the session at the very beginning

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['email']); // Assuming you set the email in the session upon login
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediHub - Cart</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #e7f9e9;
            margin: 0;
            padding-bottom: 80px; /* To prevent content from being hidden behind the footer */
        }
        .cart-container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }
        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #28a745;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .label-box {
            display: flex;
            background-color: #28a745;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .label-box div {
            flex: 1;
            text-align: center;
            font-weight: bold;
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
        }
        .cart-item div {
            flex: 1;
        }
        .quantity-control {
            display: flex;
            align-items: center;
        }
        .quantity-control button {
            width: 30px;
            height: 30px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        .checkout-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #f8f9fa;
            padding: 10px;
            border-top: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
        }
        .total-summary {
            font-weight: bold;
            font-size: 16px;
        }
        .voucher-box {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        .voucher-box select {
            padding: 5px;
            font-size: 14px;
        }
        .modal {
            display: flex;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 80%;
            max-width: 400px; /* Make the modal smaller */
            display: flex;
            flex-direction: column;
            align-items: center; /* Center items horizontally */
            justify-content: center; /* Center items vertically */
            margin: auto; /* Center the modal itself */
        }
        .close {
            float: right;
            font-size: 1.5rem;
            cursor: pointer;
        }
        #productSearch {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            font-size: 1rem;
        }
        #searchResults {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        #searchResults div {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
        }
        #searchResults div:hover {
            background-color: #f1f1f1;
        }
        .centered {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 100%;
        }
        .add-product {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
<header class="d-flex flex-column" style="padding: 20px 150px;">
    <nav class="d-flex justify-content-end mb-2">
        <ul class="list-inline mb-0" style="font-size: 0.85rem;">
            <li class="list-inline-item"><a href="index.php">Home</a></li>
            <li class="list-inline-item"><a href="services.php">Services</a></li>
            <li class="list-inline-item"><a href="about.php">About</a></li>
            <?php if (!$isLoggedIn): ?>
                <li class="list-inline-item" style="margin-right: 0px;"><a href="signup.html" class="d-flex align-items-center"><b>Sign Up</b></a></li>
                <li class="list-inline-item"><a href="login.html" class="d-flex align-items-center"><b>Log In</b></a></li>
            <?php else: ?>
                <li class="list-inline-item"><a href="profile.php" class="d-flex align-items-center"><b>Profile</b></a></li> <!-- Profile Button -->
                <li class="list-inline-item"><a href="logout.php" class="d-flex align-items-center"><b>Log Out</b></a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <div class="d-flex align-items-center">
        <a href="index.php" class="d-flex align-items-center mr-3">
            <img src="images/logo.png" alt="MediHub Logo" style="height: 60px;"/> <!-- Adjust the logo path and size as needed -->
            <h1 style="margin: 0; margin-left: 10px; font-size: 1.8rem;">MediHub</h1> <!-- Clickable text logo -->
        </a>
        <input type="text" class="form-control mr-2" placeholder="MediHub Search..." aria-label="Search" style="max-width: 1000px;"/>
        <a href="cart.php" class="btn btn-outline-success ml-auto" style="border: none;">
            <img src="images/cart-icon.png" alt="Add to Cart" style="height: 30px;"/> <!-- Add to cart icon -->
        </a>
    </div>
</header>

    <div class="cart-container">
        <div class="cart-header">
            <h2>Your MediCart</h2>
            <button id="select-all" onclick="toggleSelectAll()">Select All</button>
        </div>

        <div class="label-box">
            <div></div> <!-- Empty for checkbox -->
            <div>Product</div>
            <div>Price</div>
            <div>Quantity</div>
            <div>Total Price</div>
            <div>Actions</div>
        </div>

        <div id="cart-items"></div> <!-- Dynamic cart items will be loaded here -->

        <div class="centered">
            <div class="add-product">
                <button onclick="showProductSearch()">Add More Products</button>
            </div>
        </div>

        <div class="checkout-footer">
            <div>
                <strong>Total (0 Items):</strong>
                <div>₱0.00</div>
            </div>
            <div class="voucher-box">
                <select>
                    <option>Select a Voucher</option>
                    <option>Voucher 1</option>
                    <option>Voucher 2</option>
                </select>
                <button onclick="checkout()">Checkout</button>
            </div>
        </div>
    </div>

    <!-- Product Search Modal -->
    <div id="product-search" style="display: none; justify-content: center; align-items: center;">
        <div class="modal-content" style="display: flex; flex-direction: column; align-items: center;">
            <input type="text" id="product-search-input" placeholder ="Search for products..." onkeypress="checkEnter(event)" style="width: 80%; max-width: 300px; margin: 10px 0;">
            <ul id="search-results"></ul>
            <button onclick="closeProductSearch()" style="margin-top: 10px;">Close</button>
        </div>
    </div>

    <script>
        const products = [
            { name: 'Alcohol', price: 50.00 },
            { name: 'Ibuprofen', price: 75.00 },
            { name: 'Antihistamines', price: 90.00 }
        ];

        function showProductSearch() {
            document.getElementById('product-search').style.display = 'block';
            document.getElementById('product-search-input').value = ''; // Clear input
            document.getElementById('search-results').innerHTML = ''; // Clear previous results
        }

        function closeProductSearch() {
            document.getElementById('product-search').style.display = 'none';
        }

        function checkEnter(event) {
            if (event.key === 'Enter') {
                filterProducts();
            }
        }

        function filterProducts() {
            const searchValue = document.getElementById('product-search-input').value.toLowerCase();
            const results = document.getElementById('search-results');
            results.innerHTML = ''; // Clear previous results

            products
                .filter(product => product.name.toLowerCase().includes(searchValue))
                .forEach(product => {
                    const li = document.createElement('li');
                    li.textContent = `${product.name} - ₱${product.price.toFixed(2)}`;
                    li.onclick = () => addProductToCart(product);
                    results.appendChild(li);
                });
        }

        function addProductToCart(product) {
            const cartItemsContainer = document.getElementById('cart-items');

            const cartItem = document.createElement('div');
            cartItem.className = 'cart-item';
            cartItem.innerHTML = `
                <div><input type="checkbox" class="item-select" onchange="updateCheckoutTotal()"></div>
                <div>${product.name}</div>
                <div class="item-price" data-price="${product.price}">₱${product.price.toFixed(2)}</div>
                <div class="quantity-control">
                    <button onclick="changeQuantity(this, -1)">-</button>
                    <input type="number" value="1" min="1" class="item-quantity" onchange="updateTotal(this)">
                    <button onclick="changeQuantity(this, 1)">+</button>
                </div>
                <div class="item-total">₱${product.price.toFixed(2)}</div>
                <div>
                    <button onclick="removeItem(this)">Remove</button>
                </div>
            `;
            cartItemsContainer.appendChild(cartItem);
            updateCheckoutTotal();
            closeProductSearch(); // Close the search modal after adding the product
        }

        function updateCheckoutTotal() {
            const checkboxes = document.querySelectorAll('.item-select');
            let totalItems = 0;
            let totalAmount = 0;

            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    const cartItem = checkbox.closest('.cart-item');
                    const itemTotal = parseFloat(cartItem.querySelector('.item-total').textContent.replace('₱', ''));
                    totalItems++;
                    totalAmount += itemTotal;
                }
            });

            const checkoutFooter = document.querySelector('.checkout-footer');
            checkoutFooter.querySelector('strong').textContent = `Total (${totalItems} Item${totalItems !== 1 ? 's' : ''}):`;
            checkoutFooter.querySelector('strong + div').textContent = `₱${totalAmount.toFixed(2)}`;
        }

        function changeQuantity(button, change) {
            const input = button.parentElement.querySelector('.item-quantity');
            let newQuantity = parseInt(input.value) + change;
            if (newQuantity < 1) newQuantity = 1; // Prevent quantity from going below 1
            input.value = newQuantity;
            updateTotal(input);
        }

        function updateTotal(quantityInput) {
            const cartItem = quantityInput.closest('.cart-item');
            const priceElement = cartItem.querySelector('.item-price');
            const totalElement = cartItem.querySelector('.item-total');
            const quantity = parseInt(quantityInput.value);
            const price = parseFloat(priceElement.dataset.price);
            const total = price * quantity;

            totalElement.textContent = `₱${total.toFixed(2)}`;
            updateCheckoutTotal();
        }

        function toggleSelectAll() {
            const selectAllButton = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('.item-select');
            const allSelected = Array.from(checkboxes).every(checkbox => checkbox.checked);

            checkboxes.forEach(checkbox => {
                checkbox.checked = !allSelected;
            });

            selectAllButton.textContent = allSelected ? 'Select All' : 'Deselect All';
            updateCheckoutTotal();
        }

        function removeItem(button) {
            const cartItem = button.closest('.cart-item');
            cartItem.remove();
            updateCheckoutTotal();
        }

        function checkout() {
            alert("Proceeding to checkout...");
            // Implement your checkout logic here
        }

        // Call loadCartItems on page load
        window.onload = function() {
            // Initialize cart items if needed
        };
    </script>
</body>
</html>