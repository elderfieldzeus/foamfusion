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
$conn->close();
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
        let cart = [];

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

        function addToCart(variationID) {
            const quantityInput = document.querySelector(`#product-${variationID} .quantity-input`);
            const quantity = parseInt(quantityInput.value);

            const existingCartItem = cart.find(item => item.variationID === variationID);
            if (existingCartItem) {
                existingCartItem.quantity += quantity;
            } else {
                const productElement = document.getElementById(`product-${variationID}`);
                const productName = productElement.querySelector('.variation-name').textContent;
                const unitPrice = parseFloat(productElement.querySelector('.variation-price').textContent.replace('₱', ''));

                cart.push({ variationID, productName, unitPrice, quantity });
            }
            updateCartUI();

            // Send data to server
            const formData = new FormData();
            formData.append('variationID', variationID);
            formData.append('quantity', quantity);

            fetch('add_to_cart.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function editCartItem(variationID) {
            const newQuantity = parseInt(prompt('Enter new quantity:'));
            if (!isNaN(newQuantity) && newQuantity > 0) {
                const cartItem = cart.find(item => item.variationID === variationID);
                if (cartItem) {
                    cartItem.quantity = newQuantity;
                    updateCartUI();
                }
            } else {
                alert('Please enter a valid quantity.');
            }
        }

        function deleteCartItem(variationID) {
            cart = cart.filter(item => item.variationID !== variationID);
            updateCartUI();
        }

        function updateCartUI() {
            const cartElement = document.querySelector('#cart');
            cartElement.innerHTML = '';

            cart.forEach(item => {
                const cartItemElement = document.createElement('div');
                cartItemElement.classList.add('flex', 'justify-between', 'items-center', 'border-b', 'pb-2', 'mb-2');
                cartItemElement.innerHTML = `
                    <div>${item.productName} - Quantity: ${item.quantity}</div>
                    <div>
                        <button class="bg-blue-500 text-white px-2 py-1 rounded mr-2" onclick="editCartItem(${item.variationID})">Edit</button>
                        <button class="bg-red-500 text-white px-2 py-1 rounded" onclick="deleteCartItem(${item.variationID})">Delete</button>
                    </div>
                `;
                cartElement.appendChild(cartItemElement);
            });
        }
    </script>
</head>
<body class="bg-gray-100">

<!--navbar--> 
<?php include_once "../components/navbar.php"; ?>

<div class="container mx-auto p-6 mt-24">
    <div class="flex">
        <div class="w-3/4">
            <h1 class="text-3xl font-bold mb-6">Our Products</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-2 gap-6 product-grid">
            <?php
            foreach ($variations as $variation) {
                echo "
                <div id='product-{$variation['VariationID']}' class='bg-white p-6 rounded-lg shadow-md product'>
                    <h2 class='text-xl font-bold mb-2 variation-name'>{$variation['VariationName']}</h2>
                    <p class='text-gray-700 mb-2 variation-description'>{$variation['VariationDescription']}</p>
                    <p class='text-gray-700 mb-2'>Product Name: {$variation['ProductName']}</p>
                    <img src='{$variation['VariationImage']}' alt='{$variation['VariationName']}' class='w-full h-48 object-cover mb-4'>
                    <p class='text-gray-700 mb-2 variation-price'>₱{$variation['UnitPrice']}</p>
                    <p class='text-gray-700 mb-2'>In Stock: {$variation['InStock']}</p>
                    <input type='number' value='1' min='1' max='{$variation['InStock']}' class='quantity-input w-16 p-1 border rounded mb-4'>
                    <button class='bg-blue-500 text-white px-4 py-2 rounded' onclick='addToCart({$variation['VariationID']})'>Add to Cart</button>
                </div>
                ";
            }
            ?>
            </div>
        </div>

        <div class="w-1/4 pl-6">
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

    <div class="mt-12">
        <h2 class="text-2xl font-bold mb-4">Cart</h2>
        <div id="cart" class="bg-white p-4 rounded-lg shadow-md"></div>
        <a href="cart.php" class="bg-green-500 text-white px-4 py-2 rounded mt-4 inline-block">Go to Cart</a>
    </div>
</div>

<div id="productModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div id="modalContent"></div>
    </div>
</div>

</body>
</html>
