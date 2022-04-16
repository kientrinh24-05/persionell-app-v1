<?php

include('./autoload/Autoload.php');


if(isset($_GET['id']) && isset($_SESSION['cart'])){
    unset($_SESSION['cart'][$_GET['id']]);
    header('location: cart.php');

}
else{
    header('location: 404.php');
}