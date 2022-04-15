<?php
include('../../autoload/Autoload.php');

//================== check login

if (!Auth::user()) {

    Redirect::url('admin/account/login.php');
}

    
$id   = Input::get('id');

$data = $DB->find('roles', $id);

if (!is_object($data)) {
    die('Không tồn tại quyền');
}

$deleted = $DB->delete('roles',$id);

if($deleted === true){
    Redirect::url('admin/roles');
}

die('Vui lòng thử lại');
