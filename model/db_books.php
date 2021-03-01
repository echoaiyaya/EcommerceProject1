<?php
require_once 'db_connect.php';

class db_books {
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

    public function getAll() {
        $data = [];
        $sql = 'select * from books';
        $result = $this->mysqli->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function getOneById($id) {
        $data = null;
        $bookId = $this->mysqli->real_escape_string($id);
        $result = $this->mysqli->query("select * from books where book_id = $bookId");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $data = $row;
            }
        }
        
        
        return $data;
    }

    public function __destruct() {
        $this->db->closeDb();
    }
}