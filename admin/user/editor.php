<?php
$title = "Trang Quản lý người dùng";
$baseUrl = '../';
include_once '../layouts/header.php';
$id = $avatar = $msgfail = $msgsuccess = $fullname = $email = $phone_number = $address = $role_id =  '';
include_once './form_save.php';
$id = Utility::getGet('id');
if ($id != '' && $id > 0) {
    $sql = "SELECT * FROM users WHERE id=$id";
    $userItem = $db->executeResult($sql, true);
    if ($userItem != null) {
        $fullname = $userItem['fullname'];
        $email = $userItem['email'];
        $phone_number = $userItem['phone_number'];
        $address = $userItem['address'];
        $role_id = $userItem['role_id'];
    } else {
        $id = 0;
    }
}
$sql = "SELECT * FROM roles";
$roleItems = $db->executeResult($sql);

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <a href="index.php"><button class="btn btn-success">Quay lại</button></a><br>
            <div class="row mb-2">
                <div class="col-md-12">
                    <br><h1 style="text-transform: uppercase; text-align: center;" class="m-0 mb-3">Thêm/Sửa người dùng</h1>
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
                    <form method="POST" action="" onsubmit="return validateForm()" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <label for="exampleInputEmail1">Họ và tên</label>
                            <input name="fullname" type="text" class="form-control" placeholder="Nhập họ tên" value="<?= $fullname ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input value="<?= $email ?>" name="email" type="email" class="form-control" placeholder="Nhập email">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Quyền</label>
                            <select class="form-control" required id="exampleFormControlSelect1" name="role_id">
                                <option value="">-----Chọn-----</option>
                                <?php foreach ($roleItems as $item) : ?>
                                    <option <?= $item['id'] == $role_id ? 'selected' : '' ?> value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số điện thoại</label>
                            <input value="<?= $phone_number ?>" name="phone_number" type="tel" class="form-control" placeholder="Nhập sdt">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Địa chỉ</label>
                            <input value="<?= $address ?>" name="address" type="tel" class="form-control" placeholder="Nhập địa chỉ">
                        </div>
                        <div class="form-group">
                            <label for="avatar">Avatar:</label>
                            <input value="<?= $avatar ?>" type="file" class="form-control" id="avatar" name="avatar" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" onchange="updateAvatar()">
                            <img id="avatar_img" src="<?= fixUrl($avatar) ?>" style="max-height: 160px; margin-top: 5px; margin-bottom: 15px;">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nhập mật khẩu</label>
                            <input <?= $id > 0 ? '' : 'required="true"' ?> type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" minlength="1" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Xác nhận mật khẩu</label>
                            <input <?= $id > 0 ? '' : 'required="true"' ?> type="password" class="form-control" name="password" id="confirm_password" placeholder="Xác nhận mật khẩu" minlength="1" />
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Lưu</button>

                </div>
                </form>
            </div>


        </div>
    </div>
</div>
</div>
<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>
<script>
    function updateAvatar() {
        $('#avatar_img').attr('src', $('#avatar').val());
    }

    function validateForm() {
        $password = $('#password').val();
        $confirm_password = $('#confirm_password').val();
        if ($password != $confirm_password) {
            alert("Mật khẩu không khớp, vui lòng kiểm tra lại");
            return false;
        }
        return true;
    }
</script>
<?php
include_once '../layouts/footer.php';
?>