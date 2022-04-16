<?php
include('../../autoload/Autoload.php');

//================== check login

if (!Auth::user()) {

    Redirect::url('admin/account/login.php');
}

    
$id   = Input::get('id');

$data = $DB->find('nhanvien', $id);

if (!is_object($data)) {
    die('Không tồn tại danh mục');
}

$deleted = $DB->delete('nhanvien',$id);

if($deleted === true){
    Redirect::url('admin/employment');
}

die('Vui lòng thử lại');
