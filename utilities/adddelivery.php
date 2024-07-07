<?php

    include_once "../utilities/include.php";
    include_once "../utilities/var.sql.php";

    $session->continueSession();

    if(
        isset($_GET['orderid'])
        && isset($_GET['employeeid'])
        && $session->isSessionValid()
    ) {
        $EmployeeID = $_GET['employeeid'];
        $OrderID = $_GET['orderid'];

        //delete all deliveries with failed status that shares orderid
        $delete->deleteDeliveryOrder($OrderID);

        //insert new delivery
        $insert->insertDelivery($EmployeeID, $OrderID);
        $DeliveryID  = $insert->insert_id;

        //insert products to ordered products
        $result = $select->selectOrderedProducts($OrderID);

        while($row = $result->fetch_assoc()) {
            $DeliveredQuantity = $row['OrderedQuantity'];
            $VariationID = $row['VariationID'];
            $DeliveredPrice = $row['OrderedPrice'];

            //$update->minusStock($VariationID, $DeliveredQuantity);

            $insert->insertDeliveredProducts($DeliveredQuantity, $DeliveredPrice, $DeliveryID, $VariationID);
        }

        Location("../pages/admin.delivery.php");
    }

?>