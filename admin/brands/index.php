<?php
$title = "Trang Quản lý thương hiệu";
$baseUrl = '../';
include_once '../layouts/header.php';
$db = new Database();
// $sql = "SELECT * FROM brands";
// $data = $db->executeResult($sql);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-12">
                    <h1 class="m-0 mb-3">DANH SÁCH THƯƠNG HIỆU</h1>
                    <a href="editor.php" class="btn btn-success" style="margin-bottom: 16px;">Thêm thương hiệu</a>
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-md-11">
                                <input required class="form-control" type="text" name="search" placeholder="Nhập thông tin cần tìm kiếm ...">
                            </div>
                            <div class="col-md-1">
                                <a href="index.php" class="btn btn-dark"><i class="fas fa-sync-alt"></i></a>
                                <!-- <button type="submit" style="width: 100%;" class="btn btn-dark"><i class="fas fa-sync-alt"></i></button> -->
                            </div>

                        </div>
                    </form>
                    <br>
                    <table class="table table-hover mt-3 table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col" style="width:170px">TÊN THƯƠNG HIỆU</th>
                                <th scope="col">MÔ TẢ</th>
                                <th scope="col" style="width:150px">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_GET['search']) && $_GET['search'] != '') {
                                $sql = 'select * from brands where name like "%'.$_GET['search'].'%"';
                            } else {
                                $sql = "SELECT * FROM brands";
                            }

                            $data = $db->executeResult($sql);
                            $index = 0;
                            foreach ($data as $item) : ?>
                                <tr>
                                    <th scope="row"><?= ++$index ?></th>
                                    <td><?= $item['name'] ?></td>
                                    <td><?= $item['mota'] ?></td>
                                    <td>
                                        <a href="./editor.php?id=<?= $item['id'] ?>" class="btn btn-warning"><i class="far fa-edit"></i></a>
                                        <button onclick="deleteUser(<?= $item['id'] ?>)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>
<script>
    function deleteUser(id) {
        option = confirm('Bạn có chắc chắn muốn xoá thương hiệu này không?');
        if (!option) {
            return;
        }
        $.post('form_api.php', {
            'id': id,
            'action': 'delete'
        }, function(data) {
            location.reload();
        })
    }
</script>

<?php
include_once '../layouts/footer.php';
?>