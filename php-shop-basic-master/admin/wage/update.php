<?php
include('../../autoload/Autoload.php');

//================== check login

if (!Auth::user()) {

    Redirect::url('admin/account/login.php');
}


$id   = Input::get('id');
$chamcong = $DB->query('SELECT * FROM  chamcong'); 
if (Input::hasPost('update')) {

    $maBCC = Input::post('bcc_id');
    $ngaytao       = Input::post('ngaytao');
    $nguoitao       = Input::post('nguoitao');
    $luong       = Input::post('luong');

    Validator::required($nguoitao, "Vui lòng nhập tên người tạo")
    ->min($nguoitao, 3, "Tên người tạo phải lớn hơn 3 kí ự")
    ->required($luong, "Vui lòng nhập lương ")
    ->min($luong, 3, "Lương quá ngắn ");


    if (!Validator::anyErrors()) {
        $success = $DB->update(
            'luong',
            [
                'maBCC' => $maBCC,
                'ngaytao'       => $ngaytao,
                'nguoitao'       => $nguoitao,
                'luong'       => $luong,
            ],
            $id
        );


        if ($success === true) {
            $alertSuccess = "Cập nhật lương thành công";
        } else {
            $alertErr     = $success;
        }
    }

}

$data = $DB->find('luong', $id);

if (!is_object($data)) {
    die('Không tồn tại lương');
}



$title = "Cập nhật lương ";
include('../../layouts/admin/header.php');

?>
<div class="d-flex justify-content-between mb-4">
    <h4>Cập nhật Lương</h4>
    <a href="<?= url('admin/wage') ?>" class="btn btn-primary btn-sm"><i class="mdi mdi-arrow-left-bold"></i></a>
</div>
<div class="container">
    <div class="grid-body">
        <div class="item-wrapper">
            <form method="post">
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
                                <option value="<?= $data->maBCC?>">Chọn tên bảng chấm công</option>
                                    <?php foreach ($chamcong as $item) : ?>
                                        <option value="<?= $data->maBCC?>"><?= $item->tenbcc ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                                    
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType9">Người tạo</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                            <input type="text" class="form-control" id="inputType1" name="nguoitao" value="<?= $data->nguoitao?>">
                            </div>
                        </div>
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType9">Thời gian tạo</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                                <input type="date" class="form-control" id="inputType1" name="ngaytao" value="<?= $data->ngaytao?>">
                            </div>
                        </div>
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType9">Lương</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                            <input type="text" class="form-control" id="inputType1" name="luong" value="<?= $data->luong?>">
                            </div>
                        </div>
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <button name="update" class="btn btn-sm btn-success">Cập nhật</button>
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