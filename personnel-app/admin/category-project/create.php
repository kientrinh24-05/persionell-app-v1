<?php
include('../../autoload/Autoload.php');

//================== check login

if (!Auth::user()) {

    Redirect::url('admin/account/login.php');
}


//================= validate

if (Input::hasPost('create')) {

    $tendanhmuc = Input::post('tendanhmuc');
    $mota       = Input::post('mota');

<<<<<<< HEAD:admin/category-project/create.php
    Validator::required($tendanhmuc, "Vui lòng nhập tên danh mục dự án")
        ->min($tendanhmuc, 3, "Tên danh mục dự án phải lớn hơn 3 kí ự")
=======
    Validator::required($tendanhmuc, "Vui lòng nhập tên danh mục")
        ->min($tendanhmuc, 3, "Tên danh mục phải lớn hơn 3 kí ự")
>>>>>>> 7a0fc416a8f6e90a19a20039bc461189c12d1e73:admin/blog-category/create.php
        ->required($mota, "Vui lòng nhập mô tả ")
        ->min($mota, 3, "Mô tả quá ngắn ");


    if (!Validator::anyErrors()) {
<<<<<<< HEAD:admin/category-project/create.php
        $success = $DB->create('danhmuc',[
=======
        $success = $DB->create('danhmuc_blog',[
>>>>>>> 7a0fc416a8f6e90a19a20039bc461189c12d1e73:admin/blog-category/create.php
            'tendanhmuc' => $tendanhmuc,
            'mota'       => $mota,
        ]);

        if($success === true){
<<<<<<< HEAD:admin/category-project/create.php
            $alertSuccess = "Thêm danh mục dự án thành công";
=======
            $alertSuccess = "Thêm danh mục thành công";
>>>>>>> 7a0fc416a8f6e90a19a20039bc461189c12d1e73:admin/blog-category/create.php
        }
        else{
            $alertErr     = $success;
        }
    }
}

<<<<<<< HEAD:admin/category-project/create.php
$title = "Thêm mới danh mục  dự án";
=======
$title = "Thêm mới danh mục sản phẩm";
>>>>>>> 7a0fc416a8f6e90a19a20039bc461189c12d1e73:admin/blog-category/create.php
include('../../layouts/admin/header.php');

?>
<div class="d-flex justify-content-between mb-4">
    <h4>Thêm mới danh mục dự án</h4>
    <a href="<?= url('admin/category-project') ?>" class="btn btn-primary btn-sm"><i class="mdi mdi-arrow-left-bold"></i></a>
</div>
<div class="container">
    <div class="grid-body">
        <div class="item-wrapper">
<<<<<<< HEAD:admin/category-project/create.php
            <form action="<?= url('admin/category-project/create.php') ?>" method="post">
=======
            <form action="<?= url('admin/blog-category/create.php') ?>" method="post">
>>>>>>> 7a0fc416a8f6e90a19a20039bc461189c12d1e73:admin/blog-category/create.php
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
                                <label for="inputType1">Tên loại</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left">
                                <input type="text" class="form-control" id="inputType1" name="tendanhmuc">
                            </div>
                        </div>
                  
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType9">Mô tả</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                                <textarea class="form-control" id="inputType9" cols="12" rows="5" name="mota"></textarea>
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