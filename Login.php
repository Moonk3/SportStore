<?php
require_once('layouts/header.php');
// var_dump($_POST);
include_once 'db/database.php';
//include_once "utils/utility.php";
include_once "checkpass.php";
?>
<div class="container" style="margin: 20px auto; ">
	<form method="post" onsubmit="return true">
		<div class="from"  align=center>
			<div class="form-group">
				<legend style="font-size:40px; font-weight:bold; color:black;">ĐĂNG NHẬP</legend>
			</div>
			<h5 style="color:red"><?= $msg ?></h5>
			<h5 style="color:green"><?= isset($msg1) ? $msg1 : '' ?></h5><br>
			<div class="form-group" >
				<input required="true" type="email" class="form-control" id="email" name="email" placeholder="Nhập email" value="<?= $email ?>">
			</div>
			<div class="form-group">
				<input required="true" type="password" class="form-control" id="password" name="pass" placeholder="Nhập mật khẩu" value="<?= $password ?>">
			</div>
			<div class="form-group">
				<input type="submit" id="submit" value="ĐĂNG NHẬP" name="login" class="btn btn-success">
			</div>
			<div class="form-group">
				<a href="register.php" class="btn btn-primary">Bạn chưa có tài khoản? Đăng ký</a>
			</div>
			

		</div>
	</form>
</div>

	<script src="admin/authen/vendor/jquery/jquery.min.js"></script>
    <script src="admin/authen/js/main.js"></script>
    <script>
        function validateFormLogin() {
            $password = $('#password').val();
            $email = $('#email').val();
            if ($password == "" || $email == "") {
                alert("Vui lòng điền đủ thông tin");
                return false;
            }
            return true;
        }
    </script>

<?php
require_once('layouts/footer.php');
?>