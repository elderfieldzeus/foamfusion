<?php 

$result = $this->select->selectProductSales();
$i = 0;
            
        while($row = $result->fetch_assoc()): ?> 
        <tr class="striped border-b">
            <td class="px-6 py-4 whitespace-nowrap text-sm <?= ($row['VariationID']) ? 'text-gray-800 font-medium' : 'text-red-500 font-bold' ?>">
                <?= ($row['VariationID']) ? ($row['VariationID']) : '?' ?>
            </td>
            <td class="text-sm <?= ($row['VariationID']) ? 'text-gray-800 font-light' : 'text-red-500 font-bold' ?> px-6 py-4 whitespace-nowrap">
                <?= ($row['VariationName']) ? ($row['VariationName']) : 'DELETED' ?>
            </td>
            <td class="text-sm <?= ($row['VariationID']) ? 'text-gray-800 font-light' : 'text-red-500 font-bold' ?> px-6 py-4 whitespace-nowrap">
                <?= ($row['ProductName']) ? ($row['ProductName']) : 'DELETED' ?>
            </td>
            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                <?= $row['UnitsSold'] ?>
            </td>
            <td class="text-sm text-gray-900 px-2 py-2 whitespace-nowrap font-light">
                Php <?= number_format($row['TotalSales'], 2) ?>
            </td>
        </tr>

<?php endwhile; ?>