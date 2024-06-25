<?php

namespace SWLH\model;

abstract class user extends \SWLH\core\model
{
    // anonymous user can add new account (register) or get name (login)
    static function add(array $data = [])
    {
        $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
        $stmt = static::$conn->prepare('insert into users (name, hashed_password, full_name, birth, email, position, gender) values (?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param(
            'sssssss',
            $data['name'],
            $hashed_password,
            $data['full_name'],
            $data['birth'],
            $data['email'],
            $data['position'],
            $data['gender']
        );
        return $stmt->execute();
    }
    static function get($name)
    {
        $stmt = static::$conn->prepare('select * from users where name = ? limit 1');
        $stmt->bind_param('s', $name);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    static function get_all()
    {
        return static::$conn->query('select * from users')->fetch_all(MYSQLI_ASSOC);
    }
    // user can only do update, delete account on their own account.
    // I assumed they already logged in. 
    static function update(array $data = [])
    {
        $stmt = static::$conn->prepare('update users set full_name = ?, birth = ?, email = ?, position = ?, gender = ? where token = ? limit 1');
        $stmt->bind_param(
            'ssssss',
            $data['full_name'],
            $data['birth'],
            $data['email'],
            $data['position'],
            $data['gender'],
            $_SESSION['token']
        );
        return $stmt->execute();
    }
    static function delete()
    {
        $stmt = static::$conn->prepare('delete from users where token = ? limit 1');
        $stmt->bind_param('s', $_SESSION['token']);
        session_destroy();
        return $stmt->execute();
    }
    static function validate($name, $password)
    {
        if (!isset($name) || !isset($password)) {
            return false;
        }
        if (!preg_match('/[0-9a-zA-Z-_]{3,60}/', $name)) {
            return false;
        }
        if (!preg_match('/[0-9a-zA-Z-_]{3,60}/', $password)) {
            return false;
        }
        return true;
    }
}