<?php
    
    include "./functions/general.functions.php";

    Location("./pages/home.php");

?>

<table>
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php while($cd_row = $cd_result->fetch_assoc()): ?>
            <tr>
                <td><?= $cd_row['ProductName'] . ', '  . $cd_row['VariationName'] ?></td>
                <td><?= $cd_row['DeliveredQuantity'] ?></td>
                <td><?= $cd_row['UnitPrice'] ?></td>
                <td><?= number_format($cd_row['UnitPrice'] * $cd_row['DeliveredQuantity'], 2) ?></td>
            </tr>
        <?php endwhile; ?>  
    </tbody>
</table> 