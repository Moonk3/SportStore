<?php
session_start();
include_once '../../utils/utility.php';
// include_once '../../database/dbhelper.php';
include_once "../../db/database.php";
include_once "./process_form_register.php";
$user = Utility::getUserToken();
if ($user != null) {
    header("Location: ../index.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng ký</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <style>
        body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background: linear-gradient(135deg, #71b7e6, #9b59b6);
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .container {
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .signup-content {
        padding: 40px;
        text-align: center;
    }

    h2 {
        font-size: 36px;
        color: #333;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-input,
    .form-control {
        width: 100%;
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 25px;
        box-sizing: border-box;
        background: rgba(255, 255, 255, 0.7);
        color: #333;
        font-size: 16px;
    }

    .form-input:focus {
        border-color: #b18757;
        outline: none;
    }

    .field-icon {
        cursor: pointer;
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 20px;
        color: #ccc;
    }

    .toggle-password {
        color: #b18757;
    }

    .toggle-password:hover {
        color: #333;
    }

    .form-submit {
        width: 100%;
        display: inline-block;
        padding: 15px;
        border-radius: 25px;
        cursor: pointer;
        text-decoration: none;
        background: #2ecc71;
        font-size: 18px;
        color: #fff;
        border: none;
        margin-bottom: 10px;
    }

    .form-submit:hover {
        background: #27ae60;
    }

    .password-wrapper {
        position: relative;
    }

    .password-wrapper input {
        padding-right: 40px;
    }

    .password-wrapper .field-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 20px;
        color: #ccc;
        cursor: pointer;
        z-index: 2;
    }

    .form-group {
        position: relative;
    }

    .form-group i {
        position: absolute;
        right: 10px; 
        top: 50%;
        transform: translateY(-50%);
        color: #ccc;
    }

    .icon {
        font-size: 20px;
        margin-left: 10px; 
    }

    .form-input {
        padding-right: 30px;
    }
    </style>
</head>
<body>
    <div class="main">
        <div class="container">
            <div class="signup-content">
                <form method="POST" id="signup-form" class="signup-form" onsubmit="return validateForm()">
                    <h2>Đăng ký tài khoản</h2>
                    <div class="form-group">
                        <input type="text" class="form-input" name="fullname" id="fullname" placeholder="Tên của bạn">
                        <i class="icon fas fa-user"></i>
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-input" name="email" id="email" placeholder="Nhập email">
                        <i class="icon fas fa-envelope"></i>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="phone" placeholder="Nhập sđt">
                        <i class="icon fas fa-phone"></i>
                    </div> 

                    <div class="form-group">
                        <input type="text" class="form-control" name="address" placeholder="Nhập địa chỉ">
                        <i class="icon fas fa-map-marker-alt"></i>
                    </div>

                    <div class="form-group password-wrapper">
                        <input type="password" class="form-input" name="password" id="password" placeholder="Nhập mật khẩu" minlength="1" />
                        <span class="zmdi zmdi-eye field-icon toggle-password" onclick="togglePassword('#password')"></span>
                    </div>

                    <div class="form-group password-wrapper">
                        <input type="password" class="form-input" name="password" id="confirm_password" placeholder="Xác nhận mật khẩu" minlength="1" />
                        <span class="zmdi zmdi-eye field-icon toggle-password" onclick="togglePassword('#confirm_password')"></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" id="submit" class="form-submit submit" value="Đăng ký" />
                        <a href="login.php" class="submit-link submit">Đăng nhập</a>
                    </div>
                </form>
                <?php
    // Hiển thị thông báo thành công hoặc lỗi
    if (!empty($msg)) {
        echo '<p style="color: red;">' . $msg . '</p>';
    } elseif (!empty($msg1)) {
        echo '<p style="color: green;">' . $msg1 . '</p>';
    }
    ?>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        function validateForm() {
            var fullname = $('#fullname').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var address = $('#address').val();
            var password = $('#password').val();
            var confirm_password = $('#confirm_password').val();

            if (fullname =='' || email=='' || phone =='' || address =='' || password ==''|| confirm_password =='') {
                alert("Vui lòng điền đủ thông tin");
                return false;
            }

            if (password != confirm_password) {
                alert("Mật khẩu không khớp, vui lòng kiểm tra lại");
                return false;
            }

            return true;
        }

        function togglePassword(inputId) {
            var passwordField = $(inputId);
            var fieldType = passwordField.attr('type');
            if (fieldType === 'password') {
                passwordField.attr('type', 'text');
            } else {
                passwordField.attr('type', 'password');
            }
        }
    </script>
</body>

</html>