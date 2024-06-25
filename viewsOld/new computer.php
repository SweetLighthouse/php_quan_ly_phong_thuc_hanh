<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
</head>

<body>
    <?php require_once ('stuff/header.php'); ?>

    <?= $data['message'] ?? '' ?>
    <form action="/computer/new" method="post">
        <h2>Thêm máy tính mới</h2>

        <label for="room_id">ID phòng: </label>
        <select name="room_id" id="room_id">
            <?php foreach ($data['room_id_list'] as $k => $room) : ?>
                <option value="<?= $room['id'] ?>"><?= "$room[id] - $room[name]" ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <label for="name">Tên máy: </label>
        <input type="text" name="name" id="name" value="<?= $data['name'] ?? '' ?>" autofocus>
        <br><br>

        <label for="ram">RAM: </label>
        <input type="text" name="ram" id="ram" value="<?= $data['ram'] ?? '' ?>">
        <br><br>

        <label for="cpu">CPU: </label>
        <input type="text" name="cpu" id="cpu" value="<?= $data['cpu'] ?? '' ?>">
        <br><br>
        
        <label for="vga">VGA: </label>
        <input type="text" name="vga" id="vga" value="<?= $data['vga'] ?? '' ?>">
        <br><br>
        
        <label for="monitor">Màn hình: </label>
        <input type="text" name="monitor" id="monitor" value="<?= $data['monitor'] ?? '' ?>">
        <br><br>

        <label for="note">Ghi chú mô tả máy: </label><br>
        <textarea name="note" id="note" cols="30" rows="10"><?= $data['note'] ?? '' ?></textarea>
        <br><br>

        <span>Máy sẵn sàng để dùng?</span>
        <input type="radio" name="availability" value="1" id="availability-true" checked>
        <label for="availability">Có</label>

        <input type="radio" name="availability" value="0" id="availability-false">
        <label for="availability">Không</label>
        <br><br>

        <script>
            switch(<?= $data['availability'] ?? '' ?>) {
            case 1:
                document.getElementById('availability-true').checked = true;
                break;
            case 0:
                document.getElementById('availability-false').checked = true;
                break;
            default:
                break;
            }
            
        </script>

        <label for="computer_quantity">Số lượng máy thêm:</label>
        <input type="number" name="computer_quantity" id="computer_quantity" step="1" min="0" max="100" value="1"><br><br>

        <input type="submit" value="Thêm máy">
        <a href="/rooms">Huỷ</a>
    </form>
    <?php require_once ('stuff/footer.php'); ?>

</body>

</html>