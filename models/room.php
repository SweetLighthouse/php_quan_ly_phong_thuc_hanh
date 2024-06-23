<?php

namespace SWLH\model;

class room extends \SWLH\core\model {

    static function add($room_name, $room_position, $room_description) {
        if(!isset($room_name) || !isset($room_position) || !isset($room_description)) return false;
        $stmt = self::$conn->prepare("insert into rooms (room_name, room_position, room_description) values (?, ?, ?)");
        $stmt->bind_param("sss", $room_name, $room_position, $room_description);
        $stmt->execute();
        return true;
    }
    
    static function update($room_id, $room_name, $room_position, $room_description) {
        if(!isset($room_id) || !isset($room_name) || !isset($room_position) || !isset($room_description)) return false;
        $stmt = self::$conn->prepare("update rooms set room_name = ?, room_position = ?, room_description = ? where room_id = ?");
        $stmt->bind_param("sssi", $room_name, $room_position, $room_description, $room_id);
        $stmt->execute();
        return true;
    }

    static function get($room_id) {
        if (!isset($room_id)) return false;
        $stmt = self::$conn->prepare("select * from rooms where room_id = ? limit 1");
        $stmt->bind_param("i", $room_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 0) return false;
        return $result->fetch_assoc();
    }

    static function get_all() {
        $result = self::$conn->query("select * from rooms");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    static function delete($room_id) {
        if (!isset($room_id)) return false;
        $stmt = self::$conn->prepare("delete from rooms where room_id = ? limit 1");
        $stmt->bind_param("i", $room_id);
        $stmt->execute();
        return true;
    }


}