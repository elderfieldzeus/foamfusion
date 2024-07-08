<?php

    include_once "../utilities/include.php";
    include_once "../utilities/var.sql.php";

    $session->continueSession();

    if(
        isset($_POST['first_name'])
        && isset($_POST['last_name'])
        && isset($_POST['email'])
        && isset($_POST['phone_num'])
        && isset($_POST['password'])
        && isset($_POST['confirm_password'])
    ) {
        $FirstName = formalize($_POST['first_name']);
        $LastName = formalize($_POST['last_name']);
        $Email = $_POST['email'];
        $PhoneNum = $_POST['phone_num'];
        $Password = $_POST['password'];
        $ConfirmPassword = $_POST['confirm_password'];

        if(!accountSignup($FirstName, $LastName, $Email, $PhoneNum, $Password, $ConfirmPassword)) {
            LocationAlert("../pages/home.php", "Invalid Signup!");
        }

        Location("../pages/home.php");
    }

?>