<?php

namespace SWLH\model;

class room extends \SWLH\core\model
{
    // to add, update, delete room, user must logged in, and only authenticate user can add room. 
    // in model user, I saved a token. that should be enough and user's id should be retrieved through token.
    // but we have to request to db.users every time this model is used.
    // so I save user id in session and use it.
    // token is authenticated at index.php, once every request.

    static function create(array $data)
    {
        $stmt = static::$conn->prepare("insert into rooms (room_name, room_position, room_description, room_availability, room_owner_id) values (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssis",
            $data['room_name'],
            $data['room_position'],
            $data['room_description'],
            $data['room_availability'],
            $data['room_owner_id'],
        );
        return $stmt->execute();
    }
    static function update(array $data)
    {
        $stmt = static::$conn->prepare("update rooms set room_name = ?, room_position = ?, room_description = ?, room_availability = ?, room_owner_id = ? where room_id = ?");
        $stmt->bind_param("sssiss", 
            $data['room_name'], 
            $data['room_position'], 
            $data['room_description'], 
            $data['room_availability'], 
            $data['room_owner_id'], 
            $data['room_id'], 
        );
        return $stmt->execute();
    }
    static function delete($room_id)
    {
        if (!isset($room_id)) return false;
        $stmt = static::$conn->prepare("delete from rooms where room_id = ? limit 1");
        $stmt->bind_param("i", $room_id);
        return $stmt->execute();
    }
    // everyone can view a room, no need to authenticate.
    static function read($room_id) // view single room
    {
        if (!isset($room_id)) return false;
        $stmt = static::$conn->prepare("select * from rooms where room_id = ? limit 1");
        $stmt->bind_param("i", $room_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    static function read_by_owner_id($owner_id)
    {
        if (!isset($owner_id)) $owner_id = $_SESSION['account_id'];
        $stmt = static::$conn->prepare("select * from rooms where room_owner_id = ?");
        $stmt->bind_param("i", $owner_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    static function read_all()
    {
        return static::$conn->query("select * from rooms")->fetch_all(MYSQLI_ASSOC);
    }




}