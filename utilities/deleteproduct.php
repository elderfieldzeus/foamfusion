<?php

    include_once "../utilities/include.php";
    include_once "../utilities/var.sql.php";
    $session->continueSession();

    if(!$session->isSessionValid()) {
        Location("../pages/home.php");
    }

    if(isset($_GET['id']) && isset($_GET['image']) && $session->isSessionValid()) {
        $id = $_GET['id'];
        $image = $_GET['image'];
        $delete->deleteVariation($id, $image);

        Location("../pages/admin.product.php");
    }

?>