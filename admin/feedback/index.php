<?php
$title = "Trang Quản Lý Phản Hồi";
$baseUrl = '../';
include_once '../layouts/header.php';

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-12">
                    <h1 class="m-0 mb-3">Danh sách phản hồi</h1>
                    <!-- <a href="editor.php" class="btn btn-success">Thêm danh mục</a> -->
                    <div class="row">
                            <div class="col-md-11">
                                <input required class="form-control" type="text" name="search" placeholder="Nhập thông tin cần tìm kiếm ...">
                            </div>
                            <div class="col-md-1">
                                <a href="index.php" class="btn btn-dark"><i class="fas fa-sync-alt"></i></a>
                                <!-- <button type="submit" style="width: 100%;" class="btn btn-dark"><i class="fas fa-sync-alt"></i></button> -->
                            </div>

                        </div>
                    <table class="table table-hover mt-5 table-bordered">
                        <thead>
                            <tr>
                                <th class = "fbtitle" scope="col">STT</th>
                                <th class = "fbtitle" scope="col">Họ Tên</th>                         
                                <th class = "fbtitle" scope="col">Email</th>
                                <th class = "fbtitle" scope="col">Số Điện Thoại</th>
                                <th class = "fbtitle" scope="col">Địa chỉ</th>
                                <th class = "fbtitle" scope="col">Chủ Đề</th>
                                <th class = "fbtitle" scope="col">Nội Dung</th>
                                <th class = "fbtitle" scope="col">Ngày Tạo</th>
                                <th class = "fbtitle" style="width: 120px;" scope="col">Trạng thái</th>
                                <th class = "fbtitle" scope="col">Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $db = new Database();
                            if (isset($_GET['search']) && $_GET['search'] != '') {
                                $sql = 'select * from feedback where lastname like "%'.$_GET['search'].'%" or note like "%'.$_GET['search'].'%"';
                            } else {
                                $sql = "SELECT * FROM feedback order by status asc";
                            }
                            
                            $data = $db->executeResult($sql);
                            $index = 0;
                            foreach ($data as $item) : ?>
                                <tr>
                                    <th scope="row"><?= ++$index ?></th>
                                    <td><?= $item['fname'] ?></td>
                                    <td><?= $item['email'] ?></td>
                                    <td><?= $item['phone_number'] ?></td>
                                    <td><?= $item['address'] ?></td>
                                    <td><?= $item['subject_name'] ?></td>
                                    <td><?= $item['note'] ?></td>
                                    <td><?= $item['created_at'] ?></td>
                                    <td>
                                    <?php
                                        if($item['status'] == 0) {
                                            ?>
                                            <button  onclick="updatestatus(<?= $item['id'] ?>)" class="btn btn-warning">Đã đọc</button>
                                            <?php
                                        }
                                    ?>
                                    </td>
                                    <td>
                                        <button onclick="deletefeedback(<?= $item['id'] ?>)" class="btn btn-danger">Xoá</button>
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
    function deletefeedback(id) {
        option = confirm('Bạn có chắc chắn muốn xoá phản hồi này không?');
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

    function updatestatus(id) {
        $.post('changestatus.php', {
            'id': id,
            'action': 'mark'
        }, function(data) {
            location.reload();
        })
    }
</script>
<?php
include_once '../layouts/footer.php';
?>