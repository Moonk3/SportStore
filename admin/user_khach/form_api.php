<?php
include_once  '../../db/database.php';
include_once  '../../utils/utility.php';
$user = Utility::getUserToken();
if ($user == null) {
    die();
}
if (!empty($_POST)) {
    $action = Utility::getPost('action');
    switch ($action) {
        case 'delete':
            deleteUser();
            break;

        default:
            # code...
            break;
    }
}
function deleteUser()
{
    $db = new Database();
    $updated_at = date("Y-m-d H:i:s");
    $id = Utility::getPost('id');
    $sql = "UPDATE users_khach set deleted = 1,updated_at='$updated_at' WHERE id =$id";
    $db->execute($sql);
}
