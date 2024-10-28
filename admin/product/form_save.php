<?php
if (!empty($_POST)) {
	$db = new Database();

	$id = Utility::getPost('id');
	$name = Utility::getPost('name');
	$price = Utility::getPost('price');
	$discount = Utility::getPost('discount');
	$brand = Utility::getPost('brand');
	$quantity = Utility::getPost('quantity');
	$image = moveFile('image');
	$created_at = $updated_at = date('Y-m-d H:i:s');
	$description = Utility::getPost('description');
	$category_id = Utility::getPost('category_id');
	$active = Utility::getPost('active');

	if ($id > 0) {
		//update
		if ($image != '') {
			$sql = "UPDATE products set image = '$image', discount=$discount, name = '$name', price = $price, brand = '$brand', description = '$description', quantity = $quantity, category_id = $category_id, active= $active, updated_at = '$updated_at' where id = $id";
		} else {
			$sql = "UPDATE products set name = '$name', price = $price,discount=$discount, brand = '$brand', description = '$description', active = $active, category_id = $category_id , quantity = $quantity, updated_at = '$updated_at' where id = $id";
		}
		$db->execute($sql);
		$msgsuccess = "Sửa thành công";
	} else {
		//insert
		$sql = "insert into products(image, name, price,discount, brand, description, quantity, active, deleted, category_id,updated_at,created_at)
		values ('$image', '$name', $price,$discount, '$brand', '$description', $quantity, $active, 0, $category_id,'$updated_at','$created_at')";
		$db->execute($sql);
		$msgsuccess = "Thêm thành công";
	}
}
