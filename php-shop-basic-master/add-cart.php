<?php

include('./autoload/Autoload.php');

$id_sanpham = Input::get('id');
$sanpham    = $DB->find('sanpham', $id_sanpham);
if (is_object($sanpham)) {
    /**
     * 
     * Kiểm tra sản phẩm đã có trong giỏ hàng 
     */
    $so_luong_mua  = Input::get('so_luong') ?? 1;

    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product) {

            if ($product->id == $id_sanpham) {
                $_SESSION['cart'][$id_sanpham]->so_luong_mua = $product->so_luong_mua + $so_luong_mua;
                $_SESSION['cart'][$product->id]->thanh_tien  =  $_SESSION['cart'][$id_sanpham]->so_luong_mua * ($product->gia_ban * ((100 - $product->sale) / 100));

                header('location: cart.php');
            } else {

                /**
                 * Thành tiền = số lượng x giá sale
                 */
                $thanh_tien            = $so_luong_mua * ($sanpham->gia_ban * ((100 - $sanpham->sale) / 100));  // cong thuc anh tinh ra thanh tien = gia ban * gia ban sale ./..
                $sanpham->thanh_tien   = $thanh_tien;
                $sanpham->so_luong_mua = $so_luong_mua;;

                /**
                 * Thêm sản phẩm vào giỏ hàng
                 */
                $_SESSION['cart'][$id_sanpham] = $sanpham;

                header('location: cart.php');
            }
        }
    }


    /**
     * Thành tiền = số lượng x giá sale
     */
    $thanh_tien            = $so_luong_mua * ($sanpham->gia_ban * ((100 - $sanpham->sale) / 100));  // cong thuc anh tinh ra thanh tien = gia ban * gia ban sale ./..
    $sanpham->thanh_tien   = $thanh_tien;
    $sanpham->so_luong_mua = $so_luong_mua;;

    /**
     * Thêm sản phẩm vào giỏ hàng
     */
    $_SESSION['cart'][$id_sanpham] = $sanpham;

    header('location: cart.php');




    print_r($_SESSION['cart']);
} else {
    header('location: 404.php');
}
