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
    <form action="/room/new" method="post">
        <h2>Thêm phòng mới</h2>

        <label for="name">Tên phòng: </label>
        <input type="text" name="name" id="name" autofocus>
        <br><br>

        <label for="position">Vị trí phòng: </label>
        <input type="text" name="position" id="position">
        <br><br>

        <label for="description">Ghi chú mô tả phòng: </label><br>
        <textarea name="description" id="description" cols="30" rows="10"></textarea>
        <br><br>

        <span>Phòng sẵn sàng để dùng?</span>
        <input type="radio" name="availability" value="1" id="availability-true" checked>
        <label for="availability">Có</label>

        <input type="radio" name="availability" value="0" id="availability-false">
        <label for="availability">Không</label>
        <br><br>

        <input type="submit" value="Thêm phòng">
        <a href="/rooms">Huỷ</a>
    </form>
    <?php require_once ('stuff/footer.php'); ?>

</body>

</html>