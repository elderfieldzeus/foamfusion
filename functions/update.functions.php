<?php

    class Update {
        private $db;

        function __construct($db) {
            $this->db = $db;
        }

        //add update personal information (not really necessary)
        private function update($Table, $ID_Name, $ID, $Column, $New) {
            $sql = "UPDATE $Table 
            SET $Column = '$New'
            WHERE $ID_Name = '$ID';";

            return $this->db->query($sql);
        }

        function updateCustomer($ID, $Column, $New) {
            return $this->update("Customers", "CustomerID", $ID, $Column, $New);
        }

        function updateEmployee($ID, $Column, $New) {
            return $this->update("Employees", "EmployeeID", $ID, $Column, $New);
        }

        function updateOrderedProduct($ID, $Column, $New) {
            return $this->update("OrderedProducts", "OrderedProductID", $ID, $Column, $New);
        }

        function updateDeliveredProduct($ID, $Column, $New) {
            return $this->update("DeliveredProducts", "DeliveredProductID", $ID, $Column, $New);
        }

        function updateOrder($ID, $Column, $New) {
            return $this->update("Orders", "OrderID", $ID, $Column, $New);
        }

        function updateDelivery($ID, $Column, $New) {
            if($New == 'Success') {
                $sql = "UPDATE Deliveries SET DeliveryTime=NOW() WHERE DeliveryID='$ID';";
                $this->db->query($sql);
            }
            

            return $this->update("Deliveries", "DeliveryID", $ID, $Column, $New);
        }
        
        function updateProductVariation($ID, $Column, $New) {
            return $this->update("Variations", "VariationID", $ID, $Column, $New);
        }

        function updateProduct($ID, $Column, $New) {
            return $this->update("Products", "ProductID", $ID, $Column, $New);
        }

        function updateTotalPrice($OrderID) {
            $total_price = 0;

            $sql = "SELECT SUM(Variations.UnitPrice * OrderedProducts.OrderedQuantity) AS TotalPrice
                    FROM OrderedProducts
                    LEFT JOIN Variations ON OrderedProducts.VariationID = Variations.VariationID
                    WHERE OrderID = '$OrderID';";

            $result = $this->db->query($sql);
            $row = $result->fetch_assoc();

            $total_price = $row['TotalPrice'];

            $this->updateOrder($OrderID, "TotalPrice", $total_price);
        }
    }

?>