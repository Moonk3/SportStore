<?php
$title = "Trang Quản lý Thống kê";
$baseUrl = '../';
$formNameIndex = "Danh sách thống kê";
include_once '../layouts/header.php';
$db = new Database();
$sql = "select categories.id,categories.`name`,
COUNT(*) as 'soluong',
MAX(products.price) as 'giacao',
MIN(products.price) as 'giathap',
AVG(products.price) as 'giatb'
FROM categories,products WHERE
categories.id = products.category_id
GROUP BY categories.`name`,categories.id
";
$data = $db->executeResult($sql);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-12">
                    <h1 class="m-0 mb-3"><?= $formNameIndex ?></h1>

                    <table class="table table-hover mt-5 table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Giá cao nhất</th>
                                <th scope="col">Giá thấp nhất</th>
                                <th scope="col">Trung bình giá</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 0;
                            foreach ($data as $item) : ?>
                                <tr>
                                    <th scope="row"><?= ++$index ?></th>
                                    <td><?= $item['name'] ?></td>
                                    <td><?= $item['soluong'] ?></td>
                                    <td><?= number_format($item['giacao']) . ' VNĐ' ?></td>
                                    <td><?= number_format($item['giathap']) . ' VNĐ' ?></td>
                                    <td><?= number_format($item['giatb']) . ' VNĐ' ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <a href="./chart.php" class="btn btn-warning">Xem biểu đồ</a>
                </div>


            </div>
        </div>
    </div>
</div>
<aside class="control-sidebar control-sidebar-dark">
</aside>


<?php
include_once '../layouts/footer.php';
?>
<!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    // Load google charts
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    // Draw the chart and set the chart values
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Danh mục', 'Thống kê sản phẩm'],
            ['Work', 8],
            ['Friends', 2],
            ['Eat', 2],
            ['TV', 2],
            ['Gym', 2],
            ['Sleep', 8]
            <?php
            $i = 1;
            $sumCat = count($data);
            foreach ($data as $val) {
                if ($i == $sumCat) $comma ="";else $comma =",";
                echo "['".$val['name']."','".$val['soluong']."']";
            }
            ?>
        ]);

        // Optional; add a title and set the width and height of the chart
        var options = {
            'title': 'Biểu đồ',
            'width': 1000,
            'height': 800
        };

        // Display the chart inside the <div> element with id="piechart"
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }
</script> -->