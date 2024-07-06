<?php

    $result = $this->select->selectOrdersToBeDelivered();
    $session->continueSession();

?>

<div class="">
    <h1>Deliver Orders:</h1>
    <?php while($row = $result->fetch_assoc()) : ?>

        <hr>
        <div>
            <p>Order ID: <?= $row['OrderID'] ?></p>
            <p>Customer: <?= $row['CustomerName'] ?></p>
            <p>Address: <?= $row['FullAddress'] ?></p>

            <p>Products Ordered:</p>
            <?php
                $sale = 0;
                $o_products = $this->select->selectOrderedProducts($row['OrderID']); 
                while($op = $o_products->fetch_assoc()) :
                    $sale += $op['UnitPrice'] * $op['OrderedQuantity'];
            ?>

            <p>- <?= $op['ProductName']. ', ' . $op['VariationName'] . "@ Php" . $op['UnitPrice'] . " x " . $op['OrderedQuantity'] . "pc/s" ?></p>

            <?php endwhile; ?>
            <p>Total Price: <?= number_format($sale, 2) ?></p>
            
            
            <a href="../utilities/adddelivery.php?orderid=<?= $row['OrderID'] ?>&employeeid=<?= $session->ID ?>">Deliver!</a>
        </div>

    <?php endwhile; ?>
</div>