<?php

    require_once "../utilities/include.php";
    require_once "../utilities/var.sql.php";

    $session->continueSession();
    if(!$session->isSessionValid() || $session->Role != 'Admin') {
        Location("../pages/admin.home.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoamFusion - Admin</title>
    <link rel="stylesheet" href="../styles/admin.css">
    <link rel="stylesheet" href="../styles/tailwind.css">
    <link rel="stylesheet" href="../styles/svg.css">
    <script>
        // JavaScript function to sort table rows by Customer Name
        function sortTable(columnIndex, sortOrder) {
            let table, rows, switching, i, x, y, shouldSwitch;
            table = document.querySelector("table");
            switching = true;
            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[columnIndex];
                    y = rows[i + 1].getElementsByTagName("TD")[columnIndex];
                    if (sortOrder === 'asc') {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    } else if (sortOrder === 'desc') {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }
        }

        // Function to handle dropdown change
        function handleSortChange() {
            const sortSelect = document.getElementById("sortSelect");
            const selectedIndex = sortSelect.selectedIndex;
            const sortOrder = sortSelect.options[selectedIndex].value;
            sortTable(1, sortOrder); // Sort by Customer Name (column index 1)
        }
    </script>
</head>
<body>
    <?php
        $admin->displayNavbar("Customer");
    ?>
    <main class="pl-52 w-full min-h-full">
        <header class="w-full h-20 bg-gray-900">
        </header>

        <div class="py-8 px-12">
            <h1 class="text-4xl">Customers</h1>

            <hr class="my-5">

            <div class="mb-4 flex items-center">
                <label for="sortSelect" class="block text-sm font-medium text-gray-700 mr-2">Sort by Customer Name:</label>
                <select id="sortSelect" onchange="handleSortChange()" class="block w-40 px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="asc">A to Z</option>
                    <option value="desc">Z to A</option>
                </select>
            </div>
            <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full">
                            <thead class="bg-gray-800 text-white border-b">
                                <tr>
                                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                                        ID
                                    </th>
                                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left" onclick="sortTable(1, 'asc')">
                                        Customer Name
                                    </th>
                                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                                        Email Address
                                    </th>
                                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                                        Phone Number
                                    </th>
                                    <th scope="col" class="text-sm font-medium pl-6 py-4 text-left">
                                        Address
                                    </th>
                                    <th>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $admin->displayAdminCustomers();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function openDialog(ID) {
            const dialogName = `customer_dialog_${ID}`;
            const closeName = `close_dialog_${ID}`;
            const dialog = document.getElementById(dialogName);

            dialog.classList.remove("hidden");

            document.getElementById(closeName).addEventListener("click", () => {
                dialog.classList.add("hidden");
            });
        }
    </script>
</body>
</html>
