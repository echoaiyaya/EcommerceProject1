<?php
require_once 'db_connect.php';

class db_users {
    private $db;
    private $mysqli;
    public function __construct() {
        $this->db = new db_connect();
        if ($this->db->connectCheck()) {
            $this->mysqli = $this->db->mysqli;
            
        } else {
            die($this->db->showError());
        }
    }

    public function insertUser($fname, $lname, $email, $address, $password) {
        $stmt = $this->mysqli->prepare("insert into users values(default, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssss', $iFname, $iLname, $iEmail, $iAddress, $iPassword);

        $iFname = strip_tags($fname);
        $iLname = strip_tags($lname);
        $iEmail = strip_tags($email);
        $iAddress = strip_tags($address);
        $iPassword = strip_tags($password);

        $stmt->execute();
        $result = $stmt->affected_rows;
        $stmt->close();
        if ($result > 0) {
            return true;
        } else {
           return false;
        }
        
    }

    public function getOneByEmailAndPwd($email, $pwd) {
        $data = null;
        $e = $this->mysqli->real_escape_string($email);
        $w = $this->mysqli->real_escape_string($pwd);
        $result = $this->mysqli->query("select * from users where email = $e and password = $w limit 1");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $data = $row;
            }
        }
        return $data;
    }
}