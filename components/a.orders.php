<?php $result = $this->select->selectOrderTable();

$i = 0;

while($row = $result->fetch_assoc()): ?> 
        <tr class="striped border-b">
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
                <button onclick="openDialog(<?=$row['OrderID'] ?>)" class="bg-blue-700 text-white py-2 px-8 rounded-md">Details</button>
            </td>
        </tr>
        <?php
            $id = $row['CustomerID'];

            $c = $this->select->selectCustomerData($id);
            $c_result = $c->fetch_assoc();

            $cd_result = $this->select->selectOrderedProducts($row['OrderID']);
        ?>
        <div id="order_dialog_<?= $row['OrderID'] ?>" class="dialog hidden">
            <div class="inner_dialog">
                <span id="close_dialog_<?= $row['OrderID'] ?>" class="close--svg size-8 bg-red-500 absolute top-3 right-3 hover:cursor-pointer hover:bg-red-800 transition-colors"></span>
                <h1 class="font-bold underline text-xl">Order #<?= $row['OrderID']?></h1>
                <div>
                    <h1>Customer Information</h1>
                    <hr class="mb-1">
                    <div class="flex justify-between">
                        <p class="text-gray-500">Customer Name: </p>
                        <p class="text-gray-500"><?= $row['CustomerName'] ?></p>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-gray-500">Address: </p>
                        <p class="text-gray-500"><?= $c_result['FullAddress'] ?></p>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-gray-500">Contact Number: </p>
                        <p class="text-gray-500"><?= $c_result['PhoneNum'] ?></p>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-gray-500">Email:</p>
                        <p class="text-gray-500"><?= $c_result['Email'] ?></p>
                    </div>
                </div>
                
                <div>
                    <h1>Products Information</h1>
                    <hr class="mb-1">
                            
                    <?php 
                    $total_price = 0;

                    while($cd_row = $cd_result->fetch_assoc()): 
                        $sale = $cd_row['OrderedPrice'] * $cd_row['OrderedQuantity'];
                        $total_price += $sale;
                    ?>
                        <div class="flex justify-between">
                            <p class=<?= $cd_row['VariationID'] ? "text-gray-500" : "text-red-500" ?> ><?= ($cd_row['VariationID'] ? $cd_row['ProductName'] . ', '  . $cd_row['VariationName'] : '**DELETED PRODUCT**')   ?> @Php<?= $cd_row['OrderedPrice'] ?> x <?= $cd_row['OrderedQuantity'] ?>pc/s</p>
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
                    <h1>Order Information</h1>
                    <hr>

                    <div class="flex justify-between">
                        <p class="text-gray-500">Order Status:</p>
                        <p class="font-bold 
                        
                        <?php

                            switch(($row['OrderStatus'])) {
                                case 'Pending': echo 'text-blue-500'; break;
                                case 'Failed': echo 'text-red-500'; break;
                                case 'Success': echo 'text-green-500'; break;
                            }

                        ?>
                        
                        "><?= strtoupper($row['OrderStatus']) ?></p>
                    </div>

                    <div class="flex justify-between">
                            <p class="text-gray-500">Payment Method: </p>
                            <p class="text-gray-500"><?= $row['PaymentMethod'] ?></p>
                    </div>

                    <div class="flex justify-between">
                            <p class="text-gray-500">Order Time: </p>
                            <p class="text-gray-500"><?= $row['OrderTime'] ?></p>
                    </div>

                    <?php
                        $this->session->continueSession();
                        if ($this->session->isSessionValid() && $this->session->Role === 'Admin') : 
                    ?>

                        <div class="w-full grid grid-cols-3 gap-2 my-4">
                            <a href="../utilities/updatestatus.php?id=<?=$row['OrderID']?>&type=Order&status=Failed" class="py-2 text-center font-bold bg-red-500 hover:bg-red-800 transition-colors text-white rounded-md">FAILED</a>
                            <a href="../utilities/updatestatus.php?id=<?=$row['OrderID']?>&type=Order&status=Pending" class="py-2 text-center font-bold bg-blue-500 hover:bg-blue-800 transition-colors text-white rounded-md">PENDING</a>
                            <a href="../utilities/updatestatus.php?id=<?=$row['OrderID']?>&type=Order&status=Success" class="py-2 text-center font-bold bg-green-500 hover:bg-green-800 transition-colors text-white rounded-md">SUCCESS</a>
                        </div>

                        <div class="flex justify-center">
                            <a href="../utilities/deleteod.php?id=<?= $row['OrderID'] ?>&type=Order" class="font-bold bg-yellow-500 hover:bg-yellow-800 transition-colors pt-2 pb-1 px-2 rounded-md">
                                <span class="delete--svg bg-white size-6"></span>
                            </a>
                        </div>

                    <?php endif; ?>
                </div>
            </div>
        </div>

<?php $i++; ?>
<?php endwhile; ?>