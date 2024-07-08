<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "foamfusion_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

$cartItems = [];
foreach ($cart as $cartItem) {
    $variationID = $cartItem['variationID'];
    $quantity = $cartItem['quantity'];

    $sql = "SELECT VariationName, UnitPrice FROM Variations WHERE VariationID = $variationID";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $cartItems[] = [
            'VariationID' => $variationID,
            'VariationName' => $row['VariationName'],
            'UnitPrice' => $row['UnitPrice'],
            'Quantity' => $quantity
        ];
    }
}
$conn->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['edit'])) {
        $variationID = $_POST['variationID'];
        $newQuantity = $_POST['quantity'];
        foreach ($cart as &$item) {
            if ($item['variationID'] == $variationID) {
                $item['quantity'] = $newQuantity;
                break;
            }
        }
        $_SESSION['cart'] = $cart;
        header("Location: cart.php");
        exit();
    } elseif (isset($_POST['delete'])) {
        $variationID = $_POST['variationID'];
        $cart = array_filter($cart, function($item) use ($variationID) {
            return $item['variationID'] != $variationID;
        });
        $_SESSION['cart'] = $cart;
        header("Location: cart.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
    <link href="../styles/tailwind.css" rel="stylesheet">
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/user.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/search.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/shopping-cart.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<!--navbar--> 
<?php include_once "../components/navbar.php"; ?>

<div class="container mx-auto p-6 flex mt-24">
    <div class="w-full">
        <h1 class="text-3xl font-bold mb-6">Cart</h1>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <?php
            if (empty($cartItems)) {
                echo "<p>Your cart is empty.</p>";
                echo "<a href='product.php' class='bg-blue-500 text-white px-4 py-2 rounded mt-4 inline-block'>Back to Shopping</a>";
            } else {
                echo "<table class='w-full text-left'>";
                echo "<thead><tr><th>Product</th><th>Unit Price</th><th>Quantity</th><th>Total</th><th>Actions</th></tr></thead>";
                echo "<tbody>";
                $totalPrice = 0;
                foreach ($cartItems as $item) {
                    $total = $item['UnitPrice'] * $item['Quantity'];
                    $totalPrice += $total;
                    echo "<tr>";
                    echo "<td>{$item['VariationName']}</td>";
                    echo "<td>₱{$item['UnitPrice']}</td>";
                    echo "<td>{$item['Quantity']}</td>";
                    echo "<td>₱{$total}</td>";
                    echo "<td>
                            <form method='POST' class='inline-block'>
                                <input type='hidden' name='variationID' value='{$item['VariationID']}'>
                                <input type='number' name='quantity' value='{$item['Quantity']}' min='1' class='p-1 border rounded'>
                                <button type='submit' name='edit' class='bg-blue-500 text-white px-2 py-1 rounded'>Edit</button>
                            </form>
                            <form method='POST' class='inline-block'>
                                <input type='hidden' name='variationID' value='{$item['VariationID']}'>
                                <button type='submit' name='delete' class='bg-red-500 text-white px-2 py-1 rounded'>Delete</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                echo "<p class='mt-4 text-xl font-bold'>Total Price: ₱{$totalPrice}</p>";
                echo "<a href='checkout.php' class='bg-green-500 text-white px-4 py-2 rounded mt-4 inline-block'>Proceed to Checkout</a>";
            }
            ?>
        </div>
    </div>
</div>

</body>
</html>
