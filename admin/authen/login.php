<?php
session_start();
// include_once '../../database/dbhelper.php';
include_once '../../db/database.php';
include_once "../../utils/utility.php";
include_once "./process_form_login.php";
$user = Utility::getUserToken();

if ($user != null) {
    header("Location:  ./index.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập</title>
    
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

        .form-input {
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
    </style>
</head>

<body>

    <div class="main">
        <div class="container">
            <div class="signup-content">
                <form method="POST" id="signup-form" class="signup-form" onsubmit="return validateFormLogin()">
                    <h2>Đăng nhập</h2>
                    <div class="form-group">
                        <input type="email" class="form-input" name="email" id="email" placeholder="Nhập email"
                            value="<?= $email ?>" />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-input" name="password" id="password"
                            placeholder="Nhập mật khẩu" minlength="1" />
                        <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" id="submit" class="form-submit" value="Đăng nhập" />
                        <a href="register.php" class="submit-link">Đăng ký tài khoản mới</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
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
</body>
</html>