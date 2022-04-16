<?php

include('./autoload/Autoload.php');


$title = "Liên hệ";
include('./layouts/page/header.php');

if (Input::post('contact')) {

        $thong_tin = [
                'hoten'     => Input::post('hoten'),
                'email'     => Input::post('email'),
                'phone'     => Input::post('phone'),
                'chude'     => Input::post('chude'),
                'noidung'   => Input::post('noidung'),
                'trangthai' => 0
        ];

        $them_thanh_cong = $DB->create('lienhe', $thong_tin);
        if ($them_thanh_cong) {
                $thong_bao = 'Cảm ơn vì đã để lại phản hồi cho chúng tôi ';
        }
}
?>

<style>
        .form_field_wrap {
                margin-top: 20px;
        }
</style>
<!-- Start Middle -->
<div id="middle">
        <div class="middle_inner">
                <div class="content_wrap fullwidth">

                        <!-- Start Content -->
                        <div class="middle_content entry"></div>
                </div>
                <div id="cmsmasters_row_9991790c66" class="cmsmasters_row cmsmasters_color_scheme_default cmsmasters_row_top_default cmsmasters_row_bot_default cmsmasters_row_boxed">
                        <div class="cmsmasters_row_outer_parent" style="margin-bottom:100px">
                                <div class="cmsmasters_row_outer">
                                        <div class="cmsmasters_row_inner">
                                                <div class="cmsmasters_row_margin">
                                                        <div id="cmsmasters_column_" class="cmsmasters_column one_half">
                                                                <div class="cmsmasters_column_inner">
                                                                        <div id="cmsmasters_heading_427b55f5c7" class="cmsmasters_heading_wrap cmsmasters_heading_align_left">
                                                                                <h2 class="cmsmasters_heading" style="margin-bottom:50px">Form Liên hệ</h2>
                                                                        </div>
                                                                        <div class="cmsmasters_contact_form">
                                                                                <div class="cmsmasters-form-builder">
                                                                                        <?php if(isset($thong_bao)): ?>
                                                                                        <div class="cmsmasters_notice cmsmasters_notice_success cmsmasters_theme_icon_check success_box" style="display:block;">
                                                                                                <div class="notice_icon"></div>
                                                                                                <div class="notice_content">
                                                                                                        <p>Cảm ơn bạn <br />vì đã để lại phản hồi cho chúng tôi.</p>
                                                                                                </div>
                                                                                        </div>
                                                                                        <?php endif ?>
                                                                                        <form method="post" action="<?= url('contact.php') ?>">

                                                                                                <div class="form_info cmsmasters_input one_half">
                                                                                                        <label for="cmsmasters_name">Họ tên <span class="color_2">*</span></label>
                                                                                                        <div class="form_field_wrap">
                                                                                                                <input required type="text" name="hoten" id="cmsmasters_name" value="" size="35" class="validate[required]" />
                                                                                                        </div>
                                                                                                </div>
                                                                                                <div class="form_info cmsmasters_input one_half">
                                                                                                        <label for="cmsmasters_email">Email <span class="color_2">*</span></label>
                                                                                                        <div class="form_field_wrap">
                                                                                                                <input required type="text" name="email" id="cmsmasters_email" value="" size="35" class="validate[required,custom[email]]" />
                                                                                                        </div>
                                                                                                </div>
                                                                                                <div class="form_info cmsmasters_input one_first">
                                                                                                        <label for="cmsmasters_email">Điện thoại <span class="color_2">*</span></label>
                                                                                                        <div class="form_field_wrap">
                                                                                                                <input required type="text" name="phone" id="cmsmasters_email" value="" size="35" class="validate[required,custom[email]]" />
                                                                                                        </div>
                                                                                                </div>
                                                                                                <div class="form_info cmsmasters_input one_first">
                                                                                                        <label for="cmsmasters_email">Chủ đề <span class="color_2">*</span></label>
                                                                                                        <div class="form_field_wrap">
                                                                                                                <input required type="text" name="chude" id="cmsmasters_email" value="" size="35" class="validate[required,custom[email]]" />
                                                                                                        </div>
                                                                                                </div>
                                                                                                <div class="form_info cmsmasters_textarea one_first">
                                                                                                        <label for="cmsmasters_message_2">Nội dung <span class="color_2">*</span></label>
                                                                                                        <div class="form_field_wrap">
                                                                                                                <textarea required name="noidung" id="cmsmasters_message_2" cols="60" class="validate[required]"></textarea>
                                                                                                        </div>
                                                                                                </div>
                                                                                                <div class="cl"></div>
                                                                                                <div class="loading"></div>
                                                                                                <div class="form_info submit_wrap">
                                                                                                        <input type="submit" class="cmsmasters_button" name="contact" value="Gửi liên hệ"></input>
                                                                                                </div>
                                                                                                <div class="cl"></div>
                                                                                        </form>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>

                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>

                <!-- Finish Content -->


                <?php include('./layouts/page/footer.php') ?>