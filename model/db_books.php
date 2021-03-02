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

    public function deteleQuantity($bookId, $number) {
        $sql = 'update books set book_quality = ((select book_quality from books where book_id = ?) - ?) where book_id = ?';
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('iii', $iBookId, $iNumber, $iBookId);
        $iBookId = strip_tags($bookId);
        $iNumber = strip_tags($number);

        $stmt->execute();
        $result = $stmt->affected_rows;
        if ($result > 0) {
            $feekBack = true;
        } else {
            $feekBack = false;
        }
        $stmt->close();
        return $feekBack;

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
    
    // public function getAllByIds(array $ids) {
    //     $data = [];
    //     $ids = array_map(function change($v) {
    //         return $this->mysqli->real_escape_string($v);
    //     }, $ids);
    //     $bookIds = implode(',', $ids);
    //     $result = $this->mysqli->query("select * from books where book_id in ($bookIds)");
    //     if ($result->num_rows > 0) {
    //         while($row = $result->fetch_assoc()) {
    //             $data[] = $row;
    //         }
    //     }
        
        
    //     return $data;
    // }

    public function getOneById($id) {
        $data = null;
        $bookId = $this->mysqli->real_escape_string($id);
        $result = $this->mysqli->query("select * from books where book_id = '$bookId' limit 1");
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