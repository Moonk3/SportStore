<?php
include_once  '../../db/database.php';
include_once  '../../utils/utility.php';
if (!empty($_POST)) {
    $action = Utility::getPost('action');
    switch ($action) {
        case 'update_status':
            updateStatus();
            break;

        default:
            break;
    }
}
function updateStatus()
{
    $db = new Database();
    $id = Utility::getPost('id');
    $status = Utility::getPost('status');
    $sql = "UPDATE orders SET status=$status WHERE id=$id"; 
    $db->execute($sql);
}
