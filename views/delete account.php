<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php require_once ('stuff/header.php'); ?>
    <h2>Xoá thông tin tài khoản</h2>

    <?= $data['message'] ?? '' ?>
    <form action="/account/delete" method="post">
        <p>Bạn thật sự muốn xoá tài khoản?</p>
        <button name="delete" value="true" type="submit">Có, hãy xoá tài khoản.</button>
        <a href="/account/edit" id="here">Không, hãy quay lại.</a>
    </form>
    <?php require_once ('stuff/footer.php'); ?>
</body>

</html>