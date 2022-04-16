<?php  

include('./autoload/Autoload.php');

/**
 * Update cart
 * 
 */

if (isset($_POST['update-cart'])) {
    foreach ($_SESSION['cart'] as $product) {
        $_SESSION['cart'][$product->id]->so_luong_mua = $_POST[$product->id];
        $_SESSION['cart'][$product->id]->thanh_tien   =  $product->so_luong_mua * ($product->gia_ban * ((100 - $product->sale) / 100));
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    header('location: 404.php');
}
