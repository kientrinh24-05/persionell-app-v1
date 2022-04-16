<?php
include('../../autoload/Autoload.php');

//================== check login

if (!Auth::user()) {

    Redirect::url('admin/account/login.php');
}

$chamcong = $DB->query('SELECT * FROM  chamcong');
//================= validate

if (Input::hasPost('create')) {

    $maBCC = Input::post('bcc_id');
    $ngaytao       = Input::post('ngaytao');
    $nguoitao       = Input::post('nguoitao');
    $luong       = Input::post('luong');

    Validator::required($nguoitao, "Vui lòng nhập tên người tạo")
        ->min($nguoitao, 3, "Tên người tạo phải lớn hơn 3 kí ự")
        ->required($luong, "Vui lòng nhập lương ")
        ->min($luong, 3, "Lương quá ngắn ");


    if (!Validator::anyErrors()) {
        $success = $DB->create('luong',[
            'maBCC' => $maBCC,
            'ngaytao'       => $ngaytao,
            'nguoitao'       => $nguoitao,
            'luong'       => $luong,
        ]);

        if($success === true){
            $alertSuccess = "Thêm lương thành công";
        }
        else{
            $alertErr     = $success;
        }
    }
}

$title = "Thêm mới lương";
include('../../layouts/admin/header.php');

?>
<div class="d-flex justify-content-between mb-4">
    <h4>Thêm mới lương</h4>
    <a href="<?= url('admin/wage') ?>" class="btn btn-primary btn-sm"><i class="mdi mdi-arrow-left-bold"></i></a>
</div>
<div class="container">
    <div class="grid-body">
        <div class="item-wrapper">
            <form action="<?= url('admin/blog-category/create.php') ?>" method="post">
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

                        <?php if(isset($alertErr)): ?>
                            <div class="alert alert-danger">
                                <ul>
                                        <li><?= $alertErr ?></li>
                                </ul>
                            </div>
                        <?php endif ?>

                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label>Tên bảng chấm công</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                                <select class="custom-select" name="tenbcc">
                                <option value="0">Chọn tên bảng chấm công</option>
                                    <?php foreach ($chamcong as $item) : ?>
                                        <option value="<?= $item->id ?>"><?= $item->tenbcc ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                  
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType9">Người tạo</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                            <input type="text" class="form-control" id="inputType1" name="nguoitao">
                            </div>
                        </div>
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType9">Thời gian tạo</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                                <input type="date" class="form-control" id="inputType1" name="ngaytao">
                            </div>
                        </div>
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType9">Lương</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                            <input type="text" class="form-control" id="inputType1" name="luong">
                            </div>
                        </div>
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <button type="submit" name="create" class="btn btn-sm btn-success">Thêm mới</button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <?php
    include('../../layouts/admin/footer.php');
    ?>