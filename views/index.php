<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
</head>

<body>
    <?php require_once ('stuff/header.php'); ?>
    <?= $data['message'] ?? '' ?>

    <h2>Yêu cầu cần xử lý</h2>
    <?php if (isset($data['in_requests']) && count($data['in_requests']) > 0): ?>
        <table>
            <tr>
                <td>ID phòng yêu cầu</td>
                <td>ID người yêu cầu</td>
                <td>Từ lúc</td>
                <td>Đến lúc</td>
                <td>Lý do</td>
                <td>Đồng ý?</td>
            </tr>
            <?php foreach ($data['in_requests'] as $in_request): ?>
                <tr>
                    <td><a href="/room?id=<?= $in_request['request_room_id'] ?? '' ?>"><?= $in_request['request_room_id'] ?? '' ?></a></td>
                    <td><a href="/account?id=<?= $in_request['request_account_id'] ?? '' ?>"><?= $in_request['request_account_id'] ?? '' ?></a></td>
                    <td><?= $in_request['request_from_time'] ?? '' ?></td>
                    <td><?= $in_request['request_to_time'] ?? '' ?></td>
                    <td><?= $in_request['request_reason'] ?? '' ?></td>
                    <td>
                        <a href="/request/update?id=<?= $in_request['request_id'] ?>&approved=1"><button>Có</button></a>
                        <a href="/request/update?id=<?= $in_request['request_id'] ?>&approved=0"><button>Không</button></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

    <?php else: ?>
        <p>Không có.</p>
    <?php endif; ?>

    <h2>Yêu cầu đã xử lý</h2>
    <?php if (isset($data['resolved_requests']) && count($data['resolved_requests']) > 0): ?>
        <table>
            <tr>
                <td>ID phòng yêu cầu</td>
                <td>ID người yêu cầu</td>
                <td>Từ lúc</td>
                <td>Đến lúc</td>
                <td>Lý do</td>
                <td>Trả lời</td>
            </tr>
            <?php foreach ($data['resolved_requests'] as $in_request): ?>
                <tr>
                    <td><a href="/room?id=<?= $in_request['request_room_id'] ?? '' ?>"><?= $in_request['request_room_id'] ?? '' ?></a></td>
                    <td><a href="/account?id=<?= $in_request['request_account_id'] ?? '' ?>"><?= $in_request['request_account_id'] ?? '' ?></a></td>
                    <td><?= $in_request['request_from_time'] ?? '' ?></td>
                    <td><?= $in_request['request_to_time'] ?? '' ?></td>
                    <td><?= $in_request['request_reason'] ?? '' ?></td>
                    <td>
                        <?= isset($in_request['request_approved']) && $in_request['request_approved'] == 1 ? 'Có' : 'Không' ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

    <?php else: ?>
        <p>Không có.</p>
    <?php endif; ?>

    <h2>Các phòng bạn yêu cầu</h2>
    <?php if (isset($data['out_requests']) && count($data['out_requests']) > 0): ?>
        
        <table>
            <tr>
                <td>ID phòng yêu cầu</td>
                <td>Từ lúc</td>
                <td>Đến lúc</td>
                <td>Lý do mượn</td>
                <td>Ý kiến chủ phòng</td>
                <td>Hành động</td>
            </tr>
            <?php foreach ($data['out_requests'] as $out_request): ?>
                <tr>
                    <td><a href="/room?id=<?= $out_request['request_room_id'] ?? '' ?>"><?= $out_request['request_room_id'] ?? '' ?></a></td>
                    <td><?= $out_request['request_from_time'] ?? '' ?></td>
                    <td><?= $out_request['request_to_time'] ?? '' ?></td>
                    <td><?= $out_request['request_reason'] ?? '' ?></td>
                    <td>
                        <?php 
                        if (isset($out_request['request_approved'])) {
                            switch($out_request['request_approved']) {
                            case 1: echo 'Đồng ý'; break;
                            case 0: echo 'Không đồng ý'; break;
                            case -1: echo 'Chưa trả lời'; break;
                            }
                        }
                        ?>
                    </td>
                    <td>
                        <?php if (isset($out_request['request_approved']) && $out_request['request_approved'] == -1): ?>
                            <a href="/request/update?id=<?= $out_request['request_id'] ?? '' ?>"><button>Sửa</button></a>
                            <a href="/request/delete?id=<?= $out_request['request_id'] ?? '' ?>"><button>Xoá</button></a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Bạn chưa yêu cầu phòng nào cả.</p>
    <?php endif; ?>
    <?php require_once ('stuff/footer.php'); ?>
</body>

</html>