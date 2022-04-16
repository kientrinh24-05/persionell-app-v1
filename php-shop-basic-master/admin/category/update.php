<?php
include('../../autoload/Autoload.php');

//================== check login

if (!Auth::user()) {

    Redirect::url('admin/account/login.php');
}

$news = $DB->query('SELECT * FROM  phongban');
$id   = Input::get('id');

if (Input::hasPost('update')) {
    $tennhanvien = Input::post('tennhanvien');
    $ngaysinh       = Input::post('ngaysinh');
    $gioitinh       = Input::post('gioitinh');
    $sodienthoai     = Input::post('sodienthoai');
    $diachi       = Input::post('diachi');
    $cccd       = Input::post('cccd');
    $phongban = Input::post('maPB');
    $hesoluong       = Input::post('hesoluong');
    $trinhdo       = Input::post('trinhdo');
    $chucvu       = Input::post('chucvu');
// print_r($data);
// die();
    Validator::required($tennhanvien, "Vui lòng nhập tên nhân viên")
        ->min($tennhanvien, 3, "Tên danh mục phải lớn hơn 3 kí ự")
        ->required($ngaysinh, "Vui lòng nhập ngày sinh ")
        ->min($ngaysinh, 3, "Ngày sinh quá ngắn ")
        ->required($gioitinh, "Vui lòng nhập giới tính ")
        ->required($sodienthoai, "Vui lòng nhập số điện thoại ")
        ->min($sodienthoai, 7, "Số điện thoại quá ngắn ")
        ->required($diachi, "Vui lòng nhập địa chỉ ")
        ->min($diachi, 3, "Địa chỉ quá ngắn ")
        ->required($cccd, "Vui lòng nhập số cccd ")
        ->min($cccd, 3, "Số cccd quá ngắn ")
        ->required($hesoluong, "Vui lòng nhập hệ số lương ")
        ->required($trinhdo, "Vui lòng nhập trình độ ")       
        ->required($chucvu, "Vui lòng nhập chức vụ ");


    if (!Validator::anyErrors()) {
        $success = $DB->update(
            'nhanvien',
            [
            'tennhanvien' => $tennhanvien,
            'ngaysinh' => $ngaysinh,
            'gioitinh' => $gioitinh,
            'sodienthoai' => $sodienthoai,
            'diachi' => $diachi,
            'cccd' => $cccd,
            'maPB' => $phongban,
            'hesoluong' => $hesoluong,
            'trinhdo' => $trinhdo,
            'chucvu' => $chucvu,
            ],
            $id
        );


        if ($success === true) {
            $alertSuccess = "Cập nhật thành công";
        } else {
            $alertErr     = $success;
        }
    }

}

$data = $DB->find('nhanvien', $id);

if (!is_object($data)) {
    die('Không tồn tại nhân viên');
}



$title = "Cập nhật nhân viên";
include('../../layouts/admin/header.php');

?>
<div class="d-flex justify-content-between mb-4">
    <h4>Cập nhật nhân viên</h4>
    <a href="<?= url('admin/category') ?>" class="btn btn-primary btn-sm"><i class="mdi mdi-arrow-left-bold"></i></a>
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
                                <label for="inputType1">Tên nhân viên</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left">
                                <input name="tennhanvien" type="text" class="form-control" id="inputType1" value="<?= $data->tennhanvien ?>">
                            </div>
                        </div>

                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType1">Ngày sinh</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left">
                                <input name="ngaysinh" type="date" class="form-control" id="inputType1" value="<?= $data->ngaysinh ?>">
                            </div>
                        </div>
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType1">Giới tính</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left">
                                <input name="gioitinh" type="text" class="form-control" id="inputType1" value="<?= $data->gioitinh ?>">
                            </div>
                        </div>
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType1">Số điện thoại</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left">
                                <input name="sodienthoai" type="text" class="form-control" id="inputType1"value="<?= $data->sodienthoai ?>" >
                            </div>
                        </div>
                        
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType9">Địa chỉ</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                                <textarea name="diachi" class="form-control" id="inputType9" cols="12" rows="2" ><?= $data->diachi ?></textarea>
                            </div>
                        </div>

                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType1">Số CCCD</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left">
                                <input name="cccd" type="text" class="form-control" id="inputType1" value="<?= $data->cccd ?>">
                            </div>
                        </div>

                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label>Tên phòng ban</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                                <select class="custom-select" name="maPB">
                                <option value="0">Chọn phòng ban</option>
                                    <?php foreach ($news as $item) : ?>
                                        <option value="<?= $item->id ?>"><?= $item->tenphongban ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType1">Hệ số lương</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left">
                                <input name="hesoluong" type="text" class="form-control" id="inputType1" value="<?= $data->Hesoluong ?>">
                            </div>
                        </div>

                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType1">Trình độ</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left">
                                <input name="trinhdo" type="text" class="form-control" id="inputType1" value="<?= $data->trinhdo; ?>">
                            </div>
                        </div>
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType1">Chức vụ</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left">
                                <input name="chucvu" type="text" class="form-control" id="inputType1" value="<?= $data->chucvu ?>">
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