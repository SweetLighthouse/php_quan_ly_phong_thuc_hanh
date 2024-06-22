<?php

namespace SWLH\controller;

class home extends \SWLH\core\controller {
    static function index() {
        self::render("index.php");
    }
}