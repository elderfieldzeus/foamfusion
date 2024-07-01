<?php

    Class Authentication {
        private $Email;
        private $HashedPassword;
        private $Result;
        private $Row;

        private $db;
        private $select;
        private $insert;
        private $session;

        public $ID = null;

        function __construct($db, $session) {
            $this->db = $db;
            $this->session = $session;

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
                case 'Customer': $this->insert->insertCustomer($FirstName, $LastName, $MiddleName, $BirthDate, $PhoneNum, $Email, $City, $Barangay, $Street, $PostalCode, $this->HashedPassword); break;
                case 'Admin': $this->insert->insertEmployee($FirstName, $LastName, $MiddleName, $BirthDate, $PhoneNum, $Email, $City, $Barangay, $Street, $PostalCode, $this->HashedPassword); break;
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

            $this->ID = $this->Row[($Role == 'Customer') ? 'CustomerID' : 'EmployeeID'];

            //Set session
            $this->session->beginSession($this->ID, $Role);
            
            return TRUE;
        }

        function signout() {
            //End session
            return $this->session->endSession();
        }
    }

?>