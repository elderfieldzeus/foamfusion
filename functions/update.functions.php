<?php

    class Update {
        private $db;
        private $select;

        function __construct($db) {
            $this->db = $db;
            $this->select = new Select($db);
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
            else if($New == 'Failed' || $New == 'Pending') {
                $sql = "UPDATE Deliveries SET DeliveryTime=NULL WHERE DeliveryID='$ID';";
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

        function minusStock($id, $qty) {
            $sql = "
                    UPDATE Variations SET InStock = InStock - $qty WHERE VariationID = $id;
                ";
            
            $this->db->query($sql);
        }

        function updateCustomerData($CustomerID, $FirstName, $LastName, $BirthDate, $PhoneNum, $Email, $Password, $City, $Barangay, $Street, $PostalCode) {
            $result = $this->select->selectCustomerData($CustomerID);
            $row = $result->fetch_assoc();

            $NameID = $row['NameID'];
            $AccountID = $row['AccountID'];
            $AddressID = $row['AddressID'];

            $sql = "UPDATE Name
                    SET FirstName = '$FirstName',
                    LastName = '$LastName'
                    WHERE NameID = $NameID";

            $this->db->query($sql);

            $e_result = $this->select->selectEmail($Email);

            if($e_result->num_rows > 0 && $Email != $row['Email']) {
                return FALSE;
            }

            if($Password != $row['Password']) {
                $HashedPassword = password_hash($Password, PASSWORD_BCRYPT);
                $sql = "UPDATE Account
                        SET Password = '$HashedPassword'
                        WHERE AccountID = $AccountID;";

                $this->db->query($sql);
            }

            $sql = "UPDATE Account
                    SET Email = '$Email'
                    WHERE AccountID = $AccountID;";

            $this->db->query($sql);

            if($AddressID) {
                $sql = "UPDATE Address
                        SET City = '$City',
                        Barangay = '$Barangay',
                        Street = '$Street',
                        PostalCode = '$PostalCode'
                        WHERE AddressID = $AddressID;";

                $this->db->query($sql);
            }

            if(!$AddressID && $City != '' && $Barangay != '' && $Street != '' && $PostalCode != '') {
                $sql = "INSERT INTO Address (City, Barangay, Street, PostalCode) VALUES ($City, $Barangay, $Street, $PostalCode);";

                $this->db->query($sql);
                $insert_id = $this->db->conn->insert_id;

                $sql = "UPDATE Customers 
                        SET AddressID = $insert_id
                        WHERE CustomerID = $CustomerID;";
                $this->db->query($sql);
            }

            return TRUE;
        }

        function updateEmployeeData($EmployeeID, $FirstName, $LastName, $BirthDate, $PhoneNum, $Email, $Password, $City, $Barangay, $Street, $PostalCode, $Role) {
            $result = $this->select->selectEmployeeData($EmployeeID);
            $row = $result->fetch_assoc();

            $NameID = $row['NameID'];
            $AccountID = $row['AccountID'];
            $AddressID = $row['AddressID'];

            $sql = "UPDATE Name
                    SET FirstName = '$FirstName',
                    LastName = '$LastName'
                    WHERE NameID = $NameID";

            $this->db->query($sql);

            $e_result = $this->select->selectEmail($Email);

            if($e_result->num_rows > 0 && $Email != $row['Email']) {
                return FALSE;
            }

            if($Password != $row['Password']) {
                $HashedPassword = password_hash($Password, PASSWORD_BCRYPT);
                $sql = "UPDATE Account
                        SET Password = '$HashedPassword'
                        WHERE AccountID = $AccountID;";

                $this->db->query($sql);
            }

            $sql = "UPDATE Account
                    SET Email = '$Email',
                    Role = '$Role'
                    WHERE AccountID = $AccountID;";

            $this->db->query($sql);

            $sql = "UPDATE Address
                    SET City = '$City',
                    Barangay = '$Barangay',
                    Street = '$Street',
                    PostalCode = '$PostalCode'
                    WHERE AddressID = $AddressID;";

            $this->db->query($sql);

            return TRUE;
        }
    }

?>