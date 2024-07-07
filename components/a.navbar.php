<nav id="admin_nav" class="fixed left-0 w-52 h-screen bg-gray-800 flex flex-col items-start py-5 gap-5 transition-all">
    <div id="dashboard__icon" class="dashboard--div mb-8">
        <span class="dashboard--svg dashboard--icon"></span>
        <p class="dashboard--header">Dashboard</p>
    </div>

    <a href="./admin.home.php" id="home_dashboard" class="dashboard--div hovered--div <?= ($page == "Home" ? "active--icon": "") ?>">
        <span class="home--svg dashboard--icon"></span>
        <p class="dashboard--header">Home</p>
    </a>

    <a href="./admin.product.php" id="product_dashboard" class="dashboard--div hovered--div <?= ($page == "Product" ? "active--icon": "") ?>">
        <span class="product--svg dashboard--icon"></span>
        <p class="dashboard--header">Products</p>
    </a>

    <a href="./admin.order.php" id="order_dashboard" class="dashboard--div hovered--div <?= ($page == "Order" ? "active--icon": "") ?>">
        <span class="order--svg dashboard--icon"></span>
        <p class="dashboard--header">Orders</p>
    </a>

    <a href="./admin.delivery.php" id="delivery_dashboard" class="dashboard--div hovered--div <?= ($page == "Delivery" ? "active--icon": "") ?>">
        <span class="delivery--svg dashboard--icon"></span>
        <p class="dashboard--header">Deliveries</p>
    </a>

    <a href="./admin.customer.php" id="customer_dashboard" class="dashboard--div hovered--div <?= ($page == "Customer" ? "active--icon": "") ?>">
        <span class="customer--svg dashboard--icon"></span>
        <p class="dashboard--header">Customers</p>
    </a>

    <a href="./admin.employee.php" id="settings_dashboard" class="dashboard--div hovered--div <?= ($page == "Employee" ? "active--icon": "") ?>">
        <span class="employee--svg dashboard--icon"></span>
        <p class="dashboard--header">Employees</p>
    </a>

    <button onclick="openSignout()" id="account_dashboard" class="hover:cursor-pointer flex gap-4 absolute bottom-0 p-4 w-full bg-gray-700 overflow-hidden">
        <span class="admin--svg dashboard--icon"></span>
        <p class="dashboard--header whitespace-nowrap overflow-ellipsis">
    <?php
                        
            $this->session->continueSession();
            $result = $this->select->selectEmployeeData($this->session->ID);
            $row = $result->fetch_assoc();

            if($row != NULL) {
                echo $row["FirstName"] . " " . $row["LastName"];
            }
            else {
                echo "NULL";
                $this->session->endSession();
                Location("../pages/home.php");
            }

    ?>

        </button>
    </div>
</nav>

<div id="dialog_signout" class="dialog hidden">
    <div class="top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 fixed bg-white w-64 h-32 rounded-md flex flex-col items-center justify-center">
        <p class="text-xl">Want to sign out?</p>
        <div class="buttons w-full grid grid-cols-2 gap-2 px-4 pt-4">
            <button class="bg-red-500 hover:bg-red-800 transition-colors text-white text-center rounded-md" id="close_signout">No</button>
            <a class="bg-green-500 hover:bg-green-800 transition-colors text-white text-center rounded-md" href="../utilities/signout.php">Yes</a>
        </div>
    </div>
</div>

<script defer>
    function openSignout() {
        const dialog = document.getElementById("dialog_signout");
        const no = document.getElementById("close_signout");

        dialog.classList.remove("hidden");
        no.addEventListener("click", () => {
            dialog.classList.add("hidden");
        });

    }
</script>