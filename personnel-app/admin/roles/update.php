<?php
include('../../autoload/Autoload.php');

//================== check login

if (!Auth::user()) {

    Redirect::url('admin/account/login.php');
}


$id   = Input::get('id');

if (Input::hasPost('update')) {

    $name = Input::post('name');


    Validator::required($name, "Vui lòng nhập tên danh mục")
        ->min($name, 3, "Tên danh mục phải lớn hơn 3 kí ự");


    if (!Validator::anyErrors()) {
        $success = $DB->update(
            'roles',
            [
                'name' => $name,
            ],
            $id
        );


        if ($success === true) {
            $alertSuccess = "Cập nhật loại quyền thành công";
        } else {
            $alertErr     = $success;
        }
    }

}

$data = $DB->find('roles', $id);

if (!is_object($data)) {
    die('Không tồn tại loại quyền');
}



$title = "Cập nhật danh mục sản phẩm";
include('../../layouts/admin/header.php');

?>
<div class="d-flex justify-content-between mb-4">
    <h4>Cập nhật loại quyền</h4>
    <a href="<?= url('admin/roles') ?>" class="btn btn-primary btn-sm"><i class="mdi mdi-arrow-left-bold"></i></a>
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
                                <label for="inputType1">Tên quyền</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left">
                                <input name="name" type="text" class="form-control" id="inputType1" value="<?= $data->tendanhnamemuc ?>">
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