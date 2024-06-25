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
    <h2>Tất cả các phòng</h2>
    <?php if (count($data) == 0): ?>
        <p>Không có phòng nào để hiển thị.</p>
        <a href="/room/new"><button>Thêm phòng mới</button></a><br><br>
    <?php else: ?>
        <a href="/room/new"><button>Thêm phòng mới</button></a><br><br>
        <table>
            <tr>
                <td>ID phòng</td>
                <td>ID Người sở hữu</td>
                <td>Tên phòng</td>
                <td>Vị trí phòng</td>
                <!-- <td>Mô tả</td> -->
                <td>Khả dụng</td>
                <!-- <td>Số máy</td> -->
                <td>Hành động</td>
            </tr>
            <?php foreach ($data as $record): ?>
                <tr>
                    <td><?= $record['id'] ?></td>
                    <td><?= $record['owner_id'] ?></td>
                    <td><?= $record['name'] ?></td>
                    <td><?= $record['position'] ?></td>
                    <!-- <td><?= $record['description'] ?></td> -->
                    <td><?= $record['availability'] ?></td>
                    <!-- <td><?= $record['computers_count'] ?></td> -->
                    <td>
                        <a href="/room?id=<?= $record['id'] ?>"><button>Xem</button></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    <?php require_once ("stuff/footer.php"); ?>
</body>

</html>