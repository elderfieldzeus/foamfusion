<?php
session_start();

// Initialize the cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add item to the cart
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $quantity = $_POST['quantity'];

    $item = [
        'product_id' => $product_id,
        'product_name' => $product_name,
        'product_price' => $product_price,
        'quantity' => $quantity,
    ];

    array_push($_SESSION['cart'], $item);
}

// Update the cart quantity
if (isset($_POST['update_cart'])) {
    $index = $_POST['index'];
    $quantity = $_POST['quantity'];
    $_SESSION['cart'][$index]['quantity'] = $quantity;
}

// Remove item from the cart
if (isset($_POST['remove_from_cart'])) {
    $index = $_POST['index'];
    array_splice($_SESSION['cart'], $index, 1);
}

$cart_items = $_SESSION['cart'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/user.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/search.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/shopping-cart.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!--navbar--> 
    <?php include_once "../components/navbar.php"; ?>   
    <div class="container mx-auto mt-32">
        <div class="flex shadow-md my-10">
            <div class="w-3/4 bg-white px-10 py-10">
                <div class="flex justify-between border-b pb-8">
                    <h1 class="font-semibold text-2xl">Shopping Cart</h1>
                    <h2 class="font-semibold text-2xl"><?php echo count($cart_items); ?> Items</h2>
                </div>
                <div class="flex mt-10 mb-5">
                    <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Product Details</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Quantity</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Price</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Total</h3>
                </div>
                <?php foreach ($cart_items as $index => $item): ?>
                <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5">
                    <div class="flex w-2/5">
                        <div class="w-20">
                            <img class="h-24" src="path/to/image.jpg" alt="Product Image">
                        </div>
                        <div class="flex flex-col justify-between ml-4 flex-grow">
                            <span class="font-bold text-sm"><?php echo $item['product_name']; ?></span>
                            <form method="POST">
                                <input type="hidden" name="index" value="<?php echo $index; ?>">
                                <button type="submit" name="remove_from_cart" class="font-semibold hover:text-red-500 text-gray-500 text-xs">Remove</button>
                            </form>
                        </div>
                    </div>
                    <div class="flex justify-center w-1/5">
                        <form method="POST" class="flex">
                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                            <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" class="mx-2 border text-center w-8">
                            <button type="submit" name="update_cart" class="font-semibold text-sm text-indigo-600">Update</button>
                        </form>
                    </div>
                    <span class="text-center w-1/5 font-semibold text-sm">$<?php echo $item['product_price']; ?></span>
                    <span class="text-center w-1/5 font-semibold text-sm">$<?php echo $item['product_price'] * $item['quantity']; ?></span>
                </div>
                <?php endforeach; ?>
            </div>
            <!-- Order Summary Section -->
        </div>
    </div>
</body>
</html>
