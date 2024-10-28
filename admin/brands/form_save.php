<?php
if(!empty($_POST)) {
	$id = Utility::getPost('id');
	$name = Utility::getPost('name');
    $mota = Utility::getPost('mota');
	$db = new Database();
	if ($id > 0) {
        // update
                $sql = "UPDATE brands set name='$name',mota='$mota' WHERE id =$id";
                $db->execute($sql);
                $msgsuccess = "Sửa thương hiệu thành công";
        } else {
		//insert
				$sql = "insert into brands(name,mota) values ('$name','$mota')";
				$db->execute($sql);
				$msgsuccess = "Thêm mới thương hiệu thành công";
}
}
?>