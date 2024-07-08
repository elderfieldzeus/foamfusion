<!DOCTYPE html>
<html lang="en">

<?php

    require_once "../utilities/include.php";
    require_once "../utilities/var.sql.php";

    $auth->signup("Sample", "Name", "2003-5-12", "09177755790", "sample@gmail.com", "Sample", "Sample", "Sample", "6014", "123", "123", "Admin");

    $db->killConnection();
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
            <a href="#products" class="mt-8 inline-block bg-indigo-600 text-white px-6 py-3 rounded-full text-lg font-medium hover:bg-indigo-700 transition duration-300">Shop Now</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 py-8">
        <div class="container mx-auto px-4">
            <div class="flex justify-between">
                <div>
                    <h3 class="text-lg font-bold">FoamFusion Soap</h3>
                    <p class="mt-2">123 Soap St.<br>Clean City, Soapland 12345</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold">Follow Us</h3>
                    <div class="flex space-x-4 mt-2">
                        <a href="#" class="text-gray-300 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-300 hover:text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-300 hover:text-white"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="bg-gray-900 text-gray-500 text-center py-4">
        <p>&copy; 2024 FoamFusion Soap. All rights reserved.</p>
    </div>

</body>

</html>
