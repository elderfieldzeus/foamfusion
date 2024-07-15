<?php
    require_once "../utilities/include.php";
    require_once "../utilities/var.sql.php";
    require_once "../functions/cart.functions.php";

    $session->continueSession();

    // Pagination variables
    $limit = 6; // Number of variations per page
    $page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page, default is 1
    $offset = ($page - 1) * $limit; // Offset calculation

    // SQL query with pagination
    $sql = "
        SELECT p.ProductID, p.ProductName, v.VariationID, v.VariationName, v.VariationDescription, v.VariationImage, v.UnitPrice, v.InStock, v.MassInOZ
        FROM Products p
        JOIN Variations v ON p.ProductID = v.ProductID
        LIMIT $limit OFFSET $offset
    ";

    $result = $db->conn->query($sql);

    if (!$result) {
        die("Query failed: " . $db->conn->error);
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
            'ProductName' => $row['ProductName'],
            'MassInOZ' => $row['MassInOZ']
        ];  
    }
    

    // Query to get total count
    $countQuery = "SELECT COUNT(*) AS total FROM Variations";
    $countResult = $db->conn->query($countQuery);
    $rowCount = $countResult->fetch_assoc()['total'];

    // Calculate total pages
    $totalPages = ceil($rowCount / $limit);

    
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
        .product.disabled {
            cursor: not-allowed;
            opacity: 0.7;
        }
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
        padding: 10px; /* Adjust padding for smaller modal */
        border: 1px solid #888;
        max-width: 400px; /* Adjust maximum width of the modal */
        width: 100%;
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
    <script defer>
        let cart = [];

        <?php

            //add session carts to front end cart
            if (isset($_SESSION['cart'])) {
                foreach($_SESSION['cart'] as $index => $cart) {
                    $result = $select->selectVariationData($cart->variation_id);
                    $row = $result->fetch_assoc();

                    $productName = $row['ProductName'];
                    $unitPrice = $row['UnitPrice'];
                    $variationName = $row['VariationName'];
                    $InStock = $row['InStock'];
                    $MassInOZ = $row['MassInOZ'];

                    echo '
                        let variationID_' . $index . ' = ' . $cart->variation_id . ';
                        let productName_' . $index . ' = "' . $productName . '";
                        let unitPrice_' . $index . ' = ' . $unitPrice . ';
                        let variationName_' . $index . ' = "' . $variationName . '";
                        let quantity_' . $index . ' = ' . $cart->quantity . ';
                        let inStock_' . $index . ' = ' . $InStock . ';
                        let massInOz_' . $index . ' = ' . $MassInOZ . ';


                        cart.push({
                            variationID: variationID_' . $index . ', 
                            productName: productName_' . $index . ',
                            unitPrice: unitPrice_' . $index . ', 
                            variationName: variationName_' . $index . ', 
                            quantity: quantity_' . $index . ',
                            inStock: inStock_' . $index . ',
                            massInOz: massInOz_' . $index . '
                        });
                    ';
                }
            }

        ?>

        function openModal(productID) {
            const modal = document.getElementById('productModal');
            const productImage = document.getElementById(`product-img-${productID}`);
            const modalImage = document.getElementById('modalImage');

            modalImage.src = productImage.src;
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
                const productName = product.querySelector('.product-name').textContent.toLowerCase();
                const variationName = product.querySelector('.variation-name').textContent.toLowerCase();
                const productDesc = product.querySelector('.variation-description').textContent.toLowerCase();
                if (productName.includes(searchTerm) ||  variationName.includes(searchTerm) || productDesc.includes(searchTerm)) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        }

        function addToCart(variationID) {
            const quantityInput = document.querySelector(`#product-${variationID} .quantity-input`);
            const quantity = parseInt(quantityInput.value);
            const maxStock = parseInt(quantityInput.max); 

            if (quantity > 0 && quantity <= maxStock) {
                const existingCartItem = cart.find(item => item.variationID === variationID);
                if (existingCartItem) {
                    existingCartItem.quantity = (existingCartItem.quantity + quantity > maxStock ? maxStock : existingCartItem.quantity + quantity);
                } else {
                    const productElement = document.getElementById(`product-${variationID}`);
                    const productName = productElement.querySelector('.product-name').textContent;
                    const variationName = productElement.querySelector('.variation-name').textContent;
                    const unitPrice = parseFloat(productElement.querySelector('.variation-price').textContent.replace('₱', ''));
                    const inStock = maxStock;

                    cart.push({ variationID, productName, unitPrice, variationName, quantity, inStock });
                }
                updateCartUI();

                const formData = new FormData();
                formData.append('variationID', variationID);
                formData.append('quantity', quantity);

                fetch('../utilities/add_to_cart.php', {
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

                quantityInput.value = 1;
            } else {
                alert('Please enter a valid quantity between 1 and ' + maxStock);
            }
        }

        function addToCartBig(variationID) {
            const quantityInput = document.querySelector(`#modal_${variationID} .quantity-input`);
            const quantity = parseInt(quantityInput.value);
            const maxStock = parseInt(quantityInput.max); 

            if (quantity > 0 && quantity <= maxStock) {
                const existingCartItem = cart.find(item => item.variationID === variationID);
                if (existingCartItem) {
                    existingCartItem.quantity = (existingCartItem.quantity + quantity > maxStock ? maxStock : existingCartItem.quantity + quantity);
                } else {
                    const productElement = document.getElementById(`product-${variationID}`);
                    const productName = productElement.querySelector('.product-name').textContent;
                    const variationName = productElement.querySelector('.variation-name').textContent;
                    const unitPrice = parseFloat(productElement.querySelector('.variation-price').textContent.replace('₱', ''));
                    const inStock = maxStock;

                    cart.push({ variationID, productName, unitPrice, variationName, quantity, inStock });
                }
                updateCartUI();

                const formData = new FormData();
                formData.append('variationID', variationID);
                formData.append('quantity', quantity);

                fetch('../utilities/add_to_cart.php', {
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

                quantityInput.value = 1;
            } else {
                alert('Please enter a valid quantity between 1 and ' + maxStock);
            }
        }


        function editCartItem(variationID) {
            let newQuantity = parseInt(prompt('Enter new quantity:'));
            if (!isNaN(newQuantity) && newQuantity > 0) {
                const cartItem = cart.find(item => item.variationID === variationID);
                if (cartItem) {
                    newQuantity = (newQuantity > cartItem.inStock ? parseInt(cartItem.inStock) : parseInt(newQuantity));
                    cartItem.quantity = newQuantity;

                    const formData = new FormData();
                    formData.append('variationID', variationID);
                    formData.append('quantity', newQuantity);

                    fetch('../utilities/edit_cart.php', {
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

                    updateCartUI();
                }
            } else {
                alert('Please enter a valid quantity.');
            }
        }

        function deleteCartItem(variationID) {
            cart = cart.filter(item => item.variationID !== variationID);

            const formData = new FormData();

            formData.append('variationID', variationID);

            fetch('../utilities/delete_cart.php', {
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

            updateCartUI();
        }

        function updateCartUI() {
            const cartElement = document.querySelector('#cart');
            cartElement.innerHTML = ' ';

            if(cart.length === 0) {
                const p = document.createElement("p");
                p.textContent = 'No items yet...';

                p.classList.add('text-sm', 'text-gray-500');
                cartElement.append(p);
            }

            cart.forEach(item => {
                const cartItemElement = document.createElement('div');
                cartItemElement.classList.add('flex', 'justify-between', 'items-center', 'border-b', 'pb-2', 'mb-2', 'text-xs');
                cartItemElement.innerHTML = `
                    <div class="w-52 overflow-hidden">${item.productName}, ${item.variationName} - Quantity: ${item.quantity}</div>
                    <div>
                        <button class="bg-blue-500 text-white px-2 py-1 rounded mr-2" onclick="editCartItem(${item.variationID})">Edit</button>
                        <button class="bg-red-500 text-white px-2 py-1 rounded" onclick="deleteCartItem(${item.variationID})">Delete</button>
                    </div>
                `;
                cartElement.appendChild(cartItemElement);
            });
        }

        document.addEventListener("DOMContentLoaded", () => {
            updateCartUI();
        });

    </script>
</head>
<body class="bg-gray-100">

<!-- Navbar -->
<?php include_once "../components/navbar.php"; ?>

<div class="container mx-auto p-6 mt-24">
    <div class="flex">
        <div class="w-3/4">
            <h1 class="text-3xl font-bold mb-6">Our Products</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-2 gap-6 product-grid">
                <!-- Product grid PHP loop -->
                <?php if(sizeof($variations) === 0) : ?>
                    <p class="text-gray-500">No Products yet...</p>
                <?php endif; ?>
                <?php foreach ($variations as $variation) {
                    $disabledClass = ($variation['InStock'] == 0) ? 'disabled' : '';

                    echo "
                    <div id='product-{$variation['VariationID']}' class='bg-white p-6 rounded-lg shadow-md product {$disabledClass}'>
                        <h2 class='text-xl font-bold mb-2 product-name overflow-hidden'>{$variation['ProductName']}</h2>
                        <p class='text-gray-700 mb-2 variation-description overflow-hidden'>{$variation['VariationDescription']}</p>
                        <p class='text-gray-700 mb-2 variation-name'>{$variation['VariationName']}, {$variation['MassInOZ']}oz</p>
                        <img src='../assets/products/{$variation['VariationImage']}' alt='{$variation['VariationName']}' id='product-img-{$variation['VariationID']}' class='w-full h-48 object-cover mb-4' onclick='openModal({$variation['VariationID']}, {$variation['InStock']})' style='cursor:pointer;'>
                        <p class='text-gray-700 mb-2 variation-price'>₱{$variation['UnitPrice']}</p>
                        <p class='text-gray-700 mb-2'>In Stock: {$variation['InStock']}</p>
                        <input type='number' value='1' min='1' max='{$variation['InStock']}' class='quantity-input w-16 p-1 border rounded mb-4'>
                        <button class='bg-blue-500 text-white px-4 py-2 rounded' onclick='addToCart({$variation['VariationID']})' {$disabledClass}>Add to Cart</button>
                    </div>
                    ";
                } ?>
            </div>

            <!-- Pagination links -->
            <div class="flex justify-center mt-6">
                <?php if ($page > 1): ?>
                    <a href="product.php?page=<?php echo $page - 1; ?>" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-l">Previous</a>
                <?php endif; ?>
            
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="product.php?page=<?php echo $i; ?>" class="<?php echo ($i == $page) ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700'; ?> px-4 py-2"><?php echo $i; ?></a>
                <?php endfor; ?>
            </div>
        </div>

        <div class="w-1/4 pl-6">
            <h2 class="text-xl font-bold mb-4">Search Products</h2>
            <input type="text" id="search-bar" class="mb-4 p-2 w-full border rounded" placeholder="Search..." onkeyup="filterProducts()">
            
            <h2 class="text-xl font-bold mb-4">Sort By</h2>
            <!-- <button class="bg-blue-500 text-white p-2 rounded mb-2 w-full" onclick="sortProducts('name')">Name</button> -->
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

            <!-- Cart section -->
            <div class="mt-12">
                <h2 class="text-1xl font-bold mb-4">Cart</h2>
                <div id="cart" class="bg-white p-4 rounded-lg shadow-md">

                </div>
                <a href="cart.php" class="bg-green-500 text-white text-xs px-4 py-2 rounded mt-4 inline-block">Go to Cart</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="productModal" class="modal">
    <div class="modal-content">
        <span class="close z-10" onclick="closeModal()">&times;</span>
        <div id="modalContent"></div>
    </div>
</div>

<script>
    function openModal(variationID, inStock) {
        const modal = document.getElementById('productModal');
        const product = document.getElementById(`product-${variationID}`);
        const modalContent = document.getElementById('modalContent');

        // Clone the product node and add to modal content
        const clonedProduct = product.cloneNode(true);
        clonedProduct.classList.remove("disabled");
        clonedProduct.setAttribute("id", `modal_${variationID}`);
        
        for(let i = 0; i < 4; i++) {
            clonedProduct.removeChild(clonedProduct.lastChild);
        }

        const bitInput = document.createElement("input");
        bitInput.type = "number";
        bitInput.value = (inStock == 0) ? 0 : 1;
        bitInput.min = (inStock == 0) ? 0 : 1;
        bitInput.max = inStock;
        bitInput.classList.add("quantity-input", "w-16", "p-1", "border", "rounded", "mb-4");

        const button = document.createElement("button");
        button.textContent = "Add to Cart";
        button.classList.add("bg-blue-500", "text-white", "px-4", "py-2", "rounded");

        if(inStock == 0) {
            bitInput.setAttribute("disabled" , "true");
            button.setAttribute("disabled", "true");
            bitInput.classList.add("opacity-50");
            button.classList.add("opacity-50");
        }

        button.addEventListener("click", () => {
            addToCartBig(variationID);
        });

        clonedProduct.appendChild(bitInput);
        clonedProduct.appendChild(button);

        // // const 

        modalContent.innerHTML = ''; // Clear previous content
        modalContent.appendChild(clonedProduct);

        //"<input type='number' value='1' min='1' max='{$variation['InStock']}' class='quantity-input w-16 p-1 border rounded mb-4'>"
        //"<button class='bg-blue-500 text-white px-4 py-2 rounded' onclick='addToCart({$variation['VariationID']})' {$disabledClass}>Add to Cart</button>"

        modal.style.display = 'block';
    }

    function closeModal() {
        const modal = document.getElementById('productModal');
        modal.style.display = 'none';
    }
</script>


</body>
</html>
