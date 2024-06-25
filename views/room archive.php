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
    <?php if (isset($data['computer_list']) && $data['computer_list'] != []): ?>
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
            <?php foreach ($data['computer_list'] as $key => $computer): ?>
                <tr id="<?= $computer['id'] ?>">
                    <td><?= $computer['id'] ?></td>
                    <td><?= $computer['name'] ?></td>
                    <td><?= $computer['ram'] ?></td>
                    <td><?= $computer['cpu'] ?></td>
                    <td><?= $computer['vga'] ?></td>
                    <td><?= $computer['monitor'] ?></td>
                    <td><?= $computer['note'] ?></td>
                    <td><?= $computer['availability'] ?></td>
                    <td>
                        <button onclick="create_a_edit_form(<?= $computer['id'] ?>);">Sửa</button>
                        <form action="/computer/delete" method="post" style="display: inline-block;">
                            <input type="hidden" name="id" value="<?= $computer['id'] ?>">
                            <input type="hidden" name="room_id" value="<?= $data['id'] ?>">
                            <button type="submit">Xoá</button>
                        </form>
                        <!-- <a href="/computer/edit?id=<?= $computer['id'] ?>"><button>Sửa</button></a>
                        <a href="/computer/delete?id=<?= $computer['id'] ?>"><button>Xoá</button></a> -->
                    </td>
                </tr>
            <?php endforeach; ?>
            <script>
                function create_a_edit_form(id) {
                    document.getElementById('form-change').action = `/computer/edit?id=${id}`
                    let asdf = document.getElementById(id).children;
                    let qwer = document.getElementById('input-row').children;
                    let i = 0;
                    for(; i < asdf.length - 2; i++)
                    {
                        qwer[i].firstChild.value = asdf[i].innerHTML;
                        asdf[i].innerHTML = `<del>${asdf[i].innerHTML}</del>`
                    }
                    switch(asdf[i].innerHTML) {
                        case 'Có': qwer[i]
                    }
                }
            </script>
            <form method="post" action="/computer/new" id="form-change">
                <input type="hidden" name="room_id" id="room_id" value="<?= $data['id'] ?>">
                <tr id="input-row">
                    <td><input type="text" name="id" disabled></td>
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
            
        </table>
        <?php else: ?>
            <p>Không có máy tính nào trong phòng này.</p>
            <a href="/computer/new"><button>Thêm máy mới</button></a>
    <?php endif; ?>
    <?php if (isset($data['editable'])): ?>
        <a href="/room/edit?id=<?= $data['id'] ?>"><button>Sửa thông tin phòng</button></a>
        <a href="/room/delete?id=<?= $data['id'] ?>"><button>Xoá</button></a>
    <?php endif; ?>
    <a href="/rooms">Quay lại</a>
    <?php require_once ('stuff/footer.php'); ?>
</body>

</html>