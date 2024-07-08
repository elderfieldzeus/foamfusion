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
            <div class="flex justify-end mb-4">
                <label for="order-status-filter" class="mr-2">Filter by Order Status:</label>
                <select id="order-status-filter" onchange="filterOrders()">
                    <option value="all">All</option>
                    <option value="pending">Pending</option>
                    <option value="success">Success</option>
                    <option value="failed">Failed</option>
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
    </script>
</body>
</html>
