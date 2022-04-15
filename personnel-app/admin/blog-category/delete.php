<?php
include('../../autoload/Autoload.php');

//================== check login

if (!Auth::user()) {

    Redirect::url('admin/account/login.php');
}

    
$id   = Input::get('id');

$data = $DB->find('danhmuc_blog', $id);

if (!is_object($data)) {
    die('Không tồn tại danh mục');
}

$deleted = $DB->delete('danhmuc_blog',$id);

if($deleted === true){
    Redirect::url('admin/blog-category');
}

die('Vui lòng thử lại');
