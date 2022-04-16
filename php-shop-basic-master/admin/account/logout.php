<?php 

    include('../../autoload/Autoload.php');

    Session::forget('user');

    Redirect::url('/admin/account/login.php');