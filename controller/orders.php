<?php
require $_SERVER['DOCUMENT_ROOT'] . '/project1/model/db_orders.php';
require $_SERVER['DOCUMENT_ROOT'] . '/project1/model/db_books.php';

class orders {
    private $orders;
    public function __construct() {
        $this->orders = new db_orders();
    }

    public function getOrdersFromSession() {
        if (empty($_SESSION['email'])) {
            header('Location: http://'.$_SERVER['SERVER_NAME'].'/project1/view/html/jump.php');
        }
        $result = $this->orders->getOrdersByUserId($_SESSION['id']);
        return $result;
    }


    public function getOrderBooks() {
        header('Content-Type:text/json;charset=utf-8');
        if ($_SERVER["REQUEST_METHOD"] = "GET") {
            if (empty($_GET["orderId"])) return json_encode(['code' => 400, 'message' => 'params error']);
            session_start();
            if (empty($_SESSION['id'])) return json_encode(['code' => 400, 'message' => 'no login']);
            if (!$this->orders->checkOrderBelongToUser($_SESSION['id'], $_GET["orderId"])) return json_encode(['code' => 400, 'message' => 'order error']);

            $result = $this->orders->getOrderBooksByOrderId($_GET["orderId"]);
            if (!empty($result)) {
                foreach ($result as $key => $value) {
                    $result[$key]['itemsPrice'] = $value['quanlity'] * $value['book_price'];
                }
            }
            return json_encode(['code' => 200, 'message' => 'query successfully', 'detail' => $result]);
        }
    } 

    public function comfirmOrders() {
        header('Content-Type:text/json;charset=utf-8');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            session_start();
            if (empty($_SESSION['email'])) return json_encode(['code' => 400, 'message' => 'no login']);
            if (empty($_POST['books']) || $_POST['books'] == "[]") return json_encode(["code" => 400, "message" => "miss books"]);
            if (empty($_POST['fname']) || $_POST['fname'] == 'undefined') return json_encode(["code" => 400, "message" => "miss first name"]); 
            if (empty($_POST['lname']) || $_POST['lname'] == 'undefined') return json_encode(["code" => 400, "message" => "miss last name"]); 
            if (empty($_POST['email']) || $_POST['email'] == 'undefined') return json_encode(["code" => 400, "message" => "miss email"]); 
            if (empty($_POST['address']) || $_POST['address'] == 'undefined') return json_encode(["code" => 400, "message" => "miss address"]); 
            if (empty($_POST['price']) || $_POST['price'] == 0) return json_encode(["code" => 400, "message" => "miss price"]); 
            if (empty($_POST['tax']) || $_POST['tax'] == 0) return json_encode(["code" => 400, "message" => "miss tax"]); 
            if (empty($_POST['totalPrice']) || $_POST['totalPrice'] == 0) return json_encode(["code" => 400, "message" => "miss total price"]); 
            if (empty($_POST['payMethod']) || $_POST['payMethod'] == 'undefined') return json_encode(["code" => 400, "message" => "miss pay mothod"]); 
            if ($_POST['payMethod'] == "credit") {
                if (empty($_POST['credit']) || $_POST['credit'] == 'undefined') return json_encode(["code" => 400, "message" => "miss credit card number"]); 
                if (empty($_POST['expir']) || $_POST['expir'] == 'undefined') return json_encode(["code" => 400, "message" => "miss expir"]); 
                if (empty($_POST['cvv']) || $_POST['cvv'] == 'undefined') return json_encode(["code" => 400, "message" => "miss cvv"]);                 
            }
            //var_dump($_POST);die;
            $result = $this->orders->insertOrder($_SESSION['id'], $_POST['fname'],$_POST['lname'],$_POST['email'],$_POST['address'], $_POST['price'], $_POST['tax'], $_POST['totalPrice'], $_POST['payMethod']);
            if ($result) {
                $books = new db_books();
                foreach (json_decode($_POST['books']) as $key => $value) {
                    $this->orders->insertOrderBooks($result, $value->bookid, $value->quantity);       
                    $books->deteleQuantity($value->bookid, $value->quantity);
                }
                unset($_SESSION['checkout']);
                return json_encode(['code'=>200, 'message' => 'submit completely']);
            } else {
                return json_encode(['code'=>400, 'message' => 'any error']);
            }
            

        }       
    }
}