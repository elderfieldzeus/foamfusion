<?php
require_once "../utilities/include.php";
require_once "../utilities/var.sql.php";

$session->continueSession();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $variationID = $_POST['variationID'];
    $quantity = $_POST['quantity'];

    // Validate and sanitize input (e.g., check if variationID exists, validate quantity)

    // Example validation: Ensure variationID is a number and quantity is a positive integer
    if (!is_numeric($variationID) || $variationID <= 0 || !ctype_digit($quantity) || $quantity <= 0) {
        die("Invalid input.");
    }

    // Perform SQL operations to add to cart (Example: Insert into Cart table or session handling)
    // Example: Assuming $db is your database connection object
    // Example SQL (replace with your actual schema):
    // $sql = "INSERT INTO Cart (UserID, VariationID, Quantity) VALUES (?, ?, ?)";
    // $stmt = $db->prepare($sql);
    // $stmt->bind_param("iii", $userID, $variationID, $quantity);
    // $stmt->execute();

    // Example response
    echo "Added to cart successfully.";
} else {
    die("Invalid request.");
}
?>
