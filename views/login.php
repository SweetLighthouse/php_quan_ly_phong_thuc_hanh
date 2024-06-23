<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
</head>

<body>
    <?php require_once ('stuff/header.php'); ?>

    <?= $data['message'] ?? '' ?>
    <form action="/login" method="post">
        <h2>Đăng nhập</h2>

        <label for="name">Tài khoản: </label>
        <input type="text" name="name" id="name" autofocus>
        <br><br>

        <label for="password">Mật khẩu: </label>
        <input type="password" name="password" id="password">
        <br><br>

        <input type="submit" value="Đăng nhập">
    </form>
    <?php require_once ('stuff/footer.php'); ?>

</body>

</html>