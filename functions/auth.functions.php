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
        function signup($FirstName, $LastName, $BirthDate, $PhoneNum, $Email, $City, $Barangay, $Street, $PostalCode, $Password, $ConfirmPassword, $Role) {
            $this->Email = $this->select->selectEmail($Email);


            if($this->Email->num_rows > 0 
            || $Password != $ConfirmPassword) {
                return FALSE;
            }

            $this->HashedPassword = password_hash($Password, PASSWORD_BCRYPT);
            
            switch($Role) {
                case 'Customer': $this->insert->insertCustomer($FirstName, $LastName, $BirthDate, $PhoneNum, $Email, $City, $Barangay, $Street, $PostalCode, $this->HashedPassword); break;
                case 'Admin': $this->insert->insertEmployee($FirstName, $LastName, $BirthDate, $PhoneNum, $Email, $City, $Barangay, $Street, $PostalCode, $this->HashedPassword); break;
                default: return FALSE;
            }

            return TRUE;
        }


        function login($Email, $Password, &$Role) {
            $this->Result = $this->select->selectEmail($Email);

            $this->Row = $this->Result->fetch_assoc();
            $this->HashedPassword = $this->Row['Password'];

            if($this->Result->num_rows != 1
                || !password_verify($Password, $this->HashedPassword)) {
                $this->signout();
                return FALSE;
            }

            $Role = $this->Row['Role'];


            if($Role == 'Customer') {
                $result = $this->select->selectCustomerAccount($Email);
                $row = $result->fetch_assoc();
                $this->ID = $row['CustomerID'];
            }
            elseif ($Role == 'Admin') {
                $result = $this->select->selectEmployeeAccount($Email);
                $row = $result->fetch_assoc();
                $this->ID = $row['EmployeeID'];
            }
            else {
                $this->signout();
                return FALSE;
            }

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