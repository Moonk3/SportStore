<?php
session_start();
	include_once('./utils/utility.php');
	include_once('./db/database.php');
	if(!isset($_SESSION["isLogin"]) || empty($_SESSION["isLogin"])){
		$_SESSION["isLogin"] = 0;
	}
	$db = new Database();
	$sql = "SELECT * from categories";
	$menuItems = $db->executeResult($sql);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Trang Chủ - Shop Thể Thao</title>
	<link rel="shortcut icon" href="https://t004.gokisoft.com/uploads/2021/07/1-s-1637-ico-web.jpg">
	<link href="https://kit-pro.fontawesome.com/releases/v5.15.4/css/pro.min.css" rel="stylesheet">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">

	<style type="text/css">
		
		.nav li {
			text-transform: uppercase;
			color: #28a745;
			margin-top: 10px;
		}

		.nav li a {
			color: #fff;
			font-weight: bold;
		}

		.nav li a:hover {
			color: #3D2E5C;
			transition: 0.3s;
		}

		.carousel-inner img {
			height: 20%;
			width: 100%;
		}

		.product-item:hover {
			background-color: #f5f6f7;
			cursor: pointer;
		}

		footer {
			padding-top: 20px;
		}

		footer ul {
			list-style-type: none;
			padding: 0px;
			margin: 0px;
			padding-top: 10px;
			padding-bottom: 10px;
		}

		.cart_icon {
			position: fixed;
			z-index: 999;
			right: 0px;
			top: 45%;
		}

		.cart_icon img {
			width: 45px;
		}

		.cart_icon .cart_count {
			background-color: red;
			color: white;
			font-size: 16px;
			padding-top: 2px;
			padding-bottom: 2px;
			padding-left: 10px;
			padding-right: 10px;
			font-weight: bold;
			border-radius: 12px;
			position: fixed;
			right: 40px;
		}

		.preloader {
			background-color: #fff;
			bottom: 0;
			height: 100%;
			left: 0;
			position: fixed;
			right: 0;
			display: block;
			top: 0;
			width: 100%;
			z-index: 9999;
		}

		.preloader img {
			display: block;
			width: 100px;
			height: 100px;
			position: absolute;
			top: 50%;
			left: 50%;
			-webkit-transform: translate(-50%, -50%);
			-moz-transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
			-o-transform: translate(-50%, -50%);
			transform: translate(-50%, -50%);
		}

		#back-to-top {
			background-color: #171717;
			bottom: 20px;
			color: #fff;
			display: none;
			font-size: 24px;
			height: 40px;
			line-height: 40px;
			position: fixed;
			right: 20px;
			text-align: center;
			width: 40px;
			z-index: 99;
		}

		.name {
			color: #fff;
		}

		.nav-item{
			position: relative;
			display: flex;
			align-items: center;
		}
		.nav-item img{
			
			width: 25px;
			height: 25px;
		}
		.nav-item-sub{
			position: absolute;
			top: 20px;
			left: -110px;
			width: 250px;
			list-style: none;
			display: none;
			z-index: 100;
		}
		.nav-item-sub::after{
			
			position: absolute;
			display: block;
			content: "";
			width: 250px;
			height: 30px;
			top: -10px;
			left: 0;
		}
		.nav-item-sub li a{
			color: #28a745;
			font-size: 14px;
			margin-left: -16px;

		}
		.nav-item:hover .nav-item-sub{
			display: block;
			border-radius: 12px;
			background-color: #f5f6f7; 
			margin-top: 16px;
			box-shadow: 4px 4px 4px;
			list-style-type: none;
		}
		.btn-infor ,.btn-out{
			width: 100%;
			text-align: left;
		}
		.btn:hover{
			box-shadow: 4px 4px 4px;
		}
		.btn-out{
			margin-bottom: 16px;
		}
		.btn-out:hover{
			color: red !important; 
		}
		nav{
			background-color: #28a745;
		}
		#main-menu {
			display: flex;
		}
		#toggle {
			display: none;
			background: #28a745;
			color: #fff;
			text-align: right;
			padding: 10px;
			font-size: 20px;
			cursor: pointer;
		}
		@media screen and (max-width: 1250px) {
			#main-menu {
				flex-direction: column;
				text-align: center;
			}
			#toggle {
				display: block;
			}
			nav {
				display: none;
			}
		}
		.form-group{
			width: 50%;
		}
.search-form {
    position: relative;
    margin-left: auto;
    margin-right: auto;
    max-width: 300px; 
}

.search-form input {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #28a745; 
}

.search-form button {
    position: absolute;
    top: 0;
    right: 0;
    height: 100%;
    padding: 10px;
    border-radius: 0 5px 5px 0;
    background-color: #28a745; 
    color: #fff; 
    border: 1px solid #28a745; 
    cursor: pointer;
    transition: background-color 0.3s;
}

.search-form button:hover {
    background-color: #218838; 
}

	</style>
    <script>
        $(document).ready(function() {
            $('#toggle').click(function() {
                $('nav').slideToggle();
            });
        })
    </script>
</head>
<body>
	<!-- Menu START -->
	<div class="wapper">
		<div id="header">
			<div id="toggle">
				<a href="index.php" style="text-decoration:none; color:white; font-weight:bold;">TRANG CHỦ</a>
				<i class="fas fa-bars"></i>
			</div>
			<nav>
				<ul class="nav" id="main-menu" style="width: 100%;align-items:center;justify-content:center;padding:20px 0;">
						<li class="nav-item" style="margin-top: 8px !important;">
							<a href="index.php" style="text-decoration: none ;padding: 0 10px; line-height:20px";>TRANG CHỦ</a>
						</li>
						<?php
							include_once('./utils/utility.php');
							include_once('./db/database.php');
							if(!isset($_SESSION["isLogin"]) || empty($_SESSION["isLogin"])){
								$_SESSION["isLogin"] = 0;
							}
							$db = new Database();
							$sql = "SELECT * from categories";
							$menuItems = $db->executeResult($sql);
							foreach ($menuItems as $item){
								?>
								<li class="nav-item">
									<a class="nav-link" href="category.php?id=<?=$item['id']?>"><?=$item['name']?></a>
								</li>
								<?php
							}
						?>
						<li class="nav-item">
								<a class="nav-link" href="contact.php">Liên Hệ</a>
						</li>
						<div>
							<form action="tim_kiem.php" method="GET" class="form-inline my-2 my-lg-0 search-form">
								<input class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm" aria-label="Search" name="query">
								<button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="background-color:blue; text-align:center;">Tìm kiếm</button>
							</form>
						</div>
						<li class="nav-item">
							<?php 
							if($_SESSION["isLogin"]== 0){
								echo '<a class="nav-link" href="login.php">Đăng nhập</a>';
							}else{
								?>
								<img src="assets/photos/Thay-the-hinh-dai-dien-tai-khoan-nguoi-dung-mac.png" alt="">
								<div class="name"><b>TÀI KHOẢN</b></div>
								<ul class="nav-item-sub" >
									<li >
										<a href="http://localhost/N7_SportStore/N7_SportStore/inforuser.php" class="btn btn-infor" >Thông tin tài khoản</a>
									</li>
									<li >
										<a href="http://localhost/N7_SportStore/N7_SportStore/logout.php" class="btn btn-out" >Đăng xuất</a>
									</li>
								</ul>
								<?php
							}
							?>
						</li>
					</ul>
			</nav>
		</div>
	</div>
