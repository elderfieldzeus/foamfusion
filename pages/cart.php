<?php
session_start(); // Start the session to access cart data

$cart = $_SESSION['cart'] ?? []; // Retrieve cart items from session

// Function to calculate total cart amount
function calculateTotal() {
    global $cart;
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['unitPrice'] * $item['quantity'];
    }
    return $total;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/user.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/search.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/shopping-cart.css' rel='stylesheet'>
    <title>Shopping Cart</title>
    <link href="../styles/tailwind.css" rel="stylesheet">
    <style>
        /* Your custom styles here */
    </style>
</head>
<body class="bg-gray-100">

<!-- Navbar -->
<?php include_once "../components/navbar.php"; ?>

<div class="container mx-auto p-6 mt-24">
    <h1 class="text-3xl font-bold mb-6">Shopping Cart</h1>

    <?php if (empty($cart)) : ?>
        <p>Your cart is empty.</p>
    <?php else : ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <?php foreach ($cart as $item) : ?>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold mb-2"><?php echo $item['productName']; ?></h2>
                    <img src="<?php echo $item['variationImage']; ?>" alt="<?php echo $item['productName']; ?>" class="w-full h-48 object-cover mb-4">
                    <p class="text-gray-700 mb-2">Price: ₱<?php echo $item['unitPrice']; ?></p>
                    <p class="text-gray-700 mb-2">Quantity: <?php echo $item['quantity']; ?></p>
                    <p class="text-gray-700 mb-2">Total: ₱<?php echo $item['unitPrice'] * $item['quantity']; ?></p>
                    <div>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded mr-2" onclick="editCartItem(<?php echo $item['variationID']; ?>)">Edit</button>
                        <button class="bg-red-500 text-white px-4 py-2 rounded" onclick="deleteCartItem(<?php echo $item['variationID']; ?>)">Delete</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="mt-8">
            <h2 class="text-xl font-bold mb-2">Total Amount: ₱<?php echo calculateTotal(); ?></h2>
            <a href="checkout.php" class="bg-green-500 text-white px-4 py-2 rounded inline-block">Proceed to Checkout</a>
        </div>
    <?php endif; ?>
</div>

<script>
    function editCartItem(variationID) {
        // Implement edit functionality if needed
        alert('Edit functionality placeholder. Variation ID: ' + variationID);
    }

    function deleteCartItem(variationID) {
        // Implement delete functionality if needed
        alert('Delete functionality placeholder. Variation ID: ' + variationID);
    }
</script>

</body>
</html>
