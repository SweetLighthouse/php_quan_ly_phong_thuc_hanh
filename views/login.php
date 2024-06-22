<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="public/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
</head>

<body>
    <?php require_once ('stuff/header.php'); ?>

    <?= $data['message'] ?? '' ?>
    <form action="/login" method="post">
        <h2>Đăng nhập</h2>

        <label for="user_name">Tài khoản: </label>
        <input type="text" name="user_name" id="user_name" value="<?= $data['user_name'] ?? '' ?>" autofocus>
        <br><br>

        <label for="user_password">Mật khẩu: </label>
        <input type="password" name="user_password" id="user_password">
        <br><br>

        <input type="submit" value="Đăng nhập">
        <a href="/register">Đăng ký</a>
    </form>
    <?php require_once ('stuff/footer.php'); ?>

</body>

</html>