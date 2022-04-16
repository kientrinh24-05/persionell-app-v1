<?php
include('./autoload/Autoload.php');
if (Input::post('register')) {

    $sql = "Select * FROM  khachhang WHERE email = '" . Input::post('email') . '\'';
    $isSetEmail = $DB->query($sql);

    if (!is_array($isSetEmail)) {

        $created = $DB->create('khachhang', [
            'email'    => Input::post('email'),
            'password' => md5(Input::post('password')),
            'avatar'   => 'employee-avatar.png',
            'hoten'    => Input::post('hoten'),
            'phone'    => Input::post('phone'),
        ]);


        if ($created) {
            $success = 'Đăng ký tài khoản thành công';
        } else {
            $error = 'Đăng ký tài khoản không thành công, vui lòng thử lại';
        }
    } else {
        $error = "Email đã tồn tại vui lòng sử dụng email khác";
    }
}


$title = "Đăng ký tài khoản thành viên";
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

                    <h2>Đăng ký tài khoản</h2>

                    <form class="woocommerce-form woocommerce-form-login login" method="post">
                        <?php if (isset($success)) : ?>
                            <div class="alert alert-success" style="margin-bottom:20px; padding:15px; color:#155724;background-color: #d4edda; border-color: #c3e6cb; ">
                                <?= $success ?>
                            </div>
                        <?php endif ?>
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
                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="password">Họ tên&nbsp;<span class="required">*</span></label>
                            <input class="woocommerce-Input woocommerce-Input--text input-text" type="text" name="hoten" id="hoten" autocomplete="current-password" required />
                        </p>
                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="password">Điện thoại&nbsp;<span class="required">*</span></label>
                            <input class="woocommerce-Input woocommerce-Input--text input-text" type="text" name="phone" id="phone" autocomplete="current-password" required />
                        </p>

                        <p class="form-row">
                            <button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="register" value="Log in">Đăng ký</button>
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