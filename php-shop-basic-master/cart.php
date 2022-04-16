<?php

include('./autoload/Autoload.php');


$title = "Giỏ hàng";
include('./layouts/page/header.php');

?>

<!-- Start Main -->
<div id="main">

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
                        <?php if (is_array($cart)) : ?>
                            <form class="woocommerce-cart-form" action="<?= url('update-cart.php') ?>" method="post">

                                <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="product-remove">&nbsp;</th>
                                            <th class="product-thumbnail">&nbsp;</th>
                                            <th class="product-name">Sản phẩm</th>
                                            <th class="product-price">Giá bán</th>
                                            <th class="product-quantity">Số lượng</th>
                                            <th class="product-subtotal">Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ($cart as $item) : ?>
                                            <tr class="woocommerce-cart-form__cart-item cart_item">

                                                <td class="product-remove">
                                                    <a href="remove-product.php?id=<?= $item->id ?>" class="remove" aria-label="Remove this item" data-product_id="1631" data-product_sku="">&times;</a> </td>

                                                <td class="product-thumbnail">
                                                  <a href="<?= url('product-detail.php?id='. $item->id) ?>">
                                                    <img width="540" height="540" src="<?= $item->hinhanh ?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="<?= $item->hinhanh ?>" sizes="(max-width: 540px) 100vw, 540px" />
                                                  </a> 
                                                </td>

                                                <td class="product-name" data-title="Product">
                                                    <a href="<?= url('product-detail.php?id='. $item->id) ?>"><?= $item->tensanpham ?></a> </td>

                                                <td class="product-price" data-title="Price">
                                                    <span class="woocommerce-Price-amount amount"><span><?=  number_format($item->giaban) . ' vnđ'  ?></span> </td>

                                                <td class="product-quantity" data-title="Quantity">
                                                    <div class="quantity">
                                                        <label class="screen-reader-text" for="quantity_5ef2ea9d0f8dd"><?= $item->tensanpham ?></label>
                                                        <input type="number" id="quantity_5ef2ea9d0f8dd" class="input-text qty text" step="1" min="0" max="" name="<?= $item->id ?>" value="<?= $item->so_luong_mua ?>" title="Qty" size="4" placeholder="" inputmode="numeric" />
                                                    </div>
                                                </td>

                                                <td class="product-subtotal" data-title="Subtotal">
                                                    <span class="woocommerce-Price-amount amount"><span><span><?=  number_format($item->giaban * $item->so_luong_mua) . ' vnđ'  ?></span> </td>
                                            </tr>
                                        <?php endforeach ?>

                                        <tr>
                                            <td colspan="6" class="actions">

                                                <!-- <div class="coupon">
                                                    <label for="coupon_code">Coupon:</label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="Coupon code" /> <button type="submit" class="button" name="apply_coupon" value="Apply coupon">Apply coupon</button>
                                                </div> -->

                                                <button type="submit" class="button" name="update-cart" value="Update cart">Cập nhật giỏ hàng</button>


                                                <input type="hidden" id="woocommerce-cart-nonce" name="woocommerce-cart-nonce" value="64dec288a9" /><input type="hidden" name="_wp_http_referer" value="/cart/" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>


                            <div class="cart-collaterals">
                                <div class="cart_totals ">


                                    <h2>Hóa đơn</h2>

                                    <table cellspacing="0" class="shop_table shop_table_responsive">

                                        <tr class="cart-subtotal">
                                            <th>Tổng tiền</th>
                                            <td data-title="Subtotal"><span class="woocommerce-Price-amount amount"><span></span><?= number_format($total) . ' vnđ' ?></span></td>
                                        </tr>


                                        <tr class="order-total">
                                            <th>Phí ship</th>
                                            <td data-title="Total"><strong><span class="woocommerce-Price-amount amount"><span><span class="woocommerce-Price-currencySymbol"></span></span>Miễn phí</span></strong> </td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Thành tiền</th>
                                            <td data-title="Total"><strong><span class="woocommerce-Price-amount amount"><span><span><?=  number_format($total) . ' vnđ'  ?></span></strong> </td>
                                        </tr>
                                    </table>
                                    <div class="wc-proceed-to-checkout">
                                        <a href="<?= url('checkout.php') ?>" class="checkout-button button alt wc-forward">
                                            Thanh toán</a>
                                    </div>
                                </div>
                            </div>
                        <?php else : ?>
                            <h2 class="alert alert-warning" style="height: 40vh">Giỏ hàng của bạn chưa có sản phẩm nào !</h2>
                        <?php endif ?>
                    </div>
                    <div class="cl"></div>
                </div>
                <!-- Finish Content -->



            </div>
        </div>
    </div>

    <a href="javascript:void(0)" id="slide_top" class="cmsmasters_theme_icon_slide_top"><span></span></a>
</div>
<!-- Finish Main -->



<?php include('./layouts/page/footer.php') ?>