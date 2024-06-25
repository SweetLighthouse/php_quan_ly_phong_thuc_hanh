<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xoá phòng</title>
</head>

<body>
    <?php require_once ('stuff/header.php'); ?>
    <h2>Xoá phòng thực hành</h2>

    <?= $data['message'] ?? '' ?>
    <form action="/room/delete" method="post">
        <p>Bạn thật sự muốn xoá phòng có ID = <?= $data['room_id'] ?> ?</p>
        <input type="hidden" name="id" value="<?= $data['room_id'] ?>">
        <button name="delete" value="true" type="submit">Có, hãy xoá phòng này.</button>
        <a href="javascript:history.back()"><button type="button">Không, quay lại</button></a>
    </form>
    <?php require_once ('stuff/footer.php'); ?>
</body>

</html>