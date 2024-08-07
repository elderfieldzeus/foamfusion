<?php
require_once "../utilities/include.php";
require_once "../utilities/var.sql.php";
require_once "../functions/cart.functions.php";

$session->continueSession();

if(!$session->isSessionValid()) {
    LocationAlert("../pages/home.php", "Please Login or Signup");
}

$CustomerID = $session->ID;

$result = $select->selectCustomerAddress($CustomerID);
$row = $result->fetch_assoc();

if(!$row['AddressID']) {
    LocationAlert("../pages/account.php", "Input Address Details First.");
}

// Fetch cart items from session or database (depending on your implementation)
// For demonstration, using a session-based cart

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
        let cart = [];

        <?php

            //add session carts to front end cart
            if (isset($_SESSION['cart'])) {
                foreach($_SESSION['cart'] as $index => $cart) {
                    $result = $select->selectVariationData($cart->variation_id);
                    $row = $result->fetch_assoc();

                    $productName = $row['ProductName'];
                    $unitPrice = $row['UnitPrice'];
                    $variationName = $row['VariationName'];
                    $InStock = $row['InStock'];
                    $MassInOZ = $row['MassInOZ'];

                    echo '
                        let variationID_' . $index . ' = ' . $cart->variation_id . ';
                        let productName_' . $index . ' = "' . $productName . '";
                        let unitPrice_' . $index . ' = ' . $unitPrice . ';
                        let variationName_' . $index . ' = "' . $variationName . '";
                        let quantity_' . $index . ' = ' . $cart->quantity . ';
                        let inStock_' . $index . ' = ' . $InStock . ';
                        let massInOz_' . $index . ' = ' . $MassInOZ . ';


                        cart.push({
                            variationID: variationID_' . $index . ', 
                            productName: productName_' . $index . ',
                            unitPrice: unitPrice_' . $index . ', 
                            variationName: variationName_' . $index . ', 
                            quantity: quantity_' . $index . ',
                            inStock: inStock_' . $index . ',
                            massInOz: massInOz_' . $index . '
                        });
                    ';
                }
            }

        ?>

        function updateCartQuantity(variationID, quantity) {
            const cartItem = cart.find(item => item.variationID === variationID);
            if (cartItem) {

                quantity = (quantity > cartItem.inStock ? parseInt(cartItem.inStock) : parseInt(quantity));

                cartItem.quantity = quantity;

                // You can also update the server-side cart here via AJAX if needed
                // Example AJAX request to update server-side cart
                const formData = new FormData();
                formData.append('variationID', variationID);
                formData.append('quantity', quantity);

                fetch('../utilities/edit_cart.php', {
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

                updateCartUI();
            }
        }

        function deleteCartItem(variationID) {
            cart = cart.filter(item => item.variationID !== variationID);
            updateCartUI();

            // Example AJAX request to delete item from server-side cart
            const formData = new FormData();
            formData.append('variationID', variationID);

            fetch('../utilities/delete_cart.php', {
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
            const buttonArea = document.getElementById("button_area");
            cartElement.innerHTML = '';
            buttonArea.innerHTML = '';

            if (cart.length === 0) {
                const emptyCartMessage = document.createElement('div');
                emptyCartMessage.textContent = 'Your cart is empty.';
                cartElement.appendChild(emptyCartMessage);

                const backToShoppingButton = document.createElement('a');
                backToShoppingButton.href = './product.php'; // Replace with your shopping page URL
                backToShoppingButton.classList.add('bg-blue-500', 'text-white', 'px-4', 'py-2', 'rounded', 'mt-4', 'inline-block');
                backToShoppingButton.textContent = 'Back to Shopping';
                buttonArea.appendChild(backToShoppingButton);

                // Hide total price when cart is empty
                document.querySelector('#to-hide').style.display = 'none';
                document.querySelector('#total-price').style.display = 'none';
            } else {
                const proceedToCheckout = document.createElement('button');
                proceedToCheckout.type = 'submit';
                proceedToCheckout.classList.add('bg-green-500', 'text-white', 'px-4', 'py-2', 'rounded', 'mt-4', 'inline-block');
                proceedToCheckout.textContent = 'Proceed to Checkout';
                buttonArea.appendChild(proceedToCheckout);

                cart.forEach(item => {
                    const cartItemElement = document.createElement('div');
                    cartItemElement.classList.add('flex', 'justify-between', 'items-center', 'border-b', 'pb-2', 'mb-2', 'text-xs');
                    let subtotal = item.quantity * item.unitPrice;
                    cartItemElement.innerHTML = `
                        <div class="w-full flex justify-between pr-5">
                            <p>${item.productName}, ${item.variationName} ${item.massInOz}oz - Quantity: <input type="number" class="quantity-input" value="${item.quantity}" min="1" max="${item.inStock}" onchange="updateCartQuantity(${item.variationID}, this.value)"></p>
                            <p>₱${subtotal.toFixed(2)}</p>
                        </div>
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
                totalPriceElement.style.display = 'flex';
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
            <form class="cart" onsubmit="return confirmSubmission()" action="../utilities/addorder.php" method="POST">
                <div class="flex w-full items-center mt-4">
                    <div id="to-hide" class="flex flex-col w-full">
                        <div class="flex w-full gap-2 items-center text-sm">
                            <label class="font-bold" for="payment_method whitespace-nowrap">Select Payment Method:</label>
                            <select name="payment_method" id="payment_method" class="h-5 flex items-center">
                                <option value="Cash">Cash</option>
                                <option value="Online">Online</option>
                            </select>
                        </div>
                        <!-- <p class="text-xs">Gcash: 09123456789</p> -->
                    </div>
                    <p id="total-price" class="text-lg font-bold w-full flex items-center justify-end"></p>
                </div>
                <div id="button_area" class="flex w-full justify-center">
                
                </div>
            </form>
        </div>
    </div>
</div>

<!-- QR Code Modal -->
<div id="qrModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-10 hidden">
    <div class="bg-white p-8 rounded-lg text-center">
        <img src="../assets/qr/Gcash_qr.JPG" src="" alt="QR Code" class="w-80 h-[35rem] object-cover">
        <p id="paymentStatus" class="text-lg font-bold">Payment Loading...</p>
    </div>
</div>

<script>
    function confirmSubmission() {
        if(document.getElementById("payment_method").value == 'Online') {
            document.getElementById('paymentStatus').textContent = 'Payment Loading...';
            document.getElementById('qrModal').classList.remove('hidden');

            setTimeout(function() {
                document.getElementById('paymentStatus').textContent = 'Payment Successful';
                setTimeout(() => {
                    document.querySelector('.cart').submit();
                }, 3000);
            }, 10000);

            return false;
        }

        return confirm("Confirm Order?");
        
    }
</script>

</body>
</html>
