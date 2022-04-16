<?php
header('Content-Type: application/json; charset=utf-8');

if (isset($_FILES['thumbnailUpload'])) {
    $file_name = rand(100, 10000) . '-' . $_FILES['thumbnailUpload']['name'];
    $file_tmp = $_FILES['thumbnailUpload']['tmp_name'];
    $file_type = $_FILES['thumbnailUpload']['type'];
    $file_erro = $_FILES['thumbnailUpload']['error'];
    if ($file_erro == 0) {
        $part = $_SERVER['DOCUMENT_ROOT'] . '/public/uploads/images/';
        $data['avatar'] = $file_name;
        move_uploaded_file($file_tmp, $part . $file_name);
        echo json_encode('/public/uploads/images/' . $file_name);
        return;
    }
}
echo('upload err !');   