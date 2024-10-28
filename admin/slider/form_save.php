<?php
if (!empty($_POST)) {
	$db = new Database();

	$id = Utility::getPost('id');
	$title = Utility::getPost('title');
	$content = Utility::getPost('content');
	$image = moveFile('image');
	$created_at = $updated_at = date('Y-m-d H:i:s');
	$active = Utility::getPost('active');
	if ($id > 0) {
		//update
		if ($image != '') {
			$sql = "UPDATE sliders set image = '$image', content='$content',active= $active,title='$title'
			where id = $id";
		} else 
		{
			$sql = "UPDATE sliders set title = '$title',content='$content', active = $active 
			where id = $id";
		}
		$db->execute($sql);
		$msgsuccess = "Sửa thành công";
	} else {
		//insert
		$sql = "INSERT into sliders(image, title, content, active)
		values ('$image', '$title', '$content', $active)";
		$db->execute($sql);
		$msgsuccess = "Thêm thành công";
	}
}
