<?php

    class Admin {
        private $select;

        function __construct($select) {
            $this->select = $select;
        }

        function displayNavbar($page) {
            global $session, $select;
            include "../components/a.navbar.php";
        }

        function displayAdminProducts() {
            include "../components/a.products.php";
        }

        function displayChart($result, $name, $value) {
            include "../components/a.charts.php";
        }

        function displayAdminOrders() {
            include "../components/a.orders.php";
        }

        function displayAdminDeliveries() {
            include "../components/a.deliveries.php";
        }

        function displayAdminCustomers() {
            include "../components/a.customers.php";
        }

        function displayAdminEmployees() {
            include "../components/a.employees.php";
        }

        function displayAddDeliveries() {
            global $session;
            include "../components/a.addDelivery.php";
        }
    }
?>