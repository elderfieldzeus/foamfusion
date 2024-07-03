<!DOCTYPE html>
<html lang="en">

<?php

    require_once "../utilities/include.php";
    require_once "../utilities/var.sql.php";

    if(!$auth->signup("Zeus", "Elderfield", "David", "2003-5-12", "09177755790", "elderfieldzeus24@gmail.com", "Mandaue", "Basak", "St. John", "6014", "123", "123", "Customer")) {
        alert("Failed");
    }

    if(!$auth->signup("Zeus", "Elderfield", "David", "2003-5-12", "09177755790", "elderfieldzeus24@gmail.com", "Mandaue", "Basak", "St. John", "6014", "123", "123", "Admin")) {
        alert("Failed");
    }

    // if($auth->login("elderfieldzeus24@gmail.com", "123", "Admin")) {
    //     alert("Logged In Successfully");
    // }
    // else {
    //     alert("Failed to Login");
    // }

    // if($auth->signout()) {
    //     alert("Logged out successfully");
    // }

    // $insert->insertCustomer("Zeus", "Elderfield", "David", "2003-5-12", "09177755790", "elderfieldzeus@gmail.com", "Mandaue", "Tabok", "St. Philip", "6014", "123");
    // $insert->insertEmployee("Zeus", "Elderfield", "David", "2003-5-12", "09177755790", "elderfieldzeus@gmail.com", "Mandaue", "Tabok", "St. Philip", "6014", "123");

    // $insert->insertProduct("Soap");
    // $insert->insertVariation("Soap", "Green", "Meow", "image.jpg", 200, 10.00, 1);
    
    // $insert->insertOrder(10.00, 1);
    // $insert->insertOrderedProducts(10, 1, 1);

    // $insert->insertDelivery(10.00, 1, 1);
    // $insert->insertDeliveredProducts(10, 1, 1);

    $result = $select->selectAllDeliveries();

    $db->killConnection();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoamFusion Soap</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/user.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/search.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/arrow-left.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/arrow-right.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/shopping-cart.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-ACc2h1nMhsZ4wMDyAu8AKRz0sR1VJwROk67O6r2THC5wHc4IefQ3xH4z1ENp2/zzTBOogNdc3sAd2f/EJm6Kxw==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <?php include_once "../components/navbar.php"; ?>

    <!-- Hero Section -->
    <section class="h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('../assets/sink.png'); background-attachment: fixed;">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-white">Welcome to FoamFusion Soap</h1>
            <p class="mt-4 text-lg md:text-2xl text-white">The best soap you'll ever use</p>
            <a href="#products" class="mt-8 inline-block bg-indigo-600 text-white px-6 py-3 rounded-full text-lg font-medium hover:bg-indigo-700 transition duration-300">Shop Now</a>
        </div>
    </section>

    <!-- Product Section -->
    <section id="products" class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8">Our Products</h2>
            <div class="relative px-8">
                <!-- Added padding here -->
                <div id="carousel" class="flex space-x-4 overflow-hidden">
                    <div class="flex-none w-64 bg-white shadow-md rounded-lg p-4">
                        <img src="https://via.placeholder.com/256x256" alt="Product 1" class="w-full h-48 object-cover rounded-md">
                        <h3 class="mt-4 text-lg font-medium">Product 1</h3>
                        <p class="mt-2 text-gray-600">₱0,000</p>
                        <a href="#" class="mt-4 inline-block bg-indigo-600 text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-indigo-700 transition duration-300">Add to Cart</a>
                    </div>
                    <div class="flex-none w-64 bg-white shadow-md rounded-lg p-4">
                        <img src="https://via.placeholder.com/256x256" alt="Product 2" class="w-full h-48 object-cover rounded-md">
                        <h3 class="mt-4 text-lg font-medium">Product 2</h3>
                        <p class="mt-2 text-gray-600">₱0,000</p>
                        <a href="#" class="mt-4 inline-block bg-indigo-600 text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-indigo-700 transition duration-300">Add to Cart</a>
                    </div>
                    <div class="flex-none w-64 bg-white shadow-md rounded-lg p-4">
                        <img src="https://via.placeholder.com/256x256" alt="Product 3" class="w-full h-48 object-cover rounded-md">
                        <h3 class="mt-4 text-lg font-medium">Product 3</h3>
                        <p class="mt-2 text-gray-600">₱0,000</p>
                        <a href="#" class="mt-4 inline-block bg-indigo-600 text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-indigo-700 transition duration-300">Add to Cart</a>
                    </div>
                    <div class="flex-none w-64 bg-white shadow-md rounded-lg p-4">
                        <img src="https://via.placeholder.com/256x256" alt="Product 3" class="w-full h-48 object-cover rounded-md">
                        <h3 class="mt-4 text-lg font-medium">Product 4</h3>
                        <p class="mt-2 text-gray-600">₱0,000</p>
                        <a href="#" class="mt-4 inline-block bg-indigo-600 text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-indigo-700 transition duration-300">Add to Cart</a>
                    </div>
                    <div class="flex-none w-64 bg-white shadow-md rounded-lg p-4">
                        <img src="https://via.placeholder.com/256x256" alt="Product 3" class="w-full h-48 object-cover rounded-md">
                        <h3 class="mt-4 text-lg font-medium">Product 5</h3>
                        <p class="mt-2 text-gray-600">₱0,000</p>
                        <a href="#" class="mt-4 inline-block bg-indigo-600 text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-indigo-700 transition duration-300">Add to Cart</a>
                    </div>
                    <div class="flex-none w-64 bg-white shadow-md rounded-lg p-4">
                        <img src="https://via.placeholder.com/256x256" alt="Product 3" class="w-full h-48 object-cover rounded-md">
                        <h3 class="mt-4 text-lg font-medium">Product 6</h3>
                        <p class="mt-2 text-gray-600">₱0,000</p>
                        <a href="#" class="mt-4 inline-block bg-indigo-600 text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-indigo-700 transition duration-300">Add to Cart</a>
                    </div>
                    <!-- Add more product cards as needed -->
                </div>
                <button id="prev" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white rounded-full p-2">
                    <i class="gg-arrow-left"></i>
            </button>
                <button id="next" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white rounded-full p-2">
                    <i class="gg-arrow-right"></i>
            </button>
            </div>
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

    <!-- Modals -->
    <div id="auth-modal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 hidden z-50">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Log In</h3>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <form id="login-form" class="space-y-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" name="email" type="email" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" name="password" type="password" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div>
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Log in</button>
                    </div>
                </form>
                <div class="mt-6">
                    <p class="text-sm text-gray-500">Don't have an account? <a href="#" id="signup-link" class="font-medium text-indigo-600 hover:text-indigo-500">Sign up</a></p>
                </div>
            </div>
        </div>
    </div>

    <div id="signup-modal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 hidden z-50">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Sign Up</h3>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <form id="signup-form" class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input id="name" name="name" type="text" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" name="email" type="email" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" name="password" type="password" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div>
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Sign up</button>
                    </div>
                </form>
                <div class="mt-6">
                    <p class="text-sm text-gray-500">Already have an account? <a href="#" id="login-link" class="font-medium text-indigo-600 hover:text-indigo-500">Log in</a></p>
                </div>
            </div>
        </div>
    </div>

    <div id="search-modal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 hidden z-50">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Search</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Find what you're looking for.</p>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <form id="search-form" class="space-y-6">
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                        <input id="search" name="search" type="text" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div>
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const userIcon = document.getElementById('user-icon');
        const searchIcon = document.getElementById('search-icon');
        const authModal = document.getElementById('auth-modal');
        const signupModal = document.getElementById('signup-modal');
        const searchModal = document.getElementById('search-modal');
        const signupLink = document.getElementById('signup-link');
        const loginLink = document.getElementById('login-link');

        userIcon.addEventListener('click', () => {
            authModal.classList.toggle('hidden');
        });

        searchIcon.addEventListener('click', () => {
            searchModal.classList.toggle('hidden');
        });

        signupLink.addEventListener('click', (e) => {
            e.preventDefault();
            authModal.classList.add('hidden');
            signupModal.classList.remove('hidden');
        });

        loginLink.addEventListener('click', (e) => {
            e.preventDefault();
            signupModal.classList.add('hidden');
            authModal.classList.remove('hidden');
        });

        window.addEventListener('click', (e) => {
            if (e.target == authModal) {
                authModal.classList.add('hidden');
            }
            if (e.target == signupModal) {
                signupModal.classList.add('hidden');
            }
            if (e.target == searchModal) {
                searchModal.classList.add('hidden');
            }
        });

        const carousel = document.getElementById('carousel');
        const prev = document.getElementById('prev');
        const next = document.getElementById('next');
        let scrollAmount = 0;

        next.addEventListener('click', () => {
            carousel.scrollTo({
                top: 0,
                left: (scrollAmount += carousel.clientWidth),
                behavior: 'smooth'
            });
        });

        prev.addEventListener('click', () => {
            carousel.scrollTo({
                top: 0,
                left: (scrollAmount -= carousel.clientWidth),
                behavior: 'smooth'
            });
        });
    </script>
</body>

</html>