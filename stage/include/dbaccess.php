<?php

    class Dbaccess {
        private $_dbHost = 'localhost';
        private $_dbUser = 'root';
        private $_dbPass = '';
        private $_dbName = 'stage';

        private $_statement;
        private $_dbHandler;
        private $_error;

        public function __construct() { //Constructeur
            $conn = 'mysql:host=' . $this->_dbHost . ';dbname=' . $this->_dbName;
            
            try {
                $this->_dbHandler = new PDO($conn, $this->_dbUser, $this->_dbPass); //Mysqli = sql injection
            } catch (PDOException $e) {
                $this->_error = $e->getMessage();
                echo $this->_error;
            }
        }

        //Allows us to write queries
        public function query($sql) {
            $this->_statement = $this->_dbHandler->prepare($sql);
        }

        //Execute the prepared statement
        public function execute() {
            return $this->_statement->execute();
        }

        //Return an array
        public function resultSet() {
            $this->execute();
            return $this->_statement->fetchAll(PDO::FETCH_OBJ);
        }

        public function resultSet2() {
            $this->execute();
            return $this->_statement->fetchAll(PDO::FETCH_ASSOC);
        }

        //Return a specific row as an object
        public function single() {
            $this->execute();
            return $this->_statement->fetch(PDO::FETCH_OBJ);
        }

        public function single2() {
            $this->execute();
            return $this->_statement->fetch(PDO::FETCH_ASSOC);
        }

        //Get's the row count
        public function rowCount() {
            return $this->_statement->rowCount();
        }
    }
    
?>