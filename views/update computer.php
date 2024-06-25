<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin máy tính</title>
</head>

<body>
    <?php require_once ('stuff/header.php'); ?>
    <?= $data['message'] ?? '' ?>
    <form action="/computer/edit" method="post">
        <h2>Sửa thông tin máy tính</h2>
        <label for="computer_room_id">ID phòng: </label>
        <select name="computer_room_id" id="computer_room_id">
            <?php foreach ($data['rooms'] as $room) : ?>
                <option value="<?= $room['room_id'] ?>"><?= "$room[room_id] - $room[room_name]" ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="computer_name">Tên máy: </label>
        <input type="text" name="computer_name" id="computer_name" value="<?= $data['computer_name'] ?? '' ?>" autofocus>
        <br><br>

        <label for="computer_ram">RAM: </label>
        <input type="text" name="computer_ram" id="computer_ram" value="<?= $data['computer_ram'] ?? '' ?>">
        <br><br>

        <label for="computer_cpu">CPU: </label>
        <input type="text" name="computer_cpu" id="computer_cpu" value="<?= $data['computer_cpu'] ?? '' ?>">
        <br><br>
        
        <label for="computer_vga">VGA: </label>
        <input type="text" name="computer_vga" id="computer_vga" value="<?= $data['computer_vga'] ?? '' ?>">
        <br><br>
        
        <label for="computer_monitor">Màn hình: </label>
        <input type="text" name="computer_monitor" id="computer_monitor" value="<?= $data['computer_monitor'] ?? '' ?>">
        <br><br>

        <label for="computer_note">Ghi chú mô tả máy: </label><br>
        <textarea name="computer_note" id="computer_note" cols="30" rows="10"><?= $data['computer_note'] ?? '' ?></textarea>
        <br><br>

        <span>Máy sẵn sàng để dùng?</span>
        <input type="radio" name="computer_availability" value="1" id="computer_availability_true" <?= isset($data['computer_availability']) && $data['computer_availability'] == '1' ? 'checked' : '' ?>>
        <label for="computer_availability_true">Có</label>

        <input type="radio" name="computer_availability" value="0" id="computer_availability_false" <?= isset($data['computer_availability']) && $data['computer_availability'] == '0' ? 'checked' : '' ?>>
        <label for="computer_availability_false">Không</label>
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

        <button type="submit" name="computer_id" value="<?= $data['computer_id'] ?? '' ?>">Sửa máy</button>
        <a href="/rooms">Huỷ</a>
    </form>
    <?php require_once ('stuff/footer.php'); ?>

</body>

</html>