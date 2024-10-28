<?php
include_once  '../../db/database.php';
include_once  '../../utils/utility.php';
if (!empty($_POST)) {
    $action = Utility::getPost('action');
    switch ($action) {
        case 'mark':
            updateStatus();
            break;

        default:
            # code...
            break;
    }
}
function updateStatus()
{
    $db = new Database();
    $id = Utility::getPost('id');
    $sql = "update feedback set status = 1 where id = $id";
    $db->execute($sql);
}