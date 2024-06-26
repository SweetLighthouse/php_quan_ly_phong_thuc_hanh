<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tài khoản</title>
</head>

<body>
    <?php require_once ('stuff/header.php'); ?>
    <h2>Thông tin tài khoản</h2>
    <p>Tên đầy đủ: <?= $data['account_full_name'] ?? '' ?></p>
    <p>Email: <?= $data['account_email'] ?? '' ?></p>
    <p>Chức vụ: <?= $data['account_position'] ?? '' ?></p>
    <p>Giới tính: <?= $data['account_gender'] ?? '' ?></p>
    <a href="javascript:history.back()"><button type="button">Quay lại</button></a>
    <?php require_once ('stuff/footer.php'); ?>
</body>

</html>