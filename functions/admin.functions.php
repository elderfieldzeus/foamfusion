<?php

    class Admin {
        private $select;

        function __construct($select) {
            $this->select = $select;
        }

        function displayAdminProducts() {
            $result = $this->select->selectAllVariations();
        
            while($row = $result->fetch_assoc()) {
                echo '
                    <div class="product-card">
                        <img src="../assets/' . $row['VariationImage'] . '" class="product-card--images">
                        <div class="flex flex-col">
                            <h2 class="text-xl px-3">' . $row['VariationName'] . '</h2>
                            <h2 class="text-sm px-3 hover:cursor-pointer text-gray-400">' . $row['ProductName'] . '</h2>
                        </div>
                    </div>
                ';
            }
        }

        function displayChart($result, $name, $value) {
            echo '
            <script>
                const xValues_' . $name . ' = [];
                const yValues_' . $name . ' = [];
                const barColors_' . $name . ' = [];

                function randomColor() {
                    const letters = "0123456789ABCDEF";
                    let color = "#";
                    for (let i = 0; i < 6; i++) {
                        color += letters[Math.floor(Math.random() * 16)];
                    }
                    return color;
                }
                ';
    
            $i = 0;
    
            while ($row = $result->fetch_assoc()) {
                if ($i >= 3) break;
                echo '
                    xValues_' . $name . '.push("' . $row[$name]  . '");
                    yValues_' . $name . '.push(' . $row[$value] . ');
                    barColors_' . $name . '.push(randomColor());
                ';
                $i++;
            }
    
            echo '
            

            new Chart(document.getElementById("' . $name . '"), {
                type: "doughnut",
                data: {
                    labels: xValues_' . $name . ',
                    datasets: [{
                        backgroundColor: barColors_' . $name . ',
                        data: yValues_' . $name . '
                    }]
                }
            });
            </script>
            ';
        }

        function displayAdminOrders() {
            $result = $this->select->selectOrderTable();

            $i = 0;
            
            while($row = $result->fetch_assoc()) {
                echo '
                    <tr class="' . ($i % 2 == 0 ? "bg-gray-200" : "bg-white")  . ' border-b">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">' .
                            $row['OrderID']
                        . '</td>
                        <td class="text-sm ';

                switch(($row['OrderStatus'])) {
                    case 'Pending': echo 'text-blue-500'; break;
                    case 'Failed': echo 'text-red-500'; break;
                    case 'Success': echo 'text-green-500'; break;
                }

                echo    ' font-bold px-6 py-4 whitespace-nowrap">' .
                            strtoupper($row['OrderStatus'])
                        . '</td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">' .
                            $row['CustomerName']
                        . '</td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">' .
                            $row['OrderTime']
                        . '</td>
                        <td class="text-sm text-gray-900 font-light px-2 py-2 whitespace-nowrap text-center">
                            <button onclick="openDetails(' . $row['OrderID'] . ', \'Order\')" class="bg-blue-700 text-white py-2 px-8 rounded-md">Details</button>
                        </td>
                    </tr>
                ';
                
                $i++;
            }
        }

        function displayAdminDeliveries() {
            $result = $this->select->selectDeliveryTable();  

            $i = 0;
            
            while($row = $result->fetch_assoc()) {
                echo '
                    <tr class="' . ($i % 2 == 0 ? "bg-gray-200" : "bg-white")  . ' border-b">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">' .
                            $row['DeliveryID']
                        . '</td>
                        <td class="text-sm ';

                switch(($row['DeliveryStatus'])) {
                    case 'Pending': echo 'text-blue-500'; break;
                    case 'Failed': echo 'text-red-500'; break;
                    case 'Success': echo 'text-green-500'; break;
                }

                echo    ' font-bold px-6 py-4 whitespace-nowrap">' .
                        strtoupper($row['DeliveryStatus'])
                        . '</td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">' .
                            $row['CustomerName']
                        . '</td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">' .
                            $row['EmployeeName']
                        . '</td>
                        <td class="text-sm text-gray-900 font-light px-2 py-2 whitespace-nowrap text-center">
                            <button onclick="openDialog(' . $row['DeliveryID'] . ')" class="bg-blue-700 text-white py-2 px-8 rounded-md">Details</button>
                        </td>
                    </tr>
                    <div id="delivery_dialog_' . $row['DeliveryID'] . '" class="dialog">
                        <div class="inner_dialog">
                            <h1>Delivery #' . $row['DeliveryID'] . ' </h1>
                            <h1>' . $row['DeliveryID'] . ' </h1>
                        <div>
                    </div>
                ';
                
                $i++;
            }
        }

        function displayAdminCustomers() {
            $result = $this->select->selectCustomerTable();  

            $i = 0;
            
            while($row = $result->fetch_assoc()) {
                echo '
                    <tr class="' . ($i % 2 == 0 ? "bg-gray-200" : "bg-white")  . ' border-b">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">' .
                            $row['CustomerID']
                        . '</td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">' .
                            $row['CustomerName']
                        . '</td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">' .
                            $row['Email']
                        . '</td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">' .
                            $row['PhoneNum']
                        . '</td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">' .
                            $row['FullAddress']
                        . '</td>
                    </tr>
                ';
                
                $i++;
            }
        }
    }
?>