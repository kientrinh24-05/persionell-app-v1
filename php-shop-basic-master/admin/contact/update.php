<?php

header('Content-Type: application/json; charset=utf-8');

include('../../autoload/Autoload.php');

//================== check login

if (!Auth::user()) {

    Redirect::url('admin/account/login.php');
}


$id   = Input::get('id');

$data   = $DB->find('lienhe', $id);

if (!is_object($data)) {
    die('Không tồn tại liên hệ');
}

$DB->update('lienhe',[
    'trangthai' => true
]
,$id);

echo(json_encode(1));

