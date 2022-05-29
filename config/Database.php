<?php
    class Database 
    {
        //db params
        private $host = 'spryrr1myu6oalwl.chr7pe7iynqr.eu-west-1.rds.amazonaws.com';
        private $db_name = 'eab5ml55160q25ur';
        private $username = 'fpq2pg7dlztkcf86';
        private $password = 'c2wp7t7li6xsu65n';
        private $conn;

        //DB connect
        public function connect()
        {
            $this->conn = null;

            try
            {
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);

                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e)
            {
                echo 'Connection error: ' . $e->getMessage();
            }
            return $this->conn;
        }
    }
?>