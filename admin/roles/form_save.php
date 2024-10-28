<?php
if(!empty($_POST)) {
	$id = Utility::getPost('id');
	$name = Utility::getPost('name');
	$db = new Database();
	if ($id > 0) {
        // update
                $sql = "UPDATE roles set name='$name' WHERE id =$id";
                $db->execute($sql);
                $msgsuccess = "Sửa quyền thành công";
        } else {
		//insert
				$sql = "insert into roles(name) values ('$name')";
				$db->execute($sql);
				$msgsuccess = "Thêm mới quyền thành công";
}
}
?>