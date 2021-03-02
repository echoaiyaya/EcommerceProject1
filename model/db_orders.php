<?php
require_once 'db_connect.php';

class db_orders {
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

    public function checkOrderBelongToUser($userId, $orderId) {
        $orderId = $this->mysqli->real_escape_string($orderId);
        $userId = $this->mysqli->real_escape_string($userId);
        $sql = "select order_id from orders where user_id = $userId and order_id = $orderId limit 1";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getOrderBooksByOrderId($orderId) {
        $data = [];
        $orderId = $this->mysqli->real_escape_string($orderId);
        $sql = "select o.quanlity, b.book_name, b.book_img, b.book_price from order_books o join books b using(book_id) where o.order_id = $orderId";
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

    public function getOrdersByUserId($userId) {
        $data = [];
        $userId = $this->mysqli->real_escape_string($userId);
        $sql = "select * from orders where user_id = '$userId' order by public_time desc";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            //var_dump($data);
            return $data;
        } else {
            return null;
        }
    }

    public function insertOrderBooks($orderId, $bookId, $quanlity) {
        $stmt = $this->mysqli->prepare("insert into order_books values(default, ?, ?, ?)");
        $stmt->bind_param('iii', $iBookId, $iOrderId, $iQuanlity);

        $iBookId = strip_tags($bookId);
        $iOrderId = strip_tags($orderId);
        $iQuanlity = strip_tags($quanlity);

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

    public function insertOrder($userId, $fname, $lname, $email, $address, $price, $tax, $totalPrice, $payMethod) {
        $stmt = $this->mysqli->prepare("insert into orders values(default, ?, ?, ?, ?, ?, ?, ?, ?, ?, default)");
        $stmt->bind_param('issssddds', $iUserId, $iFname, $iLname, $iEmail, $iAddress, $iPrice, $iTax, $iTotalPrice, $iPayMethod);

        $iUserId = strip_tags($userId);
        $iFname = strip_tags($fname);
        $iLname = strip_tags($lname);
        $iEmail = strip_tags($email);
        $iAddress = strip_tags($address);
        $iPrice = strip_tags($price);
        $iTax = strip_tags($tax);
        $iTotalPrice = strip_tags($totalPrice);
        $iPayMethod = strip_tags($payMethod);

        $stmt->execute();
        $result = $stmt->affected_rows;
        if ($result > 0) {
            $insertId = $stmt->insert_id;
            
            
            $feekBack = $insertId;
        } else {
            $feekBack = false;
        }
        $stmt->close();
        return $feekBack;
        
    }
}