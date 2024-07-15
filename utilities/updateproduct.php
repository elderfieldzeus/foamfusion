<?php

    include_once "../utilities/include.php";
    include_once "../utilities/var.sql.php";
    $session->continueSession();

    if(!$session->isSessionValid()) {
        Location("../pages/home.php");
    }

    if(
        isset($_POST['variation_id'] )
        && isset($_POST['variation_name'] ) 
        && isset($_POST['product_mass'] )
        && isset($_POST['unit_price'] )
        && isset($_POST['in_stock'])
        && isset($_POST['description'] )
        && $session->isSessionValid()
    ) {
        $ID = $_POST['variation_id'];

        $VariationName = $_POST['variation_name'];
        $UnfilteredMass = $_POST['product_mass'];
        $UnitPrice = $_POST['unit_price'];
        $UnfilteredStock = $_POST['in_stock']; 
        $VariationDescription = $_POST['description'];

        $MassInOZ = filterNumber($UnfilteredMass);
        $InStock = filterNumber($UnfilteredStock);

        $update->updateProductVariation($ID, "VariationName", $VariationName);
        $update->updateProductVariation($ID, "MassInOZ", $MassInOZ);
        $update->updateProductVariation($ID, "UnitPrice", $UnitPrice);
        $update->updateProductVariation($ID, "InStock", $InStock);
        // $update->updateProductVariation($ID, "VariationDescription", $VariationDescription);

        $sql = "UPDATE Variations SET VariationDescription = ? WHERE VariationID = $ID";
        $stmt = $db->conn->prepare($sql);
        $stmt->bind_param("s", $VariationDescription);
        $stmt->execute();

        // alert($_POST['variation_id'] . $_POST['variation_name'] . $_POST['product_mass'] . $_POST['unit_price'] . $_POST['in_stock']);

        Location("../pages/admin.product.php");

    }
    else {
        Location("../pages/admin.product.php");
    }

?>