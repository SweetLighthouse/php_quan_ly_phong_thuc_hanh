<?php

namespace SWLH\model;

abstract class account extends \SWLH\core\model
{
    // anonymous user can add new account (register) or get name (login)
    static function create(array $data = [])
    {
        $account_hashed_password = password_hash($data['account_password'], PASSWORD_DEFAULT);
        $stmt = static::$conn->prepare('insert into accounts (account_name, account_hashed_password, account_full_name, account_birth, account_email, account_position, account_gender) values (?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param(
            'sssssss',
            $data['account_name'],
            $account_hashed_password,
            $data['account_full_name'],
            $data['account_birth'],
            $data['account_email'],
            $data['account_position'],
            $data['account_gender']
        );
        return $stmt->execute();
    }
    static function update(array $data = [])
    {
        $account_hashed_password = password_hash($data['account_password'], PASSWORD_DEFAULT);
        $stmt = static::$conn->prepare('update accounts set account_name = ?, account_hashed_password = ?, account_full_name = ?, account_birth = ?, account_email = ?, account_position = ?, account_gender = ? where account_token = ? limit 1');
        $stmt->bind_param(
            'ssssssss',
            $data['account_name'],
            $account_hashed_password,
            $data['account_full_name'],
            $data['account_birth'],
            $data['account_email'],
            $data['account_position'],
            $data['account_gender'],
            $data['account_token']
        );
        return $stmt->execute();
    }
    static function delete()
    {
        $stmt = static::$conn->prepare('delete from accounts where account_token = ? limit 1');
        $stmt->bind_param('s', $_SESSION['account_token']);
        return $stmt->execute();
    }
    static function read_by_name($account_name)
    {
        $stmt = static::$conn->prepare('select * from accounts where account_name = ? limit 1');
        $stmt->bind_param('s', $account_name);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    static function read_by_id($account_id)
    {
        $stmt = static::$conn->prepare('select * from accounts where account_id = ? limit 1');
        $stmt->bind_param('s', $account_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    static function read_all()
    {
        return static::$conn->query('select * from accounts')->fetch_all(MYSQLI_ASSOC);
    }
    // user can only do update, delete account on their own account.
    // I assumed they already logged in. 
}