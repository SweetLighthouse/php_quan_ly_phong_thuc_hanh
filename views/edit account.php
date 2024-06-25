<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php require_once ('stuff/header.php'); ?>
    <h2>Chỉnh sửa thông tin tài khoản</h2>

    <?= $data['message'] ?? '' ?>
    <form action="/account/edit" method="post">
        <label for="full_name">Tên đầy đủ: </label>
        <input type="text" name="full_name" id="full_name" value="<?= $data['full_name'] ?>"><br><br>

        <label for="birth">Ngày sinh: </label>
        <input type="date" name="birth" id="birth" value="<?= $data['birth'] ?>"><br><br>

        <label for="email">Email: </label>
        <input type="text" name="email" id="email" value="<?= $data['email'] ?>"><br><br>

        <label for="position">Chức vụ: </label>
        <input type="text" name="position" id="position" value="<?= $data['position'] ?>"><br><br>

        <label for="gender">Giới tính:</label>
        <select name="gender" id="gender">
            <option value="male">Nam</option>
            <option value="female">Nữ</option>
            <option value="other">Khác</option>
        </select>
        <script>
            document.getElementById('gender').value = '<?= $data['gender'] ?>';
        </script><br><br>

        <input type="submit" value="Lưu">
        <a href="/account"><button>Huỷ</button></a>
        <a href="/account/delete">Xoá tài khoản...</a>
    </form>
    <?php require_once ('stuff/footer.php'); ?>
</body>

</html>