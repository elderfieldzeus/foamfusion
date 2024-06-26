<?php

    class Insert {
        private $sql;
        private $db;

        function __construct($db) {
            $this->db = $db;
        }

        function insertCustomer($FirstName, $LastName, $MiddleName, $BirthDate, $PhoneNum, $Email, $City, $Barangay, $Street, $PostalCode, $Password) {

            $NameID = null;
            $ContactID = null;
            $AddressID = null;
            $AccountID = null;

            //insert into Name
            $this->sql = "INSERT INTO Name (FirstName, LastName, MiddleName) VALUES('$FirstName', '$LastName', '$MiddleName');";

            $this->db->query($this->sql);
            $NameID = $this->db->conn->insert_id;

            //insert into Contact
            $this->sql = "INSERT INTO Contact (PhoneNum, Email) VALUES('$PhoneNum', '$Email');";

            $this->db->query($this->sql);
            $ContactID = $this->db->conn->insert_id;

            //insert into Address
            $this->sql = "INSERT INTO Address (City, Barangay, Street, PostalCode) VALUES('$City', '$Barangay', '$Street', '$PostalCode');";

            $this->db->query($this->sql);
            $AddressID = $this->db->conn->insert_id;

            //insert into Account
            $this->sql = "INSERT INTO Account (Password) VALUES('$Password');";

            $this->db->query($this->sql);
            $AccountID = $this->db->conn->insert_id;

            //insert into Customer
            $this->sql = "INSERT INTO Customers (BirthDate, NameID, ContactID, AddressID, AccountID) VALUES ('$BirthDate', '$NameID', '$ContactID', '$AddressID', '$AccountID');";
            
            $this->db->query($this->sql);
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

            //insert into Contact
            $this->sql = "INSERT INTO Contact (PhoneNum, Email) VALUES('$PhoneNum', '$Email');";

            $this->db->query($this->sql);
            $ContactID = $this->db->conn->insert_id;

            //insert into Address
            $this->sql = "INSERT INTO Address (City, Barangay, Street, PostalCode) VALUES('$City', '$Barangay', '$Street', '$PostalCode');";

            $this->db->query($this->sql);
            $AddressID = $this->db->conn->insert_id;

            //insert into Account
            $this->sql = "INSERT INTO Account (Password, Role) VALUES('$Password', 'Admin');";

            $this->db->query($this->sql);
            $AccountID = $this->db->conn->insert_id;

            //insert into Employees
            $this->sql = "INSERT INTO Employees (BirthDate, NameID, ContactID, AddressID, AccountID) VALUES ('$BirthDate', '$NameID', '$ContactID', '$AddressID', '$AccountID');";
            
            $this->db->query($this->sql);
        }

        function insertProduct($ProductName) {
            $this->sql = "SELECT ProductID FROM Products WHERE ProductName LIKE '$ProductName';";
            $result = $this->db->query($this->sql);

            if($result->num_rows == 0) {
                $this->sql = "INSERT INTO Products (ProductName) VALUES ('$ProductName')";
                $this->db->query($this->sql);

                return $this->db->conn->insert_id;
            }
            
            $row = $result->fetch_assoc();
            return $row['ProductID'];
        }

        function insertVariation($ProductName, $VariationName, $VariationDescription, $VariationImage, $MassInOZ, $UnitPrice, $InStock) {
            $ProductID = $this->insertProduct($ProductName);

            $this->sql = "INSERT INTO Variations (VariationName, VariationDescription, VariationImage, MassInOz, UnitPrice, InStock, ProductID) VALUES ('$VariationName', '$VariationDescription', '$VariationImage', '$MassInOZ', '$UnitPrice', '$InStock', '$ProductID');";
            $this->db->conn->query($this->sql);
        }

        function insertOrder($TotalPrice, $CustomerID) {
            $this->sql = "INSERT INTO Orders(TotalPrice, CustomerID) VALUES ('$TotalPrice', '$CustomerID');";
            $this->db->query($this->sql);
        }

        function insertOrderedProducts($OrderedQuantity, $OrderID, $VariationID) {
            $this->sql = "INSERT INTO OrderedProducts(OrderedQuantity, OrderID, VariationID) VALUES ('$OrderedQuantity', '$OrderID', '$VariationID');";
            $this->db->query($this->sql);
        }
        
        function insertDelivery($TotalPrice, $EmployeeID, $OrderID) {
            $this->sql = "INSERT INTO Deliveries (TotalPrice, EmployeeID, OrderID) VALUES ('$TotalPrice', '$EmployeeID', '$OrderID');";
            $this->db->query($this->sql);
        }

        function insertDeliveredProducts($DeliveredQuantity, $DeliveryID, $VariationID) {
            $this->sql = "INSERT INTO DeliveredProducts (DeliveredQuantity, DeliveryID, VariationID) VALUES ('$DeliveredQuantity', '$DeliveryID', '$VariationID');";
            $this->db->query($this->sql);
        }
    }

?>