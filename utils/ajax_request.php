<?php
session_start();
include_once('../utils/utility.php');
include_once('../db/database.php');

	$action = Utility::getPost('action');
switch ($action) {
	case 'cart':
		addToCart();
		break;

	case 'update_cart':
		updateCart();
		break;

	case 'checkout':
		checkout();
		break;
	case 'delete_cart':
		deleteCart();
		break;
}

function checkout()
{
	if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
		return;
	}

	$fullname = Utility::getPost("fullname");
	$email = Utility::getPost("email");
	$phone_number = Utility::getPost("phone_number");
	$address = Utility::getPost("address");
	$note = Utility::getPost("note");
	$_SESSION['email'] = $email;
	$user = Utility::getUserToken();
	$userId = 0;
	if ($user != null) {
		$userId = $user['id'];
	}

	$orderDate = date('Y-m-d H:i:s');

	$totalMoney = 0;
	foreach ($_SESSION['cart'] as $item) {
		$totalMoney += $item['discount'] * $item['num'];
	}

	$db = new Database();
	$sql = "INSERT into orders(user_id, fullname, email, phone_number, address, note, order_date, status, total_money) values ($userId, '$fullname', '$email', '$phone_number', '$address', '$note', '$orderDate', 0, '$totalMoney')";
	$db->execute($sql);

	$sql = "SELECT * from Orders where order_date = '$orderDate'";
	$orderItem = $db->executeResult($sql, true);

	$orderId = $orderItem['id'];
	$email = $orderId['email'];

	foreach ($_SESSION['cart'] as $item) {
		$product_id = $item['id'];
		$price = $item['discount'];
		$num = $item['num'];
		$totalMoney = $price * $num;

		$sql = "INSERT into order_details(order_id, product_id, price, num, total_money) values ($orderId, $product_id, $price, $num, $totalMoney)";
		$db->execute($sql);
	}

	// unset($_SESSION['cart']);
}
function deleteCart(){
	updateCart(); 
}

function updateCart()
{
	$id = Utility::getPost('id');
	$num = Utility::getPost('num');

	if (!isset($_SESSION['cart'])) {
		$_SESSION['cart'] = [];
	}

	for ($i = 0; $i < count($_SESSION['cart']); $i++) {
		if ($_SESSION['cart'][$i]['id'] == $id) {
			$_SESSION['cart'][$i]['num'] = $num;
			if ($num <= 0) {
				array_splice($_SESSION['cart'], $i, 1);
			}
			break;
		}
	}
}


function addToCart()
{
	$db = new Database();
	$id = Utility::getPost('id');
	$num = Utility::getPost('num');
	if (!isset($_SESSION['cart'])) {
		$_SESSION['cart'] = [];
	}
	$isFind = false;

	for ($i = 0; $i < count($_SESSION['cart']); $i++) {
		if ($_SESSION['cart'][$i]['id'] == $id) {
			$_SESSION['cart'][$i]['num'] += $num;
			$isFind = true;
			break;
		}
	}
	if (!$isFind) {
		$sql = "SELECT Products.*, Categories.name as category_name from Products left join Categories on Products.category_id = Categories.id where Products.id = $id";
		$product = $db->executeResult($sql, true);
		$product['num'] = $num;
		$_SESSION['cart'][] = $product;
	}
}
