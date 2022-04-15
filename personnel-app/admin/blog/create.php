<?php
include('../../autoload/Autoload.php');

//================== check login

if (!Auth::user()) {

    Redirect::url('admin/account/login.php');
}
//================= add category

$news = $DB->query('SELECT * FROM  danhmuc_blog');

if(Input::hasPost('create')) {
   $title     = Input::post('tieude');
   $doantrich = Input::post('doantrich');
   $noidung   = Input::post('noidung');
   $danhmuc   = Input::post('danhmuc_id');
   Validator::required($title, "Vui lòng nhập tên bài viết")
        ->min($title, 1, "Tên bài viết quá ngắn")
        ->required($doantrich, "Vui lòng nhập mô tả ")
        ->required($noidung, "Vui lòng nhập mô tả ")
        ->min($doantrich, 3, "Mô tả quá ngắn ");
    $arrPost = array(
        "tieude" => $title,
        "doantrich" => $doantrich,
        "noidung" => $noidung,
        "danhmuc_id" => $danhmuc,
        "hinhanh" => Input::post('thumbnailUrl'),
        "user_id" => Auth::user()->id,
    );
    if(!Validator::anyErrors()){
        $success = $DB->create('baiviet',$arrPost);
        if($success === true){
            $alertSuccess = "Thêm bài viết thành công";
        }
        else {
            $alertErr     = $success;
        }
    };
}


$title = "Thêm mới bài viết";
include('../../layouts/admin/header.php');

?>
<div class="d-flex justify-content-between mb-4">
    <h4>Thêm mới bài viết</h4>
    <a href="<?= url('admin/blog') ?>" class="btn btn-primary btn-sm"><i class="mdi mdi-arrow-left-bold"></i></a>
</div>
<div class="container">
    <div class="grid-body">
        <div class="item-wrapper">
            <form method="post">
                <div class="row mb-3">
                    <div class="col-md-8 mx-auto">
                        <?php
                         if(Validator::anyErrors()) :?>
                           <div class="alert alert-danger">
                                <ul>
                                    <?php foreach (Validator::$errors as $err) : ?>
                                        <li><?= $err ?></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        <?php endif ?>
                        <?php
                        if(isset($alertSuccess)) :?>
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
                                <label for="inputType1">Tiêu đề </label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left">
                                <input type="text" class="form-control" id="inputType1" name="tieude">
                            </div>
                        </div>
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType1">Đoạn trích</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                                <textarea class="form-control" id="inputType9" cols="12" rows="5" name="doantrich"></textarea>
                            </div>
                        </div>
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType1">Nội dung</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                                <textarea class="form-control" id="inputType9" cols="12" rows="5" name="noidung"></textarea>
                            </div>
                        </div>

                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label for="inputType1">Hình ảnh</label>
                            </div>
                            <div class="col-md-9 showcase_content_area text-left upload-thumb">
                                <div class="upload-thumb-canvas">
                                    <img id="thumbnail" alt="" class="img-fluid h-100">
                                    <input type="file" class="form-control upload-thumb-input" id="inputType7" name="thumbnailUpload">
                                    <input type="hidden" class="form-control upload-thumb-input" id="inputType7" name="thumbnailUrl">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row showcase_row_area">
                            <div class="col-md-2 showcase_text_area text-left">
                                <label>Danh mục</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                                <select class="custom-select" name="danhmuc_id">
                                <option value="0">Chọn danh mục</option>
                                    <?php foreach ($news as $item) : ?>
                                        <option value="<?= $item->id ?>"><?= $item->tendanhmuc ?></option>
                                    <?php endforeach ?>
                                </select>
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
    </script>