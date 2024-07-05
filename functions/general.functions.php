<?php

    function alert($string) {
        echo 
            "<script>
                alert('" . $string . "');
            </script>";
    }

    function Location($location) {
        header("Location: ". $location);
    }

    function LocationAlert($location, $alert) {
        echo "
            <script>
                window.location.href='" . $location . "';
                alert('" . $alert . "');
            </script>
        ";
    }

    function formalize($string) {
        $string[0] = strtoupper($string[0]);
        for($i = 1; $i < strlen($string); $i++) {
            $string[$i] = strtolower($string[$i]);
        }

        return $string;
    }

?>