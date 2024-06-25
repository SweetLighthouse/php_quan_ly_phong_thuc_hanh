<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xoá tài khoản</title>
</head>

<body>
    <?php require_once ('stuff/header.php'); ?>
    <h2>Xoá tài khoản của bạn</h2>

    <?= $data['message'] ?? '' ?>
    <form action="/account/delete" method="post">
        <p>Bạn thật sự muốn xoá tài khoản của bạn?</p>
        <label for="account_password">Hãy nhập mật khẩu: </label>
        <input type="password" name="account_password" id="account_password" autofocus><br><br>
        <button name="delete" value="true" type="submit">Có, hãy xoá tài khoản.</button>
        <a href="javascript:history.back()"><button type="button">Không, hãy quay lại</button></a>
    </form>
    <?php require_once ('stuff/footer.php'); ?>
</body>

</html>