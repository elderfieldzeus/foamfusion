<?php

    class Select {
        //functions that return results of SELECT queries

        private $sql;
        private $db;

        function __construct($db) {
            $this->db = $db;
        }

        function selectEmail($Email, $Role) { //Used to check if the email already exists
            $this->sql = "SELECT Email
                        FROM Account
                        WHERE Email='$Email' && Role='$Role'";

            return $this->db->query($this->sql);
        }

        function selectCustomerAccount($Email) { //Used to check log in info
            $this->sql = "SELECT Customers.CustomerID, Account.Email, Account.Password, Account.Role
                        FROM Customers
                        LEFT JOIN Account ON Customers.AccountID = Account.AccountID
                        WHERE Account.Email='$Email';";

            return $this->db->query($this->sql);
        }

        function selectEmployeeAccount($Email) { //Used to check log in info
            $this->sql = "SELECT Employees.EmployeeID, Account.Email, Account.Password, Account.Role
                        FROM Employees
                        LEFT JOIN Account ON Employees.AccountID = Account.AccountID
                        WHERE Account.Email='$Email';";

            return $this->db->query($this->sql);
        }

        function selectCustomerData($CustomerID) { //Returns Customer Data
            $this->sql = "SELECT * FROM Customers 
                        LEFT JOIN Name ON Customers.NameID = Name.NameID
                        LEFT JOIN Address ON Customers.AddressID = Address.AddressID
                        LEFT JOIN Account ON Customers.AccountID = Account.AccountID
                        WHERE CustomerID='$CustomerID';";

            return $this->db->query($this->sql);
        }

        function selectEmployeeData($EmployeeID) { //Returns Employee Data
            $this->sql = "SELECT * FROM Employees 
                        LEFT JOIN Name ON Employees.NameID = Name.NameID
                        LEFT JOIN Address ON Employees.AddressID = Address.AddressID
                        LEFT JOIN Account ON Employees.AccountID = Account.AccountID
                        WHERE EmployeeID='$EmployeeID';";

            return $this->db->query($this->sql);
        }

        function selectAllOrders() { //Returns a list of orders data
            $this->sql = "SELECT * FROM OrderedProducts
                        LEFT JOIN Orders ON OrderedProducts.OrderID = Orders.OrderID
                        LEFT JOIN Variations ON OrderedProducts.VariationID = Variations.VariationID
                        LEFT JOIN Customers ON Orders.CustomerID = Customers.CustomerID;";

            return $this->db->query($this->sql);
        }

        function selectAllDeliveries() { //Returns a list of deliveries data
            $this->sql = "SELECT *
                        FROM DeliveredProducts
                        LEFT JOIN Deliveries ON DeliveredProducts.DeliveryID = Deliveries.DeliveryID
                        LEFT JOIN Variations ON DeliveredProducts.VariationID = Variations.VariationID
                        LEFT JOIN Employees ON Deliveries.EmployeeID = Employees.EmployeeID
                        LEFT JOIN Orders ON Deliveries.OrderID = Orders.OrderID
                        LEFT JOIN Customers ON Orders.CustomerID = Customers.CustomerID;";

            return $this->db->query($this->sql);
        }

        function selectCustomerOrders($CustomerID) { //Returns orders that belong to a customer
            $this->sql = "SELECT * FROM Orders 
                        LEFT JOIN OrderedProducts ON OrderedProducts.OrderID = Orders.OrderID
                        LEFT JOIN Variations ON OrderedProducts.VariationID = Variations.VariationID
                        WHERE Orders.CustomerID = '$CustomerID';
                        ";

            return $this->db->query($this->sql);
        }

        function selectCustomerDeliveries($CustomerID) { //Returns deliveries that belong to a customer
            $this->sql = "SELECT * FROM Deliveries
                        LEFT JOIN DeliveredProducts ON DeliveredProducts.DeliveryID = Deliveries.DeliveryID
                        LEFT JOIN Variations ON Variations.VariationID = DeliveredProducts.VariationID
                        LEFT JOIN Orders ON Orders.OrderID = Deliveries.DeliveryID
                        WHERE Orders.CustomerID = '$CustomerID';
                        ";

            return $this->db->query($this->sql);
        }

        function selectEmployeeDeliveries($EmployeeID) { //Returns deliveries an employee is assigned to
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