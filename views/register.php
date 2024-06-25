<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
</head>

<body>
    <?php require_once ('stuff/header.php'); ?>
    <h2>Đăng ký tài khoản mới</h2>
    <?= $data['message'] ?? '' ?>

    <script>
        function checkIfPassWordMatch() {
            let account_password = document.getElementById('account_password');
            let account_password_retype = document.getElementById('account_password_retype');
            if (account_password.value == account_password_retype.value) return true;
            alert('Mật khẩu phải trùng.');
            return false;
        }
    </script>
    <form action="/register" method="post" onsubmit="return checkIfPassWordMatch();">
        <h2>Đăng ký tài khoản mới</h2>
        <label for="account_name">Tài khoản (*):</label>
        <input type="text" name="account_name" id="account_name" value="<?= $data['account_name'] ?? ''?>" autofocus>
        <br><br>

        <label for="account_password">Mật khẩu (*):</label>
        <input type="password" name="account_password" id="account_password">
        <br><br>

        <label for="account_password_retype">Nhập lại mật khẩu:</label>
        <input type="password" name="account_password_retype" id="account_password_retype">
        <br><br>

        <label for="account_full_name">Tên đầy đủ:</label>
        <input type="text" name="account_full_name" id="account_full_name" value="<?= $data['account_full_name'] ?? ''?>">
        <br><br>

        <label for="account_birth">Ngày sinh:</label>
        <input type="date" name="account_birth" id="account_birth" value="<?= $data['account_birth'] ?? ''?>">
        <br><br>

        <label for="account_email">Email:</label>
        <input type="text" name="account_email" id="account_email" value="<?= $data['account_email'] ?? ''?>">
        <br><br>

        <label for="account_position">Chức vụ:</label>
        <input type="text" name="account_position" id="account_position" value="<?= $data['account_postiion'] ?? ''?>">
        <br><br>

        <label for="account_gender">Giới tính:</label>
        <select name="account_gender" id="account_gender">
            <option value="male" <?= isset($data['account_gender']) && $data['account_gender'] == 'male' ? 'checked' : '' ?>>Nam</option>
            <option value="female" <?= isset($data['account_gender']) && $data['account_gender'] == 'female' ? 'checked' : '' ?>>Nữ</option>
            <option value="other" <?= isset($data['account_gender']) && $data['account_gender'] == 'other' ? 'checked' : '' ?>>Khác</option>
        </select>
        <br><br>

        <input type="submit" value="Đăng ký">

        <p>Dấu sao ( * ) có nghĩa là bắt buộc.</p>
        <p>Tài khoản và mật khẩu dài từ 3 - 60 ký tự, chỉ bao gồm chữ cái hoa, thường, số, gạch ngang - và gạch dưới _
        </p>

    </form>
    <?php require_once ('stuff/footer.php'); ?>
</body>

</html>