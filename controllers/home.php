<?php

namespace SWLH\controller;

class home extends \SWLH\core\controller
{
    static function index()
    {
        $owned_rooms = \SWLH\model\room::read_by_owner_id($_SESSION['account_id']);
        $in_requests = [];
        $resolved_requests = [];
        foreach($owned_rooms as $owned_room) {
            $in_requests_owned_room = \SWLH\model\request::read_by_room_id($owned_room['room_id']);
            foreach($in_requests_owned_room as $in_request) {
                if($in_request['request_approved'] != -1) {
                    $resolved_requests[] = $in_request;
                }
                else {
                    $in_requests[] = $in_request;
                }
            }
        }
        $out_requests = \SWLH\model\request::read_by_account_id($_SESSION['account_id']);
        static::render("index.php", ['in_requests' => $in_requests, 'out_requests' => $out_requests, 'resolved_requests' => $resolved_requests]);
    }
}