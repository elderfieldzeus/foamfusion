<?php

    include_once "../utilities/include.php";
    include_once "../utilities/var.sql.php";
    $session->continueSession();

    if(!$session->isSessionValid()) {
        Location("../pages/home.php");
    }

    if(isset($_GET['id']) && isset($_GET['type'])) {
        $id = $_GET['id'];
        $type = $_GET['type'];

        if($type == "Order") {
            $delete->deleteOrder($id);
            if(isset($_GET['customer'])) {
                LocationAlert("../pages/account.php", "Successfully Cancelled Order.");
            }
            else {
                Location("../pages/admin.order.php");
            }
        }
        else {
            $delete->deleteDelivery($id);
            Location("../pages/admin.delivery.php");
        }
    }

?>