<?php # Script 16.1 - mysqli_oop_connect.php
// This file contains the database access information.
// This file also establishes a connection to MySQL,
// selects the database, and sets the encoding.
// The MySQL interactions use OOP!
// Set the database access information as constants:
class db_connect{
    private $db_user = 'root';
    private $db_password = '';
    private $db_host = 'localhost';
    private $db_name = 'bookstore';
    public $mysqli;
    public $error;
    public function __construct() {
        $this->mysqli = new mysqli($this->db_host, $this->db_user, $this->db_password, $this->db_name);
    }

    public function connectCheck() {
        if ($this->mysqli->connect_error) {
            $this->error = $this->mysqli->connect_error;
            unset($mysqli);
            $result = false;
        } else { // Establish the encoding.
            $this->mysqli->set_charset('utf8');
            $result = true;
        }
        return $result;
    }

    public function showError() {
        if (!empty($this->error)) {
            return $this->error;
        }
    }

    public function closeDb() {
        $this->mysqli->close();
    }

    public function __GET($name) {
        return $this->name;
    }


    
}