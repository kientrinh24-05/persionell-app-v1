<?php
include('../../autoload/Autoload.php');

//================== check login

if (!Auth::user()) {

    Redirect::url('admin/account/login.php');
}

    
$id   = Input::get('id');

$data = $DB->find('luong', $id);

if (!is_object($data)) {
    die('Không tồn tại lương');
}

$deleted = $DB->delete('luong',$id);

if($deleted === true){
    Redirect::url('admin/wage');
}

die('Vui lòng thử lại');
