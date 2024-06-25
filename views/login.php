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
    <h2>Đăng nhập vào tài khoản của bạn.</h2>
    
    <form action="/login" method="post">
        <label for="account_name">Tài khoản: </label>
        <input type="text" name="account_name" id="account_name" value="<?= $data['account_name'] ?? '' ?>" autofocus>
        <br><br>
        <label for="account_password">Mật khẩu: </label>
        <input type="password" name="account_password" id="account_password">
        <br><br>
        <input type="submit" value="Đăng nhập"><br>
    </form>
    <?= $data['message'] ?? '' ?>
    <?php require_once ('stuff/footer.php'); ?>
</body>

</html>