<?php

    require_once "../utilities/include.php";
    require_once "../utilities/var.sql.php";

    $insert->insertVariation("Soap", "Green soap", "It is a green soap", "liquidsoap.avif", 12, 10.0, 1);

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
                <a href="./admin.product.php" class="product-card items-center justify-center">
                    <span class="product--svg size-20 bg-gray-400"></span>
                    <h2 class="product-card--text text-gray-400">Add a Product</h2>
                </a>
                <?php
                    
                    $admin->displayAdminProducts();

                ?>
            </div>

        </div>
    </main>
</body>
</html>