<?php

    class Insert {
        private $sql;
        private $db;
        public $insert_id;

        function __construct($db) {
            $this->db = $db;
        }

        function insertCustomer($FirstName, $LastName, $MiddleName, $BirthDate, $PhoneNum, $Email, $City, $Barangay, $Street, $PostalCode, $Password) {
            $NameID = null;
            $AddressID = null;
            $AccountID = null;

            //insert into Name
            $this->sql = "INSERT INTO Name (FirstName, LastName, MiddleName) VALUES('$FirstName', '$LastName', '$MiddleName');";

            $this->db->query($this->sql);
            $NameID = $this->db->conn->insert_id;

            //insert into Address
            $this->sql = "INSERT INTO Address (City, Barangay, Street, PostalCode) VALUES('$City', '$Barangay', '$Street', '$PostalCode');";

            $this->db->query($this->sql);
            $AddressID = $this->db->conn->insert_id;

            //insert into Account
            $this->sql = "INSERT INTO Account (Email, Password) VALUES('$Email', '$Password');";

            $this->db->query($this->sql);
            $AccountID = $this->db->conn->insert_id;

            //insert into Customer
            $this->sql = "INSERT INTO Customers (BirthDate, PhoneNum, NameID, AddressID, AccountID) VALUES ('$BirthDate', '$PhoneNum', '$NameID', '$AddressID', '$AccountID');";
            
            $this->db->query($this->sql);
            $this->insert_id = $this->db->conn->insert_id;
        }

        function insertEmployee($FirstName, $LastName, $MiddleName, $BirthDate, $PhoneNum, $Email, $City, $Barangay, $Street, $PostalCode, $Password) {

            $NameID = null;
            $ContactID = null;
            $AddressID = null;
            $AccountID = null;

            //insert into Name
            $this->sql = "INSERT INTO Name (FirstName, LastName, MiddleName) VALUES('$FirstName', '$LastName', '$MiddleName');";

            $this->db->query($this->sql);
            $NameID = $this->db->conn->insert_id;

            //insert into Address
            $this->sql = "INSERT INTO Address (City, Barangay, Street, PostalCode) VALUES('$City', '$Barangay', '$Street', '$PostalCode');";

            $this->db->query($this->sql);
            $AddressID = $this->db->conn->insert_id;

            //insert into Account
            $this->sql = "INSERT INTO Account (Email, Password, Role) VALUES('$Email', '$Password', 'Admin');";

            $this->db->query($this->sql);
            $AccountID = $this->db->conn->insert_id;

            //insert into Employees
            $this->sql = "INSERT INTO Employees (BirthDate, PhoneNum, NameID, AddressID, AccountID) VALUES ('$BirthDate', '$PhoneNum', '$NameID', '$AddressID', '$AccountID');";
            
            $this->db->query($this->sql);
            $this->insert_id = $this->db->conn->insert_id;
        }

        function insertProduct($ProductName) {
            $this->sql = "SELECT ProductID FROM Products WHERE ProductName LIKE '$ProductName';";
            $result = $this->db->query($this->sql);

            //If product not yet in db, then insert
            if($result->num_rows == 0) {
                $this->sql = "INSERT INTO Products (ProductName) VALUES ('$ProductName')";
                $this->db->query($this->sql);
                $this->insert_id = $this->db->conn->insert_id;
                return $this->insert_id;
            }
            
            //if already in db, just return the id of existing product
            $row = $result->fetch_assoc();
            return $row['ProductID'];
        }

        function insertVariation($ProductName, $VariationName, $VariationDescription, $VariationImage, $MassInOZ, $UnitPrice, $InStock) {
            $ProductID = $this->insertProduct($ProductName);

            //inserts into Variations table with ProductID as foreign key
            $this->sql = "INSERT INTO Variations (VariationName, VariationDescription, VariationImage, MassInOz, UnitPrice, InStock, ProductID) VALUES ('$VariationName', '$VariationDescription', '$VariationImage', '$MassInOZ', '$UnitPrice', '$InStock', '$ProductID');";
            $this->db->conn->query($this->sql);
            $this->insert_id = $this->db->conn->insert_id;
        }

        function insertOrder($TotalPrice, $CustomerID) {
            $this->sql = "INSERT INTO Orders(TotalPrice, CustomerID) VALUES ('$TotalPrice', '$CustomerID');";
            $this->db->query($this->sql);
            $this->insert_id = $this->db->conn->insert_id;
        }

        function insertOrderedProducts($OrderedQuantity, $OrderID, $VariationID) {
            $this->sql = "INSERT INTO OrderedProducts(OrderedQuantity, OrderID, VariationID) VALUES ('$OrderedQuantity', '$OrderID', '$VariationID');";
            $this->db->query($this->sql);
            $this->insert_id = $this->db->conn->insert_id;
        }
        
        function insertDelivery($TotalPrice, $EmployeeID, $OrderID) {
            $this->sql = "INSERT INTO Deliveries (TotalPrice, EmployeeID, OrderID) VALUES ('$TotalPrice', '$EmployeeID', '$OrderID');";
            $this->db->query($this->sql);
            $this->insert_id = $this->db->conn->insert_id;
        }

        function insertDeliveredProducts($DeliveredQuantity, $DeliveryID, $VariationID) {
            $this->sql = "INSERT INTO DeliveredProducts (DeliveredQuantity, DeliveryID, VariationID) VALUES ('$DeliveredQuantity', '$DeliveryID', '$VariationID');";
            $this->db->query($this->sql);
            $this->insert_id = $this->db->conn->insert_id;
        }
    }

?>