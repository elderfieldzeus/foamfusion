<?php

    class Delete {
        private $db;
        private $select;
        
        function __construct($db) {
            $this->db = $db;
            $this->select = new Select($db);
        }

        function delete($Table, $Column, $ID) {
            $sql = "DELETE FROM $Table WHERE $Column='$ID'";

            $this->db->query($sql);
        }

        function deleteDelivery($ID) {
            $sql = "DELETE FROM DeliveredProducts WHERE DeliveryID='$ID';";

            $this->db->query($sql);
            $this->delete("Deliveries", "DeliveryID", $ID);
        }

        function deleteDeliveryOrder($ID) {
            $sql = "SELECT DeliveryID FROM Deliveries WHERE OrderID = $ID";

            $result = $this->db->query($sql);
            while($row = $result->fetch_assoc()) {
                $this->deleteDelivery($row['DeliveryID']);
            }
        }

        function deleteOrder($ID) {
            $sql = "SELECT * FROM OrderedProducts WHERE OrderID = $ID;";
            $result = $this->db->query($sql);

            while($row = $result->fetch_assoc()) {
                $VariationID = $row['VariationID'];
                $Quantity = $row['OrderedQuantity'];
                if($VariationID) {
                    $subsql = "UPDATE Variations SET InStock = Instock + $Quantity WHERE VariationID = $VariationID;";

                    $this->db->query($subsql);
                }
            }

            $sql = "DELETE FROM OrderedProducts WHERE OrderID='$ID';";

            $this->db->query($sql);


            $sql = "SELECT DeliveryID FROM Deliveries WHERE OrderID = $ID";
            $result = $this->db->query($sql);

            while($row = $result->fetch_assoc()) {
                $DeliveryID = $row['DeliveryID'];
                $sql = "DELETE FROM DeliveredProducts WHERE DeliveryID='$DeliveryID';";

                $this->db->query($sql);
            }

            $this->delete("Deliveries", "OrderID", $ID);
            $this->delete("Orders", "OrderID", $ID);
        }

        function deleteVariation($ID, $path, $productID) {

            //delete image from directory
            $current = __DIR__;
            $home = dirname(__DIR__);
            $directory = $home . '/assets/products/';
            $imagePath = $directory . $path; 

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            //delete from database
            $sql = "UPDATE OrderedProducts SET VariationID=NULL WHERE VariationID='$ID';";
            $this->db->query($sql);

            $sql = "UPDATE DeliveredProducts SET VariationID=NULL WHERE VariationID='$ID';";
            $this->db->query($sql);

            $this->delete("Variations", "VariationID", $ID);

            //check if there are still other variations of same product
            $res = $this->select->selectNumOfVariations($productID);
            $row = $res->fetch_assoc();

            //if no more variations, delete the product
            if($row['NumOfVariations'] == 0) {
                $this->delete("Products", "ProductID", $productID);
            }
        }

        function deleteType($Type, $ID) {
            $result;
            if($Type == 'customer') {
                $result = $this->select->selectCustomerData($ID);
            }
            else {
                $result = $this->select->selectEmployeeData($ID);
            }
            $row = $result->fetch_assoc();

            $NameID = $row['NameID'];
            $AccountID = $row['AccountID'];
            $AddressID = $row['AddressID'];

            $sql = "DELETE FROM " . ($Type == 'customer' ? 'Customers' : 'Employees') . " WHERE " . ($Type == 'customer' ? 'CustomerID' : 'EmployeeID') . " = $ID";

            $this->db->query($sql);

            $this->delete("Name", "NameID", $NameID);
            $this->delete("Account", "AccountID", $AccountID);

            if($AddressID) {
                $this->delete("Address", "AddressID", $AddressID);
            }
        }
    }

?>