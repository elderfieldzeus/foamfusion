<nav class="bg-gray-800 fixed left-4 right-4 top-4 z-10 shadow-md rounded-lg">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <a href="#" class="text-white text-2xl font-bold">Logo</a>
                </div>
                <div class="hidden md:flex md:space-x-8">
                    <a href="../pages/home.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition duration-300">Home</a>
                    <a href="../pages/about.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition duration-300">About</a>
                    <a href="../pages/product.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition duration-300">Product</a>
                    <a href="../pages/contact.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition duration-300">Contact</a>
                </div>
                <div class="flex items-center md:space-x-4">
                    <a href="#" id="user-icon" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                        <i class="gg-user"></i>
                    </a>
                    <a href="#" id="search-icon" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                        <i class="gg-search"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                        <i class="gg-shopping-cart"></i>
                    </a>
                    <div class="md:hidden flex items-center">
                        <button id="mobile-menu-button" class="text-gray-300 hover:text-white focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div id="mobile-menu" class="hidden md:hidden">
            <a href="../pages/home.php" class="block px-4 py-2 text-gray-300 hover:text-white">Home</a>
            <a href="../pages/about.php" class="block px-4 py-2 text-gray-300 hover:text-white">About</a>
            <a href="../pages/product.php" class="block px-4 py-2 text-gray-300 hover:text-white">Product</a>
            <a href="../pages/contact.php" class="block px-4 py-2 text-gray-300 hover:text-white">Contact</a>
        </div>
    </nav>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    });
</script>
