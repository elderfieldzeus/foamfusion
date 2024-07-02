<?php
    function AdminNavbar ($page) {
            global $select, $session;

            echo '
                <nav id="admin_nav" class="fixed left-0 w-52 h-screen bg-gray-800 flex flex-col items-start py-5 gap-5 transition-all">
                    <div id="dashboard__icon" class="dashboard--div mb-8">
                        <span class="dashboard--svg dashboard--icon"></span>
                        <p class="dashboard--header">Dashboard</p>
                    </div>

                    <a href="./admin.home.php" id="home_dashboard" class="dashboard--div hovered--div ' . ($page == "Home" ? "active--icon": "") . '">
                        <span class="home--svg dashboard--icon"></span>
                        <p class="dashboard--header">Home</p>
                    </a>

                    <a href="./admin.product.php" id="product_dashboard" class="dashboard--div hovered--div ' . ($page == "Product" ? "active--icon": "") . '">
                        <span class="product--svg dashboard--icon"></span>
                        <p class="dashboard--header">Products</p>
                    </a>

                    <a href="./admin.order.php" id="order_dashboard" class="dashboard--div hovered--div ' . ($page == "Order" ? "active--icon": "") . '">
                        <span class="order--svg dashboard--icon"></span>
                        <p class="dashboard--header">Orders</p>
                    </a>

                    <a href="./admin.delivery.php" id="delivery_dashboard" class="dashboard--div hovered--div ' . ($page == "Delivery" ? "active--icon": "") . '">
                        <span class="delivery--svg dashboard--icon"></span>
                        <p class="dashboard--header">Deliveries</p>
                    </a>

                    <a href="./admin.customer.php" id="customer_dashboard" class="dashboard--div hovered--div ' . ($page == "Customer" ? "active--icon": "") . '">
                        <span class="customer--svg dashboard--icon"></span>
                        <p class="dashboard--header">Customers</p>
                    </a>

                    <a href="./admin.settings.php" id="settings_dashboard" class="dashboard--div hovered--div ' . ($page == "Settings" ? "active--icon": "") . '">
                        <span class="settings--svg dashboard--icon"></span>
                        <p class="dashboard--header">Settings</p>
                    </a>

                    <div id="account_dashboard" class="hover:cursor-pointer flex gap-4 absolute bottom-0 p-4 w-full bg-gray-700 overflow-ellipsis">
                        <span class="admin--svg dashboard--icon"></span>
                        <p class="dashboard--header">';

        $result = $select->selectEmployeeData($session->ID);
        $row = $result->fetch_assoc();

        if($row != NULL) {
            echo $row["FirstName"] . "&nbsp" . $row["LastName"];
        }
        else {
            echo "NULL";
        }
        
        echo'
                            </p>
                    </div>
                </nav>
            ';
        }

?>

