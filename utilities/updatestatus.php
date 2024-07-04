<?php

    include_once "../utilities/include.php";
    include_once "../utilities/var.sql.php";
    $session->continueSession();

    if(!$session->isSessionValid()) {
        Location("../pages/home.php");
    }

    if(isset($_GET['id']) && isset($_GET['type']) && isset($_GET['status'])) {
        $id = $_GET['id'];
        $type = $_GET['type'];
        $status = $_GET['status'];

        if($type == 'Order') {
            $update->updateOrder($id, $type . 'Status', $status);
            Location("../pages/admin.order.php");
        }
        else {
            $update->updateDelivery($id, $type . 'Status', $status);
            Location("../pages/admin.delivery.php");
        }
    }

?>