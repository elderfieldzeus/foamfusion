<?php

    include_once "../utilities/include.php";
    include_once "../utilities/var.sql.php";
    $session->continueSession();

    if(!$session->isSessionValid()) {
        Location("../pages/home.php");
    }

    if($_POST['variation_id'] && $_POST['variation_name'] && $_POST['product_mass'] && $_POST['unit_price'] && $_POST['in_stock'] && $_POST['description'] && $session->isSessionValid()) {
        $ID = $_POST['variation_id'];

        $VariationName = $_POST['variation_name'];
        $MassInOZ = $_POST['product_mass'];
        $UnitPrice = $_POST['unit_price'];
        $InStock = $_POST['in_stock']; 
        $VariationDescription = $_POST['description'];

        $update->updateProductVariation($ID, "VariationName", $VariationName);
        $update->updateProductVariation($ID, "MassInOZ", $MassInOZ);
        $update->updateProductVariation($ID, "UnitPrice", $UnitPrice);
        $update->updateProductVariation($ID, "InStock", $InStock);
        $update->updateProductVariation($ID, "VariationDescription", $VariationDescription);

        alert($_POST['variation_id'] . $_POST['variation_name'] . $_POST['product_mass'] . $_POST['unit_price'] . $_POST['in_stock']);

        Location("../pages/admin.product.php");

    }
    else {
        Location("../pages/admin.product.php");
    }

?>