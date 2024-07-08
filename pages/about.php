<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoamFusion Soaps</title>
    <link href="../styles/tailwind.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/user.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/search.css' rel='stylesheet'>
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
            <img src="../assets/logo/logo_transparent_black.png" alt="FoamFusion Soap Image" class="rounded-lg shadow-lg">
        </div>
    </section>

    <!-- Mission and Vision Section -->
    <section class="mt-10 p-6 md:p-20 bg-white">
        <div class="container mx-auto">
            <!-- Mission -->
            <div class="flex flex-col md:flex-row items-center mb-16">
                <div class="w-full md:w-1/2 flex justify-center p-6">
                    <img src="https://images.unsplash.com/photo-1508759073847-9ca702cec7d2?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c29hcHxlbnwwfHwwfHx8MA%3D%3D" alt="Mission Image" class="rounded-lg shadow-lg">
                </div>
                <div class="w-full md:w-1/2 p-6 text-center md:text-left">
                    <h3 class="text-2xl font-semibold text-gray-700">Mission</h3>
                    <p class="mt-4 text-lg text-gray-600">Our mission is to create high-quality, eco-friendly soaps that provide an enjoyable and effective cleaning experience while promoting sustainability and the well-being of our customers and the environment.</p>
                </div>
            </div>

            <!-- Vision -->
            <div class="flex flex-col md:flex-row items-center">
                <div class="w-full md:w-1/2 p-6 text-center md:text-left">
                    <h3 class="text-2xl font-semibold text-gray-700">Vision</h3>
                    <p class="mt-4 text-lg text-gray-600">Our vision is to be a leading brand in the soap industry, recognized for our commitment to quality, innovation, and environmental responsibility. We strive to inspire a cleaner, healthier world with our products and practices.</p>
                </div>
                <div class="w-full md:w-1/2 flex justify-center p-6">
                    <img src="https://images.unsplash.com/photo-1705155726514-d0394f2820e1?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fGxpcXVpZCUyMHNvYXB8ZW58MHx8MHx8fDA%3D" alt="Vision Image" class="rounded-lg shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="bg-gray-200 py-8">
        <div class="container mx-auto px-4 text-center">
            <h3 class="text-2xl font-bold text-gray-700 mb-4">Subscribe to our Newsletter</h3>
            <p class="text-gray-600 mb-6">Get the latest updates on new products and upcoming sales</p>
            <form class="w-full max-w-sm mx-auto" onsubmit="sendEmail(event)">
                <div class="flex items-center border-b border-gray-500 py-2">
                    <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="email" placeholder="Enter your email" aria-label="Email" name="email">
                    <button class="flex-shrink-0 bg-gray-700 hover:bg-gray-900 border-gray-700 hover:border-gray-900 text-sm border-4 text-white py-1 px-2 rounded" type="submit">
                        Subscribe
                    </button>
                </div>
            </form>
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

    <script src="https://cdn.jsdelivr.net/npm/emailjs-com@2.6.4/dist/email.min.js"></script>
    <script>
        (function(){
            emailjs.init("jUQDE_dlABvpcAawZ");
        })();
        
        function sendEmail(event) {
            event.preventDefault();
            const form = event.target;
            emailjs.sendForm('service_9i6b9do', 'template_ygywmxh', form)
                .then((result) => {
                    form.reset();
                    alert("Message status: " + result.text);
                }, (error) => {
                    alert("Error in sending: " + error.text);
                });
        }
    </script>
    
</body>
</html>
