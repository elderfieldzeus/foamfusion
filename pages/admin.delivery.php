<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoamFusion - Admin</title>
    <link rel="stylesheet" href="../styles/tailwind.css">
    <link rel="stylesheet" href="../styles/svg.css">
    <link rel="stylesheet" href="../styles/admin.css">
    <style>
        .sortable-header {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php
        require_once "../utilities/include.php";
        require_once "../utilities/var.sql.php";

        $admin->displayNavbar("Delivery");
    ?>

    <main class="pl-52 w-full min-h-full">
        <header class="w-full h-20 bg-gray-900">
        </header>
        <div class="py-8 px-12">
            <div class="flex w-full justify-between">
                <div class="flex justify-start items-end gap-2">
                    <h1 class="text-4xl">Deliveries</h1>
                    <button onclick="openAddDialog()" class="p-1 rounded-full bg-blue-700 text-white text-base flex items-center justify-center mb-1">
                        <span class="add--svg bg-white size-4"></span>
                    </button>
                </div>
                <button onclick="openYourDialog()" class="bg-blue-700 transition-colors text-white px-6 py-2 rounded-md">Your Deliveries</button>
            </div>

            <div id="add_dialog" class="dialog hidden">
                <div class="inner_dialog">
                    <span id="close_add_dialog" class="close--svg size-8 bg-red-500 absolute top-3 right-3 hover:cursor-pointer hover:bg-red-800 transition-colors"></span>

                    <?php
                        $admin->displayAddDeliveries();
                    ?>

                </div>
            </div>

            <div id="your_dialog" class="dialog hidden">
                <div class="inner_dialog">
                    <span id="close_your_dialog" class="close--svg size-8 bg-red-500 absolute top-3 right-3 hover:cursor-pointer hover:bg-red-800 transition-colors"></span>
                    
                    <?php
                        $admin->displayYourDeliveries();
                    ?>

                </div>
            </div>

            <hr class="my-5">

            <div class="flex flex-col">
                <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
                                <!-- Dropdown for sorting -->
            <div class="mb-4 flex items-center">
                <label for="delivery-status-filter" class="block text-sm font-medium text-gray-700 mr-2">Filter by Delivery Status:</label>
                <select id="delivery-status-filter" onchange="filterDeliveries()" class="block w-40 px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option class="font-bold text-black" value="all">ALL</option>
                    <option class="font-bold text-red-500" value="failed">FAILED</option>
                    <option class="font-bold text-blue-500" value="pending">PENDING</option>
                    <option class="font-bold text-green-500" value="success">SUCCESS</option>
                </select>
            </div>
                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full" id="delivery-table">
                                <thead class="bg-gray-800 text-white border-b">
                                    <tr>
                                        <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                                            ID
                                        </th>
                                        <th scope="col" class="sortable-header text-sm font-medium px-6 py-4 text-left" onclick="sortTable(2)">
                                            Delivery Status
                                        </th>
                                        <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                                            Customer Name
                                        </th>
                                        <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                                            Employee Name
                                        </th>
                                        <th scope="col" class="text-sm font-medium pl-6 py-4 text-left">
                                            Delivery Details
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $admin->displayAdminDeliveries();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <script>
        function sortTable(columnIndex) {
            const table = document.getElementById('delivery-table');
            const rows = Array.from(table.getElementsByTagName('tr'));

            rows.shift(); // Remove the header row from sorting

            rows.sort((rowA, rowB) => {
                const cellA = rowA.getElementsByTagName('td')[columnIndex - 1].innerText.trim();
                const cellB = rowB.getElementsByTagName('td')[columnIndex - 1].innerText.trim();

                if (columnIndex === 2) { // Sorting based on delivery status
                    const deliveryStatusOrder = {
                        'pending': 1,
                        'success': 2,
                        'failed': 3
                    };

                    return deliveryStatusOrder[cellA.toLowerCase()] - deliveryStatusOrder[cellB.toLowerCase()];
                } else {
                    return cellA - cellB; // For numerical sorting if needed
                }
            });

            while (table.rows.length > 1) {
                table.deleteRow(1); // Clear existing rows except header
            }

            rows.forEach(row => {
                table.appendChild(row); // Append sorted rows to table
            });
        }

        function filterDeliveries() {
            const filter = document.getElementById('delivery-status-filter').value.toLowerCase();
            const table = document.getElementById('delivery-table');
            const rows = Array.from(table.getElementsByTagName('tr'));

            rows.shift(); // Remove the header row from filtering

            rows.forEach(row => {
                const statusCell = row.getElementsByTagName('td')[1]; // Assuming delivery status is in the second column
                const status = statusCell.innerText.trim().toLowerCase();

                if (filter === 'all' || status === filter) {
                    row.style.display = ''; // Show rows that match filter or 'all'
                } else {
                    row.style.display = 'none'; // Hide rows that do not match filter
                }
            });
        }

        function openDialog(ID) {
            const dialogName = `delivery_dialog_${ID}`;
            const closeName = `close_dialog_${ID}`;
            const dialog = document.getElementById(dialogName);

            dialog.classList.remove("hidden");

            document.getElementById(closeName).addEventListener("click", () => {
                dialog.classList.add("hidden");
            });
        }

        function openAddDialog() {
            const dialog = document.getElementById("add_dialog");
            const close = document.getElementById("close_add_dialog");
            dialog.classList.remove("hidden");

            close.addEventListener("click", () => {
                dialog.classList.add("hidden");
            });
        }

        function openYourDialog() {
            const dialog = document.getElementById("your_dialog");
            const close = document.getElementById("close_your_dialog");
            dialog.classList.remove("hidden");

            close.addEventListener("click", () => {
                dialog.classList.add("hidden");
            });
        }

        function deleteAlert(location) {
            if(confirm("Are you sure you want to delete?") == true) {
                window.location.href = location;
            }
        }
    </script>
</body>
</html>
