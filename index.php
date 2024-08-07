<?php

namespace SWLH;

if (session_status() == PHP_SESSION_NONE)
    session_start();

// echo var_dump($_SESSION) . "<br>";
// echo var_dump(session_id()) . "<br>";
// echo var_dump($_COOKIE) . "<br>";
// session_destroy();
// die("asdf");
spl_autoload_register(function ($class_name) {
    $class_name = str_replace('SWLH\\', '', $class_name); // bỏ \SWLH ở đầu
    $class_name = explode('\\', $class_name); // xé nó thành mảng
    // mình quan tâm phần tử đầu tiên. trong project này thì nó có 1 khả năng: controller, model, view, core
    if (in_array($class_name[0], ['controller', 'model', 'view'])) { // nếu nó là 1 trong 3 thằng này
        $class_name[0] = $class_name[0] . 's'; // thì thêm chữ s
        // tại sao? vì thư mục tương ứng nó có chữ s vì nó là số nhiều
    }
    $class_name = implode('/', $class_name); // làm xong thì ghép lại
    $class_name .= '.php'; // thêm hậu tố file
    require_once $class_name; // và require nó
});

if($_SERVER['REDIRECT_URL'] != '/') $_SERVER['REDIRECT_URL'] = rtrim($_SERVER['REDIRECT_URL'], "/");

// kiểm tra token của người dùng mỗi lần request đến trang.
if (!model\token::validate()) {
    model\token::delete(); // nếu token ko hợp lệ thì huỷ token.
    switch ($_SERVER['REDIRECT_URL']) { // đăng nhập lại.
        case '/login':
            controller\account::login();
            break;
        case '/register':
            controller\account::register();
            break;
        default:
            header('Location: /login');
            break;
    }
}

// route
switch ($_SERVER['REDIRECT_URL']) {
    case '/logout':
        controller\account::logout(); // đăng xuất
        break;
    case '/':
        controller\home::index(); // trang chủ
        break;
    case '/account':
        controller\account::read(); // xem tài khoản
        break;
    case '/account/update':
        controller\account::update(); // sửa tài khoản
        break;
    case '/account/delete':
        controller\account::delete(); // xoá tài khoản
        break;
    case '/accounts':
        controller\account::get_all(); // xem tất cả các người dùng trên máy chủ
        break;
    case '/rooms':
        controller\room::rooms_by_owner(); // xem phòng thực hành do mình quản lý
        break;
    case '/rooms/other':
        controller\room::rooms_not_mine(); // xem phòng thực hành của mọi người
        break;
    case '/room':
        controller\room::room(); // xem 1 phòng thực hành
        break;
    case '/room/create':
        controller\room::create(); // thêm phòng thực hành
        break;
    case '/room/update':
        controller\room::update(); // sửa phòng thục hành
        break;
    case '/room/delete':
        controller\room::delete(); // xoá phòng thực hành
        break;
    case '/computer/create':
        controller\computer::create(); // thêm máy tính vào phòng thực hành
        break;
    case '/computer/update':
        controller\computer::update(); // sửa máy tính trong phòng thực hành
        break;
    case '/computer/delete':
        controller\computer::delete(); // xoá máy tính trong phòng thực hành
        break;
    case '/request/create':
        controller\request::create(); // tạo request thuê phòng
        break;
    case '/request/update':
        controller\request::update(); // tạo request thuê phòng
        break;
    case '/request/delete':
        controller\request::delete(); // tạo request thuê phòng
        break;
    default:
        \SWLH\core\controller::render('404.php', ['message' => 'Đường dẫn không tồn tại.']);
        break;
}