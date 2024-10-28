<?php
session_start();
include_once '../../utils/utility.php';
// include_once '../../database/dbhelper.php';
include_once '../../db/database.php';
$token = Utility::getCookie('token');
// huy session, cookie
setcookie('token', '', time() - 100, '/');
session_destroy();
header("Location: login.php");
