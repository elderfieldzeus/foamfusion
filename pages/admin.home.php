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

        $admin->displayNavbar("Home");

    ?>

    <main class="pl-52 w-full min-h-full">
        <header class="w-full h-20 bg-gray-900">

        </header>
        <div class="py-8 px-12">
            <h1 class="text-4xl">Home</h1>
            <hr class="my-5">

            <div class="grid grid-cols-[repeat(auto-fit,_22rem)] gap-10">
                <a href="./admin.product.php" class="home-card">
                    <div>
                        <p class="text-4xl ">Products</p>
                        <p class="text-xl text-gray-400">
                            <?php
                                $result = $select->selectProductCount();
                                $row = $result->fetch_assoc();
                                echo $row['NumOfVariations'] . ($row['NumOfVariations'] == 1 ? " Variation" :" Variations");
                            ?>
                        </p>
                    </div>
                    <canvas id="ProductName"></canvas>
                </a>

                <a href="./admin.order.php" class="home-card">
                    <div>
                        <p class="text-4xl ">Orders</p>
                        <p class="text-xl text-gray-400">
                            <?php
                                $result = $select->selectOrderCount();
                                $row = $result->fetch_assoc();
                                echo $row['NumOfOrders'] . ($row['NumOfOrders'] == 1 ? " Order" :" Orders");
                            ?>
                        </p>
                    </div>
                    <canvas id="OrderStatus"></canvas>
                </a>

                <a href="./admin.delivery.php" class="home-card">
                    <div>
                        <p class="text-4xl ">Deliveries</p>
                        <p class="text-xl text-gray-400">
                            <?php
                                $result = $select->selectDeliveryCount();
                                $row = $result->fetch_assoc();
                                echo $row['NumOfDeliveries'] . ($row['NumOfDeliveries'] == 1 ? " Delivery" :" Deliveries");
                            ?>
                        </p>
                    </div>
                    <canvas id="DeliveryStatus"></canvas>
                </a>

                <?php 
                    $session->continueSession();
                    if ($session->isSessionValid() && $session->Role === 'Admin') :
                ?> 

                    <a href="./admin.customer.php" class="home-card">
                        <div>
                            <p class="text-4xl ">Customers</p>
                            <p class="text-xl text-gray-400">
                                <?php
                                    $result = $select->selectCustomerCount();
                                    $row = $result->fetch_assoc();
                                    echo $row['NumOfCustomers'] . ($row['NumOfCustomers'] == 1 ? " Customer" :" Customers");
                                ?>
                            </p>
                        </div>
                        <canvas id="CustomerStatus"></canvas>
                    </a>

                    <a href="./admin.employee.php" class="home-card">
                        <div>
                            <p class="text-4xl ">Employees</p>
                            <p class="text-xl text-gray-400">
                                <?php
                                    $result = $select->selectEmployeeCount();
                                    $row = $result->fetch_assoc();
                                    echo $row['NumOfEmployees'] . ($row['NumOfEmployees'] == 1 ? " Employee" :" Employees");
                                ?>
                            </p>
                        </div>
                        <canvas id="EmployeeStatus"></canvas>
                    </a>

                    <button onclick="openSales()" class="home-card">
                        <div>
                            <p class="text-4xl ">Sales</p>
                            <p class="text-xl text-gray-400 w-20">
                                <?php
                                    $result = $select->selectTotalSales();
                                    $_row = $result->fetch_assoc();
                                    echo 'Php&nbsp' . (($sales = $_row['TotalSales']) ? number_format($sales, 2) : '0.00');
                                ?>
                            </p>
                        </div>
                        <canvas id="SalesStatus"></canvas>
                    </button>

                    <div id="sales_dialog" class="dialog hidden">
                        <div class="inner_dialog">
                            <span id="close_dialog" class="close--svg size-8 bg-red-500 absolute top-3 right-3 hover:cursor-pointer hover:bg-red-800 transition-colors"></span>

                            <h1 class="text-2xl">Sales Data</h1>

                            <hr>

                            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <table class="min-w-full" id="delivery-table">
                                        <thead class="bg-gray-800 text-white border-b">
                                            <tr>
                                                <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                                                    Variation ID
                                                </th>
                                                <th scope="col" class="sortable-header text-sm font-medium px-6 py-4 text-left" onclick="sortTable(2)">
                                                    Product Name
                                                </th>
                                                <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                                                    Variation
                                                </th>
                                                <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                                                    Units Sold
                                                </th>
                                                <th scope="col" class="text-sm font-medium pl-6 py-4 text-left">
                                                    Gross Earnings
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $admin->displayTotalSales();
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                <?php endif; ?>
            </div>          
        </div>
        
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?php
        $prod_result = $select->selectProductsSorted();
        $admin->displayChart($prod_result, "ProductName", "NumOfVariations");

        $order_result = $select->selectOrderStatus();
        $admin->displayChart($order_result, "OrderStatus", "NumOfOrders");

        $delivery_result = $select->selectDeliveryStatus();
        $admin->displayChart($delivery_result, "DeliveryStatus", "NumOfDeliveries");

        $customer_result = $select->selectCustomerStatus();
        $admin->displayChart($customer_result, "CustomerStatus", "NumOfCustomers");

        $employee_result = $select->selectEmployeeStatus();
        $admin->displayChart($employee_result, "EmployeeStatus", "NumOfEmployees");

        $sales_result = $select->selectSalesStatus();
        $admin->displayChart($sales_result, "SalesStatus", "TotalSales");

        
    ?>

    <script>
        function openSales() {
            const dialogName = `sales_dialog`;
            const closeName = `close_dialog`;
            const dialog = document.getElementById(dialogName);

            dialog.classList.remove("hidden");

            document.getElementById(closeName).addEventListener("click", () => {
                dialog.classList.add("hidden");
            });
        }
    </script>
</body>
    
</html>