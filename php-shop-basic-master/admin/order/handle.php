<?php
include('../../autoload/Autoload.php');

//================== check login

if (!Auth::user()) {

    Redirect::url('admin/account/login.php');
}

    
$id   = Input::get('id');

$data = $DB->find('donhang', $id);
if (!is_object($data)) {
    die('Không tồn tại đơn hàng');
}

$updated = $DB->update('donhang',['trangthai' => true],$id);

if($updated === true){
    Redirect::url('admin/order');
}

die('Vui lòng thử lại');
