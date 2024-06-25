<?php

namespace SWLH\controller;

class computer extends \SWLH\core\controller
{
    static function new()
    {
        // check if the user has right to add new computer by making sure the logged in user owns the room which is going to be added a new computer
        foreach (\SWLH\model\room::get_by_owner() as $room) {
            if($_POST['room_id'] == $room['id']) {
                \SWLH\model\computer::add($_POST);
                header("Location: /room?id=$_POST[room_id]");
            }
        }
        //if not 
        self::render('404.php', ['message' => 'Bạn không có đủ thẩm quyền để thêm máy vào phòng đã cho.']);
    }
    static function right_to_modify($id)
    {
        
    }
    static function edit()
    {
        $id = $_POST['id'] ?? $_GET['id'];

        $allowed_to_modify = false;
        $room_id = \SWLH\model\computer::get($id)['room_id'];
        foreach (\SWLH\model\room::get_by_owner() as $room) {
            if($room_id == $room['id']) $allowed_to_modify = true;
        }
        if(!$allowed_to_modify) self::render('404.php', ['message' => 'Bạn không có đủ thẩm quyền để sửa máy ở vào phòng đã cho.']);
        switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            self::render('edit computer.php', \SWLH\model\computer::get($id));
            break;
        case 'POST':
            if(!\SWLH\model\computer::update($_POST)) {
                $_POST['message'] = 'Có lỗi xảy ra.';
                self::render('edit computer.php', $_POST);
            }
            $redirect = \SWLH\model\computer::get($id)['room_id'];
            header("Location: /room?id=$redirect");
            break;
        }
    }
    static function delete()
    {
        if($_SERVER['REQUEST_METHOD'] != 'POST') 
            self::render('404.php', ['message' => 'Sai phương thức truy nhập.']);
        $room_id = \SWLH\model\computer::get($_POST['id'])['room_id'];
        foreach (\SWLH\model\room::get_by_owner() as $room) {
            if($room_id == $room['id']) {
                \SWLH\model\computer::delete($_POST['id']);
                header("Location: /room?id=$room_id");
            }
        }
        self::render('404.php', ['message' => 'Bạn không có đủ thẩm quyền để xoá máy ở vào phòng đã cho.']);
    }
}