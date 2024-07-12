<?php

namespace SWLH\controller;

class room extends \SWLH\core\controller
{
    static function rooms_not_mine()
    {
        if($_SERVER['REQUEST_METHOD'] != 'GET') static::render('404.php', ['message'=> 'Phương thức truy nhập không hợp lệ.']);
        $rooms = \SWLH\model\room::read_all();
        foreach($rooms as $key => $room) if ($room['room_owner_id'] == $_SESSION['account_id']) unset($rooms[$key]);
        foreach ($rooms as &$room) $room['room_availability'] = ['0' => 'Không', '1' => 'Có'][$room['room_availability']];
        static::render('other rooms.php', $rooms);
    }
    static function rooms_by_owner()
    {
        if($_SERVER['REQUEST_METHOD'] != 'GET') static::render('404.php', ['message'=> 'Phương thức truy nhập không hợp lệ.']);
        $owner_id = $_GET['owner_id'] ?? $_SESSION['account_id'];
        $data = [
            'rooms' => \SWLH\model\room::read_by_owner_id($owner_id),
            'owner' => \SWLH\model\account::read_by_id($owner_id)
        ];
        foreach ($data['rooms'] as &$room) $room['room_availability'] = ['0' => 'Không', '1' => 'Có'][$room['room_availability']];
        if($owner_id == $_SESSION['account_id']) static::render('my rooms.php', $data);
        else static::render('rooms.php', $data);
    }
    static function room()
    {
        if($_SERVER['REQUEST_METHOD'] != 'GET') static::render('404.php', ['message'=> 'Phương thức truy nhập không hợp lệ.']);
        if(!isset($_GET['id'])) static::render('404.php', ['message' => 'Không thể để trống ID phòng.']);
        $data['room'] = \SWLH\model\room::read($_GET['id']);
        if(!$data['room']) static::render('404.php', ['message' => 'Không tìm thấy phòng nào với ID đã cho.']);
        $data['owner'] = \SWLH\model\account::read_by_id($data['room']['room_owner_id']);
        $data['computers'] = \SWLH\model\computer::read_by_room_id($data['room']['room_id']);
        $data['room']['room_availability'] = ['1' => 'Có', '0' => 'Không'][$data['room']['room_availability']];
        foreach ($data['computers'] as &$computer) $computer['computer_availability'] = ['0' => 'Không', '1' => 'Có'][$computer['computer_availability']];
        if($_SESSION['account_id'] == $data['room']['room_owner_id']) static::render('my room.php', $data);
        static::render('room.php', $data);
    }
    static protected function validate(array $data)
    {
        $message = '';
        if(isset($data['room_name']) && $data['room_name'] == '') $message .= 'Không được để trống tên.';
        // if (
        //     !isset($data['room_position']) || 
        //     !isset($data['room_description']) || 
        //     !isset($data['room_availability']) || 
        //     !isset($data['room_owner_id'])
        // ) $message .= 'Không được để trống trường nào. ';
        return $message;
    }
    static function create() 
    {
        if(!isset($_SESSION['account_id'])) 
            static::render('404.php', ['message' => 'Bạn cần đăng nhập để tạo phòng. ']);
        switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            static::render('create room.php');
            break;
        case 'POST':
            $_POST['room_owner_id'] = $_SESSION['account_id'];
            $validate_message = static::validate($_POST);
            if($validate_message) {
                $_POST['message'] = $validate_message;
                static::render('create room.php', $_POST);
            }
            if(!\SWLH\model\room::create($_POST)) {
                $_POST['message'] = 'Có lỗi xảy ra khi tạo phòng mới.';
                static::render('create room.php', $_POST);     
            }
            header('Location: /rooms');
            break;
        default:
            static::render('404.php', ['message' => 'Phương thức truy nhập không hợp lệ.']);
            break;
        }
    }
    static function update() 
    {
        $room_id = $_POST['room_id'] ?? $_GET['id'];
        if (!$room_id) static::render('404.php', ['message' => 'Không thể để trống ID phòng.']);
        $room = \SWLH\model\room::read($room_id);
        if(!$room) static::render('404.php', ['message' => 'Không tìm thấy phòng với ID đã cho.']);
        if ($room['room_owner_id'] != $_SESSION['account_id']) static::render('404.php', ['message' => 'Bạn không có quyền để sửa phòng này. ']);
        $room['room_owner_id'] = $_SESSION['account_id'];
        switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':  
            static::render('update room.php', $room);
            break;
        case 'POST':
            $_POST['room_owner_id'] = $room['room_owner_id'];
            $validate_message = static::validate($_POST);
            if ($validate_message) {
                $_POST['message'] = $validate_message;
                static::render('update room.php', $_POST);
            }
            if (!\SWLH\model\room::update($_POST)) {
                $_POST['message'] = 'Thất bại.';
                static::render('edit room.php', $_POST); 
            }
            // die('<script>javascript:history.back()</script>');
            header("Location: /rooms");
            break;
        }
    }
    static function delete()
    {
        $room_id = $_POST['id'] ?? $_GET['id'];
        if (!$room_id) static::render('404.php', ['message' => 'Không thể để trống ID phòng.']);
        $room = \SWLH\model\room::read($room_id);
        if(!$room) static::render('404.php', ['message' => 'Không tìm thấy phòng với ID đã cho.']);
        if ($room['room_owner_id'] != $_SESSION['account_id']) static::render('404.php', ['message' => 'Bạn không có quyền để xoá phòng này.']);
        switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            static::render('delete room.php', $room);
            break;
        case 'POST':
            if ($_POST['delete'] != 'true') static::render('404.php', ['message' => 'Có lỗi xảy ra khi xoá phòng có ID ' . $room_id]);
            \SWLH\model\room::delete($_POST['id']);
            die("<script>alert('Xoá thành công phòng có ID $room_id.'); window.location.href = '/rooms'</script>");
        }
    }
}