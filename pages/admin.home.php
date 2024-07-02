<?php

    require_once "../utilities/include.php";
    require_once "../utilities/var.sql.php";

    if(!$auth->signup("Zeus", "Elderfield", "David", "2003-5-12", "09177755790", "elderfieldzeus24@gmail.com", "Mandaue", "Basak", "St. John", "6014", "123", "123", "Admin")) {
        alert("Failed");
    }

    if($auth->login("elderfieldzeus24@gmail.com", "123", "Admin")) {
        alert("Logged In Successfully");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoamFusion - Admin</title>
    <link rel="stylesheet" href="../styles/tailwind.css">
    <link rel="stylesheet" href="../styles/svg.css">
</head>
<body>
    <?php

        include_once "../components/admin.navbar.php";
        AdminNavBar("Home");

    ?>

</body>
</html>