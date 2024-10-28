<?php
class Utility
{
    public static $private_key = "indfajfadsfsdaf%UU(*sdxx$2X^FSafdfds)";
    public static function fixSqlInject($sql)
    {
        $sql = str_replace('\\', '\\\\', $sql);
        $sql = str_replace('\'', '\\\'', $sql);
        return $sql;
    }
    public static function getGet($key)
    {
        $value = '';
        if (isset($_GET[$key])) {
            $value = $_GET[$key];
            $value = self::fixSqlInject($value);
        }
        return trim($value);
    }
    public static function getPost($key)
    {
        $value = '';
        if (isset($_POST[$key])) {
            $value = $_POST[$key];
            $value = self::fixSqlInject($value);
        }
        return trim($value);
    }
    public static function getCookie($key)
    {
        $value = '';
        if (isset($_COOKIE[$key])) {
            $value = $_COOKIE[$key];
            $value = self::fixSqlInject($value);
        }
        return trim($value);
    }
    public static function getSecurityMD5($password)
    {
        return md5(md5($password) . self::$private_key);
    }
    public static function getUserToken()
    {
        // Kiểm tra xem session có tồn tại thông tin người dùng hay không
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        // Nếu session không tồn tại, thử lấy giá trị token từ cookie
        $token = self::getCookie('token');
        $sql = "SELECT * FROM tokens WHERE token='$token'";
        $db = new Database();
        $item = $db->executeResult($sql, true);
        if ($item != null) {
            // Thực hiện truy vấn cơ sở dữ liệu để lấy thông tin người dùng từ token
            $userId = $item['user_id'];
            $sql = "SELECT * FROM users WHERE id='$userId' AND deleted=0";
            $item = $db->executeResult($sql, true);
            // Nếu tìm thấy thông tin người dùng, lưu vào session để sử dụng sau này
            if ($item != null) {
                $_SESSION['user'] = $item;
                return $item;
            }
        }
        return null;
    }
}

// Hàm di chuyển file (ảnh)
function moveFile($key, $rootPath = "../../") {
    // Không chọn file nào thì sẽ return về ''
    if(!isset($_FILES[$key]) || !isset($_FILES[$key]['name']) || $_FILES[$key]['name'] == '') {
        return '';
    }

    $pathTemp = $_FILES[$key]["tmp_name"]; // lấy đường dẫn tạm thời

    $filename = $_FILES[$key]['name']; // lấy ra tên của cái ảnh vd:hello.jpg => hello
    // Xử lý tên file tránh trường hợp người dùng đăng tên file có nhiều ký tự lạ
    // Code ...

    $newPath="assets/photos/".$filename; // lưu ảnh vào folder

    move_uploaded_file($pathTemp, $rootPath.$newPath); // di chuyển cái $pathTemp sang đường dẫn mới

    return $newPath;
}

// fix đường dẫn khi link ảnh
function fixUrl($thumbnail, $rootPath = "../../") {
    if(stripos($thumbnail, 'http://') !== false || stripos($thumbnail, 'https://') !== false) {
    } else {
        $thumbnail = $rootPath.$thumbnail;
    }

    return $thumbnail;
}