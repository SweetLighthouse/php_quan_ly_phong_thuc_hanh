<?php

namespace SWLH\controller;

class user extends \SWLH\core\controller
{
    static function index() {
        die("haven't implemented user.index yet.");
    }

    static function islogin() {
        return isset($_SESSION["user_token"]);
    }

    static function user_name() {
        return $_SESSION["user_token"]['user_name'] ?? '';
    }

    static function login()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                self::render('login.php');
                break;
            case 'POST':
                $result = \SWLH\model\user::find($_POST['user_name'], $_POST['user_password']);
                switch ($result['message']) {
                    case \SWLH\model\USER_FIND::USER_NOT_FOUND:
                        self::render("login.php", ["message" => "User not found.", "user_name" => $_POST["user_name"]]);
                        break;
                    case \SWLH\model\USER_FIND::PASSWORD_NOT_MATCH:
                        self::render("login.php", ["message" => "Password not match.", "user_name" => $_POST["user_name"]]);
                        break;
                    case \SWLH\model\USER_FIND::FOUND:
                        $_SESSION['user_token'] = ['user_name' => $result['user_name'], 'user_hashed_password' => $result['user_hashed_password']];
                        header('Location: /');
                        break;
                }
                break;
            default:
                die('unsupported method.');
        }
    }
    static function logout()
    {
        unset($_SESSION['user_token']);
        header('Location: /');
    }

    static function register()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                self::render('register.php');
                break;
            case 'POST':
                $result = \SWLH\model\user::add($_POST['user_name'], $_POST['user_password'], ['user_age' => $_POST['user_age']]);
                switch ($result) {
                    case \SWLH\model\USER_ADD::ALREADY_EXIST:
                        self::render('register.php', ['message' => 'Username đã tồn tại.', 'user_name' => $_POST['user_name']]);
                        break;
                    case \SWLH\model\USER_ADD::DATA_MALFORMED:
                        self::render('register.php', ['message'=> 'Dữ liệu đăng ký không phù hợp.', 'user_name' => $_POST['user_name']]);
                        break;
                    case \SWLH\model\USER_ADD::SUCCESS:
                        $new_user = \SWLH\model\user::find($_POST['user_name'], $_POST['user_password']);
                        $_SESSION['user_token'] = ['user_name' => $new_user['user_name'], 'user_hashed_password' => $new_user['user_hashed_password']];
                        header('Location: /');
                    }
        }
    }
}