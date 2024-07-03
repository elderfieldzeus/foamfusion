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
</head>
<body>
    <?php

        include_once "../components/admin.navbar.php";
        AdminNavBar("Order");

    ?>

    <main class="pl-52 w-full min-h-full">
        <header class="w-full h-20 bg-gray-900">

        </header>
        <div class="py-8 px-12">
            <h1 class="text-4xl">Orders</h1>
            <hr class="my-5">

            <div class="flex flex-col">
                <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full">
                                <thead class="bg-gray-800 text-white border-b">
                                    <tr>
                                        <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                                            ID
                                        </th>
                                        <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                                            Order Status
                                        </th>
                                        <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                                            Customer Name
                                        </th>
                                        <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                                            Order Time
                                        </th>
                                        <th scope="col" class="text-sm font-medium pl-6 py-4 text-left">
                                            Order Details
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $admin->displayAdminOrders();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>