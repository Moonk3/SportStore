<style>
    footer {
        background-color: #3498db;
        color: black;
        padding: 40px 0;
    }

    footer h4 {
        color: black;
        margin-bottom: 15px;
    }

    footer ul {
        list-style: none;
        padding: 0;
    }

    footer ul li {
        margin-bottom: 10px;
    }

    footer ul li i {
        margin-right: 5px;
    }

    footer div[style="background-color: #3f9609; width: 100%; text-align: center; padding: 20px;"] {
        background-color: #2c3e50;
        color: #fff;
        width: 100%;
        text-align: center;
        padding: 20px;
        margin-top: 20px;
    }

    /* Additional Styles for a cleaner look */
    footer a {
        color: #ecf0f1;
        text-decoration: none;
    }

    footer a:hover {
        text-decoration: underline;
    }

    footer .back-to-top {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #2c3e50;
        color: #fff;
        padding: 10px;
        border-radius: 5px;
        display: none;
        cursor: pointer;
    }

    footer .back-to-top a {
        color: #fff;
        text-decoration: none;
    }

    footer .back-to-top i {
        margin-right: 5px;
    }
</style>

<!-- Đoạn mã HTML đã được chỉnh sửa -->
<footer style="background-color: #81d742 !important;">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<h4>GIỚI THIỆU</h4>
				<ul>
					<li><i class="bi bi-geo-alt"></i> Địa chỉ: Hà Nội, Việt Nam</li>
					<li><i class="bi bi-mailbox2"></i> Email: Nhom7@gmail.com</li>
					<li><i class="bi bi-telephone-fill"></i> Phone: 123456789</li>
					<li>Chúng tôi cung cấp các dịch vụ xây dựng website chất lượng và độc đáo cho doanh nghiệp và cửa hàng của bạn.</li>
				</ul>
			</div>
			<div class="col-md-4">
				<h4>SẢN PHẨM MỚI NHẤT</h4>
				<ul>
					<li>LIÊN HỆ CÔNG TY CỔ PHẦN NHÓM 7 </li>
					<li><i class="bi bi-mailbox2"></i>Email: Nhom7@gmail.com</li>
					<li><i class="bi bi-telephone-fill"></i> Phone: 123456789</li>
					<li>Chúng tôi cam kết mang đến những sản phẩm website mới nhất và chất lượng nhất cho khách hàng.</li>
				</ul>
			</div>
			<div class="col-md-4">
				<h4>TIN TỨC MỚI NHẤT</h4>
				<ul>
					<li><i class="bi bi-geo-alt"></i> Địa chỉ: Hà Nội, Việt Nam</li>
					<li><i class="bi bi-mailbox2"></i> Email: Nhom7@gmail.com</li>
					<li><i class="bi bi-telephone-fill"></i> Phone: 123456789</li>
					<li>Chúng tôi luôn cập nhật tin tức mới nhất trong lĩnh vực xây dựng website và công nghệ.</li>
				</ul>
			</div>
		</div>
	</div>
	<div style="background-color: #3f9609; width: 100%; text-align: center; padding: 20px;">
		© 2023 Sport Group. Được thiết kế bởi Nhom_7. All rights reserved.
	</div>
</footer>
<!-- back to top -->
<div class="back-to-top" id="back-to-top" style="display: block;">
	<a href="#">
		<i class="fas fa-arrow-up"></i>
	</a>
</div>


<?php
if (!isset($_SESSION['cart'])) {
	$_SESSION['cart'] = [];
}
$count = 0;
// var_dump($_SESSION['cart']);
foreach ($_SESSION['cart'] as $item) {
	$count += $item['num'];
}
?>


<!-- Cart start -->
<span class="cart_icon">
	<span class="cart_count" id="cart_count"><?= $count ?></span>
	<a href="cart.php"><img src="https://gokisoft.com/img/cart.png"></a>
</span>
<!-- Cart stop -->
<!-- Jquery-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap JS-->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Owl Carousel-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<!-- Slick JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<!-- jquery.elevateZoom-3.0.8.min.js-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/elevatezoom/3.0.8/jquery.elevatezoom.min.js"></script>
<script type="text/javascript">
	function addCart(productId, num) {
		$.post("utils/ajax_request.php", {
			'action': 'cart',
			'id': productId,
			'num': num
		}, function(data) {
			alert("Đã thêm sản phẩm vào giỏ hàng")
			location.reload()

		})
	}
</script>
<script src="./main.js"></script>
</body>

</html>
