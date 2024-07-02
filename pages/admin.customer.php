<?php

    require_once "../utilities/include.php";
    require_once "../utilities/var.sql.php";

    $session->endSession();
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
        AdminNavBar("Customer");

    ?>

    <main class="pl-52 w-full min-h-full">
        <header class="w-full h-20 bg-gray-900">

        </header>
        <div class="py-8 px-12">
            <h1 class="text-4xl">Customers</h1>
            <hr class="my-5">

        </div>
    </main>

</body>
</html>