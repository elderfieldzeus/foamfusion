<?php

    class Delete {
        private $db;
        
        function __construct($db) {
            $this->db = $db;
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

        function deleteOrder($ID) {
            $sql = "DELETE FROM OrderedProducts WHERE OrderID='$ID';";

            $this->db->query($sql);
            $this->delete("Orders", "OrderID", $ID);
        }

        function deleteVariation($ID, $path) {
            //delete image from directory
            $current = __DIR__;
            $home = dirname(__DIR__);
            $directory = $home . '/assets/products/';
            $imagePath = $directory . $path; 

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            //delete from database
            $sql = "DELETE FROM OrderedProducts WHERE VariationID='$ID';";
            $this->db->query($sql);

            $sql = "DELETE FROM DeliveredProducts WHERE VariationID='$ID';";
            $this->db->query($sql);

            $this->delete("Variations", "VariationID", $ID);
        }
    }

?>