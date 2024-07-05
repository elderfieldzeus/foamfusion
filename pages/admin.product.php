<?php

    require_once "../utilities/include.php";
    require_once "../utilities/var.sql.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoamFusion - Admin</title>
    <link rel="stylesheet" href="../styles/tailwind.css">
    <link rel="stylesheet" href="../styles/svg.css">
    <link rel="stylesheet" href="../styles/admin.css">
</head>
<body>
    <?php

        $admin->displayNavbar("Product");

    ?>


    <main class="pl-52 w-full min-h-full">
        <header class="w-full h-20 bg-gray-900">

        </header>
        <div class="py-8 px-12">
            <h1 class="text-4xl">Products</h1>
            <hr class="my-5">

            <div class="grid grid-cols-[repeat(auto-fill,_13rem)] gap-10 hey">
                <button onclick="openAddDialog()" class="product-card items-center justify-center">
                    <span class="product--svg size-20 bg-gray-400"></span>
                    <h2 class="product-card--text text-gray-400">Add a Product</h2>
                </button>

                <div id="add_dialog" class="dialog hidden">
                    <div class="inner_dialog">
                        <span id="close_add_dialog" class="close--svg size-8 bg-red-500 absolute top-3 right-3 hover:cursor-pointer hover:bg-red-800 transition-colors"></span>

                        <form method="POST" action="../utilities/addproduct.php" enctype="multipart/form-data" class="w-full px-8 py-4">
                            <div class="flex flex-col items-center justify-center mb-5">
                                <p class="font-semibold text-gray-900 text-xl">Product Form</p>
                            </div>
                            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                <div class="sm:col-span-2">
                                    <label for="product_name" class="block mb-2 text-sm font-medium text-gray-900">Product Name</label>
                                    <input type="text" name="product_name" id="product_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="e.g. Soap" required="">
                                </div>
                                <div class="w-full">
                                    <label for="product_variation" class="block mb-2 text-sm font-medium text-gray-900">Product Variation</label>
                                    <input type="text" name="product_variation" id="product_variation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="e.g. Baby Blue" required="">
                                </div>
                                <div class="w-full">
                                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Price (Philippine Peso)</label>
                                    <input type="number" name="price" min="0" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="e.g. 299.00" required="">
                                </div>
                                <div>
                                    <label for="product_mass" class="block mb-2 text-sm font-medium text-gray-900">Product Mass (oz)</label>
                                    <input type="number" name="product_mass" min="0" id="product_mass" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="e.g. 2.5" required="">
                                </div> 
                                <div>
                                    <label for="in_stock" class="block mb-2 text-sm font-medium text-gray-900">In Stock</label>
                                    <input type="number" name="in_stock" min="0" id="in_stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="e.g. 10" required="">
                                </div> 
                                <div class="sm:col-span-2">
                                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                                    <textarea id="description" name="description" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500" placeholder="Your description here"></textarea>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="image" class="block mb-2 text-sm font-medium text-gray-900">Product Image</label>
                                    <input type="file" name="image" id="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Product Image" required="">
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-800">
                                    Add product
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <?php
                    
                    $admin->displayAdminProducts();
    
                ?>
            </div>
        </div>
    </main>
    <script>
        function openDialog(ID) {
            const dialogName = `product_dialog_${ID}`;
            const closeName = `close_dialog_${ID}`;
            const dialog = document.getElementById(dialogName);

            dialog.classList.remove("hidden");

            document.getElementById(closeName).addEventListener("click", () => {
                dialog.classList.add("hidden");
            });
        }

        function openAddDialog() {
            const dialog = document.getElementById("add_dialog");
            const close = document.getElementById("close_add_dialog");
            dialog.classList.remove("hidden");

            close.addEventListener("click", () => {
                dialog.classList.add("hidden");
            });

        }
    </script>
</body>
</html>