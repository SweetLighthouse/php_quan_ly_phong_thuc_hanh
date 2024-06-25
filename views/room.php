<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- <?= var_dump($data) ?> -->
    <?php require_once ('stuff/header.php'); ?>
    <h2>Thông tin phòng</h2>
    <p>ID: <?= $data['id'] ?></p>
    <p>Tên phòng: <?= $data['name'] ?></p>
    <p>Vị trí phòng: <?= $data['position'] ?></p>
    <p>Mô tả phòng: </p>
    <textarea disabled cols="30" rows="10"><?= $data['description'] ?></textarea>
    <p>Khả dụng: <?= $data['availability'] ?></p>
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
            <?php if (isset($data['computer_list']) && $data['computer_list'] != [] && isset($data['editable'])): ?>

            <?php endif; ?>
            <?php if (isset($data['editable'])): ?>
                <td>Hành động</td>
            <?php endif; ?>
        </tr>
        <?php if (isset($data['computer_list']) && $data['computer_list'] != []): ?>
            <?php foreach ($data['computer_list'] as $computer): ?>
                <tr>
                    <td><?= $computer['id'] ?></td>
                    <td><?= $computer['name'] ?></td>
                    <td><?= $computer['ram'] ?></td>
                    <td><?= $computer['cpu'] ?></td>
                    <td><?= $computer['vga'] ?></td>
                    <td><?= $computer['monitor'] ?></td>
                    <td><?= $computer['note'] ?></td>
                    <td><?= $computer['availability'] ?></td>
                    <?php if (isset($data['editable'])): ?>
                        <td>
                            <a style="display: inline;" href="/computer/edit?id=<?= $computer['id'] ?>"><button>Sửa</button></a>
                            <form action="/computer/delete" method="post" style="display: inline-block;">
                                <input type="hidden" name="id" value="<?= $computer['id'] ?>">
                                <button type="submit">Xoá</button>
                            </form>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Không có máy tính nào trong phòng này.</p>
        <?php endif; ?>
        <?php if (isset($data['editable'])): ?>
            <form method="post" action="/computer/new">
                <tr>
                    <td></td>
                    <input type="hidden" name="room_id" value="<?= $data['id'] ?>">
                    <td><input type="text" name="name" id="name"></td>
                    <td><input type="text" name="ram" id="ram"></td>
                    <td><input type="text" name="cpu" id="cpu"></td>
                    <td><input type="text" name="vga" id="vga"></td>
                    <td><input type="text" name="monitor" id="monitor"></td>
                    <td><input type="text" name="note" id="note"></td>
                    <td><select name="availability" id="availability">
                            <option value="1">Có</option>
                            <option value="0">Không</option>
                        </select></td>
                    <td><input type="submit" value="Thêm"></td>
                </tr>
            </form>
        <?php endif; ?>
    </table>
    <br>
    <?php if (isset($data['editable'])): ?>
        <a href="/room/edit?id=<?= $data['id'] ?>"><button>Sửa thông tin phòng</button></a>
        <a href="/room/delete?id=<?= $data['id'] ?>"><button>Xoá phòng</button></a>
    <?php endif; ?>
    <a href="/rooms">Quay lại</a>
    <?php require_once ('stuff/footer.php'); ?>
</body>

</html>