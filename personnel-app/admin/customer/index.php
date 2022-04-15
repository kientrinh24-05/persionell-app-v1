<?php
include('../../autoload/Autoload.php');

//================== check login

if (!Auth::user()) {

    Redirect::url('admin/account/login.php');
}

$sql = "SELECT * FROM khachhang";
$data = $DB->query($sql);

$title = "Quản lý khách hàng";
include('../../layouts/admin/header.php');

?>
<div class="d-flex justify-content-between mb-4">
    <h4>Quản lý khách hàng </h4>
    <a href="<?= url('admin/customer/create.php') ?> " class="btn btn-primary btn-sm">Thêm mới</a>
</div>
<table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th class="th-sm">#ID
            </th>
            <th class="th-sm">Họ tên
            </th>
            <th class="th-sm">Ảnh đại diện
            </th>
            <th class="th-sm">Điện thoại
            </th>
            <th class="th-sm">Email
            </th>
            <th class="th-sm ">Địa chỉ
            </th>
            <th class="th-sm text-center">Thời gian
            </th>
            <th colspan="2" class="th-sm text-center">Hành động</th>
        </tr>
    </thead>
    <tbody>

        <?php if (is_array($data)) : ?>
            <?php $i = 1 ?>
            <?php foreach ($data as $item) : ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $item->hoten ?></td>
                    <td><img style="width:50px" src="/public/uploads/images/<?=$item->avatar?>"></td>
                    <td><?= $item->phone ?></td>
                    <td><?= $item->email ?></td>
                    <td data-toggle="modal" data-target="#basicExampleModal-<?= $item->id ?>" class="d-flex justify-content-between"><?= strlen($item->diachi) > 20 ?  substr($item->diachi, 0, 20) . '...' . '<i style="cursor:pointer" class="mdi mdi-eye"></i>' : $item->diachi.' . <i style="cursor:pointer" class="mdi mdi-eye"></i>'?></td>
                    <td><?= formatDate($item->created_at) ?></td>
                    <td class="text-center" style="width:50px">
                        <a href="<?= url("admin/customer/update.php?id=$item->id") ?>"><b class='badge badge-warning status-Content'>Sửa</b></a>
                    </td>
                    <td class="text-center" style="width:50px">
                        <a href="#"><b class='badge badge-danger status-Content' type="button" data-toggle="modal" data-target="#exampleModal-<?= $item->id ?>">Xóa</b></a>
                    </td>
                </tr>
    </tbody>
    <?php $i++ ?>
<?php endforeach ?>
<?php endif ?>
</tbody>

</table>

<?php if (is_array($data)) : ?>
    <?php foreach ($data as $item) : ?>
        <div class="modal fade" id="exampleModal-<?= $item->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Xóa khách hàng</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Bạn có muốn xóa khách hàng ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <a href="<?= url("admin/customer/delete.php?id=$item->id") ?>" class="btn btn-primary">Xóa</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
<?php endif ?>

<?php if (is_array($data)) : ?>
    <?php foreach ($data as $item) : ?>
        <div class="modal fade" id="basicExampleModal-<?= $item->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <p>Thông tin khách hàng</p>
                            <p>
                                <span style="font-size: 14px"><span style="width:80px; display:inline-block">Họ tên: </span><?= $item->hoten ?></span>
                            </p>
                            <p>
                                <span style="font-size: 14px"><span style="width:80px; display:inline-block">Email: </span><?= $item->email ?></span>
                            </p>
                            <p>
                                <span style="font-size: 14px"><span style="width:80px; display:inline-block">Phone: </span><?= $item->phone ?></span>
                            </p>
                            <p>
                                <span style="font-size: 14px"><span style="width:80px; display:inline-block">Địa chỉ: </span><?= $item->diachi ?></span>
                            </p>
                            <p>
                                <span style="font-size: 14px"><span style="width:80px; display:inline-block">Ghi chú: </span><?= $item->note ?></span>
                            </p>
                     
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
<?php endif ?>


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
