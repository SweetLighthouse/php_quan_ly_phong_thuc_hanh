<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký sử dụng phòng</title>
</head>

<body>
    <?php require_once ('stuff/header.php'); ?>

    <?= $data['message'] ?? '' ?>

    <script>
        function checkIfPassWordMatch() {
            let password = document.getElementById('password');
            let password_retype = document.getElementById('password_retype');
            if (password.value == password_retype.value) return true;
            alert('Password phải trùng.');
            return false;
        }
    </script>
    <form action="/register/user" method="post" onsubmit="return checkIfPassWordMatch();">
        <h2>Bạn muốn sử dụng phòng thực hành? Hãy đăng ký tài khoản để sử dụng phòng.</h2>
        <label for="name">Tài khoản:</label>
        <input type="text" name="name" id="name" autofocus>
        <br><br>

        <label for="password">Mật khẩu:</label>
        <input type="password" name="password" id="password">
        <br><br>

        <label for="password_retype">Nhập lại mật khẩu:</label>
        <input type="password" name="password_retype" id="password_retype">
        <br><br>

        <label for="birth">Ngày sinh:</label>
        <input type="date" name="birth" id="birth">
        <br><br>

        <label for="email">Email:</label>
        <input type="text" name="email" id="email">
        <br><br>
        
        <label for="position">Chức vụ:</label>
        <input type="text" name="position" id="position">
        <br><br>

        <label for="gender">Giới tính:</label>
        <select name="gender" id="gender">
            <option value="male">Nam</option>
            <option value="female">Nữ</option>
            <option value="other">Khác</option>
        </select>
        <br><br>

        <input type="submit" value="Đăng ký">
    </form>
    <?php require_once ('stuff/footer.php'); ?>
</body>

</html>