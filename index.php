<?php
$baseUrl = '';
include_once('./layouts/header.php');
include_once('./db/database.php');
$db = new Database();

$page = Utility::getGet('page');
$page <= 0 ? $page = 1 : $page;
$page_number_max = 12; // Số sản phẩm hiển thị trên mỗi trang

// Lấy số lượng sản phẩm và tính toán số trang
$sqlCount = "SELECT COUNT(*) as 'Total' FROM products WHERE deleted = 0 AND active = 1";
$resultCount = $db->executeResult($sqlCount);
$total = $resultCount[0]['Total'];
$numPages = ceil($total / $page_number_max);

// Tính chỉ số bắt đầu của sản phẩm trên trang hiện tại
$currentIndex = ($page - 1) * $page_number_max;

// Truy vấn dữ liệu sản phẩm với phân trang
$sql = "SELECT products.*, categories.name as category_name FROM products LEFT JOIN categories ON products.category_id = categories.id WHERE deleted = 0 AND active = 1 ORDER BY id DESC LIMIT $currentIndex, $page_number_max";
$lastestItems = $db->executeResult($sql);
?>

<style>
  .product-item {
  display: flex;
  flex-direction: column;
  justify-content: space-between; 
  height: 100%; 
  border: 1px solid #e0e0e0;
  margin-bottom: 20px;
  transition: transform 0.3s;
}

.product-item img {
  max-height: 220px; 
  width: auto;
  margin: 0 auto; 
}

.product-item-content { 
  padding: 0 10px;
}

.product-item p {
  height: 3em; 
  overflow: hidden; 
  margin-bottom: 10px; 
}

.product-item .btn-success {
  width: 100%;
  border-radius: 0;
  margin-top: auto; 
  transition: background-color 0.3s;
}
  .product-item:hover {
    transform: translateY(-5px);
  }

  .product-item:hover img {
    transform: scale(1.05);
  }

  .product-item:hover .btn-success {
    background-color: #218838;
  }
  .pagination {
    display: flex;
    justify-content: center;
    list-style: none;
    padding: 0;
  }
  .price-container {
    display: flex;
    justify-content: space-between;
    align-items: baseline; 
  }

  .discount-price,
  .original-price {
    margin: 0; 
  }
</style>

<!-- banner -->
<?php require_once('./slider.php') ?>
<!-- banner stop -->
<div class="container">
  <h1 style="text-align: center; margin-top: 100px; margin-bottom: 20px;">CÁC SẢN PHẨM</h1>
  <div class="row">
    <?php
    foreach ($lastestItems as $item) {
      echo '<div class="col-md-3 col-6 product-item">
              <a href="detail.php?id=' . $item['id'] . '"><img src="' . $item['image'] . '" style="width: 100%; height: 220px;"></a>
              <p style="font-weight: bold;">' . $item['category_name'] . '</p>
              <a href="detail.php?id=' . $item['id'] . '"><p style="font-weight: bold;">' . $item['name'] . '</p></a>
              <div class="price-container">
                <p class="discount-price" style="color: red; font-weight: bold;">' . number_format($item['discount']) . ' VND </p> 
                <p class="original-price" style="text-decoration: line-through; color: grey;">' . number_format($item['price']) . ' VND </p>
              </div>
              <a href="detail.php?id=' . $item['id'] . '"><button class="btn btn-success" style="width: 100%; border-radius: 0px; margin-bottom: 16px;">Xem chi tiết</button></a>
            </div>';
  }
    ?>
  </div>

  <!-- Hiển thị phân trang -->
    <ul class="pagination">
      <?php if ($page > 1) : ?>
        <li class="page-item"><a class="page-link" href="?page=<?= ($page - 1) ?>">Previous</a></li>
      <?php endif ?>

      <?php
      for ($i = 1; $i <= $numPages; $i++) {
        echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
      }
      ?>

      <?php if ($page < $numPages) : ?>
        <li class="page-item"><a class="page-link" href="?page=<?= ($page + 1) ?>">Next</a></li>
      <?php endif ?>
    </ul>
</div>

<!-- danh muc san pham -->
<?php
$count = 0;
foreach ($menuItems as $item) {
  $sql = "SELECT products.*, categories.name as category_name FROM products LEFT JOIN categories ON products.category_id = categories.id WHERE products.category_id = " . $item['id'] . " AND deleted = 0 AND active = 1";
  $items = $db->executeResult($sql);
  if ($items == null || count($items) < 4) continue;

  ?>
  
<?php
}
require_once('./layouts/footer.php');
?>
