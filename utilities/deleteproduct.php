<?php

    include_once "../utilities/include.php";
    include_once "../utilities/var.sql.php";
    $session->continueSession();

    if(!$session->isSessionValid()) {
        Location("../pages/home.php");
    }

    if(isset($_GET['id']) && isset($_GET['image']) && $_GET['productid'] && $session->isSessionValid()) {
        $id = $_GET['id'];
        $image = $_GET['image'];
        $product_id = $_GET['productid'];
        $delete->deleteVariation($id, $image, $product_id);

        Location("../pages/admin.product.php");
    }

?>