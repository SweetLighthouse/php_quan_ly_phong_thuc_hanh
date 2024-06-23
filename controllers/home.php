<?php

namespace SWLH\controller;

class home extends \SWLH\core\controller
{

    static function account()
    {
        $account = \SWLH\model\account::find_by_token();
        $gender_map = [
            'male' => 'Nam',
            'female' => 'Nữ',
            'other' => 'Khác'
        ];
        $account['gender'] = $gender_map[$account['gender']];
        self::render('account information.php', $account);
    }
    static function index()
    {
        self::render("index.php");
    }

    static function login()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                self::render('login.php');
                break;
            case 'POST':
                $account = \SWLH\model\account::find($_POST['name']);

                if (!$account)
                    self::render("login.php", ["message" => "Không tìm thấy người dùng nào với tên tài khoản đã cho."]);

                if (!password_verify($_POST["password"], $account['hashed_password']))
                    self::render("login.php", ["message" => "Sai mật khẩu."]);

                // login success. now make a token, cache some data
                $token = bin2hex(random_bytes(32));
                \SWLH\model\account::set_token($account['name'], $token);
                $_SESSION['account_name'] = $account['name'];
                $_SESSION['account_type'] = $account['type'];
                $_SESSION['token'] = $token;
                
                header('Location: /');
                break;
        }
    }

    static function is_login()
    {
        if(!isset($_SESSION['token'])) return false;
        return \SWLH\model\account::find_by_token();
    }

    static function logout()
    {
        \SWLH\model\account::set_token($_SESSION['account_name'], '');
        session_destroy();
    }
}