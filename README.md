Project sử dụng server apache hỗ trợ php, database management system sử dụng phpmyadmin
Tất cả do Xampp cung cấp.

Cài đặt:
1. Import file swlh_db.php
2. Cài đặt các biến môi trường ở dòng thứ 8 trong file /core/model cho phù hợp.
model::$conn = new \mysqli('localhost', 'root', '', 'swlh_db');

Project quản lý phòng thực hành.
Các chức năng:
Đăng ký, đăng nhập, xoá tài khoản.
Xem phòng thực hành bất kì. Thêm, sửa, xoá phòng theo tài khoản theo tài khoản.
Xem các máy trong phòng thực hành. Thêm, sửa, xoá máy trong phòng thực hành.
