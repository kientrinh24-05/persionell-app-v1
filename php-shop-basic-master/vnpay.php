
<?php 
include('./autoload/Autoload.php');

$vnp_TxnRef = Input::get('orderId') ?? 'code el 2';
$vnp_OrderInfo = Input::get('note') ?? 'note';
$vnp_OrderType = 'billpayment';
$vnp_Amount = (Input::get('total') ?? 20000 ) * 100;
$vnp_Locale = 'vn';
$vnp_BankCode = "NCB";
$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

$inputData = array(
    "vnp_Version" => "2.0.0",
    "vnp_TmnCode" => '9PV2XG06',
    "vnp_Amount" => $vnp_Amount,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => $vnp_OrderInfo,
    "vnp_OrderType" => $vnp_OrderType,
    "vnp_ReturnUrl" =>  'http://localhost:8080/vnpay-success.php',
    "vnp_TxnRef" => $vnp_TxnRef,
);

if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    $inputData['vnp_BankCode'] = $vnp_BankCode;
}
ksort($inputData);
$query = "";
$i = 0;
$hashdata = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashdata .= '&' . $key . "=" . $value;
    } else {
        $hashdata .= $key . "=" . $value;
        $i = 1;
    }
    $query .= urlencode($key) . "=" . urlencode($value) . '&';
}

$vnp_Url =  'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html';
// $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
$vnpSecureHash = hash('sha256', 'QYNEJTXTTYYQWXIFMRXAZFQTNUXGFFGO' . $hashdata);
$vnp_Url .= '?' . $query;
$vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;

Redirect::to($vnp_Url);

?>