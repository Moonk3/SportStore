<?php
$title = "Trang Quản lý quyền";
$baseUrl = '../';
include_once '../layouts/header.php';
$db = new Database();
$sql = "SELECT * FROM roles";
$data = $db->executeResult($sql);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-12">
                    <h1 class="m-0 mb-3">Danh sách Quyền</h1>
                    <a href="editor.php" class="btn btn-success">Thêm quyền</a>
                    <table class="table table-hover mt-5 table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tên quyền</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 0;
                            foreach ($data as $item) : ?>
                                <tr>
                                    <th scope="row"><?= ++$index ?></th>
                                    <td><?= $item['name'] ?></td>
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
        option = confirm('Bạn có chắc chắn muốn xoá quyền này không?');
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