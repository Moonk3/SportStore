<?php
$db = new Database();
if (!empty($_POST)) {
    $id = Utility::getPost('id');
    $fullname = Utility::getPost('fullname');
    $address = Utility::getPost('address');
    $phone_number = Utility::getPost('phone_number');
    $email = Utility::getPost('email');
    $avatar = moveFile('avatar');
    $password = Utility::getPost('password');
    $password != '' ? $password = Utility::getSecurityMD5($password) : $password;
    $role_id = Utility::getPost('role_id');
    $created_at = $updated_at = date('Y-m-d H:i:s');


    if ($id > 0) {
        // update
        $sql = "SELECT * FROM users WHERE email='$email' AND id <> $id";
        $userItem = $db->executeResult($sql, true);
        if ($userItem != null) {
            $msgfail = 'Email này đã tồn tại trong tài khoản khác, vui lòng kiểm tra lại';
        } else {
            if ($password != '' || $avatar != '') {
                // đổi mật khẩu
                $sql = "UPDATE users set avatar='$avatar',fullname='$fullname',email='$email',phone_number='$phone_number',address='$address',password='$password',role_id=$role_id,updated_at='$updated_at' WHERE id =$id";
                $db->execute($sql);
                $msgsuccess = "Sửa tài khoản thành công";
            } else {
                // truong hop mat khau la rỗng
                $sql = "UPDATE users set fullname='$fullname',email='$email',phone_number='$phone_number',address='$address',role_id=$role_id,updated_at='$updated_at' WHERE id =$id";

                $db->execute($sql);

                $msgsuccess = "Sửa tài khoản thành công";
            }
        }
    } else {
        // insert
        $sql = "SELECT * FROM users WHERE email='$email'";
        $userItem = $db->executeResult($sql, true);
        if ($userItem != null) {
            // tai khoan ton tai => faild
            $msgfail = 'Email đã được đăng ký, vui lòng kiểm tra lại';
        } else {
            $sql = "INSERT INTO users (fullname,email,phone_number,address,password,avatar,role_id,created_at,updated_at) VALUES ('$fullname','$email','$phone_number','$address','$password','$avatar',$role_id,'$created_at','$updated_at')";
            $db->execute($sql);
            $msgsuccess = "Đăng ký tài khoản thành công";
            $fullname = $role_id = $phone_number = $address = $password = '';
        }
    }
}
