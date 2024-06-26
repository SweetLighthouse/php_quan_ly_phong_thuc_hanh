<?php

namespace SWLH\controller;

class computer extends \SWLH\core\controller
{
    static function create()
    {
        if($_SERVER['REQUEST_METHOD'] != 'POST') static::render('404.php', ['message' => 'Sai phương thức truy nhập.']);
        // check if the user has right to add new computer by making sure the logged in user owns the room which is going to be added a new computer
        foreach (\SWLH\model\room::read_by_owner_id($_SESSION['account_id']) as $room) {
            if($_POST['computer_room_id'] == $room['room_id']) {
                \SWLH\model\computer::create($_POST);
                header("Location: /room?id=$_POST[computer_room_id]");
            }
        }
        //if not 
        static::render('404.php', ['message' => 'Bạn không có đủ thẩm quyền để thêm máy vào phòng đã cho.']);
    }
    static function update()
    {
        $id = $_POST['computer_id'] ?? $_GET['id'] ?? '';
        $allowed_to_modify = false;
        if($id == '') static::render('404.php', ['message'=> 'Không thể để trống ID.']);
        $edited_room = \SWLH\model\computer::read($id);
        $rooms = \SWLH\model\room::read_by_owner_id($_SESSION['account_id']);
        foreach ($rooms as $room) if($edited_room['computer_room_id'] == $room['room_id']) $allowed_to_modify = true;
        if(!$allowed_to_modify) static::render('404.php', ['message' => 'Bạn không có đủ thẩm quyền để sửa máy ở vào phòng đã cho.']);
        switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            $data = $edited_room;
            $data['rooms'] = $rooms;
            static::render('update computer.php', $data);
            break;
        case 'POST':
            if(!\SWLH\model\computer::update($_POST)) {
                $_POST['message'] = 'Có lỗi xảy ra.';
                static::render('update computer.php', $_POST);
            }
            header("Location: /room?id=$_POST[computer_room_id]");
            break;
        }
    }
    static function delete()
    {
        if($_SERVER['REQUEST_METHOD'] != 'POST') static::render('404.php', ['message' => 'Sai phương thức truy nhập.']);
        $room_id = \SWLH\model\computer::read($_POST['computer_id'])['computer_room_id'];
        foreach (\SWLH\model\room::read_by_owner_id($_SESSION['account_id']) as $room) {
            if($room_id == $room['room_id']) {
                \SWLH\model\computer::delete($_POST['computer_id']);
                header("Location: /room?id=$room_id");
            }
        }
        static::render('404.php', ['message' => 'Bạn không có đủ thẩm quyền để xoá máy ở vào phòng đã cho.']);
    }
}