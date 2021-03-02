<?php
//require '../model/db_books.php';
require $_SERVER['DOCUMENT_ROOT'] . '/project1/model/db_books.php';
require 'users.php';

class books {
    private $books;
    public function __construct() {
        $this->books = new db_books();
    }

    public function books() {
        $getBooks = $this->books->getAll();
        //var_dump($getBooks);
        foreach($getBooks as $k => $value) {
            $str = $value["book_description"];
            if (strlen($str) > 150) {
                $value["book_description"] = substr($value["book_description"], 0, 100) . '...';
            }
            
            $getBooks[$k] = $value;
        }
        return $getBooks;
    }

    public function getBookFromSession() {
        $data = [];
        if (!empty($_SESSION['checkout'])) {
            $carts = $_SESSION['checkout'];
            foreach ($carts as $key => $value) {
                $result = $this->books->getOneById($value['book_id']);
                $result['quantity'] = $value['quanlity'];
                $data[] = $result;
            }
            return $data;
        } else {
            return $data;
        }
    }

    public function removeCheckOutBook($params) {
        header('Content-Type:text/json;charset=utf-8');
        if (empty($params['bookid'])) return json_encode(["code"=>400, "message" => "miss bookid"]); 
        session_start();
        if (!empty($_SESSION['checkout'])) {
            $price = 0;
            foreach ($_SESSION['checkout'] as $key => $value) {
                if ($value['book_id'] == $params['bookid']) {
                    array_splice($_SESSION['checkout'], $key, 1);
                } else {
                    $result = $this->books->getOneById($value['book_id']);
                    $price += (int)$value['quanlity'] * $result['book_price'];
                }
            }
            $price = round($price, 2);
            $tax = round($price * 0.13, 2);
            $total = $price + $tax;
            $priceData = ["price" => $price, "tax" => $tax, "total" => $total];
            return json_encode(["code"=>200, "message" => "operation complete", "price" => $priceData]);
        } else {
            return json_encode(["code"=>400, "message" => "no data"]);
        }
    }


    public function checkoutSession($params) {
        header('Content-Type:text/json;charset=utf-8');
        $users = new users();
        if(!$users->checkLogin()) {
            return json_encode(["code"=>400, "message" => "plase Sign in!"]);
        }
        if (empty($params['book_id']) && empty($params['quanlity'])) {
            return json_encode(["code"=>400, "message" => "params error"]);
        }
        $getBook = $this->books->getOneById($params["book_id"]);
        if (empty($getBook)) {
            return json_encode(["code"=>400, "message" => "no result"]);
        } else {
            if($getBook["book_quality"] > 0 && $params["quanlity"] <= $getBook["book_quality"]) {
                if (!empty($_SESSION['checkout'])) {
                    $inCheckOut = false;
                    foreach($_SESSION['checkout'] as $k => $value) {
                        if ($value['book_id'] == $params['book_id']) {
                            $value['quanlity'] = (int)$value['quanlity'] + (int)$params['quanlity'];
                            if ($value['quanlity'] > $getBook["book_quality"]) return json_encode(["code"=>400, "message"=>"quantity error"]);
                            $_SESSION['checkout'][$k] = $value;
                            $inCheckOut = true;
                        }
                    }
                    if (!$inCheckOut) {
                        $_SESSION['checkout'][] = ["book_id" => $params["book_id"], "quanlity" => $params['quanlity']];
                    }
                } else {
                    $_SESSION['checkout'][] = ["book_id" => $params["book_id"], "quanlity" => $params['quanlity']];
                }
                //var_dump($params);
                return json_encode(["code"=>200, "message"=>"Success"]);
            } else {
                return json_encode(["code"=>400, "message"=>"quantity error"]);
            }
        }

    }

    public function checkSoldOut($params) {
        if (empty($params['book_id'])) {
            Header("HTTP/1.0 404 Not Found");
        }
        $getBook = $this->books->getOneById($params["book_id"]);
        if (!empty($getBook)) {
            header('Content-Type:text/json;charset=utf-8');
            if($getBook["book_quanlity"] > 0) {
                return json_encode(["result"=>true]);
            } else {
                return json_encode(["result"=>false]);
            }
        } else {
            Header("HTTP/1.0 404 Not Found");
        }
        
    }
}


