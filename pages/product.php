<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal mt-20">

    <!-- Navbar -->
    <?php include_once "../components/navbar.php"; ?>

    <div class="container mx-auto p-6">
        <!-- Product Section -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <!-- Product Image -->
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/2">
                    <img src="<?php echo htmlspecialchars($product_image); ?>" alt="<?php echo htmlspecialchars($product_name); ?> Image" class="rounded-lg w-full">
                </div>
                <!-- Product Details -->
                <div class="md:w-1/2 md:pl-6">
                    <h1 class="text-3xl font-bold mb-2"><?php echo htmlspecialchars($product_name); ?></h1>
                    <p class="text-gray-700 mb-4"><?php echo htmlspecialchars($product_description); ?></p>
                    <p class="text-2xl font-semibold text-green-600 mb-4">₱<?php echo htmlspecialchars($product_price); ?></p>
                    <!-- Availability -->
                    <p class="<?php echo $product_stock > 0 ? 'text-green-600' : 'text-red-600'; ?> mb-4">
                        <?php echo $product_stock > 0 ? 'In Stock' : 'Out of Stock'; ?>
                    </p>
                    <!-- Add to Cart Button -->
                    <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded-full hover:bg-blue-700" <?php echo $product_stock > 0 ? '' : 'disabled'; ?>>
                        <?php echo $product_stock > 0 ? 'Add to Cart' : 'Out of Stock'; ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
