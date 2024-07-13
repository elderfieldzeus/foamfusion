<?php

    include_once "../utilities/include.php";
    include_once "../utilities/var.sql.php";

    $session->continueSession();

    if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['phone_num']) && isset($_POST['birthdate']) && isset($_POST['city']) && isset($_POST['barangay']) && isset($_POST['street_name']) && isset($_POST['postal_code']) && $session->isSessionValid()) {
        $Email = strtolower($_POST['email']);
        $Password = $_POST['password'];
        $ConfirmPassword = $_POST['confirm_password'];
        $FirstName = formalize($_POST['first_name']);
        $LastName = formalize($_POST['last_name']);
        $PhoneNum = $_POST['phone_num'];
        $BirthDate = $_POST['birthdate'];
        $City = formalize($_POST['city']);
        $Barangay = formalize($_POST['barangay']);
        $Street = formalize($_POST['street_name']);
        $PostalCode = formalize($_POST['postal_code']);

        if(!$auth->signup($FirstName, $LastName, $BirthDate, $PhoneNum, $Email, $City, $Barangay, $Street, $PostalCode, $Password, $ConfirmPassword, "Employee")) {
            LocationAlert("../pages/admin.employee.php", "Invalid Signup Attempt!");
        }
        else {
            Location("../pages/admin.employee.php"); 
        };
    }
    else {
        Location("../pages/admin.employee.php"); 
    }

       

?>