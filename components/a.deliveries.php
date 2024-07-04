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
            $cd_result = $this->select->selectCustomerDeliveries($id);
        ?>
        <div id="delivery_dialog_<?= $row['DeliveryID'] ?>" class="dialog hidden">
            <div class="inner_dialog">
                <span id="close_dialog_<?= $row['DeliveryID'] ?>" class="close--svg size-8 bg-red-500 absolute top-3 right-3 hover:cursor-pointer hover:bg-red-800"></span>
                <h1 class="font-bold underline">Delivery #<?= $row['DeliveryID']?></h1>
                <div>
                    <h1>Customer Information</h1>
                    <hr class="mb-1">
                    <div class="flex justify-between">
                        <p class="text-gray-500">Customer Name: </p>
                        <p class="text-gray-500"><?= $row['CustomerName'] ?></p>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-gray-500">Address: </p>
                        <p class="text-gray-500"><?= $row['FullAddress'] ?></p>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-gray-500">Contact Number: </p>
                        <p class="text-gray-500"><?= $row['PhoneNum'] ?></p>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-gray-500">Email:</p>
                        <p class="text-gray-500"><?= $row['Email'] ?></p>
                    </div>
                </div>
                <div>
                    <h1>Employee Information</h1>
                    <hr class="mb-1">
                    <div class="flex justify-between">
                        <p class="text-gray-500">Employee In Charge:</p>
                        <p class="text-gray-500"><?= $row['EmployeeName'] ?></p>
                    </div>
                </div>
                <div>
                    <h1>Products Information</h1>
                    <hr class="mb-1">
                            
                    <?php while($cd_row = $cd_result->fetch_assoc()): ?>
                        <div class="flex w-full justify-between">
                            <p class="text-gray-500"><?= $cd_row['ProductName'] . ', '  . $cd_row['VariationName']  ?> @<?= $cd_row['UnitPrice'] ?> x <?= $cd_row['DeliveredQuantity'] ?>pc/s</p>
                            <p class="text-gray-500"><?= number_format($cd_row['UnitPrice'] * $cd_row['DeliveredQuantity'], 2) ?></p>
                        </div>
                    <?php endwhile; ?>
                    <hr class="mb-1">
                    <div class="flex w-full justify-between">
                        <p class="text-gray-800">Total: </p>
                        <p class="text-gray-800"><?= number_format($row['TotalPrice'], 2) ?></p>
                    </div>
                </div>
            <div>
        </div>
    
<?php $i++;
endwhile; ?>