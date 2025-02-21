<?php 
    try {
        $pdoConnection = new PDO("mysql:host=localhost;dbname=php_ecommerce;", "root", "");
    } catch (PDOException $e) {
        die("Failed to connect to database:" . $e->getMessage());
    }
?>