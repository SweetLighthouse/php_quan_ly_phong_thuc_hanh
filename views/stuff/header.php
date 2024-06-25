<a href="/"><h2>Chương trình quản lý phòng thực hành</h2></a>
<?php if (isset($_SESSION['token'])): ?>
    Xin chào, <a href="/account"><?= $_SESSION['name'] ?></a><span>.</span>
    <a href="/rooms">Phòng bạn quản lý</a>
    <a href="/rooms/all">Xem các phòng</a>
    <a href="/accounts">Xem các người dùng</a>
    <a href="/logout">Đăng xuất</a>
<?php else: ?>
    Bạn chưa đăng nhập.
    <a href="/login">Đăng nhập</a>
    <a href="/register">Đăng ký</a>
<?php endif; ?> 
<p>--------------------------------------------------------------------------------</p>
