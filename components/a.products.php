<?php
    $result = $this->select->selectAllVariations();
?>
        
<?php while($row = $result->fetch_assoc()): ?> 

    <button onclick="openDialog(<?= $row['VariationID'] ?>)" class="product-card">
        <img src="../assets/products/<?= $row['VariationImage'] ?>" alt="&nbsp" class="product-card--images">
        <div class="flex flex-col items-start">
            <h2 class="text-xl px-3 text-start"> <?= $row['ProductName']?> </h2>
            <h2 class="text-sm px-3 hover:cursor-pointer text-gray-400 text-start"> <?=$row['VariationName']?> </h2>
        </div>
    </button>

    <div id="product_dialog_<?= $row['VariationID'] ?>" class="dialog hidden">
        <div class="inner_dialog">
            <span id="close_dialog_<?= $row['VariationID'] ?>" class="close--svg size-8 bg-red-500 absolute top-3 right-3 hover:cursor-pointer hover:bg-red-800 transition-colors"></span>
            <div class="flex w-full h-full">

                <div class="left_dialog w-1/2 max-h-full flex items-center justify-center overflow-y-hidden p-6 pr-10">
                    <img src="../assets/products/<?= $row['VariationImage'] ?>" alt="&nbsp" class="h-[30rem] w-[30rem] object-cover rounded-md">
                </div>

                <div class="right_dialog w-1/2">
                    <?php 
                        $this->session->continueSession();
                        if ($this->session->isSessionValid() && $this->session->Role === 'Admin') :
                    ?>
                        <form method="post" action="../utilities/updateproduct.php" class="wrapper w-[30rem] h-full flex flex-col justify-center">
                            <input type="hidden" id="variation_id" name="variation_id" value="<?= $row['VariationID'] ?>">
                            <div id="inner_form" class="h-4/5 overflow-scroll">
                                <div class="flex items-end gap-2">
                                    <p class="text-4xl"><?= $row['ProductName'] ?></p>
                                    <button type="button" onclick="deleteAlert('../utilities/deleteproduct.php?id=<?= $row['VariationID'] ?>&image=<?= $row['VariationImage'] ?>&productid=<?= $row['ProductID'] ?>')">
                                        <span class="delete--svg size-6 bg-red-400"></span>
                                    </button>
                                </div>
                                <p class="text-xl text-gray-400"><input name="variation_name" class="focus:outline-none bg-opacity-0 " value="<?=$row['VariationName']?>"></p>
                                <p class="text-lg mt-4">Mass: <input name="product_mass" type="numeric" step="0.01" class="text-gray-400 focus:outline-none bg-opacity-0" min="0" value="<?=$row['MassInOZ']?>oz"></p>
                                <div class="flex text-lg">
                                    <p>Price:&nbsp</p>
                                    <p class="text-gray-400">Php <input name="unit_price" type="numeric" step="0.01" class="focus:outline-none bg-opacity-0" min="0" value="<?=$row['UnitPrice']?>"></p>
                                </div>
                                <p class="text-lg">In stock: <input name="in_stock" type="numeric" step="1" class="text-gray-400 focus:outline-none bg-opacity-0" min="0" value="<?=$row['InStock']?>"></p>
                                <p class="text-xl mt-4">Product Description</p>
                                <textarea name="description" class="text-gray-400 focus:outline-none bg-opacity-0 text-lg w-full h-56 resize-none overflow-y-scroll"><?=$row['VariationDescription']?></textarea>
                            </div>

                            <button type="submit" class="px-6 py-4 bg-yellow-400 hover:bg-yellow-700 transition-colors rounded-md text-white font-bold">UPDATE</button>
                        </form>

                    <?php endif; ?>

                    <?php if($this->session->isSessionValid() && $this->session->Role === 'Employee') : ?>

                        <div class="wrapper w-[30rem] h-full flex flex-col justify-center">
                            <input type="hidden" id="variation_id" name="variation_id" value="<?= $row['VariationID'] ?>">
                            <div id="inner_form" class="h-4/5 overflow-scroll">
                                <p class="text-4xl"><?= $row['ProductName'] ?></p>
                                <p class="text-xl text-gray-400"><?=$row['VariationName']?></p>
                                <div class="flex text-lg mt-3 gap-1">
                                    <p>Mass: </p>
                                    <p class="text-gray-400"><?=$row['MassInOZ']?>oz</p>
                                </div>
                                <div class="flex text-lg">
                                    <p>Price:&nbsp</p>
                                    <p class="text-gray-400">Php <?=$row['UnitPrice']?></p>
                                </div>
                                <div class="flex text-lg gap-1">
                                    <p>In stock:</p>
                                    <p class="text-gray-400"><?=$row['InStock']?></p>
                                </div>
                                <p class="text-xl mt-4">Product Description</p>
                                <p class="text-gray-400 focus:outline-none bg-opacity-0 text-lg w-full h-56 resize-none overflow-y-scroll"><?=$row['VariationDescription']?></p>
                            </div>
                    </div>

                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
<?php endwhile; ?>
