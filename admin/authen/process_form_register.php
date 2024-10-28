<?php
include_once '../../db/database.php';
include_once "../../utils/utility.php";
$db = new Database();
$fullname = $email = $msg = '';
if (!empty($_POST)) {
    $fullname = Utility::getPost('fullname');
    $email = Utility::getPost('email');
    $phone = Utility::getPost('phone');
    $address = Utility::getPost('address');
    $password = Utility::getPost('password');

    if (empty($fullname) || empty($email) || empty($address) || empty($phone) || empty($password) || strlen($password) < 3) {
        $msg = "Vui lòng điền đầy đủ thông tin";
    } else {
        $sql1 = "SELECT * FROM users WHERE email='$email'";
        $userExist = $db->executeResult($sql1, true);
        if ($userExist != null) {
            $msg = "Email đã tồn tại, vui lòng nhập email khác";
        } else {
            $created_at = $updated_at = date('Y-m-d H:i:s');
            $password = Utility::getSecurityMD5($password);
            $sql = "INSERT INTO users (fullname,email,phone_number,address,password,role_id,created_at,updated_at) VALUES ('$fullname','$email','$phone','$address','$password',1,'$created_at','$updated_at')";
            $db->execute($sql);
            $msg1 = "Đăng ký tài khoản thành công!!!";
            // echo '
			// 	<script>
			// 		window.location.href = "login.php";
			// 	</script>';
        }
    }
}
