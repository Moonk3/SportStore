<?php
require_once('layouts/header.php');
?>
<div class="container" style="margin-top: 20px; margin-bottom: 20px;">
	<div class="row">
		<table class="table table-bordered">
			<tr>
				<th>STT</th>
				<th>Thumbnail</th>
				<th>Tiêu Đề</th>
				<th>Giá</th>
				<th>Số Lượng</th>
				<th>Tổng Giá</th>
				<th></th>
			</tr>
			<?php
			if (!isset($_SESSION['cart'])) {
				$_SESSION['cart'] = [];
			}
			$index = 0;
			foreach ($_SESSION['cart'] as $item) {
				echo '<tr>
			<td>' . (++$index) . '</td>
			<td><img src="' . $item['image'] . '" style="height: 80px"/></td>
			<td>' . $item['name'] . '</td>
			<td>' . number_format($item['discount']) . ' VND</td>
			<td style="display: flex"><button class="btn btn-light" style="border: solid #e0dede 1px; border-radius: 4px;" onclick="addMoreCart(' . $item['id'] . ', -1)">-</button>
				<input type="number" id="num_' . $item['id'] . '" value="' . $item['num'] . '" class="form-control" style="width: 90px; border-radius: 4px" onchange="fixCartNum(' . $item['id'] . ')"/>
				<button class="btn btn-light" style="border: solid #e0dede 1px; border-radius: 4px;" onclick="addMoreCart(' . $item['id'] . ', 1)">+</button>
			</td>
			<td style="color:green;font-weight:500">' . number_format($item['discount'] * $item['num']) . ' VND</td>
			<td><button class="btn btn-danger" onclick="deleteCart(' . $item['id'] . ',0)">Xoá</button></td>
		</tr>';
			}
			?>
		</table>
		<?php
		if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) : ?>
			<a href="checkout.php"><button class="btn btn-success" style="border-radius: 4px; font-size: 26px; float:right !important">TIẾP TỤC THANH TOÁN</button></a>
		<?php endif ?>

	</div>
</div>
<script type="text/javascript">
	function addMoreCart(id, delta) {
		num = parseInt($('#num_' + id).val())
		num += delta
		$('#num_' + id).val(num)
		updateCart(id, num)
	}

	function fixCartNum(id) {
		$('#num_' + id).val(Math.abs($('#num_' + id).val()))

		updateCart(id, $('#num_' + id).val())
	}

	function updateCart(productId, num) {
		$.post('utils/ajax_request.php', {
			'action': 'update_cart',
			'id': productId,
			'num': num
		}, function(data) {
			location.reload()
		})
	}

	function deleteCart(productId, num) {
		var option = confirm("Bạn có muốn xoá không?")
		if (option) {
			$.post('utils/ajax_request.php', {
				'action': 'delete_cart',
				'id': productId,
				'num': num
			}, function(data) {
				location.reload()
			})
		} else {
			return
		}

	}
</script>
<?php
require_once('layouts/footer.php');
?>