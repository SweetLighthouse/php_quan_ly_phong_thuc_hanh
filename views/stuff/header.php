<h2>Chương trình quản lý phòng thực hành</h2>
<?php if (\SWLH\controller\user::islogin()): ?>
    Xin chào, <?= \SWLH\controller\user::user_name() ?>
    <a href="/room">Xem tất cả các phòng</a>
    <a href="/logout">Đăng xuất</a>
<?php else: ?>
    Bạn chưa đăng nhập.
    <a href="/login">Đăng nhập</a>
    <a href="/register">Đăng ký</a>
<?php endif; ?>
<p>--------------------------------------------------------------------------------</p>