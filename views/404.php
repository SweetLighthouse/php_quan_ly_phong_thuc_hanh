<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="public/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lỗi</title>
</head>
<body>
    <?php require_once("stuff/header.php"); ?>
    <h2>Lỗi</h2>
    Có lỗi xảy ra: <?= $data['message'] ?>
    <?php require_once("stuff/footer.php"); ?>
</body>
</html>