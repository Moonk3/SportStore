<?php
	$title = 'Thêm/Sửa Tài Khoản Người Dùng';
	$baseUrl = '../';
	include_once '../layouts/header.php';
    $id = $msgfail=$msgsuccess= $name='';
    include_once './form_save.php';
	$db = new Database();
	$id = Utility::getGet('id');
	if ($id != '' && $id > 0) {
		$sql = "SELECT * FROM roles WHERE id=$id";
		$userItem = $db->executeResult($sql,true);
		if ($userItem != null) {
			$name = $userItem['name'];
		} else {
			$id = 0;
		}
	}
	
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
		<div class="container-fluid">
			<a href="index.php"><button class="btn btn-success">Quay lại</button></a><br>
			<div class="row mb-2">
                <div class="col-md-12">
                    <br><h1 class="m-0 mb-3">Thêm/Sửa Quyền</h1>
					<?php if ((isset($msgfail)) && !empty($msgfail)) : ?>
                        <div class="alert alert-danger alert-dismissible fade show toast" role="alert" style="max-width: 100%;">
                            <strong><?= $msgfail ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
					<?php elseif ((isset($msgsuccess)) && !empty($msgsuccess)) : ?>
                        <div class="alert alert-success alert-dismissible fade show toast" role="alert" style="max-width: 100%;">
                            <strong><?= $msgsuccess ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
						<?php endif; ?>
                    <div class="panel-body">
					<form method="post" onsubmit="return validateForm();">
					<div class="form-group">
					  <input type="hidden" name="id" value="<?= $id ?>">
					  <label for="usr">NAME:</label>
					  <input name="name" type="text" class="form-control" placeholder="Nhập tên quyền" value="<?= $name ?>">
					<button class="btn btn-success"  style="margin-top: 25px;">Lưu</button>
				</form>
			</div>
        </div>
    </div>
</div>
<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>
<?php
	require_once('../layouts/footer.php');
?>