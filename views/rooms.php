<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Các phòng của </title>
</head>

<body>
    <?php require_once ("stuff/header.php"); ?>
    <h2>Phòng của <a href="/account?id=<?= $data['owner']['account_id'] ?? '' ?>"><?= $data['owner']['account_name'] ?? '' ?></a>:</h2>
    <?php if (isset($data['rooms']) && count($data['rooms']) != 0): ?>
        <table>
            <tr>
                <td>ID phòng</td>
                <td>Tên phòng</td>
                <td>Vị trí phòng</td>
                <!-- <td>Mô tả</td> -->
                <td>Khả dụng</td>
                <!-- <td>Số máy</td> -->
                <td>Hành động</td>
            </tr>
            <?php foreach ($data['rooms'] as $room): ?>
                <tr>
                    <td><?= $room['room_id'] ?></td>
                    <td><?= $room['room_name'] ?></td>
                    <td><?= $room['room_position'] ?></td>
                    <!-- <td><?= $room['room_description'] ?></td> -->
                    <td><?= $room['room_availability'] ?></td>
                    <!-- <td><?= $room['room_computers_count'] ?></td> -->
                    <td>
                        <a href="/room?id=<?= $room['room_id'] ?>"><button>Xem</button></a>
                        <a href="/request/create?room_id=<?= $room['room_id'] ?>"><button>Thuê</button></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Không có phòng nào để hiển thị.</p>
    <?php endif; ?>
    <?php require_once ("stuff/footer.php"); ?>
</body>

</html>