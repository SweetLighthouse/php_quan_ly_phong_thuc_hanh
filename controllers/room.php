<?php

namespace SWLH\controller;

class room extends \SWLH\core\controller
{
    static function index()
    {
        if (!isset($_GET['id']))
            self::render('all the room.php', \SWLH\model\room::get_all());
        if ($_GET['id'] == '')
            self::render('404.php', ['message' => "ID không được để trống."]);
        $result = \SWLH\model\room::get($_GET['id']);
        if (!$result)
            self::render('404.php', ['message' => "Không tìm thấy phòng với ID: $_GET[id]."]);
        self::render('view single room.php', $result);
    }
}