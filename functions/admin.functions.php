<?php

    class Admin {
        private $select;
        private $session;

        function __construct($select, $session) {
            $this->select = $select;
            $this->session = $session;
        }

        function displayNavbar($page) {
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
            include "../components/a.addDelivery.php";
        }

        function displayYourDeliveries() {
            include "../components/a.yourDeliveries.php";
        }
    }
?>