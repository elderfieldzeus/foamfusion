<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $variationID = $_POST['variationID'];
    $quantity = $_POST['quantity'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $cart = $_SESSION['cart'];

    $found = false;
    foreach ($cart as &$item) {
        if ($item['variationID'] == $variationID) {
            $item['quantity'] += $quantity;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $cart[] = [
            'variationID' => $variationID,
            'quantity' => $quantity
        ];
    }

    $_SESSION['cart'] = $cart;

    echo "Item added to cart successfully.";
}
?>
