<?php
$title = "Trang Quản lý đơn hàng";
$baseUrl = '../';
include_once '../layouts/header.php';
$db = new Database();
// pending, approved, cancel
$sql = "SELECT * FROM orders ORDER BY status ASC, order_date DESC ";
$data = $db->executeResult($sql);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-12">
                    <h1 class="m-0 mb-3">Danh sách đơn hàng</h1>
                    <table class="table table-hover mt-5 table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Họ và tên</th>
                                <th scope="col">SĐT</th>
                                <th scope="col">Email</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Nội dung</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Tổng tiền</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 0;
                            foreach ($data as $item) : ?>
                                <tr>
                                    <th scope="row"><?= ++$index ?></th>
                                    <td><?= $item['fullname'] ?></td>
                                    <td><?= $item['phone_number'] ?></td>
                                    <td><?= $item['email'] ?></td>
                                    <td><?= $item['address'] ?></td>
                                    <td><?= $item['note'] ?></td>
                                    <td><?= $item['order_date'] ?></td>
                                    <td><?= number_format($item['total_money']) . ' VNĐ' ?></td>
                                    <td>
                                        <?php if ($item['status'] == 0) : ?>
                                            <button onclick="changeStatus(<?= $item['id'] ?>,1)" class="btn btn-success">Đồng ý</button>
                                            <button onclick="changeStatus(<?= $item['id'] ?>,2)" class="btn btn-danger">Huỷ</button>
                                        <?php elseif ($item['status'] == 1) : ?>
                                            <label for="" class="badge badge-success">Đã đồng ý</label>
                                        <?php else : ?>
                                            <label for="" class="badge badge-danger">Huỷ bỏ</label>
                                        <?php endif; ?>
                                        <a href="./detail.php?id=<?=$item['id']?>" class="btn btn-primary">Xem</a>
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
    function changeStatus(id, status) {
        option = confirm('Bạn có muốn xử lý không?');
        if (!option) {
            return;
        }
        $.post('form_api.php', {
            'id': id,
            'status': status,
            'action': 'update_status'
        }, function(data) {
            location.reload();
        })
    }
</script>
<?php
include_once '../layouts/footer.php';
?>