<?php
namespace App\Model;

use PDO;
use PDOException;

class DatabaseModel {
    private $dbhost = DB_HOST;
    private $dbname = DB_NAME;
    private $dbuser = DB_USER;
    private $dbpass = DB_PASS;
    private $conn;
    private $stmt;

    public function __construct() { 
        try {
            $this->conn = new PDO("mysql:host=".$this->dbhost.";dbname=".$this->dbname, $this->dbuser, $this->dbpass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            // $this->conn = null;
        }
    }

    // SELECT

    public function get_all($sql) {
        $sql_args = array_slice(func_get_args(), 1);
        try {
            $this->stmt = $this->conn->prepare($sql);
            $this->stmt->execute($sql_args);
            return $this->stmt->fetchAll();
        } catch(PDOException $e) {
            // Log or handle the exception according to your application's needs
            throw $e;
        }
    }

    // SELECT 1 

    public function get_one($sql) {
        $sql_args = array_slice(func_get_args(), 1);
        $this->stmt = $this->conn->prepare($sql);
        $this->stmt->execute($sql_args);
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    // update , insert, delete

    public function CRUD($sql) {
        $sql_args = array_slice(func_get_args(), 1);
        $this->stmt = $this->conn->prepare($sql);
        $this->stmt->execute($sql_args);
    }

    // lay gia tri 

    public function get_value($sql) {
        $sql_args = array_slice(func_get_args(), 1);
        $this->stmt = $this->conn->prepare($sql);
        $this->stmt->execute($sql_args);
        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);
        return array_values($row)[0];
    }
    public function lastInsertId() {
        return $this->conn->lastInsertId();
    }
}