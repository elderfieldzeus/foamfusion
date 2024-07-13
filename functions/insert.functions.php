<?php

    class Insert {
        private $sql;
        private $db;
        public $insert_id;

        function __construct($db) {
            $this->db = $db;
        }

        function insertCustomerInitial($FirstName, $LastName, $BirthDate, $PhoneNum, $Email, $Password) {
            $NameID = null;
            $AccountID = null;

            //insert into Name
            $this->sql = "INSERT INTO Name (FirstName, LastName) VALUES('$FirstName', '$LastName');";

            $this->db->query($this->sql);
            $NameID = $this->db->conn->insert_id;

            //insert into Account
            $this->sql = "INSERT INTO Account (Email, Password) VALUES('$Email', '$Password');";

            $this->db->query($this->sql);
            $AccountID = $this->db->conn->insert_id;

            //insert into Customer KEEPING ADDRESSID NULL
            $this->sql = "INSERT INTO Customers (BirthDate, PhoneNum, NameID, AccountID) VALUES ('$BirthDate', '$PhoneNum', '$NameID', '$AccountID');";
            
            $this->db->query($this->sql);
            $this->insert_id = $this->db->conn->insert_id;
        }

        function insertCustomer($FirstName, $LastName, $BirthDate, $PhoneNum, $Email, $City, $Barangay, $Street, $PostalCode, $Password) {
            $NameID = null;
            $AddressID = null;
            $AccountID = null;

            //insert into Name
            $this->sql = "INSERT INTO Name (FirstName, LastName) VALUES('$FirstName', '$LastName');";

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

        function insertEmployee($FirstName, $LastName, $BirthDate, $PhoneNum, $Email, $City, $Barangay, $Street, $PostalCode, $Password, $Role) {

            $NameID = null;
            $ContactID = null;
            $AddressID = null;
            $AccountID = null;

            //insert into Name
            $this->sql = "INSERT INTO Name (FirstName, LastName) VALUES('$FirstName', '$LastName');";

            $this->db->query($this->sql);
            $NameID = $this->db->conn->insert_id;

            //insert into Address
            $this->sql = "INSERT INTO Address (City, Barangay, Street, PostalCode) VALUES('$City', '$Barangay', '$Street', '$PostalCode');";

            $this->db->query($this->sql);
            $AddressID = $this->db->conn->insert_id;

            //insert into Account
            $this->sql = "INSERT INTO Account (Email, Password, Role) VALUES('$Email', '$Password', '$Role');";

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

        function insertOrder($CustomerID, $PaymentMethod) {
            $this->sql = "INSERT INTO Orders(CustomerID, PaymentMethod) VALUES ('$CustomerID', '$PaymentMethod');";
            $this->db->query($this->sql);
            $this->insert_id = $this->db->conn->insert_id;
        }

        function insertOrderedProducts($OrderedQuantity, $OrderedPrice, $OrderID, $VariationID) {
            $this->sql = "INSERT INTO OrderedProducts(OrderedQuantity, OrderedPrice, OrderID, VariationID) VALUES ('$OrderedQuantity', '$OrderedPrice', '$OrderID', '$VariationID');";
            $this->db->query($this->sql);
            $this->insert_id = $this->db->conn->insert_id;
        }
        
        function insertDelivery($EmployeeID, $OrderID) {
            $this->sql = "INSERT INTO Deliveries (EmployeeID, OrderID) VALUES ('$EmployeeID', '$OrderID');";
            $this->db->query($this->sql);
            $this->insert_id = $this->db->conn->insert_id;
        }

        function insertDeliveredProducts($DeliveredQuantity, $DeliveredPrice, $DeliveryID, $VariationID) {
            if($VariationID) {
                $this->sql = "INSERT INTO DeliveredProducts (DeliveredQuantity, DeliveredPrice, DeliveryID, VariationID) VALUES ('$DeliveredQuantity', '$DeliveredPrice', '$DeliveryID', '$VariationID');";
            }
            else {
                $this->sql = "INSERT INTO DeliveredProducts (DeliveredQuantity, DeliveredPrice, DeliveryID) VALUES ('$DeliveredQuantity', '$DeliveredPrice', '$DeliveryID');";
            }
            
            $this->db->query($this->sql);
            $this->insert_id = $this->db->conn->insert_id;
        }

        function insertAddress($City, $Barangay, $Street, $PostalCode) {
            $this->sql = "INSERT INTO Address (City, Barangay, Street, PostalCode) VALUES ('$City', '$Barangay', '$Street', '$PostalCode');";

            $this->db->query($this->sql);
            $this->insert_id = $this->db->conn->insert_id;
        }
    }

?>