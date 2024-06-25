<?php

namespace SWLH\model;

class room extends \SWLH\core\model
{
    // to add, update, delete room, user must logged in, and only authenticate user can add room. 
    // in model user, I saved a token. that should be enough and user's id should be retrieved through token.
    // but we have to request to db.users every time this model is used.
    // so I save user id in session and use it.
    // token is authenticated at index.php, once every request.

    static function add(array $data)
    {
        $stmt = self::$conn->prepare("insert into rooms (name, position, description, availability, owner_id) values (?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "sssis",
            $data['name'],
            $data['position'],
            $data['description'],
            $data['availability'],
            $_SESSION['id'] // \SWLH\model\token::get()['id']
        );
        return $stmt->execute();
    }
    static function update(array $data)
    {
        $stmt = self::$conn->prepare("update rooms set name = ?, position = ?, description = ?, availability = ? where id = ? and owner_id = ?");
        $stmt->bind_param("ssssss", 
            $data['name'], 
            $data['position'], 
            $data['description'], 
            $data['availability'], 
            $data['id'], 
            $_SESSION['id'] // \SWLH\model\token::get()['id']
        );
        return $stmt->execute();
    }
    static function delete($id)
    {
        if (!isset($id)) return false;
        $stmt = self::$conn->prepare("delete from rooms where id = ? and owner_id = ? limit 1");
        $stmt->bind_param("ss", $id, $_SESSION['id'] /* \SWLH\model\token::get()['id'] */);
        return $stmt->execute();
    }

    // everyone can view a room, no need to authenticate.
    static function get($id) // view single room
    {
        if (!isset($id)) return false;
        $stmt = self::$conn->prepare("select * from rooms where id = ? limit 1");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    static function get_by_owner($owner_id = null)
    {
        if (!isset($owner_id)) $owner_id = $_SESSION['id'];
        $stmt = self::$conn->prepare("select * from rooms where rooms.owner_id = ?");
        $stmt->bind_param("i", $owner_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    static function get_all()
    {
        return self::$conn->query("select * from rooms")->fetch_all(MYSQLI_ASSOC);
    }




}