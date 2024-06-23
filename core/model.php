<?php

namespace SWLH\core;

abstract class model {
    static $conn;
}
model::$conn = new \mysqli('localhost', 'root', '', 'swlh_db');