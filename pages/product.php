<?php


require_once "../utilities/include.php";
require_once "../utilities/var.sql.php";

$session->continueSession();

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "foamfusion_db";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// Step 1: Fetch products and their variations
$sql = "
    SELECT p.ProductID, p.ProductName, v.VariationID, v.VariationName, v.VariationDescription, v.VariationImage, v.UnitPrice, v.InStock
    FROM Products p
    JOIN Variations v ON p.ProductID = v.ProductID
";

$result = $db->conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

$variations = [];
$i = 0;
while ($row = $result->fetch_assoc()) {
    $variations[$i++] = [
        'VariationID' => $row['VariationID'],
        'VariationName' => $row['VariationName'],
        'VariationDescription' => $row['VariationDescription'],
        'VariationImage' => $row['VariationImage'],
        'UnitPrice' => $row['UnitPrice'],
        'InStock' => $row['InStock'],
        'ProductName' => $row['ProductName']
    ];  
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link href="../styles/tailwind.css" rel="stylesheet">
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/user.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/search.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/shopping-cart.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 50;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <script>
        function openModal(productID) {
            const modal = document.getElementById('productModal');
            const product = document.getElementById(`product-${productID}`);
            const modalContent = document.getElementById('modalContent');

            modalContent.innerHTML = product.innerHTML;
            modal.style.display = 'block';
        }

        function closeModal() {
            const modal = document.getElementById('productModal');
            modal.style.display = 'none';
        }

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

        function filterProducts() {
            const searchTerm = document.getElementById('search-bar').value.toLowerCase();
            const products = document.querySelectorAll('.product');

            products.forEach(product => {
                const productName = product.querySelector('.variation-name').textContent.toLowerCase();
                const productDesc = product.querySelector('.variation-description').textContent.toLowerCase();
                if (productName.includes(searchTerm) || productDesc.includes(searchTerm)) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        }
    </script>
</head>
<body class="bg-gray-100">

<!--navbar--> 
<?php include_once "../components/navbar.php"; ?>

<div class="container mx-auto p-6 flex mt-24">
    <div class="w-3/4">
        <h1 class="text-3xl font-bold mb-6">Our Products</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-2 gap-6 product-grid">
        <?php
        foreach ($variations as $variation) {
            echo "
            <div id='product-{$variation['VariationID']}' class='bg-white p-4 rounded-lg shadow-lg product cursor-pointer' onclick='openModal({$variation['VariationID']})'>
                <div class='flex'>
                    <div class='w-1/3 mr-6'>
                        <img class='w-full h-auto object-cover object-center mb-2' src='../assets/products/{$variation['VariationImage']}' alt='{$variation['VariationName']}'>
                    </div>
                    <div class='w-2/3'>
                        <h2 class='text-lg font-bold mb-2 variation-name'>{$variation['ProductName']}</h2>";
                $stockClass = ($variation['InStock'] == 0) ? 'text-red-500' : 'text-green-500';
                echo "
                        <div class='mb-4'>
                            <h3 class='text-md font-semibold mb-1 variation-name'>{$variation['VariationName']}</h3>
                            <p class='text-gray-700 mb-1 variation-price'>₱{$variation['UnitPrice']}</p>
                            <p class='text-gray-600 variation-description'>{$variation['VariationDescription']}</p>
                            <p class='$stockClass'>In Stock: {$variation['InStock']}</p>
                            <button class='bg-blue-500 text-white px-4 py-2 rounded mt-2' onclick='addToCart({$variation['VariationID']})'>Add to Cart</button>
                        </div>";
            echo "      </div>
                </div>
            </div>";
        }
        ?>
        </div>
    </div>

    <div class="w-1/4 pl-6 sticky-widget">
        <h2 class="text-xl font-bold mb-4">Search Products</h2>
        <input type="text" id="search-bar" class="mb-4 p-2 w-full border rounded" placeholder="Search..." onkeyup="filterProducts()">
        
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

<!-- The Modal -->
<div id="productModal" class="modal">
  <div class="modal-content p-6 rounded-lg shadow-lg bg-white">
    <span class="close text-black cursor-pointer text-2xl font-bold float-right" onclick="closeModal()">&times;</span>
    <div id="modalContent" class="mt-4"></div>
  </div>
</div>

</body>
</html>
