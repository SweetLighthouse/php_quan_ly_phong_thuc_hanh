<?php

namespace SWLH\model;

require_once './core/model.php';

enum USER_FIND {
    case USER_NOT_FOUND;
    case PASSWORD_NOT_MATCH;
    case FOUND;
};

enum USER_ADD {
    case ALREADY_EXIST;
    case DATA_MALFORMED;
    case SUCCESS;
}
class user extends \SWLH\core\model {
    
    static function exist($username) {
        $stmt = self::$db->prepare('select 1 from users where user_name = ?');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    static function validate($user_name, $user_password, array $addtional_data = []) {
        if(empty($user_name) || empty($user_password)) {
            return false;
        }
        if(!isset($addtional_data['user_age'])) {
            return false;
        }
        if(!preg_match('/[0-9a-zA-Z-_@.]{1,60}/', $user_name)) {
            return false;
        }
        if(!preg_match('/[0-9a-zA-Z-_@.]{1,60}/', $user_password)) {
            return false;
        }
        return true;
    }

    static function add($username, $password, array $addtional_data = []) {
        if(self::exist($username)) return USER_ADD::ALREADY_EXIST;
        if(!self::validate($username, $password, $addtional_data)) return USER_ADD::DATA_MALFORMED;
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = self::$db->prepare('insert into users (user_name, user_hashed_password, user_age) values (?, ?, ?)');
        $stmt->bind_param('ssi', $username, $hashed_password, $addtional_data['user_age']);
        $stmt->execute();
        return USER_ADD::SUCCESS;
    }
    
    static function find($username, $password) {
        $stmt = self::$db->prepare('select * from users where user_name = ? limit 1');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_assoc();
        if($result == NULL) return ['message' => USER_FIND::USER_NOT_FOUND];
        if(!password_verify($password, $result['user_hashed_password'])) return ['message' => USER_FIND::PASSWORD_NOT_MATCH];
        else return [
            'message' => USER_FIND::FOUND,
            'user_name'=> $result['user_name'],
            'user_hashed_password'=> $result['user_hashed_password'],
        ];
    }
}