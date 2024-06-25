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
    
    <h2>Chỉnh sửa thông tin tài khoản của bạn</h2>
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

    <form action="/account/edit" method="post" onsubmit="return checkIfPassWordMatch();">

        <p>ID: <?= $data['account_id'] ?? '' ?></p>

        <label for="account_password">Mật khẩu hiện tại: </label>
        <input type="password" name="account_password" id="account_password" autofocus><br><br>
        

        <label for="new_account_name">Tên tài khoản mới: </label>
        <input type="text" name="new_account_name" id="new_account_name" value="<?= $data['new_account_name'] ?? '' ?>" autofocus><br><br>

        <label for="new_account_password">Mật khẩu mới: </label>
        <input type="password" name="new_account_password" id="new_account_password"><br><br>

        <label for="new_account_password_retype">Nhập lại mật khẩu mới: </label>
        <input type="password" name="new_account_password_retype" id="new_account_password_retype"><br><br>


        <label for="account_full_name">Tên đầy đủ: </label>
        <input type="text" name="account_full_name" id="account_full_name" value="<?= $data['account_full_name'] ?? '' ?>"><br><br>

        <label for="account_birth">Ngày sinh: </label>
        <input type="date" name="account_birth" id="account_birth" value="<?= $data['account_birth'] ?? '' ?>"><br><br>

        <label for="account_email">Email: </label>
        <input type="text" name="account_email" id="account_email" value="<?= $data['account_email'] ?? '' ?>"><br><br>

        <label for="account_position">Chức vụ: </label>
        <input type="text" name="account_position" id="account_position" value="<?= $data['account_position'] ?? '' ?>"><br><br>

        <label for="account_gender">Giới tính:</label>
        <select name="account_gender" id="account_gender">
            <option value="male" <?= isset($data['account_gender']) && $data['account_gender'] == 'male' ? 'selected' : '' ?>>Nam</option>
            <option value="female" <?= isset($data['account_gender']) && $data['account_gender'] == 'female' ? 'selected' : '' ?>>Nữ</option>
            <option value="other" <?= isset($data['account_gender']) && $data['account_gender'] == 'other' ? 'selected' : '' ?>>Khác</option>
        </select>

        <p>Cần nhập mật khẩu hiện để xác thực.</p>
        <p>Mật khẩu mới là không bắt buộc.</p>
        <input type="submit" value="Lưu">
        <a href="javascript:history.back()"><button type="button">Huỷ, quay lại</button></a>
        <a href="/account/delete"><button type="button">Xoá tài khoản...</button></a>
    </form>
    <?php require_once ('stuff/footer.php'); ?>
</body>

</html>