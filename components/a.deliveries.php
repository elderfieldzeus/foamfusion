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
        <div id="delivery_dialog_<?= $row['DeliveryID'] ?>" class="dialog hidden">
            <div class="inner_dialog">
                <span id="close_dialog_<?= $row['DeliveryID'] ?>" class="close--svg size-8 bg-red-500 absolute top-2 right-2 hover:cursor-pointer hover:bg-red-800"></span>
                <h1>Delivery #<?= $row['DeliveryID']?> Details</h1>
                <div>
                    <h1>Customer Information</h1>
                    <hr>
                    <p>Customer Name: <?= $row['CustomerName'] ?></p>
                    <p>Address: <?= $row['FullAddress'] ?></p>
                    <p>Contact Number: <?= $row['PhoneNum'] ?></p>
                    <p>Email: <?= $row['Email'] ?></p>
                </div>
                <div>
                    <h1>Employee Information</h1>
                    <hr>
                    <p>Employee In Charge: <?= $row['EmployeeName'] ?></p>
                    <p>Email: <?= $row['Email'] ?></p>
                </div>
            <div>
        </div>
    
<?php $i++;
endwhile; ?>