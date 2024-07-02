<?php

    require_once "../utilities/include.php";
    require_once "../utilities/var.sql.php";

    if(!$auth->login("elderfieldzeus24@gmail.com", "123", "Admin")) {
        alert("Logged In Failed");
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
    <link rel="stylesheet" href="../styles/admin.css">
</head>
<body>
    <?php

        include_once "../components/admin.navbar.php";
        AdminNavBar("Home");

    ?>

    <main class="pl-52 w-full min-h-full">
        <header class="w-full h-20 bg-gray-900">

        </header>
        <div class="py-8 px-12">
            <h1 class="text-4xl">Home</h1>
            <hr class="my-5">

            <div class="grid grid-cols-3 gap-10">
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg h-48">
                    <?php
                        
                    ?>
                </div>
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg h-48">
                    <?php

                    ?>
                </div>
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg h-48">
                    <?php

                    ?>
                </div>
            </div>
            
        </div>
    </main>

</body>
</html>