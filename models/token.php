<?php

namespace SWLH\model;

abstract class token extends \SWLH\core\model
{
    static function set($user_id)
    {
        $token = bin2hex(random_bytes(30));
        $stmt = static::$conn->prepare('update users set token = ? where id = ? limit 1');
        $stmt->bind_param('ss', $token, $user_id);
        $stmt->execute();
        if ($stmt->affected_rows == 0)
            return false;
        $_SESSION['token'] = $token;
        return true;
    }
    static function get_current_user()
    {
        $stmt = static::$conn->prepare('select * from users where token = ? limit 1');
        $stmt->bind_param('s', $_SESSION['token']);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc() ?? [];
    }
    static function validate()
    {
        $user = static::get_current_user();
        if(!$user) return false;
        if($_SESSION['id'] && $_SESSION['id'] != $user['id']) return false;
        return true;
    }
    static function clear()
    {
        $stmt = static::$conn->prepare('update users set token = "" where token = ? limit 1');
        $stmt->bind_param('s', $_SESSION['token']);
        $stmt->execute();
        if ($stmt->affected_rows == 0)
            return false;
        return true;
    }
}