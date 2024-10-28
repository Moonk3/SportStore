<?php
include_once 'db/database.php';
include_once "utils/utility.php";
$db = new Database();
$name = $email = $msg = '';
if (!empty($_POST)) {
    $name = Utility::getPost('name');
    $email = Utility::getPost('email');
    $phone = Utility::getPost('phone');
    $address = Utility::getPost('address');
    $password = Utility::getPost('password');
    if( strlen($password) < 6) {
        $msg = "Mật khẩu phải tối thiểu 6 ký tự";
    }else{
        $sql1 = "SELECT * FROM users_khach WHERE email='{$email}'";
        $userExist = $db->executeResult($sql1, true);
        if ($userExist != null) {
            $msg = "Email đã tồn tại, vui lòng nhập email khác";
        } else {
            $sql = "INSERT INTO users_khach (name, email, phone, address, password, role) VALUES ('$name', '$email', '$phone', '$address', '$password', 3)";

            $db->execute($sql);
            $msg1 = "Đăng ký tài khoản thành công!!!";
        }
    }
}