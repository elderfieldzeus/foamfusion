<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../utilities/include.php";
require "../utilities/var.sql.php";

$session->continueSession();

$CustomerID = $session->ID;

$error = "";
$success = "";

// Fetch address details
$sql = "SELECT AddressID FROM Customers WHERE CustomerID = $CustomerID";
$result = $db->conn->query($sql);
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
        $stmt->execute();
        $AddressID = $stmt->insert_id;

        $sql = "UPDATE Customer SET AddressID = $AddressID WHERE CustomerID = $CustomerID";
        $db->conn->query($sql);
    }

    if ($stmt->execute()) {
        $success = "Address details " . ($address ? "updated" : "created") . " successfully.";
        $City = $newCity;
        $Barangay = $newBarangay;
        $Street = $newStreet;
        $PostalCode = $newPostalCode;
    } else {
        $error = "Error " . ($address ? "updating" : "creating") . " address details.";
    }
    header("Location: ../pages/account.php");
    exit();
}

// Fetch detailed recent orders
$sql = "SELECT o.OrderID, o.OrderTime, o.OrderStatus, op.OrderedQuantity, op.OrderedPrice, p.ProductName 
        FROM Orders o
        JOIN OrderedProducts op ON o.OrderID = op.OrderID
        JOIN Variations v ON op.VariationID = v.VariationID
        JOIN Products p ON v.ProductID = p.ProductID
        WHERE o.CustomerID = ?
        ORDER BY o.OrderTime DESC
        LIMIT 5";
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
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/shopping-cart.css' rel='stylesheet'>
    <link href="../styles/tailwind.css" rel="stylesheet">
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
                    <div class="mb-4 border rounded p-4 order-item">
                        <p class="text-lg font-bold"><?php echo $order['ProductName']; ?></p>
                        <p>Quantity: <?php echo $order['OrderedQuantity']; ?></p>
                        <p>Total Price: <?php echo $order['OrderedPrice'] * $order['OrderedQuantity']; ?></p>
                        <p>Status: <?php echo $order['OrderStatus']; ?></p>
                        <p>Order Time: <?php echo $order['OrderTime']; ?></p>
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
                const orderStatus = item.querySelector('p:nth-child(4)').textContent.toLowerCase();

                if (productName.includes(searchQuery) || orderStatus.includes(searchQuery)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
</script>

</body>
</html>
