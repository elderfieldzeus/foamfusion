<?php

    class Select {
        //functions that return results of SELECT queries

        private $sql;
        private $db;

        function __construct($db) {
            $this->db = $db;
        }

        function selectCustomerData($CustomerID) {
            $this->sql = "SELECT * FROM Customers 
                        LEFT JOIN Name ON Customers.NameID = Name.NameID;
                        LEFT JOIN Contact ON Customers.ContactID = Contact.ContactID;
                        LEFT JOIN Address ON Customers.AddressID = Address.AddressID;
                        LEFT JOIN Account ON Customers.ContactID = Account.AccountID;
                        WHERE CustomerID='$CustomerID';";

            return $this->db->query($this->sql);
        }

        function selectEmployeeData($EmployeeID) {
            $this->sql = "SELECT * FROM Employees 
                        LEFT JOIN Name ON Employees.NameID = Name.NameID;
                        LEFT JOIN Contact ON Employees.ContactID = Contact.ContactID;
                        LEFT JOIN Address ON Employees.AddressID = Address.AddressID;
                        LEFT JOIN Account ON Employees.ContactID = Account.AccountID;
                        WHERE EmployeeID='$EmployeeID';";

            return $this->db->query($this->sql);
        }

        function selectAllOrders() {
            $this->sql = "SELECT * FROM OrderedProducts
                        LEFT JOIN Orders ON OrderedProducts.OrderID = Orders.OrderID
                        LEFT JOIN Variations ON OrderedProducts.VariationID = Variations.VariationID
                        LEFT JOIN Customers ON Orders.CustomerID = Customers.CustomerID;";

            return $this->db->query($this->sql);
        }

        function selectAllDeliveries() {
            $this->sql = "SELECT *
                        FROM DeliveredProducts
                        LEFT JOIN Deliveries ON DeliveredProducts.DeliveryID = Deliveries.DeliveryID
                        LEFT JOIN Variations ON DeliveredProducts.VariationID = Variations.VariationID
                        LEFT JOIN Employees ON Deliveries.EmployeeID = Employees.EmployeeID
                        LEFT JOIN Orders ON Deliveries.OrderID = Orders.OrderID
                        LEFT JOIN Customers ON Orders.CustomerID = Customers.CustomerID;";

            return $this->db->query($this->sql);
        }

        function selectCustomerOrders($CustomerID) {
            $this->sql = "SELECT * FROM Orders 
                        LEFT JOIN OrderedProducts ON OrderedProducts.OrderID = Orders.OrderID
                        LEFT JOIN Variations ON OrderedProducts.VariationID = Variations.VariationID
                        WHERE Orders.CustomerID = '$CustomerID';
                        ";

            return $this->db->query($this->sql);
        }

        function selectCustomerDeliveries($CustomerID) {
            $this->sql = "SELECT * FROM Deliveries
                        LEFT JOIN DeliveredProducts ON DeliveredProducts.DeliveryID = Deliveries.DeliveryID
                        LEFT JOIN Variations ON Variations.VariationID = DeliveredProducts.VariationID
                        LEFT JOIN Orders ON Orders.OrderID = Deliveries.DeliveryID
                        WHERE Orders.CustomerID = '$CustomerID';
                        ";

            return $this->db->query($this->sql);
        }

        function selectEmployeeDeliveries($EmployeeID) {
            $this->sql = "SELECT * FROM Deliveries
                        LEFT JOIN DeliveredProducts ON DeliveredProducts.DeliveryID = Deliveries.DeliveryID
                        LEFT JOIN Variations ON Variations.VariationID = DeliveredProducts.VariationID
                        LEFT JOIN Orders ON Orders.OrderID = Deliveries.DeliveryID
                        WHERE Deliveries.EmployeeID = '$EmployeeID';
                        ";

            return $this->db->query($this->sql);
        }
    }

?>