<?php
include('../../autoload/Autoload.php');

//================== check login

if (!Auth::user()) {

    Redirect::url('admin/account/login.php');
}

$sql = "SELECT * FROM chamcong AS C INNER JOIN nhanvien AS N ON C.manv = N.id INNER JOIN phongban AS P ON P.id = N.maPB";
$data = $DB->query($sql);

$title = "Bài viết";
include('../../layouts/admin/header.php');

?>
<div class="d-flex justify-content-between mb-4">
    <h4>Danh sách chấm công </h4>
    <a href="<?= url('admin/blog/create.php') ?>" class="btn btn-primary btn-sm">Thêm mới</a>
</div>
<table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th class="th-sm">#ID
            </th>
            <th class="th-sm">Tên bảng chấm công
            </th>
            <th class="th-sm">Tên nhân viên
            </th>
            <th class="th-sm">Tên phòng ban
            </th>
            <th class="th-sm text-center">Số ngày nghỉ
            </th>
            <th class="th-sm text-center">Tổng số ngày làm
            </th>
            <th class="th-sm text-center">Người lập
            </th>
            <th class="th-sm text-center">Ngày lập
            </th>
        </tr>
    </thead>
    <tbody>
        <?php if (is_array($data)) : ?>
            <?php $i = 1 ?>
            <?php foreach ($data as $item) : ?>
                <tr>
                    <td style="width:50px"><?= $i ?></td>
                    <td>
                      <?= strlen($item->tenbcc) > 50 ?  substr($item->tenbcc, 0, 50) . ' ...' : $item->tenbcc ?>
                    </td>
                    <td>
                        <?= strlen($item->tennhanvien) > 200 ?  substr($item->tennhanvien, 0, 200) . ' ...' : $item->tennhanvien ?>
                    </td>
                    <td>
                        <?= strlen($item->tenphongban) > 200 ?  substr($item->tenphongban, 0, 200) . ' ...' : $item->tenphongban ?>
                    </td>
                    <td >
                        <?= $item->songaynghi ?>
                    </td>
                    <td >
                        <?= $item->tongsongaylam ?>
                    </td>
                    <td>
                        <?= $item->nguoilap ?>
                    </td>
                    
                    <td style="width:120px">
                        <?= formatDate($item->ngaylap) ?>
                    </td>

                    <!-- <td class="text-center" style="width:50px">
                        <a href="<?= url("admin/blog/update.php?id=$item->id") ?>"><b class='badge badge-warning status-Content'>Sửa</b></a>
                    </td>
                    <td class="text-center" style="width:50px">
                        <a href="#"><b class='badge badge-danger status-Content' type="button" data-toggle="modal" data-target="#exampleModal-<?= $item->id ?>">Xóa</b></a>
                    </td> -->
                </tr>
                <?php $i++ ?>
            <?php endforeach ?>
        <?php endif ?>
    </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xóa danh mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Bạn có muốn xóa danh mục không ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary">Xóa</button>
            </div>
        </div>
    </div>
</div>

<?php
include('../../layouts/admin/footer.php');
?>

<script>
    $(document).ready(function() {
        $('#dtBasicExample').DataTable({
            "order": [
                [0, "desc"]
            ]
        }, );
        $('.dataTables_length').addClass('bs-select');
    });
</script>
<script>
    // change status contact while click show content
    let showContents = document.querySelectorAll('.show-Content');
    let statusContent = document.querySelectorAll('.status-Content');

    showContents.forEach(function(item, index) {
        item.addEventListener('click', function() {
            let idContact = this.dataset.target.slice(19);

            let url = "/admin/contact/update-status/" + idContact;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    statusContent[index].className = 'badge badge-success status-Content';
                    statusContent[index].innerText = 'Đã xem';
                })
                .catch(err => {
                    console.log(err);
                })
        })
    })
</script>