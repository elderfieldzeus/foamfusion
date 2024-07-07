<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

// Step 1: Fetch products and their variations
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
    $products[$row['ProductID']]['ProductName'] = $row['ProductName'];
    $products[$row['ProductID']]['Variations'][] = [
        'VariationID' => $row['VariationID'],
        'VariationName' => $row['VariationName'],
        'VariationDescription' => $row['VariationDescription'],
        'VariationImage' => $row['VariationImage'],
        'UnitPrice' => $row['UnitPrice'],
        'InStock' => $row['InStock']
    ];
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/user.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/search.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/shopping-cart.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        .sticky-widget {
            position: -webkit-sticky;
            position: sticky;
            top: 1rem;
        }
        .variation-container {
            background-color: #f7fafc;
            padding: 10px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
        }
        .text-red { color: red; }
        .text-green { color: green; }
    </style>
    <script>
        function sortProducts(criteria) {
            const products = document.querySelectorAll('.product');
            const productArray = Array.from(products);

            if (criteria === 'name') {
                productArray.sort((a, b) => {
                    const nameA = a.querySelector('.variation-name').textContent.toUpperCase();
                    const nameB = b.querySelector('.variation-name').textContent.toUpperCase();
                    return nameA.localeCompare(nameB);
                });
            } else if (criteria === 'price-asc') {
                productArray.sort((a, b) => {
                    const priceA = parseFloat(a.querySelector('.variation-price').textContent.replace('₱', ''));
                    const priceB = parseFloat(b.querySelector('.variation-price').textContent.replace('₱', ''));
                    return priceA - priceB;
                });
            } else if (criteria === 'price-desc') {
                productArray.sort((a, b) => {
                    const priceA = parseFloat(a.querySelector('.variation-price').textContent.replace('₱', ''));
                    const priceB = parseFloat(b.querySelector('.variation-price').textContent.replace('₱', ''));
                    return priceB - priceA;
                });
            }

            const container = document.querySelector('.product-grid');
            container.innerHTML = '';
            productArray.forEach(product => {
                container.appendChild(product);
            });
        }

        function handleSortChange() {
            const priceSortOrder = document.querySelector('input[name="price-sort"]:checked').value;
            sortProducts(priceSortOrder);
        }

        function resetSort() {
            document.getElementById('price-asc').checked = false;
            document.getElementById('price-desc').checked = false;
            sortProducts('name'); // Reset to sort by name
        }
    </script>
</head>
<body class="bg-gray-100">

<!--navbar--> 
<?php include_once "../components/navbar.php"; ?>

<div class="container mx-auto p-6 flex mt-24">
    <div class="w-3/4">
        <h1 class="text-3xl font-bold mb-6">Our Products</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
        <?php
        foreach ($products as $productID => $product) {
            echo "
            <div class='bg-white p-4 rounded-lg shadow-lg'>
                <h2 class='text-lg font-bold mb-2'>{$product['ProductName']}</h2>";
            foreach ($product['Variations'] as $variation) {
                $stockClass = ($variation['InStock'] == 0) ? 'text-red' : 'text-green';
                echo "
                <div class='mb-4'>
                    <img class='w-full h-48 object-cover object-center mb-2' src='{$variation['VariationImage']}' alt='{$variation['VariationName']}'>
                    <h3 class='text-md font-semibold mb-1'>{$variation['VariationName']}</h3>
                    <p class='text-gray-700 mb-1'>\${$variation['UnitPrice']}</p>
                    <p class='text-gray-600'>{$variation['VariationDescription']}</p>
                    <p class='$stockClass'>In Stock: {$variation['InStock']}</p>
                </div>";
            }
            echo "</div>";
        }
        ?>
    </div>
    </div>

    <div class="w-1/4 pl-6 sticky-widget">
        <h2 class="text-xl font-bold mb-4">Sort By</h2>
        <button class="bg-blue-500 text-white p-2 rounded mb-2 w-full" onclick="sortProducts('name')">Name</button>
        <div class="bg-white p-4 rounded-lg shadow-lg">
            <h3 class="text-md font-bold mb-2">Price</h3>
            <div class="mb-2">
                <input type="radio" name="price-sort" value="price-asc" id="price-asc" onchange="handleSortChange()">
                <label for="price-asc">Low to High</label>
            </div>
            <div class="mb-2">
                <input type="radio" name="price-sort" value="price-desc" id="price-desc" onchange="handleSortChange()">
                <label for="price-desc">High to Low</label>
            </div>
            <button class="bg-gray-300 text-gray-700 p-2 rounded w-full" onclick="resetSort()">Reset</button>
        </div>
    </div>
</div>

</body>
</html>
