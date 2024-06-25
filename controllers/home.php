<?php

namespace SWLH\controller;

class home extends \SWLH\core\controller
{
    static function index()
    {
        static::render("index.php");
    }
}