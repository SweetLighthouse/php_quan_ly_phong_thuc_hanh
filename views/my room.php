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
            <td>Hành động</td>
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
                    <td>
                        <a style="display: inline;" href="/computer/update?id=<?= $computer['computer_id'] ?>"><button>Sửa</button></a>
                        <form action="/computer/delete" method="post" style="display: inline-block;">
                            <button name="computer_id" value="<?= $computer['computer_id'] ?>" type="submit">Xoá</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        <form method="post" action="/computer/create">
            <tr>
                <td></td>
                <td><input type="text" name="computer_name" id="computer_name"></td>
                <td><input type="text" name="computer_ram" id="computer_ram"></td>
                <td><input type="text" name="computer_cpu" id="computer_cpu"></td>
                <td><input type="text" name="computer_vga" id="computer_vga"></td>
                <td><input type="text" name="computer_monitor" id="computer_monitor"></td>
                <td><input type="text" name="computer_note" id="computer_note"></td>
                <td><select name="computer_availability" id="computer_availability">
                        <option value="1">Có</option>
                        <option value="0">Không</option>
                    </select></td>
                <td><button name="computer_room_id" value="<?= $data['room']['room_id'] ?>" type="submit">Thêm</button></td>
            </tr>
        </form>
    </table>
    <br>
    <a href="/room/update?id=<?= $data['room']['room_id'] ?>"><button>Sửa thông tin phòng</button></a>
    <a href="/room/delete?id=<?= $data['room']['room_id'] ?>"><button>Xoá phòng</button></a>
    <a href="javascript:history.back()"><button type="button">Quay lại</button></a>
    <?php require_once ('stuff/footer.php'); ?>
</body>

</html>