<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/public/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
</head>
<body>
    <?php require_once('stuff/header.php'); ?>
    <?= $data['message'] ?? '' ?>
    <?php require_once('stuff/footer.php'); ?>
</body>
</html>