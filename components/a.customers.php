<?php
$result = $this->select->selectCustomerTable();  

            $i = 0;
            
            while($row = $result->fetch_assoc()): ?>
            <tr class="border-b striped">
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
            </tr>              
<?php $i++;
endwhile;?>