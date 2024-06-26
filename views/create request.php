<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm yêu cầu mới</title>
</head>

<body>
    <?php require_once ('stuff/header.php'); ?>

    <?= $data['message'] ?? '' ?>
    <form action="/request/create" method="post">
        <h2>Nhập thông tin để yêu cầu sử dụng phòng.</h2>

        <label for="request_from_time">Thuê phòng từ lúc: </label>
        <input type="datetime-local" name="request_from_time" id="request_from_time" value="<?= $data['request_from_time'] ?? '' ?>"><br><br>

        <label for="request_to_time">Thuê phòng đến lúc: </label>
        <input type="datetime-local" name="request_to_time" id="request_to_time" value="<?= $data['request_to_time'] ?? '' ?>"><br><br>

        <button name="request_room_id" value="<?= $data['request_room_id'] ?? '' ?>" type="submit">Gửi yêu cầu</button>
        <a href="javascript:history.back()"><button type="button">Huỷ, quay lại</button></a>
    </form>
    <?php require_once ('stuff/footer.php'); ?>

</body>

</html>