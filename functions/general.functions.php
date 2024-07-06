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
        $string = strtolower($string);
        $string[0] = strtoupper($string[0]);

        return $string;
    }

    function filterNumber(string $string) {
        $hasDecimal = false;
        $num = "";

        for($i = 0; $i < strlen($string); $i++) {
            if(is_numeric($string[$i])) {
                $num .= $string[$i];
            }
            if($string[$i] == '.' && !$hasDecimal) {
                $num .= $string[$i];
                $hasDecimal = true;
            }
        }

        return $num;
    }

?>