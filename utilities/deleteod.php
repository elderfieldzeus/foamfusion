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
            Location("../pages/admin.order.php");
        }
        else {
            $delete->deleteDelivery($id);
            Location("../pages/admin.delivery.php");
        }
    }

?>