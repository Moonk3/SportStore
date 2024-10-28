<?php
include_once('./utils/utility.php');
include_once('./db/database.php');

$db = new Database();

$title = "Kết quả tìm kiếm";
$baseUrl = './';
include_once './layouts/header.php';

if (isset($_GET['query']) && !empty($_GET['query'])) {
    $search = $_GET['query'];
    $sql = "SELECT products.*, categories.name as category_name FROM products
            LEFT JOIN categories ON products.category_id = categories.id
            WHERE products.deleted = 0 AND products.name LIKE '%" . $search . "%'
            ORDER BY id DESC";

    $data = $db->executeResult($sql);
} else {
    
    echo "Vui lòng nhập thông tin cần tìm kiếm.";
    include_once './layouts/footer.php';
    exit(); 
}
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
<!-- Hiển thị kết quả tìm kiếm -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-12">
                    <h1 class="m-0 mb-3" style="text-align:center;padding:30px 30px;">KẾT QUẢ TÌM KIẾM</h1>
                    <!-- Hiển thị danh sách sản phẩm tìm kiếm -->
                    <div class="row">
                    <?php
        foreach ($data as $pItem) {
            echo '<div class="col-md-3 col-6 product-item">
            <a href="detail.php?id=' . $pItem['id'] . '"><img src="' . $pItem['image'] . '" style="width: 100%; height: 220px;"></a>
            <p style="font-weight: bold;">' . $pItem['category_name'] . '</p>
            <a href="detail.php?id=' . $pItem['id'] . '"><p style="font-weight: bold;">' . $pItem['name'] . '</p></a>
            <div class="price-container">
              <p class="discount-price" style="color: red; font-weight: bold;">' . number_format($pItem['discount']) . ' VND </p> 
              <p class="original-price" style="text-decoration: line-through; color: grey;">' . number_format($pItem['price']) . ' VND </p>
            </div>
            <a href="detail.php?id=' . $pItem['id'] . '"><button class="btn btn-success" style="width: 100%; border-radius: 0px; margin-bottom: 16px;">Xem chi tiết</button></a>
          </div>';
        }
        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once './layouts/footer.php';
?>
