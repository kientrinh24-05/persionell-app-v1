<?php
include('../../autoload/Autoload.php');

//================== check login

if (!Auth::user()) {

    Redirect::url('admin/account/login.php');
}


$categories = $DB->query('SELECT * FROM danhmuc');


if (Input::hasPost('create')) {


    
    $tensanpham = Input::post('tensanpham');
    $mota       = Input::post('mota');
    $giaban     = Input::post('giaban');
    $soluong    = Input::post('soluong');
    $sale       = Input::post('sale');
    $danhmuc_id = Input::post('danhmuc_id');
    $hinhanh    = Input::post('thumbnailUrl');
    $images     = Input::post('images');

    Validator::required($tensanpham, "Vui lòng nhập tên sản phẩm")
        ->min($tensanpham, 1, "Tên sản phẩm quá ngắn")
        ->required($mota, "Vui lòng nhập mô tả ")
        ->min($mota, 3, "Mô tả quá ngắn ")
        ->required($giaban, "Vui lòng nhập giá bán ")
        ->numeric($giaban, "Giá bán không hợp lệ ")
        ->required($soluong, "Vui lòng nhập số lượng ")
        ->numeric($giaban, "Số lượng không hợp lệ ")
        ->categoryRequired($danhmuc_id, "Vui lòng chọn loại sản phẩm")
        ->required($hinhanh, "Vui lòng chọn thumbnail");

    if (!Validator::anyErrors()) {
        $success = $DB->create('sanpham', [
            'tensanpham' => $tensanpham,
            'mota'       => $mota,
            'giaban'     => $giaban,
            'soluong'    => $soluong,
            'danhmuc_id' => $danhmuc_id,
            'sale'       => $sale,
            'hinhanh'    => $hinhanh,
            'danhgia'    => 5,
            'luotmua'    => 0,
            'user_id'    => Auth::user()->id,
        ]);

        $productId = $DB->lastId();

         // add images

        foreach($images as $value){

            if($value != ''){
                $DB->create('anhsanpham',[
                    'url'        => $value,
                    'sanpham_id' => $productId
                ]);
            }
        }

        if ($success === true) {
            $alertSuccess = "Thêm sản phẩm thành công";
        } else {
            $alertErr     = $success;
        }
    }
}

$title = "Thêm mới danh mục sản phẩm";
include('../../layouts/admin/header.php');
?>
<div class="d-flex justify-content-between mb-4">
    <h4>Thêm sản phẩm</h4>
    <a href="<?= url('admin/product') ?>" class="btn btn-primary btn-sm"><i class="mdi mdi-arrow-left-bold"></i></a>
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
                                <label for="inputType1">Tên sản phẩm</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left">
                                <input type="text" class="form-control" id="inputType1" name="tensanpham">
                            </div>
                        </div>

                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label>Loại sản phẩm</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                                <select class="custom-select" name="danhmuc_id">
                                    <option value="0">Chọn danh mục</option>
                                    <?php foreach ($categories as $item) : ?>
                                        <option value="<?= $item->id ?>"><?= $item->tendanhmuc ?></option>
                                    <?php endforeach ?>
                                </select>
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
                                <label for="inputType5">Số lượng</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left">
                                <input type="text" class="form-control" id="inputType5" name="soluong">
                            </div>
                        </div>

                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType6">Gía bán (vnđ)</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left">
                                <input type="text" class="form-control" id="inputType6" name="giaban">
                            </div>
                        </div>

                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType5">Sale (%)</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left">
                                <input type="text" class="form-control" id="inputType5" name="sale">
                            </div>
                        </div>
                        <div class="form-group row showcase_row_area thumb mb-5">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType7">Thumbnail</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left upload-thumb">
                                <div class="upload-thumb-canvas">
                                    <img id="thumbnail" alt="" class="img-fluid h-100">
                                    <input type="file" class="form-control upload-thumb-input" id="inputType7" name="thumbnailUpload">
                                    <input type="hidden" class="form-control upload-thumb-input" id="inputType7" name="thumbnailUrl">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row showcase_row_area thumb">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType7">Images</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left upload-thumb d-flex">
                                <div class="upload-thumb-canvas mr-3">
                                    <img class="img-fluid" id="images-0" alt="">
                                    <input type="file" class="form-control upload-thumb-input images" id="inputT">
                                    <input type="hidden" name="images[0]">
                                </div>
                                <div class="upload-thumb-canvas mr-3">
                                    <img class="img-fluid" id="images-1"  alt="">
                                    <input type="file" class="form-control upload-thumb-input images" id="inputType7">
                                    <input type="hidden" name="images[1]">
                                </div>
                                <div class="upload-thumb-canvas mr-3">
                                    <img class="img-fluid" id="images-2"  alt="">
                                    <input type="file" class="form-control upload-thumb-input images" id="inputType7">
                                    <input type="hidden" name="images[2]">
                                </div>
                                <div class="upload-thumb-canvas mr-3">
                                    <img class="img-fluid" id="images-3"  alt="">
                                    <input type="file" class="form-control upload-thumb-input images" id="inputType7">
                                    <input type="hidden" name="images[3]">
                                </div>
                                <div class="upload-thumb-canvas mr-3">
                                    <img class="img-fluid"  id="images-4" alt="">
                                    <input type="file" class="form-control upload-thumb-input images" id="inputType7">
                                    <input type="hidden" name="images[4]">
                                </div>
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