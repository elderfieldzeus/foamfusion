<?php

    include_once "../utilities/include.php";
    include_once "../utilities/var.sql.php";

    $session->continueSession();

    if(
        isset($_POST['first_name'])
        && isset($_POST['last_name'])
        && isset($_POST['birth_date'])
        && isset($_POST['email'])
        && isset($_POST['phone_num'])
        && isset($_POST['password'])
        && isset($_POST['confirm_password'])
    ) {
        $FirstName = formalize($_POST['first_name']);
        $LastName = formalize($_POST['last_name']);
        $BirthDate = $_POST['birth_date'];
        $Email = $_POST['email'];
        $PhoneNum = $_POST['phone_num'];
        $Password = $_POST['password'];
        $ConfirmPassword = $_POST['confirm_password'];

        if(!$auth->accountSignup($FirstName, $LastName, $BirthDate, $PhoneNum, $Email, $Password, $ConfirmPassword)) {
            LocationAlert("../pages/home.php", "Invalid Signup!");
        }

        $Role = null;

        if(!$auth->login($Email, $Password, $Role)) {
            LocationAlert("../pages/home.php", "ERROR");
        };

        Location("../pages/home.php");
    }

?>