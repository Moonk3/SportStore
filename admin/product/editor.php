<?php
$title = 'Thêm/Sửa Sản Phẩm';
$baseUrl = '../';
require_once('../layouts/header.php');
$db = new Database();
$id = $thumbnail = $title = $price = $discount =  $quantity = $active =  $category_id = $description = '';
require_once('form_save.php');

$id = Utility::getGet('id');
if ($id != '' && $id > 0) {
  $sql = "SELECT * FROM products WHERE id=$id";
  $userItem = $db->executeResult($sql, true);
  if ($userItem != null) {
    $thumbnail = $userItem['image'];
    $title = $userItem['name'];
    $description = $userItem['description'];
    $discount = $userItem['discount'];
    $price = $userItem['price'];
    $active = $userItem['active'];
    $quantity = $userItem['quantity'];
    $category_id = $userItem['category_id'];
  } else {
    $id = 0;
  }
} else {
  $id = 0;
}
$sql = "select * from categories";
$categoryItems = $db->executeResult($sql);
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-md-12">
          <!--============================================================================================== -->
          <div class="row" style="margin-top: 20px;">
            <div class="col-md-12 table-responsive">
              <a href="index.php"><button class="btn btn-success">Quay lại</button></a>
              <h3 style="text-align: center;">Thêm/Sửa Sản Phẩm</h3>
              <?php if ((isset($msgfail)) && !empty($msgfail)) : ?>
                <div class="alert alert-danger alert-dismissible fade show toast" role="alert" style="max-width: 100%;">
                  <strong><?= $msgfail ?></strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <?php elseif ((isset($msgsuccess)) && !empty($msgsuccess)) : ?>
                <div class="alert alert-success alert-dismissible fade show toast" role="alert" style="max-width: 100%;">
                  <strong><?= $msgsuccess ?></strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <?php endif; ?>

              <div class="panel panel-primary">
                <div class="panel-body">
                  <form method="post" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-9 col-12">
                        <div class="form-group">
                          <!-- Tên sản phẩm -->
                          <label for="usr">Tên Sản Phẩm:</label>
                          <input required="true" type="text" class="form-control" id="usr" placeholder="Nhập tên sản phẩm" name="name" value="<?= $title ?>">
                          <input type="text" name="id" value="<?= $id ?>" hidden="true">
                        </div>

                        <!-- Nội dung -->
                        <div class="form-group">
                          <label for="pwd">Nội Dung:</label>
                          <textarea class="form-control" rows="5" name="description" id="description" placeholder="Nhập nội dung sản phẩm"><?= $description ?></textarea>
                          </textarea>
                        </div>

                        <!-- Lưu sản phẩm -->
                        <button class="btn btn-success">Lưu Sản Phẩm</button>
                      </div>


                      <div class="col-md-3 col-12" style="border: solid grey 1px; padding-top: 10px; padding-bottom: 10px;">

                        <!-- Image -->
                        <div class="form-group">
                          <label for="thumbnail">Thumbnail:</label>
                          <input value="<?= $thumbnail ?>" type="file" class="form-control" id="thumbnail" name="image" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" onchange="updateThumbnail()">
                          <img id="thumbnail_img" src="<?= fixUrl($thumbnail) ?>" style="max-height: 160px; margin-top: 5px; margin-bottom: 15px;">
                        </div>

                        <!-- Danh Mục Sản Phẩm -->
                        <div class="form-group">
                          <label for="usr">Danh Mục Sản Phẩm:</label>
                          <select class="form-control" name="category_id" id="category_id" required="true">
                            <option value="">-- Chọn --</option>
                            <?php
                            foreach ($categoryItems as $item) {
                              if ($item['id'] == $category_id) {
                                echo '<option selected value="' . $item['id'] . '">' . $item['name'] . '</option>';
                              } else {
                                echo '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
                              }
                            }
                            ?>
                          </select>
                        </div>


                        <div class="form-group">
                          <label for="price">Giá:</label>
                          <input required="true" type="number" class="form-control" id="price" name="price" value="<?= $price ?>">
                        </div>

                        <div class="form-group">
                          <label for="price">Giảm Giá:</label>
                          <input required="true" type="number" class="form-control" id="price" name="discount" value="<?= $discount ?>">
                        </div>


                        <div class="form-group">
                          <label for="quantity">Số lượng:</label>
                          <input required="true" type="number" class="form-control" id="quantity" name="quantity" value="<?= $quantity ?>">
                        </div>


                        <div class="form-group">
                          <label for="quantity">Kích hoạt:</label>
                          <select class="form-control" name="active" id="active" required="true">
                            <option value="">-- Chọn --</option>
                            <option value="0" <?= $active == 0 ? 'selected' : '' ?>>Không kích hoạt</option>
                            <option value="1" <?= $active == 1 ? 'selected' : '' ?>>Kích hoạt</option>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function updateThumbnail() {
    $('#thumbnail_img').attr('src', $('#thumbnail').val());
  }
</script>
<?php
require_once('../layouts/footer.php');
?>
<script>
  CKEDITOR.replace('ckeditor');
  CKEDITOR.replace('description');
</script>