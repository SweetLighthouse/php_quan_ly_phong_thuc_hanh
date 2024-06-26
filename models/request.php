<?php

namespace SWLH\model;

class request extends \SWLH\core\model
{
    // to add, update, delete computer, user must logged in, and only authenticate user can add room. 
    // in model user, I saved a token. that should be enough and user's id should be retrieved through token.
    // but we have to request to db.users every time this model is used.
    // so I save user id in session and use it.
    // token is authenticated at index.php, once every request.

    static function create(array $data)
    {
        $stmt = static::$conn->prepare("insert into requests (request_account_id, request_room_id, request_from_time, request_to_time, request_approved) values (?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "iissi",
            $data['request_account_id'],
            $data['request_room_id'],
            $data['request_from_time'],
            $data['request_to_time'],
            $data['request_approved']
        );
        return $stmt->execute();
    }
    static function update(array $data)
    {
        $stmt = static::$conn->prepare("update requests set request_from_time = ?, request_to_time = ?, request_approved = ? where request_id = ? limit 1");
        $stmt->bind_param("ssii", 
            $data['request_from_time'],
            $data['request_to_time'],
            $data['request_approved'],
            $data['request_id']
        );
        return $stmt->execute();
    }
    static function delete($request_id)
    {
        if (!isset($request_id)) return false;
        $stmt = static::$conn->prepare("delete from requests where request_id = ? limit 1");
        $stmt->bind_param("s", $request_id);
        return $stmt->execute();
    }
    // everyone can view a computer, no need to authenticate.
    static function read($request_id) // view single request
    {
        if (!isset($request_id)) return false;
        $stmt = static::$conn->prepare("select * from requests where request_id = ? limit 1");
        $stmt->bind_param("i", $request_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    static function read_by_account_id($account_id)
    {
        if (!isset($account_id)) return false;
        $stmt = static::$conn->prepare("select * from requests where request_account_id = ?");
        $stmt->bind_param("i", $account_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    static function read_by_room_id($room_id)
    {
        if (!isset($room_id)) return false;
        $stmt = static::$conn->prepare("select * from requests where request_room_id = ?");
        $stmt->bind_param("i", $room_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}