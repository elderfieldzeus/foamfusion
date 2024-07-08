<!DOCTYPE html>
<html lang="en">

<?php

require_once "../utilities/include.php";
require_once "../utilities/var.sql.php";

$auth->signup("Sample", "Name", "2003-5-12", "09177755790", "sample@gmail.com", "Sample", "Sample", "Sample", "6014", "123", "123", "Admin");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "foamfusion_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products and their variations
$sql = "
    SELECT p.ProductID, p.ProductName, v.VariationID, v.VariationName, v.VariationDescription, v.VariationImage, v.UnitPrice, v.InStock
    FROM Products p
    JOIN Variations v ON p.ProductID = v.ProductID
";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = [
        'VariationID' => $row['VariationID'],
        'VariationName' => $row['VariationName'],
        'VariationDescription' => $row['VariationDescription'],
        'VariationImage' => $row['VariationImage'],
        'UnitPrice' => $row['UnitPrice'],
        'InStock' => $row['InStock'],
        'ProductName' => $row['ProductName']
    ];  
}
$conn->close();

// Select 3 random products
shuffle($products);
$randomProducts = array_slice($products, 0, 3);

// Sample testimonials
$testimonials = [
    [
        'quote' => "I love FoamFusion Soap! Their products are amazing and smell fantastic. Highly recommended!",
        'name' => "John Doe",
        'role' => "Customer"
    ],
    [
        'quote' => "FoamFusion Soap has changed my skincare routine. I couldn't be happier with their products!",
        'name' => "Jane Smith",
        'role' => "Customer"
    ],
    [
        'quote' => "Excellent customer service and top-notch quality. I'm a loyal customer!",
        'name' => "Michael Johnson",
        'role' => "Customer"
    ]
];

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoamFusion Soap</title>
    <link href="../styles/tailwind.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/user.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/search.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/shopping-cart.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/facebook.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/twitter.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/instagram.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-ACc2h1nMhsZ4wMDyAu8AKRz0sR1VJwROk67O6r2THC5wHc4IefQ3xH4z1ENp2/zzTBOogNdc3sAd2f/EJm6Kxw==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <?php include_once "../components/navbar.php"; ?>

    <!-- Hero Section -->
    <section class="h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1507608158173-1dcec673a2e5?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mzh8fGJhY2tncm91bmR8ZW58MHx8MHx8fDA%3D'); background-attachment: fixed;">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-white">Welcome to FoamFusion Soap</h1>
            <p class="mt-4 text-lg md:text-2xl text-white">The best soap you'll ever use</p>
            <a href="./product.php" class="mt-8 inline-block bg-indigo-600 text-white px-6 py-3 rounded-full text-lg font-medium hover:bg-indigo-700 transition duration-300">Shop Now</a>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold">Featured Products</h2>
                <a href="./product.php" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-300">View All</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <?php
                foreach ($randomProducts as $product) {
                    echo "
                    <div class='bg-gray-200 p-6 rounded-lg shadow-lg'>
                        <img src='../assets/products/{$product['VariationImage']}' alt='{$product['VariationName']}' class='w-full h-48 object-cover mb-4 rounded'>
                        <h3 class='text-xl font-bold mb-2'>{$product['ProductName']}</h3>
                        <h4 class='text-md font-semibold mb-1'>{$product['VariationName']}</h4>
                        <p class='text-gray-700 mb-4'>{$product['VariationDescription']}</p>
                        <p class='text-lg font-semibold mb-2'>₱{$product['UnitPrice']}</p>
                        <a href='./product.php' class='block bg-indigo-600 text-white text-center py-2 rounded-lg hover:bg-indigo-700 transition duration-300'>View Product</a>
                    </div>";
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8">What Our Customers Say</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <?php foreach ($testimonials as $testimonial) : ?>
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <p class="text-lg text-gray-700 mb-4">"<?php echo $testimonial['quote']; ?>"</p>
                        <p class="text-gray-600">- <?php echo $testimonial['name']; ?>, <?php echo $testimonial['role']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 py-8">
        <div class="container mx-auto px-4">
            <div class="flex justify-between">
                <div>
                    <h3 class="text-lg font-bold">FoamFusion Soap</h3>
                    <p class="mt-2">Sitio Nasipit<br>Brgy, Cebu City</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold">Follow Us</h3>
                    <div class="flex mt-2">
                        <a href="#" class="text-gray-300 hover:text-white mr-4"><i class="gg-facebook"></i></a>
                        <a href="#" class="text-gray-300 hover:text-white mr-4"><i class="gg-twitter"></i></a>
                        <a href="#" class="text-gray-300 hover:text-white mr-4"><i class="gg-instagram"></i></a>
                    </div>
                </div>
            </div>
            <p class="mt-4 text-center">&copy; <?php echo date('Y'); ?> FoamFusion Soap. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.0/dist/alpine.min.js" defer></script>
</body>

</html>
