<?php
include('../../autoload/Autoload.php');

//================== check login

if (!Auth::user()) {

    Redirect::url('admin/account/login.php');
}

    
$id   = Input::get('id');

$data = $DB->find('duan', $id);

if (!is_object($data)) {
    die('Không tồn tại dự án');
}

$deleted = $DB->delete('duan',$id);

if($deleted === true){
    Redirect::url('admin/product');
}

die('Vui lòng thử lại');
