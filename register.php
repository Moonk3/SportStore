<?php
require_once('layouts/header.php');
include_once 'utils/utility.php';
include_once 'db/database.php';
include_once "sol_register.php";
?>
<div class="container" style="margin: 20px auto;">
	<form method="post" id="signup-form" onsubmit="return true">
		<div class="" >
			<div   align="center">
				<div class="form-group">
					<legend style="font-size:40px; font-weight:bold; color:black;">Đăng ký</legend>
				</div>
					<h3 style="color:red"><?= isset($msg) ? $msg : '' ?></h3>
                    <h3 style="color:green"><?= isset($msg1) ? $msg1 : '' ?></h3>
				<div class="form-group">
					<input required="true" type="text" class="form-control" name="name" placeholder="Nhập Họ tên">
				</div>
				<div class="form-group">
					<input required="true" type="email" class="form-control" name="email" placeholder="Nhập email">
				</div>
				<div class="form-group">
					<input required="true" type="number" class="form-control" name="phone" placeholder="Nhập sđt">
				</div>
				<div class="form-group">
					<input required="true" type="text" class="form-control" name="address" placeholder="Nhập địa chỉ">
				</div>
				<div class="form-group">
					<input required="true" type="password" class="form-control" name="password" placeholder="Nhập mật khẩu">
				</div>
				<div class="form-group">
					<input required="true" type="password" class="form-control" name="password_in" placeholder="Nhập lại mật khẩu">
				</div>
				<button name="submit" type="submit" class="btn btn-success" style="border-radius: 5px; font-size: 20px; width: 25%; margin-bottom: 16px;">Đăng ký</button>
				<div class="form-group">
					<a href="Login.php" class="btn btn-primary" style="width: 60%; height: 50px; line-height: 35px; font-size: 18px;">Bạn đã có tài khoản? Đăng Nhập</a>
				</div>
			</div>
		</div>
	</form>
</div>
<?php
require_once('layouts/footer.php');
?>