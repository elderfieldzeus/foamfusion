<?php 
    class Cart {
        public $variation_id;
        public $quantity;
        public $inStock;

        function __construct($variation_id, $select) {
            $this->variation_id = $variation_id;

            $result = $select->selectInStock($variation_id);
            $row = $result->fetch_assoc();

            $this->inStock = $row['InStock'];
            $this->quantity = 0;
        }

        function addQuantity($quantity) {
            if($quantity + $this->quantity <= $this->inStock) {
                $this->quantity += $quantity;
            }
            else {
                $this->quantity = $this->inStock;
            }
        }

        function minusQuantity($quantity) {
            if($this->quantity - $quantity >= 0) {
                $this->quantity -= $quantity;
            }
            else {
                $this->quantity = 0;
            }
        }
    }
?>