<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm phòng mới</title>
</head>

<body>
    <?php require_once ('stuff/header.php'); ?>

    <?= $data['message'] ?? '' ?>
    <form action="/room/create" method="post">
        <h2>Nhập thông tin phòng mới</h2>

        <label for="room_name">Tên phòng: </label>
        <input type="text" name="room_name" id="room_name" value="<?= $data['room_name'] ?? '' ?>" autofocus><br><br>

        <label for="room_position">Vị trí phòng: </label>
        <input type="text" name="room_position" id="room_position" value="<?= $data['room_position'] ?? '' ?>"><br><br>

        <label for="room_description">Ghi chú mô tả phòng: </label><br>
        <textarea name="room_description" id="room_description" cols="30" rows="10"><?= $data['room_name'] ?? '' ?></textarea><br><br>

        <span>Phòng sẵn sàng để dùng?</span>
        <input type="radio" name="room_availability" value="1" id="room_availability_true" <?= !isset($data['room_availability']) || $data['room_availability'] == '1' ? 'checked' : '' ?>>
        <label for="availability">Có</label>

        <input type="radio" name="room_availability" value="0" id="room_availability_false" <?= isset($data['room_availability']) && $data['room_availability'] == '0' ? 'checked' : '' ?>>
        <label for="availability">Không</label><br><br>

        <input type="submit" value="Thêm phòng">
        <a href="javascript:history.back()"><button type="button">Huỷ, quay lại</button></a>
    </form>
    <?php require_once ('stuff/footer.php'); ?>

</body>

</html>