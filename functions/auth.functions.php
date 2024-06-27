<?php

    Class Authentication {
        private $Email;
        private $HashedPassword;
        private $Result;
        private $Row;

        private $select;
        private $insert;

        public $ID = null;

        function __construct($db) {
            $this->db = $db;

            $this->insert = new Insert($db);
            $this->select = new Select($db);
        }

        //Returns TRUE if successful, and FALSE if email already found
        function signup($FirstName, $LastName, $MiddleName, $BirthDate, $PhoneNum, $Email, $City, $Barangay, $Street, $PostalCode, $Password, $ConfirmPassword, $Role) {
            $this->Email = $this->select->selectEmail($Email, $Role);


            if($this->Email->num_rows > 0 
            || $Password != $ConfirmPassword) {
                alert("Invalid Signup Attempt!");
                return FALSE;
            }

            $this->HashedPassword = password_hash($Password, PASSWORD_BCRYPT);
            
            switch($Role) {
                case 'Customer': $this->insert->insertCustomer($FirstName, $LastName, $MiddleName, $BirthDate, $PhoneNum, $Email, $City, $Barangay, $Street, $PostalCode, $Password); break;
                case 'Admin': $this->insert->insertEmployee($FirstName, $LastName, $MiddleName, $BirthDate, $PhoneNum, $Email, $City, $Barangay, $Street, $PostalCode, $Password); break;
                default: return FALSE;
            }

            return TRUE;
        }


        function login($Email, $Password, $Role) {
            switch($Role) {
                case 'Customer': $this->Result = $this->select->selectCustomerAccount($Email); break;
                case 'Admin': $this->Result = $this->select->selectEmployeeAccount($Email); break;
                default: return FALSE;
            }

            $this->Row = $this->Result->fetch_assoc();
            $this->HashedPassword = $this->Row['Password'];

            if($this->Result->num_rows != 1
                || !password_verify($Password, $this->HashedPassword)) {
                return FALSE;
            }

            $this->Row = $this->Result->fetch_assoc();
            $this->ID = $this->Row[($Role == 'Customer') ? 'CustomerID' : 'EmployeeID'];
            
            return TRUE;
        }
    }

?>