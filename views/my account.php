<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tài khoản của bạn</title>
</head>

<body>
    <?php require_once ('stuff/header.php'); ?>
    <h2>Thông tin tài khoản của bạn</h2>
    <p>ID: <?= $data['account_id'] ?? '' ?></p>
    <p>Tên tài khoản: <?= $data['account_name'] ?? '' ?></p>
    <p>Tên đầy đủ: <?= $data['account_full_name'] ?? '' ?></p>
    <p>Ngày sinh: <?= $data['account_birth'] ?? '' ?> (năm / tháng / ngày)</p>
    <p>Email: <?= $data['account_email'] ?? '' ?></p>
    <p>Chức vụ: <?= $data['account_position'] ?? '' ?></p>
    <p>Giới tính: <?= $data['account_gender'] ?? '' ?></p>
    <p>Tài khoản tạo ra vào lúc: <?= $data['account_created_at'] ?? '' ?></p>
    <a href="/account/update"><button>Chỉnh sửa</button></a>
    <?php require_once ('stuff/footer.php'); ?>
</body>

</html>