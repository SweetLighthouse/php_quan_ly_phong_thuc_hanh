<?php

namespace SWLH\core;

abstract class controller
{
    static function render($file_path, array $data = [])
    {
        require_once "./views/$file_path";
        die();
    }
    function __destruct()
    {
        die();
    }
}