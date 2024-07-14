<?php

    include_once "../utilities/include.php";
    include_once "../utilities/var.sql.php";

    $session->continueSession();

    if(
        $session->isSessionvalid()
        && isset($_POST['customer_id'])
        && isset($_POST['first_name'])
        && isset($_POST['last_name'])
        && isset($_POST['birth_date'])
        && isset($_POST['phone_num'])
        && isset($_POST['email'])
        && isset($_POST['password'])
        && isset($_POST['city'])
        && isset($_POST['barangay'])
        && isset($_POST['street'])
        && isset($_POST['postal_code'])
    ) {
        $CustomerID = $_POST['customer_id'];
        $FirstName = formalize($_POST['first_name']);
        $LastName = formalize($_POST['last_name']);
        $BirthDate = $_POST['birth_date'];
        $PhoneNum = $_POST['phone_num'];
        $Email = $_POST['email'];
        $Password = $_POST['password'];
        $City = formalize($_POST['city']);
        $Barangay = formalize($_POST['barangay']);
        $Street = formalize($_POST['street']);
        $PostalCode = formalize($_POST['postal_code']);

        if($update->updateCustomerData($CustomerID, $FirstName, $LastName, $BirthDate, $PhoneNum, $Email, $Password, $City, $Barangay, $Street, $PostalCode)) {
            Location("../pages/admin.customer.php");
        }
        else {
            LocationAlert("../pages/admin.customer.php", "Failed to update.");
        }
    }

?>