<h2>Chương trình quản lý phòng thực hành</h2>
<?php if (\SWLH\controller\home::is_login()): ?>

    Xin chào, <?= $_SESSION['account_name'] ?>
    <?php if ($_SESSION['account_type'] == 'user'):?>
        <p>Bạn là người sử dụng phòng.</p>
    <?php else: ?>
        <p>Bạn là người quản lý phòng.</p>
    <?php endif; ?>
    <a href="/account">Xem tài khoản</a>
    <a href="/room">Xem tất cả các phòng</a>
    <a href="/logout">Đăng xuất</a>
<?php else: ?>
    Bạn chưa đăng nhập.
    <a href="/login">Đăng nhập</a>
    <a href="/register/user">Đăng ký sử dụng phòng</a>
    <a href="/register/owner">Đăng ký tạo và quản lý phòng</a>
<?php endif; ?>
<p>--------------------------------------------------------------------------------</p>
