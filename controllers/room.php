<?php

namespace SWLH\controller;

class room extends \SWLH\core\controller
{
    static function view_rooms() {
        $rooms = \SWLH\model\room::get_by_owner($_GET['owner'] ?? $_SESSION['account_name']);
        echo var_dump($_SESSION['account_name']);
        self::render('view my rooms.php', $rooms);
    }
    static function rooms()
    {
        $rooms = \SWLH\model\room::get_by_owner($_GET['owner'] ?? null);
        foreach ($rooms as &$room) {
            $room['availability'] = ['0' => 'Không', '1' => 'Có'][$room['availability']];
        }
        self::render('rooms.php', $rooms);
    }
    static function all()
    {
        $rooms = \SWLH\model\room::get_all();
        foreach ($rooms as &$room) {
            $room['availability'] = ['0' => 'Không', '1' => 'Có'][$room['availability']];
        }
        self::render('all rooms.php', $rooms);
    }
    static function room()
    {
        $room = \SWLH\model\room::get($_GET['id']);
        if(!$room) self::render('404.php', ['message' => 'Không tìm thấy phòng nào với ID đã cho.']);
        $room['computer_list'] = \SWLH\model\computer::get_by_room($_GET['id']);
        $room['availability'] = ['1' => 'Có', '0' => 'Không'][$room['availability']];
        if($_SESSION['id'] == $room['owner_id']) 
            $room['editable'] = true;
        foreach ($room['computer_list'] as &$computer) {
            $computer['availability'] = ['0' => 'Không', '1' => 'Có'][$computer['availability']];
        }
        self::render('room.php', $room);
    }
    static function new() 
    {
        switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            self::render('new room.php');
            break;
        case 'POST':
            if(\SWLH\model\room::add($_POST))
                header('Location: /rooms');
            $_POST['message'] = 'Thất bại.';
            self::render('new room.php', $_POST); 
            break;
        }
    }
    static function edit() 
    {
        switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            self::render('edit room.php', \SWLH\model\room::get($_GET['id']));
            break;
        case 'POST':
            $_POST['availability'] = ['true' => 1, 'false'=> 0][$_POST['availability']];
            if(\SWLH\model\room::update($_POST))
                header("Location: /room?id=$_POST[id]");
            $_POST['message'] = 'Thất bại.';
            self::render('edit room.php', $_POST); 
            break;
        }
    }
    static function delete()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            self::render('delete room.php', ['id' => $_GET['id']]);
            break;
        case 'POST':
            if($_POST['delete'] != 'true') self::render('404.php', ['message' => 'Có lỗi xảy ra.']);
            \SWLH\model\room::delete($_POST['id']);
            die('<script>alert("Đã xoá thành công."); window.location.href = "/rooms"</script>');
        }
    }
}