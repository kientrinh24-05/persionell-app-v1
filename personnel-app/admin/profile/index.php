<?php
include('../../autoload/Autoload.php');

//================== check login

if (!Auth::user()) {

    Redirect::url('admin/account/login.php');
}


$id   = Input::get('id');



if (Input::hasPost('create')) {



    $hoten   = Input::post('hoten');
    $phone   = Input::post('phone');
    $diachi  = Input::post('diachi');
    $email   = Input::post('email');
    $note    = Input::post('note');
    $hinhanh = Input::post('thumbnailUrl');

    Validator::required($hoten, "Vui lòng nhập họ tên")
        ->min($hoten, 1, "Tên sản phẩm quá ngắn")
        ->required($phone, "Vui lòng nhập số điện thoại");


    if (!Validator::anyErrors()) {

        $success = $DB->update('duan', [
            'hoten'   => $hoten,
            'phone'   => $phone,
            'diachi'  => $diachi,
            'email'   => $email,
            'avatar'  => $hinhanh,
            'note'    => $note,
        ], $id);

        if ($success === true) {
            $alertSuccess = "Cập nhật khách hàng thành công";
        } else {
            $alertErr     = $success;
        }
    }
}




$data   = $DB->find('duan', $id);

// if (!is_object($data)) {
//     die('Không tồn tại khách hàng');
// }


$title = "Thêm mới danh mục sản phẩm";
include('../../layouts/admin/header.php');
?>
<div class="d-flex justify-content-between mb-4">
    <h4>Thông tin user</h4>
    <a href="<?= url('admin/customer') ?>" class="btn btn-primary btn-sm"><i class="mdi mdi-arrow-left-bold"></i></a>
</div>
<div class="container">
    <div class="grid-body">
        <div class="item-wrapper">
            <!-- <form method="post">
                <div class="row mb-3">
                    <div class="col-md-8 mx-auto">
                        <?php
                        if (Validator::anyErrors()) : ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php foreach (Validator::$errors as $err) : ?>
                                        <li><?= $err ?></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        <?php endif ?>

                        <?php
                        if (isset($alertSuccess)) : ?>
                            <div class="alert alert-success">
                                <ul>
                                    <li><?= $alertSuccess ?></li>
                                </ul>
                            </div>
                        <?php endif ?>

                        <?php if (isset($alertErr)) : ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <li><?= $alertErr ?></li>
                                </ul>
                            </div>
                        <?php endif ?>

                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType1">Tên khách hàng</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left">
                                <input type="text" class="form-control" id="inputType1" name="hoten" value="<?= $data->hoten ?>" >
                            </div>
                        </div>
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType1">Điện thoại</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left">
                                <input type="text" class="form-control" id="inputType2" name="phone" value="<?= $data->phone ?>">
                            </div>
                        </div>
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType1">Email</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left">
                                <input type="text" class="form-control" id="inputType3" name="email"  value="<?= $data->email ?>">
                            </div>
                        </div>

                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType1">Địa chỉ</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left">
                                <input type="text" class="form-control" id="inputType4" name="diachi"  value="<?= $data->diachi ?>">
                            </div>
                        </div>
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType1">Ghi chú</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left">
                                <input type="text" class="form-control" id="inputType4" name="note"  value="<?= $data->note ?>">
                            </div>
                        </div>
                        <div class="form-group row showcase_row_area thumb mb-5">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType7">Ảnh đại diện</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left upload-thumb">
                                <div class="upload-thumb-canvas">
                                    <img id="thumbnail" alt="" class="img-fluid h-100" src="<?= $data->avatar?>">
                                    <input type="file" class="form-control upload-thumb-input" id="inputType7" name="thumbnailUpload">
                                    <input type="hidden" class="form-control upload-thumb-input" id="inputType7" name="thumbnailUrl" value="<?= $data->avatar ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <button type="submit" name="create" class="btn btn-sm btn-success">Cập nhật</button>
                            </div>
                        </div>
                    </div>

                </div>
            </form> -->
            <div class="container1">
            <div class="avatar-flip">
                <img src="http://media.idownloadblog.com/wp-content/uploads/2012/04/Phil-Schiller-headshot-e1362692403868.jpg" height="150" width="150">
                <img src="http://i1112.photobucket.com/albums/k497/animalsbeingdicks/abd-3-12-2015.gif~original" height="150" width="150">
            </div>
            <h2>John Smith</h2>
            <h4>HOVER OVER CONTAINER</h4>
            <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Maecenas sed diam eget risus varius blandit sit amet non magna ip sum dolore.</p>
            <p>Connec dolore ipsum faucibus mollis interdum. Donec ullamcorper nulla non metus auctor fringilla.</p>
</div>

        </div>

    </div>



    <?php
    include('../../layouts/admin/footer.php');
    ?>

    <style>
        .container1 {
  width: 400px;
  margin: 120px auto 120px;
  background-color: #fff;
  padding: 0 20px 20px;
  border-radius: 6px;
  -webkit-border-radius: 6px;
  -moz-border-radius: 6px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.075);
  -webkit-box-shadow: 0 2px 5px rgba(0,0,0,0.075);
  -moz-box-shadow: 0 2px 5px rgba(0,0,0,0.075);
  text-align: center;
}
.container1:hover .avatar-flip {
  transform: rotateY(180deg);
  -webkit-transform: rotateY(180deg);
}
.container1:hover .avatar-flip img:first-child {
  opacity: 0;
}
.container1:hover .avatar-flip img:last-child {
  opacity: 1;
}
.avatar-flip {
  border-radius: 100px;
  overflow: hidden;
  height: 150px;
  width: 150px;
  position: relative;
  margin: auto;
  top: -60px;
  transition: all 0.3s ease-in-out;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  box-shadow: 0 0 0 13px #f0f0f0;
  -webkit-box-shadow: 0 0 0 13px #f0f0f0;
  -moz-box-shadow: 0 0 0 13px #f0f0f0;
}
.avatar-flip img {
  position: absolute;
  left: 0;
  top: 0;
  border-radius: 100px;
  transition: all 0.3s ease-in-out;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
}
.avatar-flip img:first-child {
  z-index: 1;
}
.avatar-flip img:last-child {
  z-index: 0;
  transform: rotateY(180deg);
  -webkit-transform: rotateY(180deg);
  opacity: 0;
}
.container1 h2 {
  font-size: 32px;
  font-weight: 600;
  margin-bottom: 15px;
  color: #333;
}
.container1 h4 {
  font-size: 13px;
  color: #00baff;
  letter-spacing: 1px;
  margin-bottom: 25px
}
.container1 p {
  font-size: 16px;
  line-height: 26px;
  margin-bottom: 20px;
  color: #666;
}

        .upload-thumb {
            position: relative;
        }

        .upload-thumb-input {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 999;
            opacity: 0;
            cursor: pointer;
        }

        .upload-thumb-canvas {
            position: relative;
            border: 2px dotted #857bff;
            width: 80px;
            height: 80px;
            overflow: hidden;
            padding: 2px;
        }
    </style>

    <script>
        let inputThumbnail = document.querySelector('input[name="thumbnailUpload"]');
        let thumbnailUrl = document.querySelector('input[name="thumbnailUrl"]');
        inputThumbnail.addEventListener('change', function() {
            let thumbnail = document.querySelector('#thumbnail');

            let url = "<?= url('admin/upload/index.php') ?>";
            let formData = new FormData();
            formData.append("thumbnailUpload", inputThumbnail.files[0]);
            fetch(url, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {

                    thumbnailUrl.value = data;
                    let path = data;
                    thumbnail.setAttribute("src", path);
                })
                .catch(err => {
                    console.log(err);
                })
        })
    </script>