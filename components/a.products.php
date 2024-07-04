<?php
    $result = $this->select->selectAllVariations();
?>
        
<?php while($row = $result->fetch_assoc()): ?> 
<div class="product-card">
    <img src="../assets/<?= $row['VariationImage']; ?>" class="product-card--images">
    <div class="flex flex-col">
        <h2 class="text-xl px-3"> <?= $row['VariationName'];?> </h2>
        <h2 class="text-sm px-3 hover:cursor-pointer text-gray-400"> <?=$row['ProductName'];?> </h2>
    </div>
</div>
<?php endwhile; ?>
