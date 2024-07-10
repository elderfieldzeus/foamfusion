<?php

    include_once "../utilities/include.php";
    include_once "../utilities/var.sql.php";
    include_once "../functions/cart.functions.php";

    $session->continueSession();

    if(
        isset($_SESSION['cart']) 
        && isset($_POST['payment_method'])
        && $session->isSessionValid()
    ) {
        $success = true;
        $CustomerID = $session->ID;
        $PaymentMethod = $_POST['payment_method'];

        $insert->insertOrder($CustomerID, $PaymentMethod);

        $OrderID = $insert->insert_id;

        foreach($_SESSION['cart'] as $cart) {
            $VariationID = $cart->variation_id;
            $OrderedQuantity = $cart->quantity;

            $result = $select->selectVariationData($VariationID);
            $row = $result->fetch_assoc();

            $InStock = $row['InStock'];

            $OrderedPrice = $row['UnitPrice'];
            
            if($OrderedQuantity <= $InStock) {
                $insert->insertOrderedProducts($OrderedQuantity, $OrderedPrice, $OrderID, $VariationID);

                //minus
                $update->minusStock($VariationID, $OrderedQuantity);
            }
            else {
                LocationAlert("../pages/home.php", "Invalid Ordered Quantity");
                $success = false;
            }
                
        }

        $_SESSION['cart'] = [];

        if($success) {
            LocationAlert("../pages/home.php", "Order is successful");
        }
    }
    else {
        Location("../pages/home.php"); 
    }

       

?>