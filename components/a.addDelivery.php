<?php

    $result = $this->select->selectOrdersToBeDelivered();
    $session->continueSession();

?>

<div class="">
    <h1 class="font-bold text-xl mb-4">Deliver Orders:</h1>
    <?php while($row = $result->fetch_assoc()) : ?>
        <div class="flex flex-col items-center bg-neutral-50 rounded-md p-4 mb-10">
            <div class="w-full">
                <p class="font-bold underline text-lg">Order #<?= $row['OrderID'] ?></p>
                
                <p class="mt-4">Customer Information</p>
                <hr class="mb-2">

                <div class="flex justify-between text-gray-500">
                    <p>Customer Name:</p>
                    <p class="text-gray-500"><?= $row['CustomerName'] ?></p>
                </div>
                <div class="flex justify-between text-gray-500">
                    <p>Address:</p>
                    <p class="text-gray-500"><?= $row['FullAddress'] ?></p>
                </div>
                <div class="flex justify-between text-gray-500">
                    <p>Contact Number:</p>
                    <p class="text-gray-500"><?= $row['PhoneNum'] ?></p>
                </div>
                <div class="flex justify-between text-gray-500">
                    <p>Email:</p>
                    <p class="text-gray-500"><?= $row['Email'] ?></p>
                </div>

                <p class="mt-4">Products Information</p>
                <hr class="mb-2">
                <?php
                    $sale = 0;
                    $o_products = $this->select->selectOrderedProducts($row['OrderID']); 
                    while($op = $o_products->fetch_assoc()) :
                        $sale += ($total = $op['UnitPrice'] * $op['OrderedQuantity']);
                ?>

                <div class="flex justify-between text-gray-500">
                    <p><?= $op['ProductName']. ', ' . $op['VariationName'] . "@ Php" . $op['UnitPrice'] . " x " . $op['OrderedQuantity'] . "pc/s" ?></p>
                    <p>Php <?= number_format($total, 2) ?></p>
                </div>

                <?php endwhile; ?>

                <hr class="my-1">
                <div class="flex justify-between mt-2">
                    <p>Total:</p>
                    <p>Php <?= number_format($sale, 2) ?></p>
                </div>
            </div>
            
            <a class="bg-blue-500 hover:bg-blue-800 px-6 py-2 text-white rounded-md font-bold transition-colors" href="../utilities/adddelivery.php?orderid=<?= $row['OrderID'] ?>&employeeid=<?= $session->ID ?>">DELIVER</a>
        </div>

    <?php endwhile; ?>
</div>