<?php $result = $this->select->selectOrderTable();

$i = 0;

while($row = $result->fetch_assoc()): ?> 
        <tr class="<?=($i % 2 == 0 ? "bg-gray-200" : "bg-white")  ?> border-b">
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                <?= $row['OrderID'] ?>
            </td>
            <td class="text-sm 
                <?php
                    switch(($row['OrderStatus'])) {
                        case 'Pending': echo 'text-blue-500'; break;
                        case 'Failed': echo 'text-red-500'; break;
                        case 'Success': echo 'text-green-500'; break;
                    }
                ?>
            font-bold px-6 py-4 whitespace-nowrap">
                <?=strtoupper($row['OrderStatus'])?>
            </td>
            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                <?=$row['CustomerName']?>
            </td>
            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                <?=$row['OrderTime']?>
            </td>
            <td class="text-sm text-gray-900 font-light px-2 py-2 whitespace-nowrap text-center">
                <button onclick="openDetails(<?=$row['OrderID'] ?>, 'Order')" class="bg-blue-700 text-white py-2 px-8 rounded-md">Details</button>
            </td>
        </tr>

<?php $i++; ?>
<?php endwhile; ?>