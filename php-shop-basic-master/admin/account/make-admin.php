<?php 
include('../../autoload/Autoload.php');


    $username = "admin";
    $password = md5("123456");
    $email    = "admin@gmail.com";
    $avatar   = "avatar-default.jpg";   
    $success  = $DB->create('users',
        [
            'name'     => $username,
            'email'    => $email,
            'password' => $password,
            'avatar'   => $avatar,
        ]
    );
    if($success){
        echo('Tao admin thanh cong !');
    }
    
