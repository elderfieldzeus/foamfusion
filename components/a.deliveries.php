<?php 

$result = $this->select->selectDeliveryTable();
$i = 0;
            
        while($row = $result->fetch_assoc()): ?> 
        <tr class="<?= ($i % 2 == 0 ? "bg-gray-200" : "bg-white")  ?> border-b">
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                <?= $row['DeliveryID'] ?>
            </td>
            <td class="text-sm

            <?php

                switch(($row['DeliveryStatus'])) {
                    case 'Pending': echo 'text-blue-500'; break;
                    case 'Failed': echo 'text-red-500'; break;
                    case 'Success': echo 'text-green-500'; break;
                }

            ?>

             font-bold px-6 py-4 whitespace-nowrap">
                <?= strtoupper($row['DeliveryStatus']) ?>
            </td>
            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                <?= $row['CustomerName'] ?>
            </td>
            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                <?= $row['EmployeeName'] ?>
            </td>
            <td class="text-sm text-gray-900 font-light px-2 py-2 whitespace-nowrap text-center">
                <button onclick="openDialog(<?= $row['DeliveryID'] ?>)" class="bg-blue-700 text-white py-2 px-8 rounded-md">Details</button>
            </td>
        </tr>
        <?php
            $id = $row['CustomerID'];

            $c = $this->select->selectCustomerData($id);
            $c_result = $c->fetch_assoc();

            $cd_result = $this->select->selectCustomerDeliveries($id);
        ?>
        <div id="delivery_dialog_<?= $row['DeliveryID'] ?>" class="dialog hidden">
            <div class="inner_dialog">
                <span id="close_dialog_<?= $row['DeliveryID'] ?>" class="close--svg size-8 bg-red-500 absolute top-3 right-3 hover:cursor-pointer hover:bg-red-800 transition-colors"></span>
                <h1 class="font-bold underline text-xl">Delivery #<?= $row['DeliveryID']?></h1>
                <div>
                    <h1>Customer Information</h1>
                    <hr class="mb-1">
                    <div class="flex justify-between">
                        <p class="text-gray-500">Customer Name: </p>
                        <p class="text-gray-500"><?= $row['CustomerName'] ?></p>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-gray-500">Address: </p>
                        <p class="text-gray-500"><?= $c_result['FullAddress'] ?></p>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-gray-500">Contact Number: </p>
                        <p class="text-gray-500"><?= $c_result['PhoneNum'] ?></p>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-gray-500">Email:</p>
                        <p class="text-gray-500"><?= $c_result['Email'] ?></p>
                    </div>
                </div>
                <div>
                    <h1>Employee Information</h1>
                    <hr class="mb-1">
                    <div class="flex justify-between">
                        <p class="text-gray-500">Designated Employee:</p>
                        <p class="text-gray-500"><?= $row['EmployeeName'] ?></p>
                    </div>
                </div>
                <div>
                    <h1>Products Information</h1>
                    <hr class="mb-1">
                            
                    <?php 
                    $total_price = 0;

                    while($cd_row = $cd_result->fetch_assoc()): 
                        $sale = $cd_row['UnitPrice'] * $cd_row['DeliveredQuantity'];
                        $total_price += $sale;
                    ?>
                        <div class="flex justify-between">
                            <p class="text-gray-500"><?= $cd_row['ProductName'] . ', '  . $cd_row['VariationName']  ?> @Php<?= $cd_row['UnitPrice'] ?> x <?= $cd_row['DeliveredQuantity'] ?>pc/s</p>
                            <p class="text-gray-500">Php <?= number_format($sale, 2) ?></p>
                        </div>
                    <?php endwhile; ?>

                    <hr class="mb-1">
                    <div class="flex justify-between">
                        <p class="text-gray-800">Total: </p>
                        <p class="text-gray-800">Php <?= number_format($total_price, 2) ?></p>
                    </div>
                </div>
                <div>
                    <h1>Delivery Information</h1>
                    <hr>

                    <div class="flex justify-between">
                        <p class="text-gray-500">Delivery Status:</p>
                        <p class="font-bold 
                        
                        <?php

                            switch(($row['DeliveryStatus'])) {
                                case 'Pending': echo 'text-blue-500'; break;
                                case 'Failed': echo 'text-red-500'; break;
                                case 'Success': echo 'text-green-500'; break;
                            }

                        ?>
                        
                        "><?= strtoupper($row['DeliveryStatus']) ?></p>
                    </div>

                    <div class="flex justify-between">
                            <p class="text-gray-500">Delivery Time: </p>
                            <p class="text-gray-500"><?= $row['DeliveryTime'] ?></p>
                    </div>

                    <div class="flex justify-center gap-5 m-5">
                            <button class="py-2 px-8 bg-red-500 hover:bg-red-800 transition-colors text-white rounded-md">FAILED</button>
                            <button class="py-2 px-8 bg-blue-500 hover:bg-blue-800 transition-colors text-white rounded-md">PENDING</button>
                            <button class="py-2 px-8 bg-green-500 hover:bg-green-800 transition-colors text-white rounded-md">SUCCESS</button>
                    </div>

                    <div class="flex justify-center">
                        <button class="bg-yellow-500 hover:bg-yellow-800 transition-colors pt-2 pb-1 px-2 rounded-md">
                            <span class="delete--svg bg-white size-6"></span>
                        </button>
                    </div>
                </div>
            <div>
        </div>
    
<?php $i++;
endwhile; ?>