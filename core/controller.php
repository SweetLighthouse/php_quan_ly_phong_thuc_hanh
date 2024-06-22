<?php

namespace SWLH\core;

abstract class controller {

    static abstract function index();

    static function render($file_path, array $data = []) {
        require_once "./views/$file_path";
        die();
    }
}