<h1 class="font-bold text-xl">Your Deliveries:</h1>


<?php

    $this->session->continueSession();
    $result = $this->select->selectEmployeeDeliveries($this->session->ID);

?>

<?php if($result->num_rows == 0) : ?>
    <p class="w-full text-gray-400 text-center font-semibold mt-2">No deliveries yet! Stay tuned...</p>
<?php endif;
    while($row = $result->fetch_assoc()) :
?>

    
    <div class="bg-neutral-50 rounded-md p-4 mb-6 flex flex-col gap-5">
        <div>
            <h1 class="font-bold underline text-lg mb-4">Delivery #<?= $row['DeliveryID'] ?></h1>
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
                <p class="text-gray-500">Designated Employee:</p>
                <p class="text-gray-500"><?= $row['EmployeeName'] ?></p>
            </div>
        </div>
        <div>
            <h1>Products Information</h1>
            <hr class="mb-1">
        
            <?php
            $total_price = 0;
            $cd_result = $this->select->selectDeliveredProducts($row['DeliveryID']);
            while($cd_row = $cd_result->fetch_assoc()):
                $sale = $cd_row['DeliveredPrice'] * $cd_row['DeliveredQuantity'];
                $total_price += $sale;
            ?>
                <div class="flex justify-between">
                    <p class="text-gray-500"><?= ($cd_row['VariationID'] ? $cd_row['ProductName'] . ', '  . $cd_row['VariationName'] : '**DELETED PRODUCT**')   ?> @Php<?= $cd_row['DeliveredPrice'] ?> x <?= $cd_row['DeliveredQuantity'] ?>pc/s</p>
                    <p class="text-gray-500">Php <?= number_format($sale, 2) ?></p>
                </div>
            <?php endwhile; ?>
            <hr class="mb-1">
            <div class="flex justify-between">
                <p class="text-gray-800">Total: </p>
                <p class="text-gray-800">Php <?= number_format($total_price, 2) ?></p>
            </div>
        </div>
        <div>
            <h1>Delivery Information</h1>
            <hr>
            <div class="flex justify-between">
                <p class="text-gray-500">Delivery Status:</p>
                <p class="font-bold
        
                <?php
                    switch(($row['DeliveryStatus'])) {
                        case 'Pending': echo 'text-blue-500'; break;
                        case 'Failed': echo 'text-red-500'; break;
                        case 'Success': echo 'text-green-500'; break;
                    }
                ?>
        
                "><?= strtoupper($row['DeliveryStatus']) ?></p>
            </div>
            <div class="flex justify-between">
                    <p class="text-gray-500">Delivery Time: </p>
                    <p class="text-gray-500"><?= ($row['DeliveryStatus'] == 'Success') ? $row['DeliveryTime'] : 'N/A' ?></p>
            </div>
            <div class="w-full grid grid-cols-3 gap-2 my-4">
                <a href="../utilities/updatestatus.php?id=<?=$row['DeliveryID']?>&type=Delivery&status=Failed" class="py-2  text-center font-bold bg-red-500 hover:bg-red-800 transition-colors text-white rounded-md">FAILED</a>
                <a href="../utilities/updatestatus.php?id=<?=$row['DeliveryID']?>&type=Delivery&status=Pending" class="py-2  text-center font-bold bg-blue-500 hover:bg-blue-800 transition-colors text-white rounded-md">PENDING</a>
                <a href="../utilities/updatestatus.php?id=<?=$row['DeliveryID']?>&type=Delivery&status=Success" class="py-2  text-center font-bold bg-green-500 hover:bg-green-800 transition-colors text-white rounded-md">SUCCESS</a>
            </div>
            <div class="flex justify-center">
                <a href="../utilities/deleteod.php?id=<?= $row['DeliveryID'] ?>&type=Delivery" class="font-bold bg-yellow-500 hover:bg-yellow-800 transition-colors pt-2 pb-1 px-2 rounded-md">
                    <span class="delete--svg bg-white size-6"></span>
                </a>
            </div>
        </div>
    </div>
<?php endwhile; ?>