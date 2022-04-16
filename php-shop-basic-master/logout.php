<?php

include('./autoload/Autoload.php');

Session::forget('customer');

Redirect::url('');
