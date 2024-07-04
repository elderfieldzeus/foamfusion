<?php

    class Admin {
        private $select;

        function __construct($select) {
            $this->select = $select;
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
    }
?>