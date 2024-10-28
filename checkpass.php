<?php
//ob_start(); // Bắt đầu bộ đệm đầu ra
	include_once 'db/database.php';
	include_once "utils/utility.php";
	$db = new Database();
	$password = $email = $msg = '';
	if (!empty($_POST)) {
		$email = Utility::getPost('email');
		$password = Utility::getPost('pass');
		if (empty($email) || empty($password)) {
		} else {
			$sql = "SELECT * FROM users_khach WHERE email='{$email}' AND password='$password'";
			$userExist = $db->executeResult($sql);
			if ($userExist == null) {
				$msg = "Tên email hoặc mật khẩu không hợp lệ, vui lòng kiểm tra lại";
				$_SESSION['isLogin'] = 0;
			} else {
				// login thanh cong
				$_SESSION['isLogin'] = 1;
				//$_SESSION['login'] = $userExist;
				foreach ($userExist as $row) {
					$_SESSION['id'] = $row['id'];
					$_SESSION['name'] = $row['name'];
					$_SESSION['email'] = $row['email'];
					$_SESSION['phone'] = $row['phone'];
					$_SESSION['address'] = $row['address'];
				}
				$msg1 = "Đăng nhập tài khoản thành công!!!";
				echo '
				<script>
					window.location.href = "index.php";
				</script>';
			}
		}
	}
//ob_end_flush();
?>