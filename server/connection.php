<?php
    require "../functions/general.functions.php";
    require "../utilities/tables.php";

    class Connection {
        public $conn;
        private $connected = FALSE;

        function __construct() {
            $this->connectServer();
        }

        function connectServer() {
            $servername = 'localhost';
            $username = 'root';
            $password = '';
            $port = 3306;

            $this->conn = new mysqli($servername, $username, $password, '', $port);

            if($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->error);
            }

            if($this->connected == FALSE) {
                $this->createDatabase();
                $this->createTables();
                $this->connected = TRUE;
            }

        }

        function killConnection() {
            if(!$this->conn->close()) {
                alert("Failed to close connection!");
            }
        }

        private function createDatabase() {
            $this->query("CREATE DATABASE IF NOT EXISTS foamfusion_db;");
            if(!$this->conn->select_db('foamfusion_db')) {
                alert("Failed to select Database");
            }
        }

        function query($query) {
            $q = null;
            
            if(!($q = $this->conn->query($query))) {
                alert("Failed to load query: " . $query);
            }
            
            return $q;
        }

        private function createTables() {
            global $tables;

            foreach( $tables as $table ) {
                $this->query("CREATE TABLE IF NOT EXISTS " . $table . ";");
            }
        }
    }

?>