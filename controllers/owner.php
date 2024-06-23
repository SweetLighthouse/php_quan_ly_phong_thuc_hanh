<?php

namespace SWLH\controller;

class owner extends \SWLH\core\controller
{
    static function register()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                self::render('register for owner.php');
                break;
            case 'POST':
                if(!\SWLH\model\owner::validate($_POST['name'], $_POST['password']))
                    self::render('register for owner.php', ['message' => 'Dữ liệu đăng ký không phù hợp.']);

                $new_account = \SWLH\model\owner::add(
                    $_POST['name'], [
                        'password' => $_POST['password'],
                        'birth' => $_POST['birth'],
                        'email' => $_POST['email'],
                        'position' => $_POST['position'],
                        'gender' => $_POST['gender']
                    ]
                );
                if (!$new_account) 
                    self::render('register for owner.php', ['message' => 'Tên tài khoản đã tồn tại.']);

                header('Location: /login');
                break;
        }
    }
}