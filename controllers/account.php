<?php

namespace SWLH\controller;

class account extends \SWLH\core\controller
{
    static function get_all()
    {
        static::render('accounts.php', \SWLH\model\account::read_all());
    }
    static function login()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            static::render('login.php');
            break;
        case 'POST':
            $account = \SWLH\model\account::read_by_name($_POST['account_name']);
            if (!$account) static::render('login.php', [
                'account_name' => $_POST['account_name'],
                'message' => 'Không tìm thấy người dùng nào với tên tài khoản đã cho.'
            ]);
            if (!password_verify($_POST['account_password'], $account['account_hashed_password'])) static::render('login.php', [
                'account_name' => $_POST['account_name'],
                'message' => 'Sai mật khẩu.'
            ]);
            // authenticated success, now login
            \SWLH\model\token::update($account['account_id']);
            $_SESSION['account_name'] = $account['account_name'];
            $_SESSION['account_id'] = $account['account_id'];
            // die(var_dump($_SESSION));
            // save id to session, so we dont have to seach in db every time we need to display header with user's id.
            header('Location: /');
            break;
        }
    }
    static protected function validate(array $data)
    {
        $message = '';
        if (
            !isset($data['account_name']) || 
            !isset($data['account_password']) || 
            !isset($data['account_birth']) || 
            !isset($data['account_full_name']) || 
            !isset($data['account_email']) || 
            !isset($data['account_position']) || 
            !isset($data['account_gender'])
        ) $message .= 'Không được để trống trường nào. ';
        if (!preg_match('/[0-9a-zA-Z-_]{3,60}/', $data['account_name'])) $message .= 'Tên tài khoản không đúng cú pháp. ';
        if (!preg_match('/[0-9a-zA-Z-_]{3,60}/', $data['account_password'])) $message .= 'Mật khẩu không đúng cú pháp. ';
        if ($data['account_birth'] < "1900-01-01" || $data['account_birth'] > date('Y-m-d')) $message .= 'Ngày sinh có vấn đề. ';
        if (!filter_var($data['account_email'], FILTER_VALIDATE_EMAIL)) $message .= 'Email không hợp lệ. ';
        return $message;
    }
    static function register()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            static::render('register.php');
            break;
        case 'POST':
            $validate_message = static::validate($_POST);
            $send_back_data = $_POST; unset($send_back_data['password']);

            if ($validate_message) {
                $send_back_data['message'] = $validate_message;
                static::render('register.php', $send_back_data);
            }
            // validate success, now register
            if (!\SWLH\model\account::create($_POST)) {
                $send_back_data['message'] = 'Có lỗi không xác định khi tạo tài khoản. ';
                static::render('register.php', $send_back_data);
            }
            
            // register success: auto login
            $account = \SWLH\model\account::read_by_name($_POST['account_name']);
            \SWLH\model\token::update($account['account_id']);
            $_SESSION['account_name'] = $account['account_name'];
            $_SESSION['account_id'] = $account['account_id'];
            header('Location: /');
            break;
        }
    }
    static function logout()
    {
        \SWLH\model\token::delete();
        session_destroy(); // might be redundant since there is a session_unset inside token::delete
        header('Location: /login');
    }
    static function read()
    {
        $account_id = $_GET['id'] ?? '';
        if ($account_id) $account = \SWLH\model\account::read_by_id($account_id);
        else $account = \SWLH\model\token::read_current_account();
        if(!$account) static::render('404.php', ['message'=> 'Không tìm thấy người dùng với ID tương ứng.']);
        $account['account_gender'] = ['male' => 'Nam', 'female' => 'Nữ', 'other' => 'Khác'][$account['account_gender']];
        if ($account['account_token'] == $_SESSION['account_token']) static::render('my account.php', $account);
        static::render('account.php', $account);
    }
    static function update()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
        case "GET":
            static::render('update my account.php', \SWLH\model\token::read_current_account());
            break;
        case 'POST':
            $current_password = $_POST['account_password']; unset($_POST['account_password']);
            $new_password = $_POST['new_account_password']; unset($_POST['new_account_password']);
            $current_account = \SWLH\model\token::read_current_account();

            // authenticate with current password
            if (!password_verify($current_password, $current_account['account_hashed_password'])) {
                $_POST['message'] = 'Sai mật khẩu hiện tại. ';
                static::render('update my account.php', $_POST);
            }
            // validate
            $_POST['account_name'] = $_POST['new_account_name'] != '' ? $_POST['new_account_name'] : $current_account['account_name'];
            $_POST['account_password'] = $new_password != '' ? $new_password : $current_password;
            $validate_message = static::validate($_POST);
            if ($validate_message) {
                $_POST['message'] = $validate_message;
                static::render('update my account.php', $_POST);
            }

            // now try to update
            $_POST['account_token'] = $_SESSION['account_token'];
            if (!\SWLH\model\account::update($_POST)) {
                $_POST['message'] = 'Có lỗi xảy ra. Cập nhật thất bại. ';
                static::render('update my account.php', $_POST);
            }

            // update success, now refresh some value 
            $account = \SWLH\model\token::read_current_account();
            $_SESSION['account_name'] = $account['account_name'];
            $_SESSION['account_id'] = $account['account_id'];
            header('Location: /account');
            break;
        }
    }
    static function delete() 
    {
        switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            static::render('delete my account.php');
            break;
        case 'POST':
            $account = \SWLH\model\token::read_current_account();
            $sent_password = $_POST['account_password'] != '' ? $_POST['account_password'] : '';
            if(password_verify($sent_password, $account['account_hashed_password'])) {
                \SWLH\model\account::delete();
                session_unset();
                die('<script>alert("Đã xoá thành công."); window.location.href = "/login"</script>');
            } else {
                die('<script>alert("Sai mật khẩu."); window.location.href = "/account"</script>');
            }
        }
    }
}