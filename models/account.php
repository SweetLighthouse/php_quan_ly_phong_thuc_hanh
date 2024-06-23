<?php

namespace SWLH\model;

class account {
    static function find($name)
    {
        $type = 'user';
        $user_account = \SWLH\model\user::find($name);
        $owner_account = \SWLH\model\owner::find($name);
        if($user_account) {
            $account = $user_account;
            $account['type'] = 'user';
        } else if ($owner_account) {
            $account = $owner_account;
            $account['type'] = 'owner';
        }
        return $account ?? false;
    }

    static function delete($name)
    {
        $type = 'user';
        $success = \SWLH\model\owner::delete($name);
        if(!$success) {
            $type = 'owner';
            $success = \SWLH\model\owner::delete($name);
        }
        if(!$success) return false;
        return $type;
    }

    static function find_by_token()
    {
        $type = 'user';
        $account = \SWLH\model\user::get_by_token($_SESSION['token']);

        if (!$account) {
            $account = \SWLH\model\owner::get_by_token($_SESSION['token']);
            $type = 'owner';
        }

        if (!$account)
            return false;
        $account['type'] = $type;
        return $account;
    }

    static function find_by_name($name)
    {
        $type = 'user';
        $account = \SWLH\model\user::get_by_token($name);

        if (!$account) {
            $account = \SWLH\model\owner::get_by_token($name);
            $type = 'owner';
        }

        if (!$account)
            return false;
        $account['type'] = $type;
        return $account;
    }

    static function set_token($name, $token) {
        \SWLH\model\user::set_token($name, $token);
        \SWLH\model\owner::set_token($name, $token);
    }
}