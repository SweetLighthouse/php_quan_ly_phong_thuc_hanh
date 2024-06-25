<?php

namespace SWLH\model;

abstract class token extends \SWLH\core\model
{
    static function update($account_id)
    {
        $account_token = bin2hex(random_bytes(30));
        $stmt = static::$conn->prepare('update accounts set account_token = ? where account_id = ? limit 1');
        $stmt->bind_param('ss', $account_token, $account_id);
        $stmt->execute();
        if ($stmt->affected_rows == 0)
            return false;
        $_SESSION['account_token'] = $account_token;
        return true;
    }
    static function read_current_account()
    {
        $stmt = static::$conn->prepare('select * from accounts where account_token = ? limit 1');
        $stmt->bind_param('s', $_SESSION['account_token']);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc() ?? [];
    }
    static function validate()
    {
        $current_account = static::read_current_account();
        if(!$current_account) return false;
        if($_SESSION['account_id'] && $_SESSION['account_id'] != $current_account['account_id']) return false;
        return true;
    }
    static function delete()
    {
        $stmt = static::$conn->prepare('update accounts set account_token = "" where account_token = ? limit 1');
        $stmt->bind_param('s', $_SESSION['account_token']);
        $stmt->execute();
        session_unset();
        if ($stmt->affected_rows == 0) return false;
        return true;
    }
}