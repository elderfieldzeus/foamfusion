<?php

    include_once "../utilities/include.php";
    include_once "../utilities/var.sql.php";

    $session->continueSession();

    if(
        $session->isSessionValid()
        && isset($_GET['type'])
        && isset($_GET['id'])
    ) {
        $Type = $_GET['type'];
        $ID = $_GET['id'];

        $delete->deleteType($Type, $ID);
    }

?>