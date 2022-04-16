<?php 
include('./autoload/Autoload.php');
$id = Input::get('vnp_TxnRef');
$success = $DB->update(
    'donhang',
    [
        'trangthai'       => 1,
    ],
    $id
);
header('location: checkout_success.php');

// Ngân hàng	NCB
// Số thẻ	9704198526191432198
// Tên chủ thẻ	NGUYEN VAN A
// Ngày phát hành	07/15
// Mật khẩu OTP	123456