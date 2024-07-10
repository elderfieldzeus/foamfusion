<?php

require_once "../utilities/include.php";
require_once "../utilities/var.sql.php";
require_once "../functions/cart.functions.php";

$session->continueSession();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $variationID = $_POST['variationID'];

    // Validate and sanitize input (e.g., check if variationID exists, validate quantity)

    // Example validation: Ensure variationID is a number and quantity is a positive integer
    if (!is_numeric($variationID) || $variationID <= 0 ) {
        die("Invalid input.");
    }

    $isFound = false;
    $n;

    if(isset($_SESSION['cart'])) {
       

        foreach($_SESSION['cart'] as $index => $cart) {
            if($cart->variation_id == $variationID) {
                $isFound = true;

                unset($_SESSION['cart'][$index]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);

                break;
            }
        }

    }
    
    if(!$isFound) {
        die("Invalid request.");
    }

    echo $_SESSION['cart'][0]->quantity;
} else {
    die("Invalid request.");
}
?>
