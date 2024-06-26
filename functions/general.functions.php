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

?>