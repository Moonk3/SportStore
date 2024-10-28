<?php
$name=$email=$phone=$address='';
require_once('layouts/header.php');
// var_dump($_POST);
//session_start();
if(isset($_SESSION['id'])){
	$name = $_SESSION['name'];
	$email = $_SESSION['email'];
	$phone = $_SESSION['phone'];
	$address = $_SESSION['address'];
}
if (!empty($_POST)) {
	$fname = Utility::getPost('name');
	$femail = Utility::getPost('email');
	$phone_number = Utility::getPost('phone');
	$faddress = Utility::getPost('address');
	$subject_name = Utility::getPost('subject_name');
	$note = Utility::getPost('note');
	$created_at = $updated_at = date('Y-m-d H:i:s');

	$sql = "INSERT INTO FeedBack(fname, email, phone_number, address, subject_name, note, status, created_at, updated_at) VALUES('$name', '$femail', '$phone_number', '$faddress', '$subject_name', '$note', 0, '$created_at', '$updated_at')";
	$db = new Database();
	$resutl = $db->execute($sql);

}
?>
<style>
	.form-group .form-control{
		width: 330px !important;
	}
</style>
<div class="container" style="margin-top: 20px; margin-bottom: 20px;">
	<form method="post">
		<div class="row">
			<div class="col-md-6">
			<div class="form-group">
					Tên:<input required="true" type="text" class="form-control" name="name" value="<?=$name?>">
				</div>
				<div class="form-group">
					Email:<input required="true" type="text" class="form-control" name="email" value="<?=$email?>">
				</div>
				<div class="form-group">
					Phone:<input required="true" type="text" class="form-control" name="phone" value="<?=$phone?>">
				</div>
				<div class="form-group">
					Address:<input required="true" type="text" class="form-control" name="address" value="<?=$address?>">
				</div>
				<div class="form-group">
					<input required="true" type="text" class="form-control" name="subject_name" placeholder="Nhập tên chủ đề">
				</div>
				<div class="form-group">
					<label for="pwd">Nội dung:</label>
					<textarea class="form-control" rows="4" name="note"></textarea>
				</div>
				<a href="checkout.php"><button class="btn btn-success" onclick="handleContact()" style="border-radius: 0px; font-size: 26px; width: 100%;">GỬI PHẢN HỒI</button></a>
			</div>
			<div class="col-md-6">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2167.8646131253067!2d105.76228181953536!3d20.963199450802428!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313452dc036aa48d%3A0x483220cc32c8639e!2zMzBhLCAzMCDEkC4gTMOqIFRy4buNbmcgVOG6pW4sIEjDoCBD4bqndSwgSMOgIMSQw7RuZywgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1636621994537!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
			</div>
		</div>
	</form>
</div>
<?php
require_once('layouts/footer.php');
?>

<script>
	function handleContact() {
		fName = $('[name=name]').val();
		email = $('[name=email]').val();
		subject_name = $('[name=subject_name]').val();
		note = $('[name=note]').val();

		if (fName != '' && email != '' && subject_name != '' && note != '') {
			alert("Cảm ơn bạn đã gửi phản hồi")
		}

	}
</script>