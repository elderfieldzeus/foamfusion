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
                <!-- <a href="#" id="search-icon" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                    <i class="gg-search"></i>
                </a> -->
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

<div id="auth-modal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 hidden z-50">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Log In</h3>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <form action="../utilities/login.php" method="post" id="login-form" class="space-y-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" name="email" type="email" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 px-2 focus:bg-gray-100 py-2 rounded-md">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" name="password" type="password" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 px-2 focus:bg-gray-100 py-2 rounded-md">
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
                <form action="../utilities/signup.php" method="post" id="signup-form" class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input id="name" name="name" type="text" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 px-2 focus:bg-gray-100 py-2 rounded-md">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" name="email" type="email" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 px-2 focus:bg-gray-100 py-2 rounded-md">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" name="password" type="password" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 px-2 focus:bg-gray-100 py-2 rounded-md">
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    });

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

        // authModal.addEventListener('click', () => {
        //     authModal.classList.toggle('hidden');
        // });

        // signupModal.addEventListener('click', () => {
        //     signupModal.classList.toggle('hidden');
        // });

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
</script>

    <!-- <script>
    document.getElementById('close-modal').addEventListener('click', function() {
        document.getElementById('search-modal').classList.add('hidden');
    });

    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    });

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
</script> -->
