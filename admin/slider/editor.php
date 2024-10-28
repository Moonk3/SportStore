<?php
$title = 'Thêm/Sửa Slider';
$baseUrl = '../';
require_once('../layouts/header.php');
$db = new Database();
$id = $thumbnail = $title  = $content  = $active  = '';
require_once('form_save.php');

$id = Utility::getGet('id');
if ($id != '' && $id > 0) {
  $sql = "SELECT * FROM sliders WHERE id=$id";
  $userItem = $db->executeResult($sql, true);
  if ($userItem != null) {
    $thumbnail = $userItem['image'];
    $title = $userItem['title'];
    $content = $userItem['content'];
    $active = $userItem['active'];
  } else {
    $id = 0;
  }
} else {
  $id = 0;
}
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-md-12">
          <!--============================================================================================== -->
          <a href="index.php"><button class="btn btn-success">Quay lại</button></a><br>
          <div class="row" style="margin-top: 20px;">
            <div class="col-md-12 table-responsive">
              <h3>Thêm/Sửa Sliders</h3>
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
                          <!-- Lưu sản phẩm -->
                          <button class="btn btn-success">Lưu Sản Phẩm</button>
                        </div>


                        <div class="col-md-3 col-12" style="border: solid grey 1px; padding-top: 10px; padding-bottom: 10px;">

                          <!-- Image -->
                          <div class="form-group">
                            <label for="thumbnail">Hình ảnh:</label>
                            <input value="<?= $thumbnail ?>" type="file" class="form-control" id="thumbnail" name="image" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" onchange="updateThumbnail()">
                            <img id="thumbnail_img" src="<?= fixUrl($thumbnail) ?>" style="max-height: 160px; margin-top: 5px; margin-bottom: 15px;">
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