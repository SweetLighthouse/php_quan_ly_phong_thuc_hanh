<?php

// cái cấu trúc của tôi, tôi lưu nó thành
// \SWLH\controller
// \SWLH\model
// \SWLH\view
// \SWLH\code
// \SWLH như là chữ ký của tôi thôi.
// cái quan tâm là mô hình MVC

namespace SWLH;




# đây là index.php
# URL dc điểu hướng nằm trong $_SERVER['REDIRECT_URL']


# nếu đã có session r thì ko phải start lại nữa, ko thì start
# ông biết session chứ?
if (session_status() == PHP_SESSION_NONE)
    session_start();

// echo var_dump($_SESSION);
// echo "<br><br>";

# biết thằng này chứ? spl_autoload_register()
# cái này là mã chạy, mỗi khi có một class xuất hiện
vd: 






// tóm lại là 
spl_autoload_register(function ($class_name) {
    $class_name = str_replace('SWLH\\', '', $class_name); // bỏ \SWLH ở đầu
    $class_name = explode('\\', $class_name); // xé nó thành mảng
    // mình quan tâm phần tử đầu tiên. trong project này thì nó có 1 khả năng: controller, model, view, core
    if (in_array($class_name[0], ['controller', 'model', 'view'])) { // nếu nó là 1 trogn 3 thằng này
        $class_name[0] = $class_name[0] . 's'; // thì thêm chữ s
        // tại sao? vì thư mục tương ứng nó có chữ s vì nó là số nhiều
    }
    $class_name = implode('/', $class_name); // làm xong thì ghép lại
    $class_name .= '.php'; // thêm hậu tố file
    require_once $class_name; // và require nó
});



// must login before everything else
if (!controller\user::islogin() && !in_array($_SERVER['REDIRECT_URL'], ['/login', '/register'])) {
    header('Location: /login'); // redirect người dùng về trang /login
}

// route
switch ($_SERVER['REDIRECT_URL']) {
    case '/':
        controller\home::index();
        break;
    case '/login':
        controller\user::login();
        break;
    case '/register':
        controller\user::register();
        break;
    case '/logout':
        controller\user::logout();
        break;
    case '/room':
        controller\room::index();
        break;
    default:
        die('unknown path.');
}