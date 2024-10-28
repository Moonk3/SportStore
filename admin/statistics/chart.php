<?php
$title = "Trang Quản lý Thống kê";
$baseUrl = '../';
$formNameIndex = "Biểu đồ";
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
        <a href="index.php"><button class="btn btn-success">Quay lại</button></a><br>
            <div class="row mb-2">
                <div class="col-md-12">
                    <br><h1 class="m-0 mb-3"><?= $formNameIndex ?></h1>
                    <div id="piechart"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <aside class="control-sidebar control-sidebar-dark">
</aside> -->
</div>


<?php
include_once '../layouts/footer.php';
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
            <?php
            $i = 1;
            $sumCat = count($data);
            foreach ($data as $val) {
                if ($i == $sumCat) $comma = "";
                else $comma = ",";
                echo "['" . $val['name'] . "'," . $val['soluong'] . "]" . $comma;
                $i += 1;
            }

            ?>
        ]);

        // Optional; add a title and set the width and height of the chart
        var options = {
            'width': 1000,
            'height': 800
        };

        // Display the chart inside the <div> element with id="piechart"
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }
</script>