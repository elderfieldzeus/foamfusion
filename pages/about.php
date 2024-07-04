<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoamFusion Soaps</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/user.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/search.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/arrow-left.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/arrow-right.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/shopping-cart.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-ACc2h1nMhsZ4wMDyAu8AKRz0sR1VJwROk67O6r2THC5wHc4IefQ3xH4z1ENp2/zzTBOogNdc3sAd2f/EJm6Kxw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <style>
        .bg-cover-custom {
            background-image: url('https://source.unsplash.com/1600x900/?soap');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <?php include_once "../components/navbar.php"; ?>

    <!-- About Section -->
    <section class="mt-20 mb-14 h-full flex flex-col md:flex-row items-center justify-center bg-cover-custom bg-center w-full">
        <div class="w-full md:w-1/2 flex flex-col items-center md:items-start p-6 md:p-20">
            <h1 class="text-4xl md:text-6xl font-bold text-black">About Us</h1>
            <p class="mt-4 text-base md:text-lg text-black">Welcome to FoamFusion Soaps, your one-stop shop for premium home-blend soaps. We are a small, passionate team dedicated to crafting high-quality soaps that cater to all your cleaning needs, from the kitchen to your personal care routine.</p>
            <p class="mt-4 text-base md:text-lg text-black">At FoamFusion Soaps, we believe in the power of natural ingredients and the magic of unique blends. Our journey began with a simple idea: to create soaps that are not only effective but also gentle on the skin and the environment. Today, we take pride in offering a range of soaps that are perfect for everyday use and special occasions alike.</p>
            <p class="mt-4 text-base md:text-lg text-black">Thank you for choosing FoamFusion Soaps. We are committed to providing you with products that make your cleaning routine enjoyable and effective. Join us on this journey to experience the perfect blend of quality and care.</p>
            <p class="mt-4 text-base md:text-lg text-black">Feel free to reach out to us with any questions, feedback, or suggestions. We love hearing from our customers and are always here to help.</p>
        </div>
        <div class="w-full md:w-1/2 flex justify-center p-6 md:p-20">
            <img src="../assets/logo/logo.png" alt="FoamFusion Soap Image" class="rounded-lg shadow-lg">
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between">
                <div>
                    <h3 class="text-lg font-bold">FoamFusion Soap</h3>
                    <p class="mt-2">123 Soap St.<br>Clean City, Soapland 12345</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold">Follow Us</h3>
                    <div class="flex space-x-4 mt-2">
                        <a href="#" class="text-gray-300 hover:text-black"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-300 hover:text-black"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-300 hover:text-black"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
