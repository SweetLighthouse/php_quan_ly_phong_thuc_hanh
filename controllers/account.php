<?php

namespace SWLH\controller;

class account extends \SWLH\core\controller
{
    static function get_all()
    {
        self::render('users.php', \SWLH\model\user::get_all());
    }
    static function login()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            self::render('login.php');
            break;
        case 'POST':
            $account = \SWLH\model\user::get($_POST['name']);
            if (!$account)
                self::render('login.php', ['message' => 'Không tìm thấy người dùng nào với tên tài khoản đã cho.']);

            if (!password_verify($_POST["password"], $account['hashed_password']))
                self::render('login.php', ['message' => 'Sai mật khẩu.']);

            // login success
            \SWLH\model\token::set($account['id']);
            $_SESSION['name'] = $account['name'];
            $_SESSION['id'] = $account['id'];
            // save id to session, so we dont have to seach in db every time we need to display header with user's id.
            header('Location: /');
            break;
        }
    }
    static function register()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            self::render('register.php');
            break;
        case 'POST':
            if (!\SWLH\model\user::validate($_POST['name'], $_POST['password']))
                self::render('register.php', ['message' => 'Dữ liệu đăng ký không phù hợp.']);

            $type = $_POST['type'];
            unset($_POST['type']);
            if (!\SWLH\model\user::add($_POST))
                self::render('register.php', ['message' => 'Tên tài khoản đã tồn tại.']);

            header('Location: /login');
            break;
        }
    }
    static function logout()
    {
        \SWLH\model\token::clear();
        session_destroy();
    }
    static function view()
    {
        if (isset($_GET["name"])) $account = \SWLH\model\user::get($_GET['name']);
        else $account = \SWLH\model\token::get_current_user();
        if(!$account) self::render('404.php', ['message'=> 'Không tìm thấy người dùng với tên tương ứng.']);
        $account['gender'] = ['male' => 'Nam', 'female' => 'Nữ', 'other' => 'Khác'][$account['gender']];
        if ($account['token'] == $_SESSION['token']) $account['editable'] = true;
        self::render('account.php', $account);
    }
    static function edit()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
        case "GET":
            self::render('edit account.php', \SWLH\model\token::get_current_user());
            break;
        case 'POST':
            if (\SWLH\model\user::update($_POST)) header('Location: /account');
            $_POST['message'] = 'Có lỗi xảy ra. Cập nhật thất bại.';
            self::render('edit account.php', $_POST);
        }
    }
    static function delete() 
    {
        switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            self::render('delete account.php');
            break;
        case 'POST':
            if($_POST['delete'] != 'true') self::render('404.php', ['message' => 'Có lỗi xảy ra.']);
            \SWLH\model\user::delete();
            die('<script>alert("Đã xoá thành công."); window.location.href = "/login"</script>');
        }
    }
}