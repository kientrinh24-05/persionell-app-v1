<?php
include('../../autoload/Autoload.php');

//================== check login

if (!Auth::user()) {

    Redirect::url('admin/account/login.php');
}

    
$id   = Input::get('id');

$data = $DB->find('users', $id);

if (!is_object($data)) {
    die('Không tồn tại users');
}

$deleted = $DB->delete('users',$id);

if($deleted === true){
    Redirect::url('admin/project');
}

die('Vui lòng thử lại');
