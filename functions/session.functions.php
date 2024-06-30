<?php

    Class Session {
        public $ID = null;
        public $Role = null;

        private function startSession() {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        }

        function isSessionValid() {
            $this->startSession();
            return (isset($_SESSION["Logged_in"]) && $_SESSION["Logged_in"] === TRUE);
        }

        private function updateVariables() {
            if ($this->isSessionValid()) {
                $this->Role = $_SESSION["Role"];
                $this->ID = $_SESSION["ID"];
            } else {
                $this->ID = null;
                $this->Role = null;
            }
        }

        function beginSession($ID, $Role) {
            $this->startSession();

            $_SESSION["Logged_in"] = TRUE;
            $_SESSION["Role"] = $Role;
            $_SESSION["ID"] = $ID;

            $this->ID = $ID;
            $this->Role = $Role;
        }

        function continueSession() {
            $this->startSession();

            $this->updateVariables();
        }

        function endSession() {
            $this->startSession();

            $_SESSION = array();

            if (session_id() != "" || isset($_COOKIE[session_name()])) {
                setcookie(session_name(), '', time() - 3600, '/');
            }

            $this->updateVariables();

            return session_destroy();
        }
    }

?>