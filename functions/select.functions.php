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

        function selectAllVariations() { //Returns all products
            $this->sql = "SELECT * FROM Variations
                        LEFT JOIN Products ON Variations.ProductID = Products.ProductID;
                        ";

            return $this->db->query($this->sql);
        }

        function selectProductsSorted() {
            $this->sql = "SELECT ProductName, COUNT(Variations.ProductID) AS NumOfVariations FROM Products
                        LEFT JOIN Variations ON Products.ProductID = Variations.ProductID
                        GROUP BY Products.ProductID
                        ORDER BY NumOfVariations DESC;
                        ";

            return $this->db->query($this->sql);
        }

        function selectProductCount() {
            $this->sql = "SELECT COUNT(Variations.ProductID) AS NumOfVariations FROM Products
                        LEFT JOIN Variations ON Products.ProductID = Variations.ProductID;
                        ";

            return $this->db->query($this->sql);
        }

        function selectOrderStatus() {
            $this->sql = "SELECT OrderStatus, COUNT(OrderID) AS NumOfOrders FROM Orders
                        GROUP BY OrderStatus
                        ORDER BY NumOfOrders;
                    ";

            return $this->db->query($this->sql);
        }

        function selectOrderCount() {
            $this->sql = "SELECT COUNT(OrderID) AS NumOfOrders FROM Orders;
                        ";

            return $this->db->query($this->sql);
        }

        function selectDeliveryStatus() {
            $this->sql = "SELECT DeliveryStatus, COUNT(DeliveryID) AS NumOfDeliveries FROM Deliveries
                        GROUP BY DeliveryStatus
                        ORDER BY NumOfDeliveries;
                    ";

            return $this->db->query($this->sql);
        }

        function selectDeliveryCount() {
            $this->sql = "SELECT COUNT(DeliveryID) AS NumOfDeliveries FROM Deliveries;
                        ";

            return $this->db->query($this->sql);
        }

        function selectCustomerCount() {
            $this->sql = "SELECT COUNT(CustomerID) AS NumOfCustomers FROM Customers;";

            return $this->db->query($this->sql);
        }

        function selectCustomerStatus() {
            $this->sql = "SELECT MONTHNAME(Account.CreatedAt) AS CustomerStatus, COUNT(Customers.CustomerID) AS NumOfCustomers FROM Customers
                        LEFT JOIN Account ON Customers.AccountID = Account.AccountID
                        GROUP BY CustomerStatus
                        ORDER BY NumOfCustomers;";

            return $this->db->query($this->sql);
        }

        function selectTotalSales() {
            $this->sql = "SELECT SUM(TotalPrice) AS TotalSales
                        FROM Deliveries
                        WHERE DeliveryStatus = 'Success';";

            return $this->db->query($this->sql);
        }

        function selectSalesStatus() {
            $this->sql = "SELECT MONTHNAME(DeliveryTime) AS SalesStatus, SUM(TotalPrice) AS TotalSales
                        FROM Deliveries 
                        WHERE DeliveryStatus = 'Success'
                        GROUP BY SalesStatus
                        ORDER BY TotalSales DESC;";

            return $this->db->query($this->sql);
        }

        function selectOrderTable() {
            $this->sql = "SELECT OrderID, OrderStatus, CONCAT(Name.LastName, ', ', Name.FirstName) AS CustomerName, OrderTime
                        FROM Orders
                        LEFT JOIN Customers ON Orders.OrderID = Customers.CustomerID
                        LEFT JOIN Name ON Customers.NameID = Name.NameID;
                        ";
            return $this->db->query($this->sql);
        }
    }

?>