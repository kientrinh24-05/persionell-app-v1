<?php
include('../../autoload/Autoload.php');

//================== check login

if (!Auth::user()) {

    Redirect::url('admin/account/login.php');
}


//================= validate
$news = $DB->query('SELECT * FROM  phongban');

if (Input::hasPost('create')) {
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
        $success = $DB->create('nhanvien',[
            'tennhanvien' => $tennhanvien,
            'ngaysinh' => $ngaysinh,
            'gioitinh' => $gioitinh,
            'sodienthoai' => $sodienthoai,
            'diachi' => $diachi,
            'cccd' => $cccd,
            'maPB' => $phongban,
            'Hesoluong' => $hesoluong,
            'trinhdo' => $trinhdo,
            'chucvu' => $chucvu,
        ]);

        if($success === true){
            $alertSuccess = "Thêm nhân viên thành công";
        }
        else{
            $alertErr     = $success;
        }
    }
}

$title = "Thêm mới nhân viên";
include('../../layouts/admin/header.php');

?>
<div class="d-flex justify-content-between mb-4">
    <h4>Thêm mới nhân viên</h4>
    <a href="<?= url('admin/employment') ?>" class="btn btn-primary btn-sm"><i class="mdi mdi-arrow-left-bold"></i></a>
</div>
<div class="container">
    <div class="grid-body">
        <div class="item-wrapper">
            <form action="<?= url('admin/employment/create.php') ?>" method="post">
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
                                <input type="text" class="form-control" id="inputType1" name="tennhanvien">
                            </div>
                        </div>

                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType1">Ngày sinh</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left">
                                <input type="date" class="form-control" id="inputType1" name="ngaysinh">
                            </div>
                        </div>
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType1">Giới tính</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left">
                                <input type="text" class="form-control" id="inputType1" name="gioitinh">
                            </div>
                        </div>
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType1">Số điện thoại</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left">
                                <input type="text" class="form-control" id="inputType1" name="sodienthoai">
                            </div>
                        </div>
                        
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType9">Địa chỉ</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                                <textarea class="form-control" id="inputType9" cols="12" rows="2" name="diachi"></textarea>
                            </div>
                        </div>

                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType1">Số CCCD</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left">
                                <input type="text" class="form-control" id="inputType1" name="cccd">
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
                                <input type="text" class="form-control" id="inputType1" name="hesoluong">
                            </div>
                        </div>

                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType1">Trình độ</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left">
                                <input type="text" class="form-control" id="inputType1" name="trinhdo">
                            </div>
                        </div>
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType1">Chức vụ</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left">
                                <input type="text" class="form-control" id="inputType1" name="chucvu">
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