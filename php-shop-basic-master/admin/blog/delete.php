<?php
include('../../autoload/Autoload.php');

//================== check login

if (!Auth::user()) {

    Redirect::url('admin/account/login.php');
}

    
$id   = Input::get('id');

$data = $DB->find('baiviet', $id);

if (!is_object($data)) {
    die('Không tồn tại bài viết');
}

$deleted = $DB->delete('lienhe',$id);

if($deleted === true){
    Redirect::url('admin/blog');
}

die('Vui lòng thử lại');
