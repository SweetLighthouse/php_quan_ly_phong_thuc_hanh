<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tất cả các tài khoản</title>
</head>

<body>
    <?php require_once ("stuff/header.php"); ?>
    <h2>Tất cả các tài khoản</h2>
    <table>
        <tr>
            <td>Tên</td>
            <td>Tên đầy đủ</td>
            <td>Hành động</td>
        </tr>
        <?php foreach ($data as $room): ?>
            <tr>
                <td><?= $room['account_name'] ?? '' ?></td>
                <td><?= $room['account_full_name'] ?? '' ?></td>
                <td>
                    <a href="/account?id=<?= $room['account_id'] ?? '' ?>"><button>Xem</button></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php require_once ("stuff/footer.php"); ?>
</body>

</html>