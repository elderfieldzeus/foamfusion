<?php

require_once "../utilities/include.php";
require_once "../utilities/var.sql.php";
require_once "../functions/cart.functions.php";

$session->continueSession();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $variationID = $_POST['variationID'];
    $quantity = $_POST['quantity'];

    // Validate and sanitize input (e.g., check if variationID exists, validate quantity)

    // Example validation: Ensure variationID is a number and quantity is a positive integer
    if (!is_numeric($variationID) || $variationID <= 0 || !ctype_digit($quantity) || $quantity <= 0) {
        die("Invalid input.");
    }

    $isFound = false;

    if(isset($_SESSION['cart'])) {
       

        foreach($_SESSION['cart'] as $cart) {
            if($cart->variation_id == $variationID) {
                $isFound = true;

                $cart->updateQuantity($quantity);

                break;
            }
        }

    }
    else {
        $_SESSION['cart'] = [];
    }

    if(!$isFound) {
        $temp = new Cart($variationID, $select);

        $temp->updateQuantity($quantity);

        array_push($_SESSION['cart'], $temp);
    }

    echo $_SESSION['cart'][0]->quantity;
} else {
    die("Invalid request.");
}
?>
