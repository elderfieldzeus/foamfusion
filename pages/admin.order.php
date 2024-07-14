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

        $admin->displayNavbar("Order");
    ?>

    <main class="pl-52 w-full min-h-full">
        <header class="w-full h-20 bg-gray-900">
            <!-- Header content here if needed -->
        </header>
        <div class="py-8 px-12">
            <h1 class="text-4xl">Orders</h1>
            <hr class="my-5">

            <!-- Dropdown for sorting -->
            <div class="mb-4 flex items-center">
                <label for="order-status-filter" class="block text-sm font-medium text-gray-700 mr-2">Filter by Order Status:</label>
                <select id="order-status-filter" onchange="filterOrders()" class="block w-40 px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option class="font-bold text-black" value="all">ALL</option>
                    <option class="font-bold text-red-500" value="failed">FAILED</option>
                    <option class="font-bold text-blue-500" value="pending">PENDING</option>
                    <option class="font-bold text-green-500" value="success">SUCCESS</option>
                </select>
            </div>

            <div class="flex flex-col">
                <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full" id="order-table">
                                <thead class="bg-gray-800 text-white border-b">
                                    <tr>
                                        <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                                            ID
                                        </th>
                                        <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                                            Order Status
                                        </th>
                                        <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                                            Customer Name
                                        </th>
                                        <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                                            Order Time
                                        </th>
                                        <th scope="col" class="text-sm font-medium pl-6 py-4 text-left">
                                            Order Details
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $admin->displayAdminOrders();
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
        function openDialog(ID) {
            const dialogName = `order_dialog_${ID}`;
            const closeName = `close_dialog_${ID}`;
            const dialog = document.getElementById(dialogName);

            dialog.classList.remove("hidden");

            document.getElementById(closeName).addEventListener("click", () => {
                dialog.classList.add("hidden");
            });
        }

        function filterOrders() {
            const filter = document.getElementById('order-status-filter').value.toLowerCase();
            const table = document.getElementById('order-table');
            const rows = Array.from(table.getElementsByTagName('tr'));

            rows.shift(); // Remove the header row from filtering

            rows.forEach(row => {
                const statusCell = row.getElementsByTagName('td')[1]; // Assuming order status is in the second column
                const status = statusCell.innerText.trim().toLowerCase();

                if (filter === 'all' || status === filter) {
                    row.style.display = ''; // Show rows that match filter or 'all'
                } else {
                    row.style.display = 'none'; // Hide rows that do not match filter
                }
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
