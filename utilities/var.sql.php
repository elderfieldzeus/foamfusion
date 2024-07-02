<?php

    $db = new Connection(); //stores connection to database
    $session = new Session($db); //stores session info and session functions
    $insert = new Insert($db); //stores insert functions
    $select = new Select($db); //stores select functions
    $auth = new Authentication($db, $session); //stores authentification functions
    $admin = new Admin($select);
?>