<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tất cả các phòng</title>
</head>

<body>
    <?php require_once ("stuff/header.php"); ?>
    <h2>Tất cả các người dùng</h2>
    <table>
        <tr>
            <td>Tên</td>
            <td>Tên đầy đủ</td>
            <td>Hành động</td>
        </tr>
        <?php foreach ($data as $record): ?>
            <tr>
                <td><?= $record['name'] ?></td>
                <td><?= $record['full_name'] ?></td>
                <td>
                    <a href="/account?id=<?= $record['id'] ?>"><button>Xem</button></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php require_once ("stuff/footer.php"); ?>
</body>

</html>