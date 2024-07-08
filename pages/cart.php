<?php
require_once "../utilities/include.php";
require_once "../utilities/var.sql.php";

$session->continueSession();

// Fetch cart items from session or database (depending on your implementation)
// For demonstration, using a session-based cart
$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

$totalPrice = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="../styles/tailwind.css" rel="stylesheet">
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/user.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/search.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/shopping-cart.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        .quantity-input {
            width: 50px;
            text-align: center;
        }
    </style>
    <script>
        let cart = <?php echo json_encode($cartItems); ?>;

        function updateCartQuantity(variationID, quantity) {
            const cartItem = cart.find(item => item.variationID === variationID);
            if (cartItem) {
                cartItem.quantity = parseInt(quantity);
                updateCartUI();

                // You can also update the server-side cart here via AJAX if needed
                // Example AJAX request to update server-side cart
                const formData = new FormData();
                formData.append('variationID', variationID);
                formData.append('quantity', quantity);

                fetch('update_cart.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        }

        function deleteCartItem(variationID) {
            cart = cart.filter(item => item.variationID !== variationID);
            updateCartUI();

            // Example AJAX request to delete item from server-side cart
            const formData = new FormData();
            formData.append('variationID', variationID);

            fetch('delete_cart_item.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log(data); // Log response from server if needed
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function updateCartUI() {
            const cartElement = document.querySelector('#cart');
            cartElement.innerHTML = '';

            if (cart.length === 0) {
                const emptyCartMessage = document.createElement('div');
                emptyCartMessage.textContent = 'Your cart is empty.';
                cartElement.appendChild(emptyCartMessage);

                const backToShoppingButton = document.createElement('a');
                backToShoppingButton.href = './product.php'; // Replace with your shopping page URL
                backToShoppingButton.classList.add('bg-blue-500', 'text-white', 'px-4', 'py-2', 'rounded', 'mt-4', 'inline-block');
                backToShoppingButton.textContent = 'Back to Shopping';
                cartElement.appendChild(backToShoppingButton);

                // Hide total price when cart is empty
                document.querySelector('#total-price').style.display = 'none';
            } else {
                cart.forEach(item => {
                    const cartItemElement = document.createElement('div');
                    cartItemElement.classList.add('flex', 'justify-between', 'items-center', 'border-b', 'pb-2', 'mb-2', 'text-xs');
                    cartItemElement.innerHTML = `
                        <div>${item.variationName} - Quantity: <input type="number" class="quantity-input" value="${item.quantity}" min="1" max="${item.inStock}" onchange="updateCartQuantity(${item.variationID}, this.value)"></div>
                        <div>
                            <button class="bg-red-500 text-white px-2 py-1 rounded" onclick="deleteCartItem(${item.variationID})">Delete</button>
                        </div>
                    `;
                    cartElement.appendChild(cartItemElement);
                });

                // Calculate total price
                const total = cart.reduce((acc, item) => acc + (item.unitPrice * item.quantity), 0);
                const totalPriceElement = document.querySelector('#total-price');
                totalPriceElement.textContent = `Total Price: ₱${total.toFixed(2)}`;
                totalPriceElement.style.display = 'block'; // Show total price when cart is not empty
            }
        }

        window.onload = function() {
            updateCartUI();
        };
    </script>
</head>
<body class="bg-gray-100">

<!-- Navbar -->
<?php include_once "../components/navbar.php"; ?>

<div class="container mx-auto p-6 mt-24">
    <div class="flex justify-center">
        <div class="w-full">
            <h1 class="text-3xl font-bold mb-6">Shopping Cart</h1>
            <div id="cart">
                <!-- Cart items will be dynamically added here -->
            </div>
            <div id="total-price" class="text-lg font-bold mt-4">
                <!-- Total price will be dynamically updated here -->
            </div>
            <a href="checkout.php" class="bg-green-500 text-white px-4 py-2 rounded mt-4 inline-block">Proceed to Checkout</a>
        </div>
    </div>
</div>

</body>
</html>
