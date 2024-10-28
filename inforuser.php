<?php
    require_once('layouts/header.php');

    // session_start();
    if(isset($_SESSION['id'])){
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        $phone = $_SESSION['phone'];
        $address = $_SESSION['address'];
    }
?>

<div class="container" style="margin: 50px auto; max-width: 400px;">
    <form method="post" action="inforuser.php">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Thông tin tài khoản</h2>

                <div class="mb-3">
                    <label for="name" class="form-label">Họ và tên</label>
                    <input required="true" type="text" class="form-control" id="name" name="name" value="<?=$name?>">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input required="true" type="email" class="form-control" id="email" name="email" value="<?=$email?>">
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Số điện thoại</label>
                    <input required="true" type="tel" class="form-control" id="phone" name="phone" value="<?=$phone?>">
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Địa chỉ</label>
                    <input required="true" type="text" class="form-control" id="address" name="address" value="<?=$address?>">
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
                    <a href="logout.php" class="btn btn-danger">Đăng xuất</a>
                </div>
            </div>
        </div>
    </form>
</div>

<?php
    require_once('layouts/footer.php');
?>
