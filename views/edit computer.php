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
    <form action="/computer/edit" method="post">
        <h2>Sửa thông tin máy tính</h2>

        <input type="hidden" name="id" value="<?= $data['id'] ?? '' ?>">
        
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
        <input type="radio" name="availability" value="1" id="availability-true">
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

        <input type="submit" value="Sửa máy">
        <a href="/rooms">Huỷ</a>
    </form>
    <?php require_once ('stuff/footer.php'); ?>

</body>

</html>