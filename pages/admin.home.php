<?php

    require_once "../utilities/include.php";
    require_once "../utilities/var.sql.php";

    if(!$auth->login("elderfieldzeus24@gmail.com", "123", "Admin")) {
        alert("Logged In Failed");
    }

    // $auth->login("henry.harris@example.com", "123", "Admin");
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

        include_once "../components/admin.navbar.php";

        AdminNavBar("Home");

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

                <a href="./admin.delivery.php" class="home-card">
                    <div>
                        <p class="text-4xl ">Sales</p>
                        <p class="text-xl text-gray-400 w-20">
                            <?php
                                $result = $select->selectTotalSales();
                                $row = $result->fetch_assoc();
                                echo 'Php&nbsp' . (($sales = $row['TotalSales']) ? $sales : '0.00');
                            ?>
                        </p>
                    </div>
                    <canvas id="SalesStatus"></canvas>
                </a>
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

        $sales_result = $select->selectSalesStatus();
        $admin->displayChart($sales_result, "SalesStatus", "TotalSales");
    ?>
</body>
    
</html>