<?php

    include_once "../utilities/include.php";
    include_once "../utilities/var.sql.php";

    $session->continueSession();

    if(
        $session->isSessionValid()
        && isset($_GET['type'])
        && isset($_GET['id'])
    ) {
        $Type = $_GET['type'];
        $ID = $_GET['id'];

        $url = ($Type == 'customer') ? "../pages/admin.customer.php" : "../pages/admin.employee.php";

        if($delete->deleteType($Type, $ID)) { 
            Location($url);
        }
        else {
            LocationAlert($url, "Unable to Delete User due to Active Orders/Deliveries.");
        }

        
    }

?>