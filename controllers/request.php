<?php

namespace SWLH\controller;

class request extends \SWLH\core\controller
{
    static function delete() 
    {
        $request_id = $_GET['id'];
        if(!$request_id) static::render('404.php', ['message' => 'ID yêu cầu không thể để trống.']);
        $request = \SWLH\model\request::read($request_id);
        if(!$request) static::render('404.php', ['message' => 'Không tìm thấy yêu cầu với ID đã cho.']);
        if($request['request_approved'] != -1) static::render('404.php', ['message' => 'Không còn có thể xoá yêu cầu này.']);
        if ($request['request_account_id'] != $_SESSION['account_id']) static::render('404.php', ['message' => 'Bạn không có quyền xoá yêu cầu này.']);
        if (!\SWLH\model\request::delete($request_id)) static::render('404.php', ['message'=> 'Có lỗi xảy ra khi xoá yêu cầu.']);
        header('Location: /');
    }
    protected static function validate($data)
    {
        if(!isset($data['request_from_time']) || !isset($data['request_to_time']) || !isset($data['request_room_id']) || !isset($data['request_account_id']) || !isset($data['request_reason'])) return false;
        return true;
    }
    static function create()
    {
        $room_id = $_GET['room_id'] ?? $_POST['request_room_id'] ?? '';
        if (!$room_id) static::render('404.php', ['message' => 'Không thể để trống ID phòng']);
        $room = \SWLH\model\room::read($room_id);
        if (!$room) static::render('404.php', ['message' => 'Không tìm thấy phòng với ID đã cho.']);
        if ($room['room_owner_id'] == $_SESSION['account_id']) static::render('404.php', ['message' => 'Bạn không thể thuê chính phòng của mình.']);
        switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            static::render('create request.php', ['request_room_id' => $room_id]);
            break;
        case 'POST':
            $_POST['request_account_id'] = $_SESSION['account_id'];
            $_POST['request_approved'] = -1;
            var_dump($_POST);
            if(!static::validate($_POST)) {
                $_POST['message'] = 'Dữ liệu không hợp lệ.';
                static::render('create request.php', $_POST);
            }
            if(!\SWLH\model\request::create($_POST)) {
                $_POST['message'] = 'Có lỗi xảy ra khi tạo yêu cầu.';
                static::render('create request.php', $_POST);
            }
            die('<script>alert("Đã tạo yêu cầu thành công."); window.location.href = "/"</script>');
        }
    }
    static function update()
    {
        // switch case on update:
        // owners would want to approve or reject the request.
        // creator would want to fix the request
        // authenticate
        $request_id = $_GET['id'] ?? $_POST['request_id'];
        if(!$request_id) static::render('404.php', ['message' => 'ID yêu cầu không thể để trống.']);
        $request = \SWLH\model\request::read($request_id);
        if(!$request) static::render('404.php', ['message' => 'Không tìm thấy yêu cầu với ID đã cho.']);
        if($request['request_approved'] != -1) static::render('404.php', ['message' => 'Không còn có thể chỉnh sửa yêu cầu này.']);
        $approved = $_GET['approved'] ?? '';
        $type = '';
        if ($request['request_account_id'] == $_SESSION['account_id']) {
            $type = 'creator'; // authenticated as creator of the request
        }
        else {
            $owned_rooms = \SWLH\model\room::read_by_owner_id($_SESSION['account_id']);
            foreach ($owned_rooms as $owned_room) {
                if ($owned_room['room_id'] == $request['request_room_id']) {
                    // authenticated as owner of a room of request
                    $type = 'owner';
                    break;
                }
            }
        }
        switch ($type) {
        case 'creator':
            switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                static::render('update request.php', $request);
                break;
            case 'POST':
                $_POST['request_account_id'] = $_SESSION['account_id'];
                $_POST['request_room_id'] = $request['request_room_id'];
                $_POST['request_approved'] = $request['request_approved'];
                var_dump($_POST);
                if(!static::validate($_POST)) {
                    $_POST['message'] = 'Dữ liệu không hợp lệ.';
                    static::render('update request.php', $_POST);
                }
                if(!\SWLH\model\request::update($_POST)) {
                    $_POST['message'] = 'Cập nhật yêu cầu thất bại.';
                    static::render('update request.php', $_POST);
                }
                header('Location: /');
            }
            break;
        case 'owner':
            $request['request_approved'] = $approved;
            \SWLH\model\request::update($request);
            header('Location: /');
            break;
        default:
            static::render('404.php', ['message' => 'Bạn không có quyền để thực hiện thao tác này.']);
            break;

        }
    }
}