<?php

namespace SWLH\model;

class computer extends \SWLH\core\model
{
    // to add, update, delete computer, user must logged in, and only authenticate user can add room. 
    // in model user, I saved a token. that should be enough and user's id should be retrieved through token.
    // but we have to request to db.users every time this model is used.
    // so I save user id in session and use it.
    // token is authenticated at index.php, once every request.

    static function create(array $data)
    {
        $stmt = static::$conn->prepare("insert into computers (computer_name, computer_ram, computer_cpu, computer_vga, computer_monitor, computer_note, computer_availability, computer_room_id) values (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "ssssssii",
            $data['computer_name'],
            $data['computer_ram'],
            $data['computer_cpu'],
            $data['computer_vga'],
            $data['computer_monitor'],
            $data['computer_note'],
            $data['computer_availability'],
            $data['computer_room_id'],
        );
        return $stmt->execute();
    }
    static function update(array $data)
    {
        $stmt = static::$conn->prepare("update computers set computer_name = ?, computer_ram = ?, computer_cpu = ?, computer_vga = ?, computer_monitor = ?, computer_note = ?, computer_availability = ?, computer_room_id = ? where computer_id = ?");
        $stmt->bind_param("ssssssiii", 
            $data['computer_name'], 
            $data['computer_ram'], 
            $data['computer_cpu'], 
            $data['computer_vga'], 
            $data['computer_monitor'], 
            $data['computer_note'], 
            $data['computer_availability'], 
            $data['computer_room_id'], 
            $data['computer_id'], 
        );
        return $stmt->execute();
    }
    static function delete($computer_id)
    {
        if (!isset($computer_id)) return false;
        $stmt = static::$conn->prepare("delete from computers where computer_id = ? limit 1");
        $stmt->bind_param("s", $computer_id);
        return $stmt->execute();
    }
    // everyone can view a computer, no need to authenticate.
    static function read($computer_id) // view single computer
    {
        if (!isset($computer_id)) return false;
        $stmt = static::$conn->prepare("select * from computers where computer_id = ? limit 1");
        $stmt->bind_param("i", $computer_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    static function read_by_room_id($room_id)
    {
        if (!isset($room_id)) return false;
        $stmt = static::$conn->prepare("select * from computers where computer_room_id = ?");
        $stmt->bind_param("i", $room_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}