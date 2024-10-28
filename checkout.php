<?php
$name=$email=$phone=$address=''; 
require_once('layouts/header.php');

if(isset($_SESSION['id'])){
	$name = $_SESSION['name'];
	$email = $_SESSION['email'];
	$phone = $_SESSION['phone'];
	$address = $_SESSION['address'];

}

?>
<div class="container row" style=" margin-top: 20px; margin-bottom: 20px; margin-left: auto; margin-right: auto;">
<!-- display:flex; justify-content: space-between; -->
	<form method="post" onsubmit="completeCheckout()" class="col-md-6">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group" style="width: 100%">
					Tên:<input required="true" type="text" class="form-control" name="name" value="<?=$name?>">
				</div>
				<div class="form-group" style="width: 100%">
					Email:<input required="true" type="text" class="form-control" name="email" value="<?=$email?>">
				</div>
				<div class="form-group" style="width: 100%">
					Phone:<input required="true" type="text" class="form-control" name="phone" value="<?=$phone?>">
				</div>
				<div class="form-group" style="width: 100%">
					Address:<input required="true" type="text" class="form-control" name="address" value="<?=$address?>">
				</div>
				<div class="form-group" style="width: 100%">
				<label for="pwd">Nội dung:</label>
				<textarea class="form-control" rows="3" name="note"></textarea>
				</div>
			</div>
		</div>
	</form>

	<div class="col-md-6">
		<div>
			<table class="table table-bordered">
			<tr>
				<th>STT</th>
				<th>Tiêu Đề</th>
				<th>Giá</th>
				<th>Số Lượng</th>
				<th>Tổng Giá</th>
			</tr>
			<?php
			$_SESSION['gia'] = 0;
			if(!isset($_SESSION['cart'])) {
				$_SESSION['cart'] = [];
			}
			$index = 0;
			foreach($_SESSION['cart'] as $item) {
				echo '<tr>
						<td>'.(++$index).'</td>
						<td>'.$item['name'].'</td>
						<td>'.number_format($item['discount']).' VND</td>
						<td>
							'.$item['num'].'
						</td>
						<td>'.number_format($item['discount'] * $item['num']).' VND</td>
					</tr>';
					$_SESSION['gia'] += $item['discount'] * $item['num'];
			}
	
			?>
			</table>
			<a href="complete.php"><button class="btn btn-success" style="border-radius: 4px; font-size: 26px; width: 100%;">THANH TOÁN</button></a>
		</div>
	
		<div style="margin-top: 10px;">
			<h5>Thanh toán qua momo</h5>
			<form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded"
				action="thanhtoanmomo.php" style="margin-bottom: 20px;">
				<input type="submit" name="momo" value="Thanh toán qua QR MOMO" class="btn btn-success" style="width:100%; background: #AF2070;">
			</form>
			<form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded"
				action="thanhtoanmomo_atm.php" style="margin-bottom: 20px;">
				<input type="submit" name="momo" value="Thanh toán qua ATM MOMO" class="btn btn-success" style="width:100%; background: #AF2070;">
			</form>
		</div>
	</div>

</div>

<script type="text/javascript">
	function completeCheckout() {
		$.post('utils/ajax_request.php', {
			'action': 'checkout',
			'fullname': $('[name=name]').val(),
			'email': $('[name=email]').val(),
			'phone_number': $('[name=phone]').val(),
			'address': $('[name=address]').val(),
			'note': $('[name=note]').val()
		}, function() {
			window.open('complete.php', '_self');
		})

		return false;
	}
</script>
<?php
require_once('layouts/footer.php');
?>