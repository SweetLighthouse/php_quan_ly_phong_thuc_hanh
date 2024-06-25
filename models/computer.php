<?php

namespace SWLH\model;

class computer extends \SWLH\core\model
{
    // to add, update, delete computer, user must logged in, and only authenticate user can add room. 
    // in model user, I saved a token. that should be enough and user's id should be retrieved through token.
    // but we have to request to db.users every time this model is used.
    // so I save user id in session and use it.
    // token is authenticated at index.php, once every request.

    static function add(array $data)
    {
        $stmt = self::$conn->prepare("insert into computers (name, ram, cpu, vga, monitor, note, availability, room_id) values (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "ssssssii",
            $data['name'],
            $data['ram'],
            $data['cpu'],
            $data['vga'],
            $data['monitor'],
            $data['note'],
            $data['availability'],
            $data['room_id'],
        );
        return $stmt->execute();
    }
    static function update(array $data)
    {
        $stmt = self::$conn->prepare("update computers set name = ?, ram = ?, cpu = ?, vga = ?, monitor = ?, note = ?, availability = ? where id = ?");
        $stmt->bind_param("ssssssii", 
            $data['name'], 
            $data['ram'], 
            $data['cpu'], 
            $data['vga'], 
            $data['monitor'], 
            $data['note'], 
            $data['availability'], 
            $data['id'], 
        );
        return $stmt->execute();
    }
    static function delete($id)
    {
        if (!isset($id)) return false;
        $stmt = self::$conn->prepare("delete from computers where id = ? limit 1");
        $stmt->bind_param("s", $id);
        return $stmt->execute();
    }

    // everyone can view a computer, no need to authenticate.
    static function get($id) // view single computer
    {
        if (!isset($id)) return false;
        $stmt = self::$conn->prepare("select * from computers where id = ? limit 1");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    static function get_by_room($room_id)
    {
        if (!isset($room_id)) return false;
        $stmt = self::$conn->prepare("select * from computers where computers.room_id = ?");
        $stmt->bind_param("i", $room_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    static function get_all()
    {
        return self::$conn->query("select * from computers")->fetch_all(MYSQLI_ASSOC);
    }




}