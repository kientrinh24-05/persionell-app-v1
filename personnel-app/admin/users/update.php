<?php
include('../../autoload/Autoload.php');

//================== check login

if (!Auth::user()) {

    Redirect::url('admin/account/login.php');
}


$id   = Input::get('id');


$roles = $DB->query('SELECT * FROM roles');


if (Input::hasPost('create')) {

    $name = Input::post('name');
    $email       = Input::post('email');
    $address     = Input::post('address');
    $role       = Input::post('role');
    $password       = Input::post('password');
    $avatar    = Input::post('thumbnailUrl');


    Validator::required($name, "Vui lòng nhập tên sản phẩm")
        ->min($name, 1, "Tên sản phẩm quá ngắn")
        ->required($email, "Vui lòng nhập mô tả ")
        ->min($email, 3, "Mô tả quá ngắn ")
        ->required($address, "Vui lòng nhập giá bán ")
        ->numeric($address, "Giá bán không hợp lệ ")
        ->required($soluong, "Vui lòng nhập số lượng ")
        ->min($address ,3, "Dịa chỉ quá ngắn ")
        ->categoryRequired($role, "Vui lòng chọn quyền")
        ->required($avatar, "Vui lòng chọn thumbnail");


    if (!Validator::anyErrors()) {
        $success = $DB->update('sanpham', [
            'name' => $name,
            'email'       => $email,
            'address'     => $address,
            'role' => $role,
            'hinhanh'    => $hinhanh,
            'password'    => $password,
            'user_id'    => Auth::user()->id,
        ], $id);

        if ($success === true) {
            $alertSuccess = "Cập nhật user thành công";
        } else {
            $alertErr     = $success;
        }
    }


    $DB->delete('anhsanpham', $id, ['sanpham_id']);

    // add images

    
}





$data   = $DB->find('users', $id);
// $images = $DB->query("select * from anhsanpham where sanpham_id = $id ");


if (!is_object($data)) {
    die('Không tồn tại users');
}



$title = "Thêm mới danh mục sản phẩm";
include('../../layouts/admin/header.php');
?>
<div class="d-flex justify-content-between mb-4">
    <h4>Cập nhật users</h4>
    <a href="<?= url('admin/users') ?>" class="btn btn-primary btn-sm"><i class="mdi mdi-arrow-left-bold"></i></a>
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

                        <?php if (isset($alertErr)) : ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <li><?= $alertErr ?></li>
                                </ul>
                            </div>
                        <?php endif ?>

                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType1">Tên</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left">
                                <input type="text" class="form-control" id="inputType1" name="name" value="<?= $data->name ?>">
                            </div>
                        </div>

                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label>Quyền</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                                <select class="custom-select" name="role">
                                    <option value="0">Chọn danh mục</option>
                                    <?php foreach ($roles as $item) : ?>
                                        <?php if ($item->id == $data->role) : ?>
                                            <option value="<?= $item->id ?>" selected><?= $item->name ?></option>
                                        <?php else : ?>
                                            <option value="<?= $item->id ?>"><?= $item->name ?></option>
                                        <?php endif ?>

                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType9">Email</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left">
                                <input type="email" class="form-control" id="inputType1" name="email" value="<?= $data->email ?>">
                            </div>
                        </div>

                        

                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType6">Địa chỉ</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left">
                                <input type="text" class="form-control" id="inputType1" name="address" value="<?= $data->address ?>">
                            </div>
                        </div>
                        
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType9">Password</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left">
                                <input type="password" class="form-control" id="inputType1" name="password" value="<?= $data->password ?>">
                            </div>
                        </div>

    
                        <div class="form-group row showcase_row_area thumb mb-5">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType7">Thumbnail</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left upload-thumb">
                                <div class="upload-thumb-canvas">
                                    <img id="thumbnail" alt="" class="img-fluid h-100" src="<?= $data->hinhanh ?>?>">
                                    <input type="file" class="form-control upload-thumb-input" id="inputType7" name="thumbnailUpload">
                                    <input type="hidden" class="form-control upload-thumb-input" id="inputType7" value="<?= $data->hinhanh ?>" name="thumbnailUrl">
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
            </form>
        </div>
    </div>

    <?php
    include('../../layouts/admin/footer.php');
    ?>

    <style>
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

        let inputImages = document.querySelectorAll('.images');
        inputImages.forEach(function(item, index) {
            item.addEventListener('change', function() {

                let thumbnail = document.querySelector('#images-' + index);
                let thumbnailUrl = document.querySelector(`input[name="images[${index}]"]`)
                let url = "<?= url('admin/upload/index.php') ?>";
                let formData = new FormData();
                formData.append("thumbnailUpload", item.files[0]);
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
        })
    </script>