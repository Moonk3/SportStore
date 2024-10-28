<?php
// include_once '../../database/dbhelper.php';
include_once '../../db/database.php';
include_once "../../utils/utility.php";
$db = new Database();
$password = $email = $msg = '';
if (!empty($_POST)) {
    $email = Utility::getPost('email');
    $password = Utility::getPost('password');
    $password = Utility::getSecurityMD5($password);
    if (empty($email) || empty($password)) {
    } else {
        $userExist = $db->executeResult("SELECT * FROM users WHERE email='{$email}' AND password='$password' AND deleted=0", true);
        if ($userExist == null) {
            $msg = "Tên email hoặc mật khẩu không hợp lệ, vui lòng kiểm tra lại";
        } else {
            // login thanh cong
            $created_at = date("Y-m-d H:i:s");
            $token = Utility::getSecurityMD5($userExist['email'] . time());
            setcookie('token', $token, time() + 7 * 24 * 60 * 60, '/');
            $_SESSION['user'] = $userExist;
            $userId = $userExist['id'];
            $sql = "INSERT INTO tokens (user_id,token,created_at) VALUES ($userId,'$token','$created_at')";
            $db->execute($sql);
            header("Location: ../index.php ");
            die();
        }
    }
}
