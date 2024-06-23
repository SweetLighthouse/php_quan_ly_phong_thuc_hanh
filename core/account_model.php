<?php

namespace SWLH\core;

abstract class account_model extends model
{
    static $table;
    static function add($name, array $data = [])
    {
        if (static::find($name))
            return false;
        $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
        $stmt = static::$conn->prepare("insert into " . static::$table . " (name, hashed_password, birth, email, position, gender) values (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssss', $name, $hashed_password, $data['birth'], $data['email'], $data['position'], $data['gender']);
        $stmt->execute();
        return true;
    }

    static function update($name, array $data = [])
    {
        if (!static::find($name))
            return false;
        $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
        $stmt = static::$conn->prepare("update " . static::$table . " set (name, hashed_password, birth, email, position, gender) values (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssss', $name, $hashed_password, $data['birth'], $data['email'], $data['position'], $data['gender']);
        $stmt->execute();
        return true;
    }

    static function find($name)
    {
        // echo var_dump(static::$table);
        $sql = "select * from " . static::$table . " where name = ? limit 1";
        $stmt = static::$conn->prepare($sql);
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $record = $result->fetch_assoc();
        return $record ?? false;
    }

    static function delete($name)
    {
        $stmt = static::$conn->prepare("delete from " . static::$table . " where user_name = ?");
        $stmt->bind_param('s', $name);
        $stmt->execute();
        return $stmt->affected_rows ? true : false;
    }

    static function validate($name, $password, array $data = [])
    {
        if (!isset($name) || !isset($password)) {
            return false;
        }
        if (!preg_match('/[0-9a-zA-Z-_@.]{1,60}/', $name)) {
            return false;
        }
        if (!preg_match('/[0-9a-zA-Z-_@.]{1,60}/', $password)) {
            return false;
        }
        return true;
    }

    static function set_token($name, $token)
    {
        $stmt = static::$conn->prepare('update ' . static::$table . ' set token = ? where name = ?');
        $stmt->bind_param('ss', $token, $name);
        $stmt->execute();
        return true;
    }

    static function get_by_token($token) {
        if(!$token) return false;
        $stmt = static::$conn->prepare('select * from '. static::$table . ' where token = ?');
        $stmt->bind_param('s', $token);
        $stmt->execute();
        $result = $stmt->get_result();
        $record = $result->fetch_assoc();
        if(!$record) return false;
        return $record;
    }
}