<?php
$result = $this->select->selectCustomerTable();  

            $i = 0;
            
            while($row = $result->fetch_assoc()): ?>
            <tr class="<?= ($i % 2 == 0 ? "bg-gray-200" : "bg-white")  ?> border-b">
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
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"><?=
                    $row['FullAddress']
                ?></td>
            </tr>                
<?php $i++;
endwhile;?>