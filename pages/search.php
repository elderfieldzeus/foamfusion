<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/user.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/search.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/shopping-cart.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-ACc2h1nMhsZ4wMDyAu8AKRz0sR1VJwROk67O6r2THC5wHc4IefQ3xH4z1ENp2/zzTBOogNdc3sAd2f/EJm6Kxw==" crossorigin="anonymous" referrerpolicy="no-referrer">

</head>
<body class="bg-gray-100 min-h-screen flex flex-col justify-between">

    <!-- Navbar -->
    <?php include_once "../components/navbar.php"; ?>

    <main class="container mx-auto px-4 flex-1 mt-32">
        <?php
        // Check if the search query parameter exists
        if (isset($_GET['search_query'])) {
            // Get the search query from the URL parameter
            $search_query = urldecode($_GET['search_query']);

            // Example: Perform search (replace with your actual search logic)
            $results = perform_search($search_query);

            // Display search results
            if (!empty($results)) {
                echo "<h2 class='text-lg font-bold mb-4'>Results for: <span class='text-indigo-600'>$search_query</span></h2>";
                echo "<ul class='space-y-2'>";
                foreach ($results as $result) {
                    echo "<li class='bg-white rounded-lg shadow-md p-4'>";
                    echo "<div class='flex items-center'>";
                    echo "<div class='flex-shrink-0'>";
                    echo "<i class='fas fa-search text-gray-400'></i>";
                    echo "</div>";
                    echo "<div class='ml-3'>";
                    echo "<p class='text-sm font-medium text-gray-900'>$result</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p class='text-gray-600'>No results found for: <span class='font-medium'>$search_query</span></p>";
            }
        } else {
            // Handle cases where no search query parameter is provided
            echo "<p class='text-gray-600'>No search query provided.</p>";
        }

        // Example function for performing search (replace with your actual implementation)
        function perform_search($query) {
            // Simulated search results for demonstration
            $results = array(
                "Result 1 related to $query",
                "Result 2 related to $query"
                // Add more results as needed
            );
            return $results;
        }
        ?>
    </main>

    <footer class="bg-white shadow-lg">
        <div class="container mx-auto px-4 py-2 text-center text-gray-600">
            &copy; 2024 Your Company. All rights reserved.
        </div>
    </footer>
</body>
</html>
