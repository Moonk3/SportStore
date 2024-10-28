<?php
$title = "Trang Quản lý người dùng";
$baseUrl = '../';
include_once '../layouts/header.php';
$id = $msgfail = $msgsuccess = $name = $email = $phone = $address = $role =  '';
include_once './form_save.php';
$id = Utility::getGet('id');
if ($id != '' && $id > 0) {
    $sql = "SELECT * FROM users_khach WHERE id=$id";
    $userItem = $db->executeResult($sql, true);
    if ($userItem != null) {
        $name = $userItem['name'];
        $email = $userItem['email'];
        $phone= $userItem['phone'];
        $address = $userItem['address'];
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
            <div class="row mb-2">
                <div class="col-md-12">
                    <h1 style="text-transform: uppercase;" class="m-0 mb-3">Thêm/Sửa tài khản</h1>
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
                            <input name="fullname" type="text" class="form-control" placeholder="Nhập họ tên" value="<?=$name ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input value="<?= $email ?>" name="email" type="email" class="form-control" placeholder="Nhập email">
                        </div>
                        <!-- <div class="form-group">
                            <label for="exampleFormControlSelect1">Quyền</label>
                            <select class="form-control" required id="exampleFormControlSelect1" name="role_id">
                                <option value="">-----Chọn-----</option>
                                 //foreach ($roleItems as $item) : 
                                      $item['id'] == $role_id ? 'selected' : '' ?> value=" $item['id'] ?>"> $item['name'] ?>
                                 //endforeach; ?>
                            </select>
                        </div> -->
                        <div class="form-group">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số điện thoại</label>
                            <input value="<?= $phone ?>" name="phone_number" type="tel" class="form-control" placeholder="Nhập sdt">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Địa chỉ</label>
                            <input value="<?= $address ?>" name="address" type="tel" class="form-control" placeholder="Nhập địa chỉ">
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