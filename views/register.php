<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="public/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
</head>

<body>
    <?php require_once ('stuff/header.php'); ?>

    <?= $data['message'] ?? '' ?>

    <script>
        function checkIfPassWordMatch() {
            let user_password = document.getElementById('user_password');
            let user_password_retype = document.getElementById('user_password_retype');
            if (user_password.value == user_password_retype.value) return true;
            alert('Password phải trùng.');
            return false;
        }
    </script>
    <form action="/register" method="post" onsubmit="return checkIfPassWordMatch();">
        <h2>Đăng ký</h2>
        <label for="user_name">Tài khoản:</label>
        <input type="text" name="user_name" id="user_name" autofocus>
        <br><br>

        <label for="user_password">Mật khẩu:</label>
        <input type="password" name="user_password" id="user_password">
        <br><br>

        <label for="user_password_retype">Nhập lại mật khẩu:</label>
        <input type="password" name="user_password_retype" id="user_password_retype">
        <br><br>

        <label for="user_birth">Tuổi:</label>
        <input type="number" name="user_birth" id="user_birth">
        <br><br>

        <label for="user_age">Tuổi:</label>
        <input type="number" name="user_age" id="user_age" min="0">
        <br><br>        

        <input type="submit" value="Đăng ký">
        <a href="/login">Đăng nhập</a>
        <?php require_once ('stuff/footer.php'); ?>
    </form>
</body>

</html>