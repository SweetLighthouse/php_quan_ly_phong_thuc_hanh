<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tất cả các phòng</title>
</head>

<body>
    <?php require_once ("stuff/header.php"); ?>
    <?php if (count($data) == 0): ?>
        <p>Không có phòng nào để hiển thị.</p>
    <?php else: ?>
        <table>
            <tr>
                <td>ID phòng</td>
                <td>Tên phòng</td>
                <td>Vị trí phòng</td>
                <td>Mô tả</td>
            </tr>
            <?php foreach ($data as $record): ?>
                <tr>
                    <td><?= $record['room_id'] ?></td>
                    <td><?= $record['room_name'] ?></td>
                    <td><?= $record['room_position'] ?></td>
                    <td><?= $record['room_description'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    <?php require_once ("stuff/footer.php"); ?>
</body>

</html>