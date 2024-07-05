<?php
    include_once "../utilities/include.php";
    include_once "../utilities/var.sql.php";

    $session->continueSession();

    if(
        $session->isSessionValid()
        && isset($_POST['product_name'])
        && isset($_POST['product_variation'])
        && isset($_POST['price'])
        && isset($_POST['product_mass'])
        && isset($_POST['in_stock'])
        && isset($_POST['description'])
        && isset($_FILES['image'])
    ) {
        if(!isset($_FILES["image"]) || $_FILES["image"]["error"] != UPLOAD_ERR_OK) {
            LocationAlert("../pages/admin.product.php", "Image not found");
        }
        else {
            $photo = $_FILES["image"]["name"];
            $tmp_name = $_FILES["image"]["tmp_name"];
            $photo_size = $_FILES['image']['size'];

            $max_size = 5 * 1024 * 1024;

            $valid_format = ['jpg', 'jpeg', 'png'];
            $image_extension = explode('.', $photo);
            $image_extension = strtolower(end($image_extension));

            if(!in_array($image_extension, $valid_format)) {
                LocationAlert("../pages/admin.product.php", "Invalid Format");
            }
            else if($photo_size > $max_size) {
                LocationAlert("../pages/admin.product.php", "Image Size too Large");
            }
            else {
                $new_image = uniqid() . '.' . $image_extension;

                $current = __DIR__;
                $home = dirname($current);
                $upload_dir = $home . '/assets/products/';

                // for linux just incase: $upload_dir = "/opt/lampp/htdocs/foamfusion/assets/products/";

                $destination = $upload_dir . $new_image;

                // Ensure the upload directory exists
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                    alert("Made new directory");
                }
                
                if (move_uploaded_file($tmp_name, $destination)) {
                    chmod($destination, 0777);


                    $ProductName = formalize($_POST['product_name']);
                    $VariationName = formalize($_POST['product_variation']);
                    $VariationDescription = $_POST['description'];
                    $VariationImage = $new_image;
                    $MassInOZ = $_POST['product_mass'];
                    $UnitPrice = $_POST['price'];
                    $InStock = $_POST['in_stock'];

                    $insert->insertVariation($ProductName, $VariationName, $VariationDescription, $VariationImage, $MassInOZ, $UnitPrice, $InStock);
                    Location("../pages/admin.product.php");

                } else {
                    LocationAlert("../pages/admin.product.php", "Failed to move uploaded File");
                }

            }
        }
        
    }
    else {
        alert("hmp");
        LocationAlert("../pages/admin.product.php", "Error");
    }
?>