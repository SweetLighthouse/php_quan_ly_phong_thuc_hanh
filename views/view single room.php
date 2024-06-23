<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID phòng: <?= $data['room_id'] ?></title>
</head>

<body>
    <?php require_once ('stuff/header.php'); ?>
    <h2>Thông số phòng: </h2>
    <p>ID: <?= $data['room_id'] ?></p>
    <p>Tên phòng: <?= $data['room_name'] ?></p>
    <p>Vị trí phòng: <?= $data['room_position'] ?></p>
    <p>Mô tả: <?= $data['room_description'] ?></p>
    <?php require_once ('stuff/footer.php'); ?>
</body>

</html>