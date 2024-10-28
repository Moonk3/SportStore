<?php
$baseUrl = './mail';
require_once('layouts/header.php');
require_once("./mail/sendmail.php");
require_once('TCPDF/tcpdf.php'); 

$invoices_directory = __DIR__ . '/' . $baseUrl . '/invoices/';
if (!is_dir($invoices_directory)) {
    mkdir($invoices_directory, 0777, true); 
}

$tieude = "Đặt hàng website sportstore.vn thành công!";
$noidung = "<p>Cảm ơn quý khách đã đặt hàng của chúng tôi: </p>";
$noidung .= "<h4>Đơn hàng của bạn bao gồm: </h4>";
$noidung .= "<table style='border-collapse: collapse; width: 100%;border: 1px solid black;'>";

$tongTien = 0;
foreach ($_SESSION['cart'] as $item) {
    $tien = $item['discount'] * $item['num'];
    $tongTien += $tien;
        $noidung .= "<tr>
        <td>" . htmlspecialchars($item['name']) . "</td>
        <td>" . number_format($item['discount']) . " VND</td>
        <td>" . $item['num'] . "</td>
    </tr>";
}

$noidung .= "</table>";
$maildathang = $_SESSION['email'];
$mail = new Mailer();
$mail->datHangMail($tieude, $noidung, $maildathang);
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Đồ Thể Thao Minh An');
$pdf->SetTitle('Hóa Đơn Bán Lẻ');
$pdf->SetSubject('Hóa Đơn Bán Lẻ');

$pdf->SetFont('dejavusans', '', 10);

$pdf->AddPage();

$noidungpdf = '';
$tongTienpdf = 0;
$stt = 1; 
foreach ($_SESSION['cart'] as $item) {
    $tien = $item['discount'] * $item['num'];
    $tongTienpdf += $tien;
    
    $noidungpdf .= "<tr>
        <td>{$stt}</td>
        <td>" . htmlspecialchars($item['name']) . "</td>
        <td>" . number_format($item['discount']) . " VND</td>
        <td>" . $item['num'] . "</td>
        <td>" . number_format($item['discount']) . " VND</td>
        <td>" . number_format($tien) . " VND</td>
    </tr>";
    $stt++; 

}
$htmlHeader = <<<EOD
<style>
h2, h3, h4, p {
    font-family: "dejavusans";
    margin: 0;
    padding: 0;
    line-height: 1.2;
}
.header-title {
    font-size: 18px;
    color: #000;
    font-weight: bold;
}
.header-info {
    font-size: 10px;
    color: #000;
}
.table-header {
    background-color: #f0f0f0;
    font-weight: bold;
}
.table-spacing {
    margin-top: 20px;
    margin-bottom: 20px;
}
</style>
<table>
    <tr>
        <td style="width: 50%;">
            
        </td>
        <td style="width: 50%; text-align: right;">
            <h2 class="header-title">CÔNG TY TNHH ĐỒ THỂ THAO MINH AN</h2>
            <p class="header-info">Địa chỉ: 56 Tô Ký, Khương Thượng, Đống Đa, Hà Nội</p>
            <p class="header-info">Điện thoại: 123.456.7891</p>
            <p class="header-info">Email: Nhom7@gmail.com</p>
            <p class="header-info">Website: http://phpdothethao.vn</p>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="table-spacing">
            <h3 class="header-title" style="text-align: center;">HÓA ĐƠN BÁN LẺ</h3>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <p>Họ tên người mua hàng: ..........................................................</p>
            <p>Địa chỉ: .................................................................................</p>
        </td>
    </tr>
</table>
EOD;

$htmlFooter = <<<EOD
<table cellspacing="0" cellpadding="5" border="0" class="table-spacing">
    <tr>
        <td>NGƯỜI MUA HÀNG</td>
        <td>NGƯỜI BÁN HÀNG</td>
    </tr>
    <tr>
        <td>(Ký, ghi rõ họ tên)</td>
        <td>(Ký, ghi rõ họ tên)</td>
    </tr>
</table>
EOD;

$productTable = <<<EOD
<table cellpadding="4" cellspacing="1" border="1" style="border-collapse: collapse;" class="table-spacing">
    <tr class="table-header">
        <th>STT</th>
        <th>Tên Thiết Bị</th>
        <th>Đơn Vị</th>
        <th>Số Lượng</th>
        <th>Đơn Giá</th>
        <th>Thành Tiền</th>
    </tr>
    {$noidungpdf}
</table>
EOD;

$htmlContent = $htmlHeader . $productTable . $htmlFooter;
$pdf->writeHTML($htmlContent, true, false, true, false, '');
$pdf_filename = 'hoadon_' . time() . '.pdf'; 
$pdf_file_path = $invoices_directory . $pdf_filename;
$pdf->Output($pdf_file_path, 'F'); 

$download_link = $baseUrl . '/invoices/' . $pdf_filename;

unset($_SESSION['cart']); 
echo "<div class='container' style='margin-top: 20px;'>";
echo "<div class='container' style='margin-top: 20px; margin-bottom: 20px;'>";
echo "<div class='row'>";
echo "<div class='col-md-12' style='text-align: center;'>";
echo "<h1 style='color: green'>BẠN ĐÃ TẠO ĐƠN HÀNG THÀNH CÔNG!!!</h1>";
echo "<h4>Cảm ơn quý khách đã đặt mua sản phẩm của chúng tôi! Đơn hàng của quý khách đã được gửi đến email của bạn và sẽ giao hàng trong thời gian sớm nhất.</h4>";
echo "<a href='index.php'><button class='btn btn-success' style='border-radius: 0px; font-size: 26px;'>TIẾP TỤC MUA HÀNG</button></a>";
echo "<div class='container' style='text-align: center; margin-top: 20px; margin-bottom: 20px;'>";
echo "<h3>Hóa đơn của bạn đã sẵn sàng!</h3>";
echo "<a href='" . $download_link . "' download='" . $pdf_filename . "'><button class='btn btn-primary'>Tải xuống hóa đơn</button></a>";
echo "</div>";

echo "</div>";
echo "</div>";
echo "</div>";

require_once('layouts/footer.php');
?>
