<?php
//require '../model/db_books.php';
require 'E:/xampp/htdocs/project1/model/db_books.php';
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

    public function checkoutCookie($params) {
        header('Content-Type:text/json;charset=utf-8');
        if (empty($params['book_id'])) {
            return json_encode(["code"=>400, "message" => "params error"]);
        }
        $getBook = $this->books->getOneById($params["book_id"]);
        if (empty($getBook)) {
            return json_encode(["code"=>400, "message" => "no result"]);
        } else {
            if($getBook["book_quality"] > 0) {
                return json_encode(["code"=>200, "message"=>"Success"]);
            } else {
                return json_encode(["code"=>400, "message"=>"Sold Out"]);
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
            if($getBook["book_quality"] > 0) {
                return json_encode(["result"=>true]);
            } else {
                return json_encode(["result"=>false]);
            }
        } else {
            Header("HTTP/1.0 404 Not Found");
        }
        
    }
}


