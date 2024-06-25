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
    <h2>Thông tin tài khoản</h2>
    <p>ID: <?= $data['id'] ?></p>
    <p>Tên tài khoản: <?= $data['name'] ?></p>
    <p>Tên đầy đủ: <?= $data['full_name'] ?></p>
    <p>Ngày sinh: <?= $data['birth'] ?> (năm / tháng / ngày)</p>
    <p>Email: <?= $data['email'] ?></p>
    <p>Chức vụ: <?= $data['position'] ?></p>
    <p>Giới tính: <?= $data['gender'] ?></p>
    <p>Tài khoản tạo ra vào lúc: <?= $data['created_at'] ?></p>
    <?php if(isset($data['editable'])): ?>
        <a href="/account/edit"><button>Chỉnh sửa</button></a>
    <?php endif; ?>
    <?php require_once ('stuff/footer.php'); ?>
</body>

</html>