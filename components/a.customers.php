<?php
$result = $this->select->selectCustomerTable();  

            $i = 0;
            
            while($row = $result->fetch_assoc()): ?>
            <tr class="border-b striped items-center">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?=
                    $row['CustomerID']
                ?></td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"><?=
                    $row['CustomerName']
                ?></td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"><?=
                    $row['Email']
                ?></td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"><?=
                    $row['PhoneNum']
                ?></td>
                <td class="text-sm <?= $row['FullAddress'] ? 'text-gray-900 font-light' :  'text-red-500 font-bold ' ?> px-6 py-4 whitespace-nowrap"><?=
                    $row['FullAddress'] ? $row['FullAddress'] :  'NULL'
                ?></td>
                <td class="pt-1">
                    <button onclick="openDialog('<?= $row['CustomerID'] ?>')" class="size-10 bg-yellow-400 rounded-lg flex items-center justify-center"><span class="edit--svg size-6 bg-white"></span></button>
                </td>
            </tr>
            
            <div id="customer_dialog_<?= $row['CustomerID'] ?>" class="dialog hidden">
                <div class="inner_dialog">
                    <span id="close_dialog_<?= $row['CustomerID'] ?>" class="close--svg size-8 bg-red-500 absolute top-3 right-3 hover:cursor-pointer hover:bg-red-800 transition-colors"></span>
                </div>
            </div>
<?php $i++;
endwhile;?>