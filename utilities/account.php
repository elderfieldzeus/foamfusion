<?php
require "../utilities/include.php";
require "../utilities/var.sql.php";

$session->continueSession();

$AccountID = $session->ID;
$error = "";
$success = "";

$sql = "SELECT City, Barangay, Street, PostalCode FROM Address WHERE AddressID = ?";
$stmt = $db->conn->prepare($sql);
$stmt->bind_param("i", $AccountID);
$stmt->execute();
$result = $stmt->get_result();
$address = $result->fetch_assoc();

$City = $address['City'];
$Barangay = $address['Barangay'];
$Street = $address['Street'];
$PostalCode = $address['PostalCode'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newCity = $_POST['City'];
    $newBarangay = $_POST['Barangay'];
    $newStreet = $_POST['Street'];
    $newPostalCode = $_POST['PostalCode'];

    $sql = "UPDATE Address SET City = ?, Barangay = ?, Street = ?, PostalCode = ? WHERE AddressID = ?";
    $stmt = $db->conn->prepare($sql);
    $stmt->bind_param("sssii", $newCity, $newBarangay, $newStreet, $newPostalCode, $AccountID);

    if ($stmt->execute()) {
        $success = "Address details updated successfully.";
        $City = $newCity;
        $Barangay = $newBarangay;
        $Street = $newStreet;
        $PostalCode = $newPostalCode;
    } else {
        $error = "Error updating address details.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Address</title>
    <link href="../styles/tailwind.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/user.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/shopping-cart.css' rel='stylesheet'>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <!-- Navbar -->
    <?php include_once "../components/navbar.php"; ?>
    
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
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
</body>
</html>
