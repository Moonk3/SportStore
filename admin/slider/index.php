<?php

$title = "Trang Quản lý người dùng";
$baseUrl = '../';
include_once '../layouts/header.php';
$db = new Database();
$page = 1;
$page = Utility::getGet('page');
$page <= 0 ? $page = 1 : $page;
$page_number_max = 5;
$currentIndex = ($page - 1) * $page_number_max;
$sql = "SELECT * from sliders ORDER BY id DESC LIMIT $currentIndex, $page_number_max";

$data = $db->executeResult($sql);
$sql = "SELECT COUNT(*) as 'Total' from sliders";
$result = $db->executeResult($sql);
$total = $result[0]['Total'];
$numPages = ceil($total / $page_number_max);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-12">
                    <h1 class="m-0 mb-3">DANH SÁCH SLIDER</h1>
                    <a href="editor.php" class="btn btn-success" style="margin-bottom: 16px;">Thêm slide</a>
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-md-11">
                                <input required class="form-control" type="text" name="search" placeholder="Nhập thông tin cần tìm kiếm ...">
                            </div>
                            <div class="col-md-1">
                                <button type="submit" style="width: 100%;" class="btn btn-dark"><i class="fas fa-search"></i></button>
                            </div>

                        </div>
                    </form>

                    <table class="table table-hover mt-3 table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col" style="width: 100px">Hình ảnh</th>
                                <!-- <th scope="col">Tên slider</th>
                                <th scope="col" style="width: 300px">Nội dung</th> -->
                                <th scope="col">Kích hoạt</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $index = 0;
                            foreach ($data as $item) : ?>
                                <tr>
                                    <th scope="row"><?= ++$index ?></th>
                                    <td><img src="<?= fixUrl($item['image']) ?>" style="max-height: 100px; margin-top: 5px; margin-bottom: 15px;"></td>

                                    <!-- <td><?= $item['title'] ?></td>
                                    <td><?= $item['content']?></td>                                 -->
                                    <td> <?= $item['active'] == 0 ? "<span style='color:red'>Không kích hoạt</span>" : "<span style='color:green'>Kích hoạt</span>"; ?> </td>

                                    <td>
                                        <a href="./editor.php?id=<?= $item['id'] ?>" class="btn btn-warning">Sửa</a>

                                        <button onclick="deleteSlider(<?= $item['id'] ?>)" class="btn btn-danger">Xoá</button>

                                    </td>
                                </tr>
                            <?php endforeach ?>

                        </tbody>
                    </table>
                    <?php $pageAvaiable = [1, 2, $page - 1, $page, $page + 1, $numPages - 1, $numPages];
                    $isFirst = false;
                    $isBefore = false;
                    ?>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php if ($page > 1) : ?>
                                <li class="page-item"><a class="page-link" href="?page=<?= ($page - 1) ?>">Previous</a></li>
                            <?php endif ?>

                            <?php
                            for ($i = 1; $i <= $numPages && $numPages > 1; $i++) {
                                if (!in_array($i, $pageAvaiable)) {
                                    if ($i < $page && !$isFirst) {
                                        echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 2) . '">...</a></li>';
                                        $isFirst = true;
                                    }
                                    if ($i > $page && !$isBefore) {
                                        echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 2) . '">...</a></li>';
                                        $isBefore = true;
                                    }
                                    continue;
                                }
                                if ($i == $page) {
                                    echo '<li class="page-item active"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                                } else {
                                    echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                                }
                            }
                            ?>
                            <?php if ($page < $numPages) : ?>
                                <li class="page-item"><a class="page-link" href="?page=<?= ($page + 1) ?>">Next</a></li>
                            <?php endif ?>
                        </ul>
                    </nav>
                </div>


            </div>
        </div>
    </div>
</div>
<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>

<script>
    function deleteSlider(id) {
        option = confirm('Bạn có chắc chắn muốn xoá slider này không?');
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