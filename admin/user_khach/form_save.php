<?php
$db = new Database();
if (!empty($_POST)) {
    $id = Utility::getPost('id');
    $name = Utility::getPost('name');
    $address = Utility::getPost('address');
    $phone = Utility::getPost('phone');
    $email = Utility::getPost('email');
    // $avatar = moveFile('avatar');
    // $password = Utility::getPost('password');
    // $password != '' ? $password = Utility::getSecurityMD5($password) : $password;
    //$role_id = Utility::getPost('role_id');
    $created_at = $updated_at = date('Y-m-d H:i:s');


    if ($id > 0) {
        // update
        $sql = "SELECT * FROM users_khach WHERE email='$email' AND id <> $id";
        $userItem = $db->executeResult($sql, true);
        if ($userItem != null) {
            $msgfail = 'Email này đã tồn tại trong tài khoản khác, vui lòng kiểm tra lại';
        } else {
            if ($name != '') {
                // đổi mật khẩu
                $sql = "UPDATE users_khach set name='$name',email='$email',phone='$phone',address='$address' WHERE id =$id";
                $db->execute($sql);
                $msgsuccess = "Sửa tài khoản thành công";
            
            }
        }
    } else {
        // insert
        $sql = "SELECT * FROM users_khach WHERE email='$email'";
        $userItem = $db->executeResult($sql, true);
        if ($userItem != null) {
            // tai khoan ton tai => faild
            $msgfail = 'Email đã được đăng ký, vui lòng kiểm tra lại';
        } else {
            $sql = "INSERT INTO users_khach (name,email,phone,address) VALUES ('$name','$email','$phone','$address')";
            $db->execute($sql);
            $msgsuccess = "Đăng ký tài khoản thành công";
            $name = $phone = $address = $password = '';
        }
    }
}
