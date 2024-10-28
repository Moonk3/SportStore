<?php
$baseUrl = '';
include_once('./layouts/header.php');
$productId = Utility::getGet('id');
$db = new Database();
$sql = "SELECT Products.*, Categories.name as category_name from Products left join Categories on Products.category_id = Categories.id where Products.id = $productId";
$product = $db->executeResult($sql, true);
$category_id = $product['category_id'];
$sql1 = "SELECT Products.*, Categories.name as category_name from Products left join Categories on Products.category_id = Categories.id where Products.category_id = $category_id AND deleted=0 order by Products.updated_at desc limit 0,4";
$lastestItems = $db->executeResult($sql1);
$sql2 = "SELECT id,size FROM sizes ";
$size = $db ->executeResult($sql2);
?>
<style type="text/css">
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
<div class="container" style="margin-top: 20px; margin-bottom: 20px;">
	<div class="row">
		<div class="col-md-6">
			<img src="<?= $product['image'] ?>" style="width: 100%;">
		</div>
		<div class="col-md-6">
			<ul class="breadcrumb">
				<li><a href="index.php">Trang Chủ</a></li>
				<li><a href="category.php?id=<?= $product['category_id'] ?>"> / <?= $product['category_name'] ?></a></li>
				<li> / <?= $product['name'] ?></li>
			</ul>
			<h2><?= $product['name'] ?></h2>
			<ul style="display: flex; list-style-type: none; margin: 0px; padding: 0px;">
				<li style="color: orange; font-size: 13pt; padding-top: 2px; margin-right: 5px;">5.0</li>
				<li style="color: orange; padding: 2px;">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
						<path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
					</svg>
				</li>
				<li style="color: orange; padding: 2px;">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
						<path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
					</svg>
				</li>
				<li style="color: orange; padding: 2px;">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
						<path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
					</svg>
				</li>
				<li style="color: orange; padding: 2px;">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
						<path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
					</svg>
				</li>
				<li style="color: orange; padding: 2px;">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
						<path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
					</svg>
				</li>
				<li style="margin-left: 20px; border-left: solid #dad7d7 1px; font-size: 13pt; padding-top: 3px; padding-left: 20px;">7,635 Đã Bán</li>
			</ul>
			<p style="font-size: 30px; color: red; margin-top: 15px; margin-bottom: 15px;">
				<?= number_format($product['discount']) ?> VND
			</p>
			<p style="font-size: 15px; color: grey; margin-top: 15px; margin-bottom: 15px;">
				<del><?= number_format($product['price']) ?> VND</del>
			</p>
			<div >
				Size:&ensp; <select name="size" id="size" style="text-align: center; width: 60px;border: solid #e0dede 1px; border-radius: 0px;">
					<?php
						foreach($size as $v){
							?>
							<option value="<?=$v['size']?>"><?=$v['size']?></option>
							<?php
						}
					?>
				</select>
			</div>
			<div style="display: flex; margin-top: 16px;">
				<button class="btn btn-light" style="border: solid #e0dede 1px; border-radius: 0px;" onclick="addMoreCart(-1)">-</button>
				<input type="number" name="num" class="form-control" step="1" value="1" style="text-align: center; max-width: 90px;border: solid #e0dede 1px; border-radius: 0px;" onchange="fixCartNum()">
				<button class="btn btn-light" style="border: solid #e0dede 1px; border-radius: 0px;" onclick="addMoreCart(1)">+</button>
			</div>
			<button class="btn btn-success" style="margin-top: 20px; width: 100%; border-radius: 0px; font-size: 30px;" onclick="addCart(<?= $product['id'] ?>, $('[name=num]').val())">
				<i class="bi bi-cart-plus-fill"></i> THÊM VÀO GIỎ HÀNG
			</button>
			
		</div>
		<div class="col-md-12" style="margin-top: 20px; margin-bottom: 30px;">
			<h3>Chi Tiết Sản Phẩm</h3>
			<?= $product['description'] ?>
		</div>
	</div>
</div>
<div class="container" style="margin-top: 20px; margin-bottom: 20px;">
	<h1 style="text-align: center; margin-top: 20px; margin-bottom: 20px;">SẢN PHẨM LIÊN QUAN</h1>
	<div class="row">
	<?php foreach ($lastestItems as $item) : ?>
        <div class="col-md-3 col-6 product-item">
            <a href="detail.php?id=<?= $item['id'] ?>">
                <img src="<?= $item['image'] ?>" alt="<?= $item['name'] ?>" class="product-image">
            </a>
            <p style="font-weight: bold;"><?= $item['category_name'] ?></p>
            <a href="detail.php?id=<?= $item['id'] ?>">
                <p style="font-weight: bold;"><?= $item['name'] ?></p>
            </a>
			<div class="price-container">
                <p class="discount-price" style="color: red; font-weight: bold;"><?=  number_format($item['discount']) ?> VND </p> 
                <p class="original-price" style="text-decoration: line-through; color: grey;"><?=  number_format($item['price']) ?> VND </p> 
            </div>
            <p>
                <button class="btn btn-success" onclick="addCart(<?= $item['id'] ?>, 1)">
                    <i class="bi bi-cart-plus-fill"></i> Thêm giỏ hàng
                </button>
            </p>
        </div>
    <?php endforeach; ?>
	</div>
</div>

<script type="text/javascript">
	function addMoreCart(delta) {
		num = parseInt($('[name=num]').val())
		num += delta
		if (num < 1) num = 1;
		$('[name=num]').val(num)
	}

	function fixCartNum() {
		$('[name=num]').val(Math.abs($('[name=num]').val())) // đổi số âm thành dương
	}


</script>
<?php
require_once('layouts/footer.php');
?>