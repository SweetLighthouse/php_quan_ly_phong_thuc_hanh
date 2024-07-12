<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin phòng</title>
</head>

<body>
    <?php require_once ('stuff/header.php'); ?>
    <h2>Thông tin phòng <?= $data['room']['room_name'] ?? '' ?></h2>
    <p>ID chủ sở hữu: <a href="/account?id=<?= $data['room']['room_owner_id'] ?? '' ?>"><?= $data['room']['room_owner_id'] ?? '' ?></a></p>
    <p>ID: <?= $data['room']['room_id'] ?? '' ?></p>
    <p>Tên phòng: <?= $data['room']['room_name'] ?? '' ?></p>
    <p>Vị trí phòng: <?= $data['room']['room_position'] ?? '' ?></p>
    <p>Mô tả phòng: </p>
    <textarea disabled cols="30" rows="10"><?= $data['room']['room_description'] ?? '' ?></textarea>
    <p>Khả dụng: <?= $data['room']['room_availability'] ?? '' ?></p>
    <p><?= isset($data['computers']) && count($data['computers']) ? ('Tổng số máy: ' . count($data['computers'])) : 'Không có máy nào cả.' ?></p>
    <table>
        <tr>
            <td>ID máy</td>
            <td>Tên</td>
            <td>RAM</td>
            <td>CPU</td>
            <td>VGA</td>
            <td>Màn hình</td>
            <td>Ghi chú</td>
            <td>Khả dụng</td>
        </tr>
        <?php if (isset($data['computers'])): ?>
            <?php foreach ($data['computers'] as $computer): ?>
                <tr>
                    <td><?= $computer['computer_id'] ?></td>
                    <td><?= $computer['computer_name'] ?></td>
                    <td><?= $computer['computer_ram'] ?></td>
                    <td><?= $computer['computer_cpu'] ?></td>
                    <td><?= $computer['computer_vga'] ?></td>
                    <td><?= $computer['computer_monitor'] ?></td>
                    <td><?= $computer['computer_note'] ?></td>
                    <td><?= $computer['computer_availability'] ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
    <br>
    <a href="/request/create?room_id=<?= $data['room']['room_id'] ?>"><button type="button">Thuê phòng này</button></a>
    <a href="javascript:history.back()"><button type="button">Quay lại</button></a>
    <?php require_once ('stuff/footer.php'); ?>
</body>

</html>