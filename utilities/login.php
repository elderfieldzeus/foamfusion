<?php

    include_once "../utilities/include.php";
    include_once "../utilities/var.sql.php";

    $session->continueSession();

    if(
        isset($_POST['email'])
        && isset($_POST['password'])
    ) {
        $Email = $_POST['email'];
        $Password = $_POST['password'];
        $Role = null;

        if(!$auth->login($Email, $Password, $Role)) {
            $session->endSession();
            LocationAlert("../pages/home.php", "Invalid Login!");
        }

        if($Role == 'Admin') {
            Location("../pages/admin.home.php");
        }

        if($Role == 'Customer') {
            Location("../pages/home.php");
        }
    }

?>