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
                        LEFT JOIN Deliveries ON DeliveredProducts.DeliveryID 
                        LEFT JOIN Variations ON DeliveredProducts.VariationID
                        LEFT JOIN Employees ON Deliveries.EmployeeID
                        LEFT JOIN Orders ON Deliveries.OrderID
                        LEFT JOIN Customers ON Orders.CustomerID;";

            return $this->db->query($this->sql);
        }

        function selectCustomerOrders($CustomerID) {
            $this->sql = "SELECT * FROM OrderedProducts
                        LEFT JOIN Orders ON OrderedProducts.OrderID
                        LEFT JOIN Variation ON OrderedProducts.VariationID
                        WHERE Orders.CustomerID='$CustomerID';";

            return $this->db->query($this->sql);
        }
    }

?>