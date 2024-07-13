<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../utilities/include.php";
require "../utilities/var.sql.php";

$session->continueSession();

if(!$session->isSessionValid()) {
    LocationAlert("../pages/home.php", "Please Log in");
}

$CustomerID = $session->ID;

$error = "";
$success = "";

// Fetch address details
$sql = "SELECT AddressID FROM Customers WHERE CustomerID = ?";
$stmt = $db->conn->prepare($sql);
$stmt->bind_param("i", $CustomerID);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$AddressID = $row['AddressID'];

$sql = "SELECT City, Barangay, Street, PostalCode FROM Address WHERE AddressID = ?";
$stmt = $db->conn->prepare($sql);
$stmt->bind_param("i", $AddressID);
$stmt->execute();
$result = $stmt->get_result();
$address = $result->fetch_assoc();

if ($address) {
    $City = $address['City'];
    $Barangay = $address['Barangay'];
    $Street = $address['Street'];
    $PostalCode = $address['PostalCode'];
} else {
    $City = "";
    $Barangay = "";
    $Street = "";
    $PostalCode = "";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newCity = $_POST['City'];
    $newBarangay = $_POST['Barangay'];
    $newStreet = $_POST['Street'];
    $newPostalCode = $_POST['PostalCode'];

    if ($address) {
        $sql = "UPDATE Address SET City = ?, Barangay = ?, Street = ?, PostalCode = ? WHERE AddressID = ?";
        $stmt = $db->conn->prepare($sql);
        $stmt->bind_param("ssssi", $newCity, $newBarangay, $newStreet, $newPostalCode, $AddressID);
    } else {
        $sql = "INSERT INTO Address (City, Barangay, Street, PostalCode) VALUES (?, ?, ?, ?)";
        $stmt = $db->conn->prepare($sql);
        $stmt->bind_param("ssss", $newCity, $newBarangay, $newStreet, $newPostalCode);
    }

    if ($stmt->execute()) {
        $success = "Address details " . ($address ? "updated" : "created") . " successfully.";
        $City = $newCity;
        $Barangay = $newBarangay;
        $Street = $newStreet;
        $PostalCode = $newPostalCode;

        if(!$address) {
            $insert_id = $db->conn->insert_id;

            $sql = "UPDATE Customers SET AddressID = $insert_id WHERE CustomerID = $CustomerID;";
            $db->query($sql);

        }
    } else {
        $error = "Error " . ($address ? "updating" : "creating") . " address details.";
    }
}

// Fetch detailed recent orders with DeliveryStatus
$sql = "SELECT o.OrderID, o.OrderTime, o.OrderStatus, o.PaymentMethod, d.DeliveryStatus
FROM Orders o
LEFT JOIN Deliveries d ON o.OrderID = d.OrderID
WHERE o.CustomerID = ?
ORDER BY o.OrderTime DESC;";

$stmt = $db->conn->prepare($sql);
$stmt->bind_param("i", $CustomerID);
$stmt->execute();
$result = $stmt->get_result();
$recentOrders = [];
while ($row = $result->fetch_assoc()) {
    $recentOrders[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Address</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/user.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/search.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/shopping-cart.css' rel='stylesheet'>
    <link rel="stylesheet" href="../styles/tailwind.css">
    <link rel="stylesheet" href="../styles/svg.css">
    <link rel="stylesheet" href="../styles/admin.css">
    </head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <?php include_once "../components/navbar.php"; ?>
    
    <div class="flex justify-center mt-28">
        <!-- Address Edit Form -->
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md m-4">
            <h1 class="text-2xl font-bold mb-6 text-center">Edit Address</h1>
            
            <?php if ($error): ?>
                <p class="bg-red-100 text-red-700 p-4 rounded mb-6"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <?php if ($success): ?>
                <p class="bg-green-100 text-green-700 p-4 rounded mb-6"><?php echo htmlspecialchars($success); ?></p>
            <?php endif; ?>

            <form method="post" action="">
                <div class="mb-4">
                    <label for="City" class="block text-gray-700 font-bold mb-2">City:</label>
                    <input type="text" id="City" name="City" value="<?php echo htmlspecialchars($City); ?>" required class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div class="mb-4">
                    <label for="Barangay" class="block text-gray-700 font-bold mb-2">Barangay:</label>
                    <input type="text" id="Barangay" name="Barangay" value="<?php echo htmlspecialchars($Barangay); ?>" required class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div class="mb-4">
                    <label for="Street" class="block text-gray-700 font-bold mb-2">Street:</label>
                    <input type="text" id="Street" name="Street" value="<?php echo htmlspecialchars($Street); ?>" required class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="PostalCode" class="block text-gray-700 font-bold mb-2">Postal Code:</label>
                    <input type="text" id="PostalCode" name="PostalCode" value="<?php echo htmlspecialchars($PostalCode); ?>" required class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div class="flex items-center justify-between">
                    <input type="submit" value="Update Address" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </form>
        </div>
        
        <!-- Recent Orders Section -->
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md m-4">
            <h1 class="text-2xl font-bold mb-6 text-center">Recent Orders</h1>

            <!-- Search Input -->
            <input type="text" id="orderSearch" placeholder="Search orders..." class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4">

            <div class="overflow-y-auto max-h-96">
                <?php foreach ($recentOrders as $order): ?>
                    <?php
                        $status = "NULL";
                        $status_color = "text-blue-500";
                        switch($order['OrderStatus']) {
                            case 'Failed':
                                $status = "Order rejected"; 
                                $status_color = "text-red-500"; break;
                            case 'Pending':
                                $status = "Order is up for approval"; break;
                            case 'Success':
                                switch($order['DeliveryStatus']) {
                                    case 'Failed':
                                        $status = "Delivery has FAILED"; 
                                        $status_color = "text-red-500"; break;
                                    case 'Pending':
                                        $status = "Delivery on its way"; break;
                                    case 'Success':
                                        $status = "Delivery has ARRIVED"; 
                                        $status_color = "text-green-500"; break;
                                    default:
                                        $status = "Order APPROVED"; 
                                }
                        }

                    $OrderID = $order['OrderID'];
                    $result;

                    $c = $select->selectCustomerData($CustomerID);
                    $c_result = $c->fetch_assoc();

                    $cd_result = $select->selectOrderedProducts($OrderID);
                    ?>

                    <div id="dialog_<?= $OrderID ?>" class="dialog hidden z-10">
                        <div class="inner_dialog">
                            <span id="close_dialog_<?= $order['OrderID'] ?>" class="close--svg size-8 bg-red-500 absolute top-3 right-3 hover:cursor-pointer hover:bg-red-800 transition-colors"></span>
                            <h1 class="font-bold underline text-xl">Order #<?= $order['OrderID']?></h1>
                            <div>
                                <h1>Customer Information</h1>
                                <hr class="mb-1">
                                <div class="flex justify-between">
                                    <p class="text-gray-500">Customer Name: </p>
                                    <p class="text-gray-500"><?= $c_result['LastName'] . ', ' . $c_result['FirstName'] ?></p>
                                </div>
                                <div class="flex justify-between">
                                    <p class="text-gray-500">Address: </p>
                                    <p class="text-gray-500"><?= $c_result['FullAddress'] ?></p>
                                </div>
                                <div class="flex justify-between">
                                    <p class="text-gray-500">Contact Number: </p>
                                    <p class="text-gray-500"><?= $c_result['PhoneNum'] ?></p>
                                </div>
                                <div class="flex justify-between">
                                    <p class="text-gray-500">Email:</p>
                                    <p class="text-gray-500"><?= $c_result['Email'] ?></p>
                                </div>
                            </div>
                            
                            <div>
                                <h1>Products Information</h1>
                                <hr class="mb-1">
                                        
                                <?php 
                                $total_price = 0;

                                while($cd_row = $cd_result->fetch_assoc()): 
                                    $sale = $cd_row['OrderedPrice'] * $cd_row['OrderedQuantity'];
                                    $total_price += $sale;
                                ?>
                                    <div class="flex justify-between">
                                        <p class=<?= $cd_row['VariationID'] ? "text-gray-500" : "text-red-500" ?> ><?= ($cd_row['VariationID'] ? $cd_row['ProductName'] . ', '  . $cd_row['VariationName'] : '**DELETED PRODUCT**')   ?> @Php<?= $cd_row['OrderedPrice'] ?> x <?= $cd_row['OrderedQuantity'] ?>pc/s</p>
                                        <p class="text-gray-500">Php <?= number_format($sale, 2) ?></p>
                                    </div>
                                <?php endwhile; ?>

                                <hr class="mb-1">
                                <div class="flex justify-between">
                                    <p class="text-gray-800">Total: </p>
                                    <p class="text-gray-800">Php <?= number_format($total_price, 2) ?></p>
                                </div>
                            </div>
                            <div>
                                <h1>Order Information</h1>
                                <hr>

                                <div class="flex justify-between">
                                    <p class="text-gray-500">Status:</p>
                                    <p class="font-bold <?= $status_color ?>" ><?= strtoupper($status) ?></p>
                                </div>

                                <div class="flex justify-between">
                                        <p class="text-gray-500">Payment Method: </p>
                                        <p class="text-gray-500"><?= $order['PaymentMethod'] ?></p>
                                </div>

                                <div class="flex justify-between">
                                        <p class="text-gray-500">Order Time: </p>
                                        <p class="text-gray-500"><?= $order['OrderTime'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="order_<?= $OrderID ?>" class="mb-4 border rounded p-4 order-item flex items-center justify-between">
                        <div>
                            <p class="text-lg font-bold">Order ID: <?= $order['OrderID']; ?></p>
                            <p>Total Price: ₱<?= number_format($total_price, 2) ?></p>
                            <div class="flex gap-1"><p>Status: </p><p class="font-bold <?= $status_color ?>"><?= strtoupper($status) ?></p></div>
                            <p>Order Time: <?php echo $order['OrderTime']; ?></p>
                        </div>
                        <button onclick="openDialog('<?= $OrderID ?>')" class="flex justify-center items-center rounded-full bg-black text-white size-10"><span class="details--svg size-7 bg-white"></span></button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script>
    // JavaScript for search functionality
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('orderSearch');
        const orderItems = document.querySelectorAll('.order-item');

        searchInput.addEventListener('input', function (e) {
            const searchQuery = e.target.value.toLowerCase().trim();

            orderItems.forEach(function (item) {
                const productName = item.querySelector('p.text-lg').textContent.toLowerCase();
                const deliveryStatus = item.querySelector('p:nth-child(4)').textContent.toLowerCase();

                if (productName.includes(searchQuery) || deliveryStatus.includes(searchQuery)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    function openDialog(ID) {
        const dialogName = `dialog_${ID}`;
        const closeName = `close_dialog_${ID}`;
        const dialog = document.getElementById(dialogName);

        dialog.classList.remove("hidden");

        document.getElementById(closeName).addEventListener("click", () => {
            dialog.classList.add("hidden");
        });
    }
</script>

</body>
</html>
