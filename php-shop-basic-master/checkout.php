<?php

include('./autoload/Autoload.php');

$cart = Session::get('cart');
$total = 0;
$countProduct = 0;

if (is_array($cart)) {
    foreach ($cart as $item) {

        $total += $item->so_luong_mua * $item->giaban;

        $countProduct++;
    }
}


if (Input::post('checkout')) {

    if (Auth::customer()) {
        $DB->update(
            'khachhang',
            [
                'phone'  => Input::post('phone'),
                'diachi' => Input::post('diachi')
            ],
            Auth::customer()->id
        );

        $don_hang = [
            'tongtien'     => $total,
            'khachhang_id' => Auth::customer()->id,
            'trangthai'    => 0,
        ];
        
    } else {

        $khachhang = [

            'hoten'  => Input::post('hoten'),
            'phone'  => Input::post('phone'),
            'email'  => Input::post('email'),
            'diachi' => Input::post('diachi'),
            'note'   => Input::post('note'),
            'avatar' => 'employee-avatar.png'
        ];

        $DB->create('khachhang', $khachhang);

        $idKhachhang = $DB->getInsertID();

        $don_hang = [
            'tongtien'  => $total,
            'khachhang_id'  => $idKhachhang,
            'trangthai' => 0,
        ];
    }


    $created = $DB->create('donhang', $don_hang);
    if ($created) {

        $idDonHang = $DB->getInsertID();

        foreach ($cart as $product) {
            $chi_tiet = [
                'sanpham_id' => $product->id,
                'donhang_id' => $idDonHang,
                'soluongmua' => $product->so_luong_mua,
                'dongia'     => $product->giaban,
                'sale'       => $product->sale,
            ];
            $created = $DB->create('chitietdonhang', $chi_tiet);

            if(Input::post('payment_type') == 'ship') {
                if ($created) {
                    $_SESSION['thong_bao'] = true;
                    unset($_SESSION['cart']);
                    header('location: checkout_success.php');
                } else {
                    $_SESSION['thong_bao'] = false;
                    header('location: checkout_success.php');
                }
            }
            else {
                header("location: vnpay.php?orderId=$idDonHang&total=$total");
            }
       
        }
    }
}



$title = "Thanh toán";
include('./layouts/page/header.php');

?>


<!-- Start Middle -->
<div id="middle">
    <div class="headline cmsmasters_color_scheme_default">
    </div>
    <div class="middle_inner">
        <div class="content_wrap fullwidth">

            <!-- Start Content -->
            <div class="middle_content entry">
                <div class="woocommerce">
                    <div class="woocommerce-notices-wrapper"></div>
                    <div class="woocommerce-form-coupon-toggle">
                    </div>
                    <div class="woocommerce-notices-wrapper"></div>
                    <form name="checkout" method="post" class="checkout woocommerce-checkout" enctype="multipart/form-data">
                        <?php if (Auth::customer()) : ?>
                            <div class="col2-set" id="customer_details">
                                <div class="col-1">
                                    <div class="woocommerce-billing-fields">

                                        <h3>Thông tin bổ sung</h3>



                                        <div class="woocommerce-billing-fields__field-wrapper">

                                            <p class="form-row form-row-wide address-field validate-state" id="billing_state_field" data-priority="80"><label for="billing_state" class="">Địa chỉ <abbr class="required" title="required">*</abbr></span></label><span class="woocommerce-input-wrapper"><input type="text" required class="input-text " value="" placeholder="" name="diachi" id="billing_state" autocomplete="address-level1" data-input-classes="" /></span></p>
                                            <p class="form-row form-row-wide validate-required validate-phone" id="billing_phone_field" data-priority="100"><label for="billing_phone" class="">Số điện thoại&nbsp;<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper"><input type="tel" required class="input-text " name="phone" id="billing_phone" placeholder="" value="" autocomplete="tel" /></span></p>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="woocommerce-shipping-fields">
                                    </div>
                                    <div class="woocommerce-additional-fields">





                                        <div class="woocommerce-additional-fields__field-wrapper">
                                            <p class="form-row notes" id="order_comments_field" data-priority=""><label for="order_comments" class="">Ghi chú &nbsp;<span class="optional"></span></label><span class="woocommerce-input-wrapper"><textarea name="note" class="input-text " id="order_comments" placeholder="Ghi chú thêm về đơn hàng của bạn" rows="2" cols="5"></textarea></span></p>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="col2-set" id="customer_details">
                                <div class="col-1">
                                    <div class="woocommerce-billing-fields">

                                        <h3>Nhập thông tin của bạn</h3>

                                        <div class="woocommerce-billing-fields__field-wrapper">
                                            <p class="form-row form-row-last validate-required" id="billing_last_name_field" data-priority="20"><label for="billing_last_name" class="">Họ tên&nbsp;<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper"><input type="text" required class="input-text " name="hoten" id="billing_last_name" placeholder="" value="" autocomplete="family-name" /></span></p>
                                            <p class="form-row form-row-wide address-field validate-state" id="billing_state_field" data-priority="80"><label for="billing_state" class="">Địa chỉ <abbr class="required" title="required">*</abbr></span></label><span class="woocommerce-input-wrapper"><input type="text" required class="input-text " value="" placeholder="" name="diachi" id="billing_state" autocomplete="address-level1" data-input-classes="" /></span></p>
                                            <p class="form-row form-row-wide validate-required validate-phone" id="billing_phone_field" data-priority="100"><label for="billing_phone" class="">Số điện thoại&nbsp;<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper"><input type="tel" required class="input-text " name="phone" id="billing_phone" placeholder="" value="" autocomplete="tel" /></span></p>
                                            <p class="form-row form-row-wide validate-required validate-email" id="billing_email_field" data-priority="110"><label for="billing_email" class="">Email &nbsp;<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper"><input type="email" required class="input-text " name="email" id="billing_email" placeholder="" value="" autocomplete="email username" /></span></p>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="woocommerce-shipping-fields">
                                    </div>
                                    <div class="woocommerce-additional-fields">



                                        <h3>Thông tin bổ sung</h3>


                                        <div class="woocommerce-additional-fields__field-wrapper">
                                            <p class="form-row notes" id="order_comments_field" data-priority=""><label for="order_comments" class="">Ghi chú &nbsp;<span class="optional"></span></label><span class="woocommerce-input-wrapper"><textarea name="note" class="input-text " id="order_comments" placeholder="Ghi chú thêm về đơn hàng của bạn" rows="2" cols="5"></textarea></span></p>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                        <h3 id="order_review_heading">Đơn hàng của bạn</h3>
                        <?php if (is_array($cart)) : ?>
                            <div id="order_review" class="woocommerce-checkout-review-order">
                                <table class="shop_table woocommerce-checkout-review-order-table">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Sản phẩm</th>
                                            <th class="product-total">Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($cart as $item) : ?>

                                            <tr class="cart_item">
                                                <td class="product-name">
                                                    <?= $item->tensanpham ?> 5T&nbsp; <strong class="product-quantity">&times;&nbsp;<?= $item->so_luong_mua ?></strong> </td>
                                                <td class="product-total">
                                                    <span class="woocommerce-Price-amount amount"><span><span class="woocommerce-Price-currencySymbol">&#36;</span></span><?= number_format($item->giaban * $item->so_luong_mua) . ' vnđ'  ?></span> </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                    <tfoot>


                                        <tr class="order-total">
                                            <th>Tổng tiền</th>
                                            <td><strong><span class="woocommerce-Price-amount amount"><span><span class="woocommerce-Price-currencySymbol"></span></span><?= number_format($total) . ' vnđ'  ?></span></strong> </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div id="payment" class="woocommerce-checkout-payment">
                                    <div class=""> 
                                        <input id="paynet_ship" type="radio" name="payment_type" value="ship" checked>
                                        <label for="paynet_ship">Thanh toán sau khi giao hàng</label>
                                    </div>
                                    <div style="margin-bottom: 20px"> 
                                        <input id="paynet_vnpay" type="radio" name="payment_type" value="vnpay">
                                        <label for="paynet_vnpay">Thanh toán VNPAY</label>
                                    </div>
                                    <button type="submit" class="button alt" name="checkout" id="place_order" value="Place order" data-value="Place order">Đặt hàng</button>
                                </div>
                            </div>
                        <?php else : ?>
                            <h2 class="alert alert-warning" style="height: 40vh">Đơn hàng của bạn chưa có sản phẩm nào !</h2>

                        <?php endif ?>
                </div>


                </form>

            </div>
            <div class="cl"></div>
        </div>
        <!-- Finish Content -->



    </div>
</div>
</div>

<!-- Finish Bottom -->
<a href="javascript:void(0)" id="slide_top" class="cmsmasters_theme_icon_slide_top"><span></span></a>
</div>
<!-- Finish Main -->


<?php include('./layouts/page/footer.php') ?>