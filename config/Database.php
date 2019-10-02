<?php
    class Database {
        // Database Parameters    
        private $host = 'localhost';
        private $dbname = 'phpapis';
        private $username = 'root';
        private $password = '';
        private $conn;

        /** Provides (returns) connection to database when called by an object of this class.
         * Used within the classes of the "models" folder.
         * */ 
        public function connect() {
            $this->conn = null;
            // Exception handling in case connection results in an error due incorrect DB params or any other issue.
            try{
                $this->conn = new PDO("mysql:host=" .  $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);

                //In order to enable exception within PDO
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                echo "Could not connect to the database: " . $e->getMessage();
            }

            return $this->conn;
        }
}