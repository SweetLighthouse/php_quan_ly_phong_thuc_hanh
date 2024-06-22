<?php

namespace SWLH\core;

class model {
    static $db;
}
model::$db = new \mysqli('localhost', 'root', '', 'swlh_db');