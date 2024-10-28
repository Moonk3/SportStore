<?php
if(!empty($_POST)) {
	$id = Utility::getPost('id');
	$name = Utility::getPost('name');
	$db = new Database();
	if ($id > 0) {
        // update
                $sql = "UPDATE categories set name='$name' WHERE id =$id";
                $db->execute($sql);
                $msgsuccess = "Sửa danh mục thành công";
        } else {
		//insert
				$sql = "insert into categories(name) values ('$name')";
				$db->execute($sql);
				$msgsuccess = "Thêm mới danh mục thành công";
}
}
?>