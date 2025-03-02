<?php
class Database_Conntections {
    private $host = "localhost";
    private $db_name = "ecommerce_db";
    private $username = "root";
    private $password = "";
    private $connection;

    public function connect() {
        try {
            $this->connection = new PDO(
                "mysql:host=$this->host;dbname=$this->db_name",
                $this->username,
                $this->password
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->connection;
        } catch (PDOException $error) {
            echo "Connection failed: " . $error->getMessage();
            return null;
        }
    }
}
?>