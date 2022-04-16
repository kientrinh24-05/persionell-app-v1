<?php
include('./autoload/Autoload.php');

//================================ logged -> redirect dash board

if (Auth::customer()) {

    Redirect::url('');
}

//================================ handle login


if (Input::hasPost('login')) {

    $email = Input::post('email');
    $password = md5(Input::post('password'));


    $sql = "SELECT * FROM khachhang WHERE email = '$email' && password = '$password'";

    $data = $DB->query($sql);

    if (is_array($data)) {

        Session::put('customer', $data);
        Redirect::url('');
    }

    $error = "Sai tên đăng nhập hoặc mật khẩu";
}

$title = "Đăng nhập ";
include('./layouts/page/header.php');




?>

<!-- Start Middle -->
<div id="middle">
    <div class="middle_inner">
        <div class="content_wrap fullwidth">

            <!-- Start Content -->
            <div class="middle_content entry">
                <div class="woocommerce">
                    <div class="woocommerce-notices-wrapper"></div>

                    <h2>Đăng nhập </h2>

                    <form class="woocommerce-form woocommerce-form-login login" method="post">

                        <?php if (isset($error)) : ?>
                            <div class="alert alert-danger" style="margin-bottom:20px; padding:15px; color:#721c24;background-color: #f8d7da; border-color: #f5c6cb; ">
                                <?= $error ?>
                            </div>
                        <?php endif ?>



                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="username">Email<span class="required">*</span></label>
                            <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="username" autocomplete="username" value="" required /> </p>
                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="password">Mật khẩu&nbsp;<span class="required">*</span></label>
                            <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" required />
                        </p>
                        <p class="form-row">
                            <button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="Log in">Đăng nhập</button>
                        </p>


                    </form>


                </div>
                <div class="cl"></div>
            </div>
            <!-- Finish Content -->



        </div>
    </div>
</div>
<!-- Finish Middle -->
<?php

include('./layouts/page/footer.php');

?>