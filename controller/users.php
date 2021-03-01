<?php
require 'E:/xampp/htdocs/project1/model/db_users.php';
class users {
    private $users;
    public function __construct() {
        $this->users = new db_users();
    }

    public function checkLogin() {
        if (empty($_SESSION['email'])) {
            return false;
        } else {
            return true;
        }
    }

    public function logout() {
        header('Content-Type:text/json;charset=utf-8');
        session_destroy();
        return json_encode(["code"=>200, "message" => "log out success"]);
    }

    public function login() {
        header('Content-Type:text/json;charset=utf-8');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $error = [];
            if (empty($_POST['email'])) $error[] = 'email';
            if (empty($_POST['password'])) $error[] = 'password';
            if (!empty($error)) {
                return json_encode(["code" => 400, "message" => "form error", "detail" => $error]);
            } else {
                $email = $_POST['email'];
                $password = $_POST['password'];
            }
            $result = $this->users->getOneByEmailAndPwd($email, $password);
            if (!empty($result)) {
                session_start();
                $_SESSION['fname'] = $result['first_name'];
                $_SESSION['lname'] = $result['last_name'];
                $_SESSION['email'] = $result['email'];
                $_SESSION['address'] = $result['address'];
                return json_encode(["code" => 200, "message" => "login success"]);
            } else {
                return json_encode(["code" => 400, "message" => "login fail"]);
            }
        }
    }


    public function register() {
        header('Content-Type:text/json;charset=utf-8');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $error = [];
            if (empty($_POST['fname'])) $error[] = 'fname';
            if (empty($_POST['lname'])) $error[] = 'lname';
            if (empty($_POST['email'])) $error[] = 'email';
            if (empty($_POST['address'])) $error[] = 'address';
            if (empty($_POST['password'])) $error[] = 'password';
            if (!empty($error)) {
                return json_encode(["code" => 400, "message" => "form error", "detail" => $error]);
            } else {
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $password = $_POST['password'];
            }
            if ($this->users->insertUser($fname, $lname, $email, $address, $password)) {
                return json_encode(["code" => 200, "message" => "operation success"]);
            } else {
                return json_encode(["code" => 400, "message" => "operation fail"]);
            }
        }
    }
}