<?php

namespace SWLH;

if (session_status() == PHP_SESSION_NONE)
    session_start();

// echo var_dump($_SESSION) . "<br>";
// echo var_dump(session_id()) . "<br>";
// echo var_dump($_COOKIE) . "<br>";
// session_destroy();

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

// die(var_dump(controller\home::is_login()));
if (!controller\home::is_login()) {
    switch ($_SERVER['REDIRECT_URL']) {
        case '/login':
            controller\home::login();
            break;
        case '/register':
            header('Location: /register/user');
            break;
        case '/register/user':
            controller\user::register();
            break;
        case '/register/owner':
            controller\owner::register();
            break;
        default:
            header('Location: /login');
            break;
    }
}

// echo "reach here";
$result = model\account::find_by_token();
if (!$result) {
    controller\home::logout();
    die('<script>alert("Thông tin tài khoản lưu trên máy của bạn không hợp lệ. Hãy đăng nhập lại."); window.location.href = "/login"</script>');
}
// else {
//     echo var_dump($result);
// }

// route
switch ($_SERVER['REDIRECT_URL']) {
    case '/':
        controller\home::index();
        break;
    case '/account':
        controller\home::account();
        break;
    case '/logout':
        controller\home::logout();
        header('Location: /');
        break;
    // case '/room':
    //     controller\room::index();
    //     break;
    default:
        \SWLH\core\controller::render('404.php', ['message' => 'Đường dẫn không tồn tại.']);
}