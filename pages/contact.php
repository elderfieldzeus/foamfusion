<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .bg-custom {
            background-image: url('../assets/conatct/foam_contact.png');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-custom min-h-screen flex items-center justify-center p-4">

    <!--navbar--> 
    <?php include_once "../components/navbar.php"; ?>   

    <div class="bg-white shadow-md rounded-lg w-full max-w-5xl mx-auto flex flex-col md:flex-row">
        <div class="w-full md:w-1/2 p-6">
            <div class="h-64 w-full bg-gray-300 rounded-lg overflow-hidden">
                <iframe class="w-full h-full" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.835434509083!2d144.9537363153072!3d-37.81627977975185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0xf57769c3432b4f45!2sVictoria%20Harbour%20Promenade%2C%20Docklands%20VIC%203008%2C%20Australia!5e0!3m2!1sen!2sus!4v1636665257600!5m2!1sen!2sus" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="mt-6 space-y-4">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Contact Information</h3>
                    <p class="text-gray-700 mt-2"><i class="fas fa-phone-alt mr-2"></i>(123) 456-7890</p>
                    <p class="text-gray-700 mt-1"><i class="fas fa-envelope mr-2"></i>info@example.com</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Follow Us</h3>
                    <div class="flex space-x-4 mt-2">
                        <a href="#" class="text-gray-700 hover:text-blue-500"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-700 hover:text-blue-400"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-700 hover:text-pink-600"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full md:w-1/2 p-6">
            <h3 class="text-2xl font-bold mb-6 text-center">Contact Us</h3>
            <form id="fcf-form-id" class="space-y-4" method="post" action="contact-form-process.php">
                <div>
                    <label for="Name" class="block text-sm font-medium text-gray-700">Your Name</label>
                    <input type="text" id="Name" name="Name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter your name" required>
                </div>
                <div>
                    <label for="Name" class="block text-sm font-medium text-gray-700">Subject</label>
                    <input type="text" id="Subject" name="Subject" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter the Subject" required>
                </div>
                <div>
                    <label for="Email" class="block text-sm font-medium text-gray-700">Your Email Address</label>
                    <input type="email" id="Email" name="Email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter email" required>
                </div>
                <div>
                    <label for="Message" class="block text-sm font-medium text-gray-700">Your Message</label>
                    <textarea id="Message" name="Message" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 h-32" maxlength="3000" placeholder="Enter your concenrs here!" required></textarea>
                </div>
                <div>
                    <button type="submit" id="fcf-button" class="w-full bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
