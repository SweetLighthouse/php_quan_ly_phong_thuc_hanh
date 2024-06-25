<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin phòng</title>
</head>

<body>
    <?php require_once ('stuff/header.php'); ?>

    <?= $data['message'] ?? '' ?>
    <form action="/room/update" method="post">
        <h2>Sửa thông tin phòng có ID: <?= $data['room_id'] ?></h2>

        <input type="hidden" name="room_id" value="<?= $data['room_id'] ?>">

        <label for="room_name">Tên máy: </label>
        <input type="text" name="room_name" id="room_name" value="<?= $data['room_name'] ?>" autofocus>
        <br><br>

        <label for="room_position">Vị trí phòng: </label>
        <input type="text" name="room_position" id="room_position" value="<?= $data['room_position'] ?>">
        <br><br>

        <label for="room_description">Ghi chú mô tả phòng: </label><br>
        <textarea name="room_description" id="room_description" cols="30" rows="10"><?= $data['room_description'] ?></textarea>
        <br><br>

        <span>Phòng sẵn sàng để dùng?</span>
        <input type="radio" name="room_availability" value="1" id="room_availability_true" <?= isset($data['room_availability']) && $data['room_availability'] == '1' ? 'checked' : '' ?>>
        <label for="room_availability">Có</label>

        <input type="radio" name="room_availability" value="0" id="room_availability_false" <?= isset($data['room_availability']) && $data['room_availability'] == '0' ? 'checked' : '' ?>>
        <label for="room_availability">Không</label>
        <br><br>
        
        <input type="submit" value="Sửa phòng">
        <a href="javascript:history.back()">Huỷ, quay lại</a>
    </form>
    <?php require_once ('stuff/footer.php'); ?>

</body>

</html>