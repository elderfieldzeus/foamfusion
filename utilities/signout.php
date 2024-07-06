<?php

    include_once "../utilities/include.php";
    include_once "../utilities/var.sql.php";

    $session->continueSession();

    $auth->signOut();

    Location("../pages/home.php");
?>