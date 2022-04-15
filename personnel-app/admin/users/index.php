<?php
include('../../autoload/Autoload.php');

//================== check login

if (!Auth::user()) {

    Redirect::url('admin/account/login.php');
}

$sql = "SELECT * FROM users";
$data = $DB->query($sql);

$title = "Quản lý sản phẩm";
include('../../layouts/admin/header.php');

?>
<div class="d-flex justify-content-between mb-4">
    <h4>Quản lý users</h4>
     <a href="<?= url('admin/users/create.php') ?> " class="btn btn-primary btn-sm">Thêm mới</a>
</div>
<table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm" >#ID
      </th>
      <th class="th-sm" >Hình đại diện
      </th>

      <th class="th-sm">Tên
      </th>
      <th class="th-sm text-center">Email
      </th>
      <th class="th-sm text-center">Địa chỉ
      </th>
      <th class="th-sm text-center">Quyền
      </th>
      <th class="th-sm text-center">Thời gian
      </th>
      <th colspan="2" class="th-sm text-center">Hành động</th>
    </tr>
  </thead>
  <tbody>
    
  <?php if(is_array($data)): ?>
      <?php $i = 1 ?>
      <?php foreach($data as $item): ?>
    <tr>
      <td ><?= $i ?></td>
      <td class="text-center"><img style="width:50px" src="<?=$item->avatar ?>"></td>
      <td ><?= $item->name ?></td>
    
      <td class="text-center"><?= $item->email ?></td>
      <td class="text-center"><?= $item->address ?></td>
      <td class="text-center"><?= $item->role ?></td>
      <td class="text-center"><?= formatDate($item->created_at) ?></td>
      <td class="text-center" style="width:50px">
        <a href="<?= url("admin/users/update.php?id=$item->id") ?>"><b class='badge badge-warning status-Content'>Sửa</b></a>
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

    <?php if(is_array($data)): ?>
      <?php foreach($data as $item): ?>
        <div class="modal fade" id="exampleModal-<?= $item->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xóa users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Bạn có muốn xóa users ?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <a href="<?= url("admin/users/delete.php?id=$item->id") ?>" class="btn btn-primary">Xóa</a>
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
        $(document).ready(function () {
            $('#dtBasicExample').DataTable( 
               {  
                 "order": [[ 0, "desc" ]]
               },
            );
            $('.dataTables_length').addClass('bs-select');
        });
    </script>