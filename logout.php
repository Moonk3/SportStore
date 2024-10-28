<?php
session_start();

if($_SESSION["isLogin"] == 1){
    $_SESSION["isLogin"] =0;
}

session_destroy();

header("Location: index.php");
